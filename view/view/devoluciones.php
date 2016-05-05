<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > DEVOLUCIONES</h2>
            <div>
                
           
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					
                    <th class="">Acciones </th>
                    <th class="">Nota<br /> de Ingreso </th>
                     <th class="">Fecha</th>
                    <th class="">Cliente</th>
                     <th class="">Monto</th>
                     <th class="">Moneda</th>
                    <th>ESTADO</th>
                   
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				$sw=0;
				foreach($res as $v){
				?><tr>
                <td>    <?php  
				  $aux=$dev->devolucion_ingreso($v["idingreso"]);
				 
                     if(isset($aux["idingreso"]) && $aux["estado"]=="Sin Enviar"){
					 
					  ?>
                      <a href="<?php echo config::ruta();?>?accion=addDevolucion2&e=editar&id=<?php echo $aux["iddevolucion"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="35" height="35"  /></a>
                      <a href="<?php echo config::ruta();?>?accion=procesarDevolucion&id=<?php echo $aux["iddevolucion"];?>"><img src="<?php echo config::ruta();?>images/procesar.png" width="35" height="35"/></a>
                      
                      
					 <?php  }
					 else{
                     
                   if($v["terminado"]==1 && ($v["estado"]=="Enviado") &&!isset($aux["idingreso"])){ ?>
                  <a href="#"><img src="<?php echo config::ruta();?>images/rechazar.png" width="35" height="35"  onclick="rechazarDevolucion('<?php echo config::ruta();?>?accion=devoluciones&e=rechazar&id=<?php echo $v["idingreso"];?>');"/></a>
                 <a href="<?php echo config::ruta();?>?accion=addDevolucion2&id=<?php echo $v["idingreso"];?>">  <img src="<?php echo config::ruta();?>images/refresh.png" width="35" height="35" /></a>
                  
                  <?php }
					 }
				  ?>
                
				  
				  
                  </td>
                
                				
					<td align="center"><?php echo $v["idingreso"];?></td>
                    
                     <td align="center"><?php echo $v["fecha"]?></td>
                    <td align="center"><?php echo $v["envia"]?></td>
                   <?php if(isset($aux["idingreso"])){?>
                    <td align="right"><?php echo $aux["total"]?></td>
                    <?php }
					else{?>
                    <td align="right">0</td><?php }?>
                     <td align="center"><?php echo $v["moneda"]?></td>
                     <?php if(isset($aux["idingreso"])){?>
                     <td align="center"><?php echo strtoupper($aux["estado"]);?></td>
                     <?php }
					else{?>
                    <td align="center">SIN PROCESAR</td><?php }?>
                   
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				
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