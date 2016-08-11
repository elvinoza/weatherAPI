<!DOCTYPE html>
<html ng-app="app">
    <head>
        <title>Stations</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="station weatherstation weather meteo" />

        <!-- css -->
        <link href="css/angular-material.css" rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel='stylesheet' type='text/css' />

        <!-- //css -->
        <!-- fonts -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">
        <!-- //fonts -->
        <!-- js -->
        <script src="js/all.js"></script>
        <script src="js/modernizr.custom.js"></script>
        <!-- //js -->
    </head>
    <body ng-cloak>
        <div layout="row" style="background-color: paleturquoise;" layout-padding class="bg-blue-grey nav-dark" layout-align="space-between center">
            <div ng-if="authenticated" >
                <md-button style="background-color: rgb(255,87,34); color: white" class="md-ripple-size" ui-sref="latestData()">Latest Stations Data</md-button>
                <md-button style="background-color: rgb(255,87,34); color: white" class="md-ripple-size" ui-sref="userStations({ id: currentUser.id })">Stations</md-button>
                <md-button style="background-color: rgb(255,87,34); color: white" class="md-ripple-size" ui-sref="#">Dissease Models</md-button>
            </div>

            <div class="nav-buttons">
                <md-button ng-if="authenticated" class="md-raised md-accent" ng-click="profile()">My profile</md-button>
                <md-button ng-if="authenticated" class="md-raised md-warn" ng-click="logout()">Log Out</md-button>
            </div>
        </div>
        <ui-view></ui-view>
    </body>
</html>