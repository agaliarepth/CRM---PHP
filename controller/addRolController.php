  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/perfilesModel.php");
	 $c=new Perfiles();
	 if(isset($_GET["e"])&& $_GET["e"]=="editar"){
		 $res=$c->getId($_GET["ir"]);
		 
		 }
		 if(isset($_POST["editar"])&& $_POST["editar"]=="editar"){
		   if(isset($_POST["modulo_catalogo"]))
	 $c->modulo_catalogo=$_POST["modulo_catalogo"];
	 else
	 $c->modulo_catalogo="0";
	 
	 
	 if(isset($_POST["modulo_almacenes"]))
	 $c->modulo_almacenes=$_POST["modulo_almacenes"];
	  else
	 $c->modulo_almacenes="0";
	 
	 
	 if(isset($_POST["modulo_proveedores"]))
	 $c->modulo_proveedores=$_POST["modulo_proveedores"];
	  else
	 $c->modulo_proveedores="0";
	 
	 
	 if(isset($_POST["modulo_compras"]))
	 $c->modulo_compras=$_POST["modulo_compras"];
	  else
	 $c->modulo_compras="0";
	 
	 
	 if(isset($_POST["modulo_administracion"]))
	 $c->modulo_administracion=$_POST["modulo_administracion"];
	  else
	 $c->modulo_administracion="0";
	 
	 
	  if(isset($_POST["modulo_ventas"]))
	 $c->modulo_ventas=$_POST["modulo_ventas"];
	  else
	 $c->modulo_ventas="0";
	 
	  if(isset($_POST["modulo_clientes"]))
	 $c->modulo_clientes=$_POST["modulo_clientes"];
	  else
	 $c->modulo_clientes="0";
	 
	  if(isset($_POST["modulo_cobranzas"]))
	 $c->modulo_cobranzas=$_POST["modulo_cobranzas"];
	  else
	 $c->modulo_cobranzas="0";
	  if(isset($_POST["modulo_reportes"]))
	 $c->modulo_reportes=$_POST["modulo_reportes"];
	  else
	 $c->modulo_reportes="0";
	 
	 $c->descrip=strtoupper($_POST["descrip"]);
	 
	 $c->actualizar($_POST["idperfiles"]);
	
	header("Location:".config::ruta()."?accion=roles");
		 
		 
		 }
	 
 if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	 
	 
     if(isset($_POST["modulo_catalogo"]))
	 $c->modulo_catalogo=$_POST["modulo_catalogo"];
	 else
	 $c->modulo_catalogo="0";
	 
	 
	 if(isset($_POST["modulo_almacenes"]))
	 $c->modulo_almacenes=$_POST["modulo_almacenes"];
	  else
	 $c->modulo_almacenes="0";
	 
	 
	 if(isset($_POST["modulo_proveedores"]))
	 $c->modulo_proveedores=$_POST["modulo_proveedores"];
	  else
	 $c->modulo_proveedores="0";
	 
	 
	 if(isset($_POST["modulo_compras"]))
	 $c->modulo_compras=$_POST["modulo_compras"];
	  else
	 $c->modulo_compras="0";
	 
	 
	 if(isset($_POST["modulo_administracion"]))
	 $c->modulo_administracion=$_POST["modulo_administracion"];
	  else
	 $c->modulo_administracion="0";
	 
	 
	  if(isset($_POST["modulo_ventas"]))
	 $c->modulo_ventas=$_POST["modulo_ventas"];
	  else
	 $c->modulo_ventas="0";
	 
	  if(isset($_POST["modulo_clientes"]))
	 $c->modulo_clientes=$_POST["modulo_clientes"];
	  else
	 $c->modulo_clientes="0";
	 
	  if(isset($_POST["modulo_cobranzas"]))
	 $c->modulo_cobranzas=$_POST["modulo_cobranzas"];
	  else
	 $c->modulo_cobranzas="0";
	  if(isset($_POST["modulo_reportes"]))
	 $c->modulo_reportes=$_POST["modulo_reportes"];
	  else
	 $c->modulo_reportes="0";
	 
	 $c->descrip=strtoupper($_POST["descrip"]);
	 
	 $c->nuevo();
	
	header("Location:".config::ruta()."?accion=roles");

	 
 }


require_once("view/addRol.php");



?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>