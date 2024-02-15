<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Form\Web\UserLoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function doLogin(UserLoginRequest $request)
    {
        $remember = $request->has('remember') ?? false;

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended(route('web.home'));
        }
        throw new Exception('Failed to login, please try again');
    }

    public function register()
    {
        return $this->view('auth.register');
    }

    public function forgotPassword()
    {
        return $this->view('auth.forgot_password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('web.login.login'))->with('success', 'Successfully logged out');
    }
}
