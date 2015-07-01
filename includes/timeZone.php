<?php 
/**
 * Obtengo la zona horaria del cliente para las fechas del usuario
 */

$timeZone = $_SESSION[__CLIENT_TIME_ZONE];

if($timeZone == null){ ?>
<html>
<script type="text/javascript">
	$(document).ready(function() {
		var visitortime = new Date();
		var visitortimezone = "GMT " + -visitortime.getTimezoneOffset()/60;
		$.ajax({
			type: "POST",
			url: '<?php echo __ROOT . "/ajax/saveClientTimeZone"; ?>',
			data: '<?php echo __CLIENT_TIME_ZONE; ?>='+ visitortimezone
		});
	});
</script>
</html>
<?php } ?>