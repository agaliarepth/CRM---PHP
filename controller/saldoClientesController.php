<?php 

require_once("model/ventasModel.php");
require_once("model/clientesModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/deudasModel.php");
require_once("model/pagoVentasCreditoModel.php");
require_once("model/descuentoPagoModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/deudasModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/devolucionDeudasModel.php");







$cliente=new Clientes();
$venta=new Ventas();
$detalleventa=new detalleVentas();
$contado=new ventasContado();
$credito=new creditoVentas();
$pago=new pagoVentasCredito();
$descuento=new descuentoPago();
$devolucion=new Devolucion();
$detalledevolucion=new detalleDevolucion();
$devo_deuda=new DevolucionDeudas();
$deuda=new Deuda();
 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);

if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"){
	
	
		
		
		
		
		
		
	
	
	
$listaClientes=$cliente->listarTodosOrden("ciudad");
	
	}
require_once("view/saldoClientes.php");
?>