<?php require_once("head.php");?>
<script type="text/javascript">
var saldo_actual;
var error=false;
  function buscarCredito(){
		  var valor=$("#venta").val();
		
		  $.ajax({
					  
                              type: "POST",
                              url: "ajax/buscarCredito.php",
                              data: "id="+valor,
                              dataType: "json",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  
								    if(data!=false){
										
										  $("#campos tr").remove();
										  $("#cuotas tr").remove();

										var fila="<tr style='background-color:#333; color:#FFF;'><td>SALDO INICIAL</td><td>SALDO ACTUAL</td><td>NUMERO CUOTAS</td><td>MONTO CUOTAS</td><td>DIAS PAGO</td><td>DIAS DE GRACIA</td></tr>";
										fila+="<td>"+data[0].saldo_inicial+"</td>";
										fila+="<td>"+data[0].saldo_actual+"</td>";
										fila+="<td>"+data[0].num_cuotas+"</td>";
										fila+="<td>"+data[0].monto_cuotas+"</td>";
										fila+="<td>"+data[0].diaspago+"</td>";
										fila+="<td>"+data[0].dias+"</td>";
										  fila+="</tr>";
										  $("#campos").append(fila); 
										  fila="";
											
	                                 $("#idventas").val(data[0].ventas_idventas);
									 $("#idcredito").val(data[0].idcreditoVentas);
									  $("#cliente").val(data[0].nombre);
									  //$("#wizard").css({ display: "block"});
									  saldo_actual=data[0].saldo_actual;
	                                 listarCuotas(data[0].idcreditoVentas);
									 //alert( $("#idventas").val());
									  
									}
								
									else  {
										 alert("LA VENTA:: "+valor+":: NO SE  ENCUENTRA REGISTRADO...");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
		}
		
		function listarCuotas(idcredito){
			  $.ajax({
					  
                              type: "POST",
                              url: "ajax/listarCuotas.php",
                              data: "id="+idcredito,
                              dataType: "json",
                              error: function(){
                                    alert("NO SE ENCONTRARON CUOTAS");
                              },
                              success: function(data){
								  var fila="<TR style='background-color:#333; color:#FFF;'><td  colspan=5 align='center'>PLAN DE PAGOS</td></TR><tr style='background-color:#333; color:#FFF;'><td>Num Pago</td><td>Fecha Vencimiento</td><td>Monto</td><td>Saldo Actual</td><td>Acciones</td></tr>";
								    if(data!=false){
										 
										 
										for (var i=0; i<data.length;i++){
											
											
										fila+="<tr>"
										fila+="<td><input type='hidden' size='10'; value='"+data[i].idcuotas+"'/><input type='text' size='5' value='"+data[i].numpago+"'/></td>";
										fila+="<td><input type='text'  value='"+data[i].fecha+"'/></td>";
										fila+="<td><input type='text' size='5' value='"+data[i].saldo_inicial+"'/></td>";
										fila+="<td><input type='text' size='5' value='"+data[i].saldo_actual+"'/></td>";
									
										if(data[i].saldo_actual<=0)
										fila+="<td style='font-size:10px; background:#44;'>CUOTA CANCELADA</td>"; 
										else 
										fila+="<td><input type='hidden' value='"+data[i].creditoVentas_idcreditoVentas+"'/> <input type='button'  name='b"+i+"' id='b"+i+"' value='Registrar Pago' onclick='pagar(this);'/></td>";
										  fila+="</tr>";
										  $("#cuotas").append(fila);
										  
											fila="";
											//alert(data.length);
											}
											
										  
									}
								
									else  {
										
										fila+="<tr >"
										fila+="<td colspan='5'>NO EXISTEN PAGOS REGISTRADOS</td>";
										fila+="</tr>";
										  $("#cuotas").append(fila);
										  
											fila="";
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
			
			
			}
			
			function pagar(b){
				
				//alert($("#"+b.id).parent().parent().find("input").eq(0).val());
				$("#idcuotas").val($("#"+b.id).parent().parent().find("input").eq(0).val());
				saldo_actual=$("#"+b.id).parent().parent().find("input").eq(4).val();
				$("#wizard").css({ display: "block"});
				$("#numpago").val($("#"+b.id).parent().parent().find("input").eq(1).val());
			    $("#idcredito").val($("#"+b.id).parent().parent().find("input").eq(5).val())
                 $("#monto").val($("#"+b.id).parent().parent().find("input").eq(4).val())
				//alert($("#idcredito").val());
				
				}
		function listarPagos(idventas){
			  $.ajax({
					  
                              type: "POST",
                              url: "ajax/listarPagos.php",
                              data: "id="+idventas,
                              dataType: "json",
                              error: function(){
                                    alert("NO SE ENCONTRARON PAGOS");
                              },
                              success: function(data){
								  var fila="<TR style='background-color:#333; color:#FFF;'><td  colspan=5 align='center'>HISTORIAL PAGOS</td></TR><tr style='background-color:#333; color:#FFF;'><td>Num Pago</td><td>Monto Pago</td><td>Fecha</td><td>Num Factura</td><td>Num Recibo</td></tr>";
								    if(data!=false){
										 
										 
										for (var i=0; i<data.length;i++){
											
											
										fila+="<tr>"
										fila+="<td>"+data[i].numnpago+"</td>";
										fila+="<td>"+data[i].monto+"</td>";
										fila+="<td>"+data[i].fecha+"</td>";
										fila+="<td>"+data[i].numfactura+"</td>";
										fila+="<td>"+data[i].numrecibo+"</td>";
										  fila+="</tr>";
										  $("#pagos").append(fila);
										  
											fila="";
											//alert(data.length);
											}
											
										  
									}
								
									else  {
										
										fila+="<tr >"
										fila+="<td colspan='5'>NO EXISTEN PAGOS REGISTRADOS</td>";
										fila+="</tr>";
										  $("#pagos").append(fila);
										  
											fila="";
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
			}
		function dos_decimales(cadena){
var expresion=/^\d+(\.\d{0,2})?$/;
var resultado=expresion.test(cadena);
return resultado;
}
function validarDecimal(campo){

if(dos_decimales(campo) !== true){
return false;
}
else
return true;
}

 $(document).ready(function($)
  {
	  
	   <?php if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="editar"){
if(isset($res5["iddescuentoPago"])){
	  echo "$('#descuento').prop('checked','true');";
	  echo "$('#tienedescuento').val(1);";
	   }}?>
	    $("#descuento").change(function(){
		
		if($(this).prop("checked")){
			
		$("#tabladescuento").css({ display: "block"});
		$("#tienedescuento").val(1);

			}
			else
			{
				$("#tabladescuento").css({ display: "none"});
				$("#tienedescuento").val(0);
				
				}
		});
		
		
		  $("#montodescuento").change(function(){
		
		  if(!$("#montodescuento").val().match(/^(\d{1}\.)?(\d+\.?)+(,\d{2})?$/)){
			 $("#montodescuento").val("0");
			 $("#montodescuento").focus();
			 }
			 var s= parseFloat( $("#montodescuento").val())+parseFloat($('#monto').val());
			 var saldo=parseFloat($('#saldo_actual').val());
			 if(s>saldo){
				  alert("ERROR::EN EL MONTO DEL DESCUENTO");
				 $("#montodescuento").val("0");
			 $("#montodescuento").focus(); 
				 }
		});
		
		
	   $("#tipopago").change(function(){
		  
		 if($(this).val()=="DEPOSITO"){
			 $("#cuentabanco").css({ display: "block"});
			 
			 
			 }
			 else 
			 $("#cuentabanco").css({ display: "none"});
		   $("#cuentabanco").val("");
		  });
	   $('#monto').change(function () {
		   if(!validarDecimal($(this).val()))
		   {
		   alert("ERROR::monto de Pago");
		    $('#monto').val(0);
			 $('#monto').focus();
		    error=true;
		   }
		   if(parseFloat($(this).val())>parseFloat($("#saldo_actual").val())){
			    alert("ERROR::el monto del pago no puede Ser mayor al Saldo que se debe::"+$("#saldo_actual").val());
				$('#monto').val(0);
			 $('#monto').focus();
			     error=true;
			   }
			   else{
				   error=false;
				   }
	   });
	   
	    $('#numpago').change(function () {
		   if(!validarDecimal($(this).val()))
		   {
		   alert("ERROR::Numero de Pago");
		    $('#numpago').val(0);
			 $('#numpago').focus();
		      error=true;
		   }
		   else{
			   error=false;
			   /* $.ajax({
					  
                              type: "POST",
                              url: "ajax/buscarPago.php",
                              data: "id="+$('#numpago').val(),
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  
								    if(data!=false){
								
									  
									
	                                 
									  
									}
								
									else  {
										 alert("LA VENTA:: "+valor+":: NO SE  ENCUENTRA REGISTRADO...");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
			   */
			   
			   
			   
			   }
	   });
  });// fin ready
  function validarFormu(){
	  if(error){
		  alert("NO SE PUEDE REGISTRAR EL PAGO EXISTE ERRORES:: REVISE EL FORMULARIO");
		  
		  }
		  else
		  {
			  
			  if(confirm('Se Registrara El Pago desea Continuar..???'))
			document.form.submit();
			  }
	  
	  }
		</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            	<?php if(isset($_GET["id"])&& isset($_GET["e"])&&$_GET["e"]=="editar"){?>
                 <h2 id="contact">COBRANZAS > EDITAR  PAGO CUOTA</h2>
            <div>
           <TABLE border="1">
           <tr style="background-color:#333; color:#FFF">
           <td colspan="7" align="center">DETALLE DEL  CREDITO</td>
           </tr>
           <tr style="background-color:#333; color:#FFF; font-size:11px;">
           <td>NOTA DE VENTA</td>
           <td>FECHA DE VENTA</td>
           <td>NUMERO DE CUOTAS</td>
           <td>DIAS DE CREDITO</td>
           <td>MONTO  TOTAL</td>
           <td>SALDO ACTUAL</td>
           <td>MONEDA</td>

           </tr >
           <tr style="background-color:#fff; color:#333; text-align:center">
           <td><a href="#" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $res2["ventas_idventas"];?>');"><?php echo "10-".Helpers::rellenarCeros($res2["ventas_idventas"],6);?></a></td>
          <td><?php echo date("d-m-Y",strtotime($fecha));?></td>
           <td><?php echo $res2["num_cuotas"]?></td>
           <td><?php echo $res2["diaspago"]?></td>
           <td><?php echo $res2["saldo_inicial"]?></td>
           <td><?php echo $res2["saldo_actual"]?></td>
           <td><?php echo $res3["moneda"]?></td>

           </tr>
           </TABLE>
           <form action="" method="post"  class="notas" name="form" id="wizard">
            
            <fieldset> <legend>DATOS DEL PAGO</legend>
            <table border="0">
            <tr>
            <td colspan="3"><label>Cliente</label><input  name="cliente" size="50" id="cliente" type="text" readonly value="<?php echo $res3["nombre"]?>"/></td>
           
            <td><label>Numero de Pago</label><input value="<?php echo $res["numpago"]?>" type="text" name="numpago"   readonly="readonly" size="3"id="numpago" />
               
               </td>
               <td><label>Saldo Inicial</label><input value="<?php echo $res["saldo_inicial"]?>" type="text" name="saldo_inicial"   readonly="readonly" size="10"id="saldo_inicial" />
               
               </td>
               <td><label>Saldo Actual</label><input value="<?php echo $res["saldo_actual"]?>" type="text" name="saldo_actual"   readonly="readonly" size="10"id="saldo_actual" />
               
               </td>
              
               </tr>
               <tr>
            <td><label>Monto Pago</label><input  type="text"  size="15"name="monto"  value="<?php echo $res4["monto"] ?>"id="monto"/></td>
             <td><label>Fecha del Pago</label><input  type="text" value="<?php echo date("d-m-Y",strtotime($res4["fecha"]));  ?>" class="fechas" id="fecha" name="fecha"/></td>
              <td><label>Num Factura</label><input  type="text" size="15" name="numfactura" value="<?php echo $res4["numfactura"] ?>" style="text-transform:uppercase"id="numfactura"/></td>
              <td><label>Num Recibo</label><input  type="text" size="15" name="numrecibo" value="<?php echo $res4["numrecibo"] ?>" style="text-transform:uppercase"id="numrecibo"/></td>
               <td><label>Tipo Pago</label><select name="tipopago" id="tipopago" >
               <option <?php if($res4["tipopago"]=="EFECTIVO"){?> selected="selected"<?php }?>value="EFECTIVO">EFECTIVO</option>
               <option <?php if($res4["tipopago"]=="DEPOSITO"){?> selected="selected"<?php }?>value="DEPOSITO">DEPOSITO</option>
               </select>
               </td>
               <td colspan="2">
                     <label>BANCO-NUMERO DE CUENTA</label>
                     <input style=" text-transform:uppercase" type="TEXT" name="cuentabanco"  size="50" id="cuentabanco" value="<?php echo $res4["cuentabanco"] ?>" <?php if($res4["tipopago"]=="DEPOSITO"){?>style="text-transform:uppercase; display:block"<?php } else{?>style="text-transform:uppercase; display:none" <?php }?> />
                     </td>
            </tr>
            </table>
            </fieldset>
            <fieldset><legend><input type="checkbox"  value="0"  id="descuento"/>DESCUENTO</legend>
                     <table  id="tabladescuento" <?php if(isset($res5["iddescuentoPago"])){?>style="display:block;"<?php } else{ ?>style="display:none;"<?php }?>>
                     <TR>
                     
                    
                    <td>
                     <label>Monto del Descuento</label>
                     <input  type="text" id="montodescuento" name="montodescuento" value="<?php echo $res5["monto"];?>"/>
                     </td>
                     <td>
                     <label>Descripcion Del Descuento</label>
                     <input  type="text"  size="50"id="descripciondescuento" name="descripciondescuento"  style="text-transform:uppercase"value="<?php echo $res5["descripcion"];?>"/>
                     </td>
                     </TR>
                     
                     </table>
                     
                     
                     </fieldset>
            <table>
            <tr>
		<th>&nbsp;</th>
		<td valign="top" colspan="3">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar"  onclick="validarFormu();"/>
            <input type="hidden" name="editar" value="editar"/>
             <input type="hidden" name="idventas"  id="idventas" value="<?php echo $res2["ventas_idventas"];?>"/>
             <input type="hidden" name="cuotas_idcuotas" id="cuotas_idcuotas"  value="<?php echo $res["idcuotas"] ?>"/>
             <input type="hidden" name="idcredito" id="idcredito"  value="<?php echo $res2["idcreditoVentas"]?>"/>
             <input type="hidden" name="valorcambio" id="valorcambio" value="<?php echo $tc2["valor"];?>" />
             <input type="hidden" name="idpago" id="idpago" value="<?php echo $res4["idpagoVentasCredito"];?>" />
             <input type="hidden" name="iddescuento" id="iddescuento" value="<?php echo $res5["iddescuentoPago"];?>" />
             <input type="hidden" name="clientes_idclientes" id="clientes_idclientes" value="<?php echo $res3["clientes_idclientes"];?>" />
              <input type="hidden" name="moneda" id="moneda" value="<?php echo $res3["moneda"];?>" />
               <input type="hidden" name="tienedescuento" id="tienedescuento"  <?php if(count($res5)>0){?>value="0"  <?php } else{?> value="0" <?php }?>/>


			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=pagos';" />
		</td>
		<td></td>
	</tr>
            
            </table>
            </fieldset>
            </form>
                <?php }else {?>
				
				 <h2 id="contact">COBRANZAS > REGISTRAR PAGO CUOTA</h2>
            <div>
           <TABLE border="1">
           <tr style="background-color:#333; color:#FFF">
           <td colspan="7" align="center">DETALLE DEL  CREDITO</td>
           </tr>
           <tr style="background-color:#333; color:#FFF; font-size:11px;">
           <td>NOTA DE VENTA</td>
            <td>FECHA DE VENTA</td>
           <td>NUMERO DE CUOTAS</td>
           <td>DIAS DE CREDITO</td>
           <td>MONTO  TOTAL</td>
           <td>SALDO ACTUAL</td>
           <td>MONEDA</td>

           </tr >
           <tr style="background-color:#fff; color:#333; text-align:center">
            <td><a href="#" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $res2["ventas_idventas"];?>');"><?php echo "10-".Helpers::rellenarCeros($res2["ventas_idventas"],6);?></a></td>
            <td><?php echo date("d-m-Y",strtotime($fecha));?></td>
           <td><?php echo $res2["num_cuotas"]?></td>
           <td><?php echo $res2["diaspago"]?></td>
           <td><?php echo $res2["saldo_inicial"]?></td>
           <td><?php echo $res2["saldo_actual"]?></td>
           <td><?php echo $res3["moneda"]?></td>

           </tr>
           </TABLE>
           <form action="" method="post"  class="notas" name="form" id="wizard">
            
            <fieldset> <legend>DATOS DEL PAGO</legend>
            <table border="0">
            <tr>
            <td colspan="3"><label>Cliente</label><input  name="cliente" size="50" id="cliente" type="text" readonly value="<?php echo $res3["nombre"]?>"/></td>
           
            <td><label>Numero de Pago</label><input value="<?php echo $res["numpago"]?>" type="text" name="numpago"   readonly="readonly" size="3"id="numpago" />
               
               </td>
               <td><label>Saldo Inicial</label><input value="<?php echo $res["saldo_inicial"]?>" type="text" name="saldo_inicial"   readonly="readonly" size="10"id="saldo_inicial" />
               
               </td>
               <td><label>Saldo Actual</label><input value="<?php echo $res["saldo_actual"]?>" type="text" name="saldo_actual"   readonly="readonly" size="10"id="saldo_actual" />
               
               </td>
               
               </tr>
               <tr>
            <td><label>Monto Pago</label><input  type="text"  size="15"name="monto" id="monto" value="0"/></td>
             <td><label>Fecha del Pago</label><input  type="text" value="<?PHP echo date("d-m-Y");?>" class="fechas" id="fecha" name="fecha"/></td>
              <td><label>Num Factura</label><input  type="text" size="15" name="numfactura"  style="text-transform:uppercase"id="numfactura"/></td>
              <td><label>Num Recibo</label><input  type="text" size="15" name="numrecibo"  style="text-transform:uppercase"id="numrecibo"/></td>
               <td><label>Tipo Pago</label><select name="tipopago" id="tipopago" >
               <option value="EFECTIVO">EFECTIVO</option>
               <option value="DEPOSITO">DEPOSITO</option>
               </select>
               </td>
               <td colspan="2">
                     <label>BANCO-NUMERO DE CUENTA</label>
                     <input type="TEXT" name="cuentabanco"  size="50" id="cuentabanco" style="text-transform:uppercase; display:none" />
                     </td>
            </tr>
            </table>
            </fieldset>
            <fieldset><legend><input type="checkbox"  value="0"  id="descuento"/>DESCUENTO</legend>
                     <table  id="tabladescuento" style="display:none;">
                     <TR>
                     
                    
                    <td>
                     <label>Monto del Descuento</label>
                     <input  type="text" id="montodescuento" name="montodescuento" value="0"/>
                     </td>
                     <td>
                     <label>Descripcion Del Descuento</label>
                     <input  type="text"  size="50"id="descripciondescuento"  style="text-transform:uppercase"name="descripciondescuento" value=""/>
                     </td>
                     </TR>
                     
                     </table>
                     
                     
                     </fieldset>
            <table>
            <tr>
		<th>&nbsp;</th>
		<td valign="top" colspan="3">
			<input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar"  onclick="validarFormu();"/>
            <input type="hidden" name="enviar" value="enviar"/>
             <input type="hidden" name="idventas"  id="idventas" value="<?php echo $res2["ventas_idventas"];?>"/>
             <input type="hidden" name="tienedescuento" id="tienedescuento"  value="0"/>

             <input type="hidden" name="cuotas_idcuotas" id="cuotas_idcuotas"  value="<?php echo $res["idcuotas"] ?>"/>
             <input type="hidden" name="idcredito" id="idcredito"  value="<?php echo $res2["idcreditoVentas"]?>"/>
             <input type="hidden" name="valorcambio" id="valorcambio" value="<?php echo $tc2["valor"];?>" />
             <input type="hidden" name="moneda" id="moneda" value="<?php echo $res3["moneda"];?>" />
                             

             <input type="hidden" name="clientes_idclientes" id="clientes_idclientes" value="<?php echo $res3["clientes_idclientes"];?>" />


			<input type="button" value="Cancelar" id="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=addPagos&id=<?php  echo $res3["clientes_idclientes"]; ?>';" />
		</td>
		<td></td>
	</tr>
            
            </table>
            </fieldset>
            </form>
				<?php }?>

           

            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>