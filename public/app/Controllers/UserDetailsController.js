(function() {

    'use strict';

    angular
        .module('app')
        .controller('UserDetailsController', UserDetailsController);

    function UserDetailsController($scope, $stateParams, ApiService) {

        var vm = this;

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
            }).error(function(error) {
                console.log(error);
            });
        };

        vm.getUser($stateParams.id);
    }

})();