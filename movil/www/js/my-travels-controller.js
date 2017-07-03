angular.module("app-main")
.controller('MyTravelsController', function($scope, $http){
    $scope.$parent.title = "Mis viajes";
    $scope.$parent.nav_bar_visible = false;
    $scope.$parent.fondo = '';
    $scope.travels = [{
        c01_start_date:'2017-04-02 00:00:00'
    }];
    $http.get($scope.$parent.url_server+'travel-index')
    .then(function(success) {
        var data = success.data;
        $scope.travels = data;
    }, function(error) {
        console.log(error);
    });
});
