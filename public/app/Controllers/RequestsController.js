(function() {

    'use strict';

    angular
        .module('app')
        .controller('RequestsController', RequestsController);

    function RequestsController($scope, ApiService) {

        $scope.requests = null;

        $scope.query = {
            order: ['ip'],
            limit: 20,
            page: 1
        };


        $scope.limitOptions = [5, 10, 15, 20];

        $scope.getAllLogs = function() {

            ApiService.getLogs().success(function(data) {
                $scope.requests = data;
            }).error(function(error) {

            });
        };

        $scope.refreshList = function() {
            $scope.getAllLogs();
        };

        $scope.getAllLogs();
    };
})();

