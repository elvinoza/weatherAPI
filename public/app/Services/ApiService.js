(function() {

    'use strict';

    angular
        .module('app')
        .service('ApiService', ApiService);

    function ApiService($http) {

        var baseURL = '/api/';

        this.getStations = function(){
            return $http.get(baseURL + 'allStations/');
        };

        this.getUser = function(id){
            return $http.get(baseURL + 'user/' + id);
        }

        this.updateUser = function(user){
            return $http.post(baseURL + 'user/' + user.id, user, { headers: { 'Accept': 'Application/json' }});
        }
    }
})();