 <?php if(isset($_SESSION["modulo_almacen"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/librosModel.php");
require_once("model/clientesModel.php");
require_once("model/ventasModel.php");
require_once("model/ingresoModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/cuotasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/tipoCambioModel.php");


 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);



  
$v=new Ventas();
$devo=new Devolucion();
$det_devo=new detalleDevolucion();
$li=new Libros();
$ni=new Ingreso();

$cuota =new Cuotas();
$credito=new creditoVentas();



 if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="adicionar")
 {
	 $res=$devo->getId($_GET["id"]);
	 $res2=$det_devo->getDetalle($_GET["id"]); 
	 
 }
 
  if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="anular")
 {
	 $devo->actualizarEstado($_GET["id"],0,"Sin Enviar");
		header("Location:".config::ruta()."?accion=devolucionAlmacen");
	 
	 
 }
 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	 
	 
	 
	
		  $de=new detalleIngreso();
		   
		 	           $ni->recibe=strtoupper($_POST["recibe"]);
					 $ni->envia=strtoupper($_POST["nombre_envia"]);	
					 $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->concepto=$_POST["tipo"];
					 $ni->cant_total=$_POST["cant_total"];
					 $ni->estado="Enviado";
					 $ni->precio_total=$_POST["monto_total"];
					 $ni->nombre_usuarios=$_SESSION["nombres"];
					 $ni->terminado="1";
					 $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$tc2["valor"];
					 $ni->obs=$_POST["obser"];
					 $ni->documento=strtoupper($_POST["documento"]);
					  $ni->nuevo();
				     $lastID=Ingreso::$lastId;
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->ingreso_idingreso=$lastID;
		  $de->insertar();

		 		$li->sumarStock($_POST["idlibro"][$i],$_POST["cantidad"][$i]);


		 }
		 
		  if(!$de->nuevo()){
			  echo "<script type='text/javascript' >
alert('ERROR AL GUARDAR LA NOTA DE INGRESO. INTENTELO NUEVAMENTE');
location.href='".config::ruta()."?accion=devolucionAlmacen'
</script>"; 
                	
						 
						 }
					 
					 
					 

			  
			 
			  else{
		  unset($de);
		   $devo->actualizarEstado($_POST["iddevolucion"],1,"DEVUELTO");
					 $venta=$v->getId($_POST["idventas"]); 
					 $devolucion=$devo->getId($_POST["iddevolucion"]);
					  $devo->actualizarIngreso($_POST["iddevolucion"],$lastID);
					 
					 if($venta["tipoventa"]=="CONTADO"){}
					 
					 if($venta["tipoventa"]=="CREDITO"){
						 
						 $cred=$credito->getCredito($venta["idventas"]);
						 $listacuotas=$cuota->listarCuotasCredito($cred["idcreditoVentas"]);
						 $saldo_inicial=$devolucion["total"];
						 $saldo_actual=$devolucion["total"];
						 $monto_cuotas=$devolucion["total"]/$cred["num_cuotas"];
						  $credito->actualizarMontosDevolucion($cred["idcreditoVentas"],$saldo_inicial,$saldo_actual,$monto_cuotas);
						 foreach($listacuotas as $r){
							
							$cuota->actualizarMontos($r["idcuotas"],$monto_cuotas,$monto_cuotas);
							 
							 
							 }
							 $devo->actualizarIngreso($id,$idingreso);
		  
			header("Location:".config::ruta()."?accion=verIngreso&id=".$lastID);
	 
			  }
			  }
	 
	 }

require_once("view/addIngresoDevo.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>