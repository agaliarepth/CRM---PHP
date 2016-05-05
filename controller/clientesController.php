  <?php if(isset($_SESSION["modulo_clientes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/clientesModel.php");

$c=new Clientes();
if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="bc")
{  

$c->borrar($_GET["id"]);


	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=editoriales&m=3";</script>';

		
		}
		
		
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/clientes.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>