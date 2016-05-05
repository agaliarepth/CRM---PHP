<?php 
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/librosModel.php");
require_once("model/vendedoresModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/clientesModel.php");

$tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);



$cliente=new Clientes();
$detalleVentas=new detalleVentas();
$libros=new Libros();
$vendedor=new Vendedores();
$listaVendedores=$vendedor->listarTodos();

if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	
	$mes=$_POST["mes"]; $anio=$_POST["anio"]; $idvendedor=$_POST["idvendedor"];
	
	 if($_POST["idvendedor"]=="-1"){
	$listaClientes=$detalleVentas->listaClientesTodos($mes, $anio);
	 }
	 else{
		 	$listaClientes=$detalleVentas->listaClientes($mes, $anio,$idvendedor);

		 
		 }
	
	
	}
	
	if(isset($_POST["consulta2"])&& $_POST["consulta2"]=="consulta2"){
	
	$mes1=$_POST["mes_ini"]; $mes2=$_POST["mes_fin"]; $anio=$_POST["anio2"]; $idvendedor=$_POST["idvendedor2"];
	
	   if($_POST["idvendedor2"]=="-1"){
		 
	$listaClientes=$detalleVentas->listaClientesPeriodoTodos($mes1,$mes2, $anio);
	   }
	   else
	   {
		   $listaClientes=$detalleVentas->listaClientesPeriodo($mes1,$mes2, $anio,$idvendedor);
		   
		   }
		
	
	
	}

require_once("view/produccionVentas.php");


