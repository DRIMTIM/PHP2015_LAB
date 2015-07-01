<html>
<?php $usuario = $_SESSION[__USER];
	if($usuario === null){ ?>
	<div id="modal_closeAccount" class="panel panel-default mCustomScrollbar login-form">
		<div class="panel-heading">
			<h3 class="panel-title">Error</h3>
		</div>
		<div class="panel-body">
			<div class="alert alert-danger" role="alert">
				No has iniciado sesión para mostrar los datos de usuario!.
			</div>
		</div>
		<div class="panel-footer">
			<button class="btn btn-default" onclick="window.location.href = '<?php echo __ROOT?>';">Aceptar</button>
		</div>
	</div>
<?php }else{ ?>
<div id="modal_closeAccount" class="mCustomScrollbar login-form">
	<form action="<?php echo __ROOT . "/user/bajaCuenta"?>" method="post" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Baja de Cuenta</h3>
		</div>
		<div class="panel-body">
		<?php if(count($errores) > 0){ ?>
			<div class="alert alert-danger" role="alert">
				<?php foreach ($errores as $error){
					echo $error;
				}?>
			</div>	
		<?php } ?>
			<div>
				<input type="password" class="form-control"
					placeholder="Contraseña" aria-describedby="basic-addon6"
					name="password" id="password" required="required">
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="boton">
					<button id="botonLogin" type="submit" class="btn btn-default pull-right">Baja</button>
				</div>
				<div class="boton">
					<a href="<?php echo __ROOT?>">
						<button type="button" class="btn btn-default pull-left">Cancelar</button>
					</a>
				</div>
			</div>
		</div>
	</form>
	<?php } ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#modal_closeAccount").easyModal({
			autoOpen: true,
			overlayOpacity: 0.3,
			overlayColor: "#333",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close'
		});
		if(isMobile()){
			$("#modal_closeAccount").css("margin", "10%");
			$("#modal_closeAccount").css("position", "initial");
		}
	});
</script>
</html>