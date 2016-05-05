<?php 
require_once("model/librosModel.php");
require_once("model/categoriasModel.php");
require_once("model/proveedoresModel.php");
require_once("model/detalle_ingresoModel.php");
require_once("model/detalle_egresoModel.php");

$c=new Libros();
$cat=new Categorias();
$p=new Proveedores();
$ingreso=new detalleIngreso();
$egreso=new detalleEgreso();
if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="bl")
{  
$res=$c->getID($_GET["id"]);
$c->borrarFoto($res["foto"]);
$c->borrar($_GET["id"]);

	
	}
	
	
	
		
$res=$c->listarTodos($c->get_tabla());
require_once("view/librosVentas.php");



?>