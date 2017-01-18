(function() {

    'use strict';

    angular
        .module('app')
        .controller('MessagePopupController', MessagePopupController);

    function MessagePopupController($mdDialog, $scope, title, message) {

        $scope.message = message;
        $scope.title = title;

        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };
    };
})();