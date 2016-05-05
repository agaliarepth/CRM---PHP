<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       $idcliente=$_GET["cli"];
      if(!empty($id)) {
            comprobar($id,$idcliente);
      }
       
      function comprobar($id,$idcliente) {
          global $db;
       
            $sql ="SELECT  cuotas.idcuotas,cuotas.fecha,cuotas.numpago,cuotas.saldo_inicial,cuotas.saldo_actual,cuotas.creditoVentas_idcreditoVentas,creditoVentas.ventas_idventas,ventas.nombre,ventas.fecha as fechaVenta , ventas.idventas, ventas.total as totalVenta FROM cuotas,creditoventas ,ventas WHERE cuotas.creditoVentas_idcreditoVentas=creditoventas.idcreditoVentas AND creditoVentas.ventas_idVentas='".$id."' AND  ventas.idventas=creditoventas.ventas_idventas AND ventas.clientes_idclientes='".$idcliente."'";
			  $result=$db->query($sql)->fetchAll();
             
            
			if(count($result)>0)
              echo  json_encode($result);
			  else
			  echo 0;
			  
         
      }    
?>