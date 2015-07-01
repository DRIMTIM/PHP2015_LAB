<?php 

session_start ();

/**
 * * error reporting on **
 */
error_reporting ( E_ALL );

/**
 * * define the site path **
*/
$site_path = realpath ( dirname ( __FILE__ ) );
define ( '__SITE_PATH', $site_path );

/**
 * cargo las inicializaciones
 */

/**
 * * include the init.php file **
 */
include 'includes/init.php';

/**
 * * load the router **
 */
$registry->router = new router ( $registry );

/**
 * * set the controller path **
*/
$registry->router->setPath ( __SITE_PATH . '/controllers');

/**
 * * load up the template **
*/
$registry->template = new template ( $registry );

/**
 * Defino pattern para ajax
 */
define('__AJAX_URL_PATTERN', 'ajax');

/**
 * Obtengo la url del request
 */
$url = $_SERVER['REQUEST_URI'];

/**
 * Evaluo si es un request de ajax o no
 */
if(stripos($url, __AJAX_URL_PATTERN) == false){
	/**
	 * inicio la carga del template en caso de que no sea un request ajax
	 */
	include 'front.php';
}else{
	/**
	 * Inicio la carga de la respuesta del request ajax
	 */
	include 'ajaxHandler.php';
}

?>