<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // Dao Registration
         $this->app->bind('App\Contracts\Dao\UserDaoInterface', 'App\Dao\UserDao');

         // Business logic registration
         $this->app->bind('App\Contracts\Services\UserServiceInterface', 'App\Services\UserService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
