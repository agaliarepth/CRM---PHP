<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ADMINISTRACION > USUAIOS</h2>
             <div  style="margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addUsuario"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR NUEVO USUARIO</a></div>
            <div>
            <div>
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">ID </th>
                    <th class="">Nombres</th>
                    <th class="">Nombre Usuario</th>
                     <th class="">Contraseña</th>
                    <th class="">Rol de Usuario</th>
                    <th class="">Asignar Vendedores</th>
                     <th class="">Opciones</th>
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idusuarios"];?></td>
                    <td><?php echo $v["nombres"];?></td>
                   <td><?php echo $v["username"];?></td>
                    <td><?php echo $v["password"];?></td>
                    <td><?php $des=$p->getDescripcion($v["perfiles_idperfiles"]);echo $des["descrip"];?></td>
                   <td> <a href="<?php config::ruta(); ?>?accion=asignarVendedores&id=<?php echo $v["idusuarios"]?>">ASIGNAR VENDEDORES</a></td>
                    

					<td >
					<a href="<?php echo config::ruta();?>?accion=addUsuario&e=eu&id=<?php echo $v["idusuarios"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=usuarios&e=bu&id=<?php echo $v["idusuarios"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<th class="">ID </th>
                    <th class="">Nombres</th>
                    <th class="">Nombre Usuario</th>
                     <th class="">Contraseña</th>
                    <th class="">Rol de Usuario</th>
                     <th class="">Opciones</th>
				</tr>
				</tfoot>
                <tbody>
				</table>            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>