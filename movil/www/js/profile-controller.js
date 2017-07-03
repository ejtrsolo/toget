angular.module("app-main")
.controller('ProfileController', function($scope, $http, $timeout, LxNotificationService){
    $scope.$parent.title = "Perfil";
    $scope.$parent.nav_bar_visible = false;
    $scope.$parent.fondo = '';
    $scope.todos = [];
});
