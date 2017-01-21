(function() {

    'use strict';

    angular
        .module('app')
        .controller('AllSystemDiseaseModelsForAdminController', AllSystemDiseaseModelsForAdminController);

    function AllSystemDiseaseModelsForAdminController($state, $scope, ApiService, $mdDialog) {

        $scope.models = [];

        $scope.query = {
            order: 'name',
            limit: 10,
            page: 1
        };

        $scope.getModels = function(){
            ApiService.getAllDiseaseModels().success(function(data) {
                $scope.models = data;
            }).error(function(error) {

            });
        };

        $scope.create = function(){
            $state.go('createDiseaseModel');
        };

        $scope.editModel = function(event, item) {
            $state.go('editDiseaseModel', { id: item.id });
        };

        $scope.showStations = function(ev, id, hasConditions) {

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
                    fullscreen: true
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
                    fullscreen: true
                })
                .then(function(answer) {
                    //$scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    //$scope.status = 'You cancelled the dialog.';
                });
            }
        };

        $scope.getModels();
    }
})();

