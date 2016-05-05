<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=kardexcliente.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<img type="image" name="imageField5"  src="<?php echo config::ruta();?>images/visual-logo.png" width="169" height="42"  alt="" style="margin-left:20;"/>
<h1 style=" text-align:center; font-size:14px; text-decoration:underline;  margin:0; ">KARDEX CLIENTE<br/>
(<?php echo "GESTION - ".$_POST["anio"];?> )</h1><br/>
<?php echo $_POST['datos_a_enviar'];?>