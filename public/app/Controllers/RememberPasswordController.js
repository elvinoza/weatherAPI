(function() {

    'use strict';

    angular
        .module('app')
        .controller('RememberPasswordController', RememberPasswordController);

    function RememberPasswordController($mdDialog, $rootScope, $scope) {

        $scope.email = null;

        $scope.newPassword = function(){
            if ($scope.email != null){
                $rootScope.displayToast('New password link sent to your email!');
                $mdDialog.hide();
            }
        };

        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };
    }
})();
