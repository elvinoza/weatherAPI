(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditStationController', EditStationController);

    function EditStationController($scope, $stateParams, ApiService, flash) {

        var vm = this;

        vm.error;

        vm.getStation = function(id){
            ApiService.getStation(id).success(function(data) {
                $scope.station = data;
            }).error(function(error) {
                vm.error = error;
            });
        };

        vm.update = function(){
            ApiService.updateStation($scope.station).success(function(data) {
                $scope.station = data;
                flash.success = "Station successful updated"
            }).error(function(error) {
                flash.error = error;
            });
        };

        vm.getStation($stateParams.id);
    }

})();