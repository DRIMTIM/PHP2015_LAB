<?php
class UserModel extends AbstractModel{
    
	protected $id = NULL;
	protected $nick = NULL;
	protected $nombre = NULL;
	protected $apellido = NULL;
	protected $email = NULL;
	protected $fechaNac = NULL;
	protected $celular = NULL;
	protected $password = NULL;
	protected $passwordConfirm = NULL;
    protected $edad = NULL;
    protected $modificarPassword = false;
    protected $timeZone = NULL;
    
	public function __construct($registry){
		parent::__construct($registry);
    	$this->table_name = "USUARIOS";
    }	
        
	public function guardar(){
		$this->fromArray($_POST);
		$data = $this->toArray();
		//Quito los campos que no existen en la base
		unset($data["passwordConfirm"]);
		//Formateo la fecha de nacimiento al formato de sql
		$data["fechaNac"] = GenericUtils::getInstance()->getFormatDateIn($data["fechaNac"]);
		//Calculo la edad
		$data["edad"] = GenericUtils::getInstance()->getYears($data["fechaNac"]);
		//Obtengo la timezone del cliente para guardarla en la base.
		$timeZone = $_SESSION[__CLIENT_TIME_ZONE];
		$data["timeZone"] = $timeZone;
		return $this->registry->db->insert($this->table_name, $data);
	}
	
	public function borrar($idUsuario){
		return $this->registry->db->where("id", $idUsuario)->delete($this->table_name, 1);
	}

	public function obtenerUsuario($nick){
		$usuario = $this->registry->db->where("nick", $nick)->get($this->table_name);
		if(count($usuario) > 0){
			//Formateo la fecha nac de salida
			$usuario[0]["fechaNac"] = GenericUtils::getInstance()->getFormatDateOut($usuario[0]["fechaNac"]);
		}
		return $usuario[0];
	}
	
	public function updateUsuario($idUsuario){
		$this->fromArray($_POST);
		$data = $this->toArray();
		//Quito los campos que no existen en la base
		unset($data["passwordConfirm"]);
		unset($data["modificarPassword"]);
		//Formateo la fecha de nacimiento al formato de sql
		$data["fechaNac"] = GenericUtils::getInstance()->getFormatDateIn($data["fechaNac"]);
		return $this->registry->db->where("id", $idUsuario)->update($this->table_name, $data);
	}
}
?>