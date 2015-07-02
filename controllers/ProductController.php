<?php

class ProductController extends BaseController {

	private $compraModel = NULL;
	private $ofertasModel = NULL;

	public function __construct($registry){
		parent::__construct($registry);
		$this->compraModel = new CompraModel($this->registry);
		$this->ofertasModel = new OfferModel($this->registry);
	}

	public function index() {
		if($this->usuario == NULL){
			$this->registry->template->show('user/login');
		}else{
			$uriOferta = $_SESSION[__COMPRA_ACTIVA];
			$this->registry->template->ofertaSeleccionada = $this->ofertasModel->findOffer($uriOferta);
			$this->registry->template->show('product/compraConfirm');
		}
	}

	public function realizarCompra(){
		$uriOferta = $_SESSION[__COMPRA_ACTIVA];
		$_SESSION[__COMPRA_ACTIVA] = null;
		$errores = array();
		if($uriOferta == null){
			array_push($errores, "Ha ocurrido un error con su solicitud, intente mas tarde!");
		}else{			
			$oferta = $this->ofertasModel->findOffer($uriOferta);
			if(!$oferta["stock"] > 0){
				array_push($errores, "Ya no disponemos de stock para esta oferta!");
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