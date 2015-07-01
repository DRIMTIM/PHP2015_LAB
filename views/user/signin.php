<html>
<div id="modal_signin" style="height:300pt margin:;" class="mCustomScrollbar login-form modalUser">
	<form action="<?php echo __ROOT . "/user/altaUsuario"?>" method="post" class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Registro</h3>
		</div>
		<div class="panel-body">
			<?php if(count($errores) > 0){ ?>
				<div class="alert alert-danger" role="alert">
					<?php foreach ($errores as $error){echo $error . "<br>";}?>
				</div>	
			<?php } ?>
			<div class="row">
				<div class="col-sm-6">
					<input type="text" class="form-control" placeholder="Nick..."
						aria-describedby="basic-addon0" name="nick" id="nick"
						required="required">
				</div>
				<div class="col-sm-6">
					<input type="text" class="form-control" placeholder="Nombre..."
						aria-describedby="basic-addon1" name="nombre" id="nombre"
						required="required">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<input type="text" class="form-control" placeholder="Apellido..."
						aria-describedby="basic-addon2" name="apellido" id="apellido"
						required="required">
				</div>
				<div class="col-sm-6">
					<input type="email" class="form-control" placeholder="Email..."
						aria-describedby="basic-addon3" name="email" id="email"
						required="required">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<input type="text" class="form-control"
						placeholder="Fecha de nacimiento..." aria-describedby="basic-addon4"
						name="fechaNac" id="fechaNac" required="required">
				</div>
				<div class="col-sm-6">
					<input type="tel" class="form-control" placeholder="Celular..."
						maxlength="9" aria-describedby="basic-addon5" name="celular"
						id="celular" required="required">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<input type="password" class="form-control"
						placeholder="Contraseña..." aria-describedby="basic-addon6"
						name="password" id="password" required="required">
				</div>
				<div class="col-sm-6">
					<input type="password" class="form-control"
						placeholder="Confirmación..." aria-describedby="basic-addon7"
						name="passwordConfirm" id="passwordConfirm" required="required">
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="boton">
					<button type="submit" class="btn btn-default pull-left">Registrar</button>
				</div>
				<div class="boton">
					<a href="<?php echo __ROOT?>">
						<button type="button" class="btn btn-default pull-right">Cancelar</button>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#modal_signin").easyModal({
			autoOpen: true,
			overlayOpacity: 0.3,
			overlayColor: "#333",
			overlayClose: false,
			closeOnEscape: false,
			transitionIn: 'animated bounceInLeft',
			transitionOut: 'animated bounceOutRight',
			closeButtonClass: '.animated-close'
		});
		$( "#fechaNac" ).datepicker({
			changeYear: true,
			changeMonth: true,
			currentText: "Ahora",
			dateFormat: "<?php echo GlobalConstants::$jqueryDateFormat; ?>",
			autoSize: true,
			firstDay: 1,
			dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
			dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
			dayNamesShort: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
			monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre" ],
			monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic" ]	
		});
		$("#modal_signin").mCustomScrollbar({
		    axis:"y",
		    theme:"dark",
		    scrollbarPosition:"outside"
		});
		if(isMobile()){
			$("#modal_signin").css("margin", "10%");
			$("#modal_signin").css("position", "initial");
		}
	});
</script>
</html>