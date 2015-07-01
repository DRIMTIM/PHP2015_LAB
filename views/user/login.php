<html>
<div id="modal_login" class="login-form">
	<form id="__formLogin" action="<?php echo __ROOT . "/user/login"?>" method="post" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Inicio de Sesión</h3>
		</div>
		<div class="panel-body">
		<?php if(count($errores) > 0){ ?>
			<div class="alert alert-danger" role="alert">
				<?php foreach ($errores as $error){echo $error;}?>
			</div>	
		<?php } if(empty($usuario)){ ?>
			<div>
				<input type="text" class="form-control"
						placeholder="Escriba su Nick" aria-describedby="basic-addon0"
					 	name="nick" id="nick" required="required">
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="boton">
					<button type="submit" class="btn btn-default pull-left">Inicio</button>
				</div>
				<div class="boton">
					<a href="<?php echo __ROOT?>">
						<?php if($_SESSION[__COMPRA_ACTIVA] != null){?>
							<button type="button" class="btn btn-default pull-right" onclick="cancelarCompra();">Cancelar</button>
						<?php } else {?>
							<button type="button" class="btn btn-default pull-right" >Cancelar</button>
						<?php } ?>
					</a>
				</div>
			</div>
		</div>
		<?php }else{ ?>
			<div>
				<input type="hidden" value="<?php echo $usuario["nick"];?>" name="nick">
				<input type="password" class="form-control"
					placeholder="Escriba su Contraseña" aria-describedby="basic-addon6"
					 name="password" id="password" required="required">
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="boton">
					<button type="submit" class="btn btn-default pull-right">Inicio</button>
				</div>
				<div class="boton">
					<a href="<?php echo __ROOT?>">
						<?php if($_SESSION[__COMPRA_ACTIVA] != null){?>
							<button type="button" class="btn btn-default pull-left" onclick="cancelarCompra();">Cancelar</button>
						<?php } else {?>
							<button type="button" class="btn btn-default pull-left" >Cancelar</button>
						<?php } ?>
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#modal_login").easyModal({
			top: 100,
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
			$("#modal_login").css("margin", "10%");
			$("#modal_login").css("position", "initial");
		}
	});
</script>
</html>