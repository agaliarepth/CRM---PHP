  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/clientesModel.php");
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/cuotasModel.php");
require_once("model/vendedores_usuariosModel.php");
require_once("model/vendedoresModel.php");
require_once("model/pagoVentasCreditoModel.php");


require_once("model/cuotasModel.php");
$cuota =new Cuotas();






 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
$v=new Ventas();
$de=new detalleVentas();
$cv=new creditoVentas();
$contado=new ventasContado();
$li=new Libros();
$cuota =new Cuotas();
$vu=new VendedoresUsuarios();
$vendedor=new Vendedores();
$pago=new pagoVentasCredito();
$listaVendedores=$vu->getVendedores($_SESSION["ses_id"]);

if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="editarVenta" ){
	
	$res=$v->getId($_GET["id"]);
	$res2=$de->getDetalle($_GET["id"]);
	$credito=$cv->getVenta($_GET["id"]);
	$cont=$contado->getVenta($_GET["id"]);
	
	
	}
	

if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		            
				
					 $cred=$cv->getVenta($_POST["idventas"]);
					 $con=$contado->getVenta($_POST["idventas"]);
					 
					 $aux1=explode("||",$_POST["vendedor"]);
					
	if($_POST["tipo"]=="credito"){
		
		

	$v->total=$_POST["monto_total"];
	$v->cantidad=$_POST["cant_total"];
	$v->moneda=$_POST["moneda"];
	$v->cambio=$_POST["cambio"];
	$v->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
	$v->clientes_idclientes=$_POST["idclientes"];
	  if($_POST["vender"]==1){
	$v->terminado=1;
	$v->estado="Despachado";
	  }
	 if($_POST["vender"]==0){
	 $v->terminado=1;
	 $v->estado="Despachado";
	 }
	$v->usuario=$_SESSION["nombres"];
	$v->despachado=1;
	$v->idegreso=$_POST["idegreso"];
	$v->transporte=$_POST["transporte"];
	$v->nit=$_POST["nit"];
	$v->pais=$_POST["pais"];
	$v->telf=$_POST["telf"];
    $v->nombre=$_POST["nombre"];
	$v->razonsocial=$_POST["razonsocial"];
	$v->vendedor=$aux1[1];
	$v->ciudad=$_POST["ciudad"];
	$v->tipoventa="CREDITO";
	$v->total_cancelar=$_POST["totalcancelar"];
	$v->tipo_desc=$_POST["tipo_desc"];
	$v->monto_descuento=$_POST["monto_descuento"];
	$v->localidad=$_POST["localidad"];
	$v->destino=$_POST["destino"];
	$v->idvendedores=$aux1[0];

	$v->actualizar($_POST["idventas"]);
	$lastID=$_POST["idventas"];
	
	if($_POST["adelanto"]>0){
		$cv->saldo_inicial=$_POST["monto_total"]-$_POST["adelanto"];
		}
		else{
			$cv->saldo_inicial=$_POST["monto_total"];
			}
    // "si=".$cv->saldo_inicial."cred_si=".$cred["saldo_inicial"];
	 $aux=($cred["saldo_actual"]+($cv->saldo_inicial-$cred["saldo_inicial"]));
	$cv->saldo_actual=$aux;
	$cv->monto_cuotas=$cv->saldo_inicial/$_POST["num_cuotas"];
	$cv->actualizarMontos($cred["idcreditoVentas"],$cv->saldo_inicial,$aux,$cv->monto_cuotas);
	/*$cv->num_cuotas=$_POST["num_cuotas"];
	$cv->monto_cuotas=$cv->saldo_inicial/$_POST["num_cuotas"];
	$cv->dias=$_POST["dias"];
	$cv->ventas_idventas=$lastID;
	$cv->adelanto=$_POST["adelanto"];
	$cv->tipoadelanto=$_POST["tipoadelanto"];
	$cv->cuentabanco=strtoupper($_POST["cuentabancoadelanto"]);
	$cv->reciboadelanto=strtoupper($_POST["reciboadelanto"]);
	$cv->facturaadelanto=strtoupper($_POST["facturaadelanto"]);
	$di="P".$_POST["dias"]."D";
	$fecha=new DateTime($_POST["fecha"]);
    $fecha->add(new DateInterval($di));
	$cv->fechaprimerpago=$fecha->format("Y-m-d");
	$cv->diaspago=$_POST["diaspago"];
	
	$cv->actualizar($cred["idcreditoVentas"]);
	*/
	
	
	 	 
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=htmlentities($_POST["titulo"][$i], ENT_QUOTES,'UTF-8');
		 $de->volumen=$_POST["tomo"][$i];
		 $de->ventas_idventas=$lastID;
		  $de->actualizar($_POST["iddetalle"][$i]);
		
		 }
		 
		
		
		  $listacuotas=$cuota->listarCuotasCredito($cred["idcreditoVentas"]);
		
		  foreach($listacuotas as $r){
			 
			  $cuota->fecha=$r["fecha"];
			  $cuota->numpago=$r["numpago"];
			  $cuota->saldo_inicial=$cv->monto_cuotas;
			  $cuota->saldo_actual=($r["saldo_actual"]+($cv->monto_cuotas-$r["saldo_inicial"]));
			  $cuota->creditoVentas_idcreditoVentas=$cred["idcreditoVentas"];
			  $cuota->actualizar($r["idcuotas"]);
			 
			  }
			
		
	header("Location:".config::ruta()."?accion=editarVenta");
		
		 
			  
	}
		  
}
require_once("view/editarVentaAdmin.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>