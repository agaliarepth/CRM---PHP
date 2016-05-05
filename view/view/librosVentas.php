<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">LIBROS</h2>
            <div>
           <table border="0"  cellpadding="0" cellspacing="0" id="categorias-table" style="font-size:9px;">
                <thead>
				<tr>
					
					
                    <th class="">Codigo</th>
                     <th class="">Foto</th>
                    <th  width="250" class="">Titulo</th>
                    <th class="">Categoria</th>
                    <th class="">Proveedor</th>
                   
                    <th class="">Tomo</th>
                    <th class="">Stock Disponible </th>
                     <th class="">Precio Venta</th>
                   	<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
				
					
					<td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                                        <td><img src="<?php echo $v["foto"]; ?>" title="<?php echo $v["codigo"]; ?>"/></td>

                                        <td><?php echo $v["titulo"]?></td>

                     <td><?php $res2=$cat->getId($v["categorias_idcategorias"]); echo $res2["descripcion"];?></td>
                      <td><?php $res3=$p->getId($v["proveedores_idproveedores"]); echo $res3["nombre"];?></td>
                    <td><?php echo $v["tomo"]?></td>
                    
                    <?php if($v["stock"]<=$v["stock_minimo"]){?>
                    <td  style="background-color:#ECA6BB;"><?php echo $v["stock"]?></td><?php } 
					else{?>
                     <td><?php echo $v["stock"]?></td><?php }?>
                    
                    <td ><?php echo $v["pv"]?></td>
                                          

					<td >
					<a href="<?php echo config::ruta();?>?accion=editarLibrosVentas&id=<?php echo $v["idlibros"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				
					<th class="">Codigo</th>
                    <th class="">Foto</th>
                   <th  width="250" class="">Titulo</th>
                    <th class="">Categoria</th>
                    <th class="">Proveedor</th>
                    
                    <th class="">Tomo</th>
                    <th class="">Stock Disponible </th>
                     <th class="">Precio Venta</th>
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