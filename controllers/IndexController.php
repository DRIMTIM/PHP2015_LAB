<?php

class IndexController extends BaseController {

	private $categoriasModel = NULL;
	private $ofertasStockModel = NULL;
	private $ofertasTemporalesModel = NULL;
	private $ofertasModel = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->categoriasModel = new CategoryModel($this->registry);
		$this->ofertasStockModel = new StockOfferModel($this->registry);
		$this->ofertasTemporalesModel = new TemporalOfferModel($this->registry);
		$this->ofertasModel = new OfferModel($this->registry);
	}
		
	public function index() {
		/*** Cargo las categorias en el template para mostrarlas ***/
		$this->registry->template->categorias = $this->categoriasModel->getAll();
		/*** Cargo las ofertas recomendadas***/
		$ofertasStock = $this->ofertasStockModel->getOfertasValidas();
		$ofertasTemporales = $this->ofertasTemporalesModel->getOfertasDelDia();
		$ofertasComunes = $this->ofertasModel->getAll();
		$ofertasRecomendadas = array_merge($ofertasStock, $ofertasTemporales, $ofertasComunes);
		/*** Mezclo las ofertas ***/
		shuffle($ofertasRecomendadas);
	    /*** Cargo las ofertas en el template para mostrarlas ***/
		$this->registry->template->ofertasRecomendadas = $ofertasRecomendadas;
		$this->registry->template->ofertasStock = $ofertasStock;
	    $this->registry->template->ofertasTemporales = $ofertasTemporales;
	    $this->registry->template->ofertasComunes = $ofertasComunes;
		/*** load the index template ***/
	    $this->registry->template->show('index');
	}

}

?>
