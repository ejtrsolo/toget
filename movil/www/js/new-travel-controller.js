angular.module("app-main")
.controller('NewTravelController', function($scope, $http, $timeout, LxNotificationService){
    // Cambiar titulo a toolbar
    $scope.$parent.title = "Nuevo viaje";
    // Tamaño del mapa de google
    $scope.alto = screen.height - 150;
    // Quitar fondo de imagen en aplicación.
    $scope.$parent.fondo = '';
    // Ícono para todos los marcadores.
    $scope.icon = {
        url: 'img/icons/pin-3.png',
    };
    // Declarar valores de inicio como vacíos.
    $scope.Travel = {
        c01_start_lat: '',
        c01_end_lat: ''
    };
    // Iniciar mapa de Google Maps
    initMap();
    // Obtener la posición actual.
    navigator.geolocation.getCurrentPosition(function (position) {
        $scope.Travel.c01_start_lat = position.coords.latitude;
        $scope.Travel.c01_start_lng = position.coords.longitude;
        // Buscar ubicación del punto en donde estoy.
        var myLatlng = new google.maps.LatLng($scope.Travel.c01_start_lat, $scope.Travel.c01_start_lng);
        geocoder.geocode({'location': myLatlng}, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    map.setZoom(15);
                    $scope.inicio = results[0].formatted_address;
                    $scope.items = [$scope.inicio];
                    $scope.Travel.inicio = results[0].formatted_address;
                }
            }
        });
        // $scope.Travel.inicio = $scope.inicio;
        map.setCenter(myLatlng);
        markerInicio.setPosition(myLatlng);
        $scope.Travel.c01_start_lat = myLatlng.lat();
        $scope.Travel.c01_start_lng = myLatlng.lng();
    }, function (error) {
        console.log(error);
    }, { timeout: 30000 });
    function initMap() {
        var mexico = {lat: 22.746943, lng: -102.518532};
        directionsDisplay = new google.maps.DirectionsRenderer({ polylineOptions: { strokeColor: "#8b0013" } });
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: mexico,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            streetViewControl: false,
            fullscreenControl: false,
            zoomControl: false
        });
        directionsDisplay.setMap(map);
        directionsDisplay.setOptions({ suppressMarkers: true });
        markerInicio = new google.maps.Marker({
            position: uluru,
            map: map,
            title: 'Inicio',
            draggable:true,
            icon: $scope.icon
        });
        google.maps.event.addListener(markerInicio, 'click', function(){
            geocoder.geocode({'location': markerInicio.getPosition()}, function(results, status) {
                if (status === 'OK') {
                    //console.log(results[0]);
                    if (results[0]) {
                        //map.setZoom(15);
                        $scope.Travel.c01_start_lat = results[0].geometry.location.lat();
                        $scope.Travel.c01_start_lng = results[0].geometry.location.lng();
                        $scope.inicio = results[0].formatted_address;
                        $scope.items = [$scope.inicio];
                        $scope.Travel.inicio = results[0].formatted_address;
                    }
                }
            });
            if($scope.Travel.c01_end_lat!=''){
                var fin = new google.maps.LatLng($scope.Travel.c01_end_lat, $scope.Travel.c01_end_lng);
                calculateAndDisplayRoute(markerInicio.getPosition(), fin);
            }
        });
    }
    $scope.checkPoints = function(){
        // var inicio = new google.maps.LatLng($scope.Travel.c01_start_lat, $scope.Travel.c01_start_lng);
        // var fin = new google.maps.LatLng($scope.Travel.c01_end_lat, $scope.Travel.c01_end_lng);
        // calculateAndDisplayRoute(inicio, fin);
        return true;
    }
    //BUSCADORES de direcciones
    $scope.autocomplete = function (_newValue, _cb, _errCb){
        pointsList(1, _newValue, _cb, _errCb);
    };
    $scope.autocomplete2 = function (_newValue, _cb, _errCb){
        pointsList(2, _newValue, _cb, _errCb);
    };
    $scope.displaySelectedValue = displaySelectedValue;
    $scope.displaySelectedValue2 = displaySelectedValue2;
    $scope.autocompleteIcon = 'map-marker-radius';
    $scope.results = [];
    $scope.results2 = [];
    $scope.items = [];
    $scope.items2 = [];
    function calculateAndDisplayRoute(point1, point2) {
        directionsService.route({
            origin: point1,  // .
            destination: point2,  //
            travelMode: 'DRIVING', //,
            drivingOptions: {
                departureTime: new Date(Date.now() + 500),  // for the time N milliseconds from now.
                trafficModel: 'optimistic'
            }
        }, function(response, status) {
            if (status == 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                console.log('Directions request failed due to ' + status);
            }
        });
    }
    function pointsList(type, _newValue, _cb, _errCb){
        var items = [];
        if(type == 1){ //Si es el inicio
            items = $scope.items;
        }else{ // Si es el termino
            items = $scope.items2;
        }
        if (_newValue){
            if(items.indexOf(_newValue) == -1){
                geocoder.geocode({'address': _newValue}, function(results, status) {
                    if (status === 'OK') {
                        $timeout(function(){
                            //console.log(type);
                            if(type == 1){
                                $scope.results = results;
                            }else {
                                $scope.results2 = results;
                                //console.log($scope.results2);
                            }
                            items = [];
                            for (var i = 0; i < results.length; i++) {
                                items.push(results[i].formatted_address);
                            }
                            if(type == 1){
                                $scope.items = items;
                            }else {
                                $scope.items2 = items;
                            }
                            _cb(items);
                        }, 1000);
                    } else {
                        _errCb('Error al buscar dirección, intenta otra vez.');
                        console.log('Error: '+status);
                    }
                });
            }
        }else{
            _cb(items);
        }
    }
    function displaySelectedValue(_value){
        console.log($scope.items);
        console.log($scope.results);
        var pos = $scope.items.indexOf(_value);
        var punto = $scope.results[pos].geometry.location;
        map.setCenter(punto);
        map.setZoom(15);
        markerInicio.setPosition(punto);
        $scope.Travel.c01_start_lat = punto.lat();
        $scope.Travel.c01_start_lng = punto.lng();
        if($scope.Travel.c01_end_lat!=''){
            var fin = new google.maps.LatLng($scope.Travel.c01_end_lat, $scope.Travel.c01_end_lng);
            calculateAndDisplayRoute(punto, fin);
        }
    }
    function displaySelectedValue2(_value){
        var pos = $scope.items2.indexOf(_value);
        var punto = $scope.results2[pos].geometry.location;
        if(markerFin){
            markerFin.setPosition(punto);
        }else{
            markerFin = new google.maps.Marker({
                position: punto,
                map: map,
                draggable:true,
                icon: $scope.icon
            });
            google.maps.event.addListener(markerFin, 'click', function(){
                geocoder.geocode({'location': markerFin.getPosition()}, function(results, status) {
                    if (status === 'OK') {
                        //console.log(results[0]);
                        if (results[0]) {
                            //map.setZoom(15);
                            var position = results[0].geometry.location;
                            $scope.Travel.c01_end_lat = position.lat();
                            $scope.Travel.c01_end_lng = position.lng();
                            $scope.fin = results[0].formatted_address;
                            $scope.items2 = [$scope.fin];
                            $scope.Travel.fin = results[0].formatted_address;
                        }
                    }
                });
                var inicio = new google.maps.LatLng($scope.Travel.c01_start_lat, $scope.Travel.c01_start_lng);
                calculateAndDisplayRoute(inicio, markerFin.getPosition());
            });
        }
        $scope.Travel.c01_end_lat = punto.lat();
        $scope.Travel.c01_end_lng = punto.lng();
        var inicio = new google.maps.LatLng($scope.Travel.c01_start_lat, $scope.Travel.c01_start_lng);
        calculateAndDisplayRoute(inicio, punto);
    }
    function getBoundsZoomLevel(bounds, mapDim) {
        var WORLD_DIM = { height: 256, width: 256 };
        var ZOOM_MAX = 21;

        function latRad(lat) {
            var sin = Math.sin(lat * Math.PI / 180);
            var radX2 = Math.log((1 + sin) / (1 - sin)) / 2;
            return Math.max(Math.min(radX2, Math.PI), -Math.PI) / 2;
        }

        function zoom(mapPx, worldPx, fraction) {
            return Math.floor(Math.log(mapPx / worldPx / fraction) / Math.LN2);
        }

        var ne = bounds.getNorthEast();
        var sw = bounds.getSouthWest();

        var latFraction = (latRad(ne.lat()) - latRad(sw.lat())) / Math.PI;

        var lngDiff = ne.lng() - sw.lng();
        var lngFraction = ((lngDiff < 0) ? (lngDiff + 360) : lngDiff) / 360;

        var latZoom = zoom(mapDim.height, WORLD_DIM.height, latFraction);
        var lngZoom = zoom(mapDim.width, WORLD_DIM.width, lngFraction);

        return Math.min(latZoom, lngZoom, ZOOM_MAX);
    }
});
