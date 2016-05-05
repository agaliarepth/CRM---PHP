  <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/clientesModel.php");
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasContadoModel.php");




 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
$v=new Ventas();
$de=new detalleVentas();
$cv=new creditoVentas();
$contado=new ventasContado();
$li=new Libros();
$res=$v->listarTodosTerminado();

if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="anular"){
	$v->anular($_GET["id"]);
						header("Location:".config::ruta()."?accion=pendientes");

	}


require_once("view/pendientes.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>