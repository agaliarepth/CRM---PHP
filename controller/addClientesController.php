 <?php if(isset($_SESSION["modulo_clientes"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php

require_once("model/clientesModel.php");
	 $c=new Clientes();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){

	
	   
	
	$c->nombres=utf8_encode(strtoupper($_POST["nombres"]));	
	$c->apellidos=utf8_encode(strtoupper($_POST["apellidos"]));	
	$c->direccion=utf8_encode($_POST["direccion"]); 	
	$c->telefono=$_POST["telefono"];  	
	$c->celular=$_POST["celular"];  	
	$c->email=$_POST["email"];  	
	$c->fax=$_POST["fax"]; 	
	$c->empresa=utf8_encode(strtoupper($_POST["empresa"])); 	
	$c->esposo=utf8_encode(strtoupper($_POST["esposo"])); 	
    $c->razonsocial=strtoupper($_POST["razonsocial"]); 	
	$c->nitruc=strtoupper($_POST["nitruc"]); 	
	$c->origen=strtoupper($_POST["origen"]); 
	$c->ciudad=strtoupper($_POST["ciudad"]); 
	$c->localidad=strtoupper($_POST["localidad"]);
	$c->gracia=strtoupper($_POST["gracia"]); 	
	$c->credito=strtoupper($_POST["credito"]); 	
	$c->cuotas=strtoupper($_POST["cuotas"]); 	
	$c->numletra=strtoupper($_POST["numletra"]); 
	$c->importeletra=strtoupper($_POST["importeletra"]); 
	$c->vencimiento=date("Y-m-d",strtotime($_POST["vencimiento"]));

	   
	 if(!$c->nuevo()){
		   echo "
	   <script type='text/javascript' >
if(confirm('hay un maldito error?')){
	location.href='".config::ruta()."?accion=clientes'}
	</script>";
		 
		 
		 }
		 else{
			 echo "<script type='text/javascript' >
alert('Se ha registrado un nuevo cliente!!!');
location.href='".config::ruta()."?accion=clientes'
</script>"; 
			 
		 }
	
 }
 if(isset($_GET["e"])&&$_GET["e"]=="ec"){
	 
	 $res=$c->getId($_GET["id"]);
	 
	 
	 }
	 
	 if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
		 $c->nombres=utf8_encode(strtoupper($_POST["nombres"]));	
	$c->apellidos=utf8_encode(strtoupper($_POST["apellidos"]));	
	$c->direccion=utf8_encode($_POST["direccion"]); 	
	$c->telefono=$_POST["telefono"];  	
	$c->celular=$_POST["celular"];  	
	$c->email=$_POST["email"];  	
	$c->fax=$_POST["fax"]; 	
	$c->empresa=utf8_encode(strtoupper($_POST["empresa"])); 	
	$c->esposo=utf8_encode(strtoupper($_POST["esposo"])); 
	$c->razonsocial=strtoupper($_POST["razonsocial"]); 		
	$c->nitruc=strtoupper($_POST["nitruc"]); 	
	$c->origen=strtoupper($_POST["origen"]); 
	$c->ciudad=strtoupper($_POST["ciudad"]);
	$c->localidad=strtoupper($_POST["localidad"]); 
	$c->gracia=strtoupper($_POST["gracia"]); 	
	$c->credito=strtoupper($_POST["credito"]); 	
	$c->cuotas=strtoupper($_POST["cuotas"]); 	
	$c->numletra=strtoupper($_POST["numletra"]); 
	$c->importeletra=strtoupper($_POST["importeletra"]); 
	$c->vencimiento=date("Y-m-d",strtotime($_POST["vencimiento"]));

		if(!$c->actualizar($_POST["idclientes"])){
			
			echo "<script type='text/javascript' >
alert('AH OCURRIDO UN ERROR EN LA ECTUALIZACION INTENTELO OTRA VEZ!!!');
location.href='".config::ruta()."?accion=clientes'
</script>"; 
			
			}
		
		else{
			echo "<script type='text/javascript' >
alert('La edicion fue exitosa!!!');
location.href='".config::ruta()."?accion=clientes'
</script>"; 
			}
		 
		 
		 }

require_once("view/addClientes.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>