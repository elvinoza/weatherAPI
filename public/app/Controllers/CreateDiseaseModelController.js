(function() {

    'use strict';

    angular
        .module('app')
        .controller('CreateDiseaseModelController', CreateDiseaseModelController);

    function CreateDiseaseModelController($rootScope, $scope, $state, flash, ApiService) {
        var vm = this;
        $scope.model = null;

        vm.create = function(){
            $scope.model.user_id = $rootScope.currentUser.id;
            ApiService.createDiseaseModel($scope.model).success(function(data) {
                $scope.model = data;
                flash.success = "Station created";
                $state.go('userModels', { id: data.user_id });
            }).error(function(error) {
                flash.error = error;
            });
        };
    }
})();