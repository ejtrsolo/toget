angular.module("app-main")
.controller('main', function ($scope, $timeout, $mdSidenav, $log, $location) {
	$scope.title = "Inicio";
	$scope.nav_bar_visible = true;
	$scope.fondo = '';
	$scope.credit = false;
	$scope.url_server = 'http://localhost/proyects/yiired/app/';
	$scope.user = {};
	$scope.user.name = "Ernesto";
	$scope.user.photo = "img/logo.png";
	$scope.openNavBar = function () {
        // Component lookup should always be available since we are not using `ng-if`
        if(!$mdSidenav('left').isOpen()){
            $mdSidenav('left').open().then(function () {
                //$log.debug("open LEFT is done");
            });
        }
    };
    $scope.closeNavBar = function () {
      // Component lookup should always be available since we are not using `ng-if`
      if($mdSidenav('left').isOpen()){
          $mdSidenav('left').close().then(function () {
              //$log.debug("close LEFT is done");
          });
      }
    };
    $scope.menuHome = function () {
        $scope.closeNavBar();
        $location.path("/");
    };
    $scope.menuMyTravels = function () {
        $scope.closeNavBar();
        $location.path("/my-travels");
    };
    $scope.loadTravels = function () {
        $scope.closeNavBar();
        $location.path("/profile");
    };
    $scope.menuNewTravel = function () {
		$scope.closeNavBar();
		$location.path("/new-travel");
    };
    $scope.menuSearch = function () {
		$scope.closeNavBar();
		$location.path("/search");
    };
    $scope.menuMessages = function () {
		$scope.closeNavBar();
		$location.path("/messages");
    };
    $scope.menuProfile = function () {
		$scope.closeNavBar();
		$location.path("/profile");
    };
    $scope.menuSettings = function () {
		$scope.closeNavBar();
		$location.path("/settings");
    };
    $scope.menuNotifications = function () {
		$scope.closeNavBar();
		$location.path("/notifications");
    };
});
