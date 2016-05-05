<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
	    
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($b) {
          global $db;
       
            $sql ="SELECT num_cuenta FROM cuentas WHERE num_cuenta='".$b."'";
			  $result=$db->query($sql)->fetchALL();
             
            $contar = count($result);
             
            if($contar <= 0){
                  echo "si";
            }else{
                  echo "no";
            }
      }    
?>