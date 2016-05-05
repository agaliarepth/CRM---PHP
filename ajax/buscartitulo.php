<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($b) {
          global $db;
       
            $sql ="SELECT titulo FROM libros WHERE idlibros='".$b."'";
			  $result=$db->query($sql)->fetch();
             
            $contar = count($result);
             
            if($contar <= 0){
                  echo "sin titulo";
            }else{
                  echo $result["titulo"];
            }
      }    
?>