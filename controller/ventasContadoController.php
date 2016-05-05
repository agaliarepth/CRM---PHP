<?php 

require_once("model/ventasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/clientesModel.php");
require_once("model/detalleVentasModel.php");



$det=new detalleVentas();
$v=new Ventas();
$cv=new creditoVentas();
$c=new Clientes();



  $res=$v->listarTodosContado();

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="b"){
    $v->borrar($_GET["id"]);
     
header("Location:".config::ruta()."?accion=ventasCredito");
}

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="confirmar"){
	
    $v->terminado($_GET["id"]);
	header("Location:".config::ruta()."?accion=ventasCredito");
	

	
	}
require_once("view/ventasContado.php");
?>