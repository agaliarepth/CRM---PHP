<?php require_once("head.php");?>



  <script type="text/javascript">
		var stock;
	var titulo;
	var tomo;
	var id;
	var fac;
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
				source: "ajax/searchProductos.php", 				/* este es el formulario que realiza la busqueda */
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
			$( "#stock" ).val( ui.item.stock_disponible );
			$( "#codigoLabel" ).val( ui.item.codigo );
			$( "#pu" ).val( ui.item.cif );
			
			stock=parseInt(ui.item.stock_disponible);
			titulo=ui.item.titulo;
			tomo=ui.item.tomo;
			id=parseInt(ui.item.id);
			codigo=ui.item.codigo;
			$( "#cantidad" ).focus();
			return false;
			
		}
		
	
  $(document).ready(function($)
  {
	  
	   $("#tipo").change(function(){
       if($(this).val()=="contado"){
			$("#tablacredito").css({ display: "none"});
			
			}
			 if($(this).val()=="credito"){
				  $("#tablacredito").css({ display: "block"});
				    $("#condiciones").focus();
			 }
    });
	  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="ei"){

  foreach($res3 as $v){
	  $aux=$li->getId($v["libros_idlibros"]);
	  echo "addTableRow2($v[cantidad],'".$aux["titulo"]."','".$aux["tomo"]."',$v[precio_unit],$v[precio_total],$v[libros_idlibros],'".$aux["codigo"]."','".$v["obs"]."','".$v["factura"]."');";
	  
	 
	   
    }
	
	  
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   {
    // añadir nueva fila usando la funcion addTableRow
	
   
		if(verificaPrecio()&& validarCantidad()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt);
	addTableRow($( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id);
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   
   function addTableRow2( cantidad, titulo, tomo,pu,pt,id,codigo,obs,factura)
   {
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"        /></td><td><input type="text" class="inp2-form"  size="10" id="fact' + nextinput + '"   name="factura[]' + nextinput + '" value="'+factura+'"  /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" value="'+obs+'"  /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/eliminar.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	
$("#campos").append(campo);
array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
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
    campo = '<tr aling ="center"><td><input type="text" class="inp2-form" readonly ="readonly" size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '"  value="     '+cantidad+'"/></td><td width="10px"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '"       value="'+codigo+'"  /></td><td><input type="text" class="inp4-form" readonly ="readonly"  size="50" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input type="text" class="inp2-form"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td><input type="text" class="inp2-form" readonly ="readonly" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]"  /></td><td colspan="2"><input type="text" class="inp2-form" readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"/></td><td><input type="text" class="inp2-form"  size="10" id="fact' + nextinput + '"   name="factura[]' + nextinput + '" value="F-"  /></td><td><input type="text" class="inp2-form"  size="10" id="obs' + nextinput + '"   name="obs[]' + nextinput + '" /></td><td><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+id+'"  /></td><td><img src="images/eliminar.png  " width="25" height="25" alt="Eliminar"  id="boton' + nextinput + '" onclick="if(confirm(\'Realmente desea eliminar este detalle?\')){eliminarFila(this); }"/></td></tr>';
	if(typeof(codigo)=="undefined"){
	alert("ERROR::Este codigo de libro No se Encuentra Registrado En El Catalogo");
	return;
	}
	if(nextinput>0 && array.indexOf(codigo) != -1){
	
	
	alert("ERROR::El Item Num:"+array[array.indexOf(codigo)]+" esta duplicado o No se Encuentra Registrado En El Catalogo.");
	nextinput++;
	
	}
	else{
$("#campos").append(campo);

array[nextinput]=codigo;
nextinput++;
$("#libro").val('');
$("#stock").val('');
$("#codigoLabel").val('');
$("#num_filas").val(nextinput);
$("#cantidad").val("");
$("#pu").val("");

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
				alert("ERROR::Ingrese un cantidad");
				return false;
	             }
				                      
                                 
           if ( !patron .test($( "#cantidad" ).val())) {               

               alert("ERROR::La Cantidad no es Correcta");
			   return false;
		   }
				else
				return true;
			
			}
			
			function validarExiste(v){
				var va=v;	
				var b=1;
				$("#campos tr").each(function(index) {
					
					var pk=$(this).find("td").eq(1).find("input").attr("value");
					
                    if(pk==va){
					alert("ya existe");
					return true;
					
					
					}
					else{
					 return false;
					 
					}
                });	
				if(b==1)
				return true;
				else
				
				return false;
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
	 
 
  </script> 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            <?php if (isset($_GET["e"])&&$_GET["e"]=="ei"){?>
          
         <h2 id="contact">COMPRAS > EDITAR COMPRA</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset ><legend>Datos del Documento</legend>
		<table border="0" cellpadding="0"  id="id-form" width="70%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		
		<td><label>Proveedores</label>
      <select   name="proveedores_idproveedores" required id="proveedores_idproveedores">
        <?php foreach($prove as $row){?>
			  <option <?php  if ($res4["proveedores_idproveedores"]==$row["idproveedores"]){?> selected="selected"<?php }?>value="<?php echo $row["idproveedores"];?>"> <?php echo $row["nombre"];?></option><?php }?>
			
		</select>
        
		</td>
      
		
        <td>
                 <label>Numero Documento</label>

          <input type="text"  id="numero_doc" name="numero_doc" value="<?php echo $res4["numero_doc"];?>"/>
           </td>
        
          <td>
                 <label>Fecha Compra</label>

          <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo $res4["fecha"];?>"/>
           </td>
        <td >
               <label>Moneda:</label>

        <select  class="inp-form" name="moneda" id="moneda">
         <option <?PHP if ($res4["moneda"]=="bs"){?> selected="selected"<?php }?> value="bs">Bolivianos
        </option>
			  <option <?PHP if ($res4["moneda"]=="sus"){?> selected="selected"<?php }?>value="sus">Dolar</option>
                                    
			
		</select></td>
       <td >
               <label>Tipo de Compra :</label>

        <select  class="inp-form" name="tipo" id="tipo">
         <option <?PHP if ($res4["tipo"]=="contado"){?> selected="selected"<?php }?> value="contado">CONTADO
        </option>
			  <option <?PHP if ($res4["tipo"]=="credito"){?> selected="selected"<?php }?>value="credito">CREDITO</option>
                                    
			
		</select></td>
       
		</tr>
       
           
        
            
           </thead>
           </table>
           </fieldset>
           <?php if($res4["tipo"]=="credito"){?>
           <fieldset id="tablacredito" style=" display:block; "><legend>Datos de Credito</legend>
           <?php } else{?>           <fieldset id="tablacredito" style=" display:none; "><legend>Datos de Credito</legend>
<?php }?>
           <table     > 
           <tr>
           <td><label>Condiciones de Compra</label><input type="text" size="50" name="condiciones" id="condiciones" value="<?php echo $res4["condiciones"];?>"/></td>
           <td><label>Meses Gracia</label><input  type="text" name="gracia" id="gracia" size="9"value="<?php echo $res4["gracia"];?>" /></td>
           <td>
                 <label>Fecha Primer Pago:</label>

          <input type="text" class="fechas"  name="fechapago" id="fecha2" value="<?php echo $res4["fechapago"];?>"/>
          
           </td>
            <td><label>Num cuotas</label><input  type="text" name="numcuotas" id="numcuotas" size="9"value="<?php echo $res4["numcuotas"];?>"/></td>
             <td><label>Monto cancelado</label><input  type="text" name="montocancelado" id="montocancelado" size="9"value="<?php echo $res4["montocancelado"];?>"/></td>
           <td>
            <td><label>Saldo</label><input  type="text" name="saldo" id="saldo" size="9" value="<?php echo $res4["saldo"];?>"/></td>
           <td>
           
           </tr>
           
        
        
        
           </table>
           </fieldset>
           <fieldset><legend>Items</legend>
           <table width="90%">
           
        <tr>
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel"   class="inp2-form"/></td>
         
     <td colspan="2">
     
     <label for="libro" size="300" readonly="readonly"> TITULO DEL LIBRO :</label>
  <input id="libro"  size="75"  /></td>

  
    <td>
   <label for="libro" >CANTIDAD : </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
    <td>
   <label for="pu" >P / UNITARIO: </label>
   <input id="pu" size="5"  class="inp2-form"  />
   </td>
   
   <td>
  <img src="<?php config::ruta(); ?>images/adicionar.png" width="40" height="40" id="adicionar" style="cursor:pointer;" title="Adicionar"/>
	</td>
    </tr>
	</table>
     </fieldset>
<hr />
<p>&nbsp;</p>
<table cellpadding="0"  width="70%" id="detalle" border="0">
            
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
                             <th >Factura</th>
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
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar" onclick="javascript:window.location='<?php config::ruta()?>?accion=compras';" />
                 <input type="hidden" name="editar" id="editar" value="editar"  />
               
               <input type="hidden" name="num_filas" id="num_filas" />
               <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />
                <input type="hidden" name="idcompras" id="idcompras" value="<?php echo $res4["idcompras"];?>"/>
</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
            <?php } else {?>
            
             <h2 id="contact">COMPRAS > REGISTRAR COMPRA</h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset ><legend>Datos del Documento</legend>
		<table border="0" cellpadding="0"  id="id-form" width="70%" style="background-color:#E1F1F7">
        
	<thead>
		
		 <tr>
		
		<td><label>Proveedores</label>
      <select   name="proveedores_idproveedores" required id="proveedores_idproveedores">
        <?php foreach($prove as $row){?>
			  <option value="<?php echo $row["idproveedores"];?>"> <?php echo $row["nombre"];?></option><?php }?>
			
		</select>
        
		</td>
      
		
        <td>
                 <label>Numero Documento</label>

          <input type="text"  id="numero_doc" name="numero_doc"/>
           </td>
        
          <td>
                 <label>Fecha Compra</label>

          <input type="text" class="fechas"  name="fecha" id="fecha" value="<?php echo date("Y-m-d");?>"/>
           </td>
        <td >
               <label>Moneda:</label>

        <select  class="inp-form" name="moneda" id="moneda">
         <option  value="bs">Bolivianos
        </option>
			  <option value="sus">Dolar</option>
                                    
			
		</select></td>
       <td >
               <label>Tipo de Compra :</label>

        <select  class="inp-form" name="tipo" id="tipo">
         <option  value="contado">CONTADO
        </option>
			  <option value="credito">CREDITO</option>
                                    
			
		</select></td>
       
		</tr>
       
           
        
            
           </thead>
           </table>
           </fieldset>
           <fieldset id="tablacredito" style=" display:none; "><legend>Datos de Credito</legend>
           <table     > 
           <tr>
           <td><label>Condiciones de Compra</label><input type="text" size="50" name="condiciones" id="condiciones"/></td>
           <td><label>Meses Gracia</label><input  type="text" name="gracia" id="gracia" size="9"/></td>
           <td>
                 <label>Fecha Primer Pago:</label>

          <input type="text" class="fechas"  name="fechapago" id="fecha2" value="<?php echo date("Y-m-d");?>"/>
          
           </td>
            <td><label>Num cuotas</label><input  type="text" name="numcuotas" id="numcuotas" size="9"/></td>
             <td><label>Monto cancelado</label><input  type="text" name="montocancelado" id="montocancelado" size="9"/></td>
           <td>
            <td><label>Saldo</label><input  type="text" name="saldo" id="saldo" size="9"/></td>
           <td>
           
           </tr>
           
        
        
        
           </table>
           </fieldset>
           <fieldset><legend>Items</legend>
           <table width="90%">
           
        <tr>
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel"   class="inp2-form"/></td>
         
     <td colspan="2">
     
     <label for="libro" size="300" readonly="readonly"> TITULO DEL LIBRO :</label>
  <input id="libro"  size="75"  /></td>

  
    <td>
   <label for="libro" >CANTIDAD : </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
    <td>
   <label for="pu" >P / UNITARIO: </label>
   <input id="pu" size="5"  class="inp2-form"  />
   </td>
   
   <td>
  <img src="<?php config::ruta(); ?>images/adicionar.png" width="40" height="40" id="adicionar" style="cursor:pointer;" title="Adicionar"/>
	</td>
    </tr>
	</table>
     </fieldset>
<hr />
<p>&nbsp;</p>
<table cellpadding="0"  width="70%" id="detalle" border="0">
            
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
                             <th >Factura</th>
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
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=compras';"/>
                 <input type="hidden" name="enviar" id="enviar" value="enviar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />
               <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />
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