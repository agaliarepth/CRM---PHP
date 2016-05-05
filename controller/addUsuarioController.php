  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("model/usuariosModel.php");
require_once("model/perfilesModel.php");
$c=new Usuario();
$p=new Perfiles();
$res=$p->listarTodos();
if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	
	$c->username=$_POST["username"];
	  $c->password=$_POST["password"];
	 $c->nombres=strtoupper($_POST["nombres"]);
	 $c->cargo=strtoupper($_POST["cargo"]);
	  $c->perfiles_idperfiles=$_POST["perfiles_idperfiles"];
	 $c->nuevo();
	
	header("Location:".config::ruta()."?accion=usuarios");
	
	
	
	}
	
	if(isset($_GET["e"])&&isset($_GET["id"])&& $_GET["e"]=="eu"){
		
		$res=$c->getId($_GET["id"]);
		$res2=$p->listarTodos();
		
	}
	
	if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
		$c->username=$_POST["username"];
	  $c->password=$_POST["password"];
	 $c->nombres=strtoupper($_POST["nombres"]);
	 $c->cargo=strtoupper($_POST["cargo"]);
	  $c->perfiles_idperfiles=$_POST["perfiles_idperfiles"];
	 $c->actualizar($_POST["idusuarios"]);
	
	header("Location:".config::ruta()."?accion=usuarios");
		
		}




require_once("view/addUsuario.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>