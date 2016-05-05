<?php 
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/librosModel.php");
require_once("model/clientesModel.php");

require_once("helpers/Helpers.php");
$re=new Ventas();
$det=new detalleVentas();
$vcre=new creditoVentas();
$vcon=new ventasContado();
$l=new Libros();
$cliente=new Clientes();


if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
$res3=$vcre->getVenta($_GET["id"]);
$res4=$vcon->getVenta($_GET["id"]);
require_once("view/verNotaVenta.php");

}
?>