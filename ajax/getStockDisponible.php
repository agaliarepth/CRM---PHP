<?php

require_once("../helpers/conexion.php");
      $id= $_POST['idlibro'];
    
      if(!empty($id)) {
            buscar($id);
      }
       
      function buscar($idlibro) {
          global $db;
       $ing=0;
	   $devo=0;
	   $remi=0;
	   $egr=0;
            $sql ="SELECT sum(cantidad) as total  FROM detalle_ingreso,ingreso WHERE detalle_ingreso.libros_idlibros='".$idlibro."' AND detalle_ingreso.ingreso_idingreso=ingreso.idingreso AND ingreso.terminado=1 AND ingreso.estado='Enviado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $ing=$res1["total"];
			  
			  
			 
			 
			  
			  
			  $sql ="SELECT sum(detalle_egreso.cantidad) as total  FROM detalle_egreso,egreso WHERE detalle_egreso.libros_idlibros='".$idlibro."' AND detalle_egreso.egreso_idegreso=egreso.idegreso   AND egreso.estado='Enviado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $egr=$res1["total"];
             
			   
			  
			 
			 
            $stock=$ing-$egr;
			
             
            if($stock<= 0){
                  echo "0";
            }else{
                  echo $stock;
            }
      }    
?>