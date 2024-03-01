<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Form\User\UserLoginRequest;
use App\Http\Requests\Form\User\UserRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\PasswordResetTokensRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    protected UserRepository $userRepository;
    protected PasswordResetTokensRepository $passwordResetTokensRepository;

    public function __construct(UserRepository $userRepository, PasswordResetTokensRepository $passwordResetTokensRepository){
        $this->userRepository = $userRepository;
        $this->passwordResetTokensRepository = $passwordResetTokensRepository;
    }

    public function login()
    {
        return $this->view('auth.login');
    }

    public function doLogin(UserLoginRequest $request)
    {
        $remember = $request->has('remember') ?? false;

        $credentials = $request->only('phone_no', 'password');
        if (Auth::attempt($credentials + ['status' => User::STATUS['ACTIVE']], $remember)) {
            // Authentication passed...
            return redirect()->intended(route('web.home'));
        }

        return redirect()->back()->withInput()->with('error', 'Failed to Login, please try again.');
    }

    public function register()
    {
        return $this->view('auth.register');
    }
    public function doRegister(UserRegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['username'] = $data['first_name'];
            $this->userRepository->createUser($data);
            DB::commit();
            return $this->response();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function forgotPassword()
    {
        return $this->view('auth.forgot_password');
    }

    public function doForgotPassword(Request $request)
    {
        $data = $request->all();
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
        $resetRecord = [
            'email' => $data['email'],
            'token' => $randomString,
            'created_at' => now(),
        ];
        $this->passwordResetTokensRepository->createRecord($resetRecord);
        Mail::to($user->email)->send(new ForgotPasswordMail($randomString));
        Session::flash('swal', [
            'title' => 'Success',
            'text' => 'Reset Mail Successfully Requested.',
            'type' => 'success'
        ]);
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('web.login'))->with('success', 'Successfully logged out');
    }

    public function resetPassword()
    {
        $token = request('token');

        if(!$token){
            Session::flash('swal', [
                'title' => 'Error',
                'text' => 'Password Reset Token Expired!',
                'type' => 'error'
            ]);
            return redirect(route('web.home'));
        }

        $tokenRecord = $this->passwordResetTokensRepository->findRecordByToken($token);

        if($tokenRecord){
            $user = $this->userRepository->getUserByEmail($tokenRecord->email);
        
            if ($user && !$this->tokenExpired($tokenRecord->created_at)) {
                $id = $user->id;
                return $this->view('auth.reset_password', compact('id'));   
            } else {
                if($tokenRecord){
                    $tokenRecord->delete();
                }
                Session::flash('swal', [
                    'title' => 'Error',
                    'text' => 'Password Reset Token Expired!',
                    'type' => 'error'
                ]);
                return redirect(route('web.home'));
            }
        }
        else{
            Session::flash('swal', [
                'title' => 'Error',
                'text' => 'Password Reset Token Expired!',
                'type' => 'error'
            ]);
            return redirect(route('web.home'));
        }
    }

    private function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addMinutes(15)->isPast();
    }

    public function doResetPassword(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $this->userRepository->updateUser($request->all(), $data['id']);

        Session::flash('swal', [
            'title' => 'Success',
            'text' => 'Password Reset Successcully!',
            'type' => 'success'
        ]);

        return redirect(route('web.home'));
    }

}
