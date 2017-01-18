(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditDiseaseModelController', EditDiseaseModelController);

    function EditDiseaseModelController($rootScope, $stateParams, $scope, ApiService) {

        $scope.model = null;

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
                console.log(data);
                $scope.model = data;

                if ($scope.model.conditions == null)
                    $scope.conditionNr = 0;
                else
                    $scope.conditionNr = $scope.model.conditions.length;

            }).error(function(error) {
                //display some error's
            });
        };

        $scope.update = function() {
            $scope.model = angular.toJson($scope.model);
            ApiService.updateDiseaseModel($scope.model).success(function(data) {
                $scope.model = data;
                $rootScope.displayToast('Disease model updated!');
            }).error(function(error) {
                //display some error's
            });
        };

        $scope.getView = function(){
            return '../../Views/DiseaseModelViews/ConditionView.html'
        };

        $scope.delete = function(condition){
            $scope.model.conditions.splice($scope.model.conditions.indexOf(condition), 1);
        };

        $scope.getDiseaseModel($stateParams.id);
    }
})();