<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\DataForForecast;
use App\Models\Forecast;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DOMDocument;
use App\Enums\ClsfWeatherParameters;

interface IForecastService
{
    function calculateForecast($stationId);
    function getAllStationForecasts($stationId);
    function getUserStationsForecast($id);
    function getForecast($id);
    function getForecasts($startDate, $endDate);

    //----
    function getDataFromGisMeteo();
    function updateDataFromGisMeteo();
}

class ForecastService implements IForecastService
{
    protected $gismeteoUrl = 'https://www.gismeteo.ru/diary/4202/';
    protected $slidingWindowSize;
    protected $slidingWindowsCount;
    protected $todayDate;
    protected $user;
    protected $forecast;
    protected $dataForForecast;

    public function __construct(User $user, Forecast $forecast, DataForForecast $dataForForecast)
    {
        $this->slidingWindowSize = 7; //7 days
        $this->slidingWindowsCount = 8;
        $this->user = $user;
        $this->forecast = $forecast;
        $this->dataForForecast = $dataForForecast;
        $this->todayDate = date('Y-m-d');
    }

    public function calculateForecast($stationId)
    {
        $cdMatrix = $this->getDataForForecast($stationId, date('Y-m-d', strtotime('-1 week')), $this->todayDate); //CD matrix
        $pdMatrix = $this->getDataForForecast($stationId, date('Y-m-d', strtotime("-1 year -2 week")), date('Y-m-d', strtotime("-1 year"))); //PD matrix

        $slidingWindows = $this->createSlidingWindows($pdMatrix, $this->slidingWindowsCount, $this->slidingWindowSize); //7 - window size
        $correspondingMatrix = $this->getCorrespondingMatrix($cdMatrix, $slidingWindows, $this->slidingWindowSize);
        $variations = $this->predicatedVariations($cdMatrix, $pdMatrix, $correspondingMatrix);
        $forecast = $this->insertForecast($stationId, $variations);

        return $forecast;
    }

    public function getAllStationForecasts($stationId)
    {
        return $this->forecast->where('station_id', '=', $stationId)->get();
    }

    public function getUserStationsForecast($id)
    {
         $forecasts = DB::table('users')
                        ->leftJoin('stations', 'users.id', '=', 'stations.user_id')
                        ->leftJoin('forecast', 'stations.id', '=', 'forecast.station_id')
                        ->where('users.id', '=', $id)
                        ->where('forecast.forecast_date', '>=', Carbon::now()->toDateString())
                        ->select('stations.id', 'stations.name', 'forecast.*')
                        ->get();

        return $forecasts;
    }

    public function getForecast($id)
    {
        return $this->forecast->find($id);
    }

    public function getForecasts($startDate, $endDate)
    {
        if ($startDate == $endDate && $startDate == $this->todayDate)
        {
            return $this->forecast->where('forecast_date', '=', $this->todayDate)->with('station', 'imageUlr')->get();
        }

        return $this->forecast->where('forecast_date', '>=', $startDate)->where('forecast_date', '<=', $endDate)->with('station')->get();
    }

    public function getDataFromGisMeteo()
    {
        $this->truncateTable();
        $years = ['2015', '2016', '2017'];
        $months = ['01','02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        foreach ($years as $year)
        {
            foreach ($months as $month)
            {
                $data = $this->getTableData($year, $month);

                if ($data != null) {

                    foreach ($data->getElementsByTagName('tr') as $tr) {
                        $tds = $tr->getElementsByTagName('td'); // get the columns in this row

                        if ($tds->length != 0) {
                            if (strlen($tds->item(1)->nodeValue) != 0 && strlen($tds->item(6)->nodeValue) != 0) {
                                $day = strlen($tds->item(0)->nodeValue) == 1 ? '0' . $tds->item(0)->nodeValue : $tds->item(0)->nodeValue;
                                $date = $year . '-' . $month . '-' . $day;
                                //Day time
                                $dayTemp = $tds->item(1)->nodeValue; // day temp
                                $dayPressure = $tds->item(2)->nodeValue; // day pressure
                                $dayPhenomena = $this->getPhenomena($tds->item(4)); // phenomena
                                $wind = Helper::ParseWindParameters(utf8_decode($tds->item(5)->getElementsByTagName('span')->item(0)->textContent));
                                $dayWindDir = $wind['dir'];
                                $dayWindSpeed = $wind['speed'];

                                //Night time
                                $nightTemp = $tds->item(6)->nodeValue; // day temp
                                $nightPressure = $tds->item(7)->nodeValue; // day pressure
                                //$nightPhenomena = $this->getPhenomena($tds->item(9)); // phenomena
                                $wind = Helper::ParseWindParameters(utf8_decode($tds->item(10)->getElementsByTagName('span')->item(0)->textContent));
                                //$nightWindDir = $wind['dir'];
                                $nightWindSpeed = $wind['speed'];

                                $this->createDataForForecast($dayTemp, $nightTemp, $dayPressure, $nightPressure, $dayWindSpeed, $nightWindSpeed, $dayWindDir, $dayPhenomena, $date);
                            }
                        }
                    }
                }
                sleep(3); //to prevent blockage
            }
        }
    }

    public function updateDataFromGisMeteo()
    {
        // TODO: Implement updateDataFromGisMeteo() method.
    }

    private function predicatedVariations($cdMatrix, $pdMatrix, $correspondingMatrix)
    {
        $variations = [
            'temperature' => $this->calculatePredictedVariationV(ClsfWeatherParameters::Temperature, $cdMatrix, $pdMatrix, $correspondingMatrix),
            'pressure' => $this->calculatePredictedVariationV(ClsfWeatherParameters::Pressure, $cdMatrix, $pdMatrix, $correspondingMatrix),
            'wind_speed' => $this->calculatePredictedVariationV(ClsfWeatherParameters::WindSpeed, $cdMatrix, $pdMatrix, $correspondingMatrix),
            'wind_direction' => $this->calculatePredictedVariationV(ClsfWeatherParameters::WindSpeed, $cdMatrix, $pdMatrix, $correspondingMatrix),
            'phenomena' => $this->calculatePredictedVariationV(ClsfWeatherParameters::Rain, $cdMatrix, $pdMatrix, $correspondingMatrix)
        ];

        return $variations;
    }

    private function calculatePredictedVariationV($parameter, $cdMatrix, $pdMatrix, $correspondingMatrix)
    {
        $mean1 = $this->calculateMean($this->calculateVariationVector($cdMatrix, $correspondingMatrix, $parameter));
        $mean2 = $this->calculateMean($this->calculateVariationVector($pdMatrix, $correspondingMatrix, $parameter));

        return ($mean1 + $mean2) / 2;
    }

    private function calculateMean($variationVector)
    {
        $sum = 0;
        $i = 0;
        foreach ($variationVector as $val)
        {
            $sum = $sum + $val;
            $i++;
        }

        return $sum/$i;
    }

    private function calculateVariationVector($matrix, $correspondingMatrix, $parameter) //matrix cd/pd
    {
        //5
        //temperature
        $variationVector = [];
        switch ($parameter) {
            case ClsfWeatherParameters::Temperature:

                for ($i = 0; $i < $this->slidingWindowSize; $i++)
                {
                    $variationVector[$i] = $matrix[$i]->temperature - $correspondingMatrix[$i]->temperature;
                }
                break;
            case ClsfWeatherParameters::Pressure:

                for ($i = 0; $i < $this->slidingWindowSize; $i++)
                {
                    $variationVector[$i] = $matrix[$i]->pressure - $correspondingMatrix[$i]->pressure;
                }
                break;
            case ClsfWeatherParameters::WindSpeed:

                for ($i = 0; $i < $this->slidingWindowSize; $i++)
                {
                    $variationVector[$i] = $matrix[$i]->wind_speed - $correspondingMatrix[$i]->wind_speed;
                }
                break;
            case ClsfWeatherParameters::WindDirection:
                for ($i = 0; $i < $this->slidingWindowSize; $i++)
                {
                    $variationVector[$i] = $matrix[$i]->wind_speed - $correspondingMatrix[$i]->wind_speed;
                }
                break;
            default:
                for ($i = 0; $i < $this->slidingWindowSize; $i++)
                {
                    $variationVector[$i] = $matrix[$i]->phenomena - $correspondingMatrix[$i]->phenomena;
                }
                break;
        }

        return $variationVector;

    }

    private function getDataForForecast($stationId, $startDate, $endDate)
    {
        if ($endDate == $this->todayDate)
        {
            $data = $this->dataForForecast
                ->where('station_id', '=', $stationId)
                ->where('date', '>=', $startDate)
                ->get();
        }
        else
        {
            $data = $this->dataForForecast
                ->where('station_id', '=', $stationId)
                ->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->get();
        }

        return $data;
    }

    private function createSlidingWindows($pdMatrix, $windowsCount, $windowSize)
    {
        $slidingWindows = [];

        for($i = 0; $i < $windowsCount; $i++)
        {
            $slidingWindow = [];
            for($j = 0; $j < $windowSize; $j++)
            {
                array_push($slidingWindow, $pdMatrix[$i + $j]);
            }

            array_push($slidingWindows, $slidingWindow);
        }

        return $slidingWindows;
    }

    private function getCorrespondingMatrix($cdMatrix, $slidingWindows, $windowSize)
    {
        $i = 0;
        $correspondingMatrix = $slidingWindows[0];
        $euclideanDistances = $this->computeEuclideanDistances($cdMatrix, $slidingWindows, $windowSize);
        $min = $euclideanDistances[0];

        foreach ($euclideanDistances as $distance)
        {
            if ($distance < $min)
            {
                $min = $distance;
                $correspondingMatrix = $slidingWindows[$i];
            }

            $i++;
        }

        return $correspondingMatrix;
    }

    private function computeEuclideanDistances($cdMatrix, $slidingWindows, $windowSize)
    {
        $euclideanDistances = [];

        foreach($slidingWindows as $slidingWindow)
        {
            array_push($euclideanDistances, $this->euclideanDistance($cdMatrix, $slidingWindow, $windowSize));
        }

        return $euclideanDistances;
    }

    private function euclideanDistance($cdMatrix, $slidingWindow, $size)
    {
        $sum = 0;
        for($i = 0; $i < $size; $i++)
        {
            $sum = $sum +
                pow(($cdMatrix[$i]->temperature - $slidingWindow[$i]->temperature), 2) +
                pow(($cdMatrix[$i]->pressure - $slidingWindow[$i]->pressure), 2) +
                pow(($cdMatrix[$i]->wind_speed - $slidingWindow[$i]->wind_speed), 2) +
                pow(($cdMatrix[$i]->wind_direction - $slidingWindow[$i]->wind_direction), 2) +
                pow(($cdMatrix[$i]->phenomena - $slidingWindow[$i]->phenomena), 2);
        }
        $euclideanDistance = sqrt($sum);

        return $euclideanDistance;
    }

    private function getTableData($year, $month)
    {
        $dom = new DomDocument();
        $html = mb_convert_encoding($this->gismeteoUrl . $year .'/' . $month . '/', 'HTML-ENTITIES', "UTF-8");
        @$dom->loadHTMLFile($html);

        return $dom->getElementsByTagName("table")->item(0);
    }

    private function getPhenomena($td)
    {
        if ($td->getElementsByTagName('img')->length != 0)
        {
            return Helper::ParsePhenomena($td->getElementsByTagName('img')->item(0)->getAttribute('src'));
        }

        return null;
    }

    private function createDataForForecast($dayTemp, $nightTemp, $dayPressure, $nightPressure, $dayWindSpeed, $nightWindSpeed, $dayWindDir, $dayPhenomena, $date)
    {
        $weather = new DataForForecast();
        $weather->station_id = 1; //TODO: ?????
        $weather->temperature = ($dayTemp + $nightTemp) / 2;
        $weather->pressure = ($dayPressure + $nightPressure) / 2;
        $weather->wind_speed = ($dayWindSpeed + $nightWindSpeed);
        $weather->wind_direction = $dayWindDir;
        $weather->phenomena = $dayPhenomena;
        $weather->date = $date;
        $weather->save();
    }

    private function truncateTable()
    {
        $this->dataForForecast->truncate();
    }

    private function insertForecast($stationId, $variation)
    {
        $lastDay = date('Y-m-d', strtotime('-1 days'));
        $lastDayData = $this->dataForForecast->where('date', '=', $lastDay)->get()->first();

        $forecast = new Forecast();
        $forecast->temperature = 1;
        $forecast->station_id = $stationId;
        $forecast->temperature = $lastDayData->temperature + $variation['temperature'];
        $forecast->pressure = $lastDayData->pressure + $variation['pressure'];
        $forecast->wind_speed = $lastDayData->wind_speed + $variation['wind_speed'];
        $forecast->wind_direction = round($lastDayData->wind_direction + $variation['wind_direction']);
        $forecast->phenomena = round($lastDayData->phenomena + $variation['phenomena']);
        $forecast->forecast_date = $this->todayDate;
        $forecast->save();

        return $forecast;
    }
}