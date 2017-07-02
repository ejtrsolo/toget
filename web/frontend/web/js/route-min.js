/**
 * Created by Ernesto on 25/08/2016.
 */
$(document).ready(function(){

    google.maps.event.addDomListener(window, 'load', initialize());
    var flightPath;
    var map;
    var marker;
    var points = [];
    var txt_route = '#routes-c01_route';
    initPoints();
    //var txt_route = '#txt-route';
    function initialize() {
        var lat = 22.7632058;
        var lng = -102.5516637;
        var mapProp = {
            center:new google.maps.LatLng(lat,lng),
            zoom:13,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        map=new google.maps.Map(document.getElementById("map"),mapProp);
        google.maps.event.addListener(map, 'click', function(event) {
            if($('#in-play').val()=='1'){
                placeMarker(event.latLng);
            }else{
                alert('Para ingresar la ruta dar clic en "Iniciar captura".');
            }
        });
    }
    function placeMarker(location) {
        pushPoint(location);
        if(points.length >1){
            removeLines();
        }
        if(points.length==1){
            marker=new google.maps.Marker({
                position: location,
                label: 'A'
            });
            marker.setMap(map);
        }
        flightPath=new google.maps.Polyline({
            path:points,
            strokeColor:"#0000FF",
            strokeOpacity:1,
            strokeWeight:4
        });

        flightPath.setMap(map);
    }
    function pushPoint(location){
        var txtroute = $(txt_route);
        points.push(location);
        txtroute.val(txtroute.val()+location.lat()+','+location.lng()+'+');
    }
    function removeLines() {
        flightPath.setMap(null);
    }
    function removeLastPoint(){
        var txtroute = $(txt_route);
        removeLines();
        points.splice(points.length-1, 1);
        txtroute.val('');
        for(var i=0; i < points.length; i++){
            txtroute.val(txtroute.val()+points[i].lat()+','+points[i].lng()+'+');
        }
        flightPath=new google.maps.Polyline({
            path:points,
            strokeColor:"#0000FF",
            strokeOpacity:1,
            strokeWeight:4
        });
        flightPath.setMap(map);
    }
    function removePoints(){
        for(var i = points.length - 1; i >= 0; i--) {
            points.splice(i, 1);
        }
        marker.setMap(null);
    }
    function initPoints(){
        var route = $(txt_route).val();
        var routes = route.split('+');
        for(var i = 0; i < routes.lenght; i++){
            var r = routes[i].split(',');
            var location = new google.maps.LatLng({lat: r[0], lng: r[1]});
            placeMarker(location);
        }
    }
    $('#btn-remove-all').click(function(){
        if($('#in-play').val()=='1') {
            var isConfirm = confirm('¿Estas seguro de borrar todos los puntos del mapa?');
            if(isConfirm){
                removeLines();
                removePoints();
                $(txt_route).val('');
            }
        }else{
            alert('Para eliminar todos los puntos dar clic en "Iniciar captura".');
        }
    });
    $('#btn-remove-last').click(function(){
        if($('#in-play').val()=='1'){
            if(points.length > 0){
                if(points.length==1){
                    marker.setMap(null);
                }
                removeLastPoint();
            }else{
                alert('No existe ningun punto para borrar');
            }
        }else{
            alert('Para eliminar último punto dar clic en "Iniciar captura".');
        }
    });

    $('#btn-play').click(function(){
        var inplay = $('#in-play');
        var lbplay = $('#lb-play');
        if(inplay.val()=='0'){
            inplay.val('1');
            $(this).html('<i class="fa fa-pause"></i>');
            lbplay.html('Pausar captura');
            $(this).attr('class','btn btn-primary');
        }else{
            inplay.val('0');
            $(this).html('<i class="fa fa-play"></i>');
            lbplay.html('Iniciar captura');
            $(this).attr('class','btn btn-info');
        }
        $(this).button('toggle');
    });


});
