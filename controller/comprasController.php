<?php 

require_once("model/comprasModel.php");
require_once("model/detalleComprasModel.php");
require_once("model/proveedoresModel.php");


$det=new detalleCompras();
$c=new Compras();
$p=new Proveedores();

$res=$c->getTipo("contado");
$res2=$c->getTipo("credito");


require_once("view/compras.php");
if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="b"){

	
	
    $c->borrar($_GET["id"]);




header("Location:".config::ruta()."?accion=compras");
}

?>