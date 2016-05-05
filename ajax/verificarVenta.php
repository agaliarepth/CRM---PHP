<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
	    
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($b) {
          global $db;
       
            $sql ="SELECT idventas FROM ventas WHERE idventas='".$b."'";
			  $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
             
            if(empty($result)){
                 echo 0;
            }else{
                  echo 1;
            }
      }    
?>