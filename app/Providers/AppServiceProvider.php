<?php

namespace App\Providers;

use App\Models\Condominium;
use App\Repositories\AreaRepository;
use App\Repositories\Interfaces\AreaRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\AuthRepository;
use App\Repositories\CondominiumRepository;
use App\Repositories\Interfaces\CondominiumRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->singleton(CondominiumRepositoryInterface::class, CondominiumRepository::class);
        $this->app->singleton(AreaRepositoryInterface::class, AreaRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Validator::extend('condominium_exists', function($attribute, $value){
            return Condominium::where('id', $value)->exists();
        });
    }
}
