(function() {

    'use strict';

    angular
        .module('app')
        .service('ApiService', ApiService);

    function ApiService($http) {

        var baseURL = '/api/';

        this.getUser = function(id){
            return $http.get(baseURL + 'user/' + id);
        };

        this.updateUser = function(user){
            return $http.post(baseURL + 'user/' + user.id, user, { headers: { 'Accept': 'Application/json' }});
        };

        this.getUserStations = function(id){
            return $http.get(baseURL + 'user/stations/' + id);
        };

        this.getStation = function(id){
            return $http.get(baseURL + 'station/' + id);
        };

        this.updateStation = function(station){
            return $http.post(baseURL + 'station/', station, { headers: { 'Accept': 'Application/json' }});
        };

        this.createStation = function(station){
            return $http.post(baseURL + 'station/create', station, { headers: { 'Accept': 'Application/json' }});
        };

        this.getStationWeathers = function(id){
            return $http.get(baseURL + 'station/weathers/' + id);
        };

        this.register = function(user){
            return $http.post(baseURL + 'createuser', user, { headers: { 'Accept': 'Application/json' }});
        };

        this.getLatestWeathers = function(id){
            return $http.get(baseURL + 'user/StationsLastData/' + id);
        };

        this.deleteStation = function(id){
            return $http.get(baseURL + 'station/delete/' + id);
        };

        this.getStationDataForChart = function(stationId, startDate, endDate){
            return $http.get(baseURL + 'weathers?station_id=' + stationId + '&startDate=' + startDate + '&endDate=' + endDate);
        };
    }
})();