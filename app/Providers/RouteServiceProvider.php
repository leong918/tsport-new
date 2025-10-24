<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Authenticated API routes (with Sanctum)
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Viewer tracking routes - public, no authentication
            Route::prefix('api')
                ->middleware(['throttle:api', \Illuminate\Routing\Middleware\SubstituteBindings::class])
                ->group(base_path('routes/api/viewer-tracking.php'));

            // Public webhook routes - for external services (SRS, Python uploader)
            Route::prefix('api')
                ->middleware(['throttle:api', \Illuminate\Routing\Middleware\SubstituteBindings::class])
                ->group(base_path('routes/api/webhooks.php'));

            // Streaming API routes - public, no authentication
            Route::prefix('api')
                ->middleware(['throttle:api', \Illuminate\Routing\Middleware\SubstituteBindings::class])
                ->group(base_path('routes/api/streams.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
