<?php

namespace App\Providers;

use App\Repositories\AreaRepository;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\AuthRepository;
use App\Repositories\CondominiumRepository;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CondominiumRepositoryInterface::class, CondominiumRepository::class);
        $this->app->bind(AreaRepositoryInterface::class, AreaRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
