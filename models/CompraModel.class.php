<?php
class CompraModel extends AbstractModel {
    
	protected $id = NULL;
	protected $id_usuario = NULL;
	protected $id_oferta = NULL;
	protected $ticket = NULL;
	protected $fecha = NULL;
	protected $oferta = NULL;
    
	public function __construct($registry){
		parent::__construct($registry);
    	$this->table_name = TableNames::COMPRAS;
    }	
        
	public function guardar($idUsuario, $uriOferta){
		$idOferta = GenericUtils::getInstance()->getIdFromUri($uriOferta);		
		$data = array("id_usuario" => $idUsuario, "id_oferta" => $idOferta);
		$idCompra = $this->registry->db->insert($this->table_name, $data);
		$compra = $this->registry->db->where("id", $idCompra)->getOne($this->table_name);
		return $compra["ticket"];
	}
	
	public function borrar($idCompra){
		return $this->registry->db->where("id", $idCompra)->delete($this->table_name, 1);
	}
	
	public function getAllForUserId($idUsuario){
		if(!empty($idUsuario)){
			return $this->registry->db->where("id_usuario", $idUsuario)->get($this->table_name);
		}
		return null;
	}

}
?>