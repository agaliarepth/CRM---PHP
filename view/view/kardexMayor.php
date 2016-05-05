<?php require_once("head.php");?>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


	
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardexmayor-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
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
          <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=kardexMayor">
         <table>
         <tr>
           <td><table>
             <tr>
               <th> <h4>
                 <label >Codigo o titulo</label>
               </h4>
                 <p></p>
                 <input type="text" name="libro"  class="inp2-form" id="libro" />
               </th>
               <th colspan="5"> <h4 >
                 <label >Titulo Libro</label>
               </h4>
                 <input type="text" name="titulo" id="titulo" class="inp4-form"  />
                 <input type="hidden" name="idlibro" id="idlibro" /></th>
              <th> <label>Fecha Inicial</label>
              <input  type="text" name="fecha_ini" class="fechas" id="fecha" value="<?php echo date("Y-m-d")?>"/>
              
              </th>
               <th> <label>Fecha Final</label>
              <input  type="text" name="fecha_fin" class="fechas" id="fecha2" value="<?php echo  date("Y-m-d")?>"/>
              
              </th>
               
               <td><input type="hidden" name="consulta" value="consulta"/>
                 <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"   value="Consultar" /></td>
             </tr>
             <!--<tr>
          <td class="blue-left" colspan="6" > <a href="<?php config::ruta();?>?accion=kardexMayorTotal">Kardex Mayor Del Total de Items por Mes</a> </td>
             </tr>-->
           </table>
         
         
      </form>
  </div>
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
  <h1>Kardex Mayor ><span style="color:#F30; font-weight:bold"> <?php if(isset($_POST["consulta"])) echo $_POST["libro"]." - ".$_POST["titulo"];?></span> </h1>
<br />


				<?php if(isset($_POST["consulta"])){?>
				<table   border="1" id="kardexmayor-table" cellpadding="0" cellspacing="0" class="kardex" style="font-size:12px;"  >
<tbody>
				  <tr align="center">
				    <td align="center"><table   border="1"  cellpadding="0" cellspacing="0" class="kardex"  >
				      <thead style="background-color:#999; font-size:9px;">
				        <tr>
				          <th width="17" rowspan="2" >N&deg;</th>
				          <th width="32" rowspan="2">FECHA</th>
				          <th width="148" rowspan="2"  class="">PROCEDENCIA</th>
				          <th width="55" rowspan="2" class="">NºDOC</th>
				          <th colspan="3" align="center">MOVIMIENTO</th>
				          <th width="140" rowspan="2"  class="">CONCEPTO</th>
                          <th width="55" rowspan="2"  class=""></th>
                          <th width="140" rowspan="2"  class="">OBSERVACIONES</th>
				        </tr>
			          
				      <tr>
				        <th width="50" align="center">INGRESO</th>
				        <th width="57" align="center">SALIDA</th>
				        <th width="31" align="center">SALDO</th>
			          </tr>
                      </thead>
				      <tbody>
				       <tr style=" color:#039; font-size:14px; font-weight:bold;">
                      <td colspan="3">SALDO AL::<?php echo $fecha2;?> </td>
                      
                          <td></td>
                          <td></td>
                          <td></td>
                          <td align="right"><?php echo $saldo;?> </td>
                          <td></td>
                          <td></td>
                      </tr>
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
                            <td align="right"><?php $saldo+=$v["cantidad"]; echo $saldo;?></td>
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
                            <td align="right"><?php $saldo-=$v["cantidad"]; echo $saldo;?></td>
                             <td align="center"><?php echo $v["concepto"];?></td>
                             <td></td>
                                <td align="center"><?php echo $v["recibe"];?></td>
                      
                      </tr>
                      
                      <?php $cont++;}?>
					  <tr style=" color:#F30; font-size:14px; font-weight:bold;">
                      <td></td>
                       <td></td>
                        <td></td>
                          <td></td>
                          <td></td>
                          <td>SALDO</td>
                          <td align="right"><?php $saldo-=$sum2; echo $saldo;?></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
					
				      
			          </tbody>
				      <tfoot>
				     
				     
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