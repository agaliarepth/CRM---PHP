<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            <?php if(isset($_GET["e"])&&isset($_GET["id"])&& $_GET["e"]=="eu"){?>
             <h2 id="contact">ADMINISTRACION > EDITAR USUARIO </h2>
            <div>
<form method="post"   class="notas"  action="" name="form" id="addUsuario"  >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Roles de Usuario:</th>
		<td>	
		<select class="styledselect_form_1" name="perfiles_idperfiles">
        <?php foreach($res2 as $row){?>
			  <option  <?php if ($res["perfiles_idperfiles"]==$row["idperfiles"]){?> selected="selected"<?php }?>value="<?php echo $row["idperfiles"];?>"> <?php echo $row["descrip"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
     
		
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
			<input type="button" value="Cancelar"  id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=usuarios';" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>            </div>
            
            <?php } else{?>
            
              <h2 id="contact">ADMINISTRACION > REGISTRAR NUEVO USUARIO </h2>
            <div>
<form method="post"   class="notas"  action="" name="form" id="addUsuario"  >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Roles de Usuario:</th>
		<td>	
		<select class="styledselect_form_1" name="perfiles_idperfiles">
        <?php foreach($res as $row){?>
			  <option value="<?php echo $row["idperfiles"];?>"> <?php echo $row["descrip"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
     
		
		<tr>
		<div><th valign="top">Nombres Apellidos:</th>
			<td><input type="text" class="inp-form" id="nombres" name="nombres" value="" /><?php echo @$e[3] ?>
              </div>
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Username:	</th>
            
			<td><input type="text" class="inp-form" id="username" name="username" value=""/><?php echo @$e[1] ?>
            
            </div>
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Contraseña :</th>
			<td><input type="text" class="inp-form" id="password" name="password" value=""/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Cargo Desempeña:</th>
			<td><input type="text" class="inp-form" id="cargo" name="cargo" value=""/> <?php echo @$e[2] ?> 
           
          </div></td>
			<td></td>
		</tr>
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="enviar" value="enviar"/>
			<input type="button" value="Cancelar"  id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=usuarios';" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>            </div><?php }?>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>