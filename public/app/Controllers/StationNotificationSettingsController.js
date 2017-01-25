(function() {

    'use strict';

    angular
        .module('app')
        .controller('StationNotificationSettingsController', StationNotificationSettingsController);

    function StationNotificationSettingsController($rootScope, $stateParams, $scope, ApiService) {

        $scope.settings = [];

        $scope.operators = [{
            value: 1,
            name: 'More than'
        }, {
            value: 0,
            name: 'Lest than'
        }];

        $scope.error = [];
        $scope.test = []; $scope.test[0] = []; $scope.test[1] = [];
        $scope.test[0]['id'] = ['asd', 'asd1'];
        $scope.test[1]['id'] = ['dsa', 'dsa1'];

        ApiService.getClsfParams().success(function(data) {
            $scope.clsfWeatherParams = data;
        });

        $scope.add = function(){
            $scope.settings.push({
                id: 0,
                station_id: $stateParams.id,
                clsf_weather_parameter: null,
                compare_operator: 0,
                value: null,
                is_active: true,
                is_valid: true,
                settingsNr: $scope.settingsNr++
            });
        };

        $scope.getSettings = function($id) {
            ApiService.getSettings($id).success(function(data) {
                $scope.settings = data;

                if ($scope.settings == null)
                    $scope.settingsNr = 0;
                else
                    $scope.settingsNr = $scope.settings.length;

            }).error(function(error) {
                $rootScope.displayToast('Ups.. Try again!');
            });
        };

        $scope.update = function() {
            $scope.settingsToSend = angular.toJson($scope.settings);

            ApiService.updateSettings($scope.settingsToSend).success(function(data) {
                $scope.settings = data;
                $rootScope.displayToast('Notifications settings saved!');
            }).error(function(error) {
                $scope.setErrors(error);
                //$scope.error = error;
                console.log($scope.error);
            });
        };

        $scope.setErrors = function(error){
            $scope.error = [];
            var i = 0;
            for(var name in error) {
                var value = error[name];

                if (typeof $scope.error[parseInt(name.substr(0,name.indexOf('.')))] === 'undefined')
                    $scope.error[parseInt(name.substr(0,name.indexOf('.')))] = [];
                $scope.error[name.substr(0,name.indexOf('.'))].push([name.substr(name.indexOf('.')+1)]);
                $scope.error[name.substr(0,name.indexOf('.'))][name.substr(name.indexOf('.')+1)] = value;
            }
        };

        $scope.getView = function(){
            return '../../Views/SettingsViews/SettingView.html'
        };

        $scope.delete = function(setting){
            $scope.settings.splice($scope.settings.indexOf(setting), 1);
        };

        $scope.getSettings($stateParams.id);
    }
})();