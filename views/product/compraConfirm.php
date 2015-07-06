<div id="modal_compra" class="mCustomScrollbar login-form modalCompra">
	<?php if(empty($ticket)){ ?>
		<form action="<?php echo __ROOT . "/product/realizarCompra"?>" method="post" class="panel panel-default">
			<div id="__tituloOfertaSeleccionada" class="panel-heading">
				<h3 class="panel-title text-center"><?php if(count($errores) > 0){echo "Error!";}else{echo $ofertaSeleccionada["titulo"];}?></h3>
			</div>
			<div id="__bodyOfertaSeleccionada" class="panel-body" style="height:80%;">
				<?php if(count($errores) > 0){ ?>
					<div class="alert alert-danger" role="alert">
						<?php foreach ($errores as $error){echo $error;}?>
					</div>	
				<?php } else{ ?>
					<div>
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="<?php echo $ofertaSeleccionada["imagen"];?>" alt="" />
									<h2><?php echo Moneda::$SIMBOLOS[$ofertaSeleccionada["moneda"]] . $ofertaSeleccionada["precio"];?></h2>
									<p><?php echo $ofertaSeleccionada["descripcion_corta"];?></p>
									<?php if(GenericUtils::getInstance()->getTableNameFromUri($ofertaSeleccionada["id"]) == TableNames::OFERTAS_TEMPORALES){?>
										<p id="__timeLimitOfertaCompra_<?php echo $ofertaSeleccionada["id"];?>" class="timeLimitOfertaCompra" data-countdown="<?php echo $ofertaSeleccionada["fecha_fin"];?>"></p>
									<?php } else if (GenericUtils::getInstance()->getTableNameFromUri($ofertaSeleccionada["id"]) == TableNames::OFERTAS_STOCK){ ?>
										<p>
											Stock Disponible :
											<?php echo $ofertaSeleccionada["stock"];?>
											<?php if($ofertaSeleccionada["stock"] > 1){?>
											Unidades
											<?php } else {?>
											Unidad
											<?php } ?>
										</p>
									<?php } ?>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<p><?php echo $ofertaSeleccionada["descripcion"];?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div id="__footerOfertaSeleccionada" class="panel-footer">
				<?php if(count($errores) > 0){ ?>
					<div class="text-center">
						<a href="<?php echo __ROOT?>">
							<button type="button" style="display:inherit;" class="btn btn-default">Aceptar</button>
						</a>
					</div>
				<?php } else{ ?>
					<div class="row">
						<div class="boton pull-left">
							<button type="submit" class="btn btn-default">Comprar</button>
						</div>
						<div class="boton pull-right">
							<a href="<?php echo __ROOT?>">
								<button type="button" class="btn btn-default" onclick="cancelarCompra();">Cancelar</button>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</form>
	<?php } else {?>
		<form class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Ticket</h3>
			</div>
			<div class="panel-body">
				<div class="alert alert-warning text-center" role="alert">
					Atención el numero del ticket es importante para cualquier consulta. Debe conservarlo!
				</div>
				<h4 class="text-center">Numero de Ticket</h4>
				<h4 class="text-center"><?php echo $ticket;?></h4>
				<br>
				<p class="text-center">Los datos de esta compra, los puede ver<br>en la consulta de compras en el menu principal.</p>
			</div>
			<div class="panel-footer">
				<div class="text-center">
					<a href="<?php echo __ROOT?>">
						<button type="button" style="display:inherit;" class="btn btn-default">Aceptar</button>
					</a>
				</div>
			</div>
		</form>
	<?php } ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#modal_compra").easyModal({
			autoOpen: true,
			overlayOpacity: 0.3,
			overlayColor: "#333",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close'
		});
		$("#modal_compra").mCustomScrollbar({
		    axis:"y",
		    theme:"dark",
		    scrollbarPosition:"outside"
		});
		if(isMobile()){
			$("#modal_compra").css("margin", "10%");
			$("#modal_compra").css("position", "initial");
		};
	});
</script>
</html>