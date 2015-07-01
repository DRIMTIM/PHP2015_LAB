<?php
class OfferModel extends AbstractModel{
    
	protected $id = NULL;
    protected $titulo = NULL;
    protected $imagen = NULL;
    protected $descripcion = NULL;
    protected $descripcion_corta = NULL;
    protected $precio = NULL;
    protected $moneda = NULL;
    protected $activa = NULL;
	
    public function __construct($registry){
    	parent::__construct($registry);
    	$this->table_name = TableNames::OFERTAS;
    }
    
    public function findOffer($uriOferta){
    	if(!empty($uriOferta)){
    		$idOferta = GenericUtils::getInstance()->getIdFromUri($uriOferta);
    		$tableName = GenericUtils::getInstance()->getTableNameFromUri($uriOferta);

    		switch ($tableName){
    			case TableNames::OFERTAS_STOCK:
    			case TableNames::OFERTAS_TEMPORALES:
    				return $this->registry->db->join(TableNames::OFERTAS . " AS O", "O.id = AUX.id AND O.id = " . $idOferta, "INNER")->getOne($tableName . " AS AUX");
    			default:
    				return $this->registry->db->where("id", $id)->getOne(TableNames::OFERTAS);
    		}
    		
    	}
    	return null;
    }
    
}
?>