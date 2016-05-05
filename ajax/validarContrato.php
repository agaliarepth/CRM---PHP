<?php
require_once("../helpers/conexion.php");

	    global $db;
	      $validateError= "Este Contrato ya existe";
          $validateSuccess= "El contrato esta Correcto";
    /* RECEIVE VALUE */
    $validateValue=$_REQUEST['fieldValue'];
    $validateId=$_REQUEST['fieldId'];
	
	  $sql="SELECT numcontrato FROM contratos WHERE numcontrato='". $validateValue."'" ;
	   	    $res=$db->query($sql)->fetchColumn();
    /* RETURN VALUE */
    $arrayToJs = array();
    $arrayToJs[0] = $validateId;
    if($res>0)
    {    // validate??
        $arrayToJs[1] = true;    // RETURN TRUE
        echo json_encode($arrayToJs);    // RETURN ARRAY WITH success
    }
    else
    {
        $arrayToJs[1] = false;
        echo json_encode($arrayToJs);    // RETURN ARRAY WITH ERROR    
    }
?>