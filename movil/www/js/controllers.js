angular.module("app-main")
.controller('RegisterController', function ($scope, $location, $http) {
    $scope.app_name = 'TOGET';
    $scope.section = 'Viaja con tu número';
    $scope.sub_title = '';
    $scope.$parent.nav_bar_visible = false;

    $scope.data = {};
    $scope.data.phone = '';

    $scope.savePost = function () {
        $location.path("/confirm");
    }
})
.controller('SignupController', function($scope){
    $scope.section = 'Ingresa tus datos';
    $scope.$parent.nav_bar_visible = false;
    $scope.states = [
        {
            id: 2,
            name: 'Zacatecas'
        },
        {
            id: 1,
            name: 'Aguascalientes'
        }
    ];
})
.controller('MenuController', function($scope){

})
.controller('ConfirmController', function($scope, $location, $http){
    $scope.app_name = 'TOGET';
    $scope.section = 'Ingresa tu código';
    $scope.sub_title = '';
    $scope.$parent.nav_bar_visible = false;

    $scope.data = {};

    $scope.savePost = function () {
        $location.path("/signup");
    }
    $scope.register = function () {
        $location.path('/register');
    }

    // window.cordovaOauth = $cordovaOauth;
    // window.http = $http;
    // $scope.data = {};
    // $scope.login = function(){
    //     $cordovaOauth.facebook("297106894072581", ["email", "public_profile"], {redirect_uri: "http://localhost/callback"})
    //     .then(function(result){
    //         console.log(result);
    //         displayData($http, result.access_token);
    //     },  function(error){
    //         console.log(error);
    //     });
    // }
    // function displayData($http, access_token){
    //     $http.get("https://graph.facebook.com/v2.5/me", {params: {access_token: access_token, fields: "cover,name,first_name,last_name,age_range,locale,gender,location,picture", format: "json" }})
    //     .then(function(result) {
    //         console.log(result);
    //         $scope.data.name = result.data.name;
    //         $scope.data.gender = result.data.gender;
    //         $scope.data.picture = result.data.picture;
    //     }, function(error) {
    //         alert("Error: " + error);
    //     });
    // }
    //$cordovaOauth.facebook('297106894072581', ['email'], object options);
});
