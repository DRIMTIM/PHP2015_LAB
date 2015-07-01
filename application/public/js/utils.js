function clearAllInputs(){
	var inputs = document.getElementsByTagName("input");
	for(var i = 0; i < inputs.length; i++){
		var input = inputs[i];
		input.value = "";
	}
};
function isMobile(){
	var dispositivo = navigator.userAgent.toLowerCase();
	if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){return true;}
	return false;
};
function buildCountDown(){
	$('.timeLimitOferta').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate).on('update.countdown', function(event) {
			$this.html(event.strftime('Tiempo restante : %H:%M:%S'));
		}).on('finish.countdown', function(event) {
			if(event.target.id){
				refreshOfertasDelDia();
			}
		})
	});
};
function fixPriceImage(anchoVentana, altoVentana){
	if(anchoVentana && altoVentana){
		//Fix del ancho
		if(anchoVentana <= 320){
			$(".imagenPrecio > h4").css("right", "33%");
			$(".imagenPrecio > h4").css("font-size", "55%");
			$(".imagenPrecio > h5").css("right", "33%");
			$(".imagenPrecio > h5").css("font-size", "50%");
		}else if(anchoVentana > 320 && anchoVentana <= 360){
			$(".imagenPrecio > h4").css("right", "35%");
			$(".imagenPrecio > h4").css("font-size", "65%");
			$(".imagenPrecio > h5").css("right", "35%");
			$(".imagenPrecio > h5").css("font-size", "55%");
		}else if(anchoVentana > 360 && anchoVentana <= 768){
			$(".imagenPrecio > h4").css("right", "32%");
			$(".imagenPrecio > h4").css("font-size", "75%");
			$(".imagenPrecio > h5").css("right", "32%");
			$(".imagenPrecio > h5").css("font-size", "65%");
		}else if(anchoVentana > 768 && anchoVentana <= 800){
			$(".imagenPrecio > h4").css("right", "32%");
			$(".imagenPrecio > h4").css("font-size", "75%");
			$(".imagenPrecio > h5").css("right", "32%");
			$(".imagenPrecio > h5").css("font-size", "65%");
		}else if(anchoVentana > 800 && anchoVentana <= 980){
			$(".imagenPrecio > h4").css("right", "32%");
			$(".imagenPrecio > h4").css("font-size", "75%");
			$(".imagenPrecio > h5").css("right", "32%");
			$(".imagenPrecio > h5").css("font-size", "65%");
		}else{
			$(".imagenPrecio > h4").css("right", "50%");
			$(".imagenPrecio > h4").css("font-size", "130%");
			$(".imagenPrecio > h5").css("right", "50%");
			$(".imagenPrecio > h5").css("font-size", "100%");
		}
		//Fix del alto
		if(altoVentana <= 480){
			$(".imagenPrecio > h4").css("top", "63%");
			$(".imagenPrecio > h5").css("top", "70%");
		}else if(altoVentana > 480 && altoVentana <= 640){
			$(".imagenPrecio > h4").css("top", "61%");
			$(".imagenPrecio > h5").css("top", "68%");
		}else if(altoVentana > 640 && altoVentana <= 1024){
			$(".imagenPrecio > h4").css("top", "70%");
			$(".imagenPrecio > h5").css("top", "78%");
		}else if(altoVentana > 1024 && altoVentana <= 1280){
			$(".imagenPrecio > h4").css("top", "70%");
			$(".imagenPrecio > h5").css("top", "78%");
		}else{
			$(".imagenPrecio > h4").css("top", "61%");
			$(".imagenPrecio > h5").css("top", "68%");
		}
		//Fix del alto de resoluciones especiales
		if(anchoVentana >= 1280){
			$(".imagenPrecio > h4").css("top", "70%");
			$(".imagenPrecio > h5").css("top", "78%");
		}
	}
};