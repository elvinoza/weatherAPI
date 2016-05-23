(function() {

    'use strict';

    angular
        .module('app')
        .controller('LatestDataController', LatestDataController);

    function LatestDataController($scope, $rootScope, $state, ApiService) {

        $scope.weathers = [];

        $scope.getLatestData = function(){

            ApiService.getLatestWeathers($rootScope.currentUser.id).success(function(data) {
                $scope.weathers = data;
            }).error(function(error) {

            });
        };

        $scope.getLatestData();
    };
})();