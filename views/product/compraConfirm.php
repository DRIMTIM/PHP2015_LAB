<html>
<?php if($usuario === null){ ?>
	<div id="modal_compra" class="panel panel-default mCustomScrollbar login-form">
		<div class="panel-heading">
			<h3 class="panel-title">Error</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-danger" role="alert">
				No has iniciado sesión para comprar!.
			</div>
		</div>
		<div class="panel-footer">
			<a href="<?php echo __ROOT?>">
				<button type="button" class="btn btn-default">Cancelar</button>
			</a>
		</div>
	</div>
<?php }else{ ?>
	<div id="modal_compra" class="mCustomScrollbar login-form modalCompra">
		<?php if(empty($ticket)){ ?>
			<form action="<?php echo __ROOT . "/product/realizarCompra"?>" method="post" class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center"><?php echo $ofertaSeleccionada["titulo"];?></h3>
				</div>
				<div class="panel-body">
					<?php if(count($errores) > 0){ ?>
						<div class="alert alert-danger" role="alert">
							<?php foreach ($errores as $error){echo $error;}?>
						</div>	
					<?php } ?>
					<div>
						<div class="product-image-wrapper">
							<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo $ofertaSeleccionada["imagen"];?>" alt="" />
										<h2><?php echo Moneda::$SIMBOLOS[$ofertaSeleccionada["moneda"]] . $ofertaSeleccionada["precio"];?></h2>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><?php echo Moneda::$SIMBOLOS[$ofertaSeleccionada["moneda"]] . $ofertaSeleccionada["precio"];?></h2>
											<?php if($ofertaSeleccionada["stock"] == null && $ofertaSeleccionada["fecha_fin"] != null){?>
												<div id="__timeLimitOferta_<?php echo $ofertaSeleccionada["id"];?>" class="timeLimitOferta" data-countdown="<?php echo $ofertaSeleccionada["fecha_fin"];?>"></div>
											<?php } else { ?>
												<div>
													Stock Disponible :
													<?php echo $ofertaSeleccionada["stock"];?>
													<?php if($ofertaSeleccionada["stock"] > 1){?>
													Unidades
													<?php } else {?>
													Unidad
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="boton pull-left">
							<button type="submit" class="btn btn-default">Confirmar Compra</button>
						</div>
						<div class="boton pull-right">
							<a href="<?php echo __ROOT?>">
								<button type="button" class="btn btn-default" onclick="cancelarCompra();">Cancelar</button>
							</a>
						</div>
					</div>
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
<?php } ?>
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
		}
	});
</script>
</html>