angular.module("app-main")
.controller('HomeController', function($scope, $http, $timeout, LxNotificationService){
    $scope.$parent.title = "Inicio";
    $scope.$parent.fondo = 'background-home background-image full-screen-background-image';
    $scope.$parent.credit = true;
    $scope.$parent.nav_bar_visible = true;
});
