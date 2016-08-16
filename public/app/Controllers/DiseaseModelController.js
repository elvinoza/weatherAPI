(function() {

    'use strict';

    angular
        .module('app')
        .controller('DiseaseModelController', DiseaseModelController);

    function DiseaseModelController($scope, $stateParams, ApiService) {

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

        vm.getModels($stateParams.id);
    }
})();