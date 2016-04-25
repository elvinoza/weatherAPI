(function() {

    'use strict';

    angular
        .module('app')
        .controller('UserController', UserController);

    function UserController($http, $auth, $state, $stateParams, $rootScope, ApiService) {

        var vm = this;

        vm.users;
        vm.error;
        vm.user;

        vm.getUser = function(){
            console.log($stateParams);
            //ApiService.getUser(id).success(function(data) {
            //    vm.user = data;
            //}).error(function(error) {
            //    vm.error = error;
            //});
        }

        vm.getUsers = function() {

            // This request will hit the index method in the AuthenticateController
            // on the Laravel side and will return the list of users
            $http.get('api/authenticate').success(function(users) {
                vm.users = users;
            }).error(function(error) {
                vm.error = error;
            });
        }

        vm.stations = function(){
            $state.go('stations');
        }

        vm.logout = function() {

            $auth.logout().then(function() {

                // Remove the authenticated user from local storage
                localStorage.removeItem('user');

                // Flip authenticated to false so that we no longer
                // show UI elements dependant on the user being logged in
                $rootScope.authenticated = false;

                // Remove the current user info from rootscope
                $rootScope.currentUser = null;
            });
        }
    }

})();