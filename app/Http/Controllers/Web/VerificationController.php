<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\PointLogRepository;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\ReferralRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Carbon\Carbon;

class VerificationController extends Controller
{
    /**
     * Instantiate a new VerificationController instance.
     */
    protected UserRepository $userRepository;
    protected PointLogRepository $pointLogRepository;
    protected ReferralRepository $referralRepository;

    public function __construct(
        UserRepository $userRepository,
        PointLogRepository $pointLogRepository,
        ReferralRepository $referralRepository
    ) {
        $this->userRepository = $userRepository;
        $this->pointLogRepository = $pointLogRepository;
        $this->referralRepository = $referralRepository;
        $this->middleware('auth')->except('verify');;
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Display an email verification notice.
     *
     * @return \Illuminate\Http\Response
     */
    public function notice(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->route('web.home') : route('web.login');
    }

    /**
     * User's email verificaiton.
     *
     * @param  \Illuminate\Http\EmailVerificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $user = $this->userRepository->find($request->id);
        if ($request->route('id') != $user->getKey()) {
            throw new AuthorizationException;
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            $user->status = 1;
            $user->point = 10;
            $user->save();

            $pointLogData['user_id'] = $user->id;
            $pointLogData['point'] = 10;
            $pointLogData['type'] = 'IN';
            $pointLogData['remark'] = '10 points gained from registration.';
            $pointLogData['expired_at'] = Carbon::now()->addMonths(6);
            $this->pointLogRepository->create($pointLogData);

            // release referral coupon
            if ($user->referral_email && $user->referral_phone_no) {
                $referrer = $this->userRepository->getUserByEmail($user->referral_email);
                $this->referralRepository->releaseReferCoupon($referrer->id, $user->id);
            }

            if (function_exists('updateUserOwnerCart')) {
                $user_ip = getPublicIp();
                $coupon_session = $request->session()->pull('coupon-' . $user_ip) ?? array();
                updateUserOwnerCart($user->id, $coupon_session);
            }
        }

        return redirect(route('web.login'))->with('success', 'Account Verified!');
    }

    /**
     * Resent verificaiton email to user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()
            ->withSuccess('A fresh verification link has been sent to your email address.');
    }
}
