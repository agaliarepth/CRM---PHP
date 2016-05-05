[<?php
require_once("../helpers/conexion.php");
if (isset($_GET['term'])){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	    global $db;
	        $sql='SELECT nombres, apellidos, carnet, idVendedores FROM vendedores WHERE carnet LIKE :term OR apellidos LIKE :term OR nombres LIKE :term'  ;

	   	     $result=$db->Execute($sql,array(':term' => '%'.$_GET["term"].'%'));
		     $nombres =array();
	        foreach($result as $r){
			
			$nombres=array($r["nombres"]." ".$r["apellidos"]=>$r["carnet"]."||".$r["idVendedores"]);
			}
	   $contador=0;
		foreach ($nombres as $descripcion => $valor) 
{
	
		if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
	//print "{ \"label\" : \"$descripcion\", \"value\" : { \"descripcion\" : \"$descripcion\", \"precio\" : $valor } }";
	$c = explode("||", $valor);
	print "{ \"label\" : \"$descripcion\", \"valor\" : \"$c[0]\", \"idVendedor\" : \"$c[1]\" }";
	
} // siguiente producto*/

//echo json_encode($result);
}

?>]