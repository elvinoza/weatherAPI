(function() {
    'use strict';
    angular
        .module('app', ['ui.router', 'satellizer', 'angular-flash.service', 'angular-flash.flash-alert-directive', 'ngMaterial'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider, $httpProvider, $provide) {

            $authProvider.loginUrl = '/api/authenticate';

            $urlRouterProvider
                .otherwise('/auth');

            $stateProvider
                .state('auth', {
                    url: '/auth',
                    templateUrl: '../Views/Login.html',
                    controller: 'AuthController as auth'
                })
                .state('user', {
                    url: '/user',
                    templateUrl: '../Views/User.html',
                    controller: 'UserController as user'
                })
                .state('userDetails', {
                    url: '/user/:id',
                    templateUrl: '../Views/UserViews/Details.html',
                    controller: 'UserDetailsController as userDetails'
                })
                .state('userStations', {
                    url: '/user/stations/:id',
                    templateUrl: '../Views/StationViews/UserStations.html',
                    controller: 'UserStationsController as userStations'
                })
                .state('editStation', {
                    url: '/station/edit/:id',
                    templateUrl: '../Views/StationViews/EditStation.html',
                    controller: 'EditStationController as editStation'
                })
                .state('createStation', {
                    url: '/station/create',
                    templateUrl: '../Views/StationViews/CreateStation.html',
                    controller: 'CreateStationController as createStation'
                })
                .state('stationWeathers', {
                    url: '/station/weathers/:id',
                    templateUrl: '../Views/WeathersViews/StationWeathers.html',
                    controller: 'StationWeathersController as stationWeathers'
                })

            function redirectWhenLoggedOut($q, $injector) {

                return {
                    responseError: function(rejection) {

                        var $state = $injector.get('$state');
                        var rejectionReasons = ['token_not_provided', 'token_expired', 'token_absent', 'token_invalid'];

                        angular.forEach(rejectionReasons, function(value, key) {
                            if(rejection.data.error === value) {
                                localStorage.removeItem('user');
                                $state.go('auth');
                            }
                        });

                        return $q.reject(rejection);
                    }
                }
            }

            $provide.factory('redirectWhenLoggedOut', redirectWhenLoggedOut);
            $httpProvider.interceptors.push('redirectWhenLoggedOut');
            $authProvider.loginUrl = '/api/authenticate';
        })
        .run(function($rootScope, $state, $auth) {

            $rootScope.$on('$stateChangeStart', function(event, toState) {

                var user = JSON.parse(localStorage.getItem('user'));

                if(user) {

                    $rootScope.authenticated = true;

                    $rootScope.currentUser = user;

                    if(toState.name === "auth") {

                        event.preventDefault();

                        $state.go('user');
                    }
                }
            });

            $rootScope.logout = function() {

                $auth.logout().then(function() {

                    // Remove the authenticated user from local storage
                    localStorage.removeItem('user');

                    // Flip authenticated to false so that we no longer
                    // show UI elements dependant on the user being logged in
                    $rootScope.authenticated = false;

                    // Remove the current user info from rootscope
                    $rootScope.currentUser = null;

                    $state.go('auth');
                });
            };

            $rootScope.profile = function() {
                $state.go('userDetails', { id: $rootScope.currentUser.id });
            };
    });
})();