<!DOCTYPE html>
<html>
    <head>
        <title>Stations</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="station weatherstation weather meteo" />

        <!-- css -->
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="css/farm.css" rel='stylesheet' type='text/css' />
        <!-- //css -->
        <!-- fonts -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <!-- //fonts -->
        <!-- js -->
        <script src="js/all.js"></script>
        <script src="js/modernizr.custom.js"></script>
        <!-- //js -->
    </head>
    <body ng-app="app">
        <!--baner-->
        <div class="banner">
            <!-- container -->
            <div class="container">
                <div class="banner-top">
                    <div class="social">
                        <ul>
                            <li><a href="#" class="facebook"> </a></li>
                            <li><a href="#" class="facebook twitter"> </a></li>
                            <li><a href="#" class="facebook chrome"> </a></li>
                            <li><a href="#" class="facebook dribbble"> </a></li>
                        </ul>
                    </div>
                    <div class="header-top-right">
                            <div ng-if="authenticated" style="color: white">
                                Welcome, <a ui-sref="userDetails({ id: currentUser.id })" > {{ currentUser.name }} </a>
                            </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <!-- //container -->
        </div>
        <!--//baner-->
        <div class="top-nav">
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="logo">
                            <h1><a href="index.html">Weather</a></h1>
                        </div>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-center">
                            <li><a ng-class="{ active: isActive('/') }" href="index.html">Home</a></li>
                            <li><a ng-class="{ active: isActive('/') }" href="about.html">About</a></li>
                            <li><a href="codes.html">Codes</a></li>
                            <li><a href="index.html">Services</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </nav>
        </div>
        <!--navigation-->
        <!-- gallery -->
        <div class="gallery-top">
            <!-- container -->
            <div class="container">
                <div ui-view></div>
            </div>
            <!-- //container -->
        </div>
        <!-- //gallery -->
        <!-- footer -->
        <div class="footer">
            <!-- container -->
            <div class="container">
                <div class="footer-grids">
                    <div class="col-md-4 footer-grid">
                        <div class="footer-grid-info">
                            <h3>Popular</h3>
                        </div>
                        <div class="footer-grid-list">
                            <ul>
                                <li><a href="#">Proin placerat ipsum et rutrum</a></li>
                                <li><a href="#">Vestibulum et ligula lectus	</a></li>
                                <li><a href="#">Praesent in augue ut purus</a></li>
                                <li><a href="#">Proin semper ut ligula sit amet</a></li>
                                <li><a href="#">Vestibulum hendrerit lacus ut mi</a></li>
                                <li><a href="#">Fusce sollicitudin nunc est</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 footer-grid">
                        <div class="footer-grid-info">
                            <h3>Address</h3>
                        </div>
                        <div class="footer-grid-list">
                            <h4>Headquarters</h4>
                            <p>123 T. Globel Place.
                                <span>CG 09-123</span>
                                New York, Ba. 4567
                            </p>
                            <h4>Get In Touch</h4>
                            <p>Telephone : +1 234 567 9871
                                <span>FAX : +1 234 567 9871</span>
                                E-mail : <a href="mailto:info@example.com">mail@example.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 footer-grid">
                        <div class="footer-grid-info">
                            <h3>Stay in touch</h3>
                        </div>
                        <div class="footer-grid-list">
                            <form>
                                <input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- //footer -->
        <!-- copyright -->
        <div class="copyright">
            <!-- container -->
            <div class="container">
                <p>© 2015 Edible . All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
            </div>
            <!-- /container -->
        </div>
        <!-- //copyright -->
    </body>
</html>