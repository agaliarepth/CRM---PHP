 <?php if(isset($_SESSION["modulo_compras"])){?>  
<?php 

require_once("model/comprasModel.php");
require_once("model/cargosComprasModel.php");
require_once("model/proveedoresModel.php");

if(isset($_GET["id"])&&$_GET["id"]!=""){
	$c=new Compras();
	$res=$c->getId($_GET["id"]);
	$p=new Proveedores();
	
require_once("view/addCargosCompras.php");	
	
	}
	if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
		$cargo=new CargosCompras();
		$cargo->monto=$_POST["monto"];
		$cargo->fecha=$_POST["fecha"];
		$cargo->numdoc=strtoupper($_POST["numdoc"]);
	    $cargo->descripcion=strtoupper($_POST["descripcion"]);

		$cargo->compras_idcompras=$_POST["idcompras"];
		
		if($c->getSaldo($_POST["idcompras"])<=0){
			
			echo "
	   <script type='text/javascript' >
alert(' El saldo es 0.. ERROR?');
	location.href='".config::ruta()."?accion=compras'
	</script>";
			}
			else{
		$cargo->nuevo();
		// $c->actualizarSaldo($_POST["idcompras"],$_POST["monto"]);
		
		echo "
	   <script type='text/javascript' >
alert('Se ha registrado el Cargo correctamente......');
	location.href='".config::ruta()."?accion=compras'
	</script>";
	}
		
		}



?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>