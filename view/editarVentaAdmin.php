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
	var idclientes;
	var pu;
     var t;
	
	
	
	
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre").autocomplete({
				source: "ajax/buscarCliente.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: clienteSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.nombres + " / " + item.empresa + "</a>" )
    .appendTo( ul );
};
		});
		
		
		function clienteSeleccionado(event, ui)
		{
			
			$( "#nombre" ).val( ui.item.nombres );
			$( "#razonsocial" ).val( ui.item.empresa );
			$( "#nit" ).val( ui.item.nit );
			$( "#telf" ).val( ui.item.telefono );
			$( "#pais" ).val( ui.item.origen );
			$( "#ciudad" ).val( ui.item.ciudad );
			$( "#idclientes" ).val( ui.item.idclientes );
			return false;
			
		}
		
	

		
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
			$( "#stock" ).val( ui.item.stock_disponible);
			$( "#codigoLabel" ).val( ui.item.codigo );
			
			if($("#moneda").val()=="Sus")
			$( "#pu" ).val( parseFloat(ui.item.precio/$("#cambio").val()).toFixed(2));
			else
			$( "#pu" ).val( ui.item.precio);
			
			
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
	   $("#diaspago").change(function(){
		   if(!$("#diaspago").val().match(/^[0-9]+$/)){
			 $("#diaspago").val("0");
			 
			   }
			  
		   
		   }); 
		    $("#num_cuotas").change(function(){
		   if(!$("#num_cuotas").val().match(/^[1-9]+$/)){
			 $("#num_cuotas").val("1");
			 
			   }
			  
		   
		   }); 
		   
		    $("#dias").change(function(){
		   if(!$("#dias").val().match(/^[0-9]+$/)){
			 $("#dias").val("0");
			 
			   }
			  
		   
		   });
		     $("#adelanto").change(function(){
		   if(!$("#adelanto").val().match(/^(\d{1}\.)?(\d+\.?)+(,\d{2})?$/)){
			 $("#adelanto").val("0");
			 $("#adelanto").focus();
			 
			 
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
	 
	 
	  

	  
	  
	  $("#moneda").change(function(){
		  
		  if(nextinput>0 )
		 {
				$("#campos tr").each(function(index) {
					
					$(this).remove();
					nextinput = 0;
                  total=0;
                  precio_total=0;
					
              $("#num_filas").val(nextinput);
              $("#cant_total").val(total);
              $("#monto_total").val(precio_total);

              $("#totalventa").val(precio_total);
			
			  $( "#codigoLabel" ).focus();
			  
					});
		 }//fin de  if 
		 else{
			$( "#libro" ).val("");
			$( "#stock" ).val("");
			$( "#codigoLabel" ).val("");
			  $( "#codigoLabel" ).focus(); 
			 $( "#pu" ).val("");
			 }
		   			
		  });
	  
	  
	  $("#descuento").change(function(){
		
		if($(this).prop("checked")){
			
		$("#tabladescuento").css({ display: "block"});
		
		if( parseFloat($("#adelanto").val())>0){
			
			aux=parseFloat(precio_total-$("#adelanto").val()).toFixed(2);
			
			$("#totalventa").val(aux);
			$("#totalcancelar").val(aux);
		}
		else
		{$("#totalventa").val(precio_total);
				$("#totalcancelar").val( precio_total);
			}
		

			}
			else
			{
				$("#tabladescuento").css({ display: "none"});
				$("#descuentomonto").val("0");
				$("#totalcancelar").val($("#totalventa").val());
				$("#tipo_desc").val(" ");

				}
		});
		$("#tieneadelanto").change(function(){
		
		if($(this).prop("checked")){
			
		$("#tablaadelanto").css({ display: "block"});
		$("#adelanto").val(0);

			}
			else
			{
				$("#tablaadelanto").css({ display: "none"});
				$("#adelanto").val("0");
				$("#facturaadelanto").val("");
				$("#reciboadelanto").val("");
				$("#cuentabancoadelanto").val("");
				
				

				}
		});
		
		 $("#tipo_desc").change(function(){
			 
			 if($(this).val()=="monto"){
				 
				var r=parseFloat($("#totalventa").val()-$("#descuentomonto").val()).toFixed(2);
				  $("#totalcancelar").val(r);
				 }
				 
				 
				 if($(this).val()=="porcentaje"){
					 var aux=parseFloat($("#descuentomonto").val()/100);
					 var r=parseFloat($("#totalventa").val()*aux).toFixed(2);
					 var t=($("#totalventa").val()-r);
				  $("#totalcancelar").val(t);
				 }
			 
			 });
		
		 $("#descuentomonto").keyup(function(){
			 
			 if($("#tipo_desc").val()=="monto"){
				 
				var r=parseFloat($("#totalventa").val()-$(this).val()).toFixed(2);
				  $("#totalcancelar").val(r);
				 }
				 if($("#tipo_desc").val()=="porcentaje"){
					 var aux=Math.round($(this).val())/100;
					 var r=parseFloat($("#totalventa").val()-($("#totalventa").val()*aux)).toFixed(2);
				  $("#totalcancelar").val(r);
					 
					 }
			
			 
			 
			 });
		
		
		
		
	   $("#tipo").change(function(){
       if($(this).val()=="contado"){
			$("#tablacondiciones").css({ display: "none"});
			$("#tablaadelanto").css({ display: "none"});
			$("#tablacontado").css({ display: "block"});

			$("#tipoventa").val("contado");
			
			}
			 if($(this).val()=="credito"){
				  $("#tablacontado").css({ display: "none"});
				  $("#tablacondiciones").css({ display: "block"});
				  $("#tablaadelanto").css({ display: "block"});
                $("#num_cuotas").val("1");
				 $("#tipoventa").val("credito");

			 }
    });
	  <?php 
if(isset($_GET["e"])&& $_GET["e"]=="editarVenta"){

  foreach($res2 as $v){
	  $s=$li->getStock($v["libros_idlibros"]);
	  echo "addTableRow('".$v["codigo"]."',$v[cantidad],'".$v["titulo"]."','".$v["volumen"]."',$v[precio_unit],$v[precio_total],$v[iddetalleVentas],$v[libros_idlibros],$s);";
	  
	 
	   
    }
	
	  if($res["tipoventa"]=="CONTADO"){
		  echo"
		  $('#tablacondiciones').css({ display: 'none'});
			$('#tablaadelanto').css({ display: 'none'});
			$('#tablacontado').css({ display: 'block'});

			$('#tipoventa').val('contado');";
		  
		  }
		  if($res["tipoventa"]=="CREDITO"){
			  
			   echo "$('#tablacontado').css({ display: 'none'});
				  $('#tablacondiciones').css({ display: 'block'});
				  $('#tablaadelanto').css({ display: 'block'});

				 $('#tipoventa').val('credito');";

			  
			  }
			  if($res["monto_descuento"]>0 && $res["tipoventa"]=="CONTADO" ){
				  
				 echo" 
			
		 $('#tabladescuento').css({ display: 'block'});
		 $('#totalventa').val(".$res["total"].");
		  $('#totalcancelar').val(".$res["total"].");
		$('#descuento').attr('checked',true);";
				  }
				  
				  if($res["monto_descuento"]>0 && $res["tipoventa"]=="CREDITO"){
					   echo" 
			
		 $('#tabladescuento').css({ display: 'block'});
		 $('#totalventa').val(".$credito['saldo_inicial'].");
		  $('#totalcancelar').val(".$res['total_cancelar'].");
		$('#descuento').attr('checked',true);";
				  }
				  
				   if($credito["adelanto"]>0){
				  
				 echo" 
			$('#tablaadelanto').css({ display: 'block'});
		
		 $('#tieneadelanto').attr('checked',true);";
				  }
				  else{
					  echo" 
			$('#tablaadelanto').css({ display: 'none'});
		
		 $('#tieneadelanto').attr('checked',false);";
					  }
	}


?>
   // trigger event cuando el boton es cliqueado
   $("#adicionar").click(function()
   { 
    // añadir nueva fila usando la funcion addTableRow
	
   
		if(verificaPrecio()&& validarCantidad($( "#cantidad" )) && validarDisponible() && validarStock()){
	var pt=parseFloat($( "#cantidad" ).val())*parseFloat( $( "#pu" ).val());
	pt=parseFloat(pt).toFixed(2);
	
	addTableRow($("#codigoLabel").val(),$( "#cantidad" ).val(),$( "#libro" ).val() , tomo, $( "#pu" ).val(),pt,id, $( "#stock" ).val());
		}
	
    // prevenir que el boton redireccione a una nueva pagina
    
   });
   
   
   
   
   
   function addTableRow( codigo,cantidad, titulo, tomo,pu,pt,id,idlibro,disponible)
   {
    campo = '<tr ><td width="10px"><input style="text-align:center" type="text"  readonly ="readonly" size="10" id="codigo' + nextinput + '"  name="codigo[]' + nextinput + '" value="'+codigo+'"  /></td><td><input  style="text-align:left"type="text"  readonly ="readonly"  size="70" id="titulo ' + nextinput + '"  name="titulo[]' + nextinput + '" value="'+titulo+'"  /></td><td><input style="text-align:center"type="text"  readonly ="readonly" size="5" id="tomo' + nextinput + '"  name="tomo[]' + nextinput + '" value="'+tomo+'" /></td><td ><input style="text-align:right" type="text"  size="5" id="cantidad' + nextinput + '"  name="cantidad[]' + nextinput + '" readonly ="readonly" value="'+cantidad+'" onchange="recalcularCantidad(this);" /></td><td  colspan="2"><input style="text-align:right" type="text" size="10" value="'+pu+'" id="precio_unit' + nextinput + '"  name="precio_unit[]" onchange="recalcularPrecio(this);"  /></td><td  ><input style="text-align:right" type="text"  readonly ="readonly" size="10" id="precio_total' + nextinput + '" value="'+pt+'"  name="precio_total[]' + nextinput + '"/></td><td><input type="hidden"  id="iddetalle' + nextinput + '"  name="iddetalle[]' + nextinput + '" value="'+id+'"  /><input type="hidden"  id="idlibro' + nextinput + '"  name="idlibro[]' + nextinput + '" value="'+idlibro+'"  /><input type="hidden"  id="disponible' + nextinput + '"  name="disponible[]' + nextinput + '" value="'+disponible+'"  /></td></tr>';
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
var tt=$("#campos tr:last").find("input").eq(3).attr("value");
var prt=$("#campos tr:last").find("input").eq(5).attr("value");
total=total+parseInt(tt);
precio_total=precio_total+parseFloat(prt);
precio_total.toFixed(2);
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#totalventa").val(precio_total);
$("#totalcancelar").val(precio_total);


$("#num_filas").val(nextinput);
//alert(total+"-"+nextinput);
   }
   }
  });
  
   function recalcularCantidad(c){
	 
	 if(validarCantidad($("#"+c.id))&&validarStockDisponible(c)){
	 var pu=$("#"+c.id).parent().parent().find("input").eq(4).val();
	 var pt=pu*c.value;
	  pt=pt.toFixed(2);
	 $("#"+c.id).parent().parent().find("input").eq(5).val(pt);
	 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#totalventa").val(precio_total);
		$("#totalcancelar").val(precio_total);

	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(3).val(0);
		$("#"+c.id).parent().parent().find("input").eq(5).val(0);
		 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#totalventa").val(precio_total);
		$("#totalcancelar").val(precio_total);

		 }
	   }
	   
	   function recalcularPrecio(c){
	   var expresion=/^\d+(\.\d{0,2})?$/;
     var resultado=expresion.test(c.value);
	 if(resultado!=false){
	 var cant=$("#"+c.id).parent().parent().find("input").eq(3).val();
	 var pt=cant*c.value;
	 pt=pt.toFixed(2);
	 $("#"+c.id).parent().parent().find("input").eq(5).val(pt);
	 	 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#totalventa").val(precio_total);
		$("#totalcancelar").val(precio_total);

	 }
	 else{
		$("#"+c.id).parent().parent().find("input").eq(4).val(0);
		$("#"+c.id).parent().parent().find("input").eq(5).val(0);
		 	 recalcularNota();
$("#cant_total").val(total);
$("#monto_total").val(precio_total);
$("#totalventa").val(precio_total);
		$("#totalcancelar").val(precio_total);

		 }
	   }
	   function recalcularNota(){
		   total=0;
		   precio_total=0;
		   var i;
		   $('#campos tr').each(function () {
			   
			   total=total+parseInt($(this).find("input").eq(3).val());
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
	  $("#totalventa").val(precio_total);
	  		$("#totalcancelar").val(precio_total);

      $("#num_filas").val(nextinput);
		  
		  }
	
		else{ 
		
	total=total-parseInt(tt);
	 
	  precio_total=precio_total-parseFloat(pt);
	  
	  $("#cant_total").val(total);
	  $("#monto_total").val(precio_total);
	   $("#totalventa").val(precio_total);
	  		$("#totalcancelar").val(precio_total);
      $("#num_filas").val(nextinput);
		}

$("#"+b.id).parent().parent().remove();
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
		  
		   function validarStockDisponible(s){
		var dis=$("#"+s.id).parent().parent().find("input").eq(7).val();
		var c=$("#"+s.id).parent().parent().find("input").eq(3).val();
		var cod=$("#"+s.id).parent().parent().find("input").eq(0).val();
	
		if(parseInt(c)>parseInt(dis)){
		alert("No Existe stock Suficiente.."+cod+" stock disponible="+dis+"Unid");
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
				if(confirm("Se guardara La Nota de Venta ?")){
					$("#vender").val(0);
					//alert($("#vender").val());
					document.form.submit();
				}
				
			
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
				if(confirm("Se Registrara La Venta en el sistema ?")){
					
					$("#vender").val(1);
					//alert($("#vender").val());
						document.form.submit();
				}
				
			
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
 
 function verPlanPagos(){
	 
	    fv=$("#fecha").val();
		nc=$("#num_cuotas").val();
		dp=$("#diaspago").val();
		dg=$("#dias").val();
		if( parseFloat($("#adelanto").val())>0){
			
			mt=parseFloat($("#monto_total").val()-$("#adelanto").val());
			}
			else{
					mt=parseFloat($("#monto_total").val());
				}
		
	    tipoCambio('<?php echo config::ruta();?>?accion=planCuotas&fv='+fv+'&nc='+nc+'&dp='+dp+'&dg='+dg+'&mt='+mt);
	 
	 }
 
  </script> 

 

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            <?php if (isset($_GET["e"])&&$_GET["e"]=="editarVenta"){?>
           <h2 id="contact">VENTAS > EDITAR VENTA </h2>
            <div>
             <form method="post"   class="notas"  action="" name="form" id="wizard"  >
       <fieldset ><legend>DATOS DEL CLIENTE</legend>
		<table border="0" cellpadding="0"  id="id-form" width="70%" >
        
	<thead>
		
		 <tr >
		
		<td><label>Nombre Cliente / CI / NIT</label>
      
			
		<input    type="text" id="nombre" name="nombre" size="35" readonly value="<?php echo $res["nombre"]?>"/>
        <input type="hidden" name="idclientes" id="idclientes"   value="<?php echo $res["clientes_idclientes"]?>"/>
		</td>
      
		
        <td>
                 <label>Razon Social</label>

          <input type="text"  id="razonsocial" name="razonsocial" size="35"  readonly="readonly" style="text-transform:uppercase;" value="<?php echo $res["razonsocial"]?>"/>
           </td>
           <td>
                 <label>NIT/CI</label>

          <input type="text"  id="nit" name="nit" size="10"  readonly="readonly" value="<?php echo $res["nit"]?>"/>
           </td>
           <td>
                 <label>PAIS</label>

          <input type="text"  size="12"  name="pais" readonly id="pais" value="<?php echo $res["pais"]?>"/>
           </td>
           <td>
                 <label>CIUDAD</label>

          <input type="text" size="15"  id="ciudad" name="ciudad"  readonly="readonly"value="<?php echo $res["ciudad"]?>"/>
           </td>
            <td>
                 <label>LOCALIDAD</label>

          <input type="text"  size="15" id="localidad"  readonly="readonly"name="localidad" value="<?php echo $res["localidad"]?>"/>
           </td>
           <td>
                 <label>TELEFONO</label>

          <input type="text"  id="telf"  readonly="readonly"
          name="telf" size="10" value="<?php echo $res["telf"]?>"/>
           </td>
           
        </tr>
        </thead>
        </table>
        </fieldset>
        <fieldset  style=" background-color:#FFC;"><legend>DATOS DE LA VENTA</legend>
        <table>
        <thead>
        <tr>
       <td >
               <label>TIPO DE VENTA</label><?php echo $res["tipoventa"];?>

        <select  class="inp-form" name="tipo"  id="tipo" style=" display:none; background:#333; font-size:14px; height:22px; color:#FF0; width:150px; font-style:italic; font-weight:bolder;" >
        
         <option <?php if($res["tipoventa"]=="CONTADO"){ ?> selected="selected"<?php }?> value="contado">CONTADO
        </option>
			  <option <?php if($res["tipoventa"]=="CREDITO"){ ?> selected="selected"<?php }?> value="credito">CREDITO</option>
                                    
			
		</select></td>
        <td >
               <label>VENDEDOR</label><?php echo $res["vendedor"];?>
               <select name="vendedor"  hidden="0">
             <?php foreach($listaVendedores as $row){
				 
				  $res9=$vendedor->getVendedores($row["idvendedores"]); ?>
             
			 <option  <?php if($row["idvendedores"]==$res["idvendedores"]){?> selected="selected"<?php }?>value="<?php echo $res9["idvendedores"]."||".$res9["nombres"];?>"><?php echo $res9["nombres"];?></option>
			 <?php }?>  
               </select>
        </td>  
        <td><label>FECHA VENTA</label><input type="text" id="fecha" name="fecha" class="fechas" value="<?php echo date("d-m-Y",strtotime($res["fecha"]));  ?>"/></td>
        <td><label>DESTINO</label><input type="text"  readonly="readonly"id="destino" name="destino"  style="text-transform:uppercase;" value="<?php echo $res["destino"]?>" /></td>
        <td >
        <td >
               <label>MONEDA</label><?php echo $res["moneda"];?>

        <select  class="inp-form" name="moneda" id="moneda" hidden="">
         <option  value="Bs">Bs
        </option>
			  <option value="Sus">Sus</option>
                                    
			
		</select></td>
        <td >
               <label>CAMBIO</label>
<input type="text" name="cambio"  id="cambio" size="10"  value="<?php echo $tc2["valor"];?>"/>
        </td>
       
		</tr>
       
           
        
            
           </thead>
           </table>
           </fieldset>
           
           <fieldset style="display:none;"><legend>Items</legend>
           <table width="90%">
           
        <tr>
        
          <td>
     
     <label for="codigoLabel" size="50" > CODIGO :</label>
  <input id="codigoLabel"    class="inp2-form" /></td>
         
     <td colspan="2">
     
     <label for="libro" size="300" readonly="readonly"> TITULO DEL LIBRO :</label>
  <input id="libro"  size="75"  /></td>

  <td>
   <label for="stock" >STOCK : </label>
   <input id="stock" size="5"   readonly="readonly"  />
   </td>
    <td>
   <label for="libro" >CANTIDAD : </label>
   <input id="cantidad" size="5"  class="inp2-form"  />
   </td>
    <td>
   <label for="pu" >P / UNITARIO: </label>
   <input id="pu" size="5"    />
   </td>
   
   <td>
  <img src="<?php config::ruta(); ?>images/adicionar.png" width="40" height="40" id="adicionar" style="cursor:pointer;" title="Adicionar"/>
	</td>
    </tr>
	</table>
     </fieldset>
<hr />
<p>&nbsp;</p>
<table cellpadding="0"  width="70%" id="detalle" border="0" >
            
                    <thead>
                   
                     </thead>
                        <tr  style="background-color:#333; color:#FFF;" >
                            
                            
                            <th>Codigo</th>
                            <th>Titulo</th>
                            <th >Volumen</th>
                            <th>Cantidad</th>
                            <th>P/Unitario<th>
                            <th >P/Total</th>
                            <th >Eliminar</th>
                            
                            
                          
                        </tr>
                   
                    <tbody  id="campos">
                  
                    	
                     
                    </tbody>
                    <tfoot>
                     <tr style=" background-color:#FFC">
                     <td colspan="2" ></td>
                     <td>TOTAL:</td>
                    
                     <td  ><input style="text-align:right" size="5"  readonly="readonly" name="cant_total" class="inp2-form" id="cant_total"  /></td>
                     <TD colspan="2"></TD>
                        <td > <input style="text-align:right"name="monto_total" size="5"  class="inp2-form" readonly  id="monto_total" /></td>
                        
   </tr>
                    </tfoot>
                   
                     </table>
                     <fieldset id="tablacontado" style="display:block;"><legend>VENTA CONTADO</legend>
                     <table>
                     <TR>
                   
                     <td><label>NUMERO DE FACTURA</label>
                     <input type="TEXT" name="numfactura"  readonly="readonly"style="text-transform:uppercase;" value="<?php echo $cont["numfactura"]?>" />
                     </td>
                     <td>
                     <label>RECIBO DE INGRESO</label>
                     <input type="TEXT" name="numingreso" readonly style="text-transform:uppercase;" value="<?php echo $cont["numingreso"]?>"/>
                     </td>
                     <td>
                     <label>MONTO INGRESO</label>
                     <input type="TEXT"   readonly="readonly" style="text-transform:uppercase;"value="<?php echo $cont["monto"]?>"name="montoingreso" class="validate[custom[number]]"/>
                     </td>
                     <td>
                     <label>TIPO DE PAGO</label>
                     <select name="tipopago" id="tipopago" >
                     <option  <?php if($cont["tipopago"]=="EFECTIVO"){ ?> selected="selected"<?php }?> value="EFECTIVO">EFECTIVO</option>
                     <option <?php if($cont["tipopago"]=="DEPOSITO"){ ?> selected="selected"<?php }?>value="DEPOSITO">DEPOSITO</option>
                     
                     </select>
                 
                     </td>
                       <td>
                     <label>BANCO-NUMERO DE CUENTA</label>
                     <input type="TEXT" name="cuentabanco"  readonly="readonly"  size="50" value="<?php echo $cont["cuentabanco"];?>"id="cuentabanco" style="text-transform:uppercase; " />
                     </td>
                     </TR>
                     
                     </table>
                     </fieldset>
          
                      <fieldset ><legend><input type="checkbox"  value="0"  disabled="disabled" id="tieneadelanto"/> ADELANTO</legend>
                     <table style="display:none" id="tablaadelanto"  >
                     <TR>
                     <TD>
                     <label>MONTO </label>
                     <input type="text"  readonly="readonly" name="adelanto" id="adelanto"  value="<?php echo $credito["adelanto"]?>"/>
                     
                    
                     </TD>
                     <td><label>NUMERO DE FACTURA</label>
                     <input type="TEXT" name="facturaadelanto" readonly id="facturaadelanto" style="text-transform:uppercase;" value="<?php echo $credito["facturaadelanto"]?>"/>
                     </td>
                     <td>
                     <label>RECIBO DE INGRESO</label>
                     <input type="TEXT" name="reciboadelanto" readonly id="reciboadelanto" style="text-transform:uppercase;" value="<?php echo $credito["reciboadelanto"]?>"/>
                     </td>
                     
                     <td>
                     <label>TIPO DE PAGO</label>
                     <select name="tipoadelanto" id="tipoadelanto" >
                       <option  <?php if($credito["tipoadelanto"]=="EFECTIVO"){ ?> selected="selected"<?php }?> value="EFECTIVO">EFECTIVO</option>
                     <option <?php if($credito["tipoadelanto"]=="DEPOSITO"){ ?> selected="selected"<?php }?>value="DEPOSITO">DEPOSITO</option>
                     
                     </select>
                 
                     </td>
                     <td>
                     <label>BANCO-NUMERO DE CUENTA</label>
                     <input type="TEXT" name="cuentabancoadelanto"  readonly="readonly" size="50" id="cuentabancoadelanto" value="<?php echo $credito["cuentabanco"]?>" />
                     </td>
                     </TR>
                     
                     </table>
                     
                     
                     </fieldset>
                      <fieldset id="tablacondiciones" style="display:none;" ><legend>CONDICIONES DE  CREDITO</legend>
                     <table>
                     <TR>
                     <TD><label>Num.Cuotas</label><input  type="text" size="7"  readonly="readonly" value="<?php echo $credito["num_cuotas"];?>" id="num_cuotas" name="num_cuotas"/>
                     
                     </TD>
                     <td><label>Dias de Pago</label>
                     <input type="text"  value="<?php echo $credito["diaspago"];?>" readonlysize="7"id="diaspago" name="diaspago"/>
                    
                     
                     </td>
                     <td><label>Dias de Gracia</label>
                     <input type="text"  value="<?php echo $credito["dias"];?>"  readonly="readonly"size="7"id="dias" name="dias"/>
                    
                     
                     </td>
                    
                     
                     <td>
                     <input  type="button" value="Ver Plan de Pagos"   name="btn_cuotas" id="btn_cuotas"onclick="verPlanPagos();" />
                     </td>
                     </TR>
                     
                     </table>
                     </fieldset>
                     <fieldset><legend><input type="checkbox" disabled="disabled"  value="0"  id="descuento"/>DESCUENTO</legend>
                     <table  id="tabladescuento" style="display:none;">
                     <TR>
                     <TD>
                     <label>Monto total</label>
                     <input type="text"  readonly="readonly" id="totalventa"  readonly="readonly" value="<?php echo $credito["saldo_inicial"]?>" />
                     
                    
                     </TD>
                     <td>
                     <label>Tipo Descuento</label>
                     <select id="tipo_desc" name="tipo_desc" >
                     <option <?php if($res["tipo_desc"]=="porcentaje"){?> selected="selected" <?php }?> value="porcentaje">Porcentaje</option>
                     <option <?php if($res["tipo_desc"]=="monto"){?> selected="selected" <?php }?>value="monto">Monto fijo</option>
                     
                     
                     </select>
                     </td>
                     <td>
                     <label>Descuento</label>
                     <input  type="text" id="descuentomonto" name="monto_descuento" readonly value="<?php  echo $res["monto_descuento"]?>"/>
                     </td>
                     <td>
                     <label>Total   a cancelar</label>
                     <input  readonly="readonly"type="text" id="totalcancelar"  readonly="readonly"name="totalcancelar" value="<?php echo $res["total_cancelar"]?>" />
                     </td>
                     </TR>
                     
                     </table>
                     
                     
                     </fieldset>
                     
                     
                     <fieldset><legend>MEDIO TRASPORTE</legend>
                     <table  >
                     <TR>
                     <TD>
                     <label>Medio de Trasporte para el Despacho</label>
                     <input type="text"  name="transporte" size="55" readonly value="<?php echo $res["transporte"];?>"/>
                     
                    
                     </TD>
                     
                     </TR>
                     
                     </table>
                     
                     
                     </fieldset>
                     <table>
                     <tr>
		<th>&nbsp;</th>
</tr>
        <tr align="center">
		
		<td valign="top" colspan="8">
			<input type="button" id="bEnviar" value="Guardar Venta" name="bEnviar" onclick="validarEnviar();" />
<!--           <input type="button" id="bVender" value="Vender" name="bEnviar" onclick="validarVender();" />
-->
            <input type="button" id="cancelar" value="Cancelar"  name="cancelar"  onclick="javascript:window.location='<?php config::ruta()?>?accion=editarVenta';"/>
                 <input type="hidden" name="editar" id="editar" value="editar" />
               
               <input type="hidden" name="num_filas" id="num_filas" />
               <input type="hidden" name="vender" id="vender" />
               <input type="hidden" name="tipoventa" id="tipoventa" />
               <input type="hidden" name="idventas" id="idventas" value="<?php echo $res["idventas"]?>" />
               <input type="hidden" name="idegreso" id="idegreso" value="<?php echo $res["idegreso"]?>" />


               <input type="hidden" name="valor_cambio" id="valor_cambio" value="<?php echo $tc2["valor"];?>" />
</td>
</tr>
               </table>
               
              
            </form>
            
          
            </div>
            
        
            <?php } ?>
           
            
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