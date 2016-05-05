  <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/librosModel.php");
require_once("model/clientesModel.php");
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/egresoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/kardexMayorModel.php");
require_once("model/cuotasModel.php");
require_once("model/creditoVentasModel.php");





  
$v=new Ventas();
$de=new detalleVentas();
$li=new Libros();
$ni=new egreso();
$dete=new detalleEgreso();
$cuota =new Cuotas();
$credito=new creditoVentas();



 if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="adicionar")
 {
	 $res=$v->getId($_GET["id"]);
	 $det=$de->getDetalle($_GET["id"]); 
	 
 }
 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	 
	 
	 
	
		  $de=new detalleEgreso();
		   
		 	                  $ni->envia=strtoupper($_POST["nombre_envia"]);
					  $ni->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
					 $ni->recibe=strtoupper($_POST["recibe"]);	
 					 $ni->concepto=strtoupper($_POST["tipo"]);	
					  $ni->destino=strtoupper($_POST["destino"]);
					 $ni->cant_total=$_POST["cant_total"];
					  $ni->precio_total=$_POST["monto_total"];
					 $ni->estado="Enviado";
					 $ni->nombre_usuarios=$_SESSION["nombres"];
					  $ni->terminado=0;
					   $ni->moneda=$_POST["moneda"];
					 $ni->valor_cambio=$_POST["valor_cambio"];
					  $ni->obs=$_POST["obser"];
					  $ni->idventas=$_POST["idventas"];
					  $ni->nuevo();
					 $lastID=Egreso::$lastId;
		for($i=0; $i<$_POST["num_filas"];$i++){
		
		 $de->cantidad=$_POST["cantidad"][$i];
		 
		 $de->precio_unitario=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		  $de->obs=$_POST["obs"][$i];
		 $de->egreso_idegreso=$lastID;
		 $de->insertar();
		 
		     $li->quitarStock($_POST["idlibro"][$i],$_POST["cantidad"][$i]);
		
		
		    
		 
		 }
		 
		  $de->nuevo();
		  unset($de);
		  
		  /*
		  $res=$credito->getCredito($_POST["idventas"]);
		  $intervalodias=round($res["diaspago"]/$res["num_cuotas"],0);
		
		  $fecha = new DateTime($res["fechaprimerpago"]);
		  
		  for($i=0; $i<$res["num_cuotas"];$i++){
			  $j=1;
			  $f=$intervalodias*$j;
			  $di="P".$f."D";
			  $fecha->add(new DateInterval($di));
			  $cuota->fecha=$fecha->format('Y-m-d');
			  $cuota->numpago=($i+1)."/".$res["num_cuotas"];
			  $cuota->saldo_inicial=$res["monto_cuotas"];
			  $cuota->saldo_actual=$cuota->saldo_inicial;
			  $cuota->creditoVentas_idcreditoVentas=$res["idcreditoVentas"];
			  $cuota->nuevo();
			  $j++;
			  }
			  */
		  
		  
		  
		  $v->despachar($_POST["idventas"],$lastID);
		header("Location:".config::ruta()."?accion=verNotaEntrega&id=".$lastID);
	 
	 }

require_once("view/addPendiente.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>