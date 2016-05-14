<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::group(['prefix' => 'api'], function()
    {
        Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
        Route::post('authenticate', 'AuthenticateController@authenticate');
        Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
        Route::get('user/{id}', 'UserController@getUser');
        Route::post('createuser', 'UserController@createUser');
        Route::post('user/{id}', 'UserController@updateUser');
        Route::post('password', 'UserController@changeUserPassword');
        Route::get('user/stations/{id}', 'UserController@getUserStations');
        Route::get('user/StationsLastData/{id}', 'UserController@getUserStationsLastData');
        Route::get('station/{id}', 'StationController@getStation');
        Route::post('station', 'StationController@updateStation');
        Route::post('station/create', 'StationController@createStation');
        Route::get('station/delete/{id}', 'StationController@deleteStation');
        Route::get('station/weathers/{id}', 'StationController@getWeathers');
        Route::get('weather/{id}', 'WeatherController@getWeather');
    });

});

Route::group(['prefix' => 'stationAPI'], function()
{
    Route::post('create', 'ApiStationController@createWeather');
});
