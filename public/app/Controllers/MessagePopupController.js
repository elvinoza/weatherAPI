(function() {

    'use strict';

    angular
        .module('app')
        .controller('MessagePopupController', MessagePopupController);

    function MessagePopupController($mdDialog, $scope, message) {

        $scope.message = message;

        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };
    };

})();