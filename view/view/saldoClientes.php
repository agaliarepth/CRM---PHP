<?php require_once("head.php");?>
<script language="javascript">
	$(document).ready(function() {
     $("#botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#registroVentas").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
$('#registroVentas').dataTable( {
		 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#registroVentas body  ');
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

         var columnas = [5,8,9,10,11,12,14,15,18]; //the columns you wish to add                      
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
        "bSort": true,
		"aaSorting": [ [0,'asc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
		
		
    } ).columnFilter({ 
	                sPlaceHolder: "head:after",
					aoColumns: [ 
					           null,
							   { type:  "text"},
							   { type: "select", values: [ 'Power on Server']  },
                               { type: "select", values: [ 'Complete','Failed','Incomplete'] },
                               { type:  "text"},{ type: "text" },{ type: "text" }
                               ]
 
                        });
	
	


 //$(".botonExcel").click(function(e) { window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#registroVentas').html())); e.preventDefault(); });
});

</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">REPORTES > SALDO CLIENTES</h2>
            <div>
            <form  class="notas"name="form" action="" method="post">
            <fieldset> <legend> Filtro de consulta</legend>
         <table>
         <tr>
         
         <td><select name="anio" class="inp2-form">
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
  


        </td>
        <td>Expresado en:
        <select name="moneda">
        <option value="Bs">Bolivianos</option>
         <option value="Sus">Dolares</option>
        </select>
        </td>
        <td>
               <input type="submit" name="bConsultar"  id="bconsultar" value="Consultar" />
               <input type="hidden" name="consulta" id="consulta"/ value="consulta">
               </td>
         </tr>
         
         </table>
         </fieldset>
       
         </form>
          <?php if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){?>
			  <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 

            
 <form  style="float:right" action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p>  <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" id="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="saldoClientes"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $_POST["anio"];?>"  />



</form>
</div>
			 <table width="100" style="width:50%;" id="registroVentas" cellpadding="0"  cellspacing="0"  border="0">
             <thead>
             <tr style="background-color:#C6EDF4;font-size:7px;">
             <th >CIUDAD</th>
             <th >CLIENTE</th>
             <th >SALDO</th>
             
                         </tr>
             </thead>
             <tbody >
            <?php foreach($listaClientes as $f){
				$anio=$_POST["anio"];
	$saldo_inicial=0;
				?>
            <tr>
            <td><?php echo utf8_decode($f["ciudad"]); ?></td>
            <td><?php echo utf8_decode($f["nombres"]." ".$f["apellidos"]); ?></td>
            <td align="right"><?php 
			if($_POST["moneda"]=="Bs"){
		
		
		$montodeuda_bs=$deuda->sumarDeuda($f["idclientes"],$anio,"Bs");
		$montodeuda_sus=$deuda->sumarDeuda($f["idclientes"],$anio,"Sus");
		$totaldeuda=$montodeuda_bs["montodeuda"]+round(($montodeuda_sus["montodeuda"]*$tc2["valor"]),2);
		
		$sumaventas_bs=$detalleventa->totalVentas($anio,$f["idclientes"],"Bs");
		$sumaventas_sus=$detalleventa->totalVentas($anio,$f["idclientes"],"Sus");
		$sumaventas=$sumaventas_bs+round(($sumaventas_sus*$tc2["valor"]),2);
		
		$sumapagos_bs=0;
		$sumapagos_sus=0;
		$listaPagos_bs=$pago->listaPagos($anio,$f["idclientes"],"Bs");
		foreach($listaPagos_bs as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_bs+=$descuentos["monto"];
				
				}
			$sumapagos_bs+=$v["monto"];
		   
			}
			
			$listaPagos_sus=$pago->listaPagos($anio,$f["idclientes"],"Sus");
			foreach($listaPagos_sus as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_sus+=$descuentos["monto"];
				
				}
			$sumapagos_sus+=$v["monto"];
		   
			}
			$devoluciones_bs=$detalledevolucion->sumarDevoluciones($anio,$f["idclientes"],"Bs");
			$devoluciones_sus=$detalledevolucion->sumarDevoluciones($anio,$f["idclientes"],"Sus");
			$totaldevoluciones=$devoluciones_bs+round(($devoluciones_sus*$tc2["valor"]),2);
			
			$devolucionesDeuda_bs=$devo_deuda->getDevolucionesDeudasAnio($anio,$f["idclientes"],"Bs");
			$devolucionesDeuda_sus=$devo_deuda->getDevolucionesDeudasAnio($anio,$f["idclientes"],"Sus");
			$totaldevolucionesDeuda=$devolucionesDeuda_bs+round(($devolucionesDeuda_sus*$tc2["valor"]),2);
			
			$totalpagos=$sumapagos_bs+round(($sumapagos_sus*$tc2["valor"]),2);
			
			 $saldo_inicial=($totaldeuda+$sumaventas)-($totalpagos+$totaldevoluciones);
			
		$listaventas=$venta->kardexCliente($f["idclientes"],$anio);
			$efectivo_bs=0;
			$efectivo_sus=0;
			
			
			foreach($listaventas as $row){
				
				$cre=$credito->getVenta($row["idventas"]);
				$cont=$contado->getVenta($row["idventas"]);
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cont["monto"];
				}
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cont["monto"];
				}
				
			}
			
			$efectivo_total=$efectivo_bs+round($efectivo_sus*$tc2["valor"],2);
			$saldo_inicial=round(($totaldeuda+$sumaventas)-($totalpagos+$totaldevoluciones+$efectivo_total+$totaldevolucionesDeuda),2);
		}
		
		
		
		if($_POST["moneda"]=="Sus"){
		
		$montodeuda_bs=$deuda->sumarDeuda($f["idclientes"],$anio,"Bs");
		$montodeuda_sus=$deuda->sumarDeuda($f["idclientes"],$anio,"Sus");
		$totaldeuda=$montodeuda_sus["montodeuda"]+round(($montodeuda_bs["montodeuda"]/$tc2["valor"]),2);
		
		$sumaventas_bs=$detalleventa->totalVentas($anio,$f["idclientes"],"Bs");
		$sumaventas_sus=$detalleventa->totalVentas($anio,$f["idclientes"],"Sus");
		$sumaventas=$sumaventas_sus+round(($sumaventas_bs/$tc2["valor"]),2);
		
		$sumapagos_bs=0;
		$sumapagos_sus=0;
		$listaPagos_bs=$pago->listaPagos($anio,$f["idclientes"],"Bs");
		foreach($listaPagos_bs as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_bs+=$descuentos["monto"];
				
				}
			$sumapagos_bs+=$v["monto"];
		   
			}
			
			$listaPagos_sus=$pago->listaPagos($anio,$f["idclientes"],"Sus");
			foreach($listaPagos_sus as $v)
		{
			$descuentos=$descuento->getPago($v["idpagoVentasCredito"]);
			if(isset($descuentos["iddescuentoPago"])){
				$sumapagos_sus+=$descuentos["monto"];
				
				}
			$sumapagos_sus+=$v["monto"];
		   
			}
			$devoluciones_bs=$detalledevolucion->sumarDevoluciones($anio,$f["idclientes"],"Bs");
			$devoluciones_sus=$detalledevolucion->sumarDevoluciones($anio,$f["idclientes"],"Sus");
			
			$totaldevoluciones=$devoluciones_sus+round(($devoluciones_bs/$tc2["valor"]),2);
			
			$devolucionesDeuda_bs=$devo_deuda->getDevolucionesDeudasAnio($anio,$f["idclientes"],"Bs");
			$devolucionesDeuda_sus=$devo_deuda->getDevolucionesDeudasAnio($anio,$f["idclientes"],"Sus");
			$totaldevolucionesDeuda=$devolucionesDeuda_sus+round(($devolucionesDeuda_bs/$tc2["valor"]),2);
			$totalpagos=$sumapagos_sus+round(($sumapagos_bs/$tc2["valor"]),2);
			
			
			$listaventas=$venta->kardexCliente($f["idclientes"],$anio);
			$efectivo_bs=0;
			$efectivo_sus=0;
			
			
			foreach($listaventas as $row){
				
				$cre=$credito->getVenta($row["idventas"]);
				$cont=$contado->getVenta($row["idventas"]);
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Sus"){
				$efectivo_sus+=$cont["monto"];
				}
				
				if($row["tipoventa"]=="CREDITO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cre["adelanto"];
				
				}
				if($row["tipoventa"]=="CONTADO" && $row["moneda"]=="Bs"){
				$efectivo_bs+=$cont["monto"];
				}
				
			}
			
			$efectivo_total=$efectivo_sus+round($efectivo_bs/$tc2["valor"],2);
			
			
			  $saldo_inicial=round(($totaldeuda+$sumaventas)-($totalpagos+$totaldevoluciones+$efectivo_total+$totaldevolucionesDeuda),2);
			
		}
			
			echo   sprintf("%01.2f",$saldo_inicial); ?></td>
            
            </tr>
			
			<?php }?>
             </tbody>
                        
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