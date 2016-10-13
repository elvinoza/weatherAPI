(function() {

    'use strict';

    angular
        .module('app')
        .controller('NotificationsController', NotificationsController);

    function NotificationsController($stateParams, $scope, ApiService) {

        $scope.notifications = [];

        $scope.getAllNotifications = function(id){
            console.log('asd');
            ApiService.getAllUserNotifications(id).success(function(data) {
                $scope.notifications = data;
                console.log(data);
            }).error(function(error) {

            });
        };

        $scope.getAllNotifications($stateParams.id);
    };
})();

