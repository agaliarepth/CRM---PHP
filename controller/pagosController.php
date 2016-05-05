  <?php if(isset($_SESSION["modulo_cobranzas"])){?>

<?php

require_once("model/pagoVentasCreditoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasModel.php");
require_once("model/cuotasModel.php");

$v=new Ventas();
$pv=new pagoVentasCredito();
$cv=new creditoVentas();
$cu=new cuotas();
$f=getdate();
$res=$pv->listarTodosMes($f["mon"],$f["year"]);
if(isset($_POST["bEnviar"])){
	if($_POST["filtro"]=="MES") {
        $res = $pv->listarTodosMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {

        $res = $pv->listarTodosRango(date("Y-m-d",strtotime($_POST["fechainicio"])),date("Y-m-d",strtotime($_POST["fechafin"])));
  }
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $pv->listarTodosRango("2013-01-01",date("Y-m-d",strtotime($_POST["fechaacumulado"])));

    }
}
require_once("view/pagos.php");
if(isset($_GET["id"])&&isset($_GET["e"])&&$_GET["e"]=="borrar"){
	$pago=$pv->getId($_GET["id"]);
	$cu->sumarSaldo($pago["cuotas_idcuotas"],$pago["monto"]);
	$cv->sumarSaldo($pago["idventas"],$pago["monto"]);
	$pv->borrar($_GET["id"]);
	 //print_r($pago);
     header("Location:".config::ruta()."?accion=pagos");


	}


?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>
