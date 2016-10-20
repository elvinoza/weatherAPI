(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditDiseaseModelController', EditDiseaseModelController);

    function EditDiseaseModelController($stateParams, $scope, ApiService) {

        $scope.model = null;

        $scope.operators = [{
            value: true,
            name: 'More than'
        }, {
            value: false,
            name: 'Lest than'
        }];

        ApiService.getClsfParams().success(function(data) {
            $scope.clsfWeatherParams = data;
        });

        $scope.getDiseaseModel = function($id) {
            ApiService.getDiseaseModelById($id).success(function(data) {
                $scope.model = data;
            }).error(function(error) {
                //display some error's
            });
        };

        $scope.update = function() {

            ApiService.updateDiseaseModel($scope.model).success(function(data) {
                $scope.model = data;
            }).error(function(error) {
                //display some error's
            });
        };

        $scope.getView = function(){
            return '../../Views/DiseaseModelViews/ConditionView.html'
        };

        $scope.getDiseaseModel($stateParams.id);
    }
})();