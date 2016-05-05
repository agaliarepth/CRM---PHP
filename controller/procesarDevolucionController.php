<?php 
require_once("model/devolucionModel.php");
require_once("model/ingresoModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/ventasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/cuotasModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/librosModel.php");
require_once("model/deudasModel.php");
$id=$_GET["id"];
$li=new Libros();
$devo=new Devolucion();
$det=new detalleDevolucion();
$ven=new Ventas();
$ing=new Ingreso();
$deting=new detalleIngreso();
$cred=new creditoVentas();
$cuota=new Cuotas();
$deuda=new deuda();


$detalle=$det->getDetalle($id);
$devolucion=$devo->getId($_GET["id"]);
$venta=$ven->getId($devolucion["idventas"]);
$deudas=$deuda->getId($devolucion["iddeudas"]);
if(isset($_GET["id"])){
	//$deudas=$deuda->getId();
	
	
	}
if(isset($_POST["procesar"])){
	print_r($_POST);
	
	$devolucion=$devo->getId($_POST["iddevolucion"]);
	$venta=$ven->getId($devolucion["idventas"]);
	
	$sum_monto=0;
	if($_POST["tipodevolucion"]=="venta"){
		
		
             if($venta["tipoventa"]=="CREDITO"){
				 $credito=$cred->getCreditoByVenta($_POST["idventas"]);
	
	    for($i=0; $i<$_POST["total_filas"];$i++){
	   
	   if(isset($_POST["elegido"][$i])){
			  
	     $pos=$_POST["elegido"][$i];
		$cuota->updateSaldo($_POST["idcuotas"][$pos],$_POST["montodevo"][$pos]);
		$sum_monto+=$_POST["montodevo"][$pos];
				 }
				 
		            }
				 }
			 
			 
			 if($venta["tipoventa"]=="CONTADO" && $_POST["descontar"]==1){
			
	
	    for($i=0; $i<$_POST["total_filas"];$i++){
	   
	              if(isset($_POST["elegido"][$i])){
			  
	                 $pos=$_POST["elegido"][$i];
		             $cuota->updateSaldo($_POST["idcuotas"][$pos],$_POST["montodevo"][$pos]);
		             $sum_monto+=$_POST["montodevo"][$pos];
				                               }
				 
		                                  }
										  
			                                         	 }
														 
			$devo->updateSaldo($devolucion["iddevolucion"],$sum_monto);								 
		    
		}
		
		
		
		
		
	if($_POST["tipodevolucion"]=="deuda"){
		
	$deuda->updateSaldo($devolucion["iddeudas"],$devolucion["total"]);

		}
	
	$ingreso=$ing->getId($_POST["idingreso"]);
	$detalleingreso=$deting->getDetalle($_POST["idingreso"]);
	$ing->actualizarEstado($_POST["idingreso"]);
	
	foreach($detalleingreso as $r){
		
		$li->sumarStock($r["libros_idlibros"],$r["cantidad"]);
		
	                               }
								   
	
		$devo->actualizarEstado($_POST["iddevolucion"],1,"DEVUELTO");
		
			 
	    header("Location:".config::ruta()."?accion=devoluciones");
	
	
	}
require_once("view/procesarDevolucion.php");
?>