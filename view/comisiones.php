<?php require_once("head.php");?>


<script language="javascript">
$(document).ready(function() {
     $("#botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#comisionestotales").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
	 
	 function messageBox()
{
  var i, msg = "cfgdg", argNum = 0, startPos;
  var args = messageBox.arguments;
  var numArgs = args.length;
  if(numArgs)
  {
    theStr = args[argNum++];
    startPos = 0;  endPos = theStr.indexOf("%s",startPos);
    if(endPos == -1) endPos = theStr.length;
    while(startPos < theStr.length)
    {
      msg += theStr.substring(startPos,endPos);
      if (argNum < numArgs) msg += args[argNum++];
      startPos = endPos+2;  endPos = theStr.indexOf("%s",startPos);
      if (endPos == -1) endPos = theStr.length;
    }
    if (!msg) msg = args[0];
  }
  alert(msg);
}

	 
});

$('#comisionesCreppdito-table').dataTable( {
		 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#comisionesCredito-table body ');
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

            var columnas = [4,5,6,7,8]; //the columns you wish to add            
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
		
		
    } );
	

 
	
	
	
	});
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">CUADRO DE COMISIONES</h2>
            <div>
           <div class="" style="border: solid 1px #999; margin-bottom:20px;">
       <form name="form"   method="post"  action="">
      <table>
     
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
  
<th><label>Moneda</label>
<select name="moneda">
<option value="Bs">Bolivianos</option>
<option value="Sus">Dolares</option>

</select>
</th>
<TH><label>Vendedor</label>
<select name="idvendedor">
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
                <tr><td>&nbsp;</td></tr>

                </table>
        </form>
  </div>
  <?php if(isset($_POST["consulta"]) &&$_POST["consulta"]=="consulta"){?>
  <div style="float:right;">
 <form action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p>  <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" id="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" name="tipo" value="comisiones"/>
  
              
</form>
</div>
<table id="comisionestotales" border="0" cellpadding="0" cellspacing="0">
<tr><td>
<h1 style="background:#06F;margin:auto; font-weight:bold;color:#FF0; margin-left:500px;" > COMICIONES DE COBRANZA VENTAS CONTADO</H1>
<table border="0"  cellpadding="0"  cellspacing="0" id="comisiones-table" style="font-size:11px; margin:auto;  width:100%; text-align:center;">
                <thead>
				<tr style="background-color:#CAEDF9; ">
				
					<th >N&deg;<br />VENTA </th>
                    <th >FECHA</th>
                    <th >NOTA <BR />EGRESO</th>
                    <th >CLIENTE</th>
                    <th >TOTAL <BR />VENTA</th>
                    <th>TOTAL<BR /> COMISION</th>
                     <th  >TOTAL<BR />COBRADO</th>
                     <th >COMISION <BR />A PAGAR</th>
                      <th >FORMA<BR /> COBRO</th>
                    
				</tr>
				
				</thead>
                <tbody>
                <?php
				$r1_inf=0; $r1_sup=19.99; $r1_cash=0.02; $r1_cred=0.00;
			 $r2_inf=20; $r2_sup=39.99; $r2_cash=0.03; $r2_cred=0.02;
			 $r3_inf=40; $r3_sup=59.99; $r3_cash=0.04; $r3_cred=0.03;
			 $r4_inf=60; $r4_sup=79.99; $r4_cash=0.06; $r4_cred=0.05;
			 $r5_inf=80; $r5_sup=99.99; $r5_cash=0.07; $r5_cred=0.05;// Example:
// value1 = 3; value2 = 4;
// messageBox("text message %s and %s", value1, value2);
// this message box will display the text "text message 3 and 4"


			 $r6_inf=100; $r6_sup=9999.99; $r6_cash=0.08; $r6_cred=0.06;
			 
			 
				foreach($listaVentas as $v){
			     
				 $total_comision=0;
			 	 $res=$venta->regVentas2($_POST["mes"],$_POST["anio"],$v["idventas"]);

			 foreach($res as $r){
				 $pt=0;
				 $ci=0;
				 $imp1=0;
				 $imp2=0;
				 $cif=0;      	
                 $nombre=$v["nombre"];
		 		 $comision=0;
          
			 if($_POST["moneda"]=="Sus" && $v["moneda"]=="Bs"){
				 $precio_unit=round(($r["precio_unit"]/$tc2["valor"]),2);
			    $pt=round(($r["precio_total"]/$tc2["valor"]),2);
			       }
			 if($m==$v["moneda"]){
			 $pt=$r["precio_total"];
			 $precio_unit =$r["precio_unit"]; 
			
			 }
			  if($m=="Bs" && $v["moneda"]=="Sus"){
				  $pt=round(($r["precio_total"]*$tc2["valor"]),2);
				$precio_unit =round(($r["precio_unit"]*$tc2["valor"]),2);
			  }
			
			  if($v["clientes_idclientes"]==28){
				   $comision=0;
				  }
				  else{
			 $c1=$credito->getCredito($r["idventas"]);

			 //$l1=$libros->getPrecios($r["libros_idlibros"]);
			          if($m=="Sus" )   $cif=round(($egreso->getCif($r["idegreso"],$r["libros_idlibros"])/$tc2["valor"]),2);
//$cif=round(($l1["cif"]/$tc2["valor"]),2);
			          if($m=="Bs" )  $cif=$egreso->getCif($r["idegreso"],$r["libros_idlibros"]);// $cif=$l1["cif"];
			            
			 $por=(($precio_unit/$cif)-1)*100;
			 $por=round($por,2);
			 	 
			  if($por>=$r1_inf&&$por<=$r1_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r1_cash;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r2_cash;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r3_cash;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r4_cash;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r5_cash;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r6_cash;}
			  if($por<0 && $r["tipoventa"]=="CONTADO"){ $comision=0.02;}

			   if($c1["adelanto"]>=($r["total"]*0.5)){
			  if($por>=$r1_inf&&$por<=$r1_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r1_cash;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r2_cash;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r3_cash;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r4_cash;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r5_cash;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $r["tipoventa"]=="CREDITO"){ $comision=$r6_cash;}
			  if($por<0 && $r["tipoventa"]=="CREDITO"){ $comision=0;}
			   }
			   else{
			  if($por>=$r1_inf&&$por<=$r1_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r1_cred;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r2_cred;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r3_cred;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r4_cred;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r5_cred;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r6_cred;}
			  if($por<0 && $r["tipoventa"]=="CREDITO"){ $comision=0;}
		
			   }
				  }//fin else
		 
			
			 $importe=round($comision*$pt,2);
		
			$total_comision+=$importe;
			  
              
			
            
			 }
				
					
					?>
                <tr >
                <td align="center"><?php echo VENTA."-".Helpers::rellenarCeros($v["idventas"],6); ?></td>
                <td align="center"><?php echo date("d/m/Y",strtotime($v["fecha"])); ?></td>
                <td align="center"><?php echo $v["idegreso"]; ?></td>
                <td align="left"><?php
				$cli=$cliente->getNombre($r["clientes_idclientes"]);
				 echo utf8_decode($cli["nombres"]." ".$cli["apellidos"]);?></td>
                <td align="right"><?php
				 if($_POST["moneda"]=="Sus" && $v["moneda"]=="Bs"){
				 $pt=round(($v["total"]/$tc2["valor"]),2);
			  
			       }
			 if($m==$v["moneda"]){
			 $pt=$v["total"];
			; 
			
			 }
			  if($m=="Bs" && $v["moneda"]=="Sus"){
				  $pt=round(($v["total"]*$tc2["valor"]),2);
				
			  }
				
				 echo $pt;?>
                 
                 </td>
                <td align="right"><?php echo sprintf("%01.2f",$total_comision); ?></td>
                <td align="right">
				<?php
				
				if($v["tipoventa"]=="CONTADO"){
					$total_pagos=$v["total"];
					echo $v["total"];
					
					}
				
						
				
				  ?>
                </td>
                <td align="right"><?php  echo sprintf("%01.2f",round(($total_pagos*$total_comision)/$v["total"],2));  ?></td>
                <td align="center"><?php 
				
				
					$c=$contado->getVenta($v["idventas"]);
					 echo $c["tipopago"]."|";
					 echo $c["numingreso"]."|";
					 echo $c["numfactura"];
					
				
				
						
				
				
				 ?></td>
                
                
                </tr>
                <?php } //FIN DEL FOREACH LISTAVENTAS
				
				 // FIN DE TODO?>

               
                </tbody>
                <tfoot>
                 <tr>
                 <th></th>
                  <th></th>
                   <th></th>
                    <th></th>
                    <th align="right"></th>
                     <th align="right"></th>
                      <th align="right"></th>
                       <th align="right"></th>
                        <th></th>
                 </tr>
                
                </tfoot>
            
				</table>
                
                </td>
                </tr>
                <tr>
                <td>
                
                <h1 style="background:#06F;margin:auto; font-weight:bold;color:#FF0; margin-left:500px;" > COMICIONES DE COBRANZA VENTAS CREDITO</H1>
                <table border="0"  cellpadding="0"  cellspacing="0" id="comisionesCredito-table" style="font-size:11px; margin:auto;  width:100%; text-align:center;">
                <thead>
				<tr style="background-color:#CAEDF9; ">
				
					<th >N&deg;<br />VENTA </th>
                    <th >FECHA</th>
                    <th >NOTA <BR />EGRESO</th>
                    <th >CLIENTE</th>
                    <th >TOTAL <BR />VENTA</th>
                    <th>TOTAL<BR /> COMISION</th>
                     <th  >TOTAL<BR />COBRADO</th>
                      <th  >TOTAL<BR />DESCUENTOS</th>
                     <th >COMISION <BR />A PAGAR</th>
                      <th >FORMA<BR /> COBRO</th>
                    
				</tr>
				
				</thead>
                <tbody>
                <?php
			
			 
				foreach($listaVentas2 as $v){
			     
				 $total_comision=0;
				 $total_cobrado=0;
				 $total_descuento=0;
				 
				 $listaPagos=$pago->listaPagosMesVentas2($_POST["mes"],$_POST["anio"],$v["idventas"]);
				 foreach($listaPagos as $r){
					 $monto_bs=0;
					 $monto_sus=0;
					 $desc_bs=0;
					 $desc_sus=0;
					 $recibo=$r["numrecibo"];
					 
					  $total_cobrado+=$r["monto"];
					$total_descuento=$descuento->sumDescuentosPago($r["idpagoVentasCredito"]); 
					
					 
					 
					 }
				 
				 
			 	 $res2=$venta->regVentas3($v["idventas"]);
				
                $idventas="";
			    $saldo1=0;
			    $sw_ade=0;
			    $sw1="";
			 foreach($res2 as $r){
				 $pt=0;
				 $ci=0;
				 $imp1=0;
				 $imp2=0;
				 $cif=0;      	
                 $nombre=$r["nombre"];
		 		 $comision=0;
          
			 if($m=="Sus" && $r["moneda"]=="Bs"){
				 $precio_unit=round(($r["precio_unit"]/$tc2["valor"]),2);
			    $pt=round(($r["precio_total"]/$tc2["valor"]),2);
			       }
			 if($m==$r["moneda"]){
			 $pt=$r["precio_total"];
			 $precio_unit =$r["precio_unit"]; 
			
			 }
			  if($m=="Bs" && $r["moneda"]=="Sus"){
				  $pt=round(($r["precio_total"]*$tc2["valor"]),2);
				$precio_unit =round(($r["precio_unit"]*$tc2["valor"]),2);
			  }
			  
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
							  
			 }
						 $saldo=round(($pt-$ci),2); 

              if($r["clientes_idclientes"]==28){
				  				   $comision=0;
				  }
				  else{
					   $c1=$credito->getCredito($r["idventas"]);

			            if($m=="Sus" )   $cif=round(($egreso->getCif($r["idegreso"],$r["libros_idlibros"])/$tc2["valor"]),2);
			             if($m=="Bs" )  $cif=$egreso->getCif($r["idegreso"],$r["libros_idlibros"]);// $cif=$l1["cif"];
			            
			            
			 $por=(($precio_unit/$cif)-1)*100;
			 $por=round($por,2);
			 	 
			  if($por>=$r1_inf&&$por<=$r1_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r1_cash;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r2_cash;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r3_cash;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r4_cash;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r5_cash;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $v["tipoventa"]=="CONTADO"){ $comision=$r6_cash;}
			  if($por<0 && $r["tipoventa"]=="CONTADO"){ $comision=0.02;}
			  
			  if($saldo<=0){
			  if($por>=$r1_inf&&$por<=$r1_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r1_cash;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r2_cash;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r3_cash;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r4_cash;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r5_cash;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r6_cash;}
			  if($por<0 && $r["tipoventa"]=="CREDITO"){ $comision=0;}
			   }
			   else{
			  if($por>=$r1_inf&&$por<=$r1_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r1_cred;}
			  if($por>=$r2_inf&&$por<=$r2_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r2_cred;}
			  if($por>=$r3_inf&&$por<=$r3_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r3_cred;}
			  if($por>=$r4_inf&&$por<=$r4_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r4_cred;}
			  if($por>=$r5_inf&&$por<=$r5_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r5_cred;}
			  if($por>=$r6_inf&&$por<=$r6_sup && $v["tipoventa"]=="CREDITO"){ $comision=$r6_cred;}
			  if($por<0 && $r["tipoventa"]=="CREDITO"){ $comision=0;}
		
			   }
		
		
				  }//fin else
		  $detalleDevolucion=$devolucion->detalleDevolucionVenta($r["idventas"]);
			 
			     foreach($detalleDevolucion as $f){
					 
					 if($f["idlibros"]==$r["libros_idlibros"]){
						 
						 $pt=$pt-$f["precio_total"];
						 
						 }
					 
					 
					 
					 }
			 
			 $importe=round($comision*$pt,2);
			
			$total_comision+=$importe;
			  
              
			
            
			 }
				
				 	
					?>
                <tr >
                <td align="center"><?php echo VENTA."-".Helpers::rellenarCeros($v["idventas"],6); ?></td>
                <td align="center"><?php echo date("d/m/Y",strtotime($v["fecha"])); ?></td>
                <td align="center"><?php echo $v["idegreso"]; ?></td>
                <td align="left"><?php echo utf8_decode($v["nombre"]);?></td>
                <td align="right"><?php
				 if($_POST["moneda"]=="Sus" && $v["moneda"]=="Bs"){
				 $pt=round(($v["total"]/$tc2["valor"]),2);
				$total_cobrado=round(($total_cobrado/$tc2["valor"]),2);
				 $total_descuento=round(( $total_descuento/$tc2["valor"]),2);
			  
			       }
			 if($m==$v["moneda"]){
			 $pt=$v["total"];
			; 
			
			 }
			  if($m=="Bs" && $v["moneda"]=="Sus"){
				  $pt=round(($v["total"]*$tc2["valor"]),2);
				   $total_cobrado=round(($total_cobrado*$tc2["valor"]),2);
				    $total_descuento=round(( $total_descuento*$tc2["valor"]),2);
				   
				
			  }
			  
			
				
				 echo sprintf("%01.2f",$pt);?>
                 
                 </td>
                <td align="right"><?php echo sprintf("%01.2f",$total_comision); ?></td>
                <td align="right">
				<?php echo sprintf("%01.2f", $total_cobrado);?>
                </td>
                <td align="right">
				<?php echo  sprintf("%01.2f",$total_descuento);?>
                </td>
                <td align="right"><?php
				
				
				$total_comision=(($pt-$total_descuento)*$total_comision)/$pt;
			
								 $pt=$pt-$total_descuento;

				 $total_pagar=round(($total_cobrado/$pt)*$total_comision ,2); echo sprintf("%01.2f",$total_pagar); 
				 	
					
					
				  ?></td>
                <td align="center"><?php 
			
				
						echo "PAGO PARCIAL:".$recibo;
				
				
				 ?></td>
                
                
                </tr>
                
                
                
                
                
                
                <?php } //FIN DEL FOREACH LISTAVENTAS?>
                
                <?php 
				foreach($listaVentasCredito as $v1){
					
				 $res2=$venta->regVentas3($v1["idventas"]);
			    $total_comision=0;
                $idventas="";
			    $saldo1=0;
			    $sw_ade=0;
			    $sw1="";
			 foreach($res2 as $r){
				 $pt=0;
				 $ci=0;
				 $imp1=0;
				 $imp2=0;
				 $cif=0;      	
                 $nombre=$r["nombre"];
		 		 $comision=0;
          
			 if($m=="Sus" && $r["moneda"]=="Bs"){
				 $precio_unit=round(($r["precio_unit"]/$tc2["valor"]),2);
			    $pt=round(($r["precio_total"]/$tc2["valor"]),2);
			       }
			 if($m==$r["moneda"]){
			 $pt=$r["precio_total"];
			 $precio_unit =$r["precio_unit"]; 
			
			 }
			  if($m=="Bs" && $r["moneda"]=="Sus"){
				  $pt=round(($r["precio_total"]*$tc2["valor"]),2);
				$precio_unit =round(($r["precio_unit"]*$tc2["valor"]),2);
			  }
			  
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
							  
			 }
			
			 $saldo=round(($pt-$ci),2); 
			
			 if($r["clientes_idclientes"]==28){
				   $comision=0;
				  }
				  else{
					  
			        if($m=="Sus" )   $cif=round(($egreso->getCif($r["idegreso"],$r["libros_idlibros"])/$tc2["valor"]),2);
			          if($m=="Bs" )  $cif=$egreso->getCif($r["idegreso"],$r["libros_idlibros"]);// $cif=$l1["cif"];
			            
			 $por=(($precio_unit/$cif)-1)*100;
			 $por=round($por,2);
			 	 
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
		
		
				  }//fin else
		 $detalleDevolucion=$devolucion->detalleDevolucionVenta($r["idventas"]);
			 
			     foreach($detalleDevolucion as $f){
					 
					 if($f["idlibros"]==$r["libros_idlibros"]){
						 
						 $pt=$pt-$f["precio_total"];
						 
						 }
					 
					 
					 
					 }
			 
			 $importe=round($comision*$pt,2);
			
			$total_comision+=$importe;
			  
              
			
            
			 }
						$res=$credito->getCredito($v1["idventas"]);
						if($res["adelanto"]>0){
						$adelanto=$res["adelanto"];
					
					
					
				
				?>
                
           
				<tr >
                <td align="center"><?php echo VENTA."-".Helpers::rellenarCeros($v1["idventas"],6); ?></td>
                <td align="center"><?php echo $v1["fecha"]; ?></td>
                <td align="center"><?php echo $v1["idegreso"]; ?></td>
                <td align="left"><?php echo $v1["nombre"];?></td>
                <td align="right"><?php
				 if($m["moneda"]=="Sus" && $v1["moneda"]=="Bs"){
				 $pt=round(($v1["total"]/$tc2["valor"]),2);
				 $adelanto=round(($adelanto["total"]/$tc2["valor"]),2);
				
			  
			       }
			 if($m==$v1["moneda"]){
			 $pt=$v1["total"];
			; 
			
			 }
			  if($m=="Bs" && $v1["moneda"]=="Sus"){
				  $pt=round(($v1["total"]*$tc2["valor"]),2);
				   $adelanto=round(($adelanto["total"]*$tc2["valor"]),2);
				  
				   
				
			  }
				
				 echo  sprintf("%01.2f",$pt);?>
                 
                 </td>
                <td align="right"><?php echo sprintf("%01.2f",$total_comision); ?></td>
                <td align="right">
				<?php echo  sprintf("%01.2f",$adelanto);?>
                </td>
                <td align="right">
				<?php echo  sprintf("%01.2f",0) ?>
                </td>
                <td align="right"><?php
				
				
				 $total_pagar=round(($adelanto/($pt))*($total_comision) ,2); echo $total_pagar;  ?></td>
                <td align="center"><?php echo "ADELANTO |";
				echo  $res["reciboadelanto"]."|";
				echo $res["facturaadelanto"];
			
				
						
				
				
				 ?></td>
                
                
                </tr>
	
     			<?php } }?>
				
				
				 
               
                </tbody>
                <tfoot>
                 <tr>
                 <th></th>
                  <th></th>
                   <th></th>
                    <th></th>
                    <th align="right"></th>
                     <th align="right"></th>
                      <th align="right"></th>
                       <th align="right"></th>
                        <th align="right"></th>
                 </tr>
                
                </tfoot>
            
				</table>
                </td>
                </tr>
                <tr>
                <td>
                <h1 style="background:#06F;margin:auto; font-weight:bold;color:#FF0; margin-left:500px;" > COMICIONES DE COBRANZA DEUDAS </H1>
                <table border="0"  cellpadding="0"  cellspacing="0" id="comisionesCredito-table" style="font-size:11px; margin:auto;  width:100%; text-align:center;">
                <thead>
				<tr style="background-color:#CAEDF9; ">
				
					<th >N&deg;<br />VENTA </th>
                    <th >FECHA</th>
                    <th >NUM <BR />CUOTA</th>
                    <th >MONEDA</th>

                    <th >CLIENTE</th>
                    <th >TOTAL <BR />VENTA</th>
                    <th>TOTAL<BR /> COMISION</th>
                     <th  >TOTAL<BR />COBRADO</th>
                      <th  >TOTAL<BR />DESCUENTOS</th>
                     <th >COMISION <BR />A PAGAR</th>
                      <th >FORMA<BR /> COBRO</th>
                    
				</tr>
				
				</thead>
                <tbody>
                <?php
			
			 
				foreach( $listaPagosDeuda as $v){
			     
					?>
                <tr >
                <td align="center"><?php echo $v["descripcion"]; ?></td>
                <td align="center"><?php echo $v["fecha"]; ?></td>
                <td align="center"><?php echo $v["numcuotas"]; ?></td>
                <td align="center"><?php echo $v["moneda"]; ?></td>

                <td align="left"><?php echo $v["nombre_cliente"];?></td>
                <td align="right"><?php
				$pt=$v["saldo_inicial"];
			
				$total_devolucion=0;// ESTE MONTO DEBE SUMAR EL DESCUENTO  HASTA LA FECHA;
				
				$listadevoluciones=$devolucion->detalleDevolucionDeuda($v["deudas_iddeudas"]);
				$totaldev_bs=0;
				$totaldev_sus=0;
				$totaldev=0;
				foreach($listadevoluciones as $d){
					    if($d["moneda"]=="Bs"){
							$totaldev_bs+=$d["precio_total"];
							}
							 if($d["moneda"]=="Sus"){
								 $totaldev_sus+=$d["precio_total"];
								 }
								 
					
					}
					if($v["moneda"]=="Bs"){
						 $total_devolucion=$totaldev_bs+round(($totaldev_sus*$tc2["valor"]),2);
						
						}
					if($v["moneda"]=="Sus"){
				 $total_devolucion=$totaldev_sus+round(($totaldev_bs/$tc2["valor"]),2);
					}
					/*if($total_devolucion>0){
					$total_comision=round(($total_devolucion*$v["comision"])/$pt,2);
						
						}*/
						echo sprintf("%01.2f",$pt);
						//print_r($listadevoluciones);
						
					?>
                 </td>
                <td align="right"><?php $total_comision=$v["comision"];echo sprintf("%01.2f",$v["comision"]); ?></td>
                <td align="right">
				<?php $total_cobrado=$v["monto"]; echo sprintf("%01.2f", $total_cobrado);?>
                </td>
                <td align="right">
				<?php $total_descuento=$descuento->sumDescuentosPago($v["idpagoVentasCredito"]);  echo  sprintf("%01.2f",$total_descuento);?>
                </td>
                <td align="right"><?php
				
				
				$total_comision=(($pt-($total_devolucion+$total_descuento))*$total_comision)/$pt;
								 $pt=$pt-($total_descuento+$total_descuento);

				 $total_pagar=round(($total_cobrado/$pt)*$total_comision ,2); echo sprintf("%01.2f",$total_pagar); 
				 
				 
				  ?></td>
                <td align="center"><?php 
			
				
						echo "PAGO PARCIAL:".$v["numrecibo"];
				
				
				 ?></td>
                
                
                </tr>
                
                
                
                
                
                
                <?php } //FIN DEL FOREACH LISTAVENTAS?>
                
                </td>
                
                
                </tr>
	
     			<?php  }?>
				
				
				 
               
                </tbody>
                <tfoot>
                 <tr>
                 <th></th>
                  <th></th>
                   <th></th>
                    <th></th>
                    <th align="right"></th>
                     <th align="right"></th>
                      <th align="right"></th>
                       <th align="right"></th>
                        <th align="right"></th>
                 </tr>
                
                </tfoot>
            
				</table>
                
                </td>
                </tr></table>
				
			 
            
               
           
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
    <script>
    $('#comisiones-table').dataTable( {
		 "fnDrawCallback": function (oSettings) {
            if (oSettings.aiDisplay.length == 0) {
                return;
            }
			var nTrs = $('#comisiones-tablet body ');
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

            var columnas = [4,5,6,7]; //the columns you wish to add            
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
    
    </script>
<?php require_once("footer.php");?>