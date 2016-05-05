  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/deudasModel.php");
$d=new Deuda();
$f=getdate();
  $res=$d->listarTodosMes($f["mon"],$f["year"]);

if(isset($_POST["contratos"])){
	if($_POST["filtro"]=="MES") {
        $res = $d->listarTodosMes($_POST["mes"], $_POST["anio"]);
    }
    if($_POST["filtro"]=="RANGO") {
        $res = $d->listarTodosRango(date("Y-m-d",strtotime($_POST["fechainicio"])),date("Y-m-d",strtotime($_POST["fechafin"])));
	}
    if($_POST["filtro"]=="ACUMULADO") {
        $res = $d->listarTodosRango("2013-01-01",date("Y-m-d",strtotime($_POST["fechaacumulado"])));

    }
}

require_once("view/deudas.php");

if(isset($_GET["e"])&&isset($_GET["id"])&&$_GET["e"]=="borrar"){
$d->borrar($_GET["id"]);
     header("Location:".config::ruta()."?accion=deudas");
	

	}

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>