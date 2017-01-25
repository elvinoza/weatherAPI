(function() {

    'use strict';

    angular
        .module('app')
        .controller('ForecastController', ForecastController);

    function ForecastController($rootScope, $scope, $state, $stateParams, ApiService) {

        $scope.forecasts = [];
        $scope.date = moment().format('YYYY-MM-DD') + ' ' + moment().format('YYYY-MM-DD');

        $scope.getForecasts = function() {

            var dates = $scope.date.split(/[ ,]+/);

            ApiService.getForecasts($stateParams.id, dates[0], dates[1]).success(function(data) {
                $scope.forecasts = data;
            }).error(function(error) {
                $rootScope.displayToast('Ups.. Try again!');
            });
        };

        $scope.stationWeathers = function(stationId) {
            $state.go('stationWeathers', { id: stationId })
        };

        $scope.stationChart = function(stationId){
            $state.go('charts', { id: stationId })
        };

        $scope.confirm = function(index) {
            var id = $scope.forecasts[index].id;

            ApiService.confirmForecast(id).success(function(data) {
                $scope.forecasts[index].favorite = data.favorite;
                $scope.forecasts[index].is_confirmed = data.is_confirmed;
                $rootScope.displayToast('Thanks for your response!');
                //parodyt ta popupa virsuje
            }).error(function(error) {
                $rootScope.displayToast('Ups.. Try again!');
            });
        };

        $scope.getForecasts();
    };
})();