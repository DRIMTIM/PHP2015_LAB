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
    protected $id_categoria = NULL;

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
    				$oferta = $this->registry->db->join(TableNames::OFERTAS . " AS O", "O.id = AUX.id AND O.id = " . $idOferta, "INNER")->getOne($tableName . " AS AUX");
    				$oferta = $this->mapImagesForList(array($oferta))[0];
    				return $oferta;
    			default:
    				$oferta = $this->registry->db->where("id", $idOferta)->getOne(TableNames::OFERTAS);
    				$oferta = $this->mapImagesForList(array($oferta))[0];
    				return $oferta;
    		}

    	}
    	return null;
    }
    
    public function findOfferById($idOferta){
    	if(!empty($idOferta)){
    		$oferta = $this->registry->db->join(TableNames::OFERTAS . " AS O", "O.id = AUX.id AND O.id = " . $idOferta, "INNER")->getOne(TableNames::OFERTAS_TEMPORALES . " AS AUX");
    		if(empty($oferta)){
    			$oferta = $this->registry->db->join(TableNames::OFERTAS . " AS O", "O.id = AUX.id AND O.id = " . $idOferta, "INNER")->getOne(TableNames::OFERTAS_STOCK . " AS AUX");
    		}
    		if(empty($oferta)){
    			$oferta = $this->registry->db->where("id", $idOferta)->getOne(TableNames::OFERTAS);  			
    		}
    		$oferta = $this->mapImagesForList(array($oferta))[0];
    		return $oferta;
    	}
    	return null;
    }
    
    public function getAllOfCategory($uriCategoria){
    	$idCategoria = GenericUtils::getInstance()->getIdFromUri($uriCategoria);
    	$ofertasTemporales = $this->registry->db->
    		join(TableNames::CATEGORIAS_OFERTAS . " AS CO", "O.id = CO.id_oferta AND CO.id_categoria = " . $idCategoria, "INNER")->
    		join(TableNames::OFERTAS_TEMPORALES . " AS OT", "O.id = OT.id", "INNER")->
    		get(TableNames::OFERTAS . " AS O");
    	$ofertasStock = $this->registry->db->
	    	join(TableNames::CATEGORIAS_OFERTAS . " AS CO", "O.id = CO.id_oferta AND CO.id_categoria = " . $idCategoria, "INNER")->
	    	join(TableNames::OFERTAS_STOCK . " AS OS", "O.id = OS.id", "INNER")->
	    	get(TableNames::OFERTAS . " AS O");
    	$ofertasNormales = $items = $this->registry->db->
    		query("SELECT * FROM " . 
    				TableNames::OFERTAS . " O WHERE NOT EXISTS (SELECT 1 FROM ". 
    				TableNames::OFERTAS_STOCK . " OS WHERE O.id = OS.id) AND NOT EXISTS (SELECT 1 FROM " . 
    				TableNames::OFERTAS_TEMPORALES . " OT WHERE O.id = OT.id) AND O.id = " . $idCategoria);
    	$ofertasPorCategoria = array();
    	foreach ($ofertasTemporales as $ofertaTemporal){
    		$ofertaTemporal["id"] = GenericUtils::getInstance()->generateUri($ofertaTemporal["id"], TableNames::OFERTAS_TEMPORALES);
    		if(!GenericUtils::getInstance()->isOld($ofertaTemporal["fecha_fin"]) &&
    				GenericUtils::getInstance()->isOld($ofertaTemporal["fecha_inicio"]) &&
    				GenericUtils::getInstance()->isTodayInterval($ofertaTemporal["fecha_inicio"], $ofertaTemporal["fecha_fin"]) &&
    				$ofertaTemporal["activa"] == true){
    					array_push($ofertasPorCategoria, $ofertaTemporal);
    		}
    	}
    	foreach ($ofertasStock as $ofertaStock){
    		$ofertaStock["id"] = GenericUtils::getInstance()->generateUri($ofertaStock["id"], TableNames::OFERTAS_STOCK);
    		if($ofertaStock["activa"] == true && $ofertaStock["stock"] > 0){
    			array_push($ofertasPorCategoria, $ofertaStock);
    		}
    	}
    	foreach ($ofertasNormales as $ofertaNormal){
    		$ofertaNormal["id"] = GenericUtils::getInstance()->generateUri($ofertaNormal["id"], TableNames::OFERTAS);
    		if($ofertaNormal["activa"] == true){
    			array_push($ofertasPorCategoria, $ofertaNormal);
    		}
    	}
    	return $this->mapImagesForList($ofertasPorCategoria);
    }
    
    public function getAll(){
    	$items = $this->registry->db->
    		query("SELECT * FROM " . 
    				TableNames::OFERTAS . " O WHERE NOT EXISTS (SELECT 1 FROM ". 
    				TableNames::OFERTAS_STOCK . " OS WHERE O.id = OS.id) AND NOT EXISTS (SELECT 1 FROM " . 
    				TableNames::OFERTAS_TEMPORALES . " OT WHERE O.id = OT.id)");
    	if(!empty($items)){
    		for ($count = 0; $count < count($items); $count++){
    			$items[$count]["id"] = GenericUtils::getInstance()->generateUri($items[$count]["id"], TableNames::OFERTAS);
    		}
    	}
    	return $this->mapImagesForList($items);
    }
    
    protected function mapImagesForList($items){
    	$itemsToReturn = array();
    	if(!empty($items)){
    		foreach ($items as $item){
    			if(!is_array($item["imagen"])){
    				$item["imagen"] = explode(GlobalConstants::$FILE_SEPARATOR_FLAG, $item["imagen"]);
    			}
    			array_push($itemsToReturn, $item);
    		}
    	}
    	return $itemsToReturn;
    }
    
}
?>
