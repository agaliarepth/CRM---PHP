<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
        <h2 id="contact">LIBROS > EDITAR LIBRO > <?php echo $res["codigo"]." - ".$res["titulo"]?></h2>
            <div>
         
<form method="post"   class="contacto"  action="" name="form" id="addLibros" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                 
        <tr>
	<th>Foto :</th>
	<td><input type="file" class="file_1" name="logo" id="logo" /></td>
	<td>
	
	</td>
	</tr>
		
		
       
        <tr>
			<th valign="top">Precio Venta:</th>
			<td><input   size="5" type="text"  id="pv" name="pv" value="<?php echo $res["pv"];?>"/>
           
           </td>
			<td></td>
		</tr>
       
        
     
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="idlibros" value="<?php echo $res["idlibros"];?>"/>
			<input type="button" value="Cancelar"   id="cancelar" onclick="javascript:window.location='<?php echo config::ruta();?>?accion=librosVentas';" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>

		  
		  
		  
		
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>