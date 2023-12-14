<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    UserRepositoryInterface,
    AuthRepositoryInterface,
    EnglishRepositoryInterface,
    CardRepositoryInterface
};

use App\Repositories\{
    UserRepository,
    AuthRepository,
    EnglishRepository,
    CardRepository
};

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
            
          
        );
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
        $this->app->bind(
            EnglishRepositoryInterface::class,
            EnglishRepository::class
        );
        $this->app->bind(
            CardRepositoryInterface::class,
            CardRepository::class
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
