<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($b) {
          global $db;
       
            $sql ="SELECT count(idcontrato) as dispo FROM contratos WHERE numcontrato='".$b."'";
			  $result=$db->query($sql)->fetch();
             
            $contar = count($result);
             
        
                  echo $result["dispo"];
         
      }    
?>