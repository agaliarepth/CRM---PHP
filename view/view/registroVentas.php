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
            
            
            <h2 id="contact">VENTAS > REGITRO VENTAS</h2>
            <div>
            <form  class="notas"name="form" action="" method="post">
            <fieldset> <legend> Filtro de consulta</legend>
         <table>
         <tr>
         <td>MES
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
         </td>
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
<input type="hidden" id="tipo" name="tipo"  value="registroVentas"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $_POST["anio"];?>"  />
<input type="hidden" id="anio" name="mes"  value="<?php echo $_POST["mes"];?>"  />



</form>
</div>
			 <table  width="100%" id="registroVentas" cellpadding="0"  cellspacing="0"  border="0">
             <thead>
             <tr style="background-color:#C6EDF4;font-size:7px;">
             <th >FECHA</th>
             <th >NOTA<BR />EGRESO</th>
             <th >NOMBRE<BR />VENDEDOR</th>
             <th>CLIENTE</th>
             <th >N&deg;VENTA</th>
             <th>CANT</th>
             <th >CODPROD</th>
             <th >TITULO DE LA OBRA</th>
             <th >P.V.U.</th>
             <th >P.V. <BR />TOTAL</th>
             <th >CUOTA<BR />INICIAL</th>
             <th >SALDO</th>
             <th >IMPORTE</th>
             <th >N <br/>CUOTAS</th>
             <th >% COMISION</th>
             <th >IMPORTE</th>
             <th >RECIBO<BR />INGRESO</th>
             <th >OBS</th>
             <th >COSTO<BR />CIF</th>
             
                         </tr>
             </thead>
             <tbody>
             <?php $idventas="";
			 $saldo1=0;
			 $sw_ade=0;
			 $sw1="";
			 foreach($res as $r){
				 $pt=0;
				 $ci=0;
				 $imp1=0;
				 $imp2=0;
				 $cif=0;
				 
				 ?>
             <tr <?php if($r["tipoventa"]=="CREDITO"){?>style="background-color:#F8F4C7"<?php }?>  >
			 <td  width="150"><?php echo $r["fecha"]; ?></td>
             <td align="center" ><a  style="cursor:pointer; color:#03F" onclick="imprimir('<?php echo config::ruta();?>?accion=verEgreso&id=<?php echo $r["idegreso"];?>');"> <?php echo $r["idegreso"]; ?></a></td>
             <td width="250"  ><?php echo $r["vendedor"];?></td>
             <td width="250" ><?php  $nombre=$r["clientes_idclientes"];  $n=$cliente->getNombre($r["clientes_idclientes"]); echo utf8_decode($n["nombres"]." ".$n["apellidos"]);?></td>
             <td width="200" ><a style="cursor:pointer; color:#03F" onClick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $r["idventas"];?>');"><?php echo VENTA."-".helpers::rellenarCeros($r["idventas"],6);?></a></td>
             <td align="CENTER"><?php  echo $r["cantidad"]// echo number_format($r["cantidad"], 2); ?></td>
             <td ><?php echo $r["codigo"]?></td>
             <td><?php $tit=$libros->getCodigoTitulo($r["libros_idlibros"]); echo $tit["titulo"];?></td>
             <td align="right">
			 <?php  if($m=="Sus" && $r["moneda"]=="Bs"){ $precio_unit=round(($r["precio_unit"]/$tc2["valor"]),2); echo $precio_unit;}
			 if($m==$r["moneda"]){ $precio_unit =$r["precio_unit"]; echo $precio_unit;}
			  if($m=="Bs" && $r["moneda"]=="Sus"){  $precio_unit =round(($r["precio_unit"]*$tc2["valor"]),2); echo $precio_unit;}
			 ?>
            
             </td>
             <td align="right">
			 <?php  if($m=="Sus" && $r["moneda"]=="Bs"){
			$pt=round(($r["precio_total"]/$tc2["valor"]),2);
			echo $pt;
			 //echo number_format($pt, 2, ',', '.');
			 }
			 if($m==$r["moneda"]){
			 $pt=$r["precio_total"];
			 echo $pt;
			// echo number_format($pt, 2, ',', '.');
			 }
			  if($m=="Bs" && $r["moneda"]=="Sus"){
				  $pt=round(($r["precio_total"]*$tc2["valor"]),2);
				  echo $pt;
			  // echo number_format($pt, 2, ',', '.');
			  }
			 ?></td>
             <td align="right">
             
			 <?php 
			 $ci=0;
			 
			 if($r["tipoventa"]=="CREDITO"){
			                
			                $c1=$credito->getCredito($r["idventas"]);
			                 $idventas=$r["idventas"];
							
							if($sw1!=$r["idventas"])
							
							$sw_ade=$c1["adelanto"];
							
							
					if($c1["adelanto"]>0 && $idventas==$r["idventas"]){
							
							
								 if($sw_ade>=$pt ){
									   $ci=$pt;
										$sw_ade-=$pt;
									
									     }
										
									else{
									
								       $ci=$sw_ade;
										$sw_ade=0;
									
									     }
								   
			             
							 $sw1=$r["idventas"];
							  }
							  else
							  $ci=0;
							
					if($m=="Sus" && $r["moneda"]=="Bs" ){
								  $ci=round(($ci/$tc2["valor"]),2);
			                 
								  						   }
			                  if($m==$r["moneda"]){
								  $ci=round($ci,2);
			                  
								
							  }
			                  if($m=="Bs" && $r["moneda"]=="Sus" ){
								  $ci=round(($ci*$tc2["valor"]),2);
			                 
							    
							  }		
							  echo sprintf("%01.2f",$ci);
			 }
			  if($r["tipoventa"]=="CONTADO"){
				  $ventacontado=$contado->getVenta($r["idventas"]);
				  $p1=$r["precio_total"]/$r["total"];
				  $p2=round($p1*$ventacontado["monto"],2);
				  if($p2>$r["precio_total"])
				  $p2=$r["precio_total"];
				  
				               if($m=="Sus" && $r["moneda"]=="Bs" ){
								  $ci=round(($p2/$tc2["valor"]),2);
			                      //echo number_format($ci, 2, ',', '.');
								  						   }
			                  if($m==$r["moneda"]){
								  $ci=round($p2,2);
			                    //echo number_format($ci, 2, ',', '.');
								
							  }
			                  if($m=="Bs" && $r["moneda"]=="Sus" ){
								  $ci=round(($p2*$tc2["valor"]),2);
			                   // echo number_format($ci, 2, ',', '.');
							    
							  }
							 
								  echo sprintf("%01.2f",$ci);
				  }
				 
			  
			 ?></td>
             <td align="right" style="background-color:#FFC">
			 <?php $saldo=round(($pt-$ci),2); 
			 //echo number_format($saldo, 2, ',', '.');
			 echo sprintf("%01.2f",$saldo);
			  ?>
             </td>
             
             
             <td align="right"><?php
			  if($r["tipoventa"]=="CREDITO"){
				$imp1=round(($saldo/$c1["num_cuotas"]),2);
				//echo number_format($imp1, 2, ',', '.'); 
				echo sprintf("%01.2f",$imp1);
				
				  
				  }
				  
				  if($r["tipoventa"]=="CONTADO"){
				//$imp1=round(($saldo/$c1["num_cuotas"]),2);
				//echo number_format($saldo, 2, ',', '.');;  
				echo sprintf("%01.2f",$saldo);
				  
				  }
			 
			  ?></td>
              <TD align="center"><?PHP
			   if($r["tipoventa"]=="CREDITO"){
				echo  $c1["num_cuotas"];
				  
				  }
				  
				  if($r["tipoventa"]=="CONTADO"){
				 
				echo "1";
				  
				  }
			   
			   
			   
			   ?></TD>
             <td align="center"><?php 
			 
			 
			
			                  $l1=$libros->getPrecios($r["libros_idlibros"]);
			                   if($m=="Sus" ){
								  $cif=round(($egreso->getCif($r["idegreso"],$r["libros_idlibros"])/$tc2["valor"]),2);
			                     // echo $cif;
							   }
			                  if($m=="Bs" ){
								  $cif=$egreso->getCif($r["idegreso"],$r["libros_idlibros"]);
			                    //echo $cif;
							  }
			 $por=(($precio_unit/$cif)-1)*100;
			 $por=round($por,2);
			
			 if($nombre==28){
		$comision=0;}
		else{
			 $c1=$credito->getCredito($r["idventas"]);
			
			 $r1_inf=0.00; $r1_sup=19.99; $r1_cash=0.02; $r1_cred=0.00;
			 $r2_inf=20.00; $r2_sup=39.99; $r2_cash=0.03; $r2_cred=0.02;
			 $r3_inf=40.00; $r3_sup=59.99; $r3_cash=0.04; $r3_cred=0.03;
			 $r4_inf=60.00; $r4_sup=79.99; $r4_cash=0.06; $r4_cred=0.05;
			 $r5_inf=80.00; $r5_sup=99.99; $r5_cash=0.07; $r5_cred=0.05;
			 $r6_inf=100.00; $r6_sup=9999.99; $r6_cash=0.08; $r6_cred=0.06;
			  if($por>=$r1_inf&&$por<=$r1_sup && $r["tipoventa"]=="CONTADO"){ $comision=$r1_cash;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $r["tipoventa"]=="CONTADO"){ $comision=$r2_cash;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $r["tipoventa"]=="CONTADO"){ $comision=$r3_cash;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $r["tipoventa"]=="CONTADO"){ $comision=$r4_cash;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $r["tipoventa"]=="CONTADO"){ $comision=$r5_cash;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $r["tipoventa"]=="CONTADO"){ $comision=$r6_cash;}
			  if($por<0 && $r["tipoventa"]=="CONTADO"){ $comision=0.02;}
			   if($saldo<=0){
			  if($por>=$r1_inf&&$por<=$r1_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r1_cash;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r2_cash;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r3_cash;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r4_cash;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r5_cash;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r6_cash;}
			  if($por<0 && $r["tipoventa"]=="CREDITO"){ $comision=0;}
			   }
			   else{
		      if($por>=$r1_inf&&$por<=$r1_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r1_cred;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r2_cred;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r3_cred;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r4_cred;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r5_cred;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r6_cred;}
			    if($por<0 && $r["tipoventa"]=="CREDITO"){ $comision=0;}  
				   }
		
		}
			//echo number_format($comision, 2, ',', '.'); 
			echo  sprintf("%01.2f",$comision);
			 
			 
			  ?>
              
              
              </td>
             <td><?php
			 
			  $detalleDevolucion=$devolucion->detalleDevolucionVenta($r["idventas"]);
			 
			     foreach($detalleDevolucion as $f){
					 
					 if($f["idlibros"]==$r["libros_idlibros"]){
						 
						 $pt=$pt-$f["precio_total"];
						 
						 }
					 
					 
					 
					 }
			 
			 
			 $importe=round($comision*$pt,2);
			 //echo number_format($importe, 2, ',', '.');
			 echo sprintf("%01.2f",$importe);
			  ?></td>
             <td><?php 
			 if($r["tipoventa"]=="CONTADO"){
				 echo $ventacontado["numingreso"];
			 }
			  ?>
             </td>
             <td><?php 
			 if($r["tipoventa"]=="CREDITO"){
				 
				 echo $c1["diaspago"]." DIAS";
				 }
				  if($r["tipoventa"]=="CONTADO"){
				 echo $ventacontado["tipopago"];
			 }
			 ?></td>
             <td align="right"><?php 
			 echo sprintf("%01.2f",$egreso->getCif($r["idegreso"],$r["libros_idlibros"]));
			                  
			 ?></td>
			 
			 </tr>
			 <?php }?>
             
             </tbody>
             <tfoot>
             <tr >
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th align="right" style="border:1px solid; "></th>
            <th  align="right" style="border:1px solid; "></th>
            <th align="right" style="border:1px solid; "></th>
            <th  align="right" style="border:1px solid; "></th>
            <th  align="right" style="border:1px solid; "></th>
            <th></th>
            <th align="center"  style="border:1px solid; "></th>
            <th  align="left" style="border:1px solid; "></th>
            <th></th>
            <th></th>
            <th></th>
             
             </tr>
             <tr style="background-color:#C6EDF4">
             <th>FECHA</th>
             <th>NOTA<BR />EGRESO</th>
             <th>NOMBRE<BR />VENDEDOR</th>
             <th >CLIENTE</th>
             <th>N&deg;VENTA</th>
             <th>CANT</th>
             <th>CODPROD</th>
             <th width="500">TITULO DE LA OBRA</th>
             <th>P.V.U.</th>
             <th>P.V. <BR />TOTAL</th>
             <th>CUOTA<BR />INICIAL</th>
             <th>SALDO</th>
             <th>IMPORTE</th>
             <th>N <br/>CUOTAS</th>
             <th>% COMISION</th>
             <th>IMPORTE</th>
             <th>RECIBO<BR />INGRESO</th>
             <th>OBS</th>
             <th>COSTO<BR />CIF</th>
             
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