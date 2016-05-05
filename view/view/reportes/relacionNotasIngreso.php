<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=relacionIngreso.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<img type="image" name="imageField5"  src="<?php echo config::ruta();?>images/visual-logo.png" width="169" height="42"  alt="" style="margin-left:20;"/>
</h1>
<?php echo utf8_decode($_POST['datos_a_enviar']);?>