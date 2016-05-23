(function() {

    'use strict';

    angular
        .module('app')
        .controller('StationWeathersController', StationWeathersController);

    function StationWeathersController($scope, $state, $stateParams, ApiService) {

        var vm = this;

        $scope.limitOptions = [5, 10, 15, 20];

        $scope.query = {
            order: 'name',
            limit: 10,
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
