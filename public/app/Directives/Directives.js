(function() {

    'use strict';

    angular
        .module('directives', [])
        .directive('addconditionbutton', function() {
            return {
                restrict: "E",
                template: "<md-button conditionview style='width: 100%' class='md-raised md-primary''>Add Condition</md-button>"
            }
        })
        .directive('conditionview', function($templateRequest, $compile) {
            return {
                restrict: "E",

                template: "<md-button ng-click='add()' conditionview style='width: 100%' class='md-raised md-primary''>Add Condition</md-button>",
                link: function ($scope, $element, $templateCache, ApiService) {
                    $templateCache.remove('../../Views/DiseaseModelViews/ConditionView.html');
                    //$scope.count = 0;
                    $scope.clsfWeatherParams = [];

                    ApiService.getClsfParams().success(function(data) {
                        $scope.clsfWeatherParams = data;
                    });

                    $scope.add = function() {
                        $scope.count++;
                        //var data = $templateCache.get('../../Views/DiseaseModelViews/ConditionView.html');
                        //var templ = angular.element(data);
                        //$element.append(templ);
                        //$compile(templ)($scope);
                        $templateRequest('../../Views/DiseaseModelViews/ConditionView.html').then(function(html){
                            var template = angular.element(html);
                            $element.append(template);
                            $compile(template)($scope);
                        });
                    };
                }
            };
        });
})();