 <?php if(isset($_SESSION["modulo_ventas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/devolucionModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/kardexMayorModel.php");
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");

 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);

$ni=new Devolucion();
$li=new Libros();
$venta=new Ventas();
$deta=new detalleventas();
$deta2=new detalleDevolucion();


if (isset($_GET["e"])&&$_GET["e"]=="devolucion" && isset($_GET["idv"])){
	$res=$venta->getId($_GET["idv"]);
	$res2=$deta->getDetalle($_GET["idv"]);
	
	
	}
	

 if (isset($_GET["e"])&&$_GET["e"]=="editar"){
	$d=new detalleDevolucion();
	$res=$ni->getId($_GET["id"]);
	
	$detalle_venta=$deta->getDetalle($res["idventas"]);
	$detalle_devolucion=$deta2->getDetalle($_GET["id"]);
	
	
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		$de=new detalleDevolucion();
       $de->borrarPorNota($_POST["iddevolucion"]);
		             $ni->total=$_POST["monto_total"];
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->cantidad=$_POST["cant_total"];
					 $ni->idingreso=$_POST["idingreso"];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					 $ni->idcliente=$_POST["idclientes"];
					 $ni->cliente=$_POST["nombre"];
					 $ni->estado="Sin Enviar";
					 $ni->idventas=$_POST["idventas"];
					 $ni->actualizar($_POST["iddevolucion"]);
	              	$lastID=$_POST["iddevolucion"];
					 
	for($i=0; $i<$_POST["num_filas"];$i++){
			   if(isset($_POST["elegido"][$i])){
			  
			  $pos=$_POST["elegido"][$i];
		 $de=new detalleDevolucion();
		 $de->cantidad=$_POST["cantidad2"][$pos];
		 $de->precio_unit=$_POST["precio_unit2"][$pos];
		 $de->precio_total=$_POST["precio_total2"][$pos];
		 $de->idlibros=$_POST["idlibro"][$pos];
		 $de->devolucion_iddevolucion=$lastID;
		 $de->codigo=$_POST["codigo"][$pos];
		 $de->titulo=utf8_decode($_POST["titulo"][$pos]);
		 $de->tomo=$_POST["tomo"][$pos];
		  $de->insertar();
		 unset($de);

		 

		 }
		  $de=new detalleDevolucion();
		 }
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript' >
alert('ERROR AL GUARDAR LA DEVOLUCION. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=devoluciones'
</script>"; 
			  
			  }
			  else{
				 
		  unset($de);
		  
	 
			  
		
		           
					header("Location:".config::ruta()."?accion=devoluciones");
	 
			  }

					 
			  }
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n" ){
	
	
	     $ni->actualizarEstado($_GET["id"],1,"Almacen");
	
	
		
		
		
		header("Location:".config::ruta()."?accion=devoluciones");
	
	
	
	}

if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	
                     $ni->total=$_POST["monto_total2"];
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->cantidad=$_POST["cant_total2"];
					 $ni->idingreso=$_POST["idingreso"];
					 $ni->terminado="0";
					 $ni->moneda=$_POST["moneda"];
					$ni->idcliente=$_POST["idclientes"];
					 $ni->cliente=$_POST["nombre"];
					 $ni->estado="Sin Enviar";
					 $ni->idventas=$_POST["idventas"];
					 $ni->nuevo();
					 $lastID=Devolucion::$lastId;
		 for($i=0; $i<$_POST["num_filas"];$i++){
			   if(isset($_POST["elegido"][$i])){
			  
			  $pos=$_POST["elegido"][$i];
		 $de=new detalleDevolucion();
		 $de->cantidad=$_POST["cantidad2"][$pos];
		 $de->precio_unit=$_POST["precio_unit2"][$pos];
		 $de->precio_total=$_POST["precio_total2"][$pos];
		 $de->idlibros=$_POST["idlibro"][$pos];
		 $de->devolucion_iddevolucion=$lastID;
		 $de->codigo=$_POST["codigo"][$pos];
		 $de->titulo=utf8_decode($_POST["titulo"][$pos]);
		 $de->tomo=$_POST["tomo"][$pos];
		  $de->insertar();
		 unset($de);

		 

		 }
		  $de=new detalleDevolucion();
		 }
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript' >
alert('ERROR AL GUARDAR La DEVOLUCION. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=addDevolucion&e=ei&id=$lastID'
</script>"; 
			  
			  }
			  else{
		  unset($de);
		 // print_r($_POST);
		  
			header("Location:".config::ruta()."?accion=devoluciones");
	 
			  }

					 
		
	}
require_once("view/addDevolucion.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>