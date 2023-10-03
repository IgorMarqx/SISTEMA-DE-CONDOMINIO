<?php

namespace App\Providers;

use App\Models\Apartment;
use App\Models\Condominium;
use App\Repositories\apartment\ApartmentRepository;
use App\Repositories\apartment\ApartmentRepositoryInterface;
use App\Repositories\area\AreaRepository;
use App\Repositories\area\AreaRepositoryInterface;
use App\Repositories\auth\AuthRepository;
use App\Repositories\auth\AuthRepositoryInterface;
use App\Repositories\condominium\CondominiumRepository;
use App\Repositories\condominium\CondominiumRepositoryInterface;
use App\Repositories\garage\GarageRepository;
use App\Repositories\garage\GarageRepositoryInterface;
use App\Repositories\user\UserRepository;
use App\Repositories\user\UserRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(ApartmentRepositoryInterface::class, ApartmentRepository::class);
        $this->app->singleton(GarageRepositoryInterface::class, GarageRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Validator::extend('condominium_exists', function ($attribute, $value) {
            return Condominium::where('id', $value)->exists();
        });

        Validator::extend('apartment_exists', function ($attribute, $value) {
            return Apartment::where('id', $value)->exists();
        });
    }
}
