 <?php require_once("head.php");?>
 <script type="text/javascript">
$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#clientes").autocomplete({
				source: "ajax/buscarCliente.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: clienteSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.nombres + " / " + item.empresa + "</a>" )
    .appendTo( ul );
};
		});
		
		
		function clienteSeleccionado(event, ui)
		{
			
			$( "#clientes" ).val( ui.item.nombres );
			$( "#idclientes" ).val( ui.item.idclientes );
			
			return false;
			
		}


</script>
 <div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
             <?php if(isset($_GET["e"])&&$_GET["e"]=="editar"){?>

        <h2 id="contact">ADMINISTRACION > EDITAR REGISTRO DE DEUDAS</h2>
            <div>
           <form method="post"  action="" name="form" id="addDeudas" enctype="multipart/form-data" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <td colspan="2">
	<label>Cliente:</label>
    <input type="text"   size="50"name="cliente" id="clientes"  value="<?php echo $res["nombre_cliente"]?>" />
	</td>
    <td>
    <label>Vendedor:</label>
    <select name="idvendedor">

<?php foreach($listaVendedores as $v){?>
<option  <?php if ($res["idvendedores"]==$v["idvendedores"]){?> selected="selected"<?php }?>value="<?php echo $v["idvendedores"]?>"><?php echo $v["nombres"] ?></option>
<?php }?>
</select>
</td>
    <td>
	<label>Fecha Compra:</label>
    <input type="text" name="fecha" id="fecha" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fecha"])); ?>" />
	</td>
    <td>
	<label>Fecha Vencimiento:</label>
    <input type="text" name="fechavencimiento" id="fecha2" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fechavencimiento"]));?>" />
	</td>
    <td colspan="2">
	<label>Descripcion:</label>
    <input type="text" name="descripcion" size="50" id="descripcion" value="<?php echo $res["descripcion"];?>"/>
	</td>
    </tr>
    <tr>
    <td>
	<label>Dias Credito:</label>
    <input type="text" name="dias_credito" size="20" id="dias_credito" value="<?php echo $res["dias_credito"];?>" />
	</td>
    <td>
	<label>Numero de cuotas:</label>
    <input type="text" name="numcuotas" size="20" id="numcuotas" value="<?php echo $res["numcuotas"];?>" />
	</td>
    <td>
	<label>Monto  Total Deuda:</label>
    <input type="text" name="saldo_inicial" size="20" id="saldo_inicial" value="<?php echo $res["saldo_inicial"];?>" />
	</td>
    <td>
	<label>Saldo Inicial:</label>
    <input type="text" name="saldo"  value="<?php echo $res["saldo"];?>" />
	</td>
    <td>
	<label>Saldo Actual:</label>
    <input type="text" name="saldo_actual" id="saldo_actual" value="<?php echo $res["saldo_actual"];?>"/>
	</td>
     <td>
	<label>Importe de Comision:</label>
    <input type="text"  size="10"name="comision" id="comision" value="<?php echo $res["comision"];?> "/>
	</td>
    <td>
	<label>Moneda:</label>
  <select name="moneda">
  <option <?php if($res["moneda"]=="Bs"){?> selected="selected"<?php }?>value="Bs">Bolivianos</option>
  <option <?php if($res["moneda"]=="Sus"){?> selected="selected"<?php }?>value="Sus">Dolares</option>
 
  </select>
	</td>
    
	</tr>
		
		
       
       
        
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="editar" value="editar"/>
            <input type="hidden" name="idclientes" id="idclientes" value="<?php echo $res["clientes_idclientes"];?>" />
             <input type="hidden" name="iddeudas" id="iddeudas"  value="<?php echo $res["iddeudas"];?>"/>
			<input type="button" value="Cancelar" class="form-reset"  onclick="javascript:window.location='<?php config::ruta()?>?accion=deudas';" id="cancelar"/>
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->
</form>
<?php } else{?>

     <h2 id="contact">ADMINISTRACION > REGISTRO DE  DEUDAS</h2>
            <div>
           <form method="post"  action="" name="form" id="addDeudas" enctype="multipart/form-data" class="notas" >
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        <tr>
        <td colspan="2">
	<label>Cliente:</label>
    <input type="text"   size="50"name="cliente" id="clientes" />
	</td>
      <td>
    <label>Vendedor:</label>
    <select name="idvendedor">

<?php foreach($listaVendedores as $v){?>
<option value="<?php echo $v["idvendedores"]?>"><?php echo $v["nombres"] ?></option>
<?php }?>
</select>
</td>
    <td>
	<label>Fecha Compra:</label>
    <input type="text" name="fecha" id="fecha" class="fechas" value="<?php echo date("d-m-Y");?>" />
	</td>
      <td>
	<label>Fecha Vencimiento:</label>
    <input type="text" name="fechavencimiento" id="fecha2" class="fechas" value="<?php echo date("d-m-Y");?>" />
	</td>
    <td colspan="2">
	<label>Descripcion:</label>
    <input type="text" name="descripcion" size="50" id="descripcion" />
	</td>
    </tr>
    <tr>
    <td>
	<label>Dias Credito:</label>
    <input type="text" name="dias_credito" size="20" id="dias_credito"  />
	</td>
    <td>
	<label>Numero de cuotas:</label>
    <input type="text" name="numcuotas" size="20" id="numcuotas"  />
	</td>
    <td>
	<label>Monto  Total Deuda:</label>
    <input type="text" name="saldo_inicial" size="20" id="saldo_inicial" />
	</td>
    <td>
	<label>Saldo Inicial:</label>
    <input type="text" name="saldo"  />
	</td>
    <td>
	<label>Saldo Actual:</label>
    <input type="text" name="saldo_actual" id="descripcion" />
	</td>
     <td>
	<label>Importe de Comision:</label>
    <input type="text" size="10" name="comision" id="comision" />
	</td>
    <td>
	<label>Moneda:</label>
  <select name="moneda">
  <option value="Bs">Bolivianos</option>
  <option value="Sus">Dolares</option>
 
  </select>
	</td>
    
	</tr>
		
		
       
       
        
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
            <input type="hidden" name="enviar" value="enviar"/>
            <input type="hidden" name="idclientes" id="idclientes" />
			<input type="button" value="Cancelar" class="form-reset"  onclick="javascript:window.location='<?php config::ruta()?>?accion=deudas';" id="cancelar"/>
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