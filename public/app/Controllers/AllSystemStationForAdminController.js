(function() {

    'use strict';

    angular
        .module('app')
        .controller('AllSystemStationsForAdminController', AllSystemStationsForAdminController);

    function AllSystemStationsForAdminController($scope, $state, ApiService) {

        $scope.query = {
            order: 'name',
            limit: 10,
            page: 1
        };

        $scope.stations = [];

        $scope.getAllStations = function() {
            ApiService.getAllStations().success(function(data) {
                $scope.stations = data;
            }).error(function(error) {

            });
        };

        $scope.editStation = function(id){
            $state.go('editStation', { id: id })
        };

        $scope.create = function(){
            $state.go('createStation');
        };

        $scope.chart = function(id){
            $state.go('charts', { id: id })
        };

        $scope.weathers = function(id){
            $state.go('stationWeathers', { id: id })
        };

        $scope.refreshList = function() {
            $scope.getAllStations();
        };

        $scope.getAllStations();
    }
})();