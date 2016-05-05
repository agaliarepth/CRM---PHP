<?php
require_once("model/librosModel.php");
require_once("model/categoriasModel.php");
require_once("model/proveedoresModel.php");



	 $c=new Libros();
	 $cate=new Categorias();
	 $edit=new Proveedores();
	$res= $cate->autocompletar();
	$res2=$edit->autocompletar();
	
	
	if(isset($_GET["id"]) &&  $_GET["id"]!="")
{  
$res=$c->getId($_GET["id"]);
$res2= $cate->autocompletar();
	$res3=$edit->autocompletar();
require_once("view/editarLibrosVentas.php");

	
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar"){
		
	
	 $c->actualizarVentas($_POST["idlibros"],$c->guardarFoto(),$_POST["pv"]);	
	 echo "<script type='text/javascript' >
alert('La edicion fue exitosa!!!');
location.href='".config::ruta()."?accion=librosVentas'
</script>"; 
	//header("Location:".config::ruta()."?accion=libros");
		
		}
	