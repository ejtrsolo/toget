angular.module("app-main")
.controller('HomeController', function($scope, $resource, NgMap){

    //AIzaSyCUcvGAX-s1qleVcwawNUFaJwrklWt7oMg
    $scope.googleMapsUrl="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUcvGAX-s1qleVcwawNUFaJwrklWt7oMg";
    $scope.alto = screen.height - 180;
    //$("ng-map").attr('style', 'height: ' + (screen.height-100) + ' !important;');

    NgMap.getMap().then(function(map) {
        console.log(map.getCenter());
        //console.log('markers', map.markers);
        //console.log('shapes', map.shapes);
    });

})
.controller('RegisterController', function ($scope, $location) {
    $scope.app_name = 'TOGET';
    $scope.section = 'Muevete con nosotros';
    $scope.sub_title = '';
    $scope.$parent.nav_bar_visible = false;

    $scope.data = {};
    $scope.data.phone = '';

    $scope.savePost = function () {
        $location.path("/");
    }
})
.controller('MenuController', function($scope){

})
.controller('ProfileController', function($scope, $cordovaOauth, $http){
    window.cordovaOauth = $cordovaOauth;
    window.http = $http;
    $scope.data = {};
    $scope.login = function(){
        $cordovaOauth.facebook("297106894072581", ["email", "public_profile"], {redirect_uri: "http://localhost/callback"})
        .then(function(result){
            console.log(result);
            displayData($http, result.access_token);
        },  function(error){
            console.log(error);
        });
    }
    function displayData($http, access_token){
        $http.get("https://graph.facebook.com/v2.5/me", {params: {access_token: access_token, fields: "cover,name,first_name,last_name,age_range,locale,gender,location,picture", format: "json" }})
        .then(function(result) {
            console.log(result);
            $scope.data.name = result.data.name;
            $scope.data.gender = result.data.gender;
            $scope.data.picture = result.data.picture;
        }, function(error) {
            alert("Error: " + error);
        });
    }
    //$cordovaOauth.facebook('297106894072581', ['email'], object options);
});
