<?php
class TemporalOfferModel extends OfferModel{
	
	protected $super_table_name = NULL;
	protected $fecha_inicio = NULL;
	protected $fecha_fin = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->super_table_name = $this->table_name;
		$this->table_name = TableNames::OFERTAS_TEMPORALES;
	}
	
	/**
	 * Retorna las ofertas que no vencieron aun y que estan vigentes, 
	 * agrega solo las ofertas que su fecha de inicio ya paso y su fecha fin aun no, ademas las que estan activas.
	 */
	public function getOfertasValidas(){
		$ofertasValidas = array();
		$ofertas = $this->getAll();
		
		foreach ($ofertas as $oferta){
			if(!GenericUtils::getInstance()->isOld($oferta["fecha_fin"]) && 
				GenericUtils::getInstance()->isOld($oferta["fecha_inicio"]) &&
				$oferta["activa"] == true){
				array_push($ofertasValidas, $oferta);
			}
		}
		
		return $ofertasValidas;
	}
	
	public function getOfertasDelDia(){
		$ofertasDelDia = array();
		$ofertas = $this->getOfertasValidas();
		foreach ($ofertas as $oferta){
			if(GenericUtils::getInstance()->isTodayInterval($oferta["fecha_inicio"], $oferta["fecha_fin"])){
				array_push($ofertasDelDia, $oferta);
			}
		}
		return $ofertasDelDia;
	}
	
	public function getAll(){
		$items = $this->registry->db->join($this->super_table_name . " AS O", "O.id = OT.id", "INNER")->get($this->table_name . " AS OT");
		for ($count = 0; $count < count($items); $count++){
			$items[$count]["id"] = GenericUtils::getInstance()->generateUri($items[$count]["id"], TableNames::OFERTAS_TEMPORALES);
			$items[$count]["precio"] = GenericUtils::getInstance()->roundPriceTwoDecimals($items[$count]["precio"]);
		}
		return $items;
	}
	
}
?>