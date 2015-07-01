<?php

class AjaxController extends BaseController {

	private $ofertasTemporalesModel = NULL;
	private $ofertasStockModel = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->ofertasTemporalesModel = new TemporalOfferModel($this->registry);
		$this->ofertasStockModel = new StockOfferModel($this->registry);
	}
	
	public function index() {
		$this->registry->template->show('user/index');
	}
	
	public function saveClientTimeZone(){
		$_SESSION[__CLIENT_TIME_ZONE] = $_POST[__CLIENT_TIME_ZONE];
		$response = $_SESSION[__CLIENT_TIME_ZONE];
		echo $this->getOKMessage($response);
	}
	
	public function refreshOfertasRecomendadas(){
		$ofertasStock = $this->ofertasStockModel->getOfertasValidas();
		$ofertasTemporales = $this->ofertasTemporalesModel->getOfertasDelDia();
		$ofertasRecomendadas = array_merge($ofertasStock, $ofertasTemporales);
		/*** Mezclo las ofertas ***/
		shuffle($ofertasRecomendadas);
		$this->registry->template->ofertasRecomendadas = $ofertasRecomendadas;		
		$this->registry->template->show('product/ofertasRecomendadas');
	}
	
	public function refreshOfertasDelDia(){
		$this->registry->template->ofertasTemporales = $this->ofertasTemporalesModel->getOfertasDelDia();
		$this->registry->template->show('product/ofertasTemporales');
	}
	
	/**
	 * Guarda el id de la oferta en sesion para la confirmación de la compra
	 */
	public function agregarCompraActiva(){
		$uriOferta = $_POST["uri_oferta"];
		$_SESSION[__COMPRA_ACTIVA] = $uriOferta;
		return $this->getOKMessage($uriOferta);
	}
	
	public function quitarCompraActiva(){
		$_SESSION[__COMPRA_ACTIVA] = null;
		return $this->getOKMessage(GlobalConstants::$OK);
	}
	
}
