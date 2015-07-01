<?php
class CategoryModel extends AbstractModel{
    
	protected $id = null;
	protected $nombre = null;
	protected $descripcion = null;
	
	public function __construct($registry){
		parent::__construct($registry);
    	$this->table_name = "CATEGORIAS";
    }
	
}
?>