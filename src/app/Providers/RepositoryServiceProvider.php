<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->bind(
        \App\Repositories\Todo\TodoRepositoryInterface::class,
        \App\Repositories\Todo\TodoRepository::class
      );
      $this->app->bind(
        \App\Repositories\Category\CategoryRepositoryInterface::class,
        \App\Repositories\Category\CategoryRepository::class
      );
      $this->app->bind(
        \App\Repositories\User\UserRepositoryInterface::class,
        \App\Repositories\User\UserRepository::class
      );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
