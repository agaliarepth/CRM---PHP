<?php
if(isset($_POST))
{$f=30;
$di="P".$f."D";
	$fecha = new DateTime($_POST["fecha"]);
$fecha->add(new DateInterval($di));
echo $fecha->format('Y-m-d') . "\n";
	
	
	}
?>

<form method="post" action="" name="form">
fecvha
<input type="text" name="fecha"/>
dias gracia
<input type="text" name="gracia"/>
dias  de pago
<input type="text" name="dias"/>
numero de pagos
<input type="text" name="numpagos"/>
<button type="submit" name="enviar" value="Enviar"/>
</form>