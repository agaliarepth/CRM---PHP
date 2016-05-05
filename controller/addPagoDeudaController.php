  <?php if(isset($_SESSION["modulo_cobranzas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

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
	if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="editar"){
    $res3=$pago->getId($_GET["id"]);
	$res=$deuda->getId($res3["deudas_iddeudas"]);
	$res2=$descuento->getPago($_GET["id"]);
	}
	if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
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



		$pago->nuevo();
		 $lastID=pagoVentasCredito::$lastId;
		if($_POST["tienedescuento"]==1){
			$descuento->monto=$_POST["montodescuento"];
			$descuento->descripcion=strtoupper($_POST["descripciondescuento"]);
			$descuento->pagoVentasCredito_idpagoVentasCredito=$lastID;
			$descuento->nuevo();
			
			}
		//$deuda->updateSaldo($pago->deudas_iddeudas,$pago->monto);
	      header("Location:".config::ruta()."?accion=pagos");
		
		}
		
		if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
			
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
		//$deuda->updateSaldo($pago->deudas_iddeudas,$pago->monto);
	      //header("Location:".config::ruta()."?accion=addPagos&id=".$_POST['idclientes']);
		  header("Location:".config::ruta()."?accion=pagos");
		}
		
		if(isset($_GET["e"])&& $_GET["e"]=="confirmar" && isset($_GET["id"])){
			
			$res=$pago->getId($_GET["id"]);
	       $res2=$descuento->getPago($_GET["id"]);
			
			$monto=0;
			if(isset($res2["iddescuentoPago"])){
				$monto=$res2["monto"]+$res["monto"];
			}
			else{
				$monto=$res["monto"];
				}
			$deuda->updateSaldo($res["deudas_iddeudas"],$monto);
			$pago->updateTerminado($_GET["id"],'1');
			
					  header("Location:".config::ruta()."?accion=pagos");

			}
			
			if(isset($_GET["e"])&& $_GET["e"]=="borrar" && isset($_GET["id"])){
				
				$res=$pago->getId($_GET["id"]);
			    $res2=$descuento->getPago($_GET["id"]);

				$monto=0;
			if(isset($res2["iddescuentoPago"])){
				$monto=$res2["monto"]+$res["monto"];
			}
			else{
				$monto=$res["monto"];
				}
		   $deuda->sumarSaldo($res["deudas_iddeudas"],$monto);
			$pago->borrar($_GET["id"]);
					  header("Location:".config::ruta()."?accion=pagos");

				
				}

require_once("view/addPagoDeuda.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>