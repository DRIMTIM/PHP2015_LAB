function refreshOfertasDelDia(){
	$.ajax({
		url: __ROOT + "/ajax/refreshOfertasDelDia",
	}).done(function(data) {
		$("#__contenedor_ofertas").html(data);
		buildCountDown();
	});
};
function refreshOfertasRecomendadas(){
	$.ajax({
		url: __ROOT + "/ajax/refreshOfertasRecomendadas",
	}).done(function(data) {
		$("#__contenedor_ofertas_recomendadas").html(data);
		buildCountDown();
	});
};
function refreshOfertas(){
	refreshOfertasDelDia();
	refreshOfertasRecomendadas();
};
function comprarOferta(uri_oferta){
	$.ajax({
		type: "POST",
		url: __ROOT + "/ajax/agregarCompraActiva",
		data : { uri_oferta : uri_oferta }
	}).done(function(data){
		window.location.href = __ROOT + "/product/compraConfirm";
	});
};
function cancelarCompra(){
	$.ajax({
		type: "POST",
		url: __ROOT + "/ajax/quitarCompraActiva"
	});
};