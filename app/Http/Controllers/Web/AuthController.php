<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Form\User\UserLoginRequest;
use App\Http\Requests\Form\User\UserRegisterRequest;
use App\Http\Requests\Form\User\UserForgotPasswordRequest;
use App\Http\Requests\Form\User\UserResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\PasswordResetTokensRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

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
            $user = $this->userRepository->createUser($data);

            event(new Registered($user));

            DB::commit();
            return response()->json(['email' => $user->email]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function forgotPassword()
    {
        return $this->view('auth.forgot_password');
    }

    public function doForgotPassword(UserForgotPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $user = $this->userRepository->makeModel()->where(["email" => $request->email])->first();
            
            if (!$user) {
                throw new \Exception('User Not Found!');
            }
            
            $randomString = generateRandomString(10, false);
            $data['token'] = $randomString;
            $this->passwordResetTokensRepository->createRecord($data);
            Mail::to($user->email)->send(new ForgotPasswordMail($randomString));
            DB::commit();
            return response()->json(['email' => $user->email]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
                'title' => '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Error</p>',
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
                    'title' => '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Error</p>',
                    'text' => 'Password Reset Token Expired!',
                    'type' => 'error'
                ]);
                return redirect(route('web.home'));
            }
        }
        else{
            Session::flash('swal', [
                'title' => '<button type="button" id="custom-close-button"></button><p class="swal-register-title">Error</p>',
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

    public function doResetPassword(UserResetPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $user = $this->userRepository->find($data['id']);
            
            if (!$user) {
                throw new \Exception('User Not Found!');
            }
            $this->userRepository->updateUser($request->all(), $data['id']);

            //after reset delete token record
            $tokenRecord = $this->passwordResetTokensRepository->findRecordByToken($data['token']);
            $this->passwordResetTokensRepository->delete($tokenRecord->id);
            
            DB::commit();
            return $this->response();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
