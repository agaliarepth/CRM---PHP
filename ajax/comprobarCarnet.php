<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($b) {
          global $db;
       
            $sql ="SELECT num_documento FROM deudores WHERE num_documento='".$b."'";
			  $result=$db->query($sql)->fetchALL();
             
            $contar = count($result);
             
            if($contar <= 0){
                  echo "si";
            }else{
                  echo "no";
            }
      }    
?>