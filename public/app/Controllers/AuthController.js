(function() {

    'use strict';

    angular
        .module('app')
        .controller('AuthController', AuthController);


    function AuthController($auth, $state, $http, $rootScope, flash, ApiService, $scope) {

        $scope.register = {};
        $scope.selectedTab = 0;

        var vm = this;

        vm.login = function() {

            var credentials = {
                email: vm.email,
                password: vm.password
            }

            $auth.login(credentials).then(function() {

                // Return an $http request for the now authenticated
                // user so that we can flatten the promise chain
                return $http.get('api/authenticate/user');

            }, function(error) {
                flash.error = error.data.error;
            }).then(function(response) {

                var user = JSON.stringify(response.data.user);
                localStorage.setItem('user', user);
                $rootScope.authenticated = true;
                $rootScope.currentUser = response.data.user;
                $state.go('user');
            });
        };

        vm.register = function(){
            ApiService.register($scope.register).success(function(data) {
                $scope.station = data;
                $scope.selectedTab = 1;
            }).error(function(error) {
                //flash.error = error;
            });
        };
    };

})();
