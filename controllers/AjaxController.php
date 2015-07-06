<?php

class AjaxController extends BaseController {

	private $ofertasTemporalesModel = NULL;
	private $ofertasStockModel = NULL;
	private $ofertasModel = NULL;
	
	public function __construct($registry){
		parent::__construct($registry);
		$this->ofertasTemporalesModel = new TemporalOfferModel($this->registry);
		$this->ofertasStockModel = new StockOfferModel($this->registry);
		$this->ofertasModel = new OfferModel($this->registry);
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
	
	public function loadOfertasForSearch(){
		$ofertasDelDia = $this->ofertasTemporalesModel->getOfertasDelDia();
		$ofertasStock = $this->ofertasStockModel->getOfertasValidas();
		$ofertasComunes = $this->ofertasModel->getAll();
		$ofertasForSearch = array();
		$aux = array();
		if(!empty($ofertasDelDia)){
			foreach ($ofertasDelDia as $ofertaDelDia){
				array_push($aux, $ofertaDelDia);
			}
		}
		if(!empty($ofertasStock)){
			foreach ($ofertasStock as $ofertaStock){
				array_push($aux, $ofertaStock);
			}
		}
		if(!empty($ofertasComunes)){
			foreach ($ofertasComunes as $ofertaComun){
				array_push($aux, $ofertaComun);
			}
		}
		array_push($ofertasForSearch, $aux);
		foreach ($ofertasForSearch as $ofertaForSearch){
			echo json_encode($ofertaForSearch);
		}
	}
	
}
