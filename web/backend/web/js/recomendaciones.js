cambiar();
$('#recomendaciones-r01_repeticion_tiempo').change(function(){
	cambiar();
});

function cambiar(){
	if($('#recomendaciones-r01_repeticion_tiempo').val()==7){
		$('.field-recomendaciones-r01_fecha_fin').hide();
	}else{
		$('.field-recomendaciones-r01_fecha_fin').show();
	}
}