<?php

class UserValidator extends Validator {

	private $usuarioModel = NULL;
	private $usuario = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->usuarioModel = new UserModel($this->registry);
		if($_SESSION[__USER]!== null){
			$this->usuario = $_SESSION[__USER];
		}
	}
	
	/**
	 * Este metodo valida el alta de usuario, se creo una logica que si hay un metodo en un controller 
	 * y se quiere validar se crea el mismo con la terminacion Validator para validar dicha accion.
	 * @return multitype:lista de errores validados
	 */
	public function altaUsuario(){
		$errores = array();
		$password = $_POST["password"];
		$nick = $_POST["nick"];
		$passwordConfirm = $_POST["passwordConfirm"];
		$fechaNac = $_POST["fechaNac"];
		$usuario = $this->usuarioModel->obtenerUsuario($nick);
		if($usuario !== null){
			array_push($errores, "El nick ya existe en el sistema!");
		}
		//Valido las fechas
		if(!GenericUtils::getInstance()->isFechaValida($fechaNac)){
			array_push($errores, "La fecha ingresada no es valida!");
		}
		if(strcmp($password, $passwordConfirm) !== 0){
			array_push($errores, "La confirmción de la contraseña no coincide!");
		}
		
		return $errores;
	}
	
	public function modificarDatos(){
		$errores = array();
		$modificarPassword = $_POST["modificarPassword"];
		if($this->verificarModificacion($modificarPassword)){
			$password = $_POST["password"];
			$passwordConfirm = $_POST["passwordConfirm"];
			if($modificarPassword === "true"){
				if(strcmp($password, $passwordConfirm) !== 0){
					array_push($errores, "La confirmción de la contraseña no coincide!" );
				}
			}
			$fechaNac = $_POST["fechaNac"];
			//Valido las fechas
			if(!GenericUtils::getInstance()->isFechaValida($fechaNac)){
				array_push($errores, "La fecha ingresada no es valida!");
			}
		}else{
			array_push($errores, "Debes modificar algun dato!" );
		}
		return $errores;
	}
	
	private function verificarModificacion($modificarPassword){
		if($modificarPassword === "true"){
			return true;
		}
		$valores = array($_POST["nick"], $_POST["nombre"], 
				$_POST["apellido"], $_POST["email"], 
				$_POST["fechaNac"], $_POST["celular"]);
		foreach ($valores as $valor){
			if(!in_array($valor, $this->usuario, true)){
				return true;
			}
		}
		return false;
	}
	
	public function bajaCuenta(){
		$errores = array();
		$password = $_POST["password"];
		if(strcmp($password, $this->usuario["password"]) !== 0){
			array_push($errores, "Contraseña Inválida!" );
		}
		return $errores;
	}
	
	public function login(){
		$errores = array();
		$nick = $_POST["nick"];
		$password = $_POST["password"];
		if(!empty($nick) && empty($password)){
			$usuario = $this->usuarioModel->obtenerUsuario($nick);
			if($usuario === null){
				array_push($errores, "El nick no existe en el sistema!" );
			}
		}else if(!empty($password) && !empty($nick)){
			$usuario = $this->usuarioModel->obtenerUsuario($nick);
			if(strcmp($password, $usuario["password"]) !== 0){
				array_push($errores, "Contraseña Inválida!" );
			}
		}
		return $errores;
	}
	
}