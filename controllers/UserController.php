<?php

class UserController extends BaseController {

	private $usuarioModel = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->usuarioModel = new UserModel($this->registry);
	}
	
	public function index() {
        $this->registry->template->show('user/index');
	}

	public function signin(){
		$this->registry->template->show('user/signin');
	}
	
	public function account(){
		$this->registry->template->show('user/account');
	}
	
	public function closeAccount(){
		$this->registry->template->show('user/closeAccount');
	}
	
	public function login($errores){
		if(count($errores) > 0){
			$this->registry->template->errores = $errores;
			$this->registry->template->show('user/login');
			return;
		}
		$nick = $_POST["nick"];
		$password = $_POST["password"];
		if(!empty($nick) && empty($password)){
			$usuario = $this->usuarioModel->obtenerUsuario($nick);
			if($usuario !== null){
				$this->registry->template->usuario = $usuario;
			}		
		}else if(!empty($password) && !empty($nick)){
			$usuario = $this->usuarioModel->obtenerUsuario($nick);
			$_SESSION[__USER] = $usuario;
			if($_SESSION[__COMPRA_ACTIVA] != null){
				$this->registry->template->showOther('product/compraConfirm');
			}else{
				$this->index();
			}
			return;
		}
		$this->registry->template->show('user/login');
	}
	
	public function logout(){
		session_unset();
		$this->registry->template->showOther('index');
	}

	/**
	 * Se ejecuta la accion tomando la lista de errores que viene desde el validator en caso de existir uno, sino se asume null.
	 * @param unknown $errores lista de errores validados
	 */
	public function altaUsuario($errores){
		if(count($errores) > 0){
			$this->registry->template->errores = $errores;
			$this->signin();
			return;
		}
		$this->usuarioModel->guardar();
		$this->registry->template->showOther('index');
	}
	
	public function modificarDatos($errores){
		if(count($errores) > 0){
			$this->registry->template->errores = $errores;
			$this->account();
			return;
		}			
		if($modificarPassword !== "true"){
			$_POST["password"] = $this->usuario["password"];
		}
		$this->usuarioModel->updateUsuario($this->usuario["id"]);
		$_SESSION[__USER] = $this->usuarioModel->obtenerUsuario($this->usuario["nick"]);
		$this->index();
	}
	
	public function bajaCuenta($errores){
		if(count($errores) > 0){
			$this->registry->template->errores = $errores;
			$this->closeAccount();
			return;
		}	
		$this->usuarioModel->borrar($this->usuario["id"]);
		session_unset();
		$this->registry->template->showOther('index');
	}
	
}
