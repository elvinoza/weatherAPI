(function() {

    'use strict';

    angular
        .module('app')
        .controller('AuthController', AuthController);

    function AuthController($auth, $state, $http, $rootScope, ApiService, $scope) {

        $scope.register = {};
        $scope.selectedTab = 0;
        $scope.errors = 0;
        $scope.error = {};
        $scope.regError = {};
        var vm = this;

        vm.login = function() {

            var credentials = {
                email: vm.email,
                password: vm.password
            };

            $auth.login(credentials).then(function() {

                return $http.get('api/authenticate/user');

            }, function(error) {
                $scope.errors = 1;
                $scope.error = error;
            }).then(function(response) {
                if (response) {
                    var user = JSON.stringify(response.data.user);
                    localStorage.setItem('user', user);
                    $rootScope.authenticated = true;
                    $rootScope.currentUser = response.data.user;
                    $state.go('latestData');
                }
            });
        };

        vm.register = function(){
            ApiService.signUp($scope.register).success(function(data) {
                $scope.register = {};
                $scope.selectedTab = 0;
                $rootScope.displayToast("Registration Successful!");
            }).error(function(error) {
                console.log(error);
                $scope.regError = error;
            });
        };
    }
})();
