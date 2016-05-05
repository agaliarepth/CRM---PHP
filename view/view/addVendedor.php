<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
           <?php if(isset($_GET["e"])&& $_GET["e"]=="editar"){?>
            
            <h2 id="contact">ADMINISTRACION > VENDEDORES > EDITAR VENDEDOR </h2>
            <div>
          <form method="post"  action="" name="form" id="addCategorias" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">NOMBRES: </th>
			<td><input type="text"  size="50"class="inp-form" id="nombres" name="nombres" style="text-transform:uppercase;" value="<?php echo $res["nombres"];?>"/>
            </td>
			
		</tr>
      
        
		
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="button" id="cancelar" value="Cancelar" name="Cancelar" />
            <input type="hidden" name="editar" value="editar"/>
            <input type="hidden" name="idvendedor" value="<?php echo $res["idvendedores"];?>"/>
			
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form><?php } else{ ?>

<h2 id="contact">ADMINISTRACION > VENDEDORES > REGISTRO DE VENDEDORES</h2>
            <div>
          <form method="post"  action="" name="form" id="addCategorias" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">NOMBRES: </th>
			<td><input type="text"  size="50"class="inp-form" id="nombres" name="nombres" style="text-transform:uppercase;"/>
            </td>
			
		</tr>
       
		
		
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
        
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
<input type="button" id="cancelar" value="Cancelar"  name="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=vendedores';"/>            <input type="hidden" name="enviar" value="enviar"/>
			
		</td>
		<td></td>
	</tr>
	</table>


<?php }?>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>