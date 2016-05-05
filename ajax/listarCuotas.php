<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT idcuotas,fecha,numpago,saldo_inicial,saldo_actual,creditoVentas_idcreditoVentas FROM cuotas WHERE creditoVentas_idcreditoVentas='".$id."'";
			  $result=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0)
              echo  json_encode($result); 
			 //print_r($result);
			  else
			  echo 0;
			  
         
      }    
?>