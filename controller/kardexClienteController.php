  <?php if(isset($_SESSION["modulo_ventas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/ventasModel.php");
require_once("model/clientesModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/pagoVentasCreditoModel.php");
require_once("model/descuentoPagoModel.php");
require_once("model/devolucionModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/deudasModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/devolucionDineroModel.php");








$cliente=new Clientes();
$venta=new Ventas();
$detalleventa=new detalleVentas();
$contado=new ventasContado();
$credito=new creditoVentas();
$pago=new pagoVentasCredito();
$descuento=new descuentoPago();
$devolucion=new Devolucion();
$detalledevolucion=new detalleDevolucion();
$devoDinero=new DevolucionDinero();
$deuda=new Deuda();
 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);

if(isset($_POST["consulta"])&& isset($_POST["idcliente"])&&$_POST["consulta"]=="consulta"){
	$anio=$_POST["anio"]-1;
	$saldo_inicial=0;
	if($_POST["moneda"]=="Bs"){
		
		
		$montodeuda_bs=$deuda->sumarDeuda($_POST["idcliente"],$anio,"Bs");
		$montodeuda_sus=$deuda->sumarDeuda($_POST["idcliente"],$anio,"Sus");
		$totaldeuda=$montodeuda_bs["montodeuda"]+round(($montodeuda_sus["montodeuda"]*$tc2["valor"]),2);
		
		$sumaventas_bs=$detalleventa->totalVentas($anio,$_POST["idcliente"],"Bs");
		$sumaventas_sus=$detalleventa->totalVentas($anio,$_POST["idcliente"],"Sus");
		$sumaventas=$sumaventas_bs+round(($sumaventas_sus*$tc2["valor"]),2);
		
		$sumapagos_bs=0;
		$sumapagos_sus=0;
		$listaPagos_bs=$pago->listaPagos($anio,$_POST["idcliente"],"Bs");
		foreach($listaPagos_bs as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_bs+=$descuentos["monto"];
				
				}
			$sumapagos_bs+=$v["monto"];
		   
			}
			
			$listaPagos_sus=$pago->listaPagos($anio,$_POST["idcliente"],"Sus");
			foreach($listaPagos_sus as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_sus+=$descuentos["monto"];
				
				}
			$sumapagos_sus+=$v["monto"];
		   
			}
			$devoluciones_bs=$detalledevolucion->sumarDevoluciones($anio,$_POST["idcliente"],"Bs");
			$devoluciones_sus=$detalledevolucion->sumarDevoluciones($anio,$_POST["idcliente"],"Sus");
			
			//$devolucionesDeuda_bs=$devo_deuda->getDevolucionesDeudasAnio($anio,$_POST["idcliente"],"Bs");
			//$devolucionesDeuda_sus=$devo_deuda->getDevolucionesDeudasAnio($anio,$_POST["idcliente"],"Sus");
			//$totaldevolucionesDeuda=$devolucionesDeuda_bs+round(($devolucionesDeuda_sus*$tc2["valor"]),2);
			$totaldevolucionesDeuda=0;
			$totaldevoluciones=$devoluciones_bs+round(($devoluciones_sus*$tc2["valor"]),2);
			
			$totalpagos=$sumapagos_bs+round(($sumapagos_sus*$tc2["valor"]),2);
			
			 $saldo_inicial=($totaldeuda+$sumaventas)-($totalpagos+$totaldevoluciones);
			
		$listaventas=$venta->kardexCliente($_POST["idcliente"],$anio);
		
		 
			$efectivo_bs=0;
			$efectivo_sus=0;
			
			
			foreach($listaventas as $row){
				
				$cre=$credito->getVenta($row["idventas"]);
				$cont=$contado->getVenta($row["idventas"]);
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cont["monto"];
				}
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cont["monto"];
				}
				
			}
			
			
			// CONSULTA DEVOLUCION DE DINERO
			$lista_devodinero=$devoDinero->kardexCliente($_POST["idcliente"],$anio);
			$dinero_sus=0;
			$dinero_bs=0;
			
			foreach($lista_devodinero as $row){
				
				
				if($row["moneda"]=="Sus"){
				$dinero_sus+=$row["monto"];
				}
				if($row["moneda"]=="Bs"){
				$dinero_bs+=$row["monto"];
				}
			}
			$dinero_total=$dinero_bs+round(($dinero_sus*$tc2["valor"]),2);
			
			/////////////////////////////////////////////////////////////////
			
			$efectivo_total=$efectivo_bs+round($efectivo_sus*$tc2["valor"],2);
			
			
			$saldo_inicial=round(($totaldeuda+$sumaventas+$dinero_total)-($totalpagos+$totaldevoluciones+$efectivo_total+$totaldevolucionesDeuda),2);
		}
		
		
		
		if($_POST["moneda"]=="Sus"){
		
		$montodeuda_bs=$deuda->sumarDeuda($_POST["idcliente"],$anio,"Bs");
		$montodeuda_sus=$deuda->sumarDeuda($_POST["idcliente"],$anio,"Sus");
		$totaldeuda=$montodeuda_sus["montodeuda"]+round(($montodeuda_bs["montodeuda"]/$tc2["valor"]),2);
		
		$sumaventas_bs=$detalleventa->totalVentas($anio,$_POST["idcliente"],"Bs");
		$sumaventas_sus=$detalleventa->totalVentas($anio,$_POST["idcliente"],"Sus");
		$sumaventas=$sumaventas_sus+round(($sumaventas_bs/$tc2["valor"]),2);
		
		$sumapagos_bs=0;
		$sumapagos_sus=0;
		$listaPagos_bs=$pago->listaPagos($anio,$_POST["idcliente"],"Bs");
		foreach($listaPagos_bs as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_bs+=$descuentos["monto"];
				
				}
			$sumapagos_bs+=$v["monto"];
		   
			}
			
			$listaPagos_sus=$pago->listaPagos($anio,$_POST["idcliente"],"Sus");
			foreach($listaPagos_sus as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_sus+=$descuentos["monto"];
				
				}
			$sumapagos_sus+=$v["monto"];
		   
			}
			$devoluciones_bs=$detalledevolucion->sumarDevoluciones($anio,$_POST["idcliente"],"Bs");
			$devoluciones_sus=$detalledevolucion->sumarDevoluciones($anio,$_POST["idcliente"],"Sus");
			
			
			/*$devolucionesDeuda_bs=$devo_deuda->getDevolucionesDeudasAnio($anio,$_POST["idcliente"],"Bs");
			$devolucionesDeuda_sus=$devo_deuda->getDevolucionesDeudasAnio($anio,$_POST["idcliente"],"Sus");
			$totaldevolucionesDeuda=$devolucionesDeuda_sus+round(($devolucionesDeuda_bs/$tc2["valor"]),2);*/
			$totaldevolucionesDeuda=0;
			$totaldevoluciones=$devoluciones_sus+round(($devoluciones_bs/$tc2["valor"]),2);
			
			
			$totalpagos=$sumapagos_sus+round(($sumapagos_bs/$tc2["valor"]),2);
			
			
			$listaventas=$venta->kardexCliente($_POST["idcliente"],$anio);
			$efectivo_bs=0;
			$efectivo_sus=0;
			
			
			foreach($listaventas as $row){
				
				$cre=$credito->getVenta($row["idventas"]);
				$cont=$contado->getVenta($row["idventas"]);
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cont["monto"];
				}
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cont["monto"];
				}
				
			}
			
			$efectivo_total=$efectivo_sus+round($efectivo_bs/$tc2["valor"],2);
			
			
			// CONSULTA DEVOLUCION DE DINERO
			$lista_devodinero=$devoDinero->kardexCliente($_POST["idcliente"],$anio);
			$dinero_sus=0;
			$dinero_bs=0;
			
			foreach($lista_devodinero as $row){
				
				
				if($row["moneda"]=="Sus"){
				$dinero_sus+=$row["monto"];
				}
				if($row["moneda"]=="Bs"){
				$dinero_bs+=$row["monto"];
				}
			}
			$dinero_total=$dinero_sus+round(($dinero_bs/$tc2["valor"]),2);
			
			/////////////////////////////////////////////////////////////////
			
			  $saldo_inicial=round(($totaldeuda+$sumaventas+$dinero_total)-($totalpagos+$totaldevoluciones+$efectivo_total+$totaldevolucionesDeuda),2);
			
		}
		
		
		
		
		
		
	
	$res=$cliente->getId($_POST["idcliente"]);
	$listaventas=$venta->kardexCliente($_POST["idcliente"],$_POST["anio"]);
     $listadevoluciones=$detalledevolucion->kardexCliente($_POST["idcliente"],$_POST["anio"]); 
	// $listadevolucionesDeuda=$devo_deuda->kardexCliente($_POST["idcliente"],$_POST["anio"]); 

	 $listapagos=$pago->kardexCliente($_POST["idcliente"],$_POST["anio"],"credito");
 $listapagos2=$pago->kardexCliente2($_POST["idcliente"],$_POST["anio"]);
	
  $listaDevolucionDinero=$devoDinero->kardexCliente($_POST["idcliente"],$_POST["anio"]);
	 
	}
require_once("view/kardexCliente.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>