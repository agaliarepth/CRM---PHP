<?php require_once("head.php");?>
 <script type="text/javascript">
 
 var total_devolucion=<?php echo $devolucion["total"];?>;
 var idcliente=<?php echo $devolucion["idcliente"];?>;
 var total_filas=0;
 var nextinput=0;
 var nextinput2=0;
 var total=0;
 var array=new Array();
 var tipo=1;
 var idventa=<?php echo $devolucion["idventas"];?>;

  $(document).ready(function($)
  {
	<?php if($devolucion["tipodevolucion"]=="venta"){?>
	rellenarVentas();
	<?php }?>
	$("#devoContado").change(function(){
		if($(this).is(':checked')){
			 $("#buscarVenta").css( "display", "block");
			 $("#descontar").val(1);
			
			}
			else{
				 $("#buscarVenta").css( "display", "none");
				 $("#descontar").val(0);
				}
		
		});
	  
	  });
	  
	 

 function rellenarVentas(){
	 
		 
		
		  $.ajax({
					 
                              type: "POST",
                              url: "ajax/Buscarcuotas.php",
                              data: "id="+idventa,
                              dataType: "json",
                              error: function(){
                                    alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								    if(data!=false){
										
                                    if(nextinput2>0 && array.indexOf(data[0].ventas_idventas) != -1){
	
	                                	alert("ERROR::La Nota de Venta:"+array[array.indexOf(data[0].ventas_idventas)]+" Ya se Agrego.");
	
	
	                                    }
										else{
										var fila="<tr class='"+data[0].ventas_idventas+"' align='center' style='background-color:#333; color:#FFF; '><td colspan='6'>NOTA DE VENTA::"+data[0].ventas_idventas+"</td></tr>";
							$("#cuotas").append(fila);			
							array[nextinput2]=data[0].ventas_idventas;
							nextinput2++;
										for(f=0;f<=data.length;f++){
											
											addRow(data[f].numpago,data[f].fecha,data[f].saldo_inicial,data[f].saldo_actual,data[f].creditoVentas_idcreditoVentas,data[f].ventas_idventas,data[f].idcuotas);
											
										
											
										}
										}
									}
								
									else  {
										 alert("LA VENTA:: "+valor+":: NO SE  ENCUENTRA REGISTRADO...");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
				 
		}
		
		 
	
		
		function addRow(numcuota,fecha,montocuota,saldo,idcreditoVentas,idventa,idcuota){
			
			fila= '<tr id="fila' + nextinput + '" class="'+idventa+'"><td width="10px"><input style="text-align:center" type="text"  readonly ="readonly" size="10" id="numcuota' + nextinput + '"  name="numcuota[]' + nextinput + '" value="'+numcuota+'"  /></td><td><input  style="text-align:left"type="text"  readonly ="readonly"  size="15" id="fecha ' + nextinput + '"  name="fecha[]' + nextinput + '" value="'+fecha+'"  /></td><td><input style="text-align:right" type="text"   readonly ="readonly"  size=8" id="montocuota' + nextinput + '"  name="montocuota[]' + nextinput + '"  readonly ="readonly" value="'+montocuota+'"  /></td><td><input style="text-align:right" type="text"  size="5" id="saldo' + nextinput + '"  name="saldo[]' + nextinput + '"  value="'+saldo+'"  /></td><td><input style="text-align:right" type="text" readonly ="readonly"    size=8" id="montodevo' + nextinput + '"  name="montodevo[]' + nextinput + '" value="0" onchange="validarMonto(this);" /></td><td><input   type="checkbox" id="elegido' + nextinput + '" onchange="chequeo(this);" name="elegido[]"  value="'+nextinput+'" /><input type="hidden"  id="idcreditoVentas' + nextinput + '"  name="idcreditoVentas[]' + nextinput + '" value="'+idcreditoVentas+'"  /><input type="hidden"  id="monto_original' + nextinput + '"   name="monto_original[]' + nextinput + '" value="'+montocuota+'"  /><input type="hidden"  id="idcuotas' + nextinput + '"  name="idcuotas[]' + nextinput + '" value="'+idcuota+'"  /></td></tr>';
	
	
	
$("#cuotas").append(fila);

          total_filas++;
		  $("#total_filas").val(total_filas);

			nextinput++;
	
			}
			
			function rellenarVentasContado(){
	 
		  var idventa=$("#notaventa").val();
		   //alert(idventa);
		
		  $.ajax({
					 
                              type: "POST",
                              url: "ajax/BuscarcuotasClientes.php?cli="+$("#idclientes").val(),
                              data: "id="+idventa,
                              dataType: "json",
                              error: function(){
                                    alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								    if(data!=false){
										
										
                                    if(nextinput2>0 && array.indexOf(data[0].ventas_idventas) != -1){
	
	                                	alert("ERROR::La Nota de Venta:"+array[array.indexOf(data[0].ventas_idventas)]+" Ya se Agrego.");
	
	
	                                    }
										else{
										var fila="<tr class='"+data[0].ventas_idventas+"' align='center' style='background-color:#333; color:#FFF; '><td colspan='5'>NOTA DE VENTA::"+data[0].ventas_idventas+"</td><td><img src='images/eliminar.png' width='25' height='25' alt='Eliminar'  onclick='if(confirm(\"Realmente desea eliminar este detalle?\")){eliminarDetalle("+data[0].ventas_idventas+"); }'/></td></tr>";
							$("#cuotas").append(fila);			
							array[nextinput2]=data[0].ventas_idventas;
							nextinput2++;
										for(f=0;f<=data.length;f++){
											
											addRow(data[f].numpago,data[f].fecha,data[f].saldo_inicial,data[f].saldo_actual,data[f].creditoVentas_idcreditoVentas,data[f].ventas_idventas,data[f].idcuotas);
										
										             				
									           	                 }
										}//FIN ELSE
									}
								
									else  {
										 alert("LA VENTA:: "+idventa+" :: NO SE  ENCUENTRA REGISTRADA A ESTE CLIENTE");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
				 
		}
		
		 
	
		
			
			function eliminarDetalle(c){
				
				var idx=array.indexOf(c);
				
	           if(idx==-1) array.splice(idx, 1);
                 nextinput2 =nextinput2-1;
				$("."+c).remove();
                 calcularTotal();
				}
			
			  function validarMonto(c){
	  var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test(c.value);
	  var s= $("#"+c.id).parent().parent().find("input").eq(3).val();
	 if(resultado!=false){
		
		 
		  calcularTotal();
	 	 if(total>total_devolucion){
         
		 
			 
			 alert("ERROR::SOBREPASO EL MONTO DE DEVOLUCION");
			 $("#"+c.id).parent().parent().find("input").eq(4).val(0);
			 $("#"+c.id).parent().parent().find("input").eq(5).attr('checked',false);
 			 $("#"+c.id).parent().parent().css( "background-color", "");

			 calcularTotal();

		 }
		if(parseFloat(c.value)>parseFloat( total_devolucion)){
			 alert("ERROR::EL MONTO NO PUEDE SER MAYOR  A: "+total_devolucion);
			 $("#"+c.id).parent().parent().find("input").eq(4).val( 0);
			 $("#"+c.id).parent().parent().find("input").eq(5).attr('checked',false);
 			 $("#"+c.id).parent().parent().css( "background-color", "");

			 calcularTotal();
			
			}
			if(parseFloat(c.value)>s){
				alert("ERROR::EL MONTO NO PUEDE SER MAYOR  Al SALDO RESTANTE: "+s);
				 $("#"+c.id).parent().parent().find("input").eq(4).val( 0);
			 $("#"+c.id).parent().parent().find("input").eq(5).attr('checked',false);
 			 $("#"+c.id).parent().parent().css( "background-color", "");

			 calcularTotal();
				}
		
		

	 }
	 else{
			 $("#"+c.id).parent().parent().find("input").eq(4).val(0);

		 }
		 //alert(total);
	   }
	   
	   function chequeo(v){
		
		  var f=$("#"+v.id).parent().parent().attr("id");
		  
			  if($("#"+v.id).is(':checked')){ 
			  //alert(	$("#"+v.id).parent().parent().find("input").eq(7).val());
	       
			$("#"+v.id).parent().parent().find("input").eq(4).focus();
		 $("#"+v.id).parent().parent().find("input").eq(4).removeAttr("readonly");

	        $("#"+f).css( "background-color", "red");
		
			   return false;
			  } 
			  else{
			 
			 $("#"+f).css( "background-color", "");
			 $("#"+v.id).parent().parent().find("input").eq(4).attr("readonly","true");
			 $("#"+v.id).parent().parent().find("input").eq(4).val(0);
			 
			   return false;
				  }
			 }
			 
			 function calcularTotal(){
				
				 total=0;
				  $('#cuotas tr').each(function () {
					   if($(this).find("input").eq(5).is(':checked')){
			   
			             total=total+parseFloat($(this).find("input").eq(4).val());

					   }
			   
			   });
				 
				 }
				 
				
		
				 function validarFormulario(){
				//	alert($("#tipodevolucion").val());
				//	alert($("#total_filas").val());
					 if($("#tipodevolucion").val()=="venta" ){
						 
						 if($("#tipoventa").val()=="CREDITO" || $("#descontar").val()==1){
						 if(total>total_devolucion)
						 return;
						 /*if(total!=total_devolucion){
						 alert("ERROR:: NO SE  COMPLETO EL MONTO DE LA DEVOLUCION: "+total_devolucion);
						 return;
						 }*/
						 }
						 if(confirm(" SE PROCESARA LA DEVOLUCION.. DESEA CONTINUAR .?"))
					
					     document.form.submit();
				
				         else
				         return;
					 
					 }
					
					  if($("#tipodevolucion").val()=="deuda" ){
					 
					 if(confirm(" SE PROCESARA LA DEVOLUCION.. DESEA CONTINUAR .?"))
					
					     document.form.submit();
				
				         else
				         return;
					  }
					 
					 }
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
          
            <div>
           <b> PROCESAR DEVOLUCION </b>
            </div>
            <hr />
            <form  action="" method="post" name="form" class="notas" >
            <table border="1" width="50%" >
            
            <thead style="background-color:#06C;color:#CF0; font-weight:bold; ">
            <tr>
            <td colspan="6" align="center">
            DEVOLUCION VENTA
            </td>
            
            </tr>
            <tr>
            <th>CODIGO </th>
            <th>TITULO </th>
            <th>TOMO </th>
            <th>CANTIDAD </th>
            <th>P.UNIT </th>
            <th>P.TOTAL </th>
            </tr>
            </thead>
            <tbody style="background-color:#FFF">
            <?PHP foreach($detalle as $v){?>
            <tr>
            <td><?php echo $v["codigo"]; ?></td>
             <td><?php echo utf8_encode($v["titulo"]); ?></td>
              <td align="center"><?php echo $v["tomo"]; ?></td>
               <td align="center"><?php echo $v["cantidad"]; ?></td>
              <td align="right"><?php echo $v["precio_unit"]; ?></td>
               <td align="right"><?php echo $v["precio_total"]; ?></td> 
               </tr>
               <?php }?>
               
             <tfoot style="background-color:#06C;color:#CF0; font-weight:bold; ">
             <tr>
             <td colspan="3">TOTAL</td>
             <td align="center"><?php echo $devolucion["cantidad"];?></td>
             <td></td>
             <td align="right"><?php echo $devolucion["total"];?></td>
             
             </tr>
             </tfoot>
            </tbody>
            
            </table>
            
              <br />
              <?Php if($devolucion["tipodevolucion"]=="deuda"){?>
			  
			  <table border="1" width="50%">
            <THEAD>
            <tr style="background-color:#06C;color:#CF0; font-weight:bold; "><td colspan="4" align="center">DETALLE DEUDA POR COBRAR</td></tr>
            <TR style="background-color:#FFF;">
            <td>
            <b>CODIGO DEUDA:</b><?php  echo $deudas["iddeudas"]?>
                       </td>
            <td><b>DESCRIPCION:</b><?php echo $deudas["descripcion"];?></td>
            <td><b>CLIENTE:</b><?php echo $deudas["nombre_cliente"];?></td>
           
           
            <td><b>FECHA VENTA:</b> <?php echo $deudas["fecha"];?></td>
            </TR>
            <TR style="background-color:#FFF;">
             <td><b>MONTO:</b> <?php echo $deudas["saldo"];?></td>
             <td><b>MONEDA:</b> <?php echo $deudas["moneda"];?></td>
          </TR>
            </THEAD>
            
            </table>
            
			  
			  
			  
			  <?php }?>
              <?Php if($devolucion["tipodevolucion"]=="venta"){?>
            <table border="1" width="50%">
            <THEAD>
            <tr style="background-color:#06C;color:#CF0; font-weight:bold; "><td colspan="3" align="center">DETALLE VENTA</td></tr>
            <TR style="background-color:#FFF;">
            <td>
            <b>NOTA DE VENTA:</b><?php  echo $venta["idventas"]?>
            <a  href="#"><img src="<?php echo config::ruta();?>images/consultar.png" width="25" height="25" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $venta["idventas"];?>');"/></a>
            </td>
            <td><b>CLIENTE:</b><?php echo $venta["nombre"];?></td>
           
           
            <td><b>FECHA VENTA:</b> <?php echo $venta["fecha"];?></td>
            </TR>
            <tr style="background-color:#FFF;">
             <td><b>TIPO VENTA:</b> <?php echo $venta["tipoventa"];?></td>
              <td><b>MONTO :</b> <?php echo $venta["total"];?></td>
               <td><b>MONEDA :</b> <?php echo $venta["moneda"];?></td>
          </TR>
            </THEAD>
            
            </table>
            
          <?PHP if ($venta["tipoventa"]=="CREDITO"){?>
          
          <p>&nbsp;</p>
            <table border="1" width="50%">
            <thead>
            <tr>
           
            </tr>
            <tr align="center" style="background-color:#06C;color:#CF0; font-weight:bold; ">
            <td>NUM CUOTA </td>
            <td>FECHA</td>
            <td>MONTO <BR /></td>
            <td>SALDO <BR />ACTUAL</td>
            <td>MONTO  DE <BR />DEVOLUCION</td>

            <td>SELECC<BR />IONAR</td>
            </tr>
            </thead>
            <tbody id="cuotas">
            
            </tbody>
            </table>
            <p>&nbsp;</p>
            <?php }}?>
            <?PHP if ($venta["tipoventa"]=="CONTADO"){?>
			<table width="100%">
            <tr style="background-color:#333;color:#FC0;">
            <td><input   type="checkbox" id="devoContado" name="devoContado"/><img  src="<?php echo config::ruta();?>/images/money.png" /><b> REALIZAR  DESCUENTOS A DEUDAS DE VENTAS</b></td>
            </tr>
            
            </table>
			<fieldset id="buscarVenta" style="display:none"><legend>Buscar Venta</legend>
            <table>
            <tr>
              <td><label>NUM  VENTA</label><input  type="text" size="10" id="notaventa" name="notaventa"/></td>
            <td><input type="button" value="Buscar"  name="buscar" id="bconsultar" onClick="rellenarVentasContado();"/></td>
            </tr>
            
            </table>
            
            
           
			 <table border="1" width="50%"
             >
            <thead>
            <tr>
           
            </tr>
            <tr align="center" style="background-color:#06C;color:#CF0; font-weight:bold; ">
            <td>NUM CUOTA </td>
            <td>FECHA</td>
            <td>MONTO <BR /></td>
            <td>SALDO <BR />ACTUAL</td>
            <td>MONTO  DE <BR />DEVOLUCION</td>

            <td>SELECC<BR />IONAR</td>
            </tr>
            </thead>
            <tbody id="cuotas">
            
            </tbody>
            </table>
             </fieldset>
			<?php }?>
            <table>
           
           <tr>
           <td><input  type="button" value="Procesar" id="bProcesar" name="procesar" onclick="validarFormulario();"/></td>
           <td><input  type="button" value="Cancelar" id="cancelar" name="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=devoluciones';"/>
           <input type="hidden" name="procesar" id="procesar" value="procesar"/>
            <input type="hidden" name="idingreso" id="idingreso" value="<?php echo $devolucion["idingreso"];?>"/>
            <input type="hidden" name="iddevolucion" id="iddevolucion" value="<?php echo $devolucion["iddevolucion"];?>"/>
            <input type="hidden" name="idventas" id="idventas" value="<?php echo $devolucion["idventas"];?>"/>
            <input type="hidden" name="iddeudas" id="iddeudas" value="<?php echo $devolucion["iddeudas"];?>"/>
            <input type="hidden" name="tipodevolucion" id="tipodevolucion" value="<?php echo $devolucion["tipodevolucion"];?>"/>
            <input type="hidden" name="idclientes" id="idclientes" value="<?php echo $devolucion["idcliente"];?>"/>
              <input type="hidden" name="tipoventa" id="tipoventa" value="<?php echo $venta["tipoventa"];?>"/>
            <input type="hidden" name="total_filas" id="total_filas" value=""/>
            <input type="hidden" name="descontar" id="descontar" value=""/>
            
           
           </td>
           
           </tr>
           
          
            </table>
            </form>
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
             
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>