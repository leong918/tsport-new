<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Temporary debug route - remove after fixing
Route::get('/debug-auth', function() {
    $output = [];
    
    // Check authentication
    $output['is_authenticated'] = Auth::guard('user')->check();
    $output['default_guard'] = config('auth.defaults.guard');
    
    if (Auth::guard('user')->check()) {
        $user = Auth::guard('user')->user();
        $output['user_id'] = $user->id;
        $output['user_status'] = $user->status;
        $output['active_status_constant'] = User::STATUS['ACTIVE'];
        $output['is_active'] = $user->status === User::STATUS['ACTIVE'];
        $output['user_data'] = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'status' => $user->status,
            'created_at' => $user->created_at
        ];
    }
    
    // Session data
    $output['session_id'] = session()->getId();
    $output['has_session_auth'] = session()->has('login_user_' . sha1('user'));
    
    return response()->json($output, 200, [], JSON_PRETTY_PRINT);
});
