<div id="modal_categoria" class="mCustomScrollbar login-form">
	<form class="panel panel-default" style="width: 60%;">
		<div class="panel-heading">
			<span class="glyphicon glyphicon-th-list"></span>
			<b>Categoria</b>
		</div>
		<div class="panel-body">
			<?php if(!empty($ofertas)){ 
				$ofertasRecomendadas = $ofertas; 
				include 'ofertasRecomendadas.php'; 
			}else{ ?>
			<h6>No existen ofertas para la categoria seleccionada!</h6>
			<?php } ?>
		</div>
		<div class="panel-footer">
			<div class="text-center">
				<a href="<?php echo __ROOT?>">
					<button type="button" style="display:inherit;" class="btn btn-default">Aceptar</button>
				</a>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#modal_categoria").easyModal({
			autoOpen: true,
			overlayOpacity: 0.3,
			overlayColor: "#333",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close'
		});
		$("#modal_categoria").mCustomScrollbar({
		    axis:"y",
		    theme:"dark",
		    scrollbarPosition:"outside"
		});
		if(isMobile()){
			$("#modal_categoria").css("margin", "10%");
			$("#modal_categoria").css("position", "initial");
		};
	});
</script>