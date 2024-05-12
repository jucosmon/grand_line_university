<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckUserType;
use Closure;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->registerMiddleware(); // Register custom middleware

    }
    protected function registerMiddleware(): void
    {
        $this->app['router']->middleware('check.user.type', CheckUserType::class);
    }


}
