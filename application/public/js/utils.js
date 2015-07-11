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
			$this.html(event.strftime('Termina en : %H:%M:%S'));
		}).on('finish.countdown', function(event) {
			if(event.target.id){
				refreshOfertasDelDia();
			}
		})
	});
	$('.timeLimitOfertaCompra').each(function() {
		var $this = $(this), finalDate = $(this).data('countdown');
		$this.countdown(finalDate).on('update.countdown', function(event) {
			$this.html(event.strftime('Termina en : %H:%M:%S'));
		}).on('finish.countdown', function(event) {
			if(event.target.id){
				if(!isCategory){
					showErrorsForOfferInForm("__tituloOfertaSeleccionada", "__bodyOfertaSeleccionada", "__footerOfertaSeleccionada", "Lo sentimos la oferta ha expirado!");
				}else{
					window.location.reload();
				}
			}
		})
	});
};
function fixPriceImage(anchoVentana, altoVentana){
	if(anchoVentana && altoVentana){
		//Fix del ancho
		if(anchoVentana <= 320 && altoVentana <= 480){
			$(".imagenPrecio > h4").css("right", "33%");
			$(".imagenPrecio > h4").css("font-size", "55%");
			$(".imagenPrecio > h5").css("right", "33%");
			$(".imagenPrecio > h5").css("font-size", "50%");
			
			$(".imagenPrecio > h4").css("top", "63%");
			$(".imagenPrecio > h5").css("top", "70%");
		}else if(anchoVentana <= 360 && altoVentana <= 640){
			$(".imagenPrecio > h4").css("right", "35%");
			$(".imagenPrecio > h4").css("font-size", "65%");
			$(".imagenPrecio > h5").css("right", "35%");
			$(".imagenPrecio > h5").css("font-size", "55%");
			
			$(".imagenPrecio > h4").css("top", "61%");
			$(".imagenPrecio > h5").css("top", "68%");
		}else if(anchoVentana <= 768 && altoVentana <= 1024){
			$(".imagenPrecio > h4").css("right", "36%");
			$(".imagenPrecio > h4").css("font-size", "75%");
			$(".imagenPrecio > h5").css("right", "36%");
			$(".imagenPrecio > h5").css("font-size", "65%");
			
			$(".imagenPrecio > h4").css("top", "60%");
			$(".imagenPrecio > h5").css("top", "65%");
		}else if(anchoVentana <= 800 && altoVentana <= 1280){
			$(".imagenPrecio > h4").css("right", "36%");
			$(".imagenPrecio > h4").css("font-size", "60%");
			$(".imagenPrecio > h5").css("right", "36%");
			$(".imagenPrecio > h5").css("font-size", "65%");
			
			$(".imagenPrecio > h4").css("top", "59%");
			$(".imagenPrecio > h5").css("top", "63%");
		}else if(anchoVentana <= 980 && altoVentana <= 1280){
			$(".imagenPrecio > h4").css("right", "32%");
			$(".imagenPrecio > h4").css("font-size", "75%");
			$(".imagenPrecio > h5").css("right", "32%");
			$(".imagenPrecio > h5").css("font-size", "65%");
			
			$(".imagenPrecio > h4").css("top", "68%");
			$(".imagenPrecio > h5").css("top", "75%");
		}else if(anchoVentana <= 1280){
			$(".imagenPrecio > h4").css("right", "50%");
			$(".imagenPrecio > h4").css("font-size", "130%");
			$(".imagenPrecio > h5").css("right", "50%");
			$(".imagenPrecio > h5").css("font-size", "100%");
			
			$(".imagenPrecio > h4").css("top", "72%");
			$(".imagenPrecio > h5").css("top", "82%");
		}else{
			$(".imagenPrecio > h4").css("right", "49%");
			$(".imagenPrecio > h4").css("font-size", "130%");
			$(".imagenPrecio > h5").css("right", "49%");
			$(".imagenPrecio > h5").css("font-size", "100%");
			
			$(".imagenPrecio > h4").css("top", "70%");
			$(".imagenPrecio > h5").css("top", "80%");
		}
	}
};
function mostrarErrores(idContainer, errores){
	if(errores){
		var divError = $("<div>").attr("class", "alert alert-danger").attr("role", "alert");
		var htmlError = "";
		if(Object.prototype.toString.call(errores) === '[object Array]'){
			for(var i = 0; i < errores.length; i++){
				htmlError = htmlError + errores[i] + "<br>";
			}
		}else{
			htmlError = htmlError + errores;
		}
		divError.html(htmlError);
		$("#" + idContainer).html(divError);
	}
};
function showErrorsForOfferInForm(idTitle, idBody, idFooter, errores){
	if(idTitle && idBody && idFooter && errores){
		var h3 = $("<h3>").attr("class", "panel-title text-center").html("Error!");
		var divTitle = $("#" + idTitle).html(h3);
		mostrarErrores(idBody, errores);
		var button = $("<button>").attr("type", "button").attr("style", "display:inherit;").attr("class", "btn btn-default").html("Aceptar");
		var aLink = $("<a>").attr("href", __ROOT).html(button);
		var divButtons = $("<div>").attr("class", "text-center").html(aLink);
		$("#" + idFooter).html(divButtons);
	}
};