<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectAuthenticatedUser
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return redirect(route('web.home'));
        }
        return $next($request);
    }
}
