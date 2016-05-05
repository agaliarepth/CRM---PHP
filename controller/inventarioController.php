  <?php if(isset($_SESSION["modulo_almacenes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/librosModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/detalle_egresoModel.php");

require_once("model/proveedoresModel.php");
require_once("model/categoriasModel.php");
require_once("helpers/Helpers.php");
$l=new Libros();
$p=new Proveedores();
$c=new categorias();
$ingreso=new detalleIngreso();
$egreso=new detalleEgreso();


if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"){
	$mes2=1;
	$anio2=2013;
	$ingreso_ant=0;
	$ingreso_act=0;
	$egreso_ant=0;
	$egreso_act=0;
	if($_POST["mes"]==1){
		$mes2=12;
		$anio2=$_POST["anio"]-1;
				
		}
		else{
			$mes2=$_POST["mes"]-1;
		$anio2=$_POST["anio"];
			
			}
	
	}

	$res=$l->listarTodos();

require_once("view/inventario.php");



?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>