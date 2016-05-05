<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">CLIENTES > LISTAR CLIENTES</h2>
            <div>
        <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">Nombres</th>
                    <th  align="center"class="">Pais</th>
                    <th  align="center"class="">Ciudad</th>
                    <th class="">Esposo</th>
                    <th class="">Empresa</th>
                    <th class="">Telefono</th>
                    <th class="">Fax</th>
                    <th class="">Celular</th>
                    <th class="">RUC/NIT</th>
                    <th class="">Email</th>
                    <th class="">Direccion </th>
                    <th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					<td width="250"><?php echo utf8_decode($v["nombres"]." ".$v["apellidos"]);?></td>
                   
                    <td align="center"><?php echo $v["origen"];?></td>
                    <td align="center"><?php echo $v["ciudad"];?></td>
                    <td><?php echo $v["esposo"];?></td>
                    <td><?php echo $v["empresa"]?></td>
                    <td><?php echo $v["telefono"];?></td>
                    <td><?php echo $v["fax"];?></td>
                    <td><?php echo $v["celular"];?></td>
                    <td><?php echo $v["nitruc"];?></td>
                    <td><?php echo $v["email"];?></td>
                    <td width="250"><?php echo $v["direccion"];?></td>
                    
                    
					<td >
					<a href="<?php echo config::ruta();?>?accion=addClientes&e=ec&id=<?php echo $v["idclientes"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=clientes&e=bc&id=<?php echo $v["idclientes"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				    <th class="">Nombres</th>
                    <th class="">Pais</th>
                    <th class="">Ciudad</th>
                    <th class="">Esposo</th>
                    <th class="">Empresa</th>
                    <th class="">Telefono</th>
                    <th class="">Fax</th>
                    <th class="">Celular</th>
                    <th class="">RUC/NIT</th>
                    <th class="">Email</th>
                    <th class="">Direccion </th>
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