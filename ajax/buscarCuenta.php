[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term']) ){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	
	    global $db;
	    
	    $sql="SELECT idcuentas,num_cuenta,saldo,saldo_actual,nombre_cobrador,idcobrador,nombre_cliente  FROM cuentas WHERE num_cuenta =".$_GET['term'];
	    $result=$db->query($sql);
		
		$nombres =array();
	   foreach($result as $r){
			
			$nombres=array($r["idcuentas"]=>$r["num_cuenta"]."||".$r["saldo"]."||".$r["saldo_actual"]."||".$r["nombre_cobrador"]."||".$r["idcobrador"]."||".$r["nombre_cliente"]);
			}
	   $contador=0;
		foreach ($nombres as $descripcion => $valor) 
{
	
		if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
	//print "{ \"label\" : \"$descripcion\", \"value\" : { \"descripcion\" : \"$descripcion\", \"precio\" : $valor } }";
	$c = explode("||", $valor);

	print "{ \"idcuentas\" : \"$descripcion\", \"num_cuenta\" : \"$c[0]\", \"saldo\" : \"$c[1]\",\"saldo_actual\" : \"$c[2]\", \"nombre_cobrador\" : \"$c[3]\",\"idcobrador\" : \"$c[4]\", \"nombre_cliente\" : \"$c[5]\"}";
	
} // siguiente producto*/

//echo json_encode($result);
}

?>]