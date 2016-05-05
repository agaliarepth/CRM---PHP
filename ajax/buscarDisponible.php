<?php

require_once("../helpers/conexion.php");
      $user = $_POST['b'];
       
      if(!empty($user)) {
            comprobar($user,$_GET["id"]);
      }
       
      function comprobar($b,$v) {
          global $db;
       
            $sql ="SELECT count(cod_libro) as disponible FROM kardexVendedor WHERE cod_libro='".$b."' AND estado_libro ='Remitido' AND vendedores_idVendedores='".$v."' AND (cargo!=2)";
			  $result=$db->query($sql)->fetch();
             
            $contar = count($result);
             
            if($contar <= 0){
                  echo "0";
            }else{
                  echo $result["disponible"];
            }
      }    
?>