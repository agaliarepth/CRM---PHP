<?php 
 require_once("model/ventasModel.php");
  require_once("model/creditoVentasModel.php");
 require_once("model/ventasContadoModel.php");
 require_once("model/tipoCambioModel.php");
  require_once("model/librosModel.php");
 require_once("model/detalle_egresoModel.php");
 require_once("model/clientesModel.php");
 require_once("model/devolucionModel.php");
 require_once("model/detalleDevolucionModel.php");




$tc=new tipoCambio();
 $tc1=$tc->recuperarUltimo();
$tc2=$tc->getId($tc1);
 $venta=new Ventas();
 $credito=new creditoVentas();
 $contado=new ventasContado();
 $libros=new Libros();
 $egreso=new detalleEgreso();
 $cliente=new Clientes();
 $devolucion=new Devolucion();
 $det_dev=new detalleDevolucion();
 
 if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){
	 $m=$_POST["moneda"];
	 $res=$venta->regVentas($_POST["mes"],$_POST["anio"]);
	 }

require_once("view/registroVentas.php")


?>