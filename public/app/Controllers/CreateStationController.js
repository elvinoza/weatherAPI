(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateStationController', CreateStationController);

    function CreateStationController($rootScope, $scope, $state, flash, ApiService) {
        var vm = this;
        $scope.station = null;

        vm.create = function(){
            $scope.station.user_id = $rootScope.currentUser.id;
            ApiService.createStation($scope.station).success(function(data) {
                $scope.station = data;
                flash.success = "Station created";
                $state.go('userStations', { id: data.user_id });
            }).error(function(error) {
                flash.error = error;
            });
        };
    }
})();

