<?php
class CompraModel extends AbstractModel {
    
	protected $id = NULL;
	protected $id_usuario = NULL;
	protected $id_oferta = NULL;
	protected $ticket = NULL;
    
	public function __construct($registry){
		parent::__construct($registry);
    	$this->table_name = TableNames::COMPRAS;
    }	
        
	public function guardar($idUsuario, $uriOferta){
		$idOferta = GenericUtils::getInstance()->getIdFromUri($uriOferta);		
		$data = array("id_usuario" => $idUsuario, "id_oferta" => $idOferta);
		$idCompra = $this->registry->db->insert($this->table_name, $data);
		$ticket = GenericUtils::getInstance()->generarTicket($idCompra);
		$data = array("ticket" => $ticket);
		$this->registry->db->where("id", $idCompra)->update($this->table_name, $data);
		return $ticket;
	}
	
	public function borrar($idCompra){
		return $this->registry->db->where("id", $idCompra)->delete($this->table_name, 1);
	}

}
?>