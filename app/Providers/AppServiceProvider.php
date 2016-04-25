<?php

namespace App\Providers;

use App\Repositories\StationRepository;
use App\Services\StationService;
use App\Models\Station;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        $this->app->bind('App\Services\StationService', function($app){
//            return new StationService($app->make('App\Repositories\StationRepository'));
//        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind('App\Repositories\IStationRepository', 'App\Repositories\StationRepository');
//        $this->app->bind('App\Services\StationService', function($app){
//            return new StationService($app->make('App\Repositories\StationRepository'));
//        });

        //$this->app->bind('App\Repositories\IStationRepository', 'App\Repositories\StationRepository');
    }
}
