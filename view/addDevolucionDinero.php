<?php require_once("head.php");?>
<script type="text/javascript">

	
	
	
	
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombrecliente").autocomplete({
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
			
			$( "#nombrecliente" ).val( ui.item.nombres );
			
			$( "#idcliente" ).val( ui.item.idclientes );
			return false;
			
		}
		function validarMonto(valor){
		    var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test(valor);
	 
	 if(resultado!=false)
		 
		 return true;
		 
		 else
		 return false;
	 
	 }
	 
	 
	  function validarFormulario(){
		  if($("#idcliente").val()==""||$("#idcliente").val()==0 ){
			  alert("ERROR:: NO EXISTE UN CLIENTE  A ESTA DEVOLUCION");
			  return;
			  }
			  else
			  {
				  if(confirm("SE GUARDARA LA DEVOLUCION ?"))
				  document.form.submit();
				  else
				  return;
				  }
		  
		  }
	  
		 $(document).ready(function() {
			  
			 $( "#monto" ).change(function(){
				if(!validarMonto($(this).val()))
				{
					alert("ERROR:: EL MONTO NO ES CORRECTO");
					
					$( "#monto" ).value(0);
					}
				 
				 });
			 });
			 
			 
		
		</script>
 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            <?php if (isset($_GET["e"])&&$_GET["e"]=="editar"){
				
			
				?>
           <h2 id="contact">ADMINISTRACION > EDITAR DEVOLUCION DEUDA </h2>
                <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset >
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input  type="text" id="nombrecliente" name="nombrecliente"  size="50" value="<?php echo $res["nombre_cliente"] ?>"/>
        <input  type="hidden" id="idcliente" name="idcliente"  value="<?php echo $res["clientes_idclientes"] ?>"/>
		</td>
        <td><label>MONTO</label>
      
			
		<input  type="text" id="monto" name="monto" size="10" value="<?php echo $res["monto"] ?>"/>
		</td>
         <td >
               <label>MONEDA</label>

       <select  name="moneda">
       <option <?php if($res["moneda"]=="Bs"){ ?> selected="selected"<?php }?> value="Bs">Bolivianos</option>
       <option <?php if($res["moneda"]=="Sus"){ ?> selected="selected"<?php }?>value="Sus">Dolares</option>
       
       </select>
       
       </td>
       </tr>
       <tr>
        <td><label>DESCRIPCION</label>
      
			
		<input  type="text" id="descripcion" name="descripcion" size="50"  value="<?php echo $res["descripcion"] ?>"/>
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fecha"]));?>"/></td>
        <td><label>NUM RECIBO DE CAJA</label><input type="text" id="numrecibo" name="numrecibo" value="<?php echo $res["numrecibo"] ?>"/></td>
     
       
       
        </tr>
        </thead>
        </table>
        
        
	
           </fieldset>
          
           
                     
                     <table>
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
			<input type="button" id="bEnviar" value="Guardar " name="bEnviar" onclick="validarFormulario();"  />

            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=devolucionDinero';"/>
                 <input type="hidden" name="editar" id="editar" value="editar" />
                  <input type="hidden" name="iddevolucion" id="iddevolucion" value="<?php echo $res["iddevolucion_dinero"] ?>" />
               


</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
          
            </div>
        
            <?php } else {?>
            
             <h2 id="contact">ADMINISTRACION > REGISTRAR DEVOLUCION  DINERO</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset >
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input  type="text" id="nombrecliente" name="nombrecliente"  size="50" value=""/>
        <input  type="hidden" id="idcliente" name="idcliente"  value=""/>
		</td>
        <td><label>MONTO</label>
      
			
		<input  type="text" id="monto" name="monto" size="10" value=""/>
		</td>
         <td >
               <label>MONEDA</label>

       <select  name="moneda">
       <option value="Bs">Bolivianos</option>
       <option value="Sus">Dolares</option>
       
       </select>
       
       </td>
       </tr>
       <tr>
        <td><label>DESCRIPCION</label>
      
			
		<input  type="text" id="descripcion" name="descripcion" size="50" />
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y");?>"/></td>
        <td><label>NUM RECIBO DE CAJA</label><input type="text" id="numrecibo" name="numrecibo" value=""/></td>
     
       
       
        </tr>
        </thead>
        </table>
        
        
	
           </fieldset>
          
           
                     
                     <table>
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
			<input type="button" id="bEnviar" value="Guardar " name="bEnviar" onclick="validarFormulario();"  />

            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=devolucionDinero';"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
               


</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
            <?php }?>
           
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
   
<?php require_once("footer.php");?>