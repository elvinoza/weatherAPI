(function() {

    'use strict';

    angular
        .module('app')
        .controller('NotificationsController', NotificationsController);

    function NotificationsController($stateParams, $rootScope, $scope, ApiService) {

        $scope.query = {
            order: 'short_message',
            limit: 10,
            page: 1
        };

        $scope.limitOptions = [5, 10, 15, 20];
        $scope.allNotifications = [];


        $scope.getAllNotifications = function(id) {

            ApiService.getAllUserNotifications(id).success(function(data) {
                $scope.allNotifications = data;
            }).error(function(error) {

            });
        };

        $scope.refreshList = function() {
            $scope.getAllNotifications($stateParams.id);
        };

        $scope.showNotification = function(ev, notification){
            $rootScope.showNotification(ev, notification);
            $scope.getAllNotifications($stateParams.id);
        };

        $scope.getAllNotifications($stateParams.id);
    };
})();

