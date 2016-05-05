<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tipo de Cambio</title>
</head>

<body>
<form action="" method="post">
<table width="388" border="1">
  <tr style=" background-color:#333; color:#FFF;">
    <th width="203" scope="col">&nbsp;</th>
    <th width="87" scope="col">Valor Sus</th>
    <th width="76" scope="col">Valor Bs</th>
  </tr>
  <tr style="background-color:#E3F4F9;">
    <td><p>Ultima Cotizacion<br><?php echo $res3["fecha"]; ?></br>
    </p></td>
    <td>
    <input name="textfield" type="text" id="textfield" value="1" size="10" readonly></td>
    <td><input name="textfield2" type="text" id="textfield2" value="<?php echo $res3["valor"];?>" size="10" readonly/></td>
  </tr>
  <tr  style="background-color:#E3F4F9;">
    <td style="background-color:#E3F4F9;"><p>Cotizacion Hoy</p>
      <p><?php echo date("Y-m-d H:i:s");?></p></td>
    <td><input name="textfield3" type="text" id="textfield3" value="1" size="10" readonly></td>
    <td><input name="valor" type="text" id="valor" size="10"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Registrar">
    <input type="hidden" name="enviar" value="enviar"/>
    </td>
    <td><input type="button" name="button" id="button" value="Cancelar" onclick="window.close();"></td>
  </tr>
</table>
</form>
</body>
</html>