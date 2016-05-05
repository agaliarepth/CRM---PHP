<?php 
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/librosModel.php");
require_once("helpers/Helpers.php");
$re=new Egreso();
$det=new detalleEgreso();
$l=new Libros();


if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verNotaEntrega.php");

}
?>