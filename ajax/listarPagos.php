<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT monto,fecha,numfactura,numnpago,idventas,tipopago,numrecibo,cuentabanco,cuotas_idcuotas FROM pagoVentasCredito WHERE idventas='".$id."'";
			  $result=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0)
              echo  json_encode($result); 
			 //print_r($result);
			  else
			  echo 0;
			  
         
      }    
?>