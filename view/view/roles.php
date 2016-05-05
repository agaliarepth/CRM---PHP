<?php require_once("head.php");?>

<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ADMINISTRACION > ROLES DE USUARIO</h2>
            <div  style="margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addRol"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR NUEVO ROL DE USUARIO</a></div>
            <div>
           <table border="0" width="100%" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">ID </th>
                    <th class="">Descripcion</th>
                    	                      
					
					
					<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idperfiles"];?></td>
                    <td><?php echo $v["descrip"];?></td>
                   
                    

					<td class="options-width">
					<a href="<?php echo config::ruta();?>?accion=addRol&e=editar&ir=<?php echo $v["idperfiles"];?>" title="Editar" class="icon-1 info-tooltip">EDITAR</a>
					<a href="#" title="Borrar" class="icon-2 info-tooltip" onclick="eliminar('<?php echo config::ruta();?>?accion=roles&e=bp&ip=<?php echo $v["idperfiles"];?>');"></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<th class="">ID </th>
                <th class="">Descripcion</th>
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
