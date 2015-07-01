<?php

class IndexController extends BaseController {

	private $categoriasModel = NULL;
	private $ofertasStockModel = NULL;
	private $ofertasTemporalesModel = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->categoriasModel = new CategoryModel($this->registry);
		$this->ofertasStockModel = new StockOfferModel($this->registry);
		$this->ofertasTemporalesModel = new TemporalOfferModel($this->registry);
	}
		
	public function index() {
		/*** Cargo las categorias en el template para mostrarlas ***/
	    $this->registry->template->categorias = $this->categoriasModel->getAll();
	    /*** Cargo las ofertas en el template para mostrarlas ***/
	    $this->registry->template->ofertasStock = $this->ofertasStockModel->getAll();
	    $this->registry->template->ofertasTemporales = $this->ofertasTemporalesModel->getOfertasDelDia();
	    /*** Cargo las ofertas recomendadas***/
	    $ofertasStock = $this->ofertasStockModel->getOfertasValidas();
	    $ofertasTemporales = $this->ofertasTemporalesModel->getOfertasDelDia();
	    $ofertasRecomendadas = array_merge($ofertasStock, $ofertasTemporales);
	    /*** Mezclo las ofertas ***/
	    shuffle($ofertasRecomendadas);
	    $this->registry->template->ofertasRecomendadas = $ofertasRecomendadas;
		/*** load the index template ***/
	    $this->registry->template->show('index');
	}

}

?>
