<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
	    $user2 = $_GET['b1'];
       
      if(!empty($user)) {
            comprobar($user,$user2);
      }
       
      function comprobar($b,$b1) {
          global $db;
       
            $sql ="SELECT numrecibo FROM pagos WHERE cuentas_idcuentas='".$b."' AND numrecibo='".$b1."'";
			  $result=$db->query($sql)->fetchALL();
             
            $contar = count($result);
             
            if($contar <= 0){
                  echo "si";
            }else{
                  echo "no";
            }
      }    
?>