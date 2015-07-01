<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php if(!empty($ofertasStock)){?>
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
						<?php 
							if(count($ofertasStock) > 1){
								for($cont = 0; $cont < count($ofertasStock); $cont++){ 
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
								foreach ($ofertasStock as $ofertaStock){
									if($itemActive){ $itemActive = false;?>
										<div class="item active">
									<?php } else { ?>
										<div class="item">
									<?php } ?>
									<div class="col-sm-6">
										<h1><?php echo $ofertaStock["titulo"];?></h1>
										<h2><?php echo $ofertaStock["descripcion_corta"];?></h2>
										<p><?php echo $ofertaStock["descripcion"];?></p>
										<button type="button" class="btn btn-default get" onclick="comprarOferta('<?php echo $ofertaStock["id"];?>');">Obtener Ahora</button>
									</div>
									<div class="col-sm-6">
										<img src="<?php echo $ofertaStock["imagen"];?>" class="girl img-responsive" alt="" />
										<div class="imagenPrecio">
											<h4 class="pricing">En stock!</h4>
											<h5 class="pricing"><?php echo Moneda::$SIMBOLOS[$ofertaStock["moneda"]] . $ofertaStock["precio"];?></h5>
											<img src="<?php echo __ROOT_IMG . 'home/pricing.png'?>"  class="pricing" alt="<?php echo Moneda::$SIMBOLOS[$ofertaStock["moneda"]] . $ofertaStock["precio"];?>"/>
										</div>
										<script type="text/javascript">
											$(document).ready(function(){
												fixPriceImage($( window ).width(), $( window ).height());
											});
											$(window).resize(function(){
												fixPriceImage($( window ).width(), $( window ).height());
											});
										</script>
									</div>
								</div>
								<?php } ?>
						</div>
						<?php if(count($ofertasStock) > 1){?>
							<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						<?php }?>
					</div>
				</div>
			<?php } else {?>
				<h4 class="text-center">No hay ofertas destacadas en el sistema!</h4>
			<?php }?>
		</div>
	</div>
</section><!--/slider-->
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Categorías</h2>
					<div class="panel-group category-products" id="accordian"><!--Categorias de productos-->
					<?php if(!empty($categorias)){
							foreach ($categorias as $categoria){ ?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="#" style="font-size:70%;"><?php echo $categoria["nombre"];?></a></h4>
									</div>
								</div>
						<?php } 
							}else{ ?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"><a href="#" style="font-size:70%;">No existen categorías disponibles!</a></h4>
									</div>
								</div>
					<?php }?>
					</div><!--Categorias de productos-->
				</div>
			</div>
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 id="__tituloOfertas" class="title text-center">Ofertas del dia</h2>
					<div id="__contenedor_ofertas"><?php include 'product/ofertasTemporales.php';?></div>
				</div><!--features_items-->
				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">Recomendado</h2>				
					<div id="__contenedor_ofertas_recomendadas"><?php include 'product/ofertasRecomendadas.php';?></div>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						setInterval(refreshOfertasDelDia, parseInt('<?php echo GlobalConstants::$UPDATE_OFERTAS_TIMEOUT;?>'));
						setInterval(refreshOfertasRecomendadas, parseInt('<?php echo GlobalConstants::$UPDATE_OFERTAS_TIMEOUT;?>'));
					});
				</script>
			</div>
		</div>
	</div>
</section>