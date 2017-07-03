angular.module("app-main")
.controller('MessagesController', function($scope, $http, $timeout, LxNotificationService){
    $scope.$parent.title = "Mensajes";
    var imagePath = 'img/logo.png';
    $scope.todos = [
      {
        face : imagePath,
        //what: 'Brunch this weekend?',
        who: 'Min Li Chan',
        when: '3:08PM',
        notes: " I'll be in your neighborhood doing errands"
      },
      {
        face : imagePath,
        //what: 'Brunch this weekend?',
        who: 'Min Li Chan',
        when: '3:08PM',
        notes: " I'll be in your neighborhood doing errands"
      },
      {
        face : imagePath,
        //what: 'Brunch this weekend?',
        who: 'Min Li Chan',
        when: '3:08PM',
        notes: " I'll be in your neighborhood doing errands"
      },
      {
        face : imagePath,
        //what: 'Brunch this weekend?',
        who: 'Min Li Chan',
        when: '3:08PM',
        notes: " I'll be in your neighborhood doing errands"
      },
      {
        face : imagePath,
        //what: 'Brunch this weekend?',
        who: 'Min Li Chan',
        when: '3:08PM',
        notes: " I'll be in your neighborhood doing errands"
      },
    ];
})
.controller('ViewMessagesController', function($scope, $http, $routeParams, $location){
    $scope.$parent.title = "Perfil";
    $scope.$parent.nav_bar_visible = false;
    $scope.$parent.fondo = '';
    var id = $routeParams.id;
    $scope.loading = true;
    $http.get($scope.$parent.url_server+"app/messages?id="+id)
    .then(function(success) {
        //console.log(success);
        $scope.messages = success.data;
        $scope.loading = false;
    }, function(error) {
        $location.path("/error/1");
    });


});
