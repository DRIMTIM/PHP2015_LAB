<?php

class ErrorsController extends BaseController {
	
	public function index() {
		$this->registry->template->mensaje = 'La pagina solicitada no existe!';
		$this->registry->template->show('errors/error404');
	}

}
?>
