<?php 
require_once("model/perfilesModel.php");
require_once("model/usuariosModel.php");
$c=new Usuario();
$res=$c->getId($_SESSION["ses_id"]);
if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
	$c->username=$_POST["username"];
	  $c->password=$_POST["password"];
	 $c->nombres=strtoupper($_POST["nombres"]);
	 $c->cargo=strtoupper($_POST["cargo"]);
	  $c->perfiles_idperfiles=$_POST["idperfiles"];
	 $c->actualizar($_POST["idusuarios"]);
	 echo "<script type='text/javascript' >
alert('LOS CAMBIOS SE REALIZARON CON EXITO!!!');
location.href='".config::ruta()."?accion=home'
</script>"; 
	
	
	}
require_once("view/editUser.php");

?>