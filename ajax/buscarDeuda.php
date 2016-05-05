<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            comprobar($id);
      }
       
      function comprobar($id) {
          global $db;
       
            $sql ="SELECT iddeudas,saldo_inicial,saldo_actual,saldo,descripcion,fecha,clientes_idclientes,moneda,nombre_cliente,dias_credito,numcuotas,idvendedores,comision,fechavencimiento FROM deudas WHERE iddeudas='".$id."'";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>