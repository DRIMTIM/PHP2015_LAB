<?php
class StockOfferModel extends OfferModel{
	
	protected $stock = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->super_table_name = $this->table_name;
		$this->table_name = TableNames::OFERTAS_STOCK;
	}
	
	public function getAll(){
		$items = $this->registry->db->join($this->super_table_name . " AS O", "O.id = OS.id", "INNER")->get($this->table_name . " AS OS");
		if(!empty($items)){
			for ($count = 0; $count < count($items); $count++){
				$items[$count]["id"] = GenericUtils::getInstance()->generateUri($items[$count]["id"], TableNames::OFERTAS_STOCK);
			}
		}
		return $items;
	}
	
	public function getOfertasValidas(){
		$ofertasValidas = array();
		$ofertas = $this->getAll();
		
		foreach ($ofertas as $oferta){
			if($oferta["activa"] == true && $oferta["stock"] > 0){
				array_push($ofertasValidas, $oferta);
			}
		}
		
		return $ofertasValidas;
	}
	
}
?>