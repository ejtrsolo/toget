angular.module("app-main")
.controller('NotificationsController', function($scope, $http, $timeout, LxNotificationService){
    $scope.$parent.title = "Notificaciones";
    var imagePath = 'img/logo.png';
    $scope.$parent.nav_bar_visible = false;
    $scope.$parent.fondo = '';
    $scope.todos = [
        {
            face : imagePath,
            who: "Aceptación de viaje",
            notes: '<b>Ernesto Troncoso</b> te aceptó en el viaje <b>Guadalupe - Aguascalientes</b>',
            when: '3:08PM'
        },
        {
            face : imagePath,
            who: "Mensaje",
            notes: 'Tienes un mensaje de <b>Carlos Mendoza</b> del viaje <b>Aguascalientes - Zacatecas</b>',
            when: '3:08PM'
        }
    ];
});
