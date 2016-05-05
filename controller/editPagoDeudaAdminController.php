 <?php if((isset($_SESSION["modulo_cobranzas"])||isset($_SESSION["modulo_administracion"]) )&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

  <?php 
require_once("model/pagoVentasCreditoModel.php");
require_once("model/deudasModel.php");
require_once("model/descuentoPagoModel.php");
require_once("model/tipoCambioModel.php");
 
$tc=new tipoCambio();
$tc1=$tc->recuperarUltimo();
$deuda=new Deuda();
$pago=new pagoVentasCredito();
$descuento=new descuentoPago();
if(isset($_GET["id"]) ){
	$res=$deuda->getId($_GET["id"]);
	
	}
	
    $res3=$pago->getId($_GET["id"]);
	$res=$deuda->getId($res3["deudas_iddeudas"]);
	$res2=$descuento->getPago($_GET["id"]);
	
	
		
		if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
			
			$deuda->sumarSaldo($_POST["iddeudas"],$_POST["monto_ant"]);
			
		$pago->monto=$_POST["monto"];
		$pago->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
		$pago->numfactura=strtoupper($_POST["numfactura"]);
		$pago->idventas=0;
		$pago->tipopago=$_POST["tipopago"];
		$pago->numrecibo=strtoupper($_POST["numrecibo"]);
		$pago->cuentabanco=$_POST["cuentabanco"];
		$pago->cuotas_idcuotas=0;
		$pago->cliente=$_POST["cliente"];
		$pago->numcuota=$_POST["numpago"];
		$pago->deudas_iddeudas=$_POST["iddeudas"];
		$pago->moneda=$_POST["moneda"];
		$pago->valorcambio=$_POST["valorcambio"];
		$pago->referencia="deuda";
		$pago->idcliente=$_POST['idclientes'];
        $pago->terminado=0;

		$pago->actualizar($_POST["idPago"]);
		 $lastID=$_POST["idPago"];
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
			
			
			$deuda->updateSaldo($_POST["iddeudas"],$monto);
			$pago->updateTerminado($lastID,'1');
		
		  header("Location:".config::ruta()."?accion=pagos");
		}
		
		
			
		

require_once("view/editPagoDeudaAdmin.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>