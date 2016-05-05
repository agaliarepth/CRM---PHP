<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > VENTAS CONTADO</h2>
            
                        <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addVenta"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR VENTA </a></div>

            <div>
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th>Acciones</th>
                    <th class="">Nº Venta</th>
                     <th class="">Fecha</th>
                    <th class="">Cliente</th>
                    <th class="">Precio Venta</th>
                    <th class="">Num factura</th>
                    <th class="">Num Ingreso</th>
                   <th class="">Monto Ingreso</th>
                   <th class="">Estado</th>
                    <th class="">Opciones</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>  
                  
                  <?php if($v["terminado"]==0 ){?>
                  <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarVentaCredito('<?php echo config::ruta();?>?accion=ventasCredito&id=<?php echo $v["idventas"];?>&e=confirmar');"  width="25" height="25" alt="Enviar Nota" title="Enviar Nota" /></a>
                  
                  <a  href="<?php echo config::ruta();?>?accion=addVenta&e=ev&id=<?php echo $v["idventas"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota Venta" /></a><?php }?>
                  
                  
                   <img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25" onclick="eliminar('<?php echo config::ruta();?>?accion=ventasCredito&e=b&id=<?php echo $v["idventas"];?>');"/></a>

                  </td>
                
                				
                    <td align="center"><?php echo "v-".$v["idventas"]?></td>
                     <td><?php echo $v["fecha"]?></td>
                    <td><?php  echo $v["nombre"];?></td>
                    <td align="right"><?php echo $v["total"]?></td>
                    <td align="right"><?php echo $v["numfactura"]?></td>
                    <td align="right"><?php echo $v["numingreso"]?></td>
                    <td ><?php echo $v["monto"]?></td>
                    <td ><?php echo $v["estado"]?></td>

              
                                    
				<td>
                  
  	<?php if($v["terminado"]=="1"){ ?>
                  
                 


                  <img src="<?php echo config::ruta();?>images/imprimir.png" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $v["idventas"];?>');"/></a>

  	
                  
                  <?php }?>
					
				
				
				
                    
                    	
                  </td>
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				
                 <th>Acciones</th>
                    <th class="">Nº Venta</th>
                     <th class="">Fecha</th>
                    <th class="">Cliente</th>
                    <th class="">Precio Venta</th>
                    <th class="">Num factura</th>
                    <th class="">Num Ingreso</th>
                   <th class="">Monto Ingreso</th>
                   <th class="">Estado</th>
                   <th class="">Opciones</th>
                  
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