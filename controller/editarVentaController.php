  <?php if(isset($_SESSION["modulo_ventas"])){?>

<?php

require_once("model/librosModel.php");
require_once("model/tipoCambioModel.php");
require_once("model/clientesModel.php");
require_once("model/ventasModel.php");
require_once("model/detalleVentasModel.php");
require_once("model/creditoVentasModel.php");
require_once("model/ventasContadoModel.php");
require_once("model/cuotasModel.php");
require_once("model/vendedores_usuariosModel.php");
require_once("model/vendedoresModel.php");






 $tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
$v=new Ventas();
$de=new detalleVentas();
$cv=new creditoVentas();
$contado=new ventasContado();
$li=new Libros();
$cuota =new Cuotas();
$vu=new VendedoresUsuarios();
$vendedor=new Vendedores();
//$res=$v->listarTodosTerminadoTipoVenta("CREDITO");
$res=$v->listarTodosTerminadoDespachadoTodos();
$listaVendedores=$vu->getVendedores($_SESSION["ses_id"]);

if(isset ($_GET["id"]) && $_GET["id"]!="" &&  $_GET["e"]=="editarVenta" ){

	$res=$v->getId($_GET["id"]);
	$res2=$de->getDetalle($_GET["id"]);
	$credito=$cv->getVenta($_GET["id"]);
	$cont=$contado->getVenta($_GET["id"]);


	}



if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar" && !isset($_POST["editar"]) ){

	if($_POST["tipo"]=="credito"){
		//print_r($_POST);
	$aux1=explode("||",$_POST["vendedor"]);
	$v->total=$_POST["monto_total"];
	$v->cantidad=$_POST["cant_total"];
	$v->moneda=$_POST["moneda"];
	$v->cambio=$_POST["cambio"];
	$v->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
	$v->clientes_idclientes=$_POST["idclientes"];
	  if($_POST["vender"]==1){
	$v->terminado=1;
	$v->estado="En Almacen";
	  }
	 if($_POST["vender"]==0){
	 $v->terminado=0;
	 $v->estado="Sin Enviar";
	 }
	$v->usuario=$_SESSION["nombres"];
	$v->estado="Sin Enviar";

	$v->despachado=0;
	$v->idegreso=0;
	$v->transporte=$_POST["transporte"];
	$v->nit=$_POST["nit"];
	$v->pais=$_POST["pais"];
	$v->telf=$_POST["telf"];
    $v->nombre=$_POST["nombre"];
	$v->razonsocial=$_POST["razonsocial"];
	$v->vendedor=$aux1[1];
	$v->ciudad=$_POST["ciudad"];
	$v->tipoventa="CREDITO";
	$v->total_cancelar=$_POST["totalcancelar"];
	$v->tipo_desc=$_POST["tipo_desc"];
	$v->monto_descuento=$_POST["monto_descuento"];
	$v->localidad=$_POST["localidad"];
	$v->destino=$_POST["destino"];
		$v->idvendedores=$aux1[0];

	$v->nuevo();
	$lastID=Ventas::$lastId;

	$cv->saldo_inicial=$_POST["monto_total"]-$_POST["adelanto"];
	$cv->saldo_actual=$cv->saldo_inicial;
	$cv->num_cuotas=$_POST["num_cuotas"];
	$cv->monto_cuotas=$cv->saldo_inicial/$_POST["num_cuotas"];
	$cv->dias=$_POST["dias"];
	$cv->ventas_idventas=$lastID;
	$cv->adelanto=$_POST["adelanto"];
	$cv->tipoadelanto=$_POST["tipoadelanto"];
	$cv->cuentabanco=strtoupper($_POST["cuentabancoadelanto"]);
	$cv->reciboadelanto=strtoupper($_POST["reciboadelanto"]);
	$cv->facturaadelanto=strtoupper($_POST["facturaadelanto"]);
	$di="P".$_POST["dias"]."D";
	$fecha=new DateTime($_POST["fecha"]);
    $fecha->add(new DateInterval($di));
	$cv->fechaprimerpago=$fecha->format("Y-m-d");
    $cv->diaspago=$_POST["diaspago"];



	$cv->nuevo();


		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=htmlentities($_POST["titulo"][$i], ENT_QUOTES,'UTF-8');
		 $de->volumen=$_POST["tomo"][$i];
		 $de->ventas_idventas=$lastID;
		  $de->insertar();




		 }

		  $de->nuevo();


		  if($_POST["vender"]==1){

					header("Location:".config::ruta()."?accion=verNotaVenta&id=".$lastID);

		  }

		 if($_POST["vender"]==0)

			header("Location:".config::ruta()."?accion=ventasCredito");


	}

    if($_POST["tipo"]=="contado"){
		 $aux1=explode("||",$_POST["vendedor"]);
		$v->total=$_POST["monto_total"];
	$v->cantidad=$_POST["cant_total"];
	$v->moneda=$_POST["moneda"];
	$v->cambio=$_POST["cambio"];
	$v->fecha=date("Y-m-d",strtotime($_POST["fecha"]));
		$v->clientes_idclientes=$_POST["idclientes"];

	  if($_POST["vender"]==1){
	$v->terminado=1;
	$v->estado="En Almacen";
	  }
	 if($_POST["vender"]==0){
	 $v->terminado=0;
	 $v->estado="Sin Enviar";
	 }
	$v->terminado=0;
	$v->usuario=$_SESSION["nombres"];
	$v->estado="Sin Enviar";

	$v->despachado=0;
	$v->idegreso=0;
	$v->transporte=$_POST["transporte"];
	$v->nit=$_POST["nit"];
	$v->pais=$_POST["pais"];
	$v->telf=$_POST["telf"];
    $v->nombre=$_POST["nombre"];
	$v->razonsocial=$_POST["razonsocial"];
	$v->vendedor=$aux1[1];
	$v->ciudad=$_POST["ciudad"];
	$v->tipoventa="CONTADO";
	$v->total_cancelar=$_POST["totalcancelar"];
	$v->monto_descuento=$_POST["monto_descuento"];

	$v->tipo_desc=$_POST["tipo_desc"];
	$v->localidad=$_POST["localidad"];
	$v->destino=$_POST["destino"];
		$v->idvendedores=$aux1[0];

	$v->nuevo();
	$lastID=Ventas::$lastId;

	$contado->numfactura=$_POST["numfactura"];
	$contado->numingreso=$_POST["numingreso"];
	$contado->ventas_idventas=$lastID;
	$contado->monto=$_POST["montoingreso"];
	$contado->saldo=$_POST["montoingreso"]-$v->total_cancelar;
	$contado->tipopago=$_POST["tipopago"];
	$contado->cuentabanco=$_POST["cuentabanco"];
	$contado->nuevo();


		 for($i=0; $i<$_POST["num_filas"];$i++){
		 $de->cantidad=$_POST["cantidad"][$i];

		 $de->precio_unit=$_POST["precio_unit"][$i];
		 $de->precio_total=$_POST["precio_total"][$i];
		 $de->libros_idlibros=$_POST["idlibro"][$i];
		 $de->codigo=$_POST["codigo"][$i];
		 $de->titulo=htmlentities($_POST["titulo"][$i], ENT_QUOTES,'UTF-8');
		 $de->volumen=$_POST["tomo"][$i];
		 $de->ventas_idventas=$lastID;
		  $de->insertar();




		 }

		  $de->nuevo();
		  if($_POST["vender"]==1)

					header("Location:".config::ruta()."?accion=verNotaVenta&id=".$lastID);

		 if($_POST["vender"]==0)
		 header("Location:".config::ruta()."?accion=ventasCredito");

		}





	}
require_once("view/editarVenta.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>
