<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">COMPRAS > LISTAR COMPRAS</h2>
            <div>
            <script type="text/javascript">
             $(function() {
$( "#tabs" ).tabs();
});

            
            </script>
            <div id="tabs">
<ul>
<li><a href="#tabs-1">Compras a Credito</a></li>
<li><a href="#tabs-2">Compras Contado</a></li>
</ul>
<div id="tabs-1">
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table2">
                <thead>
				<tr>
					
					
                    <th class="">Acciones </th>
                    <th >Num </br>Compra </th>
                    <th class="">Fecha</th>
                    <th class="">Num doc</th>
                    <th class="">Proveedor</th>
                   <th class="">Monto total</th>
                   <th class="">Fecha Pago</th>
                    <th class="">Num Cuotas</th>
                    <th class="">Saldo</th>
                                     
                      <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res2 as $v){
				?><tr>
                <td>  <?php if($v["terminado"]==0){ ?>
                  
                 
<a href="#"><img src="<?php echo config::ruta();?>images/download.png" onclick="enviarCompra('<?php echo config::ruta();?>?accion=addCompras&id=<?php echo $v["idcompras"];?>&e=n');"  width="20" height="20" alt="Enviar Nota" title="Enviar Nota" /></a>



  	
                  
                  <?php }?>
                  
                  <?php if($v["terminado"]==0 ){?>
                  <a  href="<?php echo config::ruta();?>?accion=addCompras&e=ei&id=<?php echo $v["idcompras"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="20" height="20"  alt="editar" title="Editar Nota" /></a><?php }?>
                  
                  <?php if($v["terminado"]==1 && $v["estado"]!="pagado" ){?>
                  <a  href="<?php echo config::ruta();?>?accion=addPagosCompras&id=<?php echo $v["idcompras"];?>"><img src="<?php echo config::ruta();?>images/money.png" width="20" height="20"  alt="editar" title="Registrar Pago" /></a>
				  
				 <a  href="<?php echo config::ruta();?>?accion=addCargosCompras&id=<?php echo $v["idcompras"];?>"><img src="<?php echo config::ruta();?>images/cargo.png" width="20" height="20"  alt="editar" title="Registrar Cargo" /></a>  
				  <?php }?>
                  
                  <img src="<?php echo config::ruta();?>images/imprimir.png" width="20" height="20" onclick="imprimir('<?php echo config::ruta();?>?accion=verCompra&id=<?php echo $v["idcompras"];?>');"/></a>
                  </td>
                
                				
					<td width="4"><?php echo $v["idcompras"];?></td>
                    
                     <td><?php echo $v["fecha"]?></td>
                    <td><?php echo $v["numero_doc"]?></td>
                    <td><?php $pro=$p->getId($v["proveedores_idproveedores"]);echo $pro["nombre"]?></td>
                    <td><?php echo $v["total"]?></td>
                    <td><?php echo $v["fechapago"]?></td>
                    <td><?php echo $v["numcuotas"]?></td>
                    <td><?php echo $v["saldo"]?></td>
                    
                   <?php if($v["terminado"]==0){?>
                    <td style="background-color:#EBA0B7;">Sin Enviar</td><?php }?>
                     <?php if($v["terminado"]==1){?>
                    <td style="background-color:#D0FBCE;">Enviado</td><?php }?>
                  <td >
				
                   <?php if($v["estado"]!="Procesando"){?> 
 <img src="<?php echo config::ruta();?>images/eliminar.png" width="20" height="20" onclick="eliminar('<?php echo config::ruta();?>?accion=compras&e=b&id=<?php  echo $v["idcompras"];?>');"/></a>
  	
					
					<?php }?>
				
				
                    
                    	
                  </td>
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				
                <th class="">Acciones </th>
                    <th class="">N Compra </th>
                    <th class="">Fecha</th>
                    <th class="">Num doc</th>
                    <th class="">Proveedor</th>
                   <th class="">Monto total</th>
                   <th class="">Fecha Pago</th>
                    <th class="">Num Cuotas</th>
                    <th class="">Saldo</th>
                      <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
				</tr>
				</tfoot>
                <tbody>
				</table>
</div>
<div id="tabs-2">
<table border="0" width="100%"  cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					
                    <th class="">Acciones </th>
                    <th class="">N Compra </th>
                    <th class="">Fecha</th>
                    <th class="">Num doc</th>
                    <th class="">Proveedor</th>
                   <th class="">Monto total</th>
                      <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>  <?php if($v["terminado"]==0){ ?>
                  
                 
<a href="#"><img src="<?php echo config::ruta();?>images/download.png" onclick="enviarCompra('<?php echo config::ruta();?>?accion=addCompras&id=<?php echo $v["idcompras"];?>&e=n');"  width="20" height="20" alt="Enviar Nota" title="Enviar Nota" /></a>



  	
                  
                  <?php }?>
                  
                  <?php if($v["terminado"]==0 && $v["estado"]=="sin enviar"){?>
                  <a  href="<?php echo config::ruta();?>?accion=addCompras&e=ei&id=<?php echo $v["idcompras"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="20" height="20"  alt="editar" title="Editar Nota" /></a><?php }?>
                  
                  <img src="<?php echo config::ruta();?>images/imprimir.png" width="20" height="20" onclick="imprimir('<?php echo config::ruta();?>?accion=verCompra&id=<?php echo $v["idcompras"];?>');"/></a>
                  </td>
                
                				
					<td><?php echo $v["idcompras"];?></td>
                    
                     <td><?php echo $v["fecha"]?></td>
                    <td><?php echo $v["numero_doc"]?></td>
                    <td><?php $pro=$p->getId($v["proveedores_idproveedores"]);echo $pro["nombre"]?></td>
                    <td><?php echo $v["total"]?></td>
                    
                      <?php if($v["terminado"]==0){?>
                    <td style="background-color:#EBA0B7;">Sin Enviar</td><?php }?>
                     <?php if($v["terminado"]==1){?>
                    <td style="background-color:#D0FBCE;">Enviado</td><?php }?>
                    
                  <td >
				
                  <?php if($v["estado"]!="Procesando"){?> 
 <img src="<?php echo config::ruta();?>images/eliminar.png" width="20" height="20" onclick="eliminar('<?php echo config::ruta();?>?accion=compras&e=b&id=<?php  echo $v["idcompras"];?>');"/></a>
  	
					
					<?php }?>
				
                    
                    	
                  </td>
					
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				
                <th class="">Acciones </th>
                    <th class="">N Compra </th>
                    <th class="">Fecha</th>
                    <th class="">Num doc</th>
                    <th class="">Proveedor</th>
                   <th class="">Monto total</th>
                      <th class="">Estado</th>
                   <th class="">Borrar</th>
                  
				</tr>
				</tfoot>
                <tbody>
				</table>
</div>

</div>
           
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>