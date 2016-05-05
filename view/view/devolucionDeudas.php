<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">DEVOLUCIONES DEUDAS</h2>
            <div>
                
           
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					
                    <th class="">Acciones </th>
                    <th class="">Nº Devolucion </th>
                    
                    <th class="">Fecha</th>
                    <th class="">Cliente</th>
                     <th>Descripcion</th>
                     <th class="">Monto</th>
                     <th class="">Moneda</th>
                    <th class="">Num Ingreso</th>
                   
                   
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>  <?php if($v["terminado"]==0){ ?>
                  
                 
<a href="#"><img src="<?php echo config::ruta();?>images/download.png" onclick="enviarDevolucion('<?php echo config::ruta();?>?accion=addDevolucionDeudas&id=<?php echo $v["iddevolucion_deudas"];?>&e=n');"  width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a>

 <a  href="<?php echo config::ruta();?>?accion=addDevolucionDeudas&e=editar&id=<?php echo $v["iddevolucion_deudas"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota" /></a>
                  

  	
                  
                  <?php }?>
                  <?php if($v["terminado"]==1){ ?>
                  <img src="<?php echo config::ruta();?>images/eliminar.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=devolucionDeudas&e=borrar&id=<?php echo $v["iddevolucion_deudas"];?>');"/></a>
                  <?php }?>
                  </td>
                
                				
					<td align="center"><?php echo $v["iddevolucion_deudas"];?></td>
                    
                     <td align="center"><?php echo $v["fecha"]?></td>
                    <td align="center"><?php echo $v["cliente"]?></td>
                    <td align="right"><?php echo $v["descripcion"]?></td>
                     <td align="right"><?php echo $v["monto"]?></td>
                     <td align="center"><?php echo $v["moneda"]?></td>
                    <td align="center"><?php echo $v["notaingreso"]?></td>
                   
					
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