<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    }

    public function sendVerificationViaEmail($user_id)
    {
        $user = $this->userRepository->find($user_id);
        $user->sendEmailVerificationNotification();
        return back()
        ->withSuccess('A fresh verification link has been sent to your email address.');
    }

}