<?php require_once("head.php");?>


<script type="text/javascript">
		var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
   var total=0;
   var  precio_total=0;
   var array=new Array();
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		
		
			$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#codigoLabel").autocomplete({
				source: "ajax/searchProductos.php",			/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado1/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + " / " + item.titulo + "</a>" )
    .appendTo( ul );
};
		});
		
		
		function productoSeleccionado1(event, ui)
		{
			
			$( "#libro" ).val( ui.item.titulo );
			/*$( "#stock" ).val( ui.item.stock_disponible );*/
			$( "#pu" ).val( ui.item.cif );
			$( "#codigoLabel" ).val( ui.item.codigo );
			
			/*stock=parseInt(ui.item.stock_disponible);*/
			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			codigo=ui.item.codigo;
			$( "#cantidad" ).focus();
			$.ajax({
					  
                              type: "POST",
                              url: "ajax/getStockDisponible.php",
                              data: "idlibro="+ui.item.id,
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								
									 $( "#stock" ).val(data);
									  n();
									                                                
                                  
                                  
                              }
                  });
			return false;
			
		}
		
	
  $(document).ready(function($)
  {
	  	  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="ei"){

  foreach($res3 as $v){
	  	  $aux=$li->getId($v["libros_idlibros"]);

	  echo "addTableRow2($v[cantidad],'".$aux["titulo"]."','".$aux["tomo"]."',$v[precio_unitario],$v[precio_total],$v[libros_idlibros],'".$aux["codigo"]."','".$v["obs"]."');";
	  
	 
	   
    }
	
	  
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
		if(verificaPrecio()&& validarCantidad() && validarDisponible() && validarStock()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt).toFixed(2);
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo,obs)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="50px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  style="text-align:center" name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '" style="text-align:center" name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" style="text-align:right" onchange="recalcularPrecio(this);" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" style="text-align:right" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" value="'+obs+'"  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/eliminar.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$( "#codigoLabel" ).val('');
$("#pu").val('');
$("#num_filas").val(nextinput);

var tt=$("#campos tr:last").find("input").eq(0).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
Precio_total=precio_total.toFixed(2);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);

   }
   
   function addTableRow( cantidad, titulo, tomo,pu,pt,id)
   {
    campo = '<tr><td><input type="text" class="inp2-form" onchange="recalcularCantidad(this);" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td ><input type="text" style="text-align:center" class="inp2-form" readonly ="readonly" size="15" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="75" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  style="text-align:center" name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" onchange="recalcularPrecio(this);" size="10" value="'+pu+'"  style="text-align:right" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" style="text-align:right" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/eliminar.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
	if(typeof(codigo)=="undefined"){
	alert("este codigo de libro no es valido");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	alert("!!!Ya existe este Item en la Lista.");
	nextinput++;
	
	}
	else{
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$( "#codigoLabel" ).val('');
$("#stock").val('');

$("#num_filas").val(nextinput);
$("#codigoLabel").focus();
var tt=$("#campos tr:last").find("input").eq(0).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
Precio_total=precio_total.toFixed(2);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
  });
  function recalcularCantidad(c){
	 
	 if(validarCantidad($("#"+c.id))&&validarStockDisponible(c)){
	 var pu=$("#"+c.id).parent().parent().find("input").eq(4).val();
	 var pt=pu*c.value;
	 $("#"+c.id).parent().parent().find("input").eq(5).val(pt);
	 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);

	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(0).val(0);
		$("#"+c.id).parent().parent().find("input").eq(5).val(0);
		 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);

		 }
	   }
    function recalcularPrecio(c){
	   var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test(c.value);
	 if(resultado!=false){
	 var cant=$("#"+c.id).parent().parent().find("input").eq(0).val();
	 var pt=cant*c.value;
	 $("#"+c.id).parent().parent().find("input").eq(5).val(pt);
	 	 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);

	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(0).val(0);
		$("#"+c.id).parent().parent().find("input").eq(5).val(0);
		 	 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);

		 }
	   }
	   function recalcularNota(){
		   total=0;
		   precio_total=0;
		   var i;
		   $('#campos tr').each(function () {
			   
			   total=total+parseInt($(this).find("input").eq(0).val());
			precio_total= precio_total+parseFloat($(this).find("input").eq(5).val());
			precio_total.toFixed(2);
			   
			   });
		  
		   
		   
		   }
  
   function eliminarFila(b ){
	  
	     

	      var tt=$("#"+b.id).parent().parent().find("input").eq(0).val();
	  	  var pt=$("#"+b.id).parent().parent().find("input").eq(5).val();
            var cod=$("#"+b.id).parent().parent().find("input").eq(1).val();
	   var idx=array.indexOf(cod);
	   if(idx!=-1) array.splice(idx, 1);



	  nextinput =nextinput -1;
	  
	  
	  if(nextinput==0){
		  total=0;
		  precio_total=0;
		 $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
      $("#num_filas").val(nextinput);
		  
		  }
	
		else{ 
		
	total=total-parseInt(tt);
	 
	  precio_total=precio_total-parseFloat(pt);
	  
	  $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
      $("#num_filas").val(nextinput);
		}

$("#"+b.id).parent().parent().remove();
	  }
	  
	  
	  
	    function validarCantidad(){
			 var patron = /^\d*$/;  
		
				if($( "#cantidad" ).val()==""){
				alert("Ingrese un cantidad");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               alert("La Cantidad no es Correcta");
			   return false;
		   }
				else
				return true;
			
			}
			
					
 function dos_decimales(cadena){
var expresion=/^\d+(\.\d{0,2})?$/;
var resultado=expresion.test(cadena);
return resultado;
}
function verificaPrecio(){
var campo = document.getElementById('pu');
if(dos_decimales(campo.value) !== true){
alert('formato no valido en el campo Precio');
return false;
}
else
return true;
}
	  function validarDisponible(){
		var dis=$("#stock").val();
		var cant=$("#cantidad").val();
		if(parseInt(dis)==0)
		 {
			 alert ("no hay Stock Suficiente");
			 return false;
			 }
			 else{
				 if(parseInt(cant)>parseInt(dis)){
					  alert ("no hay Stock Suficiente");
			 return false;
					 
					 }
				 
				 }
           
			return true;		
		  }
		  
		   function validarEnviar(){
			
				if(nextinput==0){
					alert("No existen items para enviar ")
					
					return false;
					}
				
				
				if(confirm("Se Registrara La nota de Egreso. Desea Continuar??"))
					{
					return true;
					}
					else
					return false;
			
			}
       function validarStock(){
				 
				 if($("#stock").val()==""){
				 alert("no selecciono un Libro");
				 return;
				 }
				 else return true;
				 
				 }
				 
				 $("#cantidad").keyup(function () {
     alert("wer");
    }).keyup();
	

	   
	 
  </script> 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            <?php if (isset($_GET["e"])&&$_GET["e"]=="ei"){?>
          
             <h2 id="contact">ALMACEN > EDITAR NOTA EGRESO > Num:<?php echo $res4["idegreso"]?></h2>
            <div>
           <form method="post"   class="notas"  action="" name="form" id="wizard" onsubmit="return validarEnviar();" >
       <fieldset><legend>Encabezado</legend>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="90%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td>
            <label>Envia :</label>
            <input name="nombre_envia" style="text-transform:uppercase;"  class="validate[required] text-input" data-prompt-position="topRight:-70" type="text"  id="nombre_envia" value="<?php echo $res4["envia"]?>" size="50" />
       
            </td>
		
        
		 <td><select  class="inp-form" name="tipo">
        
			 <option <?php if ($res4["concepto"]=="VENTAS"){?>selected="selected"<?php }?> value="VENTAS">VENTAS</option>
               <option <?php if ($res4["concepto"]=="TRASPASO"){?>selected="selected"<?php }?> value="TRASPASO">TRASPASO</option>
                 <option <?php if ($res4["concepto"]=="CONSIGNACION"){?>selected="selected"<?php }?>  value="CONSIGNACION">CONSIGNACION</option>
                  <option  <?php if ($res4["concepto"]=="DONACION"){?>selected="selected"<?php }?> value="DONACION">DONACION</option>
                   <option <?php if ($res4["concepto"]=="MERMAS Y CASTIGOS"){?>selected="selected"<?php }?> value="MERMAS Y CASTIGOS">MERMAS Y CASTIGOS</option>
                    <option  <?php if ($res4["concepto"]=="REGULARIZACION INVENTARIO"){?>selected="selected"<?php }?>value="REGULARIZACION INVENTARIO">REGULARIZACION INVENTARIO</option>
                     
			
		</select></td>
		
          <td>
                 <label>Fecha:</label>

          <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo date("d-m-Y",strtotime($res4["fecha"]));?>"/>
           </td>
       
       
		</tr> 
           
        <tr>
			
           <td>
        <label>Recibe :</label>	
		<input type="text" name="recibe" style="text-transform:uppercase;" class="validate[required] text-input" data-prompt-position="topRight:-70" value="<?php echo $res4["recibe"]?>" size="50"/>
        
		</td>
			
          
            <td>
            <label>Destino:</label>
            <input type="text" name="destino"  style="text-transform:uppercase;" id="destino" value="<?php echo $res4["destino"]?>" /></td>
           
            
            
              <td>
                             <label>Tipo Cambio :</label>

              <select  class="inp2-form" name="moneda">
        
			 
               <option <?php if ($res4["moneda"]=="Bs"){?>selected="selected"<?php }?>   value="Bs">Bs</option>
                <option <?php if ($res4["moneda"]=="Sus"){?>selected="selected"<?php }?> value="Sus">Dolar</option>
               </select>
               <b><?php echo " 1 Sus =". $tc2["valor"]." Bs";?></b>
               </td>
              
               
      
           
            </tr>
            <tr>
            <td>&nbsp;</td>
           
           			<td colspan="2">
                    <label>Observacion:</label>
                      <textarea   name="obser" cols="28" rows="1" maxlength="255"   ><?php echo $res4["obs"]?></textarea>

            
         
            </td>
			
            </tr>
           </thead>
           </table>
           </fieldset>
           <fieldset><legend>Items</legend>
           <table >
           
        <tr>
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel"   class="inp2-form"/></td>
         
     <td colspan="2">
     
     <label for="libro" size="300" readonly="readonly"> TITULO DEL LIBRO :</label>
  <input id="libro"  size="75"  /></td>
 
  <td>
   <label for="libro" >Stock Disponible: </label>
   <input id="stock" size="5" readonly class="inp2-form"  />
   </td>
   <td>
   <label for="pu" >P / UNITARIO: </label>
   <input id="pu" size="5"  class="inp2-form"  />
   </td>
    <td>
   <label for="libro" >CANTIDAD : </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
   
   <td>
  <img src="<?php config::ruta(); ?>images/adicionar.png" width="40" height="40" id="adicionar" style="cursor:pointer;" title="Adicionar"/>
	</td>
    </tr>
	</table>
    </fieldset>

<table cellpadding="0"  id="detalle" border="0">
            
                    <thead>
                    <tr><td><label for="pu" >CANT TOTAL: </label>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
   <td><label for="monto_total" >MONTO TOTAL</label>
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td>
   </tr>
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                             <th >Observacion</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                   
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
       <input type="submit" id="bEnviar" value="Guardar" name="bEnviar" />
       <input type="button" id="cancelar" value="Cancelar"  name="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=notasEgreso';"/>               
       <input type="hidden" name="editar" id="editar"  value="editar"/>
       <input type="hidden" name="idegreso" id="idegreso" value="<?php echo $_GET["id"]; ?>" />
       <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />
       <input type="hidden" name="num_filas" id="num_filas" />
</td>
</tr>
               </table>
            </form>
            </div>
            <?php } else {?>
            
             <h2 id="contact">ALMACEN > REGISTRAR NOTA EGRESO</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard" onsubmit="return validarEnviar();"  >
        <fieldset><legend>Encabezado</legend>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="70%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td>
            <label>Envia :</label>
            <input name="nombre_envia"  class="validate[required] text-input" data-prompt-position="topRight:-70" type="text"  id="nombre_envia" value=""  size="50" style="text-transform:uppercase;"/>
       
            </td>
		
      
		<td >
               <label>Concepto :</label>

        <select  class="inp-form" name="tipo">
          <option  value="VENTAS">VENTAS</option>
               <option  value="TRASPASO">TRASPASO</option>
                 <option   value="CONSIGNACION">CONSIGNACION</option>
                  <option  value="DONACION">DONACION</option>
                   <option  value="MERMAS Y CASTIGOS">MERMAS Y CASTIGOS</option>
                    <option value="REGULARIZACION INVENTARIO">REGULARIZACION INVENTARIO</option>
                     
			
		</select></td>
       
        
          <td>
                 <label>Fecha:</label>

          <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo date("d-m-Y");?>"/>
           </td>
       
       
		</tr> 
           
        <tr>
			
           <td>
        <label>Recibe :</label>	
		<input type="text" name="recibe"  style="text-transform:uppercase;"size="50"class="validate[required] text-input" data-prompt-position="topRight:-70"/>
        
		</td>
			
          
            <td>
            <label>Destino:</label>
            <input type="text" name="destino" style="text-transform:uppercase;" id="destino" value="" />
            </td>
           
           			   <td>
               <label>Tipo Cambio :</label>
               <select  class="inp2-form" name="moneda">
          <option   value="Bs">Bs</option>
			  <option value="Sus">Dolar</option>
             
               </select>
                <b><?php echo " 1 Sus =". $tc2["valor"]." Bs";?></b>
               </td>
			
            </tr>
            <tr>
            <td>&nbsp;</td>
           
           			<td colspan="2">
                    <label>Observacion:</label>
                      <textarea   name="obser" cols="28" rows="1" maxlength="255"   ></textarea>

            
         
            </td>
			
            </tr>
           </thead>
           </table>
           </fieldset>
           <fieldset><legend>Items</legend>
           <table width="90%">
           
        <tr>
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO </label>
  <input id="codigoLabel"   class="inp2-form"/></td>
         
     <td colspan="2">
     
     <label for="libro" size="300" readonly="readonly"> TITULO DEL LIBRO </label>
  <input id="libro"  size="75"  /></td>
  <td>
   <label for="libro" >Stock Disponible </label>
   <input id="stock" size="5" readonly class="inp2-form"  />
   </td>
  
   <td>
   <label for="pu" >P/UNITARIO </label>
   <input id="pu" size="5"  class="inp2-form"  />
   </td>
    <td>
   <label for="libro" >CANTIDAD  </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
   
   <td>
  <img src="<?php config::ruta(); ?>images/adicionar.png" width="40" height="40" id="adicionar" style="cursor:pointer;" title="Adicionar"/>
	</td>
    </tr>
	</table>
    </fieldset>

<table cellpadding="0"  width="90%" id="detalle" border="0">
            
                    <thead>
                    <tr><td><label for="pu" >CANT TOTAL </label>
   <input  size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
   <td><label for="monto_total" >MONTO TOTAL</label>
   <input name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td>
   </tr>
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Cantidad</th>
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                             <th >Observacion</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                   
                    	
                     
                    </tbody>
                   
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
			<input type="submit" id="bEnviar" value="Guardar" name="bEnviar"  />
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=notasEgreso';" />
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
               
     
                <input type="hidden" name="num_filas" id="num_filas" />
               <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />
</td>
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