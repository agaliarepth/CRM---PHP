 <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/devolucionDineroModel.php");

require_once("model/tipoCambioModel.php");

require_once("model/deudasModel.php");

 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);


$devo=new DevolucionDinero();



	
	   if (isset($_GET["e"])&&$_GET["e"]=="editar"){
		   
		   $res=$devo->getId($_GET["id"]);
		   require_once("view/addDevolucionDinero.php");

		   }


	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		
  $devo->monto=$_POST["monto"];
	$devo->moneda=$_POST["moneda"];
	$devo->descripcion=strtoupper($_POST["descripcion"]);
	$devo->numrecibo=strtoupper($_POST["numrecibo"]);
	$devo->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
	$devo->clientes_idclientes=$_POST["idcliente"];
	$devo->terminado=0;
	$devo->nombre_cliente=$_POST["nombrecliente"];
                    
		  $devo->actualizar($_POST["iddevolucion"]);
			header("Location:".config::ruta()."?accion=devolucionDinero");
					 
			  }
			  
			  
			  
			  
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="aceptar" ){
	
	
	     $devo->actualizarTerminado($_GET["id"],1);
	        
		
		
		header("Location:".config::ruta()."?accion=devolucionDinero");
	
	
	
	}
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="borrar" ){
	
	
	     $devo->borrar($_GET["id"]);
	        
		
		
		header("Location:".config::ruta()."?accion=devolucionDinero");
	
	
	
	}
if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	$devo->monto=$_POST["monto"];
	$devo->moneda=$_POST["moneda"];
	$devo->descripcion=strtoupper($_POST["descripcion"]);
	$devo->numrecibo=strtoupper($_POST["numrecibo"]);
	$devo->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
	$devo->clientes_idclientes=$_POST["idcliente"];
	$devo->terminado=0;
	$devo->nombre_cliente=$_POST["nombrecliente"];
                    
		  $devo->nuevo();
			header("Location:".config::ruta()."?accion=devolucionDinero");
	 
			  
					 
		
	}
require_once("view/addDevolucionDinero.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>