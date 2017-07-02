angular.module("app-main",["lumx", "ngRoute", "ngResource", 'ui.mask', 'ngMap', 'ngMaterial', 'ngCordovaOauth'])
.config(function($routeProvider){
	$routeProvider
		.when("/", {
			controller: "HomeController",
			templateUrl: "template/home.html"
		})
		.when("/menu", {
			controller: "MenuController",
			templateUrl: "template/menu.html"
		})
		.when("/profile", {
			controller: "ProfileController",
			templateUrl: "template/profile.html"
		})
		.when("/register", {
			controller: "RegisterController",
			templateUrl: "template/register.html"
		});

})
.config(function($mdThemingProvider) {
	$mdThemingProvider.theme('default')
		.primaryPalette('green')
		.accentPalette('orange');
})
.controller('main', function ($scope, $timeout, $mdSidenav, $log) {
	$scope.title = "Inicio";
	$scope.nav_bar_visible = true;
	$scope.openNavBar = function () {
        // Component lookup should always be available since we are not using `ng-if`
        if(!$mdSidenav('left').isOpen()){
            $mdSidenav('left').open().then(function () {
                //$log.debug("open LEFT is done");
            });
        }
    };
    //$scope.toggleRight = buildToggler('right');
    $scope.closeNavBar = function () {
      // Component lookup should always be available since we are not using `ng-if`
      if($mdSidenav('left').isOpen()){
          $mdSidenav('left').close().then(function () {
              //$log.debug("close LEFT is done");
          });
      }
    };
});
.controller('MainController', function ($scope, $cordovaOauth, $http) {
	$scope.title = "Inicio";
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
});
