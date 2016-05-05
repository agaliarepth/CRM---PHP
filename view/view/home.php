<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">INICIO</h2>
            <div>
           BIENVENIDOS .... VISUAL EDICIONES
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                <form method="post"   class="notas"  action="" name="form" id="addUsuario"  >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        
     
		
		<tr>
		<th valign="top">Nombres Apellidos:</th>
			<td><input type="text" class="inp-form" id="nombres" name="nombres" value="<?php echo $res["nombres"];?>" />
        
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Username:	</th>
            
			<td><input type="text" class="inp-form" id="username" name="username" value="<?php echo $res["username"];?>"/>
            
           
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Contraseña :</th>
			<td><input type="text" class="inp-form" id="password" name="password" value="<?php echo $res["password"];?>"/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Cargo Desempeña:</th>
			<td><input type="text" class="inp-form" id="cargo" name="cargo" value="<?php echo $res["cargo"];?>"/> 
           
          </td>
			<td></td>
		</tr>
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="idusuarios" value="<?php echo $res["idusuarios"];?>"/>
                          <input type="hidden" name="idperfiles" value="<?php echo $res["perfiles_idperfiles"];?>"/>

			<input type="button" value="Cancelar"  id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=home';" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>            
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>