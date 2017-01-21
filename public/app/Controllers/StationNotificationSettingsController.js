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
                //display some error's
            });
        };

        $scope.update = function() {
            $scope.settings = angular.toJson($scope.settings);

            ApiService.updateSettings($scope.settings).success(function(data) {
                $scope.settings = data;
                $rootScope.displayToast('Notifications settings saved!');
            }).error(function(error) {
                //display some error's
            });
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