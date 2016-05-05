<?php
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/pagoVentasCreditoModel.php");
require_once("model/deudasModel.php");
require_once("model/cuotasModel.php");
require_once("model/clientesModel.php");
require_once("model/descuentoPagoModel.php");
require_once("model/devolucionModel.php");




$tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
$devolucion=new Devolucion();


$pago=new pagoVentasCredito();
$detalleVentas=new detalleVentas();
$venta=new Ventas();
$deudas=new Deuda();
$cuotas=new Cuotas();
$cliente=new Clientes();
$descuento=new descuentoPago();


if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	$mes=$_POST["mes"]; $anio=$_POST["anio"];
	if($_POST["mes"]==1){
		$mes_anterior=12;
		$anio_anterior=$anio-1;
		}
		else{

				$mes_anterior=$mes-1;
		$anio_anterior=$anio;

			}

      if($_POST["filtro"]=="MES") {
        $listadeudas=$deudas->getDeudasVencidas($mes,$anio);
        $listaCuotas=$cuotas->getCuotasVencidas($mes,$anio);
        }
        if($_POST["filtro"]=="RANGO") {
           $listadeudas=$deudas->getDeudasVencidasRango(date("Y-m-d",strtotime($_POST["fechainicio"])),date("Y-m-d",strtotime($_POST["fechafin"])));
            $listaCuotas=$cuotas->getCuotasVencidasRango(date("Y-m-d",strtotime($_POST["fechainicio"])),date("Y-m-d",strtotime($_POST["fechafin"])));

      }

        if($_POST["filtro"]=="ACUMULADO") {
          $listadeudas=$deudas->getDeudasVencidasRango("2013-01-01",date("Y-m-d",strtotime($_POST["fechafin"])));
           $listaCuotas=$cuotas->getCuotasVencidasRango("2013-01-01",date("Y-m-d",strtotime($_POST["fechafin"])));

        }




	}

require_once("view/cuentasCobrar.php");
