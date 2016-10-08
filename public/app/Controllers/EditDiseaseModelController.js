(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditDiseaseModelController', EditDiseaseModelController);

    function EditDiseaseModelController($rootScope, $stateParams, $state, $scope, ApiService) {

        $scope.model = null;

        ApiService.getClsfParams().success(function(data) {
            $scope.clsfWeatherParams = data;
        });

        $scope.getDiseaseModel = function($id){
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