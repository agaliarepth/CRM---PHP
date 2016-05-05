<?php require_once("head.php");?>
 <script type="text/javascript">
 
 var total_devolucion=<?php echo $monto["total"];?>;
 var idcliente=<?php echo $monto["idcliente"];?>;
 var total_filas=0;
 var nextinput=0;
 var nextinput2=0;
 var total=0;
 var array=new Array();
 var tipo=1;

  $(document).ready(function($)
  {
	  
	  $("#valorDevolucion").val(total_devolucion);
	  
	    $("#tipo").change(function(){
		   if($("#tipo").val()=="credito")tipo=1;
		   if($("#tipo").val()=="contado")tipo=2;
		   if($("#tipo").val()=="deuda")tipo=3;
			   
			 
		   
		   }); 
	  
	  });
	  
	 
	function rellenarContado(){
	 
		  var idventa=$("#notaventa").val();
		  $.ajax({
					 
                              type: "POST",
                              url: "ajax/BuscarVentaContado.php",
                              data: "id="+idventa,
                              dataType: "json",
                              error: function(){
                                    alert("ERROR EN LA PETICION");
                              },
                              success: function(data){
								  
								    if(data!=false){
									
										
                                    if(nextinput2>0 && array.indexOf(data.ventas_idventas) != -1){
	
	                                	alert("ERROR::La Nota de Venta:"+array[array.indexOf(data.ventas_idventas)]+" Ya se Agrego.");
	
	
	                                    }
										else{
										var fila="<tr class='"+data.ventas_idventas+"' align='center' style='background-color:#333; color:#FFF; '><td colspan='3'>NOTA DE VENTA::"+data.ventas_idventas+"</td></tr><tr style='background-color:#333; color:#FFF; ' align='center'><td>NUM PAGO</td><td>FECHA</td><td>MONTO</td><td>SALDO</td><td><img src='images/eliminar.png' width='25' height='25' alt='Eliminar'  onclick='if(confirm(\"Realmente desea eliminar este detalle?\")){eliminarDetalle("+data.ventas_idventas+"); }'/></td></tr>";
							$("#cuotas").append(fila);			
							array[nextinput2]=data.ventas_idventas;
							nextinput2++;
										//for(f=0;f<=data.length;f++){
															addRow(1,data.fecha,data.monto,0,data.idventascontado,data.ventas_idventas);
											
										
											
										
										}
									}
								
									else  {
										 alert("LA VENTA:: "+valor+":: NO SE  ENCUENTRA REGISTRADO...");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
				 
		}	  
		  
 function rellenarVentas(){
	 
		  var idventa=$("#notaventa").val();
		   //alert(idventa);
		
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
										var fila="<tr class='"+data[0].ventas_idventas+"' align='center' style='background-color:#333; color:#FFF; '><td colspan='4'>NOTA DE VENTA::"+data[0].ventas_idventas+"</td><td><img src='images/eliminar.png' width='25' height='25' alt='Eliminar'  onclick='if(confirm(\"Realmente desea eliminar este detalle?\")){eliminarDetalle("+data[0].ventas_idventas+"); }'/></td></tr>";
							$("#cuotas").append(fila);			
							array[nextinput2]=data[0].ventas_idventas;
							nextinput2++;
										for(f=0;f<=data.length;f++){
											
											addRow(data[f].numpago,data[f].fecha,data[f].saldo_inicial,data[f].saldo_actual,data[f].creditoVentas_idcreditoVentas,data[f].ventas_idventas);
											
										
											
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
		
		 
	  function opciones(){
	
		 
		   //if(tipò==parseInt(2)){rellenarContado();}
		    // if(tipo==1){rellenarVentas();}
		  // if(tipo==3){rellenarDeuda();}
		   rellenarContado();
		   rellenarVentas();
		  
		  }
		
		function addRow(numcuota,fecha,montocuota,saldo,idcreditoVentas,idventa){
			
			fila= '<tr id="fila' + nextinput + '" class="'+idventa+'"><td width="10px"><input style="text-align:center" type="text"  readonly ="readonly" size="10" id="numcuota' + nextinput + '"  name="numcuota[]' + nextinput + '" value="'+numcuota+'"  /></td><td><input  style="text-align:left"type="text"  readonly ="readonly"  size="15" id="fecha ' + nextinput + '"  name="fecha[]' + nextinput + '" value="'+fecha+'"  /></td><td><input style="text-align:right" type="text"   readonly ="readonly"  size=8" id="montocuota' + nextinput + '"  name="montocuota[]' + nextinput + '" value="'+montocuota+'" onchange="validarMonto(this);" /></td><td><input style="text-align:right" type="text"  size="5" id="saldo' + nextinput + '"  name="saldo[]' + nextinput + '"  value="'+saldo+'"  /></td><td><input   type="checkbox" id="elegido' + nextinput + '" onchange="chequeo(this);" name="elegido[]"  value="'+nextinput+'" /><input type="hidden"  id="idcreditoVentas' + nextinput + '"  name="idcreditoVentas[]' + nextinput + '" value="'+idcreditoVentas+'"  /><input type="hidden"  id="monto_original' + nextinput + '"  name="monto_original[]' + nextinput + '" value="'+montocuota+'"  /></td></tr>';
	
	
	
$("#cuotas").append(fila);



			nextinput++;
	
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
	 if(resultado!=false){
		
		 
		  calcularTotal();
	 	 if(total>total_devolucion){
         
		 
			 
			 alert("ERROR::SOBREPASO EL MONTO DE DEVOLUCION");
			 $("#"+c.id).parent().parent().find("input").eq(2).val( $("#"+c.id).parent().parent().find("input").eq(6).val());
			 $("#"+c.id).parent().parent().find("input").eq(4).attr('checked',false);
 			 $("#"+c.id).parent().parent().css( "background-color", "");

			 calcularTotal();

		 }
		if(parseFloat(c.value)>parseFloat( $("#"+c.id).parent().parent().find("input").eq(6).val())){
			 alert("ERROR::EL MONTO NO PUEDE SER MAYOR  A: "+$("#"+c.id).parent().parent().find("input").eq(6).val());
			 $("#"+c.id).parent().parent().find("input").eq(2).val( $("#"+c.id).parent().parent().find("input").eq(6).val());
			 $("#"+c.id).parent().parent().find("input").eq(4).attr('checked',false);
 			 $("#"+c.id).parent().parent().css( "background-color", "");

			 calcularTotal();
			
			}
		
		

	 }
	 else{
			 $("#"+c.id).parent().parent().find("input").eq(2).val( $("#"+c.id).parent().parent().find("input").eq(6).val());

		 }
		 //alert(total);
	   }
	   
	   function chequeo(v){
		
		  var f=$("#"+v.id).parent().parent().attr("id");
		  
			  if($("#"+v.id).is(':checked')){ 
	       
			$("#"+v.id).parent().parent().find("input").eq(2).focus();
		 $("#"+v.id).parent().parent().find("input").eq(2).removeAttr("readonly");

	        $("#"+f).css( "background-color", "red");
		
			   return false;
			  } 
			  else{
			 
			 $("#"+f).css( "background-color", "");
			 $("#"+v.id).parent().parent().find("input").eq(2).attr("readonly","true");
			 $("#"+v.id).parent().parent().find("input").eq(2).val( $("#"+v.id).parent().parent().find("input").eq(6).val());
			 
			   return false;
				  }
			 }
			 
			 function calcularTotal(){
				
				 total=0;
				  $('#cuotas tr').each(function () {
					   if($(this).find("input").eq(4).is(':checked')){
			   
			             total=total+parseFloat($(this).find("input").eq(6).val()-$(this).find("input").eq(2).val());

					   }
			   
			   });
				 
				 }
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">INICIO</h2>
            <div>
           DEVOLUCIONES
            <table>
            <tr>
            <td><label>TIPO :</label><select name="tipo" id="tipo">
            <option value="credito">VENTA CREDITO</option>
            <option value="contado">VENTA CONTADO</option>
            <option value="deuda">DEUDA</option>
            </select></td>
            <td><label>NUM  VENTA/DEUDA:</label><input  type="text" size="10" id="notaventa" name="notaventa"/></td>
            <td><input type="button" value="Buscar"  name="buscar" id="buscar" onClick="opciones();"/></td>
            </tr>
            </table>
            </div>
            <hr />
            <H6>MONTO TOTAL DEVOLUCION:<input  id="valorDevolucion" name="valorDevolucion" value="" readonly size="10"/><?php echo $monto["moneda"]?></H6><br />
            <table border="1">
            <thead>
            
            <tr align="center" style="background-color:#06C;color:#CF0; font-weight:bold; ">
            <td>NUM CUOTA </td>
            <td>FECHA</td>
            <td>MONTO <BR /></td>
            <td>SALDO <BR />ACTUAL</td>
            <td>SELECC<BR />IONAR</td>
            </tr>
            </thead>
            <tbody id="cuotas">
            
            </tbody>
           <tfoot>
           <tr>
           <td><input  type="button" value="Procesar" id="procesar" name="procesar"/></td>
           <td><input  type="button" value="Cancelar" id="cancelar" name="cancelar"/></td>
           
           </tr>
           
           </tfoot>
            </table>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
             
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>