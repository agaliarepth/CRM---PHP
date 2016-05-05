<?php 
require_once("model/ingresoModel.php");
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/librosModel.php");

$li=new Libros();

$ni=new Ingreso();
$ne=new Egreso();
$det1=new detalleIngreso();
$det2=new detalleEgreso();
 
if(isset($_POST["consulta"])&&($_POST["notas"]=="ingreso")){
	//print_r($_POST);
	$fecha="".$_POST["anio"]."-".$_POST["mes"]."-1";
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	
	
			$res=$det1->reportePorMes($mes,$anio);
		
		
	}
	
	if(isset($_POST["consulta"])&&($_POST["notas"]=="egreso")){
	//print_r($_POST);
	$fecha="".$_POST["anio"]."-".$_POST["mes"]."-1";
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	
	
			$res=$det2->reportePorMes($mes,$anio);
		
		
	}


	
	

require_once("view/relacionNotas.php");



?>