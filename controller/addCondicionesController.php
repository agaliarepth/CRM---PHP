<?php 
require_once("model/ventasCreditoModel.php");
require_once("model/detalleVentasCreditoModel.php");

$v=new VentasCredito();
$det=new detalleVentasCredito();
	
	
	$res=$v->getId($_GET["id"]);
	$res2=$det->getDetalle($_GET["id"]);
require_once("view/addCondiciones.php");

?>