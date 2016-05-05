 <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/ingresoModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");

 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);

$ni=new Ingreso();
$li=new Libros();

if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="ei" ){
	$d=new detalleIngreso();
	$res4=$ni->getId($_GET["id"]);
	$res3=$d->getDetalle($_GET["id"]);
	
	
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		$de=new detalleIngreso();
       $de->borrarPorNotaIngreso($_POST["idingreso"]);
		
		$lastID=$_POST["idingreso"];
					 
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];
		
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->ingreso_idingreso=$lastID;
		 $de->insertar();

		 }
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript' >
alert('ERROR AL GUARDAR LA NOTA DE INGRESO. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=addIngreso&e=ei&id=$lastID'
</script>"; 
			  
			  }
			  else{
				 
		  unset($de);
		  
	 
			  
		
		             $ni->recibe=strtoupper($_POST["recibe"]);
					 $ni->envia=strtoupper($_POST["nombre_envia"]);	
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->concepto=$_POST["tipo"];
					 $ni->cant_total=$_POST["cant_total"];
					 $ni->estado="Sin Enviar";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->nombre_usuarios=$_SESSION["nombres"];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					 $ni->obs=$_POST["obser"];
					 $ni->documento=strtoupper($_POST["documento"]);
					 $ni->actualizar($_POST["idingreso"]);
					header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
	 
			  }

					 
			  }
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n" ){
	
	$nota=$ni->getId($_GET["id"]);
	$d=new detalleIngreso();
	$det=$d->getDetalle($_GET["id"]);
	$ni->actualizarEstado($_GET["id"]);
	
	if($nota["concepto"]!="DEVOLUCION EN VENTA"){
	foreach($det as $r){
		
		
		$li->sumarStock($r["libros_idlibros"],$r["cantidad"]);
			
	}
	}
	
	header("Location:".config::ruta()."?accion=notasIngreso");
	}

if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	
                     $ni->recibe=strtoupper($_POST["recibe"]);
					 $ni->envia=strtoupper($_POST["nombre_envia"]);	
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->concepto=$_POST["tipo"];
					 $ni->cant_total=$_POST["cant_total"];
					 $ni->estado="Sin Enviar";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->nombre_usuarios=$_SESSION["nombres"];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					 $ni->obs=$_POST["obser"];
					 $ni->documento=strtoupper($_POST["documento"]);
					 $ni->nuevo();
					 $lastID=Ingreso::$lastId;
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleIngreso();
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->ingreso_idingreso=$lastID;
		  $de->insertar();
		 unset($de);

		 

		 }
		  $de=new detalleIngreso();
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript' >
alert('ERROR AL GUARDAR LA NOTA DE INGRESO. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=addIngreso&e=ei&id=$lastID'
</script>"; 
			  
			  }
			  else{
		  unset($de);
		  
			header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
	 
			  }

					 
		
	}
require_once("view/addIngreso.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>