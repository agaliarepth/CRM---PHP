<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">INICIO</h2>
            <div>
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">Nombre</th>
                    <th class="">Contacto</th>
                    <th class="">Pais-Ciudad</th>
                    <th class="">Direccion</th>
                    <th class="">Telefonos</th>
                    <th class="">Email</th>
                    <th class="">RUC/NIT</th>
                    <th class="">BANCO</th>
                    <th class="">Num Cuenta</th>
                    
                    <th class="">Tiempo-Gracia</th>
                    <th class="">Condiciones</th>
                    <th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					<td><?php echo $v["nombre"];?></td>
                   
                    <td><?php echo $v["contacto"];?></td>
                    <td><?php echo $v["pais"]."-".$v["ciudad"];?></td>
                    <td><?php echo $v["direccion"]?></td>
                    <td><?php echo $v["telf1"]." - ".$v["telf2"]." - ".$v["telf3"];?></td>
                    <td><?php echo $v["email"];?></td>
                    <td><?php echo $v["rucnit"];?></td>
                    <td><?php echo $v["banco"];?></td>
                    <td><?php echo $v["numcuenta"];?></td>
                    
                    <td><?php echo $v["tiempogracia"];?></td>
                    <td><?php echo $v["condiciones"];?></td>
                    
                    
					<td >
					<a href="<?php echo config::ruta();?>?accion=addProveedores&e=ep&id=<?php echo $v["idproveedores"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=proveedores&e=bp&id=<?php echo $v["idproveedores"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
						<th class="">Nombre</th>
                    <th class="">Contacto</th>
                    <th class="">Pais-Ciudad</th>
                    <th class="">Direccion</th>
                    <th class="">Telefonos</th>
                    <th class="">Email</th>
                    <th class="">RUC/NIT</th>
                    <th class="">BANCO</th>
                    <th class="">Num Cuenta</th>
                    
                
                    <th class="">Tiempo-Gracia</th>
                    <th class="">Condiciones</th>
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