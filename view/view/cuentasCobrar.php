<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#cuentasCobrar-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});

 $('#cuentasCobrar-table').dataTable( {
		 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#cuentasCobrar-table body ');
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

            var columnas = [6,7,8,9,10]; //the columns you wish to add            
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
		"aaSorting": [ [2,'asc'] ],
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
            
            
            <h2 id="contact">REPORTES > CUENTAS POR COBRAR</h2>
             
            <div>
           
          <form name="form"   method="post"  action="">
      
    <fieldset > 
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
                <input type="hidden" name="consulta" id="consulta"/ value="consulta"/>
               </td>
          </tr>
         
          </table>
        </fieldset>
               
      </form>
      
 <?php      if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){?>
	  <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 

            
 <form  style="float:right" action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="cuentasCobrar"  />
<input type="hidden" id="mes" name="mes"  value="<?php echo $mes;?>"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $anio;?>"  />


</form>
</div>
<h1 style="background:#06F;margin:auto; font-weight:bold;color:#FF0; margin-left:500px">CUENTAS POR COBRAR <?php $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 echo $_POST["moneda"]." HASTA EL 31 DE ".strtoupper($meses[$_POST["mes"]-1])." DEL ".$_POST["anio"];?></h1>
           <table border="0" cellpadding="0" cellspacing="0" id="cuentasCobrar-table">
           <thead>
           <tr style="background-color:#C6EDF4">
           <th>FECHA<BR />VENTA</th>
           <TH>CLIENTE</TH>
           <TH>CUIDAD</TH>
           <th>FECHA<BR />VENCIMIE<BR />NTO</th>
           <th>N&deg;<BR />CUOTA</th>
            <th>NOTA<BR />VENTA</th>
           <th>TOTAL <BR />DEUDA</th>
           <th>MONTO X<br /> COBRAR</th>
            <th>DESCUENTOS</th>
           <th>A CUENTA</th>
          
           <th>SALDO</th>
           <th>FECHA PAGO</th>
           <th style="color:#F00">DIAS<BR />MORA AL<BR /><?PHP echo date("d-m-Y");?></th>
          <TH>ESTADO</TH>
          </tr>
           </thead>
           <tbody>
           <?php 
		   $cont=1;
		   foreach($listadeudas as $r){
			   $fv2=$r["fechavencimiento"];
				$cli=$cliente->getNombre($r["clientes_idclientes"]);
				 $sa=$pago->sumarPagosDeuda($mes_anterior,$anio_anterior,$r["iddeudas"]);
		   $dp=0;
		   $listapagosdeudas=$pago-> listaPagosDeudas($mes_anterior,$anio_anterior,$r["iddeudas"]);
		   foreach($listapagosdeudas as $v){
			     $dp+=$descuento->sumDescuentosPago($v["idpagoVentasCredito"]);
			   
			   }
		 
		    $monto_cobrar=$r["saldo"]-($sa["total"]+$dp);
			
			 $listaPagosMes=$pago->listarPagosMesDeuda($mes,$anio,$r["iddeudas"]);
		 $sumpago=0;
		 $sumdes=0;
		 foreach($listaPagosMes as $v1){
			 $sumpago+=$v1["monto"];
			 $sumdes+=$descuento->sumDescuentosPago($v1["idpagoVentasCredito"]);
			 
			 }
			 $total_pago_mes=$sumpago;
			
				if( $monto_cobrar>0){
				?>
           <tr>
          <td align="center"><?php echo $r["fecha"] ?></td>
          <td><?php  echo $r["nombre_cliente"]?></td>
          <td><?php  echo $cli["ciudad"]?></td>
          <td align="center"><?php echo $r["fechavencimiento"] ?></td>
          <td align="center"><?php  echo $r["numcuotas"] ?></td>
          <td align="center"><?php  echo $r["descripcion"]?></td>
          <td align="right"><?php 
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $total=round($r["saldo_inicial"]*$tc2["valor"],2); echo sprintf("%01.2f",$total);}
		    if($r["moneda"]==$_POST["moneda"]){ $total=$r["saldo_inicial"]; echo sprintf("%01.2f",$total);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $total=round($r["saldo_inicial"]/$tc2["valor"],2); echo sprintf("%01.2f", $total);}
		  
		   ?></td>
          <td align="right"><?php 
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $monto_cobrar=round($monto_cobrar*$tc2["valor"],2); echo sprintf("%01.2f",$monto_cobrar);}
		    if($r["moneda"]==$_POST["moneda"]){ echo sprintf("%01.2f",$monto_cobrar);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $monto_cobrar=round($monto_cobrar/$tc2["valor"],2); echo sprintf("%01.2f",$monto_cobrar);}
		 
		
		 
		  
		  ?></td>
           <td align="right"><?php 
		  
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $sumdes=round($sumdes*$tc2["valor"],2); echo sprintf("%01.2f",$sumdes);}
		    if($r["moneda"]==$_POST["moneda"]){  echo sprintf("%01.2f",$sumdes);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $sumdes=round($sumdes/$tc2["valor"],2); echo sprintf("%01.2f",$sumdes);}
		 ?>
          </td>
         <td align="right"><?php 
		  if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $total_pago_mes=round($total_pago_mes*$tc2["valor"],2); echo sprintf("%01.2f",$total_pago_mes);}
		    if($r["moneda"]==$_POST["moneda"]){  echo sprintf("%01.2f",$total_pago_mes);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $total_pago_mes=round($total_pago_mes/$tc2["valor"],2); echo sprintf("%01.2f",$total_pago_mes);}
		
			
		 
		 
		 ?></td>
         
         <td align="right"><?php
		  $saldo=$monto_cobrar-($total_pago_mes+$sumdes);
		  echo sprintf("%01.2f",$saldo);
		 
		  ?></td>
          <td align="center"> 
          <table style="font-size:8px; color:#03C; font-weight:bold;" border="0" cellpadding="0" cellspacing="0">
		  <?php 
		  
		   foreach($listaPagosMes as $r){?>
			   <tr>
               <td> <?php echo date("d-m-Y",strtotime($r["fecha"]));?></td>
               <td> &nbsp;:&nbsp;</td>
                <td> <?php echo $r["numrecibo"]?></td>
               
               </tr>
			
			 
			 
			 <?php }?>
		 
		  
		  </table></td>
          <?php  $mora=Helpers::dias_transcurridos($fv2,date("Y-m-d"));?>
          <?php if ($mora<=30){?>
          <TD align="center" style="font-weight:bold;"><?php echo $mora;?></TD>
		  <?php }?>
           <?php if ($mora>30){?>
          <TD  style=" font-weight:bold;color:#F00;"align="center"><?php echo $mora;?></TD>
		  <?php }?>
          
			 <td   <?php if($saldo<=0) {?>style="background-color:#CFEFD7"<?PHP }?>><strong> <?php if($saldo<=0)echo "CANCELADO";?></strong></td>
			
           </tr>
           <?php } }?>
            <?php  //--------------LISTA DE CUOTAS VENCIDAS//////////////////////
		   $cont=1;
		   $saldo=0;
		    foreach($listaCuotas as $r){
				$fv=$r["fecha"];
				$cli=$cliente->getNombre($r["clientes_idclientes"]);
				 $sa=$pago->sumarPagosCuotas($mes_anterior,$anio_anterior,$r["idcuotas"]);
		   $dp=0;
		   $listapagosCuotas=$pago-> listaPagosCuotas($mes_anterior,$anio_anterior,$r["idcuotas"]);
		   foreach($listapagosCuotas as $v){
			     $dp+=$descuento->sumDescuentosPago($v["idpagoVentasCredito"]);
			   
			   }
		 
		    $monto_cobrar=$r["saldo_inicial"]-($sa["total"]+$dp);
			
			 $listaPagosMes=$pago->listarPagosMesCuota($mes,$anio,$r["idcuotas"]);
		 $sumpago=0;
		 $sumdes=0;
		 foreach($listaPagosMes as $v1){
			 $sumpago+=$v1["monto"];
			 $sumdes+=$descuento->sumDescuentosPago($v1["idpagoVentasCredito"]);
			 
			 }
			 $total_pago_mes=$sumpago;
			  $saldo=$monto_cobrar-($total_pago_mes+$sumdes);?>
				
					<?php if( $monto_cobrar>0){
				?>
					<tr>
          <td align="center"><?php echo $r["fecha"] ?></td>
          <td><?php  echo $r["nombre"]?></td>
          <td><?php  echo $cli["ciudad"]?></td>
          <td align="center"><?php echo $r["fecha"] ?></td>
          <td align="center"><?php  echo $r["numpago"] ?></td>
          <td align="center"><a href="#" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $r["idventas"];?>');"><?php echo VENTA."-".helpers::rellenarCeros($r["idventas"],6);?></a></td>
          <td align="right"><?php 
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $total=round($venta->getTotalVenta($r["idventas"])*$tc2["valor"],2); echo $total;}
		    if($r["moneda"]==$_POST["moneda"]){ $total=$venta->getTotalVenta($r["idventas"]); echo $total;}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $total=round($venta->getTotalVenta($r["idventas"])/$tc2["valor"],2); echo $total;}
		  
		   ?></td>
          <td align="right"><?php 
		  
		 
			 
		  if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $monto_cobrar=round($monto_cobrar*$tc2["valor"],2); echo sprintf("%01.2f",$monto_cobrar);}
		    if($r["moneda"]==$_POST["moneda"]){  echo sprintf("%01.2f",$monto_cobrar);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $monto_cobrar=round($monto_cobrar/$tc2["valor"],2); echo sprintf("%01.2f",$monto_cobrar);}
		  
		  ?></td>
          <td align="right"><?php 
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $sumdes=round($sumdes*$tc2["valor"],2); echo sprintf("%01.2f",$sumdes);}
		    if($r["moneda"]==$_POST["moneda"]){  echo sprintf("%01.2f",$sumdes);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $sumdes=round($sumdes/$tc2["valor"],2); echo sprintf("%01.2f",$sumdes);}
		   ?></td>
         <td align="right"><?php 
		 if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $total_pago_mes=round($total_pago_mes*$tc2["valor"],2); echo sprintf("%01.2f",$total_pago_mes);}
		    if($r["moneda"]==$_POST["moneda"]){  echo sprintf("%01.2f", $total_pago_mes);}
			 if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $total_pago_mes=round($total_pago_mes/$tc2["valor"],2); echo sprintf("%01.2f",$total_pago_mes);}
		 
		 
		 ?></td>
          
         <td align="right"><?php
		 $saldo=$monto_cobrar-($total_pago_mes+$sumdes);
		  echo sprintf("%01.2f",$saldo);
		
		 
		  ?></td>
          <td align="center">
          <table style="font-size:8px; color:#03C; font-weight:bold;" border="0" cellpadding="0" cellspacing="0">
		  <?php 
		  
		   foreach($listaPagosMes as $r){?>
			   <tr>
                <td> <?php echo date("d-m-Y",strtotime($r["fecha"]));?></td>
               <TD> : </TD>
                <td> <?php echo $r["numrecibo"]?></td>
               
               </tr>
			
			 
			 
			 <?php }?>
		 
		  
		  </table>
          </td>
           <?php  $mora=Helpers::dias_transcurridos($fv,date("Y-m-d"));?>
          <?php if ($mora<=30){?>
          <TD align="center" style="font-weight:bold;"><?php echo $mora;?></TD>
		  <?php }?>
           <?php if ($mora>30){?>
          <TD  style=" font-weight:bold;color:#F00;"align="center"><?php echo $mora;?></TD>
		  <?php }?>
			 <td   <?php if($saldo<=0) {?>style="background-color:#CFEFD7"<?PHP }?>><strong> <?php if($saldo<=0)echo "CANCELADO";?></strong></td>
			
           </tr>
					
				<?php } //FIN DE IF?>
		   
		   
		   <?php }//FIN DE TODO?>
           </tbody>
           
           <tfoot >
           <TR style="background-color:#333; color:#FF0">
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td align="right">TOTALES</td>
           <td align="right"></td>
           <td align="right"></td>
           <td align="right"></td>
           <td align="right"></td>
            <td align="right"></td>
           <td></td>
           <td></td>
           <td></td>
           </TR>
           <tr>
          <th>FECHA<BR />VENTA</th>
           <TH>CLIENTE</TH>
           <TH>CUIDAD</TH>
           <th>FECHA<BR />VENCIMIE<BR />NTO</th>
           <th>N&deg;<BR />CUOTA</th>
            <th>NOTA<BR />VENTA</th>
           <th>TOTAL <BR />DEUDA</th>
           <th>MONTO X<br /> COBRAR</th>
            <th>DESCUENTOS</th>
           <th>A CUENTA</th>
          
           <th>SALDO</th>
           <th>FECHA PAGO</th>
           <th style="color:#F00">DIAS<BR />MORA</th>
          <TH>ESTADO</TH>
          </tr>
          </tr>
            
           </tfoot>
           </table>
     
     
	 
<?php }// FIN DE TODO?>
      
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>