<?php
class GenericUtils {
	//Singleton en PHP
	private static $instance = null;
	private function __construct(){}
	public static function getInstance(){
		if (!self::$instance instanceof self){
			self::$instance = new self;
		}
		return self::$instance;
	}
	/**
	 * Formatea un String de fecha de entrada para transformarlo en un formato valido de mysql.
	 * @param unknown $strDate Date String de entrada
	 * @return String formateado a SQL Date
	 */
	public function getFormatDateIn($strDate){
		$strDate = str_replace("/", "-", $strDate);
		$timeStamp = strtotime($strDate);
		$newDate = date(GlobalConstants::$sqlDateTimeFormat, $timeStamp);
		return $newDate;
	}
	/**
	 * Obtiene la diferencia de años entre la fecha de hoy y la ingresada.
	 * @param unknown $strFechaNac 
	 */
	public function getYears($strFechaNac){
		$strFechaNac = str_replace("/", "-", $strFechaNac);
		$fechaActual = new DateTime();
		$fechaNac = new DateTime($strFechaNac);
		$edad = $fechaActual->diff($fechaNac);
		return $edad->y;
	}
	
	/**
	 * Verifica si una fecha ya paso.
	 * @param unknown $strFecha string fecha de ingreso
	 * @return boolean retorna true si ya paso o false en caso contrario.
	 */
	public function isOld($strFecha){
		$strFecha = str_replace("/", "-", $strFecha);
		$fechaActual = new DateTime();
		$fechaActual = $fechaActual->getTimestamp();
		$fecha = strtotime($strFecha);
		if($fechaActual >= $fecha){
			return true;
		}
		return false;
	}
	/**
	 * Indica si un intervalo de fechas esta dentro del dia actual desde 00:00:00 a 23:59:59
	 * @param unknown $fechaInicio
	 * @param unknown $fechaFin
	 * @return boolean true si esta dentro del dia o false en caso contrario
	 */
	public function isTodayInterval($fechaInicio, $fechaFin){
		if(empty($fechaInicio) || empty($fechaFin)){
			return false;
		}
		//Obtengo los timestamps de la fecha actual de inicio y de fin, desde las 00:00:00 hasta las 23:59:59
		$inicioFechaActual = new DateTime();
		$finFechaActual = new DateTime();
		$inicioFechaActual->setTime(0, 0, 0);
		$finFechaActual->setTime(23, 59, 59);
		$inicioFechaActual = $inicioFechaActual->getTimestamp();
		$finFechaActual = $finFechaActual->getTimestamp();
		//Obtengo los timestamps de las fechas ingresadas
		$fechaInicio = strtotime($fechaInicio);
		$fechaFin = strtotime($fechaFin);
		//Comparo
		if($fechaInicio >= $inicioFechaActual && 
			$fechaFin > $inicioFechaActual &&
			$fechaInicio < $fechaFin && 
			$fechaFin <= $finFechaActual){
			return true;
		}
		return false;
	} 
	
	/**
	 * Formatea un String de fecha de salida para transformarlo en un formato valido del plugin de jquery.
	 * @param unknown $strDate Date String de entrada
	 * @return String formateado a el formato de la app
	 */
	public function getFormatDateOut($strDate){
		$timeStamp = strtotime($strDate);
		$newDate = date(GlobalConstants::$sqlToJqueryDateFormat, $timeStamp);
		return $newDate;
	}
	/**
	 * 
	 * @param unknown $strDate String de fecha de entrada a validar.
	 * @return boolean retorna true si el string de fecha cumple con el patron de fecha, retorna false en caso contrario.
	 */
	public function isFechaValida($strDate){
		$strDate = str_replace("/", "-", $strDate);
		$timeStamp = strtotime($strDate);
		if($timeStamp == false){
			return false;
		}
		return true;
	}
	
	public function roundPriceTwoDecimals($price){
		if(empty($price)){
			return false;
		}
		return round($price, 2, PHP_ROUND_HALF_UP);
	}
	
	public function generateUri($id, $tableName){
		if(!empty($id) && !empty($tableName)){
			return GlobalConstants::$URI_DRIM . $tableName . GlobalConstants::$ARROBA . $id;
		}
		return null;
	}
	
	public function getIdFromUri($uri){
		if(!empty($uri)){
			return substr($uri, strpos($uri, GlobalConstants::$ARROBA) + 1);
		}
		return null;
	}
	
	public function getTableNameFromUri($uri){
		if(!empty($uri)){
			$uriValue = substr($uri, strpos($uri, GlobalConstants::$EQUAL) + 1);
			$tableName = substr($uriValue, 0, strpos($uriValue, GlobalConstants::$ARROBA));
			return $tableName;
		}
		return null;
	}
	
	public function generarTicket($idCompra){
		return rand(0, 50000000) . $idCompra . rand(0, 50000000);
	}
	
}