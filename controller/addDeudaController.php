 <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/deudasModel.php");
require_once("model/clientesModel.php");
require_once("model/vendedoresModel.php");

$d=new Deuda();
$vendedor=new Vendedores();
	$listaVendedores=$vendedor->listarTodos();

if(isset($_GET["e"])&&isset($_GET["id"])&&$_GET["e"]=="editar"){
$res=$d->getId($_GET["id"]);

}
if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
	 $d->saldo_inicial=$_POST["saldo_inicial"];
	 $d->saldo_actual=$_POST["saldo_actual"];
	 	 $d->saldo=$_POST["saldo"];

	 $d->descripcion=strtoupper($_POST["descripcion"]);
	 $d->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
	 		 	 $d->fechavencimiento=date("Y-m-d",strtotime($_POST["fechavencimiento"])); 
 

	 $d->clientes_idclientes=$_POST["idclientes"];
	 $d->moneda=$_POST["moneda"];
	 $d->nombre_cliente=$_POST["cliente"];
	 $d->dias_credito=$_POST["dias_credito"];
	 $d->numcuotas=$_POST["numcuotas"];
	 $d->fechavencimiento=date("Y-m-d",strtotime($_POST["fechavencimiento"])); 
	 	 $d->comision=$_POST["comision"];
		 	 	 $d->idvendedores=$_POST["idvendedor"];


	 $d->actualizar($_POST["iddeudas"]);
	 header("Location:".config::ruta()."?accion=deudas");

	
	
}
if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
	 $d->saldo_inicial=$_POST["saldo_inicial"];
	 $d->saldo_actual=$_POST["saldo_actual"];
	 $d->saldo=$_POST["saldo"];
	 $d->descripcion=strtoupper($_POST["descripcion"]);
	 $d->fecha=date("Y-m-d",strtotime($_POST["fecha"])); 
	 $d->fechavencimiento=date("Y-m-d",strtotime($_POST["fechavencimiento"])); 

	 $d->clientes_idclientes=$_POST["idclientes"];
	 $d->moneda=$_POST["moneda"];
	 $d->nombre_cliente=$_POST["cliente"];
	 $d->dias_credito=$_POST["dias_credito"];
	 $d->numcuotas=$_POST["numcuotas"];
	 $d->comision=$_POST["comision"];
	  $d->idvendedores=$_POST["idvendedor"];
	 $d->nuevo();
	      header("Location:".config::ruta()."?accion=deudas");

	
	 }
require_once("view/addDeuda.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>