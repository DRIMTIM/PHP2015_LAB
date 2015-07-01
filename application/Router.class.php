<?php

class Router {
 /*
 * @the registry
 */
 private $registry;

 /*
 * @the controller path
 */
 private $path;

 private $args = array();

 public $file;

 public $controller;

 public $action;
 
 public $actionValidator;
 
 public $validatorFile;
 
 public $validator;

 function __construct($registry) {
        $this->registry = $registry;
 }

 /**
 *
 * @set controller directory path
 *
 * @param string $path
 *
 * @return void
 *
 */
 function setPath($path) {

	/*** check if path i sa directory ***/
	if (is_dir($path) == false)
	{
		throw new Exception ('Invalid controller path: `' . $path . '`');
	}
	/*** set the path ***/
 	$this->path = $path;
}


 /**
 *
 * @load the controller
 *
 * @access public
 *
 * @return void
 *
 */
 public function loader()
 {
	/*** check the route ***/
	$this->getController();

	/*** if the file is not there diaf ***/
	if (is_readable($this->file) == false)
	{
		$this->file = $this->path.'/ErrorsController.php';
        $this->controller = 'Errors';
	}

	/*** include the controller ***/
	include $this->file;

	/*** a new controller class instance ***/
	$class = $this->controller . 'Controller';
	$controller = new $class($this->registry);

	/*** check if the action is callable ***/
	if (is_callable(array($controller, $this->action)) == false)
	{
		$action = 'index';
	}
	else
	{
		$action = $this->action;
	}
	
	$errores = null;
	$actionValidator = $this->actionValidator;
	
	/*** check if the action is callable, valido la accion si tiene validator, en caso de tenerlo retorna una lista de errores para pasarla a la accion ***/
	if (is_callable(array($controller, $actionValidator)) == true)
	{
		/*** run the action ***/
		$errores = $controller->$actionValidator();
	}
	
	/*** if the file is not there diaf, si no se definio un metodo de validacion en el controller 
	 * mismo los errores vienen null, por lo que verifico que haya una clase validator ***/
	if (is_readable($this->validatorFile) == true && $errores == null)
	{
		$actionValidator = $this->action;
		
		/*** include the validator ***/
		include $this->validatorFile;
		
		/*** a new validator class instance ***/
		$classValidator = $this->controller . 'Validator';
		$validator = new $classValidator($this->registry);
		
		/*** check if the action is callable, valido la accion si tiene validator, en caso de tenerlo retorna una lista de errores para pasarla a la accion ***/
		if (is_callable(array($validator, $actionValidator)) == true)
		{
			/*** run the action ***/
			$errores = $validator->$actionValidator();
		}
		
	}
	
	/*** run the action ***/
	$controller->$action($errores);
 }


 /**
 *
 * @get the controller
 *
 * @access private
 *
 * @return void
 *
 */
private function getController() {

	/*** get the route from the url ***/
	$route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

	if (empty($route))
	{
		$route = 'index';
	}
	else
	{
		/*** get the parts of the route ***/
		$parts = explode('/', $route);
		$this->controller = $parts[0];
		if(isset( $parts[1]))
		{
			$this->action = $parts[1];
			$this->actionValidator = $this->action . "Validator";
		}
	}

	if (empty($this->controller))
	{
		$this->controller = 'index';
	}

	/*** Get action ***/
	if (empty($this->action))
	{
		$this->action = 'index';
	}
	
	/*** Get Validator ***/
	if (empty($this->actionValidator))
	{
		$this->actionValidator = null;
	}

	/** cambio a camel case para la nomenclatura**/
	$this->controller = ucfirst($this->controller);
	
	/*** set the validator file path ***/
	$this->validatorFile = $this->path .'/validators/'. $this->controller . 'Validator.php';
	
	/*** set the file path ***/
	$this->file = $this->path .'/'. $this->controller . 'Controller.php';

}


}

?>
