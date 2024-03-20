<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Form\User\UserLoginRequest;
use App\Http\Requests\Form\User\UserRegisterRequest;
use App\Http\Requests\Form\User\UserForgotPasswordRequest;
use App\Http\Requests\Form\User\UserResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Repositories\PasswordResetTokensRepository;
use App\Repositories\LevelRepository;
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
    protected LevelRepository $levelRepository;

    public function __construct(UserRepository $userRepository, PasswordResetTokensRepository $passwordResetTokensRepository, LevelRepository $levelRepository)
    {
        $this->userRepository = $userRepository;
        $this->passwordResetTokensRepository = $passwordResetTokensRepository;
        $this->levelRepository = $levelRepository;
    }

    public function login()
    {
        return $this->view('auth.login');
    }

    public function doLogin(UserLoginRequest $request)
    {
        $credentials = $request->only('phone_no', 'password');
        if (Auth::attempt($credentials + ['status' => User::STATUS['ACTIVE']], true)) {

            if (function_exists('updateUserOwnerCart')) {
                updateUserOwnerCart(auth()->user()->id);
            }
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
            $data['level_id'] = $this->levelRepository->getLowestLeveling()->id;

            if ($data['referral_email'] && $data['referral_phone_no']) {
                $user = $this->userRepository->getUserByEmail($data['referral_email'], $data['referral_phone_no']);
                if (!$user || $user->level_id <= 1) {
                    throw new \Exception('Referral User Not Found or Refferal User Level Not Compatible!');
                }
            }

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
        auth()->logout();
        return redirect(route('web.login'))->with('success', 'Successfully logged out');
    }

    public function resetPassword()
    {
        $token = request('token');
        if (!$token) {
            return redirect(route('web.home'))->with('swal_error', "Password Reset Token Expired!");
        }

        $tokenRecord = $this->passwordResetTokensRepository->findRecordByToken($token);

        if ($tokenRecord) {
            $user = $this->userRepository->getUserByEmail($tokenRecord->email);

            if ($user && !$this->tokenExpired($tokenRecord->created_at)) {
                $id = $user->id;
                return $this->view('auth.reset_password', compact('id'));
            } else {
                if ($tokenRecord) {
                    $tokenRecord->delete();
                }
                return redirect(route('web.home'))->with("swal_error", "Password Reset Token Expired!");
            }
        }

        return redirect(route('web.home'))->with("swal_error", "Password Reset Token Expired!");
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
