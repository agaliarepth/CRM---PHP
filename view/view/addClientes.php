 <?php require_once("head.php");?>
 <div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
             <?php if(isset($_GET["e"])&&$_GET["e"]=="ec"){?>

            <h2 id="contact">PROVEEDORES > EDITAR CLIENTE </h2>
            <div>
             <form method="post"  action="" name="form" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <td>
	<label>Nombres</label>
    <input type="text" name="nombres" id="nombres" value="<?php echo $res["nombres"];?>" />
	</td>
    <td>
	<label>Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" value="<?php echo $res["apellidos"];?>" />
	</td>
    <td>
	<label>Esposo(a)</label>
    <input type="text" size="45" name="esposo" id="esposo" value="<?php echo $res["esposo"];?>" />
	</td>
	</tr>
		
		
        <tr>
			<td>
	<label>Pais </label>
    <input type="text" name="origen" id="origen"  value="<?php echo $res["origen"];?>"/>
	</td>
    <td>
	<label> Ciudad</label>
    <input type="text" name="ciudad" id="ciudad"  value="<?php echo $res["ciudad"];?>"/>
	</td>
    <td>
	<label>Localidad</label>
    <input type="text" name="localidad" id="localidad" / value="<?php echo $res["localidad"];?>">
	</td>
		</tr>
        <tr>
        <td>
	<label>Empresa</label>
    <input type="text" name="empresa" id="empresa" value="<?php echo $res["empresa"];?>" />
	</td>
    <td>
	<label>Telefono</label>
    <input type="text" name="telefono" id="telefono"  value="<?php echo $res["telefono"];?>"/>
	</td>
			<td>
	<label>Fax</label>
    <input type="text" name="fax" id="fax" value="<?php echo $res["fax"];?>" />
	</td>
    <td>
	<label>Celular</label>
    <input type="text" name="celular" id="celular"  value="<?php echo $res["celular"];?>"/>
	</td>
    <td>
	<label>Ruc/Nit:</label>
    <input type="text" name="nitruc" id="nitruc" value="<?php echo $res["nitruc"];?>" />
	</td>
		</tr>
        <tr>
			
    <td colspan="2">
	<label>Email</label>
    <input name="email" type="text" id="email" size="45"  value="<?php echo $res["email"];?>"/>
	</td>
    <td colspan="2">
	<label>Direccion</label>
    <input type="text" name="direccion" id="direccion" size="45"  value="<?php echo $res["direccion"];?>"/>
	</td>
    <td>
	
	</td>
		</tr>
        
       </table>
       </fieldset>
       
       <fieldset><legend>DATOS DE CREDITO</legend>
       <table>
       <TR>
       <TD><label>DIAS DE GRACIA</label> <input type="text" name="gracia" size="5" value="<?php echo $res["gracia"];?>"/></TD>
       <TD><label>CREDITO</label> <input type="text" name="credito" size="10" value="<?php echo $res["credito"];?>"/></TD>
       <TD><label>CUOTAS</label> <input type="text" name="cuotas" size="5" value="<?php echo $res["cuotas"];?>"/></TD>
       <TD><label>LETRA NUM</label> <input type="text" name="numletra" size="10"  value="<?php echo $res["numletra"];?>"/></TD>
       <TD><label>IMPORTE LETRA</label> <input type="text" name="importeletra" size="10" value="<?php echo $res["importeletra"];?>"/></TD>
       <TD><label>VENCIMIENTO</label> <input type="text" name="vencimiento"  class="fechas" id="fecha" value="<?php echo date("d-m-Y",strtotime($res["vencimiento"])); ?>"/></TD>
       </TR>
       </table>
       
       </fieldset>
       
       <table>
        
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top" colspan="3">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="idclientes" value="<?php echo $res["idclientes"];?>"/>
			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=CLIENTES';" />
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form>
<?php } else{?>

     <h2 id="contact">CLIENTES > REGISTRO CLIENTE</h2>
            <div>
           <form method="post"  action="" name="form" class="notas" >
           <fieldset><legend>DATOS DEL CLIENTE</legend>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <td>
	<label>Nombres</label>
    <input type="text" name="nombres" id="nombres" />
	</td>
    <td>
	<label>Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" />
	</td>
    <td colspan="2">
	<label>Esposo(a)</label>
    <input type="text" size="45" name="esposo" id="esposo" />
	</td>
	</tr>
		
		
        <tr>
			<td>
	<label>Pais</label>
    <input type="text" name="origen" id="origen" />
	</td>
    	<td>
	<label>Ciudad</label>
    <input type="text" name="ciudad" id="ciudad" />
	</td>
    <td>
	<label>Localidad</label>
    <input type="text" name="localidad" id="localidad" />
	</td>
    
		</tr>
        <tr>
        <td>
	<label>Empresa</label>
    <input type="text" name="empresa" id="empresa" />
	</td>
    <td>
	<label>Telefono</label>
    <input type="text" name="telefono" id="telefono" />
	</td>
			<td>
	<label>Fax</label>
    <input type="text" name="fax" id="fax" />
	</td>
    <td>
	<label>Celular</label>
    <input type="text" name="celular" id="celular" />
	</td>
    <td>
	<label>Ruc/Nit:</label>
    <input type="text" name="nitruc" id="nitruc" />
	</td>
		</tr>
        <tr>
			
    <td colspan="2">
	<label>Email</label>
    <input name="email" type="text" id="email" size="45" />
	</td>
    <td colspan="2">
	<label>Direccion</label>
    <input type="text" name="direccion" id="direccion" size="45" />
	</td>
    <td>
	
	</td>
		</tr>
        
       </table>
       </fieldset>
       
       <fieldset><legend>DATOS DE CREDITO</legend>
       <table>
       <TR>
       <TD><label>DIAS DE GRACIA</label> <input type="text" name="gracia" size="5"/></TD>
       <TD><label>CREDITO</label> <input type="text" name="credito" size="10"/></TD>
       <TD><label>CUOTAS</label> <input type="text" name="cuotas" size="5"/></TD>
       <TD><label>LETRA NUM</label> <input type="text" name="numletra" size="10"/></TD>
       <TD><label>IMPORTE LETRA</label> <input type="text" name="importeletra" size="10"/></TD>
       <TD><label>VENCIMIENTO</label> <input type="text" name="vencimiento"  class="fechas" id="fecha" value="<?php echo date("d-m-Y")?>"/></TD>
       </TR>
       </table>
       
       </fieldset>
              <table>
        
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top" colspan="3">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="id" value="enviar"/>
			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=clientes';" />
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