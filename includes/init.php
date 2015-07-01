<?php
/**
 * Defino el nombre de la variable de usuario en sesión
 */
define('__USER', '__USER_');
/**
 * * Defino la url root de la app **
 */
define ( '__ROOT', substr ( $site_path, strrpos ( $site_path, "/" ) ) );
/**
 * * Defino la url root de los css **
 */
define ( '__ROOT_CSS', __ROOT . '/application/public/css/');
/**
 * * Defino la url root de los javascript **
 */
define ( '__ROOT_JS', __ROOT . '/application/public/js/');
/**
 * * Defino la url root de las imagenes **
 */
define ( '__ROOT_IMG', __ROOT . '/application/public/images/');
/**
 * Defino constante para la zona horaria del cliente
 */
define('__CLIENT_TIME_ZONE', '__CLIENT_TIME_ZONE');
/**
 * Defino la constante para la compra
 */
define('__COMPRA_ACTIVA', '__COMPRA_ACTIVA');
/**
 * * include the controller class **
 */
include __SITE_PATH . '/application/BaseController.class.php';

include __SITE_PATH . '/application/Validator.class.php';

include __SITE_PATH . '/application/AbstractModel.class.php';

/**
 * * include the registry class **
 */
include __SITE_PATH . '/application/Registry.class.php';

/**
 * * include the router class **
 */
include __SITE_PATH . '/application/Router.class.php';

/**
 * * include the template class **
 */
include __SITE_PATH . '/application/Template.class.php';

include __SITE_PATH . '/application/GenericUtils.class.php';

include __SITE_PATH . '/application/GlobalConstants.class.php';

/**
 * Cargo las entidades a utilizar
 */
if($dirEntities = opendir(__SITE_PATH . "/models/entities")){
	while(false != ($entity = readdir($dirEntities))){
		if(stripos("$entity", '.php') != false){
			include __SITE_PATH . "/models/entities/" . $entity;
		}
	}
}

/**
 * * auto load model classes **
 */
function __autoload($class_name) {
	$filename = $class_name . '.class.php';
	$file = __SITE_PATH . '/models/' . $filename;
	
	if (file_exists ( $file ) == false) {
		return false;
	}
	include ($file);
}

/**
 * * a new registry object **
 */
$registry = new registry ();

/**
 * * create the database registry object **
 */

$registry->db = new MysqliDb ( 'localhost', 'root', 'chonabook', 'PHP_LAB' );
?>