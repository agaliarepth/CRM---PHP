  <?php if(isset($_SESSION["modulo_cobranzas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/pagoVentasCreditoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasModel.php");
require_once("model/cuotasModel.php");
require_once("model/clientesModel.php");

$v=new Ventas();
$pv=new pagoVentasCredito();
$cv=new creditoVentas();
$cu=new Cuotas();
$cli=new Clientes();

if(isset($_POST["consultar"])&& $_POST["consultar"]=="consultar"){
	
	$res=$cli->getDeudasCompras($_POST["idcliente"]);
	$res2=$cli->getDeudas($_POST["idcliente"]);
	$res3=$cli->getNombre($_POST["idcliente"]);
	}
	
	if(isset($_GET["accion"])&& isset($_GET["id"]) &&$_GET["accion"]=="addPagos"){
	
	$res=$cli->getDeudasCompras($_GET["id"]);
	$res2=$cli->getDeudas($_GET["id"]);
	$res3=$cli->getNombre($_GET["id"]);
	}


/*if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar")

{
	//print_r($_POST);
	$pv->monto=$_POST["monto"];
	$pv->fecha=$_POST["fecha"];
	$pv->numfactura=$_POST["numfactura"];
    $pv->idventas=$_POST["idventas"];
    $pv->numrecibo=$_POST["numrecibo"];
	$pv->tipopago=$_POST["tipopago"];
	$pv->cuentabanco=$_POST["cuentabanco"];
	$pv->cuotas_idcuotas=$_POST["idcuotas"];
	$pv->cliente=$_POST["cliente"];
	$pv->numcuota=$_POST["numpago"];
	$pv->nuevo();
	
	$cv->updateSaldo($_POST["idcredito"],$_POST["monto"]);
	$cu->updateSaldo($_POST["idcuotas"],$_POST["monto"]);

	
	header("Location:".config::ruta()."?accion=addPagos");
	}
*/



require_once("view/addPagos.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>