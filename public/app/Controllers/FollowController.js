(function() {

    'use strict';

    angular
        .module('app')
        .controller('FollowController', FollowController);

    function FollowController($mdDialog, $rootScope, $scope, modelId, ApiService) {

        $scope.stations = [];
        $scope.activated = true;

        $scope.getStations = function(id){
            ApiService.getModelUserStations($rootScope.currentUser.id, id).success(function(data) {
                $scope.activated = false;
                $scope.stations= data;
            }).error(function(error) {
                $scope.displayToast('Something going wrong. Try again!')
            });
        };

        $scope.changeStatus = function(stationId) {
            var followModel = {
                user_id: $rootScope.currentUser.id,
                station_id: stationId,
                disease_model_id: modelId
            };

            ApiService.changeModelFollowStatus(followModel).success(function(data) {
                if (data.is_valid) {
                    $rootScope.displayToast('Station - ' + data.station.name + ' following ' + data.model.name + ' model!');
                } else {
                    $rootScope.displayToast('Station ' + data.station.name + ' un follow ' + data.model.name + ' model!');
                }
            }).error(function(error) {
                $scope.displayToast('Something going wrong. Try again!');
            });
        };

        $scope.hide = function() {
            $mdDialog.hide();
        };

        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.getStations(modelId);
    };

})();