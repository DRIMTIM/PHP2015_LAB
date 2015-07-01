<?php if(!empty($ofertasTemporales)){	
		foreach ($ofertasTemporales as $ofertaTemporal){?>
			<div id="__ofertaTemporal_<?php echo $ofertaTemporal["id"];?>" class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
							<div class="productinfo text-center">
								<img src="<?php echo $ofertaTemporal["imagen"];?>" alt="" />
								<h2><?php echo Moneda::$SIMBOLOS[$ofertaTemporal["moneda"]] . $ofertaTemporal["precio"];?></h2>
								<p><?php echo $ofertaTemporal["titulo"];?></p>
							</div>
							<div class="product-overlay">
								<div class="overlay-content">
									<h2><?php echo Moneda::$SIMBOLOS[$ofertaTemporal["moneda"]] . $ofertaTemporal["precio"];?></h2>
									<p><?php echo $ofertaTemporal["titulo"];?></p>
									<p class="timeLimitOferta" data-countdown="<?php echo $ofertaTemporal["fecha_fin"];?>"></p>
									<a href="#" class="btn btn-default add-to-cart" onclick="comprarOferta(<?php echo $ofertaTemporal["id"];?>);"><i class="fa fa-shopping-cart"></i>Comprar</a>
								</div>
							</div>
					</div>
					<div class="choose">
						<ul class="nav nav-pills nav-justified">
							<li>
								<a href="#">
									<div id="__timeLimitOferta_<?php echo $ofertaTemporal["id"];?>" class="timeLimitOferta" data-countdown="<?php echo $ofertaTemporal["fecha_fin"];?>"></div>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
<?php } }else{?>
	<h4 class="text-center">No hay ofertas vigentes en el sistema para el dia de hoy!</h4>
	<br>
<?php }?>