<?php
define("SUCURSAL", "COCHABAMBA");
define("VENTA", "10");
define("ABREV", "OF-CBBA");
define("SESSION", "COCHABAMBA");
define("CABECERA","c. Heroes del Boqueron N&deg;1549 Telf:4534660-61-63-Cochabamba<br/>
            E-mail:comercial bolivia@visualediciones.com<br/>www.visualediciones.com");
session_start();
require_once("helpers/conexion.php");
require_once("helpers/Helpers.php");
class config{
	
	
	public function  comillas_inteligentes($valor){
		if(get_magic_quotes_gpc()){
			$valor=stripcslashes($valor);
			
		}
		if(is_numeric($valor)){
			$valor="'".mysql_real_escape_string($valor)."'";
			
			}
			return $valor;
	}
	 static function ruta(){
		 
		 return "http://127.0.0.1/visual/";
		 }
 static function server(){
		 
		  return "http://127.0.0.1/";
		 }

	}

 ?>