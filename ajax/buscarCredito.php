<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT creditoVentas.idcreditoVentas,creditoVentas.saldo_inicial,creditoVentas.saldo_actual,creditoVentas.num_cuotas,creditoVentas.monto_cuotas,creditoVentas.dias,creditoVentas.ventas_idventas,creditoVentas.diaspago,ventas.nombre FROM creditoVentas,ventas WHERE creditoVentas.ventas_idventas='".$id."' AND ventas.idventas=creditoVentas.ventas_idventas and despachado=1";
			  $result=$db->query($sql)->fetchAll();
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>