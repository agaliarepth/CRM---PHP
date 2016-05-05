<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
	 
	 var saldo=parseInt($("#saldoAnterior").html());

	 ordenar();
	
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardexmayor-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	
	 
});
function ordenar(){
	saldo=parseInt($("#saldoAnterior").html());

	 $('#kardex1 tr').each(function () {
		  if($(this).find("td").eq(4).html()!=""){
			  
			  saldo=saldo+parseInt($(this).find("td").eq(4).html());
			  $(this).find("td").eq(6).html(saldo);
			  
			  }
			  if($(this).find("td").eq(5).html()!=""){
			  
			  saldo=saldo-parseInt($(this).find("td").eq(5).html());
			  $(this).find("td").eq(6).html(saldo);
			  
			  }
		  
		  });
	
	  $("#saldoFinal").html(saldo);
	}


 
	
		  
		$("#kardexmayor-table thead").click(function(){
			
			 ordenar();
			});  
$('#kardexmayor-table').dataTable( {
		 
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
	
		
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [1,'asc'] ],
        "bInfo": true,
        "bAutoWidth": true,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    
        });
 ordenar();
});

</script>
<script type="text/javascript">
				// esta rutina se ejecuta cuando jquery esta listo para trabajar
		var stock;
	var titulo;
	var tomo;
	var id;
	var codigo;
	var nextinput = 0;
   var total=0;
		// esta rutina se ejecuta cuando jquery esta listo para trabajar
		$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#libro").autocomplete({
				source: "ajax/searchProductos.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 2,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: productoSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.codigo + ":" + item.titulo + "</a>" )
    .appendTo( ul );
};
		});
		
		function productoSeleccionado(event, ui)
		{
			
			$( "#libro" ).val( ui.item.codigo );
			$( "#titulo" ).val( ui.item.titulo);
			$( "#idlibro" ).val( ui.item.id);
			
			
		
			
			return false;
			
		}
				
	  
  </script> 
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">KARDEX MAYOR</h2>
          <div>
     
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=kardexMayor" class="notas">
       
       <fieldset><legend> </legend>
       
        <table>
             <tr>
               <th> 
                 <label ><b>Codigo o titulo</b></label>
               
               
                 <input  size="12"type="text" name="libro"  class="inp2-form" id="libro" />
               </th>
               <th colspan="5"> 
                 <label ><b>Titulo Libro</b></label>
               
                 <input  size="50"type="text" name="titulo" id="titulo" class="inp4-form"  />
                 <input type="hidden" name="idlibro" id="idlibro" /></th>
              <td> <label><b>Fecha Inicial</b></label>
              <input  type="text" name="fecha_ini" class="fechas" id="fecha" value="<?php echo date("d-m-Y")?>"/>
              
              </td>
               <td> <label><b>Fecha Final</b></label>
              <input  type="text" name="fecha_fin" class="fechas" id="fecha2" value="<?php echo  date("d-m-Y")?>"/>
              
              </td>
               
               <td><input type="hidden" name="consulta" value="consulta"/>
                 <input type="submit" id="bconsultar" value="Consultar" /></td>
             </tr>
           
           </table>
         
          </fieldset>
      </form>
   
    
  <div style="float:right;">
  <?php if(isset($_POST["consulta"])){?>
 <form action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel <img src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="codigo" name="codigo" value="<?php  echo $_POST["libro"];?>"/>
<input type="hidden" id="titulo_libro" name="titulo_libro" value="<?php  echo $_POST["titulo"];?>"/>
<input type="hidden" id="tipo" name="tipo" value="kardexMayor"/>


</form>
<?php }?>
</div>

  <h1><b>KARDEX MAYOR ></b> <span style="color:#F30; font-weight:bold"> <?php if(isset($_POST["consulta"])) echo $_POST["libro"]." - ".$_POST["titulo"];?></span> </h1>
<br />


				<?php if(isset($_POST["consulta"])){?>
				<table  width="75%"   id="kardexmayor-table"  border="1" cellpadding="0" cellspacing="0" >

				 
				      <thead style="background-color:#999; font-size:9px;">
				        <tr>
				          <th width="17"  >N&deg;</th>
				          <th width="32" >FECHA</th>
				          <th width="148"  class="">PROCEDENCIA</th>
				          <th width="55" class="">NºDOC</th>
				           <th width="50" align="center">INGRESO</th>
				        <th width="57" align="center">SALIDA</th>
				        <th width="31" align="center">SALDO</th>
				          <th width="140"  class="">CONCEPTO</th>
                          <th width="55"   class=""></th>
                          <th width="140"   class="">OBSERVACIONES</th>
				      
				       
			          </tr>
                        <tr   style=" color:#039; font-size:14px; font-weight:bold;">
                      <td  >SALDO AL::</td>
                      <td><?php echo date("d/m/Y",strtotime($fecha2));?> </td>
                      <td></td>
                          <td></td>
                          <td align="right"></td>
                          <td></td>
                          <td id="saldoAnterior" align="right"><?php echo $saldo;?> </td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                      
                      <tr style=" color:#039; font-size:14px; font-weight:bold;">
                      <td  ></td>
                      <td></td>
                      <td></td>
                          <td></td>
                          <td align="right"></td>
                          <td></td>
                          <td align="right">&nbsp; </td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                    
                      </thead>
				      <tbody id="kardex1">
				       
                      <?php 
					  $s1=0;
				
					  $cont=1; 
					  foreach($res1 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["recibe"];?></td>
                         <td align="center"><?php echo $v["idingreso"];?></td>
                          <td align="right"><?php echo $v["cantidad"];?></td>
                           <td align="right"><?php ?></td>
                            <td align="right"></td>
                             <td align="center"><?php echo $v["concepto"];?></td>
                             <td></td>
                             <td align="center"><?php echo $v["envia"];?></td>
                      
                      </tr>
                      
                      <?php $cont++;}?>
                      
                      <?php foreach($res2 as $v){?>
					  <tr>
                      
                      <td><?php echo $cont;?></td>
                       <td><?php echo $v["fecha"];?></td>
                        <td><?php echo $v["envia"];?></td>
                         <td align="center"><?php echo $v["idegreso"];?></td>
                          <td align="right"><?php echo "";?></td>
                           <td align="right"><?php echo $v["cantidad"];?></td>
                            <td align="right"></td>
                             <td align="center"><?php echo $v["concepto"];?></td>
                             <td></td>
                                <td align="center"><?php echo $v["recibe"];?></td>
                      
                      </tr>
                      
                      <?php $cont++;}?>
					  
					
				      
			          </tbody>
				      <tfoot>
				     <tr style=" color:#F30; font-size:14px; font-weight:bold;">
                      <td></td>
                       <td></td>
                        <td></td>
                          <td></td>
                          <td></td>
                          <td>SALDO</td>
                          <td  id="saldoFinal" align="right"></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
				     
			          </tfoot>
			        </table>
                    
                    
                  
				<?php }?>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>