<?php 
if(isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL ){
	
	header("Location:".config::ruta()."?accion=home");
	}
	
require_once("model/usuariosModel.php");
$user=new Usuario();
if(isset($_POST["grabar"]) && $_POST["grabar"]=="si"){
	
	
	$user->logeo();
	}



require_once("view/index.php");

?>