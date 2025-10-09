<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Form\Web\WebLoginRequest;
use App\Http\Requests\Form\Web\WebRegisterRequest;
use App\Http\Requests\Form\Web\WebResetPasswordRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return $this->view('auth.login');
    }

    public function register()
    {
        return $this->view('auth.register');
    }

    public function profile()
    {
        return $this->view('auth.profile');
    }

    public function editProfile()
    {
        return $this->view('profile_edit_modal');
    }

    public function personalInfo()
    {
        return $this->view('auth.personal-info');
    }

    public function doRegister(WebRegisterRequest $request)
    {
        try {
            $user = $this->userRepository->createAccount($request->validated());

            // Automatically log in the user after successful registration
            Auth::guard('user')->login($user);

            // If it's an AJAX request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Account created successfully!',
                    'user'    => $user,
                    'redirect' => route('web.home')
                ]);
            }

            // For regular form submissions, redirect with success message
            return redirect()->route('web.home')->with('success', 'Account created successfully! Welcome!');
        } catch (\Exception $e) {
            // If it's an AJAX request, return JSON error
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Something went wrong. Please try again later.',
                    'errors' => ['general' => [$e->getMessage()]]
                ], 500);
            }

            // For regular form submissions, redirect back with error
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function doLogin(WebLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('user')->attempt($credentials, false)) {
            // Check if user is active
            $user = Auth::guard('user')->user();
            if ($user->status != User::STATUS['ACTIVE']) {
                Auth::guard('user')->logout();
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Your account is inactive. Please contact support.',
                        'errors' => ['general' => ['Account is inactive']]
                    ], 403);
                }
                
                return redirect()->back()->withInput()->with('error', 'Your account is inactive. Please contact support.');
            }

            // Authentication passed and user is active
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Login successful!',
                    'user' => $user,
                    'redirect' => route('web.home')
                ]);
            }

            return redirect()->intended(route('web.home'))->with('success', 'Welcome back!');
        }

        // Authentication failed
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Invalid credentials',
                'errors' => ['general' => ['Invalid username or password']]
            ], 401);
        }

        return redirect()->back()->withInput()->with('error', 'Invalid username or password');
    }

    public function resetPassword()
    {
        return $this->view('auth.reset-password');
    }

    public function doResetPassword(WebResetPasswordRequest $request)
    {
        try {
            /** @var User $user */
            $user = Auth::guard('user')->user();
            
            if (!$user) {
                // If user is not authenticated, redirect to login with a message
                return redirect()->route('web.login')->with('error', '请先登录以重置密码');
            }

            // For authenticated users, verify current password
            if ($request->has('current_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', '当前密码不正确');
                }
            }

            // Update password with the new password
            $user->password = Hash::make($request->password);
            $user->save();

            // If it's an AJAX request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => '密码重置成功！',
                    'redirect' => route('web.profile')
                ]);
            }

            return redirect()->route('web.profile')->with('success', '密码重置成功！');
        } catch (\Exception $e) {
            // If it's an AJAX request, return JSON error
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => '密码重置失败：' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', '密码重置失败：' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        
        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Successfully logged out',
                'redirect' => route('web.home')
            ]);
        }
        
        return redirect(route('web.home'))->with('success', 'Successfully logged out');
    }

    public function updateProfile(Request $request)
    {
        try {
            /** @var User $user */
            $user = Auth::guard('user')->user();
            
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:user,username,' . $user->id,
                'email' => 'required|email|max:255|unique:user,email,' . $user->id,
                'phone_no' => 'required|string|max:20',
                'phone_region' => 'nullable|string|max:10',
                'birthdate' => 'nullable|date',
            ]);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'phone_region' => $request->phone_region,
                'birthdate' => $request->birthdate,
            ]);

            // If it's an AJAX request, return JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => '个人资料更新成功！',
                    'redirect' => route('web.profile')
                ]);
            }

            return redirect()->back()->with('success', '个人资料更新成功！');
        } catch (\Exception $e) {
            // If it's an AJAX request, return JSON error
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => '更新失败：' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', '更新失败：' . $e->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
                'new_password_confirmation' => 'required',
            ]);

            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', '当前密码不正确');
            }

            // Update password
            $user->password = $request->new_password;
            $user->save();

            return redirect()->back()->with('success', '密码更新成功！');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '密码更新失败：' . $e->getMessage());
        }
    }

    public function redeemCode(Request $request)
    {
        try {
            $request->validate([
                'redeem_code' => 'required|string|max:50',
            ]);

            // TODO: Implement redeem code logic
            // This could involve checking against a database table of valid codes
            // and applying rewards/benefits to the user account
            
            $redeemCode = $request->redeem_code;
            
            // Placeholder logic - replace with actual implementation
            if ($redeemCode === 'WELCOME2024') {
                // Apply some benefit to user
                return redirect()->back()->with('success', '兑换码使用成功！已获得奖励。');
            } else {
                return redirect()->back()->with('error', '无效的兑换码');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '兑换失败：' . $e->getMessage());
        }
    }
}
