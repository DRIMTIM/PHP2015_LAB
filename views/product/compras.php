<div id="modal_compras" class="mCustomScrollbar login-form"  style="height:70%;">
	<form class="panel panel-default">
		<div class="panel-heading">
			<span class="glyphicon glyphicon-th-list"></span>
			<b>Lista de Compras Realizadas</b>
		</div>
		<div class="panel-body">
			<?php if(!empty($compras)){?>
				<table data-toggle="table" id="table-style" data-row-style="rowStyle" >
					<thead>
						<tr>
							<th><b>Fecha</b></th>
							<th><b>Oferta</b></th>
							<th><b>Numero de Ticket</b></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($compras as $compra){ ?>
								<tr>
									<td><?php echo $compra["fecha"];?></td>
									<td><?php echo $compra["oferta"]["titulo"];?></td>
									<td><?php echo $compra["ticket"];?></td>
								</tr>
						<?php } ?>
					</tbody>
				</table>
				<script>
					function rowStyle(row, index) {
						var classes = ['active', 'success', 'info', 'warning', 'danger'];
						if (index % 2 === 0) {
							return {
								classes: classes[2]
							};
						}
						return {};
					}			
				</script>
			<?php } else { ?>
				<h6>Usted no dispone de compras realizadas!</h6>
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
		$("#modal_compras").easyModal({
			autoOpen: true,
			overlayOpacity: <?php echo GlobalConstants::$MODAL_COLOR_BACKGROUND_ALPHA?>,
			overlayColor: "<?php echo GlobalConstants::$MODAL_COLOR_BACKGROUND?>",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close'
		});
		$("#modal_compras").mCustomScrollbar({
		    axis:"y",
		    theme:"dark",
		    scrollbarPosition:"outside"
		});
		if(isMobile()){
			$("#modal_compras").css("margin", "10%");
			$("#modal_compras").css("position", "initial");
		};
	});
</script>