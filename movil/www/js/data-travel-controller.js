'use strict';
angular.module("app-main")
.controller('DataTravelController', function($scope, $http, LxDialogService){
    //Datos generales
    $scope.$parent.title = "Datos del viaje";
    $scope.section = 'Datos generales';
    $scope.dialogIdInicio = 'dialog-inicio';
    $scope.dialogIdFin = 'dialog-fin';
    $scope.autocompleteIcon = 'map-marker-radius';
    $scope.part3 = 33;
    $scope.activeTab = 0;
    $scope.Travel = {};
    $scope.hours = [];
    $scope.minutes = [];
    $scope.types = [];
    $scope.minDate = new Date();

    // Cargar campos del formulario
    $http.get($scope.$parent.url_server+'options-time')
    .then(function(success) {
        $scope.hours = success.data.hours;
        $scope.minutes = success.data.minutes;
        $scope.types = success.data.time;
        cargarFormulario();
    }, function(error) {
        console.log(error);
    });
    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    /////// FUNCIONES
    $scope.saveTravel = function(){
        $http.post($scope.$parent.url_server+'create-travel', data).then(function(success) {
            var data = success.data;
            $scope.travels = data;
        }, function(error) {
            console.log(error);
        });
    };
    $scope.openDialog = function(id){
        if($scope.dialogIdInicio && id == $scope.dialogIdInicio){
            LxDialogService.open($scope.dialogIdInicio);
        }
        if($scope.dialogIdFin && id == $scope.dialogIdFin){
            LxDialogService.open($scope.dialogIdFin);
        }
    }
    $scope.closeDialog = function(id){
        if($scope.dialogIdInicio && id == $scope.dialogIdInicio){
            LxDialogService.close($scope.dialogIdInicio);
        }
        if($scope.dialogIdFin && id == $scope.dialogIdFin){
            LxDialogService.close($scope.dialogIdFin);
        }
    }

    function cargarFormulario(){
        $scope.Travel.type = 'am';
        var d = new Date();
        var hour = d.getHours();
        var minutes = d.getMinutes();
        // hour = 12;
        // minutes = 57;
        //Configurar horas
        if(hour > 11){
            $scope.Travel.type = 'pm';
            if(hour > 12){
                hour = hour - 12;
            }
        }else if(hour == 0){
            hour = 12;
        }
        //Configurar minutos
        var faltante = 5 - (minutes % 5);
        var minutes = minutes + faltante;
        if(minutes == 60){
            minutes = 0;
            if(hour == 12){
                hour = 1;
            }else{
                hour = hour + 1
            }
        }
        $scope.Travel.date = d;
        $scope.Travel.hour = addZero(hour);
        $scope.Travel.minute = addZero(minutes);
    }
    $scope.autocomplete = autocomplete;
    $scope.displaySelectedValue = displaySelectedValue;
    $scope.searchFilter = {
        first: undefined,
        second: undefined,
        third: undefined,
        fourth: undefined,
        fifth: undefined,
        sixth: undefined,
        autocomplete: undefined
    };
    function autocomplete(_newValue, _cb, _errCb){
        if (_newValue){
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': _newValue}, function(results, status) {
                if (status === 'OK') {
                    console.log(results);
                    // for (var i = 0; i < results.length; i++) {
                    //     results[i]
                    // }
                    // resultsMap.setCenter(results[0].geometry.location);
                    // var marker = new google.maps.Marker({
                    //     map: resultsMap,
                    //     position: results[0].geometry.location
                    // });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
            // $http.get('http://www.omdbapi.com/?s=' + escape(_newValue)).then(function updateSuccess(response){
            //     $timeout(function(){
            //         var items = [];
            //         vm.autocompleteIcon = undefined;
            //         if (response.data && response.data.Search){
            //             items = response.data.Search.map(function(object) { return object.Title; });
            //         }
            //         _cb(items);
            //     }, 1000);
            // })
            // .catch(function updateError(){
            //     _errCb('Error');
            // });
        }else{
            //vm.autocompleteIcon = 'clock';
            _cb(['History 1', 'History 2',  'History 3']);
        }
    }
    function displaySelectedValue(_value){
        console.log(_value);
    }

});
