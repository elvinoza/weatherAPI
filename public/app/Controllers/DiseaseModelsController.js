(function() {

    'use strict';

    angular
        .module('app')
        .controller('DiseaseModelsController', DiseaseModelsController);

    function DiseaseModelsController($state, $scope, $stateParams, ApiService, $mdDialog) {

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

        vm.showStations = function(ev, id, hasConditions) {

            if(hasConditions){
                $mdDialog.show({
                    controller: 'FollowController',
                    templateUrl: '../../Views/DiseaseModelViews/FollowPopup.html',
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    clickOutsideToClose:true,
                    locals: {
                        modelId: id
                    },
                    fullscreen: true // Only for -xs, -sm breakpoints.
                })
                .then(function(answer) {
                    //$scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    //$scope.status = 'You cancelled the dialog.';
                });
            } else {
                $mdDialog.show({
                    controller: 'MessagePopupController',
                    templateUrl: '../../Views/Shared/MessagePopup.html',
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    clickOutsideToClose:true,
                    locals: {
                        title: "Set Follow Stations",
                        message: "This model can't be assigned, because it hasn't any condition."
                    },
                    fullscreen: true // Only for -xs, -sm breakpoints.
                })
                .then(function(answer) {
                    //$scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    //$scope.status = 'You cancelled the dialog.';
                });
            }
        };

        vm.getModels($stateParams.id);
    }
})();

