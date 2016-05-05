
  <?php if(isset($_SESSION["modulo_catalogo"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/categoriasModel.php");

$c=new Categorias();
if(isset($_GET["ic"]) && isset($_GET["e"]) && $_GET["e"]=="bc")
{  
$c->borrar($_GET["ic"]);

	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=categorias&m=3";</script>';

		
		}
		
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/categorias.php");


?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>