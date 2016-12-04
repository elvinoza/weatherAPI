(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditStationController', EditStationController);

    function EditStationController($state, $scope, $rootScope, $stateParams, ApiService, flash) {

        var vm = this;

        //vm.location = {
        //    lat: 54.8985049,
        //    lng: 23.9578067
        //};

        vm.error;

        vm.getStation = function(id){
            ApiService.getStation(id).success(function(data) {
                console.log(data);
                $scope.station = data;
            }).error(function(error) {
                vm.error = error;
            });
        };

        vm.update = function(){
            console.log($scope.station);
            ApiService.updateStation($scope.station).success(function(data) {

                $scope.station = data;
                flash.success = "Station successful updated"
            }).error(function(error) {
                flash.error = error;
            });
        };

        vm.delete = function(id){
            ApiService.deleteStation(id).success(function(data) {
                $state.go('userStations', { id: $rootScope.currentUser.id});
                //flash.success = "Station successful updated"
            }).error(function(error) {
                //flash.error = error;
            });
        };

        vm.getStation($stateParams.id);
    };
})();