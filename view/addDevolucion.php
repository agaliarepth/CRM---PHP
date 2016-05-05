<?php require_once("head.php");?>

 <script type="text/javascript">

	var nextinput = 0;
    var total=0;
    var  precio_total=0;
	var total2=0;
    var  precio_total2=0;
    var array=new Array();
	var pu;

		
	
  $(document).ready(function($)
  {
     
	
	  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="editar"){

  foreach($detalle_venta as $v){
	  $sw=0;
	foreach($detalle_devolucion as $r){
	
	//echo "alert('".$r["idlibros"]."');";
	if($r["idlibros"]==$v["libros_idlibros"]){
	  echo "addTableRow2('".$v["codigo"]."',$v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unit],$v[precio_total],$v[libros_idlibros],$r[cantidad],$r[precio_unit],$r[precio_total]);";
	  echo" chequeo2($('#campos tr:last').find('input').eq(9).attr('id'));";
	 $sw=1; 
	}
	                 
	}
	if($sw==0)
	echo "addTableRow2('".$v["codigo"]."',$v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unit],$v[precio_total],$v[libros_idlibros],'0','0','0');";
    }

}

 if (isset($_GET["e"])&&$_GET["e"]=="devolucion" && isset($_GET["idv"])){
		 foreach($res2 as $v){
		 echo "addTableRow2('".$v["codigo"]."',$v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unit],$v[precio_total],$v[libros_idlibros],'0','0','0');";
	
		 }
	 }


?>
   // trigger event cuando el boton es cliqueado

   });
   
   
    function addTableRow2( codigo,cantidad, titulo, tomo,pu,pt,id,cantidad2,pu2,pt2)
   {
    campo = '<tr id="fila' + nextinput + '"><td width="10px"><input style="text-align:center" type="text"  readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '" value="'+codigo+'"  /></td><td><input  style="text-align:left"type="text"  readonly ="readonly"  size="70" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input style="text-align:center"type="text"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td ><input style="text-align:right;background-color:#FFC" type="text "  size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="'+cantidad+'" readonly /></td><td><input style="text-align:right;background-color:#FFC" type="text" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]" readonly  /></td><td colspan="2"  ><input style="text-align:right;background-color:#FFC" type="text"  readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"/></td><td ><input style="text-align:right" type="text"  size="5" id="cantidad2' + nextinput + '"  name="cantidad2[]' + nextinput + '" readonly   value="'+cantidad2+'" onchange="recalcularCantidad(this);" /></td><td><input style="text-align:right" type="text"  readonly size="10" value="'+pu2+'" id="precio_unit2' + nextinput + '"  name="precio_unit2[]" onchange="recalcularPrecio(this);"  /></td><td colspan="2" ><input style="text-align:right" type="text"  readonly ="readonly" size="10" id="precio_total2' + nextinput + '" value="'+pt2+'"  name="precio_total2[]' + nextinput + '"/></td><td align="center"> <input  onchange="chequeo(this);" type="checkbox" id="elegido' + nextinput + '" name="elegido[]"  value="'+nextinput+'" /><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td></tr>';
	
$("#campos").append(campo);

array[nextinput]=codigo;
nextinput++;

var tt=$("#campos tr:last").find("input").eq(3).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
var tt2=$("#campos tr:last").find("input").eq(6).attr("value");
var prt2=$("#campos tr:last").find("input").eq(8).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
precio_total.toFixed(2);
total2=total2+parseInt(tt2);
precio_total2=precio_total2+parseFloat(prt2);
precio_total2.toFixed(2);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#cant_total2").val(total2);
$("#monto_total2").val(precio_total2);

$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   
   }
   
   
  

  	 function chequeo(v){
		
		  var f=$("#"+v.id).parent().parent().attr("id");
			  if($("#"+v.id).is(':checked')){ 
	       
			 $("#"+v.id).parent().parent().find("input").eq(6).focus();
	        $("#"+f).css( "background-color", "red");
			 $("#"+v.id).parent().parent().find("input").eq(6).removeAttr("readonly");
			  $("#"+v.id).parent().parent().find("input").eq(7).removeAttr("readonly");
		
			   return false;
			  } 
			  else{
			 
			 $("#"+f).css( "background-color", "");
			 $("#"+v.id).parent().parent().find("input").eq(6).attr("readonly","true");
			  $("#"+v.id).parent().parent().find("input").eq(7).attr("readonly","true");
			  $("#"+v.id).parent().parent().find("input").eq(6).val("0");
			  $("#"+v.id).parent().parent().find("input").eq(7).val("0");
			   $("#"+v.id).parent().parent().find("input").eq(8).val("0");
			   recalcularNota();
			   $("#cant_total2").val(total2);
$("#monto_total2").val(precio_total2);
			   return false;
				  }
			 }
			 
			  function chequeo2(v){
		
		  var f=$("#"+v).parent().parent().attr("id");
			
	     //  alert(v);
			 $("#"+v.id).parent().parent().find("input").eq(6).focus();
	        $("#"+f).css( "background-color", "red");
			 $("#"+v).parent().parent().find("input").eq(6).removeAttr("readonly");
			  $("#"+v).parent().parent().find("input").eq(7).removeAttr("readonly");
			  			 $("#"+v).parent().parent().find("input").eq(9).attr('checked',1);

		
			   return false;
			  
			 }
   function recalcularCantidad(c){
	 
	 if(validarCantidad($("#"+c.id))&&validarStockDisponible(c)){
	 var pu=$("#"+c.id).parent().parent().find("input").eq(7).val();
	 var pt=pu*c.value;
	 $("#"+c.id).parent().parent().find("input").eq(8).val(pt);
	 recalcularNota();
$("#cant_total2").val(total2);
$("#monto_total2").val(precio_total2);


	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(6).val(0);
		$("#"+c.id).parent().parent().find("input").eq(8).val(0);
		 recalcularNota();
$("#cant_total2").val(total2);
$("#monto_total2").val(precio_total2);


		 }
	   }
	   
	   function recalcularPrecio(c){
	   var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test(c.value);
	 if(resultado!=false){
	 var cant=$("#"+c.id).parent().parent().find("input").eq(6).val();
	 var pt=cant*c.value;
	 $("#"+c.id).parent().parent().find("input").eq(8).val(pt);
	 	 recalcularNota();
$("#cant_total2").val(total2);
$("#monto_total2").val(precio_total2);


	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(7).val(0);
		$("#"+c.id).parent().parent().find("input").eq(8).val(0);
		 	 recalcularNota();
$("#cant_total2").val(total2);
$("#monto_total2").val(precio_total2);


		 }
	   }
	   function recalcularNota(){
		   total2=0;
		   precio_total2=0;
		   var i;
		   $('#campos tr').each(function () {
			   
			   total2=total2+parseInt($(this).find("input").eq(6).val());
			precio_total2= precio_total2+parseFloat($(this).find("input").eq(8).val());
			//precio_total.toFixed(2);
			   
			   });
		  
		   
		   
		   }
  
   
	 
	  
	    function validarCantidad(cant){
			 var patron = /^\d*$/;  
		
				if(cant.val()==""){
				alert("ERROR::Ingrese un cantidad");
				return false;
	             }
				                      
                                 
           if ( !patron .test(cant.val())) {               

               alert("ERROR::La Cantidad no es Correcta");
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
alert('ERROR::formato no valido en el campo Precio');
return false;
}
else
return true;
}

		  
		   function validarStockDisponible(s){
		var dis=$("#"+s.id).parent().parent().find("input").eq(3).val();
		var c=$("#"+s.id).parent().parent().find("input").eq(6).val();
		
	
		if(parseInt(c)>parseInt(dis)){
		alert("La cantidad Devuelta no Puede ser Mayor a La cantidad Vendida");
		return false;
		
		
		}
		else
		return true;
		  }
		  
		   function validarEnviar(){
			
				if(nextinput==0){
					alert("No existen items para enviar ")
					$("#codigoLabel").focus();
					return ;
					
					}
				
				else {
					if($("#idclientes").val()==""){
						
						alert("No Existe ningun cliente Seleccionado");
						$("#nombre").focus();
						return;
						
						}
					
					
				}
				if(confirm("SE GUARDARA LA DEVOLUCION ?"))
					$("#vender").val(0);
					//alert($("#vender").val());
					document.form.submit();
				
			
			}
			
			   function validarVender(){
			
				if(nextinput==0){
					alert("No existen items para enviar ")
					$("#codigoLabel").focus();
					return ;
					
					}
				
				else {
					if($("#idclientes").val()==""){
						
						alert("No Existe ningun cliente Seleccionado");
						$("#nombre").focus();
						return;
						
						}
					
					
				}
				if(confirm("Se Registrara La Devolucion en el sistema ?"))
					
					$("#vender").val(1);
					//alert($("#vender").val());
						document.form.submit();
				
			
			}
  
 

  </script> 

 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            <?php if (isset($_GET["e"])&&$_GET["e"]=="editar"){
				
			
				?>
           <h2 id="contact">VENTAS > EDITAR VENTA </h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
            
      <fieldset >
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input  type="text" id="nombre" name="nombre" size="55" value="<?php echo $res["cliente"]?>"/>
        <input type="hidden" name="idclientes" id="idclientes" value="<?php echo $res["idcliente"]?>"/>
		</td>
        <td><label>NOTA DE INGRESO</label>
      
			
		<input  type="text" id="idingreso" name="idingreso" size="10" readonly/>
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fecha"]));?>"/></td>
      <td >
               <label>MONEDA</label>

       <input type="text"  size="3"id="moneda" name="moneda" readonly  value="<?php echo $res["moneda"];?>"/></td>
       
       
        </tr>
        </thead>
        </table>
        
        
       
       
	
           </fieldset>
          
           

<p>&nbsp;</p>
<table cellpadding="0"  width="70%" id="detalle" border="0" >
            
                    <thead>
                   
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th>Volumen</th>
                            <th>Cantidad<br />Vendida</th>
                            <th>P/Unitario<br />Vendida<th>
                            <th >P/Total</br>Vendida</th>
                            <th>Cantidad<br />Devuelto</th>
                            <th>P/Unitario<br />Devuelto<th>
                            <th >P/Total<br />Devuelto</th>
                            <th >Marcar</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                  
                    	
                     
                    </tbody>
                    <tfoot>
                     <tr style=" background-color:#FFC">
                     <td colspan="2" ></td>
                     <td>TOTAL VENDIDO:</td>
                    
                     <td  align="right" ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
                     <TD colspan="2"></TD>
                        <td align="right" > <input style="text-align:right" name="monto_total" size="10"  class="inp2-form" readonly  id="monto_total" /></td>
                       
                    
                     <td  align="right" ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total2" class="inp2-form" id="cant_total2"  /></td>
                     <TD ></TD>
                        <td align="right"  colspan="2"> <input style="text-align:right" name="monto_total2" size="10"  class="inp2-form" readonly  id="monto_total2" /></td>
                        
   </tr>
                    </tfoot>
                   
                     </table>
                      
           
                      
                     
                     
                     
                     
                     
                     <table>
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
			<input type="button" id="bEnviar" value="Guardar " name="bEnviar" onclick="validarEnviar();" />
<!--           <input type="button" id="bVender" value="Vender" name="bEnviar" onclick="validarVender();" />
-->
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=devoluciones';"/>
                 <input type="hidden" name="editar" id="editar" value="editar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />
               <input type="hidden" name="iddevolucion" id="iddevolucion" value="<?php echo $res["iddevolucion"]; ?>" />
               <input type="hidden" name="idventas" id="idventas" value="<?php echo $res["idventas"];?>" />


             
</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
        
            <?php } else {?>
            
             <h2 id="contact">VENTAS > REGISTRAR DEVOLUCION </h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset >
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input  type="text" id="nombre" name="nombre" size="55" value="<?php echo $res["nombre"]?>"/>
        <input type="hidden" name="idclientes" id="idclientes" value="<?php echo $res["clientes_idclientes"]?>"/>
		</td>
        <td><label>NOTA DE INGRESO</label>
      
			
		<input  type="text" id="idingreso" name="idingreso" size="10" readonly/>
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y");?>"/></td>
      <td >
               <label>MONEDA</label>

       <input type="text"  size="3"id="moneda" name="moneda" readonly  value="<?php echo $res["moneda"];?>"/></td>
       
       
        </tr>
        </thead>
        </table>
        
        
       
       
	
           </fieldset>
          
           

<p>&nbsp;</p>
<table cellpadding="0"  width="70%" id="detalle" border="0" >
            
                    <thead>
                   
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th>Volumen</th>
                            <th>Cantidad<br />Vendida</th>
                            <th>P/Unitario<br />Vendida<th>
                            <th >P/Total</br>Vendida</th>
                            <th>Cantidad<br />Devuelto</th>
                            <th>P/Unitario<br />Devuelto<th>
                            <th >P/Total<br />Devuelto</th>
                            <th >Marcar</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                  
                    	
                     
                    </tbody>
                    <tfoot>
                     <tr style=" background-color:#FFC">
                     <td colspan="2" ></td>
                     <td>TOTAL VENDIDO:</td>
                    
                     <td  align="right" ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
                     <TD colspan="2"></TD>
                        <td align="right" > <input style="text-align:right" name="monto_total" size="10"  class="inp2-form" readonly  id="monto_total" /></td>
                       
                    
                     <td  align="right" ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total2" class="inp2-form" id="cant_total2"  /></td>
                     <TD ></TD>
                        <td align="right"  colspan="2"> <input style="text-align:right" name="monto_total2" size="10"  class="inp2-form" readonly  id="monto_total2" /></td>
                        
   </tr>
                    </tfoot>
                   
                     </table>
                      
           
                      
                     
                     
                     
                     
                     
                     <table>
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
			<input type="button" id="bEnviar" value="Guardar " name="bEnviar" onclick="validarEnviar();" />
<!--           <input type="button" id="bVender" value="Vender" name="bEnviar" onclick="validarVender();" />
-->
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=ventasCredito';"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />


               <input type="hidden" name="idventas" id="idventas" value="<?php echo $res["idventas"];?>" />
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