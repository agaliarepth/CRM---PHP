<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PLAN DE PAGOS</title>
</head>

<body>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="font-size:12px">
  <tr>
    <td width="34%"><strong>FECHA DE VENTA</strong></td>
    <td width="14%"><?php echo $_GET["fv"]; ?></td>
    <td width="28%"><strong>DIAS DE PAGO</strong></td>
    <td width="24%"><?php echo $_GET["dp"]; ?></td>
   
  </tr>
  <tr>
    <td><strong>NUMERO DE CUOTAS</strong></td>
    <td><?php echo $_GET["nc"]; ?></td>
    <td><strong>DIAS DE GRACIA:</strong></td>
    <td><?php echo $_GET["dg"]; ?></td>
   
  </tr>
</table>
<p align="center">PLAN DE PAGOS</p>
<HR/>
<TABLE width="371" height="20" border="1" cellpadding="0" cellspacing="0" style="font-size:11px">
<?php 

$di="P".$_GET["dg"]."D";
	$fecha=new DateTime($_GET["fv"]);
    $fecha->add(new DateInterval($di));
	$fechaprimerpago=$fecha->format("Y-m-d");
$intervalodias=round($_GET["dp"]/$_GET["nc"],0);
		
		  $fecha2 = new DateTime($fechaprimerpago);
		  
		  for($i=0; $i<$_GET["nc"];$i++){
			  $j=1;
			  $f=$intervalodias*$j;
			  $di="P".$f."D";
			  $fecha2->add(new DateInterval($di));
			  ?>
          
          <tr>
          <td width="51"> <strong>PAGO:</strong> <?php echo ($i+1)."/".$_GET["nc"];?></td>
          <td width="168"> <strong>FECHA VENCIMIENTO</strong>:<?php echo $fecha2->format('d-m-Y');?></td>
          <td width="116"><strong>MONTO</strong>: <?php echo round($_GET["mt"]/$_GET["nc"],2);?></td>
			  </tr>
			<?php 
			  $j++;}?>


</TABLE>

</body>
</html>