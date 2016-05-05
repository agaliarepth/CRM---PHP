  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/usuariosModel.php");
require_once("model/perfilesModel.php");
$u=new Usuario();
$p=new Perfiles();
$res=$u->listarTodos();

if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="bu"){
	
	$u->borrar($_GET["id"]);
		header("Location:".config::ruta()."?accion=usuarios");

	
	}
require_once("view/usuarios.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>