<?php 
require_once("model/perfilesModel.php");
require_once("model/usuariosModel.php");



if(isset($_SESSION["idperfiles"])){
	$p=new Perfiles();
$res=$p->getId($_SESSION["idperfiles"]);
foreach($res as $v){
	if($res["modulo_almacenes"]=="1")
	$_SESSION["modulo_almacenes"]="1";
	
	if($res["modulo_catalogo"]=="1")
	$_SESSION["modulo_catalogo"]="1";
	

	
	if($res["modulo_administracion"]=="1")
	$_SESSION["modulo_administracion"]="1";
	
	if($res["modulo_ventas"]=="1")
	$_SESSION["modulo_ventas"]="1";
	
	if($res["modulo_compras"]=="1")
	$_SESSION["modulo_compras"]="1";
	
	if($res["modulo_proveedores"]=="1")
	$_SESSION["modulo_proveedores"]="1";
	
	if($res["modulo_clientes"]=="1")
	$_SESSION["modulo_clientes"]="1";
	
	if($res["modulo_cobranzas"]=="1")
	$_SESSION["modulo_cobranzas"]="1";
	if($res["modulo_reportes"]=="1")
	$_SESSION["modulo_reportes"]="1";
	
	}
}
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
require_once("view/home.php");
?>