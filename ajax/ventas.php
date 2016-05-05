[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term'])&& isset($_GET["id"]) ){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	
	    global $db;
	    
	    $sql="SELECT idkardexVendedor,cod_libro, idlibro,titulo_libro,tomo_libro  FROM kardexvendedor WHERE cod_libro LIKE :term  AND vendedores_idVendedores='".$_GET["id"]."'  AND estado_libro='Remitido' order by fecha_remision desc ";
	    $result=$db->Execute($sql,array(':term' => '%'.$_GET["term"].'%'));
		
		$nombres =array();
	   foreach($result as $r){
			
			$nombres=array($r["cod_libro"]=>$r["titulo_libro"]."||".$r["tomo_libro"]."||".$r["idlibro"]."||".$r["idkardexVendedor"]);
			}
	   $contador=0;
		foreach ($nombres as $descripcion => $valor) 
{
	
		if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
	//print "{ \"label\" : \"$descripcion\", \"value\" : { \"descripcion\" : \"$descripcion\", \"precio\" : $valor } }";
	$c = explode("||", $valor);

	print "{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\",\"id\" : \"$c[2]\", \"idk\" : \"$c[3]\"}";
	
} // siguiente producto*/

//echo json_encode($result);
}

?>]