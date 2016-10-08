(function() {

    'use strict';

    angular
        .module('app')
        .controller('DiseaseModelsController', DiseaseModelsController);

    function DiseaseModelsController($state, $scope, $stateParams, ApiService) {

        var vm = this;

        vm.models;

        $scope.query = {
            order: 'name',
            limit: 10,
            page: 1
        };

        vm.getModels = function(id){
            ApiService.getUserDiseaseModels(id).success(function(data) {
                vm.models = data;
            }).error(function(error) {

            });
        };

        vm.create = function(){
            $state.go('createDiseaseModel');
        };

        vm.editModel = function(event, item) {
            $state.go('editDiseaseModel', { id: item.id });
        };

        vm.getModels($stateParams.id);
    }
})();

