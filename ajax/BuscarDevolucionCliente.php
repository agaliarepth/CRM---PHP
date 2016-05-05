<?php
require_once("../helpers/conexion.php");
      $id=$_POST['id'];
	  $idcliente=$_GET["idcliente"];
       
      if(!empty($id)) {
            comprobar($id,$idcliente);
      }
       
      function comprobar($id,$idcliente) {
          global $db;
       
            $sql ="SELECT iddevolucion,total,fecha,moneda,saldo FROM devolucion WHERE idingreso='".$id."' AND  idcliente='".$idcliente."' AND terminado=1 AND estado='DEVUELTO'";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>