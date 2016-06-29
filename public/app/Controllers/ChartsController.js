(function() {

    'use strict';

    angular
        .module('app')
        .controller('ChartsController', ChartsController);

    function ChartsController($scope, $state, $stateParams, ApiService, $timeout) {

        $scope.data = [];
        $scope.show = false;
        $scope.startDate = new Date();
        $scope.endDate = new Date();

        $scope.loadChartData = function(){
            ApiService.getStationDataForChart($stateParams.id, $scope.startDate.toISOString().slice(0,10), $scope.endDate.toISOString().slice(0,10)).success(function(data) {
                $scope.data = data;
                //set data to chart
                $scope.chartConfig.xAxis[0].categories = $scope.data.time;
                $scope.chartConfig.series[0].data = $scope.data.temperature;
                $scope.chartConfig.series[1].data = $scope.data.rain;
                $scope.chartConfig.series[2].data = $scope.data.pressure;
                $scope.chartConfig.series[3].data = $scope.data.soil_temperature;
                $scope.chartConfig.series[4].data = $scope.data.soil_humidity;
                $scope.chartConfig.series[5].data = $scope.data.humidity;
                $scope.chartConfig.series[6].data = $scope.data.wind_speed;
            }).error(function(error) {
                //TODO: handle error's
            });
        };

        $scope.loadChartData();

        $scope.chartConfig = {
            chart: {
                zoomType: 'xy'
            },
            title: {
                text: ''
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
                }
            }, { // 5 yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Soil Humidity',
                    style: {
                        color: Highcharts.getOptions().colors[4]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[4]
                    }
                },
                opposite: true
            }, { // 6 yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Humidity',
                    style: {
                        color: Highcharts.getOptions().colors[5]
                    }
                },
                labels: {
                    format: '{value} %',
                    style: {
                        color: Highcharts.getOptions().colors[5]
                    }
                },
                opposite: true
            }, { // 7 yAxis
                gridLineWidth: 0,
                title: {
                    text: 'Wind Speed',
                    style: {
                        color: Highcharts.getOptions().colors[6]
                    }
                },
                labels: {
                    format: '{value} km/h',
                    style: {
                        color: Highcharts.getOptions().colors[6]
                    }
                },
                opposite: true
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
                data: [],
                tooltip: {
                    valueSuffix: ' °C'
                }
            },{
                name: 'Rainfall',
                type: 'spline',
                yAxis: 1,
                data: [],
                tooltip: {
                    valueSuffix: ' mm'
                }
            }, {
                name: 'Pressure',
                type: 'spline',
                yAxis: 2,
                data: [],
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
                yAxis: 3,
                data: [],
                tooltip: {
                    valueSuffix: ' °C'
                }
            }, {
                name: 'Soil humidity',
                type: 'spline',
                yAxis: 4,
                data: [],
                tooltip: {
                    valueSuffix: ' %'
                }
            }, {
                name: 'Humidity',
                type: 'spline',
                yAxis: 5,
                data: [],
                tooltip: {
                    valueSuffix: ' %'
                }
            }, {
                name: 'Wind speed',
                type: 'spline',
                yAxis: 6,
                data: [],
                tooltip: {
                    valueSuffix: ' km/h'
                }
            }]
        };
    };
})();

