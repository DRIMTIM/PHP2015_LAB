<?php

class ProductController extends BaseController {

	private $compraModel = NULL;
	private $ofertasModel = NULL;

	public function __construct($registry){
		parent::__construct($registry);
		$this->compraModel = new CompraModel($this->registry);
		$this->ofertasModel = new OfferModel($this->registry);
	}

	public function categoria(){
		$this->registry->template->ofertas = $this->ofertasModel->getAllOfCategory($_GET["categoria"]);
		$this->registry->template->show('product/category');
	}
	
	public function index() {
		$uriOferta = $_GET["oferta"];
		if(empty($uriOferta)){
			$uriOferta = $_SESSION[__COMPRA_ACTIVA];
		}else{
			$_SESSION[__COMPRA_ACTIVA] = $uriOferta;
		}
		$oferta = $this->ofertasModel->findOffer($uriOferta);
		$oferta["id"] = $uriOferta;
		$this->registry->template->ofertaSeleccionada = $oferta;
		$this->registry->template->show('product/compraConfirm');
	}
	
	public function consultaCompras(){
		$comprasRealizadas = array();
		$compras = $this->compraModel->getAllForUserId($this->usuario["id"]);
		foreach ($compras as $compra){
			$ofertaComprada = $this->ofertasModel->findOfferById($compra["id_oferta"]);
			$compra["oferta"] = $ofertaComprada;
			$compra["fecha"] = GenericUtils::getInstance()->getFormatDateOut($compra["fecha"]);
			array_push($comprasRealizadas, $compra);
		}
		$this->registry->template->compras = $comprasRealizadas;
		$this->registry->template->show('product/compras');
	}

	public function realizarCompra(){
		if($this->usuario == NULL){
			$this->registry->template->show('user/login');
		}else{
			$uriOferta = $_SESSION[__COMPRA_ACTIVA];
			$_SESSION[__COMPRA_ACTIVA] = null;
			$errores = array();
			if($uriOferta == null){
				array_push($errores, "Ha ocurrido un error con su solicitud, intente mas tarde!");
			}else{
				$oferta = $this->ofertasModel->findOffer($uriOferta);
				if(!$oferta["stock"] > 0 && GenericUtils::getInstance()->getTableNameFromUri($uriOferta) == TableNames::OFERTAS_STOCK){
					array_push($errores, "Ya no disponemos de stock para esta oferta!");
				}
				if(GenericUtils::getInstance()->getTableNameFromUri($uriOferta) == TableNames::OFERTAS_TEMPORALES &&
						GenericUtils::getInstance()->isOld($oferta["fecha_fin"])){
					array_push($errores, "Esta oferta ha expirado!");
				}
				if(empty($errores)){
					$ticket = $this->compraModel->guardar($this->usuario["id"], $uriOferta);
					$this->registry->template->ticket = $ticket;
					if(empty($ticket)){
						array_push($errores, "Ha ocurrido un error con su solicitud, intente mas tarde!");
					}
				}
			}
			$this->registry->template->errores = $errores;
			$this->registry->template->show('product/compraConfirm');
		}
	}
}