<?php

namespace App\Providers;

use App\Repositories\StationRepository;
use App\Services\StationService;
use App\Models\Station;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\EventDispatcher\Tests\Service;

class StationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\StationService', function($app){
            return new StationService($app['App\Models\Station']);
        });
    }
}
