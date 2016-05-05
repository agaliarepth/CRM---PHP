<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#produccionVentas-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});


     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#produccionVentas2-table").eq(0).clone()).html());
     $("#FormularioExportacion2").submit();
});

  $('#produccionVentas2-table').dataTable( {
		
		
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
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
	
	$('#produccionVentas-table').dataTable( {
		 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#produccionVentas-table body ');
            var iColspan = nTrs[0].getElementsByTagName('td').length;
            var sLastGroup = "";
            for (var i = 0; i < nTrs.length; i++) {
                var iDisplayIndex = oSettings._iDisplayStart + i;
                var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData[0];
                if (sGroup != sLastGroup) {
                    var nGroup = document.createElement('tr');
                    var nCell = document.createElement('td');
                    nCell.colSpan = iColspan;
                    nCell.className = "group";
                    nCell.innerHTML = sGroup;
                    nGroup.appendChild(nCell);
                    nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
                    sLastGroup = sGroup;
                }
            }
        },
		"fnFooterCallback": function (nRow, aasData, iStart, iEnd, aiDisplay) {

            var columnas = [3,4,5,6,7,8]; //the columns you wish to add            
            for (var j in columnas) {
                var columnaActual = columnas[j];
                var total = 0;
                for (var i = iStart; i < iEnd; i++) {
                    total = total + parseFloat(aasData[aiDisplay[i]][columnaActual]);
                }
                $($(nRow).children().get(columnaActual)).html(total.toFixed(2));
               
            } // end 

        }, // end footercallback
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
            
            
            <h2 id="contact">VENTAS > PLANILLA DE PRODUCCION</h2>
             
            <div>
           <table>
           <tr><td>
          <form name="form"   method="post"  action="" class="notas">
      
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
<TH><label>Vendedor</label>
<select name="idvendedor">
<option value="-1">TODOS </option>

<?php foreach($listaVendedores as $v){?>
<option value="<?php echo $v["idvendedores"]?>"><?php echo $v["nombres"] ?></option>
<?php }?>
</select>
</TH>
              <td>
            
              
                
                 <input type="submit" name="bConsultar"  id="bconsultar" value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta" id="consulta"/ value="consulta"/>
               </td>
          </tr>
         
          </table>
        </fieldset>
               
      </form>
      </td>
      <td>
                <form name="form"   method="post"  action="" class="notas">
      
    <fieldset > <legend>RANGO FECHAS</legend>
    <table border="0">
<tr>
<TD>DE:</TD>
<th><label for="mes">MES INICIO </label>
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



</select></th>
<TH>A:</TH>

<th><label for="mes">MES FIN</label>
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
<TH>DEL</TH>
<th><label for="anio">AÑO</label><select name="anio2" class="inp2-form">
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
<th><label>MONEDA</label>
<select name="moneda2">
<option value="Bs">Bolivianos</option>
<option value="Sus">Dolares</option>

</select>
</th>
<TH><label>VENDEDOR</label>
<select name="idvendedor2">
<option value="-1">TODOS </option>

<?php foreach($listaVendedores as $v){?>
<option value="<?php echo $v["idvendedores"]?>"><?php echo $v["nombres"] ?></option>
<?php }?>
</select>
</TH>
              <td>
            
              
                
                 <input type="submit" name="bConsultar"  id="bconsultar" value="Consultar" /></td>
                <td>
                <input type="hidden" name="consulta2" id="consulta2"/ value="consulta2"/>
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
<p> <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="cuadroProduccion"  />
<input type="hidden" id="mes" name="mes"  value="<?php echo $mes;?>"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $anio;?>"  />
<input type="hidden"  name="nombrevendedor"  value="<?php  $ven=$vendedor->getVendedores($idvendedor);echo $ven["nombres"];?>"  />


</form>
</div>
           <table border="0" cellpadding="0" cellspacing="0" id="produccionVentas-table">
           <thead>
           <tr style="background-color:#C6EDF4">
           <th>VENDEDOR</th>
           <th>CIUDAD</th>
           <TH>CLIENTE</TH>
           <th>CANTIDAD <BR /> CONTADO</th>
           <th>MONTO<BR />CONTADO</th>
            <th>CANTIDAD <BR /> CREDITO</th>
           <th>MONTO <BR />CREDITO</th>
           <th>TOTAL CANTIDAD</th>
           <th>TOTAL MONTO</th>
          </tr>
           </thead>
           <tbody>
           <?php
		  
		    foreach($listaClientes as $r){
				$sum_cantidad=0;
				?>
           <tr>
           <td><?php  if($_POST["idvendedor"]!=-1) echo $r["vendedor"]; else
	   echo "TODOS VENDEDORES";?></td>
           <td><?php $cli=$cliente->getNombre($r["clientes_idclientes"]); echo $cli["ciudad"];?></td>
       <td><?php  echo utf8_decode($cli["nombres"]." ".$cli["apellidos"]);//$n= preg_replace(“�?”,”ñ”,$n);?></td>
           <TD align="center">
		   <?php 
		    $cc=$detalleVentas->sumarCantidadPorCliente($mes, $anio,$r["clientes_idclientes"],"CONTADO");
			if($cc=="")
			echo "0";
			else
			 echo $cc; ?></TD>
           <td align="right">
           <?php
           if($_POST["moneda"]=="Bs"){
			   $totalcontado_bs=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Bs","CONTADO");
			   $totalcontado_sus=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Sus","CONTADO");
			   $totalcontado=$totalcontado_bs+round($totalcontado_sus*$tc2["valor"],2);
			   			   
			   }
			   if($_POST["moneda"]=="Sus"){
			   $totalcontado_bs=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Bs","CONTADO");
			   $totalcontado_sus=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Sus","CONTADO");
			   $totalcontado=$totalcontado_sus+round($totalcontado_bs/$tc2["valor"],2);
			   			   
			   }
			   echo  sprintf("%01.2f",$totalcontado);
		   
		   ?>
           </td>
           <TD align="center"><?php $cred=$detalleVentas->sumarCantidadPorCliente($mes, $anio,$r["clientes_idclientes"],"CREDITO");
		   if($cred=="")
		   echo"0";
		   else
		    echo $cred; ?></TD>
           <td align="right">
           <?php
           if($_POST["moneda"]=="Bs"){
			   $totalcredito_bs=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Bs","CREDITO");
			   $totalcredito_sus=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Sus","CREDITO");
			   $totalcredito=$totalcredito_bs+round($totalcredito_sus*$tc2["valor"],2);
			   			   
			   }
			   if($_POST["moneda"]=="Sus"){
			$totalcredito_bs=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Bs","CREDITO");
			   $totalcredito_sus=$detalleVentas->sumarPrecioPorCliente($mes, $anio,$r["clientes_idclientes"],"Sus","CREDITO");
			   $totalcredito=$totalcredito_sus+round($totalcredito_bs/$tc2["valor"],2);
			   			   
			   }
			   echo sprintf("%01.2f",$totalcredito);
		   
		   ?>
           </td>
           <td align="right"><?php $tc=$cc+$cred; echo sprintf("%01.2f",$tc); ?></td>
            <td align="right"><?php $tp=$totalcontado+$totalcredito; echo sprintf("%01.2f",$tp); ?></td>
			
           </tr>
           <?php }?>
           </tbody>
           <tfoot>
           <tr>
           <th></th>
            <th></th>
             <th></th>
              <th></th>
               <th align="right"></th>
                <th></th>
                 <th align="right"></th>
                  <th align="right"></th>
                   <th align="right"></th>
           </tr>
            
           </tfoot>
           </table>
     
     
	 
<?php }// FIN DE TODO?>

<?php
      if(isset($_POST["consulta2"])&& $_POST["consulta2"]=="consulta2"){?>
       <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 

            
 <form  style="float:right" action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion2">
<p> <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="cuadroProduccion2"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $anio;?>"  />


</form>
</div>
      <table id="produccionVentas2-table">
      <thead>
      <tr>
      <th>VENDEDOR</th>
      <th>CIUDAD</th>
      <th>CLIENTE</th>
       <?php 
	 $meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
	 for ($i=$mes1;$i<=$mes2; $i++){ ?>
     <th><?php echo $meses[$i-1];?></th>
     <?php }?>
     <TH>TOTAL</TH>
      </tr>
      </thead>
      <tbody>
      <?php foreach($listaClientes as $r){?>
	  
	  <tr>
       <td><?php if($_POST["idvendedor2"]!=-1) echo $r["vendedor"]; else
	   echo "TODOS VENDEDORES";?></td>
      <td><?php $cli=$cliente->getNombre($r["clientes_idclientes"]); echo $cli["ciudad"];?></td>
       <td><?php  echo utf8_decode($cli["nombres"]." ".$cli["apellidos"]);//$n= preg_replace(“�?”,”ñ”,$n);?></td>
       <?php
	   $sum1=0;
	    for ($i=$mes1;$i<=$mes2; $i++){ ?>
     <td align="right"><?php
	            $total=0;
	           $total_bs=$detalleVentas->sumarPrecioPorCliente2($i, $anio,$r["clientes_idclientes"],"Bs");
  	           $total_sus=$detalleVentas->sumarPrecioPorCliente2($i, $anio,$r["clientes_idclientes"],"Sus");
			   if($_POST["moneda2"]=="Bs"){ $total=$total_bs+round($total_sus*$tc2["valor"],2); }
			    if($_POST["moneda2"]=="Sus"){ $total=$total_sus+round($total_bs/$tc2["valor"],2); }
				
				echo sprintf("%01.2f",$total); $sum1+=$total;

	 
	   ?></td>
     <?php }//fin for?>
     <th align="right"><?php echo sprintf("%01.2f",$sum1);?></th>
      </tr>
	  <?php }// fin de foreach lista clientes?>
      
      </tbody>
      <tfoot>
       <tr>
     <th></th>
     <th></th>
     <th>TOTAL</th>
     <?php
	 $sum2=0;
	 for ($i=$mes1;$i<=$mes2; $i++){ ?> 
      <th align="right"><?php 
	  if($_POST["idvendedor2"]=="-1"){
		$total_bs=$detalleVentas->sumarTotalMesTodos($i, $anio,"Bs");  
		$total_sus=$detalleVentas->sumarTotalMesTodos($i, $anio,"Sus");
		$total=0;
		 if($_POST["moneda2"]=="Bs"){ $total=$total_bs+round($total_sus*$tc2["valor"],2); }
			    if($_POST["moneda2"]=="Sus"){ $total=$total_sus+round($total_bs/$tc2["valor"],2); }
				
				echo sprintf("%01.2f",$total); $sum2+=$total;
		 
	  }
	  else{
		  
		  $total_bs=$detalleVentas->sumarTotalMesVendedor($i, $anio,$idvendedor,"Bs");  
		$total_sus=$detalleVentas->sumarTotalMesVendedor($i, $anio,$idvendedor,"Sus"); 
		$total=0;
		 if($_POST["moneda2"]=="Bs"){ $total=$total_bs+round($total_sus*$tc2["valor"],2); }
			    if($_POST["moneda2"]=="Sus"){ $total=$total_sus+round($total_bs/$tc2["valor"],2); }
				
				echo sprintf("%01.2f",$total); $sum2+=$total;
		  
		  }
	  
	  
	  ?></th>
     <?php }?>
     <th align="right" style="color:#039; font-weight:bold; font-size:16px;"><?php echo  sprintf("%01.2f",$sum2);  ?></th>
     </tr>
     
      
      </tfoot>
      
      
      </table>
      <?php }//FIN DE LISTACLIENTES?>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>