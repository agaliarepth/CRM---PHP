<?php 
require_once("model/ventasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/librosModel.php");
require_once("model/vendedoresModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/pagoVentasCreditoModel.php");
require_once("model/descuentoPagoModel.php");
require_once("model/detalle_egresoModel.php");
require_once("model/clientesModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/deudasModel.php");
require_once("model/devolucionDeudasModel.php");



$tc=new tipoCambio();
$tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);

$li=new Libros();
$vendedor=new Vendedores();
$listaVendedores=$vendedor->listarTodos();
$venta=new Ventas();
$credito=new creditoVentas();
$contado=new ventasContado();
$libros=new Libros();
$pago=new pagoVentasCredito();
 $descuento=new descuentoPago();
  $egreso=new detalleEgreso();
  $cliente=new Clientes();
  $devolucion=new Devolucion();
 $det_dev=new detalleDevolucion();
$deuda=new Deuda();
 $devo_deuda=new DevolucionDeudas();
 if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	 $m=$_POST["moneda"];
	 $listaVentas=$venta->getVentasMes($_POST["mes"],$_POST["anio"],$_POST["idvendedor"],"CONTADO");
	 	 $listaVentasCredito=$venta->getVentasMes($_POST["mes"],$_POST["anio"],$_POST["idvendedor"],"CREDITO");

	 $listaVentas2=$pago->listaPagosMesVentas($_POST["mes"],$_POST["anio"],$_POST["idvendedor"]);
	 $listaPagosDeuda=$pago->listaPagosMesDeudasVendedor($_POST["mes"],$_POST["anio"],$_POST["idvendedor"]);
	 
	 
	 }



	
	

require_once("view/comisiones.php");



?>