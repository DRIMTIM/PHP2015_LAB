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
function loadSearch(){
	$.ajax({
		type: "GET",
		url: __ROOT + "/ajax/loadOfertasForSearch"
	}).done(function(data){
		var matches = new Array();
		data = $.parseJSON(data);
		for(var i = 0; i < data.length; i++){
			matches.push({ label : data[i].titulo , value : data[i].descripcion_corta, data : data[i] });
			matches.push({ label : data[i].descripcion , value : data[i].descripcion_corta, data : data[i] });
		}
		$("#busqueda_ofertas").autocomplete({
			source: matches,
			select: function(event, ui) {$("#input_oferta_search").val(ui.item.data.id);$('#form_search').submit();}
		}).autocomplete("instance")._renderItem = function(ul, item) {
			$(ul).attr("class", "dropdown-menu");
			return $("<li></li>")
	            .data("item.autocomplete", item)
	            .append("<a href='product/compraConfirm?oferta=" + item.data.id + "'>" + 
            				"<div class='panel-body'>" +
	            				"<h6 class='pull-left item-desc'>" + 
	            					item.label + 
            					"</h6>" +
            					"<img src='" + item.data.imagen + "' class='imagenSearch pull-right'/>" +
        					"</div>" +
						"</a>")
	            .appendTo(ul);
	    };;
	});
};