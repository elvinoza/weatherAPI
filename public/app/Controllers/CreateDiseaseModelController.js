(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateDiseaseModelController', CreateDiseaseModelController);

    function CreateDiseaseModelController($rootScope, $state, $scope, ApiService) {

        $scope.clsfWeatherParams = [];
        $scope.model = {};
        $scope.conditionNr = 1;
        $scope.modelError = {};

        $scope.conditionError = [];

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
                $scope.modelError = error;
            });
        };

        $scope.update = function(){
            $scope.model.user_id = $rootScope.currentUser.id;
            var cond = angular.toJson({ conditions: $scope.conditions });

            ApiService.createDiseaseModelConditions(cond).success(function(data) {
                $state.go('userModels', { id: $scope.model.user_id });
                $rootScope.displayToast('Disease model updated!');
            }).error(function(error) {
                $rootScope.displayToast('Disease model not valid. Check errors and try again!');
                $scope.setErrors(error);
            });
        };

        $scope.delete = function(condition){
            $scope.conditions.splice($scope.conditions.indexOf(condition),1);
        };

        $scope.setErrors = function(error){
            $scope.conditionError = [];
            var i = 0;
            for(var name in error) {
                var value = error[name];

                if (typeof $scope.conditionError[parseInt(name.substr(11, 1))] === 'undefined')
                    $scope.conditionError[parseInt(name.substr(11, 1))] = [];
                $scope.conditionError[parseInt(name.substr(11, 1))].push([name.substr(name.lastIndexOf('.')+1)]);
                $scope.conditionError[parseInt(name.substr(11, 1))][name.substr(name.lastIndexOf('.')+1)] = value;
            }
        };
    }
})();