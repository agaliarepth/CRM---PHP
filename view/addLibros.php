<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
             <?php
		  if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="el"){
?>
            <h2 id="contact">LIBROS > EDITAR LIBRO > <?php echo $res["codigo"]." - ".$res["titulo"]?></h2>
            <div>
         
<form method="post"   class="contacto"  action="" name="form" id="addLibros" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Categoria :</th>
		<td>	
		<select  name="categorias_idcategorias" id="categorias_idcategorias">
        <?php foreach($res2 as $row){?>
			  <option value="<?php echo $row["idcategorias"];?>" <?php if($res["categorias_idcategorias"]==$row["idcategorias"]) {?> selected="selected"<?php }?>> <?php echo "[".$row["codigo"]."]-".$row["descripcion"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
         <tr>
		<th valign="top">Proveedor:</th>
		<td>	
		<select  name="proveedores_idproveedores" id="proveedores_idproveedores">
        <?php foreach($res3 as $row){?>
			  <option value="<?php echo $row["idproveedores"];?>" <?php if($res["proveedores_idproveedores"]==$row["idproveedores"]) {?> selected="selected"<?php }?>> <?php echo $row["nombre"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
        <tr>
	<th>Foto :</th>
	<td><input type="file" class="file_1" name="logo" id="logo" /></td>
	<td>
	
	</td>
	</tr>
		
		<tr>
		<div><th valign="top">Codigo :</th>
			<td><input  size="10"name="codigo" type="text" class="inp-form" id="codigo" value="<?php echo $res["codigo"];?>" />
            
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Titulo :	</th>
            
			<td><input name="titulo" type="text" class="inp-form" id="titulo" value="<?php echo $res["titulo"];?>" size="50"/>
            
			<td></td>
		</tr>
        <tr>
			<th valign="top">Volumen :</th>
			<td><input  size="5" type="text" class="inp-form" id="tomo" name="tomo" value="<?php echo $res["tomo"];?>"/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio Venta:</th>
			<td><input   size="5" type="text"  id="pv" name="pv" value="<?php echo $res["pv"];?>"/>
           
           </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio Sucursal:</th>
			<td><input size="5" type="text"  id="ps" name="ps" value="<?php echo $res["ps"];?>"/>
           
           </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio CIF:</th>
			<td><input size="5" type="text"  id="cif" name="cif" value="<?php echo $res["cif"];?>"/>
            </td>
			<td></td>
		</tr>
       
         <tr>
			<th valign="top">Stock Minimo :</th>
			<td><input size="5" type="text" class="inp-form" id="stock_minimo" name="stock_minimo" value="<?php echo $res["stock_minimo"];?>"/>
           
            </td>
			<td></td>
		</tr>
         <tr>
			<th valign="top">Stock  :</th>
			<td><input size="5"   readonly="readonly" type="text" class="inp-form" id="stock" name="stock" value="<?php echo $c->getStock($_GET["id"]);?>"/>
           
            </td>
			<td></td>
		</tr>
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="idlibros" value="<?php echo $res["idlibros"];?>"/>
			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=libros';" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>
<?php 
		  }
		  
		  else{
		  
		  if (count($res) == 0 || count($res2) == 0) {
   ?>
  
   <p>No Existen Categorias o Proveedores  Registrados.. <a href="<?php config::ruta()?>?accion=addCategorias">Ingrese nueva Categoria</a>.</p><p><a href="<?php config::ruta()?>?accion=addProveedores">Ingrese nuevo Proveedor</a></p>
   <?php 
} else { ?>
 <h2 id="contact">LIBROS > REGISTRAR LIBRO</h2>
            <div>
<form method="post"   class="notas"  action="" name="form" id="addLibros" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
		<th valign="top">Categoria :</th>
		<td>	
		<select  name="categorias_idcategorias" id="categorias_idcategorias">
        <?php foreach($res as $row){?>
			  <option value="<?php echo $row["idcategorias"];?>"> <?php echo "[".$row["codigo"]."]-".$row["descripcion"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
         <tr>
		<th valign="top">Proveedor:</th>
		<td>	
		<select  name="proveedores_idproveedores" id="proveedores_idproveedores">
        <?php foreach($res2 as $row){?>
			  <option value="<?php echo $row["idproveedores"];?>"> <?php echo $row["nombre"];?></option><?php }?>
			
		</select>
		</td>
		<td></td>
		</tr> 
        <tr>
	<th>Foto :</th>
	<td><input type="file" class="file_1" name="logo" id="logo" /></td>
	<td>
	
	</td>
	</tr>
		
		<tr>
		<div><th valign="top">Codigo :</th>
			<td><input size="10"type="text" class="inp-form" id="codigo" name="codigo" value="" />
            
            </td>
			<td></td>
		</tr>
        <tr>
			<div><th valign="top">Titulo :	</th>
            
			<td><input type="text" class="inp-form" id="titulo" name="titulo" size="50" value=""/>
            
			<td></td>
		</tr>
        <tr>
			<th valign="top"> Volumen :</th>
			<td><input  size="5"type="text" class="inp-form" id="tomo" name="tomo" value=""/>
          
            </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio Venta:</th>
			<td><input size="5"type="text"  id="pv" name="pv" value=""/>
           
           </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio Sucursal:</th>
			<td><input size="5"type="text"  id="ps" name="ps" value=""/>
           
           </td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">Precio CIF:</th>
			<td><input size="5"type="text"  id="cif" name="cif" value=""/>
            </td>
			<td></td>
		</tr>
       
         <tr>
			<th valign="top">Stock Minimo :</th>
			<td><input type="text" class="inp-form" id="stock_minimo" size="5"name="stock_minimo" value=""/>
           
            </td>
			<td></td>
		</tr>
        
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="id" value="enviar"/>
			<input type="button" value="Cancelar"  id="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=libros';" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>
<?php }
		  
		  
		  
		  }?>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>