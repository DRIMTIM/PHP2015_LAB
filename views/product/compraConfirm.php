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
									<img src="<?php echo $ofertaSeleccionada["imagen"][GlobalConstants::$DEFAULT_IMAGE_FOR_SHOW];?>" class="imagenGaleria" />
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
										<p><button type="button" class="btn btn-default botonGaleria" onclick="mostrarGaleria(true);">Galería</button></p>
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
<div id="modal_carousel_imagenes" class="mCustomScrollbar login-form modalGaleria">
	<?php if(empty($ticket)){?>
		<form  class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Galería</h3>
			</div>
			<div class="panel-body">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				<?php $imagenes = $ofertaSeleccionada["imagen"];
					if(count($imagenes) > 1){
						for($cont = 0; $cont < count($imagenes); $cont++){ 
							if($cont == 0){?>
								<li data-target="#slider-carousel" data-slide-to="<?php echo $cont;?>" class="active"></li>
							<?php }else{?>
								<li data-target="#slider-carousel" data-slide-to="<?php echo $cont;?>"></li>
							<?php } ?>
				<?php } } ?>
				</ol>
				<div class="carousel-inner">
					<?php 
						$itemActive = true;
						foreach ($imagenes as $imagen){
							if($itemActive){ $itemActive = false;?>
								<div class="item active">
							<?php } else { ?>
								<div class="item">
							<?php } ?>
							<div class="col-sm-3">
								<img src="<?php echo $imagen;?>" class="imagenGaleria" />
							</div>
						</div>
						<?php } ?>
					</div>
					<?php if(count($imagenes) > 1){?>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					<?php }?>
				</div>
			</div>
			<div class="panel-footer">
				<div class="text-center">
					<a>
						<button type="button" class="btn btn-default" style="display:inherit;" onclick="mostrarGaleria(false);">Aceptar</button>
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
			overlayOpacity: <?php echo GlobalConstants::$MODAL_COLOR_BACKGROUND_ALPHA?>,
			overlayColor: "<?php echo GlobalConstants::$MODAL_COLOR_BACKGROUND?>",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close',
			zIndex: function (){return 20;}
		});
		$("#modal_carousel_imagenes").easyModal({
			autoOpen: false,
			overlayOpacity: <?php echo GlobalConstants::$MODAL_COLOR_BACKGROUND_ALPHA?>,
			overlayColor: "<?php echo GlobalConstants::$MODAL_COLOR_BACKGROUND?>",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close',
			zIndex: function (){return 20;}
		});
		$("#modal_compra").mCustomScrollbar({
		    axis:"y",
		    theme:"dark",
		    scrollbarPosition:"outside"
		});
		$("#modal_carousel_imagenes").mCustomScrollbar({
		    axis:"y",
		    theme:"dark",
		    scrollbarPosition:"outside"
		});
		if(isMobile()){
			$("#modal_compra").css("margin", "10%");
			$("#modal_compra").css("position", "initial");
			$("#modal_carousel_imagenes").css("margin", "10%");
			$("#modal_carousel_imagenes").css("position", "initial");
		};
	});
	function mostrarGaleria(mostrar){
		if(mostrar){
			$("#modal_compra").trigger('closeModal');
			$("#modal_carousel_imagenes").trigger('openModal');
		}else{
			$("#modal_carousel_imagenes").trigger('closeModal');
			$("#modal_compra").trigger('openModal');
		}
	};
</script>
</html>