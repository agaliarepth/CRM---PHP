 <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");


 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);
$ni=new Egreso();
$li=new Libros();

if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="ei" ){
	$d=new detalleEgreso();
	$res4=$ni->getId($_GET["id"]);
	$res3=$d->getDetalle($_GET["id"]);
	 
		 
	
	
	}
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		
		             $de=new detalleEgreso();
					 $de->borrarPorNotaEgreso($_POST["idegreso"]);
					 unset($de);
		
		            
                     $ni->envia=strtoupper($_POST["nombre_envia"]);
					  $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->recibe=strtoupper($_POST["recibe"]);	
 					 $ni->concepto=strtoupper($_POST["tipo"]);	
					  $ni->destino=strtoupper($_POST["destino"]);
					 $ni->cant_total=$_POST["cant_total"];
					  $ni->precio_total=$_POST["monto_total"];
					 $ni->estado="Sin Enviar";
					 $ni->nombre_usuarios=$_SESSION["nombres"];
					  $ni->terminado=0;
					   $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					  $ni->obs=$_POST["obser"];
					  $ni->idventas=0;
					 $ni->actualizar($_POST["idegreso"]);
					
					 $lastID=$_POST["idegreso"];
		 for($i=0; $i<$_POST["num_filas"];$i++){
		  $de=new detalleEgreso();
		 $de->cantidad=$_POST["cantidad"][$i];
		
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->egreso_idegreso=$lastID;
		 $de->obs=$_POST["obs"][$i];
		 $de->insertar();
		 unset($de);
		 

		 }
		 $de= new detalleEgreso();
		  $de->nuevo();
		  unset($de);
		header("Location:".config::ruta()."?accion=notasEgreso");

	 
			  }
	

if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n"){
	$nota=$ni->getId($_GET["id"]);
	$d=new detalleEgreso();
	$det=$d->getDetalle($_GET["id"]);
	$ni->actualizarEstado($_GET["id"]);
	foreach($det as $r){
		 $km=new kardexMayor();
		 $li->quitarStock($r["libros_idlibros"],$r["cantidad"]);
		   $km->idlibros=$r["libros_idlibros"];
			 $km->fecha=$nota["fecha"];
			 $km->procedencia=$nota["recibe"];
			 $km->num_doc=$nota["idegreso"];
			  $km->ingreso=0;
			  $km->salida=$r["cantidad"];
			  $km->saldo=0;
			 $km->concepto1=$nota["destino"]; 
			 $km->concepto2=""; 
			 $km->obs="";
			
			 $km->idingreso="";
			 $km->idegreso=$nota["idegreso"];
			 $km->nuevo();
		 
		
		unset($km);
		 
	}
						header("Location:".config::ruta()."?accion=notasEgreso");

	
	
	}
if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	
	
	               
                     $ni->envia=strtoupper($_POST["nombre_envia"]);
					  $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->recibe=strtoupper($_POST["recibe"]);	
 					 $ni->concepto=strtoupper($_POST["tipo"]);	
					  $ni->destino=strtoupper($_POST["destino"]);
					 $ni->cant_total=$_POST["cant_total"];
					  $ni->precio_total=$_POST["monto_total"];
					 $ni->estado="Sin Enviar";
					 $ni->nombre_usuarios=$_SESSION["nombres"];
					  $ni->terminado=0;
					   $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					  $ni->obs=$_POST["obser"];
					  $ni->idventas=0;
					$ni->nuevo();
					 $lastID=Egreso::$lastId;
		for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleEgreso();
		 $de->cantidad=$_POST["cantidad"][$i];
		 
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		  $de->obs=$_POST["obs"][$i];
		 $de->egreso_idegreso=$lastID;
		 $de->insertar();
		 unset($de);
		
		
		 
		 }
		  $de=new detalleEgreso();
		  $de->nuevo();
		  unset($de);
					header("Location:".config::ruta()."?accion=verEgreso&id=".$lastID);
	 
					 

					 
		
	}
require_once("view/addEgreso.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>