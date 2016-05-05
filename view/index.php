<?php require_once("config.php");

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>VISUAL-LOGIN</title>
<meta name="description" content="VISUAL-LOGEO">

<link rel="stylesheet" type="text/css" href="<?php echo config::ruta();?>css/stylelogin.css" />

</head>
<body>


<form id="slick-login" method="post">
<span style="margin: auto;" ><img src="<?php echo config::ruta();?>images/visual-logo.png" width="209" height="102"/></span>
<h2 style="color:#FFF; font-family:helvetica; font-weight:bold; margin-top:7px;">SUCURSAL <?php echo SUCURSAL?></h2>
<label for="username">Nombre de Usuario</label><input type="text" name="username" class="placeholder" placeholder="nombre usuario">
<label for="password">Contrase&ntilde;a</label><input type="password" name="password" class="placeholder" placeholder="contrase&ntilde;a">
  <input type="hidden" name="grabar" value="si"/>
<input type="submit" value="INGRESAR">
</form>

</body>
</html>