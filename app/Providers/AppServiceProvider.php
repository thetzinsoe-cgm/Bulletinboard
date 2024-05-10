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

         // Dao Registration
         $this->app->bind('App\Contracts\Dao\PostDaoInterface', 'App\Dao\PostDao');

         // Business logic registration
         $this->app->bind('App\Contracts\Services\PostServiceInterface', 'App\Services\PostService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
