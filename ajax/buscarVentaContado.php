<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT  ventascontado.idventascontado,ventascontado.numfactura,ventascontado.numingreso,ventascontado.ventas_idventas,ventascontado.monto,ventascontado.tipopago,ventascontado.cuentabanco,ventas.fecha FROM ventascontado, ventas WHERE ventascontado.ventas_idventas='".$id."' AND ventascontado.ventas_idventas=ventas.idventas";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>