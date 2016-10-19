(function() {

    'use strict';

    angular
        .module('app')
        .controller('FollowController', FollowController);

    function FollowController($mdDialog, $rootScope, $scope, modelId, ApiService) {

        $scope.stations = [];

        $scope.getStations = function(id){
            ApiService.getModelUserStations($rootScope.currentUser.id, id).success(function(data) {
                console.log(data);
                $scope.stations= data;
            }).error(function(error) {

            });
        };

        $scope.changeStatus = function(stationId) {
            var followModel = {
                user_id: $rootScope.currentUser.id,
                station_id: stationId,
                disease_model_id: modelId
            };

            ApiService.changeModelFollowStatus(followModel).success(function(data) {
                //display changes
            }).error(function(error) {
                //display error
            });
        };
        
        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.getStations(modelId);
    }
})();