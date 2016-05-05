<?php require_once("head.php");
//print_r($res2);
?>

 <script type="text/javascript">

	var nextinput = 0;
    var total=0;
    var  precio_total=0;
	var cantidadtotal=0;
    var  precio_total2=0;
    var array=new Array();
	var pu;
     var idventa=0;
	 var iddeuda=0;
	 var sw=0;
	 var sw2=0;
		
	
  $(document).ready(function($)
  {
	  
		   $("#datosdeuda").css({ display: "none"});			
	       $("#tipodevolucion").change(function(){
		
		if($(this).val()=="deuda"){
			
           $("#datosventa").css({ display: "none"});
		   $("#datosdeuda").css({ display: "block"});
		   $("#idventas").val(0);
		   sw=0;		
			
			}
			if($(this).val()=="venta"){
			
           $("#datosventa").css({ display: "block"});
		   $("#datosdeuda").css({ display: "none"});			
			
			 $("#iddeudas").val(0);
		   sw2=0;		
			}
		
		
		});
		
		
		$("#iddeudas").change(function(){
			
			deudas();			
			});//fin $("#iddeudas").change(function()
	$("#idventas").change(function(){
		
		
		ventas();
	});
     
		 
		  

		
  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="editar"){

   
	foreach($detalle_devolucion as $v){
	
	 $v2=$li->getId($v["idlibros"]);
		  echo "addTableRow2('".$v2["codigo"]."','".$v2["titulo"]."','".$v2["tomo"]."',$v[cantidad],$v[precio_unit],$v[idlibros]);";
	}
	      
		  if($res["tipodevolucion"]=="venta"){
		  ?>
		   $("#datosventa").css({ display: "block"});
		   $("#datosdeuda").css({ display: "none"});
		   $("#iddeudas").val(0);
		  $("#idventas").val(<?php echo $res["idventas"]?>);
		   sw=1;  
		  $sw2=0;
		  ventas();
		 
		 <?php }
		   if($res["tipodevolucion"]=="deuda"){?>
		  // alert("deuda");
		  $("#datosventa").css({ display: "none"});
		   $("#datosdeuda").css({ display: "block"});
		   $("#idventas").val(0);
		  $("#iddeudas").val(<?php echo $res["iddeudas"]?>);
		   sw=0;  
		  $sw2=1;
		  deudas();
		   
		   <?php }?>
		 
		 
		 
<?php 
}

 if (isset($_GET["id"])&&!isset($_GET["e"])){
		 foreach($res2 as $v){
			 $v2=$li->getId($v["libros_idlibros"]);
		  echo "addTableRow2('".$v2["codigo"]."','".$v2["titulo"]."','".$v2["tomo"]."',$v[cantidad],0,$v[libros_idlibros]);";
	
		 }
	 }


?> 
		
	


   });//fin 
    
  function ventas(){
	   idventa=$("#idventas").val();
		  
		
		  $.ajax({
					 
                              type: "POST",
                              url: "ajax/buscarVentaCliente.php",
                              data: "id="+idventa,
                              dataType: "json",
                              error: function(){
                                    alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								    if(data!=false)
										{
                                  sw=1;
										$("#nombrecliente").val(data.nombre);
										$("#idcliente").val(data.clientes_idclientes);	
										$("#tipoventa").val(data.tipoventa);
										$("#fechaventa").val(data.fecha);
										$("#montoventa").val(data.total);
										$("#monedaventa").val(data.moneda);									
										}
								
									else { 
										 alert("LA VENTA:: NO SE  ENCUENTRA REGISTRADO...");
										 sw=0;
									}
									  n();
									 
                              
	                               }
                  });
	  
	  
	  }
  function deudas(){
	  iddeuda=$("#iddeudas").val();
		  
		
		  $.ajax({
					 
                              type: "POST",
                              url: "ajax/buscarDeuda.php",
                              data: "id="+iddeuda,
                              dataType: "json",
                              error: function(){
                                    alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								    if(data!=false)
										{
                                  sw2=1;
										$("#fechadeuda").val(data.fecha);
										$("#cliente_deuda").val(data.nombre_cliente);	
										$("#descrip_deuda").val(data.descripcion);	
										$("#monto_deuda").val(data.saldo);	
										$("#monedadeuda").val(data.moneda);	
										$("#id_clientes").val(data.clientes_idclientes);							
										}
								
									else { 
										 alert("LA DEUDA:: NO SE  ENCUENTRA REGISTRADO...");
										 sw2=0;
									}
									  n();
									 
                              
	                               }
                  });
	  }
   function recalcularPrecio(c){
		    var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test($("#"+c).val());
	 
	 if(resultado!=false){
	 var cant=$("#"+c).parent().parent().find("input").eq(3).val();
	 var pt=parseInt(cant)*parseFloat($("#"+c).val());
	
	 $("#"+c).parent().parent().find("input").eq(6).val(parseFloat(pt).toFixed(2));
	
	 	 recalcularNota();

	 }
	 else{
		$("#"+c).val("0");
		 recalcularNota();


		 }
	
	   }
	   
   function addTableRow2( codigo, titulo, tomo,cantidad,pu1,id)
   {
    campo = '<tr id="fila' + nextinput + '"><td width="10px"><input style="text-align:center" type="text"  readonly ="readonly" size="10"   name="codigo[]' + nextinput + '" value="'+codigo+'"  /></td><td><input  style="text-align:left"type="text"  readonly ="readonly"  size="70" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input style="text-align:center"type="text"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td ><input style="text-align:right;background-color:#FFC" type="text "  size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="'+cantidad+'" readonly /></td><td colspan="2" ><input style="text-align:right" type="text"  size="10" value="'+pu1+'" id="precio_unit2' + nextinput + '"  name="precio_unit[]" onchange="recalcularPrecio(this.id);"    /></td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /><td style="text-align:right;background-color:#AC3"><input style="text-align:right" type="text" readonly ="readonly"  size="10" id="total_fila' + nextinput + '" value="0"  name="total_fila[]' + nextinput + '" /></td></tr>';
	
$("#campos").append(campo);

array[nextinput]=codigo;
nextinput++;
var tt=$("#campos tr:last").find("input").eq(3).attr("value");
total=total+parseInt(tt);
$("#cant_total2").val(total);
$("#num_filas").val(nextinput);
	 aux1=parseFloat( $("#campos tr:last").find("input").eq(3).val())*parseFloat( $("#campos tr:last ").find("input").eq(4).val());
	 
	
     $("#campos tr:last ").find("input").eq(6).val(aux1);
	

 recalcularNota();

   }
   
    function recalcularNota(){
		   total2=0;
		   precio_total2=0;
		   var i;
		   $('#campos tr').each(function () {
			   
			precio_total2= precio_total2+parseFloat($(this).find("input").eq(6).val());
			total2=total2+parseFloat($(this).find("input").eq(3).val());
			   
			   });
			   precio_total2=precio_total2.toFixed(2);
		  
		 			$("#monto_total2").val(precio_total2);
					$("#cant_total").val(total2);
		   
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

function validarEnviar(){
			if( $("#tipodevolucion").val()=="venta"){
				if(sw==0 ){
					 alert("NO EXISTE NINGUNA VENTA ASOCIADA A ESTA DEVOLUCION..REVISE EL CAMPO NOTA DE VENTA");
					 		$("#idventas").focus();
							return;	
					
					           }
					else {
						
				          if(confirm("SE GUARDARA LA DEVOLUCION ?")){
					
					           $("#iddeudas").val(0);
				            	document.form.submit();
				               }
				               else
				               return;
					      }
			}
					if($("#tipodevolucion").val()=="deuda"){
			 if(sw2==0 ){
					 alert("NO EXISTE NINGUNA DEUDA ASOCIADA A ESTA DEVOLUCION..REVISE EL CAMPO 'CODIGO DEUDA'");
					 		$("#iddeudas").focus();	
							
							
					}
					else{
				if(confirm("SE GUARDARA LA DEVOLUCION ?")){
					$("#idventas").val(0);
					document.form.submit();
				          }
				     else
				    return;
					}
					}
			}
			function imprimirNota(url){
				if(sw==1)
				imprimir(url+idventa);
				
				}
   
    

  </script> 

 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            <?php if (isset($_GET["e"])&&$_GET["e"]=="editar"){
				
			
				?>
           <h2 id="contact">VENTAS > EDITAR DEVOLUCION</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
            
      <fieldset ><legend>DATOS DE LA DEVOLUCION</legend>
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		<td><label>TIPO DEVOLUCION</label><select style="background-color:#333; color:#CF0; font-weight:bold;" name="tipodevolucion"  id="tipodevolucion">
        
        <option style="width:100px;" <?php if($res["tipodevolucion"]=="venta"){?> selected<?php }?> value="venta">VENTA</option>
        <option value="deuda" <?php if($res["tipodevolucion"]=="deuda"){?> selected<?php }?>>DEUDA</option>
        
        </select></td>
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input  type="text" id="nombre" name="nombre" size="55" value="<?php echo $res["cliente"]?>"/>
         <input  type="hidden" id="idcliente" name="idcliente" value="<?php echo $res["idcliente"]?>"/>
		</td>
         
        <td><label>NOTA DE INGRESO</label>
      
			
		<input  type="text" id="idingreso" name="idingreso" size="10"  value="<?php echo $res["idingreso"]?>"readonly/>
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fecha"]));?>"/></td>
      <td >
               <label>MONEDA</label>

       <input type="text"  size="3"id="moneda" name="moneda" readonly  value="<?php echo $res["moneda"];?>"/></td>
       
       
        </tr>
        </table>
          </fieldset>
          
          
          
          
          
        <fieldset id="datosventa"><legend>DATOS DE LA VENTA</legend>
        <table>
        <tr>
         <td><label>NOTA DE VENTA</label><input type="text" size="8" name="idventas" id="idventas"  value="<?php echo $res["idventas"];?>"/><a href="#" onclick="imprimirNota('<?php echo config::ruta();?>?accion=vernotaVenta&id=')">Ver Nota Venta</a></td>
         <td> <label>TIPO VENTA</label>
      		<input  type="text" id="tipoventa" name="tipoventa" size="15" readonly value="<?php echo $tipo;?>"/></td>
            <td><label>FECHA VENTA</label>
      		<input  type="text" id="fechaventa" name="fechaventa" size="15" readonly value="<?php 
			
			echo $venta->getFecha($res["idventas"]);
			 $res["fecha"];?>"/>
         <td colspan="2">
         <label>CLIENTE DE LA VENTA</label>
      
			
		<input  type="text" id="nombrecliente" name="nombrecliente" size="55" readonly value="<?php
		$res2=$venta->getMoneda($res["idventas"]);
		 echo $res2["nombre"];?>"/>
        <input  type="hidden" id="idcliente" name="idcliente" size="55"  value="<?php echo $res2["clientes_idclientes"];?>"/>
         </td>
         <td> <label>MONTO DE VENTA</label>
      
		<input  type="text" id="montoventa" name="montoventa" size="15" readonly value="<?php echo $venta->getTotalVenta($res["idventas"]);?>"/></td>
         <td> <label>MONEDA VENTA</label>
      
		<input  type="text" id="monedaventa" name="monedaventa" size="8" readonly value="<?php echo $res2["moneda"];?>"/></td>
        </tr>
        </thead>
        </table>
        
        </fieldset>
          
            </fieldset>
           <fieldset id="datosdeuda"><legend>DATOS DE DEUDA POR COBRAR</legend>
           <table>
           <tr>
           <td><label>CODIGO DEUDA</label><input type="text" size="8" name="iddeudas" id="iddeudas"/></td>
           <td><label>FECHA COMPRA</label><input type="text" size="8" name="fechadeuda" id="fechadeuda"/></td>
           <td><label>NOMBRE CLIENTE</label><input type="text" size="50" name="cliente_deuda" id="cliente_deuda"/>
             <input type="hidden" name="id_clientes" id="id_clientes"/>
           </td>
           <td><label>DESCRIPCION</label><input type="text" size="20" name="descrip_deuda" id="descrip_deuda"/></td>
           <td><label>MONTO</label><input type="text" size="12" name="monto_deuda" id="monto_deuda"/></td>
           <td><label>MONEDA</label><input type="text" size="5" name="monedadeuda" id="monedadeuda"/></td>
           </tr>
           
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
                            <th>Cantidad<br />Devuelta</th>
                            <th>P/Unitario <br /><th>
                            <th>Precio <br />ToTal</th>
                         
                            
                        </tr>
                   
                    <tbody  id="campos">
                  
                    	
                     
                    </tbody>
                    <tfoot>
                      <tr style=" background-color:#FFC">
                     
                    
                 
                     <TD colspan="2"></TD>
                     
                        <td align="right" > </td>
                       
                    
                     <td  align="right" ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total2" class="inp2-form" id="cant_total2"  /></td>
                     <td colspan="2"></td>
                    
                        <td align="right"  > <input style="text-align:right" name="monto_total2"  value="0"size="10"  class="inp2-form" readonly  id="monto_total2" /></td>
                        
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


             
</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
        
            <?php } else {?>
            
             <h2 id="contact">VENTAS > REGISTRAR DEVOLUCION </h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset > <legend>DATOS DE LA DEVOLUCION</legend>
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr>
		<td><label>TIPO DEVOLUCION</label><select style="background-color:#333; color:#CF0; font-weight:bold;" name="tipodevolucion"  id="tipodevolucion">
        
        <option style="width:100px;" value="venta">VENTA</option>
        <option value="deuda">DEUDA</option>
        
        </select></td>
		<td colspan="2"><label>NOMBRE CLIENTE</label>
      
			
		<input  type="text" id="nombre" name="nombre" size="55" readonly value="<?php echo $res["envia"]?>"/>

		</td>
       
        <td><label>NOTA DE INGRESO</label>
      
			
		<input  type="text" id="idingreso" name="idingreso" size="10" value="<?php echo $res["idingreso"]?>" readonly/>
		</td>
      
		<td><label>FECHA </label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y");?>"/></td>
      <td >
               <label>MONEDA</label>

       <input type="text"  size="3"id="moneda" name="moneda" readonly  value="<?php echo $res["moneda"];?>"/></td>
       
       
        </tr>
      
        </table>
          </fieldset>
          
          
          
          
          
        <fieldset id="datosventa"><legend>DATOS DE LA VENTA</legend>
        <table>
        
        <tr>
         <td><label>NOTA DE VENTA</label><input type="text" size="8" name="idventas" id="idventas" /><a href="#" onclick="imprimirNota('<?php echo config::ruta();?>?accion=vernotaVenta&id=')">Ver Nota Venta</a></td>
         <td> <label>TIPO VENTA</label>
      		<input  type="text" id="tipoventa" name="tipoventa" size="15" readonly value=""/></td>
         <td><label>FECHA VENTA</label>
      		<input  type="text" id="fechaventa" name="fechaventa" size="15" readonly />
         <td colspan="2">
         <label>CLIENTE DE LA VENTA</label>
      
			
		<input  type="text" id="nombrecliente" name="nombrecliente" size="55" readonly />
        <input  type="hidden" id="idcliente" name="idcliente" size="55"  />
         </td>
         <td> <label>MONTO DE VENTA</label>
      
		<input  type="text" id="montoventa" name="montoventa" size="15" readonly value=""/></td>
         <td> <label>MONEDA VENTA</label>
      
		<input  type="text" id="monedaventa" name="monedaventa" size="8" readonly value=""/></td>
        </tr>
        </thead>
        </table>
        
        
       
       
	
           </fieldset>
           <fieldset id="datosdeuda"><legend>DATOS DE DEUDA POR COBRAR</legend>
           <table>
           <tr>
           <td><label>CODIGO DEUDA</label><input type="text" size="8" name="iddeudas" id="iddeudas"/></td>
           <td><label>FECHA COMPRA</label><input type="text" size="8" name="fechadeuda" id="fechadeuda"/></td>
           <td><label>NOMBRE CLIENTE</label><input type="text" size="50" name="cliente_deuda" id="cliente_deuda"/>
            <input type="hidden" name="id_clientes" id="id_clientes"/>
           </td>
           <td><label>DESCRIPCION</label><input type="text" size="20" name="descrip_deuda" id="descrip_deuda"/></td>
           <td><label>MONTO</label><input type="text" size="12" name="monto_deuda" id="monto_deuda"/></td>
           <td><label>MONEDA</label><input type="text" size="5" name="monedadeuda" id="monedadeuda"/></td>
           </tr>
           
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
                            <th>Cantidad<br />Devuelta</th>
                            <th>P/Unitario <br /><th>
                            <th>Precio <br />ToTal</th>
                          
                       
                        </tr>
                   
                    <tbody  id="campos">
                  
                    	
                     
                    </tbody>
                    <tfoot>
                     <tr style=" background-color:#FFC">
                     
                    
                 
                     <TD colspan="2"></TD>
                     
                        <td align="right" > </td>
                       
                    
                     <td  align="right" ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total2" class="inp2-form" id="cant_total2"  /></td>
                     <td colspan="2"></td>
                     
                        <td align="right"  > <input style="text-align:right" name="monto_total2"  value="0"size="10"  class="inp2-form" readonly  id="monto_total2" /></td>
                        
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
         
         <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=devoluciones';"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />


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