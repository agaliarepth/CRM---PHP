<?php 
require_once("model/ProveedoresModel.php");

$c=new Proveedores();
if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="bp")
{  

$c->borrar($_GET["id"]);


	
	}
	else{
		echo '<script type="text" language="javascript"> window.location="'.config::ruta().'?accion=editoriales&m=3";</script>';

		
		}
		
		
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/proveedores.php");
?>