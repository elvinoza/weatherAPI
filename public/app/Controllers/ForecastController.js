(function() {

    'use strict';

    angular
        .module('app')
        .controller('ForecastController', ForecastController);

    function ForecastController($scope, $state, $stateParams, ApiService) {

        $scope.forecasts = [];
        $scope.date = moment().format('YYYY-MM-DD') + ' ' + moment().format('YYYY-MM-DD');

        $scope.getForecasts = function() {

            var dates = $scope.date.split(/[ ,]+/);

            ApiService.getForecasts($stateParams.id, dates[0], dates[1]).success(function(data) {
                $scope.forecasts = data;
            }).error(function(error) {
                //TODO: handle error's
            });
        };

        $scope.stationWeathers = function(stationId) {
            $state.go('stationWeathers', { id: stationId })
        };

        $scope.stationChart = function(stationId){
            $state.go('charts', { id: stationId })
        };

        $scope.getForecasts();
    };
})();