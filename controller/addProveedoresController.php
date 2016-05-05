  <?php if(isset($_SESSION["modulo_proveedores"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php

require_once("model/ProveedoresModel.php");
	 $c=new Proveedores();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	
	   
	    $c->nombre=strtoupper($_POST["nombre"]);
	 $c->contacto=$_POST["contacto"];
	 $c->direccion=$_POST["direccion"];
	 $c->telf1=$_POST["telf1"];
	 $c->telf2=$_POST["telf2"];
	 $c->telf3=$_POST["telf3"];
	 $c->rucnit=$_POST["rucnit"];
	 $c->email=$_POST["email"];
	 $c->pais=$_POST["pais"];
	 $c->ciudad=$_POST["ciudad"];
	 $c->banco=$_POST["banco"];
	 $c->numcuenta=$_POST["numcuenta"];
	 $c->tiempogracia=$_POST["tiempogracia"];
	 $c->condiciones=$_POST["condiciones"];
	   
	 $c->nuevo();
	   echo "
	   <script type='text/javascript' >
if(confirm('Se ha registrado una nuevo Proveedor.. Desea volver?')){
	location.href='".config::ruta()."?accion=proveedores'}
	</script>";
	//header("Location:".config::ruta()."?accion=addProveedores&m=1");

	 
 }
 if(isset($_GET["e"])&&$_GET["e"]=="ep"){
	 
	 $res=$c->getId($_GET["id"]);
	 
	 
	 }
	 
	 if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
		    $c->nombre=strtoupper($_POST["nombre"]);
	 $c->contacto=$_POST["contacto"];
	 $c->direccion=$_POST["direccion"];
	 $c->telf1=$_POST["telf1"];
	 $c->telf2=$_POST["telf2"];
	 $c->telf3=$_POST["telf3"];
	 $c->rucnit=$_POST["rucnit"];
	 $c->email=$_POST["email"];
	 $c->pais=$_POST["pais"];
	 $c->ciudad=$_POST["ciudad"];
	 $c->banco=$_POST["banco"];
	 $c->numcuenta=$_POST["numcuenta"];
	 $c->tiempogracia=$_POST["tiempogracia"];
	 $c->condiciones=$_POST["condiciones"];
		$c->actualizar($_POST["idproveedores"]);
		 echo "<script type='text/javascript' >
alert('La edicion fue exitosa!!!');
location.href='".config::ruta()."?accion=proveedores'
</script>"; 
		 
		 }

require_once("view/addProveedores.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>