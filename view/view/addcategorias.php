<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
           <?php if(isset($_GET["e"])&& $_GET["e"]=="ec"){?>
            
            <h2 id="contact">CATEGORIAS > EDITAR CATEGORIA > <?php echo $res["descripcion"];?></h2>
            <div>
          <form method="post"  action="" name="form" id="addCategorias" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Descripcion : </th>
			<td><input type="text" class="inp-form" id="descripcion" name="descripcion" value="<?php echo $res["descripcion"];?>"/>
            </td>
			
		</tr>
        <tr>
			<th valign="top">Codigo :</th>
			<td><input type="text" class="inp-form" id="codigo" name="codigo" value="<?php echo $res["codigo"];?>"/>
            </td>
			
		</tr>
		
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="button" id="cancelar" value="Cancelar" name="Cancelar" />
            <input type="hidden" name="editar" value="editar"/>
            <input type="hidden" name="idcategorias" value="<?php echo $res["idcategorias"];?>"/>
			
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form><?php } else{ ?>

<h2 id="contact">CATEGORIAS > REGISTRO DE CATEGORIAS</h2>
            <div>
          <form method="post"  action="" name="form" id="addCategorias" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Descripcion : </th>
			<td><input type="text" class="inp-form" id="descripcion" name="descripcion" value=""/>
            </td>
			
		</tr>
        <tr>
			<th valign="top">Codigo :</th>
			<td><input type="text" class="inp-form" id="codigo" name="codigo" value=""/>
            </td>
			
		</tr>
		
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
        
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="button" id="cancelar" value="Cancelar" name="Cancelar" />
            <input type="hidden" name="id" value="enviar"/>
			
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