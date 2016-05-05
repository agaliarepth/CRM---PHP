<?php require_once("head.php");?>
 <script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#wizard").validationEngine();
		});
            
	</script>

  <script type="text/javascript">
	$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#cobrador").autocomplete({
				source: "ajax/searchCobradores.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.label + " CI:" + item.valor + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{	$( "#cobrador" ).val( ui.item.label );
			$( "#idcobrador" ).val( ui.item.idcobradores );
			return false;
				}
				
				
				$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#buscarCuenta").autocomplete({
				source: "ajax/buscarcuenta.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: cuentaSeleccionada/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.num_cuenta + " ::" + item.nombre_cliente + "</a>" )
    .appendTo( ul );
};
		});
		
		function cuentaSeleccionada(event, ui)
		{	$( "#cliente" ).val( ui.item.nombre_cliente );
			$( "#num_cuenta" ).val( ui.item.num_cuenta );
			$( "#cobrador" ).val( ui.item.nombre_cobrador );
			$( "#saldoini" ).val( ui.item.saldo_actual );
			$( "#idcuentas" ).val( ui.item.idcuentas );
			$( "#idcobrador" ).val( ui.item.idcobrador );

			return false;
				}
  $(document).ready(function($)
  {  
	 
  
     $("#monto").change(function(){
		 
		 var v=parseFloat($("#saldoini").val())-parseFloat($("#monto").val());
		
		   var r=Math.round(v*100)/100;
		 if(parseFloat(r)<0){
			 
			 alert("Error::El monto del recibo no puede ser mayor Al Saldo anterior..");
			 $("#monto").val(" ");
			 $("#monto").focus();
			 }
			 else
			
			 $("#saldo").val(r);
		 });
   
   
	   $("#num_recibo").change(function(){
	    $.ajax({
                              type: "POST",
                              url: "ajax/comprobarRecibo.php?b1="+$("#num_recibo").val(),
                              data: "b="+$("#idcuentas").val(),
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  if(data=="no"){
									 alert("Este numero de Recibo ya esta registrado para esta Cuenta...."); 
									 $("#num_recibo").val("");
									   $("#num_recibo").focus();
									  n();
									  } 
									                                              
                                  
                                  
                              }
                  });
	   
	   });
   
   
  });
  
  
  
 
	  
					
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

	
		
		 
		 function chequeo(v){
			  if($("#"+v.id).is(':checked')){ 
			  check=true;
			
			   return false;
			  } 
			  else{
			 
			   check=false;
			   return false;
				  }
			 }
			 function abrirPop(){
				 var id=$( "#idcuentas" ).val();
				 
				 window.open('<?php echo config::ruta()?>?accion=verTarjetaCobranza&id='+id, this.target, 'width=700,height=650,scrollbars=1'); return false;
				 
				 }
				 function validarForm(){
					 
					 if(parseFloat($("#saldoini").val())<=0){
					 alert("No se Puede Registrar El pago:: El Saldo Es 0")
					 return false;
					 }
					 
					 if(confirm("Se Registrara el pago.. desea Continuar?? "))
					
					return true;
					 else
					 return false;
					 }
					 
				
  </script> 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">COMPRAS >  REGISTRAR PAGOS</h2>
            <div>
          <form class="notas" action="" method="post">
             <table border="0">
               <tr style="background-color:#003; color:#0CF; font-weight:bold; border:1px solid #999; ">
                 <td>Proveedor</td>
                 <td>Num de Compra</td>
                 <td>Fecha de Compra</td>
                 <td>Saldo </td>
                 <td>Numero cuotas </td>
                 <td>Moneda</td>
                 
               </tr>
               <tr style=" background-color:#FFF; text-align:center; font-weight:bold; border:1px solid #999;">
                 <td><?php  $res2=$p->getId($res["proveedores_idproveedores"]); echo $res2["nombre"]?></td>
                 <td><?php   echo $res["idcompras"]?></td>
                                  <td><?php   echo $res["fecha"]?></td>

                 <td><?php   echo $res["saldo"]?></td>
                  <td><?php   echo $res["numcuotas"]?></td>
                  <td><?php   echo $res["moneda"]?></td>
                  
               </tr>
               <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><label>Fecha Pago:</label></td>
                 <td><input  name="fecha" class="fechas"id="fecha" value="<?php echo date("Y-m-d")?>"/></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><label>Monto Pago:</label></td>
                 <td><input  name="monto" id="monto" value=""/></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><label>Numero Documento:</label></td>
                 <td><input  name="numdoc" id="numdoc" value=""/></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><label>Descripcion:</label></td>
                 <td colspan="2"><input  size="50" name="descripcion" id="descripcion" value=""/></td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td>&nbsp;</td>
                 <td>&nbsp;</td>
                 <td><input  type="submit" id="bEnviar" value="Registrar" name="bEnviar"/></td>
                 <td><input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:window.location='<?php echo config::ruta();?>?accion=compras'"/></td>
                 <td><input type="hidden"  name="enviar"value="enviar"/></td>
                 <td><input type="hidden"  name="idcompras"value="<?php echo $_GET["id"];?>"/></td>
               </tr>
             </table>
             </form>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>