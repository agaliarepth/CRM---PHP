  <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/kardexMayorModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/detalle_egresoModel.php");
$det1=new detalleIngreso();
$det2=new detalleEgreso();

$km=new kardexMayor();

if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){

				$sum2=0;
				$f1=date("Y-m-d",strtotime($_POST["fecha_ini"]));
				$f2=date("Y-m-d",strtotime($_POST["fecha_fin"]));
		$fecha2=strtotime('-1 day', strtotime($f1)); 
		$fecha2=date("Y-m-d",$fecha2);
		$si=$det1->sumIngreso($fecha2,$_POST["idlibro"]);
		$se=$det2->sumEgreso($fecha2,$_POST["idlibro"]);
	
		$saldo=$si["suma"]-($se["suma"]);
		$res1=$det1->getMes($_POST["idlibro"],$f1,$f2);
		$res2=$det2->getMes($_POST["idlibro"],$f1,$f2);
		$saldo1=0;
	
	
	}
require_once("view/kardexMayor.php");
?> 
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>