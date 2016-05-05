<?php

require_once("../helpers/conexion.php");
      $id = $_POST['id'];
       
      if(!empty($id)) {
            eliminarCargo($id);
      }
       
      function eliminarCargo($id) {
          global $db;
        $sw;
            $sql ="delete from pagoscompras WHERE idpagosCompras='".$id."'";
			 
			 if( $result=$db->query($sql))
			 
             $sw=1;
			 else
			 $sw=0;
            
             
            if($sw == 1){
                  echo "0";
            }else{
                  echo "1";
            }
      }    
?>