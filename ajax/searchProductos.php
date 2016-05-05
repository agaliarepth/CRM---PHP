[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term'])){
	$return_arr = array();
$criterio =$_GET["term"];
	
	    global $db;
	    
	    $sql="SELECT codigo,titulo,tomo,stock,idlibros,pv,cif,ps FROM libros WHERE codigo LIKE '%$criterio%' OR titulo LIKE '%$criterio%'" ;
	    
		$result=$db->query($sql);
		     $nombres =array();
	   foreach($result as $r){
			
			$nombres[$r["codigo"]]=html_entity_decode($r["titulo"],ENT_NOQUOTES,"UTF-8")."||".$r["tomo"]."||".$r["stock"]."||".$r["idlibros"]."||".$r["pv"]."||".$r["cif"]."||".$r["ps"];
			}
	   $contador=0;
	   $f="";
		foreach ($nombres as $descripcion => $valor) 
{
	
	
	$c = explode("||", $valor);

	$f.="{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\", \"stock_disponible\" : \"$c[2]\" , \"id\" : \"$c[3]\", \"precio\" : \"$c[4]\", \"cif\" : \"$c[5]\", \"ps\" : \"$c[6]\"},";
	
} // siguiente producto*/
echo  substr($f,0,-1);
//echo json_encode($result);
}

?>]