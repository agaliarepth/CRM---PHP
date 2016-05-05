 <?php if(isset($_SESSION["modulo_catalogo"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php

require_once("model/categoriasModel.php");
	 $c=new Categorias();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	 $c->descripcion=strtoupper($_POST["descripcion"]);
	 $c->codigo=strtoupper($_POST["codigo"]);
	 $c->nuevo($c->get_tabla(),$c->get_objeto());
	  echo "<script type='text/javascript' >
if(confirm('Se ha registrado una nueva categoria.. Desea volver?')){
	location.href='".config::ruta()."?accion=categorias'

	
	}</script>";

	//header("Location:".config::ruta()."?accion=addCategorias&m=1");

	 
 }
 if(isset($_GET["e"])&& $_GET["e"]=="ec"){
	 	
	$res=$c->getId($_GET["id"]);
	
	
	 
	 }
	 if (isset ($_POST["editar"]) && $_POST["editar"]=="editar"){
		 
		 $c->descripcion=strtoupper($_POST["descripcion"]);
	 $c->codigo=strtoupper($_POST["codigo"]);
	 $c->actualizar($_POST["idcategorias"]);
	 echo "<script type='text/javascript' >
alert('La edicion fue exitosa!!!');
location.href='".config::ruta()."?accion=categorias'
</script>";
	//header("Location:".config::ruta()."?accion=categorias");
	
		 
		 }
require_once("view/addCategorias.php");
?>
 <?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>