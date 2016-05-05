  <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/ingresoModel.php");
require_once("model/librosModel.php");
require_once("model/detalle_ingresoModel.php");

$det=new detalleIngreso();
$li=new Libros();
$ni=new Ingreso();

  $f=getdate();
  $res=$ni->listarTodosMes($f["mon"],$f["year"]);

if(isset($_POST["contratos"])){
	if($_POST["filtro"]=="MES") {
        $res = $ni->listarTodosMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {
        $res = $ni->listarTodosRango(date("Y-m-d",strtotime($_POST["fechainicio"])),date("Y-m-d",strtotime($_POST["fechafin"])));
	}
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $ni->listarTodosRango("2013-01-01",date("Y-m-d",strtotime($_POST["fechaacumulado"])));

    }
}
require_once("view/notasIngreso.php");
if(isset($_GET["ii"]) && isset($_GET["e"]) && $_GET["e"]=="bi")
{
	$res=$ni->getId($_GET["ii"]);
	$res2=$det->getDetalle($_GET["ii"]);
if($res["terminado"]==1){
	foreach($res2 as $v){
	
		$li->quitarStock($v["libros_idlibros"],$v["cantidad"]);
		
		
		}
	
    $ni->borrar($_GET["ii"]);
}
else{
	$ni->borrar($_GET["ii"]);
	
	}

header("Location:".config::ruta()."?accion=notasIngreso");
}

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>