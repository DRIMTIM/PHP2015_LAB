<?php if(!empty($ofertasRecomendadas)){ ?>
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php
				$activeItem = true;
				$cantPorItem = 3;
				$cantOfertas = count($ofertasRecomendadas);
				$cantItems = $cantOfertas / $cantPorItem;
				$countOfertasTotal = 0;
				for($countItems = 0; $countItems < $cantItems; $countItems++){
					if($countOfertasTotal < $cantOfertas){					
						if($activeItem){ 
							$activeItem = false; 
							?><div class="item active"><?php 
						}else{
							?><div class="item"><?php
						} 
						for($countOfertas = 0; $countOfertas < $cantPorItem && $countOfertasTotal < $cantOfertas; $countOfertas++){
							$ofertaRecomendada = $ofertasRecomendadas[$countOfertasTotal];
							$countOfertasTotal++?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo $ofertaRecomendada["imagen"];?>" alt="" />
											<h2><?php echo Moneda::$SIMBOLOS[$ofertaRecomendada["moneda"]] . $ofertaRecomendada["precio"];?></h2>
											<p><?php echo $ofertaRecomendada["titulo"];?></p>
											<?php if(GenericUtils::getInstance()->getTableNameFromUri($ofertaRecomendada["id"]) == TableNames::OFERTAS_TEMPORALES){?>
												<div id="__timeLimitOfertaCompra_<?php echo $ofertaRecomendada["id"];?>" class="timeLimitOfertaCompra" data-countdown="<?php echo $ofertaRecomendada["fecha_fin"];?>"></div>
											<?php } else if (GenericUtils::getInstance()->getTableNameFromUri($ofertaRecomendada["id"]) == TableNames::OFERTAS_STOCK){ ?>
												<div>
													Stock Disponible :
													<?php echo $ofertaRecomendada["stock"];?>
													<?php if($ofertaRecomendada["stock"] > 1){?>
													Unidades
													<?php } else {?>
													Unidad
													<?php } ?>
												</div>
											<?php } ?>
											<br>
											<a href="#" class="btn btn-default add-to-cart" onclick="comprarOferta('<?php echo $ofertaRecomendada["id"];?>');"><i class="fa fa-shopping-cart"></i>Ver Oferta</a>
										</div>
									</div>
								</div>
							</div>
					<?php } ?>
				</div>
			<?php }} ?>
		</div>
		<?php if(count($ofertasRecomendadas) > 3){?>
			<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
			<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
		<?php } ?>
	</div>
<?php } else {?>
	<h4 class="text-center">No hay ofertas recomendadas en el sistema!</h4>
	<br>
<?php }?>