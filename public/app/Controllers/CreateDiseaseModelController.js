(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateDiseaseModelController', CreateDiseaseModelController);

    function CreateDiseaseModelController($rootScope, $state, $scope, flash, ApiService) {

        $scope.clsfWeatherParams = [];
        $scope.model = null;
        $scope.conditionNr = 1;

        $scope.operators = [{
            value: true,
            name: 'More than'
        }, {
            value: false,
            name: 'Lest than'
        }];

        $scope.conditions = [];

        $scope.getView = function(){
            return '../../Views/DiseaseModelViews/ConditionView.html'
        };

        ApiService.getClsfParams().success(function(data) {
            $scope.clsfWeatherParams = data;
        });

        $scope.add = function(){
            $scope.conditions.push({
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

        $scope.create = function(){
            $scope.model.user_id = $rootScope.currentUser.id;
            ApiService.createDiseaseModel($scope.model).success(function(data) {
                $scope.model = data;

                $scope.conditions.push({
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

                $rootScope.displayToast('Disease model created!');
            }).error(function(error) {
                flash.error = error;
            });
        };

        $scope.update = function(){
            $scope.model.user_id = $rootScope.currentUser.id;
            var cond = angular.toJson({ conditions: $scope.conditions });

            ApiService.createDiseaseModelConditions(cond).success(function(data) {
                $state.go('userModels', { id: $scope.model.user_id });
                $rootScope.displayToast('Disease model updated!');
            }).error(function(error) {
                flash.error = error;
            });
        };

        $scope.delete = function(condition){
            $scope.conditions.splice($scope.conditions.indexOf(condition),1);
            console.log($scope.conditions);
        };
    }
})();