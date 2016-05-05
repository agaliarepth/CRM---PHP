 <?php if(isset($_SESSION["modulo_administracion"]) &&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

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



	$res4=$pago->getId($_GET["id"]);
	$res=$cu->getId($res4["cuotas_idcuotas"]);
	$res2=$credito->getId($res["creditoVentas_idcreditoVentas"]);
	$res3=$venta->getMoneda($res2["ventas_idventas"]);
	$res5=$descuento->getPago($_GET["id"]);
   $fecha=$venta->getFecha($res2["ventas_idventas"]);
	
	
	if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
		 $res2=$cu->getCredito($_POST["cuotas_idcuotas"]);
		$cu->sumarSaldo($_POST["cuotas_idcuotas"],$_POST["monto_ant"]);
		$credito->sumarSaldo($res2["creditoVentas_idcreditoVentas"],$_POST["monto_ant"]);
		
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
		$monto=$_POST["monto"];
		if($_POST["tienedescuento"]==1 && !empty($_POST["iddescuento"]) ){
			$descuento->monto=$_POST["montodescuento"];
			$descuento->descripcion=strtoupper($_POST["descripciondescuento"]);
			$descuento->pagoVentasCredito_idpagoVentasCredito=$lastID;
			$descuento->actualizar($_POST["iddescuento"]);
			$monto=$_POST["montodescuento"]+$_POST["monto"];
			}
			if($_POST["tienedescuento"]==1 && empty($_POST["iddescuento"]) ){
			$descuento->monto=$_POST["montodescuento"];
			$descuento->descripcion=strtoupper($_POST["descripciondescuento"]);
			$descuento->pagoVentasCredito_idpagoVentasCredito=$lastID;
			$descuento->nuevo();
			$monto=$_POST["montodescuento"]+$_POST["monto"];
			}
			if($_POST["tienedescuento"]==0 && !empty($_POST["iddescuento"])){
			$descuento->borrar($_POST["iddescuento"]);
			
			}
		 
			        $cu->updateSaldo($_POST["cuotas_idcuotas"],$monto);
		            $credito->updateSaldo($res2["creditoVentas_idcreditoVentas"],$monto);
					$pago->updateTerminado($lastID,'1');

	     header("Location:".config::ruta()."?accion=pagos");	
		
	}
	

require_once("view/editPagoAdmin.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>