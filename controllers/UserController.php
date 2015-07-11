<?php

class UserController extends BaseController {

	private $usuarioModel = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->usuarioModel = new UserModel($this->registry);
	}
	
	public function index() {
        $this->registry->template->showOther('index');
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
	public function loginSocial(){
		// the selected provider
		$provider_name = $_REQUEST["provider"];
		
		try
		{
			// inlcude HybridAuth library
			// change the following paths if necessary
			$config   = __SITE_PATH . '/includes/library/config.php';
			require_once( "includes/library/Hybrid/Auth.php" );
		
			// initialize Hybrid_Auth class with the config file
			$hybridauth = new Hybrid_Auth( $config );
		
			// try to authenticate with the selected provider
			$adapter = $hybridauth->authenticate( $provider_name );
		
			// then grab the user profile
			$user_profile = $adapter->getUserProfile();
		}
		
		// something went wrong?
		catch( Exception $e )
		{
			$this->index();
			return;
		}
		
		// check if the current user already have authenticated using this provider before
		$user_exist = get_user_by_provider_and_id( $provider_name, $user_profile->identifier );
		
		// if the used didn't authenticate using the selected provider before
		// we create a new entry on database.users for him
		if( ! $user_exist )
		{
			create_new_hybridauth_user(
					$user_profile->email,
					$user_profile->firstName,
					$user_profile->lastName,
					$provider_name,
					$user_profile->identifier
			);
		}
		
		// set the user as connected and redirect him
		$_SESSION["user_connected"] = true;
		
		$this->index();
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
