(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateDiseaseModelController', CreateDiseaseModelController);

    function CreateDiseaseModelController($rootScope, $scope, $state, flash, ApiService) {

        $scope.showConditionsForms = false
        $scope.clsfWeatherParams = [];
        $scope.model = null;
        $scope.id = null;

        $scope.conditions = [
            {
                disease_model_id: $scope.id,
                clsf_weather_parameter: null,
                start_range: null,
                end_range: null,
                constant: null,
                operator: null,
                time: null
            }];

        //$scope.count = 0;

        $scope.getView = function(){
            return '../../Views/DiseaseModelViews/ConditionView.html'
        };

        $scope.clsfWeatherParams = [];

        ApiService.getClsfParams().success(function(data) {
            $scope.clsfWeatherParams = data;
        });

        $scope.add = function(){
            $scope.conditions.push({
                disease_model_id: $scope.id,
                clsf_weather_parameter: null,
                start_range: null,
                end_range: null,
                constant: null,
                operator: null,
                time: null
            });
        };


        $scope.create = function(){
            $scope.model.user_id = $rootScope.currentUser.id;
            ApiService.createDiseaseModel($scope.model).success(function(data) {
                $scope.model = data;
                flash.success = "Model created";

                //vm.OpenCondition();
                //$state.go('userModels', { id: data.user_id });
            }).error(function(error) {
                flash.error = error;
            });
        };
    }
})();