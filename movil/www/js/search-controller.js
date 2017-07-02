angular.module("app-main")
.controller('SearchController', function($scope, $http){
    $scope.$parent.title = "Buscar viaje";
    $scope.$parent.fondo = '';
    $scope.$parent.credit = false;
    $scope.$parent.nav_bar_visible = true;
});
