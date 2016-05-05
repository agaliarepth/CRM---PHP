<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ALMACEN > DEVOLUCIONES</h2>
            <div>
         <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th>Acciones</th>
                     <th class="">Nº Devolucion</th>
                    <th class="">Nº Venta</th>
                     <th class="">Fecha <br />Devolucion</th>
                    <th class="">Cliente</th>
                   
				</tr>
				</thead>
                <tbody>
                <?php  foreach($res as $v){?>
                 <tr>
                 
                 <th><a href="<?php echo config::ruta();?>?accion=addIngresoDevo&id=<?php echo $v["iddevolucion"];?>&e=adicionar"><img src="<?php echo config::ruta();?>images/ni.png"   width="35" height="35" alt="Nueva Nota Ingreso" title="Nueva Nota Ingreso" /></a></th>
                     <th class=""><?php  echo $v["iddevolucion"];?></th>
                     <th class=""><?php  echo $v["idventas"];?></th>
                     <th class=""><?php  echo $v["fecha"];?></th>
                     <th class=""><?php  echo $v["cliente"];?></th>
                 
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