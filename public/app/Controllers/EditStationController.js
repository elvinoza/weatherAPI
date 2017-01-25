(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditStationController', EditStationController);

    function EditStationController($state, $scope, $rootScope, $stateParams, ApiService) {

        var vm = this;
        vm.googleMapsUrl = $rootScope.googleMapsUrl;

        $scope.error = {};

        vm.getStation = function(id){
            ApiService.getStation(id).success(function(data) {
                $scope.station = data;
            }).error(function(error) {
                $rootScope.displayToast('Ups.. Try again!');
            });
        };

        vm.update = function(){
            ApiService.updateStation($scope.station).success(function(data) {
                $scope.station = data;
                $rootScope.displayToast('Station updated!');
            }).error(function(error) {
                $scope.error = error;
            });
        };

        vm.delete = function(id){
            ApiService.deleteStation(id).success(function(data) {
                $state.go('userStations', { id: $rootScope.currentUser.id});
                $rootScope.displayToast('Station deleted!');
            }).error(function(error) {
                $rootScope.displayToast('Ups.. Try again!');
            });
        };

        vm.changeMapMarker = function(event)
        {
            $scope.station.lat = event.latLng.lat();
            $scope.station.lng = event.latLng.lng();
        };

        vm.settings = function()
        {
            $state.go('stationNotificationSettings', { id: $stateParams.id });
        };

        vm.getStation($stateParams.id);
    }
})();