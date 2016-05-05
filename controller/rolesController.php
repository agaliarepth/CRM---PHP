<?php 
require_once("model/perfilesModel.php");
	 $c=new Perfiles();
	 
	 $res=$c->listarTodos();
	 
	 
	 if(isset($_GET["ip"]) && isset($_GET["e"]) && $_GET["e"]=="bp")
{  
$c->borrar($_GET["ip"]);
	 header("Location:".config::ruta()."?accion=roles");
	
	}
	

require_once("view/roles.php");



?>