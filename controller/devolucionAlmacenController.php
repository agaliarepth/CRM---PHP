  <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/devolucionModel.php");


$devo=new Devolucion();
$res=$devo->listarTodosTerminado();

if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="anular"){
	$v->anular($_GET["id"]);
						header("Location:".config::ruta()."?accion=pendientes");

	}


require_once("view/devolucionAlmacen.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>