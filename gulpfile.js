var gulp = require('gulp');
var bower = require('gulp-bower');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var watch = require('gulp-watch');

var paths = {
    scripts: [
        'public/app/app.js',
        'public/app/Directives/Directives.js',
        'public/app/Controllers/AuthController.js',
        'public/app/Controllers/LatestDataController.js',
        'public/app/Controllers/UserDetailsController.js',
        'public/app/Controllers/UserStationsController.js',
        'public/app/Controllers/EditStationController.js',
        'public/app/Controllers/CreateStationController.js',
        'public/app/Controllers/StationWeathersController.js',
        'public/app/Controllers/ChartsController.js',
        'public/app/Controllers/DiseaseModelsController.js',
        'public/app/Controllers/CreateDiseaseModelController.js',
        'public/app/Controllers/EditDiseaseModelController.js',
        'public/app/Controllers/NotificationsController.js',
        'public/app/Controllers/FollowController.js',
        'public/app/Services/ApiService.js'
    ]
};

gulp.task('init', function() {
    bower()
        .pipe(gulp.dest('resources/lib/'))
});

gulp.task('scripts', function(){
    gulp.src(['resources/lib/jquery/dist/jquery.min.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js',
        'resources/lib/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/translation.js',
        'resources/lib/angular/angular.js',
        'resources/lib/angular-ui-router/release/angular-ui-router.js',
        'resources/lib/satellizer/satellizer.js',
        'resources/lib/angular-flash/dist/angular-flash.js',
        'resources/lib/angular-aria/angular-aria.js',
        'resources/lib/angular-animate/angular-animate.js',
        'resources/lib/angular-material/angular-material.js',
        'resources/lib/angular-loading-bar/src/loading-bar.js',
        'resources/lib/angular-material-data-table/dist/md-data-table.js',
        'resources/lib/highcharts/highcharts.src.js',
        'resources/lib/highcharts-ng/dist/highcharts-ng.js',
        'resources/lib/moment/moment.js',
        'resources/lib/smDateTimeRangePicker/src/picker.js',
        'public/app/app.js',
        'public/app/Services/ApiService.js',
        'public/app/Directives/Directives.js',
        'public/app/Controllers/AuthController.js',
        'public/app/Controllers/LatestDataController.js',
        'public/app/Controllers/UserDetailsController.js',
        'public/app/Controllers/UserStationsController.js',
        'public/app/Controllers/EditStationController.js',
        'public/app/Controllers/CreateStationController.js',
        'public/app/Controllers/StationWeathersController.js',
        'public/app/Controllers/DiseaseModelsController.js',
        'public/app/Controllers/CreateDiseaseModelController.js',
        'public/app/Controllers/EditDiseaseModelController.js',
        'public/app/Controllers/NotificationsController.js',
        'public/app/Controllers/FollowController.js',
        'public/app/Controllers/ChartsController.js'
    ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('public/js'));
});

gulp.task('css', function() {
    gulp.src(['resources/css/style.scss',
        'resources/lib/angular-material/angular-material.scss',
        'resources/lib/smDateTimeRangePicker/app/styles/*.scss'
    ])
        .pipe(sass())
        .pipe(concat('style.css'))
        .pipe(gulp.dest('public/css'));
});

gulp.task('watch', function() {
    gulp.watch(paths.scripts, ['scripts']);
});