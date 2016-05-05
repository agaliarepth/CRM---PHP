<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ALMACEN > PENDIENTES</h2>
            <div>
         <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th>Acciones</th>
                    <th class="">Nº Venta</th>
                     <th class="">Fecha</th>
                    <th class="">Cliente</th>
                   
				</tr>
				</thead>
                <tbody>
                <?php  foreach($res as $v){?>
                 <tr>
                 
                 <th><a href="<?php echo config::ruta();?>?accion=addPendiente&id=<?php echo $v["idventas"];?>&e=adicionar"><img src="<?php echo config::ruta();?>images/addne.png"   width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a></th>
                     <th class=""><?php  echo $v["idventas"];?></th>
                     <th class=""><?php  echo $v["fecha"];?></th>
                     <th class=""><?php  echo $v["nombre"];?></th>
                 
                 </tr>
                 <?php }?>
                    
               
                </tbody>
                <tfoot>
				<tr>
				
                 <th>Acciones</th>
                    <th class="">Nº Venta</th>
                     <th class="">Fecha</th>
                    <th class="">Cliente</th>
                  
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