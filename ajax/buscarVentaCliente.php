<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
	  //$idCliente=$_POST["idcliente"];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT idventas,total,cantidad,moneda,fecha,nombre,clientes_idclientes,idegreso,tipoventa FROM ventas WHERE idventas='".$id."'";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>