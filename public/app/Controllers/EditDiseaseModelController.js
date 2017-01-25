(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditDiseaseModelController', EditDiseaseModelController);

    function EditDiseaseModelController($rootScope, $stateParams, $scope, ApiService) {

        $scope.model = null;
        $scope.modelSend = null;
        $scope.modelError = {};
        $scope.conditionError = [];

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
            $scope.model.conditions.push({
                id: $scope.conditionNr,
                disease_model_id: $scope.model.id,
                clsf_weather_parameter: null,
                date_range: true,
                start_range: null,
                end_range: null,
                constant: null,
                operator: null,
                time: null,
                conditionNr: $scope.conditionNr++
            });
        };

        $scope.getDiseaseModel = function($id) {
            ApiService.getDiseaseModelById($id).success(function(data) {
                $scope.model = data;

                if ($scope.model.conditions == null)
                    $scope.conditionNr = 0;
                else
                    $scope.conditionNr = $scope.model.conditions.length;

            }).error(function(error) {
                $rootScope.displayToast('Ups.. Try again!');
            });
        };

        $scope.update = function() {
            $scope.modelSend = angular.toJson($scope.model);
            ApiService.updateDiseaseModel($scope.modelSend).success(function(data) {
                $scope.model = data;
                $rootScope.displayToast('Disease model updated!');
            }).error(function(error) {
                $scope.modelError = error;
                $rootScope.displayToast('Disease model not valid. Check errors and try again!');
                $scope.setErrors(error);
            });
        };

        $scope.getView = function(){
            return '../../Views/DiseaseModelViews/ConditionView.html'
        };

        $scope.delete = function(condition){
            $scope.model.conditions.splice($scope.model.conditions.indexOf(condition), 1);
        };

        $scope.setErrors = function(error){
            $scope.conditionError = [];
            for(var name in error) {
                if (name.match( new RegExp('\\.','g')) != null && name.match( new RegExp('\\.','g') ).length > 1)
                {
                    var value = error[name];

                    if (typeof $scope.conditionError[parseInt(name.substr(11, 1))] === 'undefined')
                        $scope.conditionError[parseInt(name.substr(11, 1))] = [];
                    $scope.conditionError[parseInt(name.substr(11, 1))].push([name.substr(name.lastIndexOf('.')+1)]);
                    $scope.conditionError[parseInt(name.substr(11, 1))][name.substr(name.lastIndexOf('.')+1)] = value;
                }
            }
        };

        $scope.getDiseaseModel($stateParams.id);
    }
})();