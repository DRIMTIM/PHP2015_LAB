LISTA
<table>
<?php

foreach ($usuarios as $key => $usuario) {
	# code...
	echo "<tr><td>{$usuario['id']}</td><td>{$usuario['nombre']}</td></tr>";
}

?>
</table>