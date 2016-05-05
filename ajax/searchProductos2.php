[<?php
require_once("../helpers/conexion.php");


if (isset($_GET['term'])&&$_GET["id"]){
	$return_arr = array();
$criterio = strtolower($_GET["term"]);
	
	    global $db;
	    
	    $sql="SELECT libros.codigo,libros.titulo,libros.tomo,libros_has_almacenes.stock_disponible,libros.idlibros, libros.precio_base FROM libros_has_almacenes , libros WHERE libros.idlibros=libros_has_almacenes.libros_idlibros AND  libros_has_almacenes.almacenes_idalmacenes='".$_GET["id"]."' and libros.codigo LIKE :term OR titulo LIKE :term" ;
	    $result=$db->Execute($sql);
		
		$nombres =array();
	   foreach($result as $r){
			
			$nombres=array($r["codigo"]=>$r["titulo"]."||".$r["tomo"]."||".$r["stock_disponible"]."||".$r["idlibros"]."||".$r["precio_base"]);
			}
	   $contador=0;
		foreach ($nombres as $descripcion => $valor) 
{
	
		if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
	//print "{ \"label\" : \"$descripcion\", \"value\" : { \"descripcion\" : \"$descripcion\", \"precio\" : $valor } }";
	$c = explode("||", $valor);

	print "{ \"codigo\" : \"$descripcion\", \"titulo\" : \"$c[0]\", \"tomo\" : \"$c[1]\", \"stock_disponible\" : \"$c[2]\" , \"id\" : \"$c[3]\", \"precio\" : \"$c[4]\" }";
	
} // siguiente producto*/

//echo json_encode($result);
}

?>]