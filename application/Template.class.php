<?php

class Template {

/*
 * @the registry
 * @access private
 */
private $registry;

/*
 * @Variables array
 * @access private
 */
private $vars = array();

/**
 *
 * @constructor
 *
 * @access public
 *
 * @return void
 *
 */
function __construct($registry)
{
	$this->registry = $registry;
}


 /**
 *
 * @set undefined vars
 *
 * @param string $index
 *
 * @param mixed $value
 *
 * @return void
 *
 */
 public function __set($index, $value)
 {
 	$this->vars[$index] = $value;
 }

function show($name) {
	
	if($_SESSION[__USER] !== null){
		$this->usuario = $_SESSION[__USER];
	}

	$path = __SITE_PATH . '/views/' . $name . '.php';

	if (file_exists($path) == false)
	{
		throw new Exception('Template not found in '. $path);
		return false;
	}

	// Load variables
	foreach ($this->vars as $key => $value)
	{
		$$key = $value;
	}

	include ($path);
	
}

/**
 * Muestra una view que se encuentra en otro controller al actual, esta funcion se crea ya que al ir a otra view
 * que el controlador actual no maneja se pierde toda la carga de datos de dicha view, ya que el controlador que maneja la misma
 * no se instancia por lo que con esta funcion se llama al loader instanciando al controlador correspondiente y se cargan los datos correctamente.
 * @param unknown $url
 */
function showOther($url){
	$_GET['rt'] = $url;
	$this->registry->router->loader();
}

}

?>
