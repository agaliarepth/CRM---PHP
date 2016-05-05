<?php 
require_once("model/comprasModel.php");
require_once("model/pagosComprasModel.php");
require_once("model/proveedoresModel.php");

if(isset($_GET["id"])&&$_GET["id"]!=""){
	$c=new Compras();
	$res=$c->getId($_GET["id"]);
	$p=new Proveedores();
	
require_once("view/addPagosCompras.php");	
	
	}
	if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
		$pa=new Pagoscompras();
		$pa->monto=$_POST["monto"];
		$pa->fecha=$_POST["fecha"];
		$pa->numdoc=strtoupper($_POST["numdoc"]);
		$pa->descripcion=strtoupper($_POST["descripcion"]);

		$pa->compras_idcompras=$_POST["idcompras"];
		
		if($c->getSaldo($_POST["idcompras"])<=0){
			
			echo "
	   <script type='text/javascript' >
alert(' El saldo es 0.. ERROR?');
	location.href='".config::ruta()."?accion=compras'
	</script>";
			}
			else{
		$pa->nuevo();
		// $c->actualizarSaldo($_POST["idcompras"],$_POST["monto"]);
		
		echo "
	   <script type='text/javascript' >
alert('Se ha registrado el Pago correctamente......');
	location.href='".config::ruta()."?accion=compras'
	</script>";
	}
		
		}



?>