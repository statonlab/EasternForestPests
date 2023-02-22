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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $routes = [
            'admin',
            'login',
            'logout',
            'users',
            'users/([0-9]+)',
            'superuser',
            'chapters',
            'account',
            'downloads',
            'pests',
            'pests/:id',
            'data-upload',
            'data-upload/dart',
            'data-upload/dart/create',
            'data-upload/dart/([0-9]+)/edit',
            'data-upload/dart/([0-9]+)',
            'data-upload/isotope',
            'data-upload/isotope/create',
            'data-upload/isotope-confirmation/([0-9]+)',
            'data-upload/isotope/([0-9]+)/edit',
            'data-upload/isotope/([0-9]+)',
        ];
        $this->pattern('vue', implode('|', $routes));

        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
