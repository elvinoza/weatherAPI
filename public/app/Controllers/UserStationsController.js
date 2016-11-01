(function() {

    'use strict';

    angular
        .module('app')
        .controller('UserStationsController', UserStationsController);

    function UserStationsController($scope, $state, $stateParams, ApiService) {

        $scope.stations = [];

        $scope.getUserStations = function(id){
            ApiService.getUserStations(id).success(function(data) {
                $scope.stations = data;
            }).error(function(error) {

            });
        };

        $scope.create = function(){
            $state.go('createStation');
        };

        $scope.editStation = function(id){
            $state.go('editStation', { id: id })
        };

        $scope.chart = function(id){
            $state.go('charts', { id: id })
        };

        $scope.weathers = function(id){
            $state.go('stationWeathers', { id: id })
        };

        $scope.refreshList = function() {
            $scope.getUserStations($stateParams.id);
        };

        $scope.getUserStations($stateParams.id);
    }
})();
