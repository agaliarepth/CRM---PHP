<?php require_once("head.php");?>

 

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
      
			
		<input  type="text" id="cliente" name="cliente" size="55" value="<?php echo $res["cliente"]?>"/>
		</td>
        <td><label>MONTO</label>
      
			
		<input  type="text" id="monto" name="monto" size="10" value="<?php echo $res["monto"]; ?>"/>
		</td>
        <td><label>DESCRIPCION</label>
      
			
		<input  type="text" id="descripcion" name="descripcion" size="50" value="<?php echo $res["descripcion"]; ?>" />
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fecha"])); ?>"/></td>
        <td><label>NOTA DE INGRESO </label><input type="text" id="notaingreso" name="notaingreso" value="<?php echo $res["notaingreso"]; ?>"/></td>
      <td >
               <label>MONEDA</label>

       <select  name="moneda">
       <option value="Bs">Bolivianos</option>
       <option value="Sus">Dolares</option>
       
       </select>
       
       </td>
       
       
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
			<input type="submit" id="bEnviar" value="Guardar " name="bEnviar"  />
<!--           <input type="button" id="bVender" value="Vender" name="bEnviar" onclick="validarVender();" />
-->
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=devolucionDeudas';"/>
                 <input type="hidden" name="editar" id="editar" value="editar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />


               <input type="hidden" name="iddeudas" id="iddeudas" value="<?php echo $res["deudas_iddeudas"];?>" />
                              <input type="hidden" name="iddevolucionDeuda"  value="<?php echo $res["iddevolucion_deudas"];?>" />

</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
          
            </div>
        
            <?php } else {?>
            
             <h2 id="contact">ADMINISTRACION > REGISTRAR DEVOLUCION  DEUDA</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset >
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input  type="text" id="cliente" name="cliente" size="55" value="<?php echo $res["nombre_cliente"]?>"/>
		</td>
        <td><label>MONTO</label>
      
			
		<input  type="text" id="monto" name="monto" size="10" value=""/>
		</td>
        <td><label>DESCRIPCION</label>
      
			
		<input  type="text" id="descripcion" name="descripcion" size="50" />
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y");?>"/></td>
        <td><label>NOTA DE INGRESO </label><input type="text" id="notaingreso" name="notaingreso" value=""/></td>
      <td >
               <label>MONEDA</label>

       <select  name="moneda">
       <option value="Bs">Bolivianos</option>
       <option value="Sus">Dolares</option>
       
       </select>
       
       </td>
       
       
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
			<input type="submit" id="bEnviar" value="Guardar " name="bEnviar"  />
<!--           <input type="button" id="bVender" value="Vender" name="bEnviar" onclick="validarVender();" />
-->
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=devolucionDeudas';"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />


               <input type="hidden" name="iddeudas" id="iddeudas" value="<?php echo $res["iddeudas"];?>" />
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
    <script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
		});
            
	</script>
<?php require_once("footer.php");?>