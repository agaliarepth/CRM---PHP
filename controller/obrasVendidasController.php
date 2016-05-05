<?php 
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/librosModel.php");
require_once("model/vendedoresModel.php");
require_once("model/tipoCambioModel.php");
$tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);



$detalleVentas=new detalleVentas();
$libros=new Libros();
$vendedor=new Vendedores();
	$listaVendedores1=$vendedor->listarTodos();


if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	
		$lista=$detalleVentas->relacionObrasVendidas($mes,$anio);
		$listaVendedores=$detalleVentas->listaVendedores($mes,$anio);
	
	}
	
	if(isset($_POST["consulta2"])&& $_POST["consulta2"]=="consulta2"){
	
	$mes1=$_POST["mes_ini"]; $mes2=$_POST["mes_fin"]; $anio=$_POST["anio2"]; $idvendedor=$_POST["idvendedor"];
	 if($_POST["idvendedor"]=="-1"){
	
		$listaCodigos=$detalleVentas->listaCodigosMeses($mes1,$mes2,$anio);
	 }
	 else{
		 
		$listaCodigos=$detalleVentas->listaCodigosMesesVendedor($mes1,$mes2,$anio,$idvendedor);
		 
		 
		 }
	}

require_once("view/obrasVendidas.PHP");




?>