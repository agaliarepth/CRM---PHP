<?php

$di="P".$_GET["gracia"]."D";
	$fecha=new DateTime($_GET["fecha"]);
    $fecha->add(new DateInterval($di));
	$fechaprimerpago=$fecha->format("Y-m-d");
$intervalodias=round($_GET["dias"]/$_GET["cuotas"],0);
			  $fecha2 = new DateTime($fechaprimerpago);

	 //
	 
	 $cadena1 =array();
	 
	  for($i=0; $i<$_GET["cuotas"];$i++){
		  $cadena2=array();
			  $j=1;
			  $f=$intervalodias*$j;
			  $di="P".$f."D";
			  $fecha2->add(new DateInterval($di));
			$cadena2["numcuota"]=($i+1)."/".$_GET["cuotas"];
			$cadena2["fecha"]=$fecha2->format('d-m-Y');
			$cadena2["monto"]=round($_GET["monto"]/$_GET["cuotas"],2);
			$cadena[$i]=$cadena2;
       
			  $j++;
			  }


              echo  json_encode($cadena);


			  
         
    
?>