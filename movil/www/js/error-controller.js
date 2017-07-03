angular.module("app-main")
.controller('NotificationsController', function($scope, $http, $routeParams){
    $scope.$parent.title = "Notificaciones";
    $scope.$parent.nav_bar_visible = false;
    $scope.$parent.fondo = '';
    $scope.error = $routeParams.error;
});
