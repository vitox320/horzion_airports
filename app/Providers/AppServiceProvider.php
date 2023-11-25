<?php

namespace App\Providers;

use App\Repositories\Eloquent\AirportRepository;
use App\Repositories\Eloquent\CityRepository;
use App\Repositories\Eloquent\FlightClassRepository;
use App\Repositories\Eloquent\FlightClassTypeRepository;
use App\Repositories\Eloquent\FlightRepository;
use App\Repositories\Eloquent\PassengerRepository;
use App\Repositories\Eloquent\SeatRepository;
use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interface\AirportRepositoryInterface;
use App\Repositories\Interface\CityRepositoryInterface;
use App\Repositories\Interface\FlightClassRepositoryInterface;
use App\Repositories\Interface\FlightClassTypeRepositoryInterface;
use App\Repositories\Interface\FlightRepositoryInterface;
use App\Repositories\Interface\PassengerRepositoryInterface;
use App\Repositories\Interface\SeatRepositoryInterface;
use App\Repositories\Interface\TicketRepositoryInterface;
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
        $this->app->bind(SeatRepositoryInterface::class, SeatRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(PassengerRepositoryInterface::class, PassengerRepository::class);
        $this->app->bind(FlightClassTypeRepositoryInterface::class, FlightClassTypeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
