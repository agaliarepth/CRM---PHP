<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
             <?php if(isset($_GET["e"])&& $_GET["e"]=="editar"){?>
            <h2 id="contact">ROL DE USUARIOS > EDITAR ROL DE USUARIO</h2>
            <div>
 <form method="post"  action="" name="form" id="addPerfil" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <th valign="top">Descipcion :</th>
			<td><input type="text" class="inp-form" id="descrip"  name="descrip" value="<?php echo $res["descrip"]?>"/></td></tr>
            
            <tr>
        <fieldset  ><legend align="center">
            Modulo Administracion</legend>
             <input type="checkbox" name="modulo_administracion" <?php if($res["modulo_administracion"]==1){?>checked="checked"<?php }?>B value="1"><b > modulo Administracion</b>
            </fieldset>
			
		</tr>
		<tr>
			<fieldset  ><legend align="center">
            Modulo Catalogo</legend>
          <input type="checkbox" name="modulo_catalogo" value="1"  ><b > modulo Catalogo</b>
            </fieldset>
		</tr>
        <tr>
			<fieldset  ><legend align="center">
            Modulo Almacenes</legend>
             <input type="checkbox" name="modulo_almacenes" <?php if($res["modulo_almacenes"]==1){?>checked="checked"<?php }?> value="1"><b > modulo Almacenes</b>
            </fieldset>
			
		</tr>
        <tr>
			<fieldset  ><legend align="center">
            Modulo Proveedores</legend>
             <input type="checkbox" name="modulo_proveedores" <?php if($res["modulo_proveedores"]==1){?>checked="checked"<?php }?>value="1" ><b > modulo Proveedores</b>
            </fieldset>
			
		</tr>
        <tr>
        <fieldset  ><legend align="center">
            Modulo Compras</legend>
             <input type="checkbox" name="modulo_compras" <?php if($res["modulo_compras"]==1){?>checked="checked"<?php }?>value="1"><b > modulo Compras</b>
            </fieldset>
			
		</tr>
        
		
         <tr>
        <fieldset  ><legend align="center">
            Modulo Ventas</legend>
             <input type="checkbox" name="modulo_ventas" <?php if($res["modulo_ventas"]==1){?>checked="checked"<?php }?>value="1"><b > modulo Ventas</b>
            </fieldset>
			
		</tr>
         <tr>
        <fieldset  ><legend align="center">
            Modulo Clientes</legend>
             <input type="checkbox" name="modulo_clientes" <?php if($res["modulo_clientes"]==1){?>checked="checked"<?php }?>value="1"><b > modulo Clientes</b>
            </fieldset>
			
		</tr>
        <tr>
        <fieldset  ><legend align="center">
            Modulo Cobranzas</legend>
             <input type="checkbox" name="modulo_cobranzas" <?php if($res["modulo_cobranzas"]==1){?>checked="checked"<?php }?> value="1"><b > modulo Cobranzas</b>
            </fieldset>
			
		</tr>
        <tr>
        <fieldset  ><legend align="center">
            Modulo Reportes</legend>
             <input type="checkbox" name="modulo_reportes" <?php if($res["modulo_reportes"]==1){?>checked="checked"<?php }?>value="1"><b > modulo Reportes</b>
            </fieldset>
			
		</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar"  name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="idperfiles" value="<?php echo $res["idperfiles"]?>"/>
			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=roles';" />
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form>           
<?php } else{?>

            <h2 id="contact">ROL DE USUARIOS > REGISTRAR ROL DE USUARIO</h2>
            <div>
 <form method="post"  action="" name="form" id="addPerfil" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <th valign="top">Descipcion :</th>
			<td><input type="text" class="inp-form" id="descrip" name="descrip" value=""/></td></tr>
            
            <tr>
        <fieldset  ><legend align="center">
            Modulo Administracion</legend>
             <input type="checkbox" name="modulo_administracion" value="1"><b > modulo Administracion</b>
            </fieldset>
			
		</tr>
		<tr>
			<fieldset  ><legend align="center">
            Modulo Catalogo</legend>
          <input type="checkbox" name="modulo_catalogo" value="1"  ><b > modulo Catalogo</b>
            </fieldset>
		</tr>
        <tr>
			<fieldset  ><legend align="center">
            Modulo Almacenes</legend>
             <input type="checkbox" name="modulo_almacenes" value="1"><b > modulo Almacenes</b>
            </fieldset>
			
		</tr>
        <tr>
			<fieldset  ><legend align="center">
            Modulo Proveedores</legend>
             <input type="checkbox" name="modulo_proveedores" value="1" ><b > modulo Proveedores</b>
            </fieldset>
			
		</tr>
        <tr>
        <fieldset  ><legend align="center">
            Modulo Compras</legend>
             <input type="checkbox" name="modulo_compras" value="1"><b > modulo Compras</b>
            </fieldset>
			
		</tr>
        
		
         <tr>
        <fieldset  ><legend align="center">
            Modulo Ventas</legend>
             <input type="checkbox" name="modulo_ventas" value="1"><b > modulo Ventas</b>
            </fieldset>
			
		</tr>
         <tr>
        <fieldset  ><legend align="center">
            Modulo Clientes</legend>
             <input type="checkbox" name="modulo_clientes" value="1"><b > modulo Clientes</b>
            </fieldset>
			
		</tr>
        <tr>
        <fieldset  ><legend align="center">
            Modulo Cobranzas</legend>
             <input type="checkbox" name="modulo_cobranzas" value="1"><b > modulo Cobranzas</b>
            </fieldset>
			
		</tr>
        <tr>
        <fieldset  ><legend align="center">
            Modulo Reportes</legend>
             <input type="checkbox" name="modulo_reportes" value="1"><b > modulo Reportes</b>
            </fieldset>
			
		</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar"  name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="enviar" value="enviar"/>
			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=roles';" />
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
        
    </div>
<?php require_once("footer.php");?>