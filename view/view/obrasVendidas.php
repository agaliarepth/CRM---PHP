<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#obrasVendidas-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	 
});

 $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#obrasVendidas2-table").eq(0).clone()).html());
     $("#FormularioExportacion2").submit();
	 
	 
});

$('#obrasVendidas-table').dataTable( {
		
		
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
		"aaSorting": [ [0,'asc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
	
	$('#obrasVendidas2-table').dataTable( {
		
		
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
		"aaSorting": [ [0,'asc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
});
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > RELACION IOBRAS VENDIDAS</h2>
            <div>
            <table id="obras"><tr>
            <td>
          <form name="form"  class="notas"  method="post"  action="">
      
    <fieldset > <legend>MENSUAL</legend>
    <table border="0">
<tr>

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

</th>
<th><label>Moneda</label>
<select name="moneda">
<option value="Bs">Bolivianos</option>
<option value="Sus">Dolares</option>

</select>
</th>
              <td>
            
              
                
               <input type="submit" name="bConsultar"  id="bconsultar" value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta" value="consulta"/>
               </td>
          </tr>
         
          </table>
        </fieldset>
               
      </form>
      </td>
      <td>
      
           <form name="form"   method="post"  action="" class="notas">
      
    <fieldset > <legend>RANGO DE MESES</legend>
    <table border="0">
<tr>
<th>DE:</th>
<th><label for="mes">Mes Inicio</label>
<select name="mes_ini" class="inp-form">
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



</select></th> <th>A:</th>
<th><label for="mes">Mes Fin</label>
<select name="mes_fin" class="inp-form">
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

<th>DEL:</th>
<th><label for="anio">Año</label><select name="anio2" class="inp2-form">
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

</th>
<TH><label>Vendedor</label>
<select name="idvendedor">
<option value="-1">TODOS </option>

<?php foreach($listaVendedores1 as $v){?>
<option value="<?php echo $v["idvendedores"]?>"><?php echo $v["nombres"] ?></option>
<?php }?>
</select>
</TH>

              <td>
            
              
                
               <input type="submit" name="bConsultar"  id="bconsultar" value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta2" value="consulta2"/>
               </td>
          </tr>
         
          </table>
        </fieldset>
               
      </form>
      </td>
      
      </tr>
      </table>
      
 <?php      if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){?>
	 <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 

            
 <form  style="float:right" action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="obrasVendidas"  />
<input type="hidden" id="mes" name="mes"  value="<?php echo $mes;?>"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $anio;?>"  />


</form>
</div>
           <table border="0" cellpadding="0" cellspacing="0" id="obrasVendidas-table">
           <thead>
           <tr style="background-color:#C6EDF4">
           <th>COD <br />ITEM</th>
           <TH>TITULO</TH>
           <?php foreach($listaVendedores as $v){?>
           <TH>CANTIDAD <br /><?php echo $v["vendedor"];?></TH>
           <?php }?>
           <th>TOTAL <br />CANTIDAD</th>
           <TH>CIF</TH>
           <TH>COSTO DE <br />VENTA</TH>
           <TH>P.U.V.</TH>
           <TH>%</TH>
           <TH>PRECIO DE <BR />VENTA</TH>
           
           
           <TH>UTILIDAD <BR />BRUTA</TH>
           <TH>%</TH>
           </tr>
           </thead>
           <tbody>
           <?php
		   $s1=0;
		    $s2=0;
			 $s3=0;
			  $s4=0;
			   $s5=0;
			   $s6=0;
			   $s7=0;
			   $s8=0;
		    foreach($lista as $r){
				$sum_cantidad=0;
				?>
           <tr>
           <td align="center"><?php echo $r["codigo"];?></td>
           <td><?php $tit=$libros->getCodigoTitulo($r["libros_idlibros"]); echo $tit["titulo"];?></td>
           <?php foreach($listaVendedores as $v){  ?>
           
               <td align="center"><?php  $res=$detalleVentas->sumarPorCodigo($r["codigo"],$mes,$anio,$v["idvendedores"]); $cantidad=$res["sumcantidad"]; echo $cantidad; $sum_cantidad+=$cantidad; ?></td>   
           <?php }?>
           <td align="center"><?php  $s1+=$sum_cantidad; echo $sum_cantidad;?></td>
           <td align="right">
		   <?php
		    if($_POST["moneda"]=="Bs")
		   {
			   $res=$libros->getPrecios($r["libros_idlibros"]);  $cif=$res["cif"]; $s2+=$cif; echo $cif;
		   }
		  if($_POST["moneda"]=="Sus")
		   {
			    $res=$libros->getPrecios($r["libros_idlibros"]);  $cif=round($res["cif"]/$tc2["valor"],2);  $s2+=$cif;echo $cif;
		   }
		    
			?>
            </td>
           <td align="right"><?php $costo_venta=$cif*$sum_cantidad;  $s3+=$costo_venta;echo  sprintf("%01.2f",$costo_venta); ?></td>
            <?php
		   if($_POST["moneda"]=="Bs")
		   {
			   $sumaprecio_bs=$detalleVentas->sumarPrecioPorCodigo($r["codigo"],$mes,$anio,"Bs");
			     $sumaprecio_sus=$detalleVentas->sumarPrecioPorCodigo($r["codigo"],$mes,$anio,"Sus");
				 $total_precio=$sumaprecio_bs+round($sumaprecio_sus*$tc2["valor"],2);
			   }
			   if($_POST["moneda"]=="Sus")
		   {
			   $sumaprecio_bs=$detalleVentas->sumarPrecioPorCodigo($r["codigo"],$mes,$anio,"Bs");
			     $sumaprecio_sus=$detalleVentas->sumarPrecioPorCodigo($r["codigo"],$mes,$anio,"Sus");
				 $total_precio=$sumaprecio_sus+round($sumaprecio_bs/$tc2["valor"],2);
			   }
			    $s4+=$total_precio;
		   ?>
            <td align="right"><?php $puv=round($total_precio/$sum_cantidad,2); $s5+=$puv; echo  sprintf("%01.2f",$puv);?></td>
           <td align="right"><?php  $porcen_1= round((($puv-$cif)*100)/$cif,2);  $s6+=$porcen_1;echo sprintf("%01.2f",$porcen_1);?></td>
           <td align="right">
		   <?php
		   echo sprintf("%01.2f", $total_precio);
		   ?>
           </td>
          
           <td align="right"><?php $utilidad_bruta=$total_precio-$costo_venta; $s7+=$utilidad_bruta; echo sprintf("%01.2f",$utilidad_bruta);?></td>
           <td align="right"><?php $porcen_2=round(($utilidad_bruta*100)/$costo_venta,2);  $s8+=$porcen_2;echo sprintf("%01.2f",$porcen_2);?></td>
           </tr>
           <?php }?>
           </tbody>
           <tfoot>
            <tr>
                <th  style="text-align:right">Total:</th>
                <th></th>
                 <?php foreach($listaVendedores as $v){?>
           <TH><?php ?></TH>
           <?php }?>
               <th align="right"><?php echo sprintf("%01.2f",$s1);?></th> 
              <th align="right"><?php echo sprintf("%01.2f",$s2);?></th> 
               <th align="right"><?php echo sprintf("%01.2f",$s3);?></th> 
               <th align="right"><?php echo sprintf("%01.2f",$s5);?></th> 
               <th align="right"><?php echo sprintf("%01.2f",$s6);?></th> 
                             <th align="right"><?php echo sprintf("%01.2f",$s4);?></th> 

                <th align="right"><?php echo sprintf("%01.2f",$s7);?></th> 
                <th align="right"><?php echo sprintf("%01.2f",$s8);?></th> 
            </tr>
           </tfoot>
           </table>
     
     
	 
<?php }// FIN DE TODO?>
      
     <?php  if(isset($_POST["consulta2"])&& $_POST["consulta2"]=="consulta2"){?>
	  <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 

            
 <form  style="float:right" action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion2">
<p><img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="obrasVendidas2"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $anio;?>"  />


</form>
</div>
	 <table id="obrasVendidas2-table">
     <thead>
     <tr>
     <th>COD. <BR />ITEM</th>
     <TH>TITULO</TH>
     <?php 
	 $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	 for ($i=$mes1;$i<=$mes2; $i++){ ?>
     <th><?php echo $meses[$i-1];?></th>
     <?php }?>
     <TH>TOTAL</TH>
     </tr>
     </thead>
     <tbody>
     <?php
	 
	  foreach($listaCodigos as $r){?>
        <tr>
        <td align="center"><?php echo $r["codigo"]  ?></td>
         <td><?php echo $r["titulo"]  ?></td>
         <?php 
	 $sum=0;
	 $sum2=0;
	 for ($i=$mes1;$i<=$mes2; $i++){ ?>
     <td align="right">
	 <?php 
	  if($_POST["idvendedor"]=="-1"){
	  $sum=$detalleVentas->sumarPorCodigo2($r["codigo"],$i, $anio); echo $sum; $sum2+=$sum;
	  }
	  else{
		  $sum=$detalleVentas->sumarPorCodigoVendedor($r["codigo"],$i, $anio,$idvendedor); echo $sum; $sum2+=$sum;
		  }
	  ?></td>
     <?php }?>
     <th align="right"><?php echo $sum2;?></th>
        </tr>
     <?php }// fin foreach lista codigos?>
     </tbody>
     <tfoot>
     <tr>
     <th></th>
     <th>TOTAL</th>
     <?php
	 $total=0;
	 for ($i=$mes1;$i<=$mes2; $i++){ ?> 
      <th align="right"><?php 
	   if($_POST["idvendedor"]=="-1"){
	  $cant=$detalleVentas->sumarPorMes($i, $anio); echo $cant; $total+=$cant;
	     }
      else{
		  
		    $cant=$detalleVentas->sumarPorMesVendedor($i, $anio,$idvendedor); echo $cant; $total+=$cant;
		  }
	  
	  ?>
   
      </th>
     <?php }?>
     <th align="right" style="color:#039; font-weight:bold; font-size:16px;"><?php echo $total;  ?></th>
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