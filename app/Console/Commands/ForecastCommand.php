<?php

namespace App\Console\Commands;

use App\Services\ForecastService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ForecastCommand extends Command {

    protected $name = 'forecast:update';

    protected $description = 'Calculate forecast.';

    protected $forecast;

    public function __construct(ForecastService $forecastService)
    {
        parent::__construct();
        $this->forecast = $forecastService;
    }

    public function fire()
    {
        $this->forecast->getDataFromGisMeteo();
        $this->forecast->calculateForecast(1);
    }

    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED,
                'An example argument.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL,
                'An example option.', null],
        ];
    }

}