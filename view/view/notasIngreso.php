<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ALMACEN > NOTAS DE INGRESO</h2>
            <div>
                
             <div  style=" background-color:#FBFACE;margin-bottom:20px;"> 
             <a  href="<?php echo config::ruta();?>?accion=addIngreso" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/> NUEVA NOTA DE INGRESO </a>

</div>
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					
                    <th class="">Acciones </th>
                    <th class="">Nº Ingreso </th>
                    
                    <th class="">Fecha</th>
                    <th class="">Envia</th>
                    <th class="">Recibe</th>
                   <th class="">Concepto</th>
                      <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>  <?php if($v["estado"]=="Sin Enviar"){ ?>
                  
                 
<a href="#"><img src="<?php echo config::ruta();?>images/download.png" onclick="enviarIngreso('<?php echo config::ruta();?>?accion=addIngreso&id=<?php echo $v["idingreso"];?>&e=n');"  width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a>



  	
                  
                  <?php }?>
                  
                  <?php if($v["terminado"]==0 && $v["estado"]=="Sin Enviar"){?>
                  <a  href="<?php echo config::ruta();?>?accion=addIngreso&e=ei&id=<?php echo $v["idingreso"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota" /></a><?php }?>
                  
                  <img src="<?php echo config::ruta();?>images/imprimir.png" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verIngreso&id=<?php echo $v["idingreso"];?>');"/></a>
                  </td>
                
                				
					<td align="center"><?php echo $v["idingreso"];?></td>
                    
                     <td align="center"><?php echo $v["fecha"]?></td>
                    <td><?php echo $v["envia"]?></td>
                    <td><?php echo $v["recibe"]?></td>
                    <td align="center"><?php echo $v["concepto"]?></td>
                    
                      <?php if($v["estado"]=="Sin Enviar"){?>
                    <td style="background-color:#EBA0B7;"><?php echo $v["estado"]?></td><?php }?>
                     <?php if($v["estado"]=="Enviado"){?>
                    <td style="background-color:#D0FBCE;"><?php echo $v["estado"]?></td><?php }?>
                     <?php if($v["estado"]=="Procesando"){?>
                    <td style="background-color:#FC6;"><?php echo $v["estado"]?></td><?php }?>
                  <td >
				
                   <?php if($v["estado"]!="Procesando"){?> 
 <img src="<?php echo config::ruta();?>images/eliminar.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=notasIngreso&e=bi&sw=<?php echo $v["estado"];?>&ii=<?php echo $v["idingreso"];?>');"/></a>
  	
					
					<?php }?>
				
				
                    
                    	
                  </td>
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				
                 <th class="">Acciones</th>
                     <th class="">Nº Ingreso </th>
                    <th class="">Fecha</th>
                    <th class="">Envia</th>
                    <th class="">Recibe</th>
                   <th class="">Concepto</th>
                     <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
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