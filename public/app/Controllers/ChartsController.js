(function() {

    'use strict';

    angular
        .module('app')
        .controller('ChartsController', ChartsController);

    function ChartsController($scope, $state, $stateParams, ApiService, $timeout) {

        $scope.data = [];
        $scope.show = false;

        $scope.buildChart = function(){

            ApiService.getStationWeathers(1, '2016-05-15').success(function(data) {
                $scope.data = data;
                //set data to chart
                $scope.chartConfig.xAxis[0].categories = $scope.data.time;
                $scope.chartConfig.series[0].data = $scope.data.temperature;
                $scope.chartConfig.series[1].data = $scope.data.rain;
                $scope.chartConfig.series[2].data = $scope.data.pressure;
                $scope.chartConfig.series[3].data = $scope.data.soil_temperature;
            }).error(function(error) {

            });
        };

        $scope.buildChart();

        $scope.chartConfig = {
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: 'Average Monthly Weather Data for Tokyo'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: [{
                categories: [],
                crosshair: true
            }],
            yAxis: [{ // 1 yAxis
                labels: {
                    format: '{value}°C',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                },
                title: {
                    text: 'Temperature',
                    style: {
                        color: Highcharts.getOptions().colors[2]
                    }
                }
            }, { // 2 yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Rainfall',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                labels: {
                    format: '{value} mm',
                    style: {
                        color: Highcharts.getOptions().colors[0]
                    }
                },
                opposite: true

            }, { // 3 yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Pressure',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                labels: {
                    format: '{value} Pa',
                    style: {
                        color: Highcharts.getOptions().colors[1]
                    }
                },
                opposite: true

            }, { // 4 yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Soil temperature',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                },
                labels: {
                    format: '{value} °C',
                    style: {
                        color: Highcharts.getOptions().colors[3]
                    }
                },
            }],
            tooltip: {
                shared: true
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                x: 80,
                verticalAlign: 'top',
                y: 55,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
            },
            series: [{
                name: 'Temperature',
                type: 'spline',
                data: $scope.data.temperature,
                tooltip: {
                    valueSuffix: ' °C'
                }
            },{
                name: 'Rainfall',
                type: 'spline',
                yAxis: 1,
                data: $scope.data.rain,
                tooltip: {
                    valueSuffix: ' mm'
                }

            }, {
                name: 'Pressure',
                type: 'spline',
                yAxis: 2,
                data: $scope.data.pressure,
                marker: {
                    enabled: false
                },
                dashStyle: 'shortdot',
                tooltip: {
                    valueSuffix: ' Pa'
                }

            }, {
                name: 'Soil temperature',
                type: 'spline',
                yAxis: 1,
                data: [],
                tooltip: {
                    valueSuffix: ' °C'
                }

            }]
        };
    };
})();

