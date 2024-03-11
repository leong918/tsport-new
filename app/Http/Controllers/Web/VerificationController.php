<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Repositories\UserRepository;

class VerificationController extends Controller
{
    /**
     * Instantiate a new VerificationController instance.
     */
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
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
        // dd($request->user()->hasVerifiedEmail(),123123);
        return $request->user()->hasVerifiedEmail() 
            ? redirect()->route('web.home') : view('web.auth.verify_email');
    }

    /**
     * User's email verificaiton.
     *
     * @param  \Illuminate\Http\EmailVerificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function verify(EmailVerificationRequest $request)
    {
        $user = $this->userRepository->find($request->id);
        if($user){
            $user->status = 1;
            $user->save();
            $request->fulfill();
        }
        return redirect()->intended(route('web.home'));
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