<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralException;
use App\Http\Requests\Form\Admin\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function doLogin(AdminLoginRequest $request)
    {
        $remember = $request->has('remember') ?? false;

        $credentials = $request->only('username', 'password');
            if (Auth::guard('admin')->attempt($credentials + ['status' => Admin::STATUS['ACTIVE']], $remember)) {
            // Authentication passed...
            return redirect()->intended(route('admin.dashboard'));
        }
        throw new GeneralException('Failed to login, please try again');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'))->with('success', 'Successfully logged out');
    }
}
