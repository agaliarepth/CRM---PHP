 <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/devolucionDeudasModel.php");

require_once("model/tipoCambioModel.php");

require_once("model/deudasModel.php");

 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
	$tc2=$tc->getId($tc1);

$deuda=new Deuda();
$devo=new DevolucionDeudas();


if (isset($_GET["e"])&&$_GET["e"]=="devolucion" && isset($_GET["id"])){
	$res=$deuda->getId($_GET["id"]);
	
	
	
	}
	
	   if (isset($_GET["e"])&&$_GET["e"]=="editar"){
		   
		   $res=$devo->getId($_GET["id"]);
		   require_once("view/addDevolucionDeudas.php");

		   }


	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		
$devo->monto=$_POST["monto"];
	$devo->moneda=$_POST["moneda"];
	$devo->descripcion=strtoupper($_POST["descripcion"]);
	$devo->notaingreso=strtoupper($_POST["notaingreso"]);
	$devo->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
	$devo->deudas_iddeudas=$_POST["iddeudas"];
	$devo->terminado=0;
	$devo->cliente=$_POST["cliente"];
                    
		  $devo->actualizar($_POST["iddevolucionDeuda"]);
			header("Location:".config::ruta()."?accion=devolucionDeudas");
					 
			  }
			  
			  
			  
			  
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="n" ){
	
	
	     $devo->actualizarTerminado($_GET["id"],1);
	        
			$res=$devo->getId($_GET["id"]);
			$de=$deuda->getId($res["deudas_iddeudas"]);
	      if($res["moneda"]=="Bs"&&$de["moneda"]=="Sus"){
			  
			  $monto=round($res["monto"]/$tc2["valor"],2);
			  
			  $deuda->updateSaldo($_GET["id"],$monto);
			  }
		   if($res["moneda"]=="Sus"&&$de["moneda"]=="Bs"){
			   
			    $monto=round($res["monto"]*$tc2["valor"],2);
			  
			  $deuda->updateSaldo($_GET["id"],$monto);
			   
			   }
		
		if($res["moneda"]==$de["moneda"]){
			   
			    $monto=round($res["monto"]);
			  
			  $deuda->updateSaldo($_GET["id"],$monto);
			   
			   }
		
		header("Location:".config::ruta()."?accion=devolucionDeudas");
	
	
	
	}

if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	$devo->monto=$_POST["monto"];
	$devo->moneda=$_POST["moneda"];
	$devo->descripcion=strtoupper($_POST["descripcion"]);
	$devo->notaingreso=strtoupper($_POST["notaingreso"]);
	$devo->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
	$devo->deudas_iddeudas=$_POST["iddeudas"];
	$devo->terminado=0;
	$devo->cliente=$_POST["cliente"];
                    
		  $devo->nuevo();
			header("Location:".config::ruta()."?accion=devolucionDeudas");
	 
			  
					 
		
	}
require_once("view/addDevolucionDeudas.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>