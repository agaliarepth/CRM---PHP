<?php 
require_once("model/devolucionModel.php");
require_once("model/ingresoModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/ventasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/cuotasModel.php");
$id=$_GET["id"];

$devo=new Devolucion();
$det=new detalleDevolucion();
$detalle=$det->getDetalle($id);
$monto=$devo->getId($_GET["id"]);

require_once("view/aceptarDevolucion.php");
?>