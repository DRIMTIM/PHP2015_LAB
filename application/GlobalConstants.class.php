<?php
class GlobalConstants {
	public static $OK = "OK";
	public static $EQUAL = "=";
	public static $PLUS = "+";
	public static $COLON = ":";
	public static $SEMI_COLON = ";";
	public static $SPACE = " ";
	//Formatos de fecha para el plugin de jquery
	public static $jqueryDateFormat = "dd/mm/yy";
	public static $jqueryTimeFormat = "HH:mm:ss";
	public static $jqueryDateTimeFormat = "dd/mm/yy HH:mm:ss";
	//Formatos de fecha para mysql
	public static $sqlDateFormat = "Y-m-d";
	public static $sqlTimeFormat = "H:i:s";
	public static $sqlDateTimeFormat = "Y-m-d H:i:s";
	//Formatos de fecha para la conversion desde la base al front
	public static $sqlToJqueryDateTimeFormat = "d/m/Y H:i:s";
	public static $sqlToJqueryDateFormat = "d/m/Y";
	//Tiempo en minutos entre pools para refrescar las ofertas temporales
	public static $UPDATE_OFERTAS_TIMEOUT = (1000 * 60) * 1;
	public static $URI_DRIM = "uriDrim=";
	public static $ARROBA = "@";
}