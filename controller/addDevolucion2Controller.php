 <?php if(isset($_SESSION["modulo_ventas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/devolucionModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/ingresoModel.php");
require_once("model/detalle_ingresoModel.php");

 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);

$ni=new Devolucion();
$li=new Libros();
$venta=new Ventas();
$deta=new detalleventas();
$deta2=new detalleDevolucion();
$ingreso=new Ingreso();
$det_ingreso=new detalleIngreso();



if (isset($_GET["id"])){
	$res=$ingreso->getId($_GET["id"]); 
	$res2=$det_ingreso->getDetalle($_GET["id"]);
	
	
	}
	

 if (isset($_GET["e"])&&$_GET["e"]=="editar"){
	$d=new detalleDevolucion();
	$res=$ni->getId($_GET["id"]);
	
	$detalle_devolucion=$deta2->getDetalle($_GET["id"]);
	
	$tipo=$venta->getTipoVenta($res["idventas"]);
	}
	
	if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	                 echo "<script type='text/javascript'>
alert('ERROR AL GUARDAR La DEVOLUCION. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=addDevolucion&e=ei&id=$lastID'
</script>"; 
	
                     $ni->total=$_POST["monto_total2"];
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->cantidad=$_POST["cant_total2"];
					 $ni->idingreso=$_POST["idingreso"];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					 if($_POST["tipodevolucion"]=="venta"){
					 $ni->idcliente=$_POST["idcliente"];
					 $ni->cliente=$_POST["nombrecliente"];
					 }
					 else{
				     $ni->idcliente=$_POST["id_clientes"];
					 $ni->cliente=$_POST["cliente_deuda"];
						 }
					 $ni->estado="Sin Enviar";
					 $ni->idventas=$_POST["idventas"];
					 $ni->tipodevolucion=$_POST["tipodevolucion"];
					 $ni->iddeudas=$_POST["iddeudas"];
					 $ni->saldo=$_POST["monto_total2"];
					 $ni->nuevo();
					 $lastID=Devolucion::$lastId;
					 for($i=0; $i<$_POST["num_filas"];$i++){
					 $de=new detalleDevolucion();
					 $de->cantidad=$_POST["cantidad"][$i];
					 $de->precio_unit=$_POST["precio_unit"][$i];
					 $de->precio_total=$_POST["total_fila"][$i];
					 $de->idlibros=$_POST["idlibro"][$i];
					 $de->devolucion_iddevolucion=$lastID;
					 $de->codigo=$_POST["codigo"][$i];
					 $de->titulo=utf8_decode($_POST["titulo"][$i]);
					 $de->tomo=$_POST["tomo"][$i];
					
					  $de->insertar();
					 
					 }
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript'>
alert('ERROR AL GUARDAR La DEVOLUCION. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=addDevolucion&e=ei&id=$lastID'
</script>"; 
			  
			  }
			  else{
		  unset($de);
		  
			header("Location:".config::ruta()."?accion=devoluciones");
	 
			  }

					 
		
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		$de=new detalleDevolucion();
       $de->borrarPorNota($_POST["iddevolucion"]);
		             $ni->total=$_POST["monto_total2"];
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->cantidad=$_POST["cant_total2"];
					 $ni->idingreso=$_POST["idingreso"];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					  $ni->idcliente=$_POST["idcliente"];
					 $ni->cliente=$_POST["nombrecliente"];
					 $ni->estado="Sin Enviar";
					 $ni->idventas=$_POST["idventas"];
					 $ni->tipodevolucion=$_POST["tipodevolucion"];
					 $ni->iddeudas=$_POST["iddeudas"];
					 $ni->saldo=$_POST["monto_total2"];

	              	$lastID=$_POST["iddevolucion"];
				 $ni->actualizar($_POST["iddevolucion"]);
					 
         for($i=0; $i<$_POST["num_filas"];$i++){
		  $de->cantidad=$_POST["cantidad"][$i];
		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["total_fila"][$i];
		 $de->idlibros=$_POST["idlibro"][$i];
		 $de->devolucion_iddevolucion=$lastID;
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=utf8_decode($_POST["titulo"][$i]);
		 $de->tomo=$_POST["tomo"][$i];
		 $de->insertar();
		 
		 }
		 
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript' >
alert('ERROR AL GUARDAR LA DEVOLUCION. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=devoluciones'
</script>"; 
			  
			  }
			  else{
				         
					header("Location:".config::ruta()."?accion=devoluciones");
	 			  }
 }
			  
			  
require_once("view/addDevolucion2.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>