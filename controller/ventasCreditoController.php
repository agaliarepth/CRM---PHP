  <?php if(isset($_SESSION["modulo_ventas"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/ventasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/clientesModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/ventasContadoModel.php");



$det=new detalleVentas();
$v=new Ventas();
$cv=new creditoVentas();
$vcon=new ventasContado();

$c=new Clientes();



  //$res=$v->listarTodos();
  $f=getdate();
$res=$v->listarTodosMes($f["mon"],$f["year"]);

if(isset($_POST["contratos"])){
	if($_POST["filtro"]=="MES") {
        $res = $v->listarTodosMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {
       
        $res = $v->listarTodosRango(date("Y-m-d",strtotime($_POST["fechainicio"])),date("Y-m-d",strtotime($_POST["fechafin"])));
  }
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $v->listarTodosRango("2013-01-01",date("Y-m-d",strtotime($_POST["fechaacumulado"])));

    }
}

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="b"){
    $v->borrar($_GET["id"]);
     
header("Location:".config::ruta()."?accion=ventasCredito");
}

if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="confirmar"){
	
    $v->terminado($_GET["id"]);
	header("Location:".config::ruta()."?accion=ventasCredito");
	

	
	}
require_once("view/ventasCredito.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>