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
		
		
			
		
	
  $(document).ready(function($)
  {
	  	  <?php 
if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="adicionar"){

  foreach($res2 as $v){
	  	  $aux=$li->getId($v["idlibros"]);
           $t=$v["cantidad"]*$aux["cif"];
	  echo "addTableRow2($v[cantidad],'".$aux["titulo"]."','".$aux["tomo"]."',$aux[cif],".$t.",$v[idlibros],'".$aux["codigo"]."');";
	  
	 
	   
    }
	
	  
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
		if(verificaPrecio()&& validarCantidad() && validarDisponible() && validarStock()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" style="text-align:center" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="100" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '" style="text-align:center" name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" style="text-align:right;background-color:#FF6" onchange="recalcularPrecio(this);" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" style="text-align:right"id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" value=""  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td></tr>';
	
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
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);

   }
   
   function addTableRow( cantidad, titulo, tomo,pu,pt,id)
   {
    campo = '<tr><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '" style="text-align:center" name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" onchange="recalcularPrecio(this);" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td></tr>';
	
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
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
  });
  
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
		//$("#"+c.id).parent().parent().find("input").eq(0).val(0);
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
  
 
	  
	  



		  
		   function Aceptar(){
			
				
				if(confirm("SE REGISTRARA LA NOTA DE  INGRESO... ?"))
					
					document.form.submit();
				
			
			}
			  function Rechazar(){
			
				
				if(confirm("ANULAR LA NOTA DE  INGRESO... ?"))
					
					window.location='<?php config::ruta()?>?accion=addIngresoDevo&id=<?php echo $res["iddevolucion"]?>&e=anular';
			
			}
			
			
     
  </script> 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
          
            
             <h2 id="contact">ALMACEN > REGISTRAR NOTA INGRESO</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset><legend>Encabezado</legend>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="90%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		<td>
            <label>Recibe :</label>
            <input name="recibe"   size="50"  type="text"  id="recibe" value="" />
       
            </td>
		
      
		<td >
               <label>Concepto :</label>

 <select  class="inp-form" name="tipo">
           <option value="INVENTARIO INICIAL">INVENTARIO INICIAL</option>
                 <option  value="COMPRA MERCADERIA">COMPRA MERCADERIA</option>
                 <option  value="TRASPASO">TRASPASO</opTION>
                 <option  value="DEVOLUCION EN VENTA" selected="selected">DEVOLUCION EN VENTA</option>
                 <option  value="DEVOLUCION CONSIGNACION">DEVOLUCION CONSIGNACION</option>
                 <option value="DONACION Y/U OBSEQUIO">DONACION Y/U OBSEQUIO</option>
                 <option  value="REGULARIZACION INVENTARIO">REGULARIZACION  INVENTARIO</option>
                 
                     
			
		</select>          </td>
       
        
          <td>
                 <label>Fecha:</label>

          <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo $res["fecha"];?>"/>
           </td>
       
       
		</tr> 
           
        <tr>
			
           <td>
        <label>Envia:</label>	
		<input type="text" name="nombre_envia"  size="50" readonly value="<?php echo $res["cliente"];?>"/>
        
		</td>
			
          
            <td>
            <label>Documento:</label>
            <input type="text" name="documento" id="documento" value="<?php echo VENTA."-".Helpers::rellenarceros($res["idventas"],6);?>" />
            </td>
           
           			   <td>
               <label>Moneda :</label>
               <input type="text"  readonly="readonly" name="moneda" value="<?php echo $res["moneda"];?>">
          
              
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
			<input type="button" id="bAceptar" value="APROBAR" name="bAceptar" onclick="Aceptar();"/>
            			<input type="button" id="bRechazar" value="Rechazar" name="bRechazar" onclick="Rechazar();"/>

            <input type="button" id="cancelar" value="Regresar"  name="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=devolucionAlmacen';" />
            <input type="hidden" name="enviar" id="enviar" value="enviar" /> 
            <input type="hidden" name="num_filas" id="num_filas" />
            <input type="hidden" name="iddevolucion" id="iddevolucion" value="<?php echo $res["iddevolucion"]?>" />
            <input type="hidden" name="idventas" id="idventas" value="<?php echo $res["idventas"]?>" />

</td>
               </table>
            </form>
            
          
            </div>
          
           
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>