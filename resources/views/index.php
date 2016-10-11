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
                <md-button style="background-color: rgb(255,87,34); color: white" class="md-ripple-size" ui-sref="userModels({ id: currentUser.id })">Disease Models</md-button>
                <md-button style="background-color: rgb(255,87,34); color: white" class="md-ripple-size" ui-sref="userModels({ id: currentUser.id })">Forecast</md-button>
            </div>

            <div ng-if="authenticated" class="nav-buttons">
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel" style="list-style: none">

                    <li class="xn-icon-button">
                        <a><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger">{{ currentUser.user_notify.count }}</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
                                <div class="pull-right">
                                    <span class="label label-danger">4 new</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
<!--                                    <img src="images/users/user2.jpg" class="pull-left" alt="John Doe"/>-->
                                    <span class="contacts-title">John Doe</span>
                                    Praesent placerat tellus id augue condimentum
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
<!--                                    <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/>-->
                                    <span class="contacts-title">Dmitry Ivaniuk</span>
                                    Donec risus sapien, sagittis et magna quis
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
<!--                                    <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/>-->
                                    <span class="contacts-title">Nadia Ali</span>
                                    Mauris vel eros ut nunc rhoncus cursus sed
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-offline"></div>
<!--                                    <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>-->
                                    <span class="contacts-title">Darth Vader</span>
                                    I want my money back!
                                </a>
                            </div>
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Show all messages</a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <md-button class="md-raised md-accent" ng-click="profile()">My profile</md-button>
                    </li>
                    <li>
                        <md-button ng-if="authenticated" class="md-raised md-warn" ng-click="logout()">Log Out</md-button>
                    </li>
                </ul>
            </div>
        </div>
        <ui-view></ui-view>
    </body>

<script type="application/javascript">

    //notification toolbar
    //TODO: move to separate js file

    $(document).ready(function(){

        $("html").on("click", function(){
                $(".x-navigation-horizontal li,.x-navigation-minimized li").removeClass('active');
        });

        x_navigation();
    });

    function page_content_onresize(){
        $(".page-content,.content-frame-body,.content-frame-right,.content-frame-left").css("width","").css("height","");

        var content_minus = 0;
        content_minus = ($(".page-container-boxed").length > 0) ? 40 : content_minus;
        content_minus += ($(".page-navigation-top-fixed").length > 0) ? 50 : 0;

        var content = $(".page-content");
        var sidebar = $(".page-sidebar");

        if(content.height() < $(document).height() - content_minus){
            content.height($(document).height() - content_minus);
        }

        if(sidebar.height() > content.height()){
            content.height(sidebar.height());
        }

        if($(window).width() > 1024){

            if($(".page-sidebar").hasClass("scroll")){
                if($("body").hasClass("page-container-boxed")){
                    var doc_height = $(document).height() - 40;
                }else{
                    var doc_height = $(window).height();
                }
                $(".page-sidebar").height(doc_height);

            }

            if($(".content-frame-body").height() < $(document).height()-162){
                $(".content-frame-body,.content-frame-right,.content-frame-left").height($(document).height()-162);
            }else{
                $(".content-frame-right,.content-frame-left").height($(".content-frame-body").height());
            }

            $(".content-frame-left").show();
            $(".content-frame-right").show();
        }else{
            $(".content-frame-body").height($(".content-frame").height()-80);

            if($(".page-sidebar").hasClass("scroll"))
                $(".page-sidebar").css("height","");
        }

        if($(window).width() < 1200){
            if($("body").hasClass("page-container-boxed")){
                $("body").removeClass("page-container-boxed").data("boxed","1");
            }
        }else{
            if($("body").data("boxed") === "1"){
                $("body").addClass("page-container-boxed").data("boxed","");
            }
        }
    }


    /* X-NAVIGATION CONTROL FUNCTIONS */
    function x_navigation_onresize(){

        var inner_port = window.innerWidth || $(document).width();

        if(inner_port < 1025){
            $(".page-sidebar .x-navigation").removeClass("x-navigation-minimized");
            $(".page-container").removeClass("page-container-wide");
            $(".page-sidebar .x-navigation li.active").removeClass("active");


            $(".x-navigation-horizontal").each(function(){
                if(!$(this).hasClass("x-navigation-panel")){
                    $(".x-navigation-horizontal").addClass("x-navigation-h-holder").removeClass("x-navigation-horizontal");
                }
            });


        }else{
            if($(".page-navigation-toggled").length > 0){
                x_navigation_minimize("close");
            }

            $(".x-navigation-h-holder").addClass("x-navigation-horizontal").removeClass("x-navigation-h-holder");
        }

    }

    function x_navigation_minimize(action){

        if(action == 'open'){
            $(".page-container").removeClass("page-container-wide");
            $(".page-sidebar .x-navigation").removeClass("x-navigation-minimized");
            $(".x-navigation-minimize").find(".fa").removeClass("fa-indent").addClass("fa-dedent");
            $(".page-sidebar.scroll").mCustomScrollbar("update");
        }

        if(action == 'close'){
            $(".page-container").addClass("page-container-wide");
            $(".page-sidebar .x-navigation").addClass("x-navigation-minimized");
            $(".x-navigation-minimize").find(".fa").removeClass("fa-dedent").addClass("fa-indent");
            $(".page-sidebar.scroll").mCustomScrollbar("disable",true);
        }

        $(".x-navigation li.active").removeClass("active");

    }

    function x_navigation(){

        $(".x-navigation-control").click(function(){
            $(this).parents(".x-navigation").toggleClass("x-navigation-open");

            onresize();

            return false;
        });

        if($(".page-navigation-toggled").length > 0){
            x_navigation_minimize("close");
        }

        $(".x-navigation-minimize").click(function(){

            if($(".page-sidebar .x-navigation").hasClass("x-navigation-minimized")){
                $(".page-container").removeClass("page-navigation-toggled");
                x_navigation_minimize("open");
            }else{
                $(".page-container").addClass("page-navigation-toggled");
                x_navigation_minimize("close");
            }

            onresize();

            return false;
        });

        $(".x-navigation  li > a").click(function(){

            var li = $(this).parent('li');
            var ul = li.parent("ul");

            ul.find(" > li").not(li).removeClass("active");

        });

        $(".x-navigation li").click(function(event){
            event.stopPropagation();

            var li = $(this);

            if(li.children("ul").length > 0 || li.children(".panel").length > 0 || $(this).hasClass("xn-profile") > 0){
                if(li.hasClass("active")){
                    li.removeClass("active");
                    li.find("li.active").removeClass("active");
                }else
                    li.addClass("active");

                onresize();

                if($(this).hasClass("xn-profile") > 0)
                    return true;
                else
                    return false;
            }
        });

        /* XN-SEARCH */
        $(".xn-search").on("click",function(){
            $(this).find("input").focus();
        })
        /* END XN-SEARCH */

    }
    /* EOF X-NAVIGATION CONTROL FUNCTIONS */

    /* PAGE ON RESIZE WITH TIMEOUT */
    function onresize(timeout){
        timeout = timeout ? timeout : 200;

        setTimeout(function(){
            page_content_onresize();
        },timeout);
    }
    /* EOF PAGE ON RESIZE WITH TIMEOUT */
</script>
</html>