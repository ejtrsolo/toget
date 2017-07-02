angular.module("app-main")
.controller('SettingsController', function($scope, $http, $timeout, LxNotificationService){
    $scope.$parent.title = "Configuración";
});
