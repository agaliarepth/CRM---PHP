<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#ventas-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact" style="font-weight:bold">VENTAS > LISTA DE VENTAS</h2>
            
                        <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addVenta" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR VENTA </a>

            
 <form  style="float:right" action="<?php echo config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><a href="">  <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></a><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="listaVentas"  />

</form>
</div>
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="ventas-table" >
                <thead>
				<tr>
					
                    <th class="">Nº Venta</th>
                     <th class="">Fecha</th>
                    <th class="">Cliente</th>
                     <th class="">Mon<br />eda</th>
                    <th class="">Precio<br />Venta</th>
                    <th class="">Monto <br /> Cancelado</th>
                    <th>Recibo<br />Ingreso</th>
                    <th>Factura</th>
                    <th>Banco</th>
                      <th class="">Destino</th>
                      <th class="">tipo de Venta</th>
                      <th class="">Estado</th>
                 	<th class="">Opciones</th>

                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=0;
				foreach($res as $v){
				?><tr>
           
                				
                    <td align="center"><?php echo  VENTA."-".Helpers::rellenarceros($v["idventas"],6);?></td>
                     <td align="center"><?php echo $v["fecha"];?></td>
                    <td><?php  echo $v["nombre"];?></td>
                    <td align="center"><?php echo $v["moneda"];?></td>
                    <td align="right"><?php $cont+=$v["total"];echo number_format($v["total"], 2, ',', '.');?></td>
                    <td align="right"><?php $res3=$cv->getVenta($v["idventas"]);
$res4=$contado->getVenta($v["idventas"]);

 if($v["tipoventa"]=="CONTADO"){
	 echo $res4["monto"];
	 
	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["adelanto"];
	 
	 }
?>

</td>
<td align="center"><?php
if($v["tipoventa"]=="CONTADO"){
	 echo $res4["numingreso"];
	 
	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["reciboadelanto"];
	 
	 }
?>


</td>

<td align="center"><?php
if($v["tipoventa"]=="CONTADO"){
	 echo $res4["numfactura"];
	 
	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["facturaadelanto"];
	 
	 }
	 
?>


</td>
<td align="center"><?php
if($v["tipoventa"]=="CONTADO"){
	 echo $res4["cuentabanco"];
	 
	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["cuentabanco"];
	 
	 }
	 
?>


</td>
                    <td align="center"><?php echo $v["destino"]?></td>
                    <td align="center"><?php echo $v["tipoventa"]?></td>
                    <td  align="center"><?php echo $v["estado"]?></td>

                   <td>  
                     <?php if($v["terminado"]==0 ){?>
                  <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarVentaCredito('<?php echo config::ruta();?>?accion=ventasCredito&id=<?php echo $v["idventas"];?>&e=confirmar');"  width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a>
                  
                  <a  href="<?php echo config::ruta();?>?accion=addVenta&e=ev&id=<?php echo $v["idventas"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota Venta" /></a><?php }?>
                  
                  
                   <a><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25" onclick="eliminar('<?php echo config::ruta();?>?accion=ventasCredito&e=b&id=<?php echo $v["idventas"];?>');"/></a>
                   
                   
                	
                	<?php if($v["terminado"]=="1"){ ?>
            
                  <a><img src="<?php echo config::ruta();?>images/imprimir.png" width="25" height="25" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $v["idventas"];?>');"/></a>
                     <a  href="<?php echo config::ruta();?>?accion=editarVentaAdmin&e=editarVenta&id=<?php echo $v["idventas"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota Venta" /></a>
                  
                  <?php }?>
               

                  </td>
                                    
			
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				
                <tr>
                  <th ></th>
                   <th ></th>
                    <th ></th>
                     <th ></th>
                  <th  align="right"></th>
                  <th  align="right"></th>
                  <th ></th>
                   <th ></th>
                    <th ></th>
                     <th ></th>
                      <th ></th>
                       <th ></th>
                        <th ></th>
                       
                </tr>
                
				</tfoot>
                <tbody>
				</table>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>