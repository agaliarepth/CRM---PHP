<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT  cuotas.idcuotas,cuotas.fecha,cuotas.numpago,cuotas.saldo_inicial,cuotas.saldo_actual,cuotas.creditoVentas_idcreditoVentas,creditoVentas.ventas_idventas FROM cuotas,creditoventas WHERE cuotas.creditoVentas_idcreditoVentas=creditoventas.idcreditoVentas AND creditoVentas.ventas_idVentas='".$id."'";
			  $result=$db->query($sql)->fetchAll();
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>