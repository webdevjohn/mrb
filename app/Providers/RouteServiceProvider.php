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
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        // $this->routes(function () {
        //     Route::prefix('api')
        //         ->middleware('api')
        //         ->namespace($this->namespace)
        //         ->group(base_path('routes/api.php'));

        //     Route::middleware('web')
        //         ->namespace($this->namespace)
        //         ->group(base_path('routes/web.php'));
        // });

        $this->mapWebRoutes();
        
        $this->mapWebBasketRoutes();

        // $this->mapWebCMSRoutes();
        
        // $this->mapWebRegisteredUsersRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapWebBasketRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace  . '\basket')
             ->group(base_path('routes/webBasket.php'));
    }

     /**
     * Define the "CMS" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebCMSRoutes()
    {
        Route::prefix('cms')
             ->as('cms.')
             ->middleware(['web', 'auth', 'admin'])   
             ->namespace($this->namespace . '\cms')                      
             ->group(base_path('routes/webCMS.php'));
    }

    /**
     * Define the "Registered Users" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRegisteredUsersRoutes()
    {
        Route::middleware(['web', 'auth'])   
             ->namespace($this->namespace . '\RegisteredUsers')                      
             ->group(base_path('routes/webRegisteredUsers.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
