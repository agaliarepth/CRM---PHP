<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">Vendedores > LISTAR VENDEDORES</h2>
            <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addVendedor" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR VENDEDOR </a>
            <div>
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">NOMBRES</th>
                  
                    
                    <th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $r){
				?><tr>
					
					<td><?php echo $r["nombres"];?></td>
                    
                   
                                      
                    
					<td >
					<a href="<?php echo config::ruta();?>?accion=addVendedor&e=editar&id=<?php echo $r["idvendedores"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
					<!--<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=clientes&e=bc&id=<?php echo $v["idvendedores"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>-->
				
					</td>
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