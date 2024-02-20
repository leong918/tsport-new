<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Form\Web\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class AuthController extends BaseController
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return $this->view('auth.login');
    }

    public function doLogin(UserLoginRequest $request)
    {
        $remember = $request->has('remember') ?? false;

        $credentials = $request->only('phone_no', 'password');
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended(route('web.home'));
        }

        return redirect()->back()->withInput()->with('error', 'Failed to Login, please try again.');
    }

    public function register()
    {
        return $this->view('auth.register');
    }
    public function doRegister(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'email' => 'required|unique:user',
            'phone_no' => 'required|unique:user',
            'password' => 'required|min:6|confirmed',
            'accept_tnc' => 'required',
        ]);
        $fillData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['first_name'],
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'birth_month' => $data['birth_month'],
            'password' => $data['password'],
            'referral_email' => $data['ref_email'],
            'referral_phone_no' => $data['ref_phone_no'],
        ];
        $this->userRepository->createUser($fillData);

        Session::flash('swal', [
            'title' => 'Successful Registration',
            'text' => 'Congratulations, your account has been successfully created.',
            'type' => 'success'
        ]);
        

        return redirect()->route("web.home");

    }

    public function forgotPassword()
    {
        return $this->view('auth.forgot_password');
    }

    public function doForgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required'
        ]);

        $user = $this->userRepository->makeModel()->where(["email" => $request->email])->first();
        if (!$user) {
            Session::flash('swal', [
                'title' => 'Error',
                'text' => 'Account Not Found',
                'type' => 'error'
            ]);
            return back()->withInput();
        }

        $randomString = generateRandomString(10, false);
        Mail::to($user->email)->send(new ForgotPasswordMail($randomString));
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('web.login'))->with('success', 'Successfully logged out');
    }

    public function resetPassword()
    {
        return $this->view('auth.reset_password');
    }

    public function doResetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);
        
        return redirect('web.home');
    }

}
