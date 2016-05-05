<?php 
require_once("model/IngresoModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/librosModel.php");
require_once("helpers/Helpers.php");
$re=new Ingreso();
$det=new detalleIngreso();
$l=new Libros();

if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
$nom=$al->getEncargado($res["idalmacenes"]);
require_once("view/verIngreso.php");

}
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verIngreso.php");

}
?>