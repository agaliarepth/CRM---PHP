<?php 
require_once("model/comprasModel.php");
require_once("model/detalleComprasModel.php");
require_once("model/librosModel.php");
require_once("model/proveedoresModel.php");
$re=new Compras();
$det=new detalleCompras();
$l=new Libros();
$p=new Proveedores();

if(isset($_POST["id"])){
$res=$re->getId($_POST["id"]);
$res2=$det->getDetalle($_POST["id"]);
require_once("view/verCompra.php");

}
if(isset($_GET["id"])){
$res=$re->getId($_GET["id"]);
$res2=$det->getDetalle($_GET["id"]);
require_once("view/verCompra.php");

}
?>