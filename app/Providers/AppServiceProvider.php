<?php

namespace App\Providers;

use App\Repositories\Eloquent\AirportRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\FlightClassRepository;
use App\Repositories\Eloquent\FlightRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interface\AirportRepositoryInterface;
use App\Repositories\Interface\CityRepositoryInterface;
use App\Repositories\Interface\FlightClassRepositoryInterface;
use App\Repositories\Interface\FlightRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(AirportRepositoryInterface::class, AirportRepository::class);
        $this->app->bind(FlightRepositoryInterface::class, FlightRepository::class);
        $this->app->bind(FlightClassRepositoryInterface::class, FlightClassRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
