(function() {

    'use strict';

    angular
        .module('app')
        .controller('UserDetailsController', UserDetailsController);

    function UserDetailsController($rootScope, $scope, $stateParams, ApiService) {

        var vm = this;

        $scope.password = {};

        vm.error;

        vm.getUser = function(id){
            ApiService.getUser(id).success(function(data) {
                $scope.user = data;
            }).error(function(error) {
                vm.error = error;
            });
        };

        vm.update = function(){
            ApiService.updateUser($scope.user).success(function(data) {
                $scope.user = data;
                $rootScope.displayToast('User data updated!');
            }).error(function(error) {
                console.log(error);
            });
        };

        vm.changePassword = function(){
            $scope.password.user_id = $stateParams.id;

            ApiService.changeUserPassword($scope.password).success(function(data) {
                $scope.password = {};
                $rootScope.displayToast('User password updated!');
            }).error(function(error) {
                console.log(error);
            });
        };

        vm.getUser($stateParams.id);
    }

})();