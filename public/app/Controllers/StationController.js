(function() {

    'use strict';

    angular
        .module('app')
        .controller('StationController', StationController);

    function StationController(ApiService) {

        var vm = this;

        vm.stations;
        vm.error;

        vm.getStations = function(){
            ApiService.getStations().success(function(data) {
                vm.stations = data;
            }).error(function(error) {

                vm.error = error;
            });
        }
    }
})();
