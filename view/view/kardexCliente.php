<?php require_once("head.php");?>
<script type="text/javascript">
$(function() 
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#nombre").autocomplete({
				source: "ajax/buscarCliente.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: clienteSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */
				
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.nombres + " / " + item.empresa + "</a>" )
    .appendTo( ul );
};
		});
		
		
		function clienteSeleccionado(event, ui)
		{
			
			$( "#nombre" ).val( ui.item.nombres );
			$( "#idcliente" ).val( ui.item.idclientes );
			
			return false;
			
		}


</script>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#kardex").eq(0).clone()).html());

     $("#FormularioExportacion").submit();
});
});
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > KARDEX CLIENTE</h2>
            <div>
            <form method="post" name="form" class="notas" id="form" action="">
           <fieldset> <legend >Datos del Cliente</legend>
         <table> 
         <tr>
         <td><label>Nombres / CI / NIT </label><input  type="text" name="nombre" id="nombre" size="50"/></td>
         <td><label>Gestion </label><select name="anio" id="anio"  />
         <option  value="2010">2010</option>
        <option  value="2011">2011</option>
        <option  value="2012">2012</option>
        <option  value="2013">2013</option>
        <option  value="2014" selected="selected">2014</option>
        <option  value="2015">2015</option>
        <option  value="2016">2016</option>
        <option  value="2017">2017</option>
        <option  value="2018">2018</option>
        <option  value="2019">2019</option>
        <option  value="2020">2020</option>
        <option  value="2021">2021</option>
        <option  value="2022">2022</option>
        <option  value="2023">2023</option>
        <option  value="2024">2024</option>
        <option  value="2025">2025</option>
        <option  value="2026">2026</option>
        <option  value="2027">2027</option>
        <option  value="2028">2028</option>
        <option  value="2029">2029</option>
        <option  value="2030">2030</option>
        

         </td>
         <td><label>Moneda </label><select name="moneda" id="moneda"  />
         <option  value="Bs">Bolivianos</option>
         <option  value="Sus">Dolares</option>
               </td>
               <td>
               <input type="submit" name="bConsultar"  id="bconsultar" value="Consultar" />
               <input type="hidden" name="idcliente" id="idcliente"/>
               <input type="hidden" name="consulta" id="consulta"/ value="consulta">
               </td>
               
         </tr>
         
         </table>
         </fieldset>
         </form>
         
         <?php if(isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"){?>
         
         <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 

            
 <form  style="float:right" action="<?php config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="kardexCliente"  />
<input type="hidden" id="anio" name="anio"  value="<?php echo $_POST["anio"];?>"  />


</form>
</div>
<table id="kardex" border="0" style="width:100%">
<tr><td colspan="4">
         <table style="background-color:#E1E1E1;  font-size:12px; width:100%" id="infoCliente">
         <tr>
         <td colspan="2"><span><strong>NOMBRE</strong>: </span> <?php echo $res["nombres"]." ".$res["apellidos"];?></td>
         <td colspan="2"><span><strong>DIRECCION</strong></span>           <?php  echo $res["direccion"];?></td>
         </tr>
         
         <tr>
         <td colspan="2"><span><strong>CIUDAD</strong>: </span><?php   echo $res["ciudad"];?></td>
         <td colspan="2"><span><strong>TELEFONOS</strong>: </span><?php   echo "telf:".$res["telefono"]." Cel:".$res["celular"];?></td>
         </tr>
         
         <tr>
         <td ><span><strong>NIT</strong>: </span><?php echo  $res["nitruc"];?></td>
         <td ><span><strong>RAZON SOCIAL</strong>: </span><?php   echo $res["empresa"];?></td>
         <td><span><strong>EMAIL</strong>: </span><?php  echo $res["email"];?></td>
         </tr>
         
         
         </table>
         </td>
         </tr>
         <tr>
         <td colspan="2">
         
           <table border="0"  cellpadding="0" cellspacing="0" id="kardexcliente-table">
          <thead>
          <tr style="background-color:#C6EDF4">
          <th width="100">FECHA</th>
          <th width="10">ORIGEN O</BR>DESPACHO</th>
          <th width="75">DOCUM <BR />N</th>
          <th width="70">COD PROD</th>
          <th width="550">DETALLE</th>
          <th width="5">Cant</th>
          <th width="50">PU</th>
          <th width="100">DEBE</th>
          <th width="100">HABER</th>
          <th width="100">SALDO</th>
          <th width="150">OBSER</th>
          </tr>
          <tr style="background-color:#9F6; font-size:14px;font-weight:bold;">
          <td  colspan="7">SALDO AL  1-ENERO-<?php  echo $_POST["anio"];?></td>
          
          
          <TD  align="right"><?php echo $saldo_inicial?></TD>
          <TD></TD>
         <TD  align="right"><?php echo $saldo_inicial?></TD>
           <TD></TD>
           
          </tr>
          <TR>
          
          <td >&nbsp;</td>
          <TD></TD>
          <TD></TD>
          <TD></TD>
          <TD></TD>
          <TD></TD>
          <TD></TD>
          <TD  ></TD>
           <TD></TD>
           <TD></TD>
           <TD></TD>
          
          </TR>
           </thead>
          <tbody>
          
          <?php
		 
		   $saldo=0;
		   $pt=0;
		   $sumdebe=0;
		   $sumhaber=0;
		   $aux3=$saldo_inicial;
		   foreach($listaventas as $v){ 
		    $idventa="";
		      $det=$detalleventa->kardexCliente($v["idventas"]);?>
			 
			  <?PHP foreach($det as $r){ ?>
                     
          <tr>
           <td><?php echo $r["fecha"];  ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php echo "NE-".$r["idegreso"]; ?></td>
           <td><?php echo $r["codigo"]; ?></td>
           <td><?php echo $r["titulo"]; ?></td>
           <td ><?php echo $r["cantidad"]; ?></td>
           <td align="right">
		   <?php 
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs")
		   echo round(($r["precio_unit"]*$tc2["valor"]),2); 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus")
		   echo round(($r["precio_unit"]/$tc2["valor"]),2); 
		   if($r["moneda"]==$_POST["moneda"])
		   echo $r["precio_unit"]; 
		   ?>
           </td>
           <td align="right">
		   <?php 
		   
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($r["precio_total"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($r["precio_total"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$r["precio_total"]; echo $pt;  }
			 $sumdebe+=$pt;
		  
		   
		   ?>
           </td>
           <td align="right"><?php ?></td>
           <td align="right"><?php $saldo_inicial+=$pt; echo $saldo_inicial;  ?></td>
           <td align="center"><?php 
		   if($r["tipoventa"]=="CONTADO"){ $aux=$contado->getNumFactura($r["idventas"]); echo $aux["numfactura"];}
		    if($r["tipoventa"]=="CREDITO"){
				 $aux=$credito->getCondiciones($r["idventas"]); 
				   if($aux["dias"]>0){
					   echo $aux["dias"]." GRACIA - ";
					   }
					  
						    echo $aux["diaspago"]."DIAS";
							
							} ?>
            </td>
          </tr>
          
          <?php
		  
			  }?>
              	  <?PHP 
				  if($v["tipoventa"]=="CONTADO"){
				   $con=$contado->kardexCliente($v["idventas"]);
				  ?>
			  
			   <tr style="background-color:#FF9">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php echo $con["numingreso"]; ?></td>
           <td></td>
           <?php if($con["tipopago"]=="EFECTIVO"){ ?>
           <td>PAGO EN EFECTIVO</td><?php }?>
           <?php if($con["tipopago"]=="DEPOSITO") {?>
           <td>DEPOSITO <?php echo $con["cuentabanco"]; ?></td><?php }?>
           <td></td>
           <td></td>
           <td></td>
           <td align="right">
		   <?php
		     if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($con["monto"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($con["monto"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$con["monto"]; echo $pt;  }
			$sumhaber+=$pt;
		    
			
			 ?>
            </td>
           <td align="right"><?php   $saldo_inicial-=$pt; echo $saldo_inicial;?></td>
           <td align="center"></td>
           
          </tr>
			  
			  
			  
			  <?php }?>
		<?PHP // FILA DE ADELANTOS
				  if($v["tipoventa"]=="CREDITO"){
				   $cred=$credito->getCredito($v["idventas"]);
				   if($cred["adelanto"]>0)
				   {
				  ?>
			  
			   <tr style="background-color:#B0EAD2">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php echo $cred["reciboadelanto"]; ?></td>
           <td></td>
           <?php if($cred["tipoadelanto"]=="EFECTIVO"){ ?>
           <td> ADELANTO PAGO EN EFECTIVO </td><?php }?>
           <?php if($cred["tipoadelanto"]=="DEPOSITO") {?>
           <td>ADELANTO DEPOSITO  <?php echo $cred["cuentabanco"]; ?></td><?php }?>           <td></td>
           <td></td>
           <td></td>
           <td align="right">
		   <?php
		     if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $ade=round(($cred["adelanto"]*$tc2["valor"]),2); echo $ade;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $ade=round(($cred["adelanto"]/$tc2["valor"]),2); echo $ade;}
		    if($r["moneda"]==$_POST["moneda"]){ $ade=$cred["adelanto"]; echo $ade;  }
			$sumhaber+=$ade;
			
		    
			
			 ?>
            </td>
           <td align="right"><?php   $saldo_inicial-=$ade; echo $saldo_inicial;?></td>
           <td align="center"><?php echo $cred["facturaadelanto"]?></td>
           
          </tr>
			  
			  
			  
			  <?php }
				  }
			  ?>
              
              <?php	 } 
			  
			   ?>
		  <?php // FILA DE DEVOLUCIONES
			  foreach($listadevoluciones as $r){
			  ?>
			  
		   <tr style="background-color:#FF9">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php echo "NI-".$r["idingreso"]; ?></td>
           <td><?php echo $r["codigo"]; ?></td>
           <td><?php echo utf8_decode($r["titulo"]); ?></td>
           <td><?php echo $r["cantidad"]; ?></td>
           <td align="right">
		   <?php 
		   if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs")
		   echo round(($r["precio_unit"]*$tc2["valor"]),2); 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus")
		   echo round(($r["precio_unit"]/$tc2["valor"]),2); 
		   if($r["moneda"]==$_POST["moneda"])
		   echo $r["precio_unit"];
		   ?>
           </td>
           
           <td></td>
           <td align="right"><?php 
		    if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($r["precio_total"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($r["precio_total"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$r["precio_total"]; echo $pt;  }
			$sumhaber+=$pt;
		   ?>
           </td>
           <td align="right"><?php echo $saldo_inicial-=$pt;  ?></td>
           <td align="center">DEVOLUCION</td>
           
          </tr>
			  
			  
			 <?php 
			  }?>
              
               <?php // FILA DE DEVOLUCIONES DEUDAS
			  //foreach($listadevolucionesDeuda as $r){
			  ?>
			  
		  <!-- <tr style="background-color:#09F;">
           <td><?php //echo $r["fecha"]; ?></td>
           <td><?php //echo ABREV;?></td>
           <td><?php //echo "NI-".$r["notaingreso"]; ?></td>
           <td><?php ?></td>
           <td><?php //echo $r["descripcion"]." (".$r["descrip"].")"; ?></td>
           <td><?php  ?></td>
           <td align="right">-->
		   <?php 
		  
		   ?>
           <!--</td>
           
           <td></td>
           <td align="right">-->
		   <?php 
		    /*if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($r["monto"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($r["monto"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$r["monto"]; echo $pt;  }
			$sumhaber+=$pt;*/
		   ?>
          <!-- </td>
           <td align="right"><?php //echo $saldo_inicial-=$pt;  ?></td>
           <td align="center">DEVOLUCION DEUDA</td>
           
          </tr>-->
			  
			  
			 <?php 
			  //}?>
              
               <?php //FILA DE PAGOS CREDITO
			  foreach($listapagos as $r){
			  ?>
			  
		   <tr style="background-color:#D7B54D">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php echo $r["numrecibo"]; ?></td>
           <td><?php  ?></td>
           <?php if($r["tipopago"]=="EFECTIVO"){ ?>
           <td>PAGO EN EFECTIVO <a href="#" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $r["idventas"];?>');"><?php echo "NV:".VENTA."-".$r["idventas"]; ?></a> <?php echo $r["numcuota"]?></td> <?php }?>
           <?php if($r["tipopago"]=="DEPOSITO") {?>
           <td>DEPOSITO <a href="#" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $r["idventas"];?>');"> <?php echo "NV-".$r["idventas"]; ?></a> <?php echo $r["numcuota"]." ".$r["cuentabanco"]?> </td><?php }?>
           <td></td>
           <td></td>
           
           <td></td>
           <td align="right">
		   <?php 
		     if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($r["monto"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($r["monto"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$r["monto"]; echo $pt;  }
			$sumhaber+=$pt;
		   ?>
           </td>
           <td align="right"><?php echo $saldo_inicial-=$pt; ?></td>
           <td align="center"><?php echo $r["numfactura"]; ?></td>
           
          </tr>
			<?php $aux2=$descuento->kardexCliente($r["idpagoVentasCredito"]);
			if(isset($aux2["iddescuentoPago"])){?> 
			<tr style="background-color:#FF9">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php  ?></td>
           <td><?php  ?></td>
                
           <td><?php echo $aux2["descripcion"];?> </td>
		   
           <td></td>
           <td></td>
           
           <td></td>
           <td align="right"><?php
		   
			 if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($aux2["monto"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($aux2["monto"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$aux2["monto"]; echo $pt;  }
			$sumhaber+=$pt;
			?>
            </td>
           <td align="right"><?php echo $saldo_inicial-=$pt;  ?></td>
           <td align="center"><?php echo "DESCUENTO";?></td>
           
          </tr>
			        <?php }
			  }?> 
                    
                  <?php //FILA DE PAGOS DEUDAS
			  foreach($listapagos2 as $r){
			  ?>
			  
		   <tr style="background-color:#D7B54D">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php echo $r["numrecibo"]; ?></td>
           <td><?php  ?></td>
           <?php if($r["tipopago"]=="EFECTIVO"){ ?>
           <td>PAGO EN EFECTIVO <?php echo $r["descripcion"]; ?></td>
		   <?php }?>
           <?php if($r["tipopago"]=="DEPOSITO") {?>
          <td>DEPOSITO <?php echo $r["descripcion"]." ".$r["cuentabanco"]; ?></td>
		   <?php }?>
           <td></td>
           <td></td>
           
           <td></td>
           <td align="right">
		   <?php
		    if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($r["monto"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($r["monto"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$r["monto"]; echo $pt;  }
			$sumhaber+=$pt;
			?>
            </td>
            <td align="right"><?php echo $saldo_inicial-=$pt;  ?></td>
           <td align="center"><?php echo $r["numfactura"]; ?></td>
           
          </tr>
			<?php $aux2=$descuento->kardexCliente($r["idpagoVentasCredito"]);
			if(isset($aux2["iddescuentoPago"])){?> 
			<tr style="background-color:#FF9">
           <td><?php echo $r["fecha"]; ?></td>
           <td><?php echo ABREV;?></td>
           <td><?php  ?></td>
           <td><?php  ?></td>
                
           <td><?php echo $aux2["descripcion"];?> </td>
		   
           <td></td>
           <td></td>
           
           <td></td>
           <td align="right"><?php 
            if($r["moneda"]=="Sus" && $_POST["moneda"]=="Bs"){ $pt=round(($aux2["monto"]*$tc2["valor"]),2); echo $pt;} 
		   if($r["moneda"]=="Bs" && $_POST["moneda"]=="Sus"){ $pt=round(($aux2["monto"]/$tc2["valor"]),2); echo $pt;}
		    if($r["moneda"]==$_POST["moneda"]){ $pt=$aux2["monto"]; echo $pt;   }
			$sumhaber+=$pt;
			?>
            </td>
           <td align="right"><?php echo $saldo_inicial-=$pt;  ?></td>
           <td align="center"><?php echo "DESCUENTO";?></td>
           
          </tr>
			        <?php }}?>   
			  
          </tbody>
          <tfoot>
          <TR style="font-weight:bold;">
          <td colspan="4"></td>
          <td  colspan="3"align="center">TOTALES</td>
          <td align="right"><?php echo $sumdebe+$aux3;?></td>
         <td align="right"><?php echo $sumhaber;?></td>
         <td align="right"><?php echo $saldo_inicial;?></td>
         <td></td>
          </TR> 
          
          </tfoot>
          </table>
          </td>
          </tr>
          </table>
         <?php 
			  }//finn de todo?>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>