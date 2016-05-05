<?php require_once("head.php");?>


<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">RELACION DE NOTAS</h2>
            <div>
           <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="">
      <table>
     
<tr>
<th colspan="2" > <label for="almacenes">TIPO</label>
       <select class="inp-form" name="notas">
      
			  <option value="ingreso">NOTAS DE INGRESO</option>
              <option value="egreso">NOTAS DE EGRESO</option>

			
		</select>
       </th>
<th><label for="mes">Mes</label>
<select name="mes" class="inp-form">
<option value="1">ENERO</option>
<option value="2">FEBRERO</option>
<option value="3">MARZO</option>
<option value="4">ABRIL</option>
<option value="5">MAYO</option>
<option value="6">JUNIO</option>
<option value="7">JULIO</option>
<option value="8">AGOSTO</option>
<option value="9">SEPTIEMBRE</option>
<option value="10">OCTUBRE</option>
<option value="11">NOVIEMBRE</option>
<option value="12">DICIEMBRE</option>



</select></th>
<th><label for="anio">Año</label><select name="anio" class="inp2-form">
<option value="2013">2013</option>
<option value="2014" selected="selected">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>



</select>
  


        <td>&nbsp;</td>
                <td>
              
                
                <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" type="submit"  value="Consultar"  name="consulta"/></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <?php if(isset($_POST["consulta"]) &&isset($_POST["notas"]) &&$_POST["notas"]=="ingreso"){?>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" name="tipo" value="relacionNotasIngreso"/
  <input type="hidden" name="fecha" value="<?php if(isset($_POST["consulta"])){
	  
	  switch($mes){
		  case '1': $mes="Enero"; break;
		  case '2': $mes="Febrero"; break;
		  case '3': $mes="Marzo"; break;
		   case '4': $mes="Abril"; break;
		    case '5': $mes="Mayo"; break;
			 case '6': $mes="Junio"; break;
			  case '7': $mes="Julio"; break;
			   case '8': $mes="Agosto"; break;
			    case '9': $mes="Septiembre"; break;
				 case '10': $mes="Octubre"; break;
				  case '11': $mes="Noviembre"; break;
				   case '12': $mes="Diciembre"; break;
	  }
		
	   echo "AL 31  de ".$mes." del ". $anio; ?>"<?php }?> />
              
</form>
</div>

<table border="0"  cellpadding="0"  cellspacing="0" id="categorias-table" style="font-size:11px; margin:auto;  width:100%; text-align:center;">
                <thead>
				<tr style="background-color:#CAEDF9; ">
				
					<th width="95" >FECHA </th>
                    <th  width="250">PROCEDENCIA</th>
                    <th >N&deg;DOC</th>
                     <th >INGRESO</th>
                    <th >CONCEPTO</th>
                    <th >OBSERVA<br />CIONES</th>
                    <th >N&deg; DOC <BR />INGRESO</th>
                    <th>CODIGO</th>
                     <th  >TITULO</th>
                     <th >P.CIF</th>
                      <th >P.TOTAL</th>
                    
				</tr>
				
				</thead>
                <tbody>
                <?php 
				$cant=0;
				$total=0;
				foreach($res as $v){
					$cant=$cant+$v["cantidad"]; 
					$libro=$li->getCodigoTitulo($v["libros_idlibros"]);
				?><tr>
									
					<td><?php echo $v["fecha"];?></td>
                    <td ><?php echo $v["envia"];?></td>
                    <td><?php echo $v["idingreso"]?></td>
                                        <td><?php echo $v["cantidad"];?></td>

                    <td><?php echo $v["concepto"]?></td>
                   <td ><?php echo $v["recibe"]?></td>
                    <td ><?php echo $v["documento"]?></td>
                     <td ><?php echo $libro["codigo"];?></td>
                      <td ><?php echo $libro["titulo"];?></td>
                   
                    <td  align="right"><?php $v1=str_replace(".",",",$v["precio_unitario"]);echo $v1;?></td>
                    <td align="right"><?php $total+=$v["precio_total"]; $v2=str_replace(".",",",$v["precio_total"]);echo $v2;?></td>
                   
                    			
				</tr>
                
                <?php
				}
				?>
               
                </tbody>
                <tfoot>
                 <tr style=" font-weight:bold; background-color:#FC0">
                  <td>&nbsp;</td>
                  <td colspan="2" >Total</td>
                                    <td align="right";><?php echo $cant; ?></td>

                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td >&nbsp;</td>
                  <td ></td>
                  <td ></td>
                  <td >&nbsp;</td>
               
                  <td><?php $v3=str_replace(".",",",$total);echo $v3; ?></td>
                </tr>
                
                </tfoot>
            
				</table>
				<?php }?>
				
                
                
                <?php if(isset($_POST["consulta"]) &&isset($_POST["notas"]) &&$_POST["notas"]=="egreso"){?>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" name="tipo" value="relacionNotasEgreso"/
  <input type="hidden" name="fecha" value="<?php if(isset($_POST["consulta"])){
	  
	  switch($mes){
		  case '1': $mes="Enero"; break;
		  case '2': $mes="Febrero"; break;
		  case '3': $mes="Marzo"; break;
		   case '4': $mes="Abril"; break;
		    case '5': $mes="Mayo"; break;
			 case '6': $mes="Junio"; break;
			  case '7': $mes="Julio"; break;
			   case '8': $mes="Agosto"; break;
			    case '9': $mes="Septiembre"; break;
				 case '10': $mes="Octubre"; break;
				  case '11': $mes="Noviembre"; break;
				   case '12': $mes="Diciembre"; break;
	  }
		
	   echo "AL 31  de ".$mes." del ". $anio; ?>"<?php }?> />
              
</form>
</div>

<table border="0"  cellpadding="0" cellspacing="0" id="categorias-table" style="font-size:11px; margin:auto;  width:100%; text-align:center;">
                <thead>
				<tr style="background-color:#CAEDF9; ">
				
					<th width="95" >FECHA </th>
                    <th  width="250">PROCEDENCIA</th>
                    <th >N&deg;DOC</th>
                     <th >EFGRESO</th>
                    <th >CONCEPTO</th>
                    <th >OBSERVA<br />CIONES</th>
                    <th >N&deg; NOTA <BR />VENTA</th>
                    <th>CODIGO</th>
                     <th  >TITULO</th>
                     <th >P.CIF</th>
                      <th >P.TOTAL</th>
                    
				</tr>
				
				</thead>
                <tbody>
                <?php 
				$cant=0;
				$total=0;
				foreach($res as $v){
					$cant=$cant+$v["cantidad"]; 
					$libro=$li->getCodigoTitulo($v["libros_idlibros"]);
				?><tr>
									
					<td><?php echo $v["fecha"];?></td>
                    <td ><?php echo $v["envia"];?></td>
                    <td><?php echo $v["idegreso"]?></td>
                                        <td><?php echo $v["cantidad"];?></td>

                    <td><?php echo $v["concepto"]?></td>
                   <td ><?php echo $v["recibe"]?></td>
                    <td ><?php echo $v["idventas"]?></td>
                     <td ><?php echo $libro["codigo"];?></td>
                      <td ><?php echo $libro["titulo"];?></td>
                   
                    <td  align="right"><?php $v1=str_replace(".",",",$v["precio_unitario"]);echo $v1;?></td>
                    <td align="right"><?php $total+=$v["precio_total"]; $v2=str_replace(".",",",$v["precio_total"]);echo $v2;?></td>
                   
                    			
				</tr>
                
                <?php
				}
				?>
               
                </tbody>
                <tfoot>
                 <tr style=" font-weight:bold; background-color:#FC0">
                  <td>&nbsp;</td>
                  <td colspan="2" >Total</td>
                                    <td align="right";><?php echo $cant; ?></td>

                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td >&nbsp;</td>
                  <td ></td>
                  <td ></td>
                  <td >&nbsp;</td>
               
                  <td><?php $v3=str_replace(".",",",$total);echo $v3; ?></td>
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