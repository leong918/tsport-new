<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\PointLogRepository;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
class VerificationController extends Controller
{
    /**
     * Instantiate a new VerificationController instance.
     */
    protected UserRepository $userRepository;
    protected PointLogRepository $pointLogRepository;

    public function __construct(UserRepository $userRepository, PointLogRepository $pointLogRepository)
    {
        $this->userRepository = $userRepository;
        $this->pointLogRepository = $pointLogRepository;
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
    
        if ($user->markEmailAsVerified()){
            event(new Verified($user));
            $user->status = 1;
            $user->point = 10;
            $user->save();

            $pointLogData['user_id'] = $user->id;
            $pointLogData['point'] = 10;
            $pointLogData['remark'] = '10 points gained from registration.';
            $this->pointLogRepository->create($pointLogData);
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