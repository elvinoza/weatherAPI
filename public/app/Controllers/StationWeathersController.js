(function() {

    'use strict';

    angular
        .module('app')
        .controller('StationWeathersController', StationWeathersController);

    function StationWeathersController($scope, $state, $stateParams, ApiService) {

        var vm = this;

        $scope.query = {
            order: 'name',
            limit: 5,
            page: 1
        };

        vm.weathers;

        vm.getStationWeathers = function(id){
            ApiService.getStationWeathers(id).success(function(data) {
                vm.weathers = data;
            }).error(function(error) {

            });
        }

        vm.getStationWeathers($stateParams.id);
    }
})();
