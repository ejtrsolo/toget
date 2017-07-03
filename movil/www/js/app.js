angular.module("app-main", ["lumx", "ngRoute", "ngResource", 'ui.mask', 'ngMaterial', 'ngSanitize'])
.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}])
.config(function($mdThemingProvider) {
	$mdThemingProvider.theme('default')
		.primaryPalette('green')
		.accentPalette('orange');
})
.config(function($routeProvider){
	$routeProvider
        .when("/", {
            controller: "HomeController",
            templateUrl: "template/home.html"
        })
        .when("/my-travels", {
            controller: "MyTravelsController",
            templateUrl: "template/my-travels.html"
        })
		.when("/new-travel", {
			controller: "NewTravelController",
			templateUrl: "template/new.html"
		})
		.when("/search", {
			controller: "SearchController",
			templateUrl: "template/search.html"
		})
		.when("/messages", {
			controller: "MessagesController",
			templateUrl: "template/messages.html"
		})
		.when("/messages/:id", {
			controller: "ViewMessagesController",
			templateUrl: "template/view-messages.html"
		})
		.when("/profile", {
			controller: "ProfileController",
			templateUrl: "template/profile.html"
		})
		.when("/settings", {
			controller: "SettingsController",
			templateUrl: "template/settings.html"
		})
		.when("/notifications", {
			controller: "NotificationsController",
			templateUrl: "template/notifications.html"
		})
		.when("/data-travel", {
			controller: "DataTravelController",
			templateUrl: "template/data-travel.html"
		})
        .when("/confirm", {
            controller: "ConfirmController",
            templateUrl: "template/confirm.html"
        })
        .when("/signup", {
            controller: "SignupController",
            templateUrl: "template/signup.html"
        })
        .when("/register", {
            controller: "RegisterController",
            templateUrl: "template/register.html"
        })
        .when("/error/:error"){
            controller: "ErrorController",
            templateUrl: "template/error.html"
        }
        .otherwise("/error");

})
;
