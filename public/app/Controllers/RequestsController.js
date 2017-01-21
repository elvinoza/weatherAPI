(function() {

    'use strict';

    angular
        .module('app')
        .controller('RequestsController', RequestsController);

    function RequestsController($scope, ApiService) {

        $scope.logs = [];

        $scope.query = {
            order: 'ip',
            limit: 20,
            page: 1
        };

        $scope.getAllLogs = function() {
            ApiService.getLogs().success(function(data) {
                $scope.logs = data;
            }).error(function(error) {

            });
        };

        $scope.refreshList = function() {
            $scope.getAllLogs();
        };

        $scope.getAllLogs();
    }
})();

