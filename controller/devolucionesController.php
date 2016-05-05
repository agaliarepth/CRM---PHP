
  <?php if(isset($_SESSION["modulo_ventas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/devolucionModel.php");
require_once("model/ingresoModel.php");
require_once("model/detalleDevolucionModel.php");
require_once("model/ventasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/cuotasModel.php");



$dev=new Devolucion();
$ingreso=new Ingreso();
$deta=new detalleDevolucion();
$contado=new ventasContado();
$credito=new creditoVentas();
$cuotas= new Cuotas();


$res=$ingreso->listarDevoluciones();
require_once("view/devoluciones.php");
if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="aceptar")
{

	 
		   header("Location:".config::ruta()."?accion=aceptarDevolucion&id=".$_GET["id"]);
		   
		 
		
	 
	
}

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="rechazar")
{

      $ingreso->updateEstado($_GET["id"],"Sin Enviar",0);
      header("Location:".config::ruta()."?accion=devoluciones");
}

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="eliminar")
{
    $res= $dev->getId($_GET["id"]);
	$dev->borrar($_GET["id"]);
	$ingreso->updateEstado($aux["idingreso"],"Enviado",1);


header("Location:".config::ruta()."?accion=devoluciones");
}



?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>