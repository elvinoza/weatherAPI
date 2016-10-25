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
        Route::post('user/create', 'UserController@createUser');
        Route::post('user/{id}', 'UserController@updateUser');
        Route::post('password', 'UserController@changeUserPassword');
        Route::get('user/stations/{id}', 'UserController@getUserStations');
        Route::get('user/StationsLastData/{id}', 'UserController@getUserStationsLastData');
        Route::get('station/{id}', 'StationController@getStation');
        Route::post('station', 'StationController@updateStation');
        Route::post('station/create', 'StationController@createStation');
        Route::get('station/delete/{id}', 'StationController@deleteStation');
        Route::get('station/weathers/{id}/{count?}', 'StationController@getWeathers');
        Route::get('weather/{id}', 'WeatherController@getWeather');
        Route::get('weathers', 'WeatherController@getWeathers');

        //Notifications
        Route::get('user/fiveUserNotifications/{id}', 'UserController@getFirstFiveUserNotifications');
        Route::get('user/allUserNotifications/{id}', 'UserController@allUserNotifications');
        Route::get('notification/decrease/{userId}', 'NotifyController@decreaseUserNotificationsCount'); // decrease user notification count
        Route::get('notification/setAsRead/{id}', 'NotifyController@setAsRead'); // decrease user notification count

        //Follow's
        Route::post('follow/change', 'FollowModelController@changeUserFollowModelStatus');
        Route::post('follow/check', 'FollowModelController@checkUserFollowModel');
        Route::get('follow/stations/{userId}/{modelId}', 'FollowModelController@getUserModelFollows');

        //Diseases
        Route::post('disease/create', 'DiseaseModelController@create');
        Route::post('disease/update', 'DiseaseModelController@update');
        Route::post('disease/createConditions', 'DiseaseModelController@createConditions');
        Route::get('disease/{id}', 'DiseaseModelController@getModel');
        Route::get('user/models/{id}', 'UserController@getUserDiseaseModels');
        Route::get('disease/models', 'DiseaseModelController@getAllModels');
        Route::get('clsf/params', 'ClsfController@getAllParameters');

        //testing url's
        Route::get('disease/tryNot/{stationId}', 'DiseaseModelController@tryNot'); //test note
    });

});

Route::group(['prefix' => 'stationAPI'], function()
{
    Route::post('create', 'ApiStationController@createWeather');
    Route::get('station/updateTime/{id}', 'ApiStationController@getStationUpdateTime');
});
