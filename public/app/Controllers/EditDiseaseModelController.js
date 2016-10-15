(function() {

    'use strict';

    angular
        .module('app')
        .controller('EditDiseaseModelController', EditDiseaseModelController);

    function EditDiseaseModelController($rootScope, $stateParams, $scope, ApiService) {

        $scope.model = null;

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

        $scope.changeStatus = function() {
            var followModel = {
                user_id: $rootScope.currentUser.id,
                disease_model_id: $stateParams.id
            };

            ApiService.changeModelFollowStatus(followModel).success(function(data) {
                //display changes
            }).error(function(error) {
                //display error
            });
        };

        $scope.getDiseaseModel($stateParams.id);
    }
})();