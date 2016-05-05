<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#inventario-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
$('#inventario-table').dataTable( {
		
		"fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#inventario-table body  ');
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

         var columnas = [2,3,4,5,6,7,8,9,10]; //the columns you wish to add                      
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
            
            <form name="form"   method="post"  action="<?php echo config::ruta();?>?accion=inventario">
         <table>
         <tr>
           <td><table>
             <tr>
              
              <th> 
            <label for="mes">Mes</label>
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



</select>
              
              </th>
               <th> <label for="anio">Año</label><select name="anio" class="inp2-form">
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
               
               <td><input type="hidden" name="consulta" value="consulta"/>
                 <input type="submit" style=" background-color:#CF0; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;"   value="Consultar" /></td>
             </tr>
             <!--<tr>
          <td class="blue-left" colspan="6" > <a href="<?php config::ruta();?>?accion=kardexMayorTotal">Kardex Mayor Del Total de Items por Mes</a> </td>
             </tr>-->
           </table>
         
         
      </form>
            <h2 id="contact">           ALMACEN > INVENTARIO
</h2>
<div style="float:rigth;">
 <form action="<?php config::ruta();?>?accion=reporteInventario" method="post" target="_blank" id="FormularioExportacion">
<p>  <img src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />

<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
<?php if(isset ($_POST["consulta"])&&$_POST["consulta"]=="consulta"){?>

           <table border="0"   width="100%"cellpadding="0" cellspacing="0" id="inventario-table" >
                <thead>
				<tr align="left">
					
					
                    <th class="">Codigo</th>
                    <th  width="390" class="">Titulo</th>
                    <th >CIF</th>
                    <th class="">SALDO AL <br /><?php echo "31-".$mes2."-".$anio2 ?> </th>
                    <th class="">CANTIDAD<BR />INGRESOS </th>
                    <th class="">BS</th>
                    <th class="">CANTIDAD<BR />EGRESOS</th>
                     <th class="">BS</th>
                     <th class="">SALDO AL <br /><?php echo "31-".$_POST["mes"]."-".$_POST["anio"] ?> </th>
                      <th class="">COSTO INICIAL</th>
                       <th class="">COSTO FINAL</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
					 $saldo_ante=0;
					?>
               <tr>
                <td><?php echo $v["codigo"]?></td>
                <td><?php echo utf8_decode($v["titulo"]);?></td>
                 <td><?php echo $v["cif"];?></td>
                <td>
                <?php
				$ingreso_ant=$ingreso->sumIngresoInventarioAnt($mes2 , $anio2,$v["idlibros"]);
				$egreso_ant=$egreso->sumEgresoInventarioAnt($mes2 , $anio2,$v["idlibros"]);
				
				$saldo_ante=$ingreso_ant-$egreso_ant;
				echo $saldo_ante;
				 ?>
                
                </td>
                <td>
                <?php
				$ingreso_act=$ingreso->sumIngresoInventario($_POST["mes"] , $_POST["anio"],$v["idlibros"]);
				if($ingreso_act<=0)$ingreso_act=0;
			
				
				echo $ingreso_act;
				 ?>
                 
                
                </td>
                <td>
                <?php $m1=$v["cif"]*$ingreso_act; echo$m1;?>
                 </td>
                  <td>
                <?php
				$egreso_act=$egreso->sumEgresoInventario($_POST["mes"] , $_POST["anio"],$v["idlibros"]);
				
				if($egreso_act<=0)$egreso_act=0;
			
				echo $egreso_act;
				 ?>
                 
                
                </td>
               
                <td>
                <?php $m2=$v["cif"]*$egreso_act; echo $m2;?>
                 </td>
                 <td>
                 <?php $saldo_act=$saldo_ante+$ingreso_act-$egreso_act; echo $saldo_act;?>
                 
                 </td>
                 <td><?php $costo_ant=$saldo_ante*$v["cif"]; echo $costo_ant;?></td>
                  <td><?php $costo_act=$saldo_act*$v["cif"]; echo $costo_act;?></td>
				</tr>
				<?php }// fin 
				?>
             
               
                <tbody>
                <tfoot>
                <th></th>
                <th>TOTALES</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
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