(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateStationController', CreateStationController);

    function CreateStationController($rootScope, $scope, $state, flash, ApiService) {
        var vm = this;
        $scope.station = {};
        $scope.station.lat = null;
        $scope.station.lng = null;

        vm.create = function(){
            console.log($scope.station);
            $scope.station.user_id = $rootScope.currentUser.id;
            ApiService.createStation($scope.station).success(function(data) {
                $scope.station = data;
                flash.success = "Station created";
                $state.go('userStations', { id: data.user_id });
            }).error(function(error) {
                flash.error = error;
            });
        };

        vm.changeMapMarker = function(event)
        {
            $scope.station.lat = event.latLng.lat();
            $scope.station.lng = event.latLng.lng();
            console.log($scope.station);
        };
    }
})();

