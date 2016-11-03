(function() {

    'use strict';

    angular
        .module('app')
        .controller('LatestDataController', LatestDataController);

    function LatestDataController($scope, $rootScope, ApiService) {

        $scope.weathers = [];

        $scope.query = {
            order: 'name',
            limit: 10,
            page: 1
        };

        $scope.getLatestData = function(){

            ApiService.getLatestWeathers($rootScope.currentUser.id).success(function(data) {
                $scope.weathers = data;
            }).error(function(error) {

            });
        };

        $scope.refreshList = function(){
            $scope.getLatestData();
        };

        $scope.getLatestData();
    };
})();