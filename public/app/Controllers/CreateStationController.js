(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateStationController', CreateStationController);

    function CreateStationController($rootScope, $scope, $state, ApiService) {
        var vm = this;
        $scope.station = {};
        $scope.station.lat = null;
        $scope.station.lng = null;
        $scope.error = {};

        vm.create = function(){
            $scope.station.user_id = $rootScope.currentUser.id;
            ApiService.createStation($scope.station).success(function(data) {
                $scope.station = data;
                $rootScope.displayToast('Station created!');
                $state.go('userStations', { id: data.user_id });
            }).error(function(error) {
                $scope.error = error;
            });
        };

        vm.changeMapMarker = function(event)
        {
            $scope.station.lat = event.latLng.lat();
            $scope.station.lng = event.latLng.lng();
        };
    }
})();

