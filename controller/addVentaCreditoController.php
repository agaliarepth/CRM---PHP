<?php 

require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/clientesModel.php");
require_once("model/ventasCreditoModel.php");
require_once("model/detalleVentasCreditoModel.php");



 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
$v=new VentasCredito();
$de=new detalleVentasCredito();
$li=new Libros();


if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="ei" ){
	$d=new detalleCompras();
	$res4=$compra->getId($_GET["id"]);
	$res3=$d->getDetalle($_GET["id"]);
	
	
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar" ){
		             $de=new detalleCompras();
					 $de->borrarPorNota($_POST["idcompras"]);
					
					 unset($de);
		
    $compra->total=$_POST["monto_total"];
	$compra->fecha=$_POST["fecha"];
	$compra->numero_doc=$_POST["numero_doc"];
	$compra->cambio=$_POST["valor_cambio"];
	$compra->moneda=$_POST["moneda"];
	$compra->proveedores_idproveedores=$_POST["proveedores_idproveedores"];
	
	if($_POST["tipo"]=="contado"){
	 $compra->tipo=$_POST["tipo"];	
	$compra->condiciones="";
	$compra->gracia="";
	$compra->fechapago="";
	$compra->numcuotas="";
	$compra->saldo=0;
	$compra->montocancelado=$_POST["montocancelado"];
		
		}
		else{
    $compra->tipo=$_POST["tipo"];
	$compra->condiciones=$_POST["condiciones"];
	$compra->gracia=$_POST["gracia"];
	$compra->fechapago=$_POST["fechapago"];
	$compra->numcuotas=$_POST["numcuotas"];
	$compra->saldo=$_POST["saldo"];
	$compra->montocancelado=$_POST["montocancelado"];
		}
		
	$compra->estado="sin enviar";
	$compra->terminado=0;
					 $compra->actualizar($_POST["idcompras"]);
					 $lastID=$_POST["idcompras"];
					 
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de=new detalleCompras();
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->obs=$_POST["obs"][$i];
		 $de->factura=$_POST["factura"][$i];
		 $de->compras_idcompras=$lastID;
		  $de->insertar();
		 unset($de);

		 

		 }
		  $de=new detalleCompras();
		  $de->nuevo();
		  unset($de);
					header("Location:".config::ruta()."?accion=compras");
	 
					 

					 
			  }
if(isset ($_GET["id"]) && $_GET["id"]!="" && $_GET["e"]=="confirmar" ){
	
	$nota=$compra->getId($_GET["id"]);
	$d=new detalleCompras();
	$det=$d->getDetalle($_GET["id"]);
	$compra->actualizarEstado($_GET["id"]);
	
	
		header("Location:".config::ruta()."?accion=compras");
	}

if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){
	
	$v->total=$_POST["monto_total"];
	$v->cantidad=$_POST["cant_total"];
	$v->moneda=$_POST["moneda"];
	$v->cambio=$_POST["cambio"];
	$v->fecha=$_POST["fecha"];
	$v->clientes_idclientes=$_POST["idclientes"];
	$v->terminado=0;
	$v->usuario=$_SESSION["nombres"];
	$v->estado="";
	$v->nit=$_POST["nit"];
	$v->pais=$_POST["pais"];
	$v->telf=$_POST["telf"];
    $v->nombre=$_POST["nombre"];
	$v->razonsocial=$_POST["razonsocial"];
	$v->vendedor=$_POST["vendedor"];
	$v->nuevo();
	 $lastID=VentasCredito::$lastId;
					 
		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=$_POST["titulo"][$i];
		 $de->volumen=$_POST["tomo"][$i];
		 $de->ventascredito_idventascredito=$lastID;
		  $de->insertar();
		

		 

		 }
		 
		  $de->nuevo();
		  if($_POST["vender"]==0){
		
					header("Location:".config::ruta()."?accion=ventasCredito");
		  }
		   if($_POST["vender"]==1){
		
					header("Location:".config::ruta()."?accion=addCondiciones&id=$lastID");
		  }
    
		 

		
					 
		
	}
require_once("view/addVentaCredito.php");

?>