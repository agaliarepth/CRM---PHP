[<?php
require_once("../helpers/conexion.php");
if (isset($_GET['term'])){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	    global $db;
	        $sql="SELECT nombres, localidad, apellidos, empresa, idclientes, nitruc,origen,ciudad,telefono,razonsocial FROM clientes WHERE nombres LIKE '%$criterio%' OR apellidos LIKE '%$criterio%' OR nitruc LIKE '%$criterio%'";
		$result=$db->query($sql);
		     $nombres =array();
	        foreach($result as $r){
			
			$nombres[$r["nombres"]." ".$r["apellidos"]]=$r["nitruc"]."||".$r["idclientes"]."||".$r["empresa"]."||".$r["origen"]."||".$r["ciudad"]."||".$r["telefono"]."||".$r["localidad"]."||".$r["razonsocial"];
			}
			//print_r($nombres);
	   $contador=0;
	   $f="";
		foreach ($nombres as $descripcion => $valor) 
{
	
		
	$c = explode("||", $valor);
	$f.="{ \"nombres\" : \"$descripcion\", \"nit\" : \"$c[0]\", \"idclientes\" : \"$c[1]\", \"empresa\" : \"$c[2]\", \"origen\" : \"$c[3]\", \"ciudad\" : \"$c[4]\", \"telefono\" : \"$c[5]\", \"localidad\" : \"$c[6]\",\"razonsocial\" : \"$c[7]\"},";
	
} // siguiente producto*/
	echo  utf8_decode(substr($f,0,-1));
//echo json_encode($result);
}

?>]