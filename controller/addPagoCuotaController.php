 <?php if((isset($_SESSION["modulo_cobranzas"])||isset($_SESSION["modulo_administracion"]) )&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/pagoVentasCreditoModel.php");
require_once("model/cuotasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/tipoCambioModel.php");
 require_once("model/ventasModel.php");
 require_once("model/descuentoPagoModel.php");


$tc=new tipoCambio();
$tc1=$tc->recuperarUltimo();
$venta=new Ventas();
$cu=new Cuotas();
$pago=new pagoVentasCredito();
$credito=new creditoVentas();
$descuento=new descuentoPago();

if(isset($_GET["id"])){
	$res=$cu->getId($_GET["id"]);
	$res2=$credito->getId($res["creditoVentas_idcreditoVentas"]);
	$res3=$venta->getMoneda($res2["ventas_idventas"]);
	$fecha=$venta->getFecha($res2["ventas_idventas"]);
	}
	if(isset($_GET["id"])&& isset($_GET["e"]) && $_GET["e"]=="editar" ){
	$res4=$pago->getId($_GET["id"]);
	$res=$cu->getId($res4["cuotas_idcuotas"]);
	$res2=$credito->getId($res["creditoVentas_idcreditoVentas"]);
	$res3=$venta->getMoneda($res2["ventas_idventas"]);
	$res5=$descuento->getPago($_GET["id"]);
     $fecha=$venta->getFecha($res2["ventas_idventas"]);
		}
	
	if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
	    $pago->monto=$_POST["monto"];
		$pago->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
		$pago->numfactura=strtoupper($_POST["numfactura"]);
		$pago->idventas=$_POST["idventas"];
		$pago->tipopago=$_POST["tipopago"];
		$pago->numrecibo=strtoupper($_POST["numrecibo"]);
		$pago->cuentabanco=strtoupper($_POST["cuentabanco"]);
		$pago->cuotas_idcuotas=$_POST["cuotas_idcuotas"];
		$pago->cliente=$_POST["cliente"];
		$pago->numcuota=$_POST["numpago"];
		$pago->deudas_iddeudas=0;
		$pago->moneda=$_POST["moneda"];
		$pago->valorcambio=$_POST["valorcambio"];
		$pago->referencia="credito";
		$pago->idcliente=$_POST['clientes_idclientes'];


		$pago->actualizar($_POST["idpago"]);
		$lastID=$_POST["idpago"];
		
		if($_POST["tienedescuento"]==1 && !empty($_POST["iddescuento"]) ){
			//$res2=$descuento->getId()
			$descuento->monto=$_POST["montodescuento"];
			$descuento->descripcion=strtoupper($_POST["descripciondescuento"]);
			$descuento->pagoVentasCredito_idpagoVentasCredito=$lastID;
			$descuento->actualizar($_POST["iddescuento"]);
			
			}
			if($_POST["tienedescuento"]==1 && empty($_POST["iddescuento"]) ){
			//$res2=$descuento->getId()
			$descuento->monto=$_POST["montodescuento"];
			$descuento->descripcion=strtoupper($_POST["descripciondescuento"]);
			$descuento->pagoVentasCredito_idpagoVentasCredito=$lastID;
			$descuento->nuevo();
			
			}
			if($_POST["tienedescuento"]==0 && !empty($_POST["iddescuento"])){
			//$res2=$descuento->getId()
			$descuento->borrar($_POST["iddescuento"]);
			
			
			}
		//$cu->updateSaldo($pago->cuotas_idcuotas,$pago->monto);
		//$credito->updateSaldo($_POST["idcredito"],$pago->monto);
	     header("Location:".config::ruta()."?accion=pagos");	
		
	}
	if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
		$pago->monto=$_POST["monto"];
		$pago->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
		$pago->numfactura=strtoupper($_POST["numfactura"]);
		$pago->idventas=$_POST["idventas"];
		$pago->tipopago=$_POST["tipopago"];
		$pago->numrecibo=strtoupper($_POST["numrecibo"]);
		$pago->cuentabanco=strtoupper($_POST["cuentabanco"]);
		$pago->cuotas_idcuotas=$_POST["cuotas_idcuotas"];
		$pago->cliente=$_POST["cliente"];
		$pago->numcuota=$_POST["numpago"];
		$pago->deudas_iddeudas=0;
		$pago->moneda=$_POST["moneda"];
		$pago->valorcambio=$_POST["valorcambio"];
		$pago->referencia="credito";
		$pago->idcliente=$_POST['clientes_idclientes'];
		$pago->nuevo();
		 $lastID=pagoVentasCredito::$lastId;
		if($_POST["tienedescuento"]==1){
			$descuento->monto=$_POST["montodescuento"];
			$descuento->descripcion=strtoupper($_POST["descripciondescuento"]);
			$descuento->pagoVentasCredito_idpagoVentasCredito=$lastID;
			$descuento->nuevo();
			
			}
		//$cu->updateSaldo($pago->cuotas_idcuotas,$pago->monto);
		//$credito->updateSaldo($_POST["idcredito"],$pago->monto);
	     header("Location:".config::ruta()."?accion=pagos");
		
		}
		
		if(isset($_GET["e"])&& $_GET["e"]=="confirmar" && isset($_GET["id"])){
			
			$res=$pago->getId($_GET["id"]);
	       $res2=$cu->getCredito($res["cuotas_idcuotas"]);
		    $res3=$descuento->getPago($_GET["id"]);
			
				$monto=0;
			if(isset($res3["iddescuentoPago"])){
				$monto=$res3["monto"]+$res["monto"];
			}
			else{
				$monto=$res["monto"];
				}
			$cu->updateSaldo($res["cuotas_idcuotas"],$monto);
		$credito->updateSaldo($res2["creditoVentas_idcreditoVentas"],$monto);
						$pago->updateTerminado($_GET["id"],'1');

					  header("Location:".config::ruta()."?accion=pagos");

			}
			
			if(isset($_GET["e"])&& $_GET["e"]=="borrar" && isset($_GET["id"])){
				
					$res=$pago->getId($_GET["id"]);
	       $res2=$cu->getCredito($res["cuotas_idcuotas"]);
			$cu->sumarSaldo($res["cuotas_idcuotas"],$res["monto"]);
		$credito->sumarSaldo1($res2["creditoVentas_idcreditoVentas"],$res["monto"]);
		$pago->borrar($_GET["id"]);
						  header("Location:".config::ruta()."?accion=pagos");
			}

require_once("view/addPagoCuota.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>