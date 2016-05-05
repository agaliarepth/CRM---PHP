<?php
require_once("model/comprasModel.php");
require_once("model/pagosComprasModel.php");
require_once("model/cargosComprasModel.php");
require_once("model/detalleComprasModel.php");
require_once("model/proveedoresModel.php");
require_once("model/librosModel.php");


$p=new Proveedores();
$proveedores=$p->listartodos();
$cargos=new CargosCompras();
$pagos=new PagosCompras();
$compras=new Compras();
$det=new detalleCompras();
$li=new Libros();
if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	$saldo=0;
	$com=$compras->getComprasKardexAnual("credito",$_POST["proveedores"],$_POST["anio"]);
	$prove=$p->getId($_POST["proveedores"]);
	
	}
require_once("view/kardexProveedor.php");


?>