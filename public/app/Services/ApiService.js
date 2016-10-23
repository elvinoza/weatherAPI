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

        this.signUp = function(user){
            return $http.post(baseURL + 'user/create', user, { headers: { 'Accept': 'Application/json' }});
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

        this.getUserFiveNotifications = function(id){
            return $http.get(baseURL + 'user/fiveUserNotifications/' + id);
        };

        this.getAllUserNotifications = function(id){
            return $http.get(baseURL + 'user/allUserNotifications/' + id);
        };

        //Clsf's

        this.getClsfParams = function(){
            return $http.get(baseURL + 'clsf/params');
        };

        //Disease

        this.getUserDiseaseModels = function(id){
            return $http.get(baseURL + 'user/models/' + id);
        };

        this.createDiseaseModel = function(diseaseModel){
            return $http.post(baseURL + 'disease/create', diseaseModel, { headers: { 'Accept': 'Application/json' }});
        };

        this.createDiseaseModelConditions = function(diseaseModelConditions){
            return $http.post(baseURL + 'disease/createConditions', diseaseModelConditions, { headers: { 'Accept': 'Application/json' }});
        };

        this.getDiseaseModelById = function(id){
            return $http.get(baseURL + 'disease/' + id);
        };

        this.updateDiseaseModel = function(diseaseModel){
            return $http.post(baseURL + 'disease/update', diseaseModel, { headers: { 'Accept': 'Application/json' }});
        };

        this.changeModelFollowStatus = function(followModel){
            return $http.post(baseURL + 'follow/change', followModel, { headers: { 'Accept': 'Application/json' }});
        };

        this.getModelUserStations = function($userId, $modelId){
            return $http.get(baseURL + 'follow/stations/' + $userId + '/' + $modelId);
        };
    }
})();