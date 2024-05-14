<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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

         //Comment Dao Registration
         $this->app->bind('App\Contracts\Dao\CommentDaoInterface', 'App\Dao\CommentDao');

         // Business logic registration for Comment
         $this->app->bind('App\Contracts\Services\CommentServiceInterface', 'App\Services\CommentService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
