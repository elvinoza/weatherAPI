(function() {

    'use strict';

    angular
        .module('app')
        .controller('UserStationsController', UserStationsController);

    function UserStationsController($scope, $stateParams, ApiService) {

        var vm = this;

        vm.stations;
        vm.error;

        vm.getUserStations = function(id){
            ApiService.getUserStations(id).success(function(data) {
                vm.stations = data;
            }).error(function(error) {

                vm.error = error;
            });
        }

        vm.getUserStations($stateParams.id);
    }
})();
