<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > PAGOS</h2>
           
          
          <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Acciones</th>
					<th class="">Num <br />Pago</th>
                    <th class="">Num Venta</th>
                    <th class="">Cliente</th>
                    <th class="">Num Cuota</th>
                    <th class="">Monto</th>
                    <th class="">Moneda</th>
                    <th class="">Fecha Pago</th>
                    <th class="">Factura</th>
                    <th class="">Recibo</th>
                    <th class="">Tipo Pago</th>
                    <th class="">Cuenta Banco</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
                                      
					<td>
                   
					
			   <?php if ($v["terminado"]==1 && $v["referencia"]=="deuda"){?>
					
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagoDeuda&e=borrar&id=<?php echo $v["idpagoVentasCredito"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
					<?php }?>
                    
                     <?php if ($v["terminado"]==1 && $v["referencia"]=="credito"){?>
					
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagocuota&e=borrar&id=<?php echo $v["idpagoVentasCredito"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
					<?php }?>
                    
                    <?php if ($v["terminado"]==0 && $v["referencia"]=="deuda"){?>
						 <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarPago('<?php echo config::ruta();?>?accion=addPagoDeuda&id=<?php echo $v["idpagoVentasCredito"];?>&e=confirmar');"  width="35" height="35" alt="Enviar Nota" title="Enviar Pago" /></a>
                   
                  <a  href="<?php echo config::ruta();?>?accion=addPagoDeuda&e=editar&id=<?php echo $v["idpagoVentasCredito"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Pago Pago " /></a>
					  <?php }?>
                      
                      
                      
                      <?php if ($v["terminado"]==0 && $v["referencia"]=="credito"){?>
						 <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarPago('<?php echo config::ruta();?>?accion=addPagocuota&id=<?php echo $v["idpagoVentasCredito"];?>&e=confirmar');"  width="35" height="35" alt="Enviar Nota" title="Enviar Pago" /></a>
                   
                  <a  href="<?php echo config::ruta();?>?accion=addPagocuota&e=editar&id=<?php echo $v["idpagoVentasCredito"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Pago  " /></a>
					  <?php }?>
					
				
					
                    </td>
                   
                    <td align="center"><?php echo $v["idpagoVentasCredito"];?></td>
                    <td align="center"><?php echo Helpers::rellenarCeros($v["idventas"],6);?></td>
                    <td width="280"><a  title="VER DEUDAS" href="<?php config::ruta()?>?accion=addPagos&id=<?php echo $v["idcliente"];?>"><?php echo $v["cliente"];?></a></td>
                    <td align="center"><?php echo $v["numcuota"];?></td>
                    <td align="right"><?php echo sprintf("%01.2f",$v["monto"]);?></td>
                    <td align="center"><?php echo $v["moneda"];?></td>
                    <td align="center"><?php echo $v["fecha"]?></td>
                    <td align="center"><?php echo $v["numfactura"];?></td>
                    <td align="center"><?php echo $v["numrecibo"];?></td>
                    <td align="center"><?php echo $v["tipopago"];?></td>
                    <td align="center"><?php echo $v["cuentabanco"];?></td>
                                     
                    
					
					
                    
					
				
				
				</tr><?php
				}
				?>
                </tbody>
                
                
				</table>
            <div>
            
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
          </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>