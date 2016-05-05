 <?php require_once("head.php");?>
 <div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
             <?php if(isset($_GET["e"])&&$_GET["e"]=="ep"){?>

            <h2 id="contact">PROVEEDORES > EDITAR PROVEEDOR > <?php echo $res["nombre"];?></h2>
            <div>
           <form method="post"  action="" name="form" id="addEditoriales" enctype="multipart/form-data"  class="notas">
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <td>
	<label>Nombre:</label>
    <input type="text" name="nombre" id="nombre"b  value=" <?php echo $res["nombre"];?>" />
	</td>
    <td>
	<label>Contacto:</label>
    <input type="text" name="contacto" id="contacto"  value=" <?php echo $res["contacto"];?>" />
	</td>
    <td>
	<label>Direccion:</label>
    <input type="text" name="direccion" id="direccion"  value=" <?php echo $res["direccion"];?>" />
	</td>
	</tr>
		
		
        <tr>
			<td>
	<label>Pais:</label>
    <input type="text" name="pais" id="pais"  value=" <?php echo $res["pais"];?>"/>
	</td>
    <td>
	<label>Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad"  value=" <?php echo $res["ciudad"];?>" />
	</td>
    <td>
	<label>Email:</label>
    <input type="text" name="email" id="email"   value=" <?php echo $res["email"];?>"/>
	</td>
		</tr>
        <tr>
			<td>
	<label>Telefono 1:</label>
    <input type="text" name="telf1" id="telf1"  value=" <?php echo $res["telf1"];?>"/>
	</td>
    <td>
	<label>Telefono 2:</label>
    <input type="text" name="telf2" id="telf2"  value=" <?php echo $res["telf2"];?>" />
	</td>
    <td>
	<label>Telefono 3:</label>
    <input type="text" name="telf3" id="telf3"  value=" <?php echo $res["telf3"];?>"/>
	</td>
		</tr>
        <tr>
			
    <td>
	<label>RUC/NIT:</label>
    <input type="text" name="rucnit" id="rucnit"  value=" <?php echo $res["rucnit"];?>" />
	</td>
    <td>
	<label>Banco:</label>
    <input type="text" name="banco" id="banco"  value=" <?php echo $res["banco"];?>" />
	</td>
    <td>
	<label>Num Cuenta:</label>
    <input type="text" name="numcuenta" id="numcuenta"  value=" <?php echo $res["numcuenta"];?>"/>
	</td>
		</tr>
         <tr>
			
    <td>
	<label>Tiempo de Gracia:</label>
    <input type="text" name="tiempogracia" id="tiempogracia"  value=" <?php echo $res["tiempogracia"];?>"/>
	</td>
    <td>
	<label>Condiciones:</label>
    <input type="text" name="condiciones" id="condiciones"  value=" <?php echo $res["condiciones"];?>"/>
	</td>
   
		</tr>
       
        
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
            <input type="hidden" name="idproveedores"  value=" <?php echo $res["idproveedores"];?>"/>
			<input type="button" value="Cancelar" name="Cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=proveedores';"  id="cancelar"/>
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form>
<?php } else{?>

     <h2 id="contact">PROVEEDORES > REGISTRO PROVEEDOR</h2>
            <div>
           <form method="post"  action="" name="form" id="addEditoriales" enctype="multipart/form-data" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <td>
	<label>Nombre:</label>
    <input type="text" name="nombre" id="nombre" />
	</td>
    <td>
	<label>Contacto:</label>
    <input type="text" name="contacto" id="contacto" />
	</td>
    <td>
	<label>Direccion:</label>
    <input type="text" name="direccion" id="direccion" />
	</td>
	</tr>
		
		
        <tr>
			<td>
	<label>Pais:</label>
    <input type="text" name="pais" id="pais" />
	</td>
    <td>
	<label>Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad" />
	</td>
    <td>
	<label>Email:</label>
    <input type="text" name="email" id="email" />
	</td>
		</tr>
        <tr>
			<td>
	<label>Telefono 1:</label>
    <input type="text" name="telf1" id="telf1" />
	</td>
    <td>
	<label>Telefono 2:</label>
    <input type="text" name="telf2" id="telf2" />
	</td>
    <td>
	<label>Telefono 3:</label>
    <input type="text" name="telf3" id="telf3" />
	</td>
		</tr>
        <tr>
			
    <td>
	<label>RUC/NIT:</label>
    <input type="text" name="rucnit" id="rucnit" />
	</td>
    <td>
	<label>Banco:</label>
    <input type="text" name="banco" id="banco" />
	</td>
    <td>
	<label>Num Cuenta:</label>
    <input type="text" name="numcuenta" id="numcuenta" />
	</td>
		</tr>
         <tr>
			
    <td>
	<label>Tiempo de Gracia:</label>
    <input type="text" name="tiempogracia" id="tiempogracia" />
	</td>
    <td>
	<label>Condiciones:</label>
    <input type="text" name="condiciones" id="condiciones" />
	</td>
   
		</tr>
       
        
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="id" value="enviar"/>
			<input type="button" value="Cancelar" class="form-reset"  onclick="javascript:window.location='<?php config::ruta()?>?accion=proveedores';" id="cancelar"/>
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form>
<?php }?>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div> <!-- END #main_content -->
    
    
        <?php require_once("footer.php");?>