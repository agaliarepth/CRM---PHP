<?php require_once("head.php");?>
<script>
              $(document).ready(function() {
$('#devoluciondinero-table').dataTable( {
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"
		
        },
		
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [4,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"
		
    } );
			  });
			  </script>
	
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ADMINISTRACION > DEVOLUCION DINERO</h2>
             <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addDevolucionDinero" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR NUEVA DEVOLUCION DINERO </a></div>

            <div>
                
           
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="devoluciondinero-table">
                <thead>
				<tr>
					
					
                    <th class="">ACCIONES </th>
                    <th class="">CLIENTE</th>
                     <th class="">MONTO</th>
                     <th class="">MONEDA</th>
                    <th class="">FECHA</th>
                     <th class="">DESCRIPCION</th>
                     <th class="">NUM RECIBO</th>
                  
                   
                  
                    
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				$cont=1;
				$sw=0;
				foreach($res as $v){
				?><tr>
                <td>    <?php  
				 
                     if( $v["terminado"]==0){
					 
					  ?>
                      <a href="<?php echo config::ruta();?>?accion=addDevolucionDinero&e=editar&id=<?php echo $v["iddevolucion_dinero"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="35" height="35"  /></a>
                      <a href="<?php echo config::ruta();?>?accion=addDevolucionDinero&e=aceptar&id=<?php echo $v["iddevolucion_dinero"];?>"><img src="<?php echo config::ruta();?>images/download.png" width="35" height="35"/></a>
                   
                      
                      
					 <?php  }
					 else{
                     
                   if($v["terminado"]==1 ){ ?>
                
                 <img src="<?php echo config::ruta();?>images/aceptar.png" width="35" height="35" />
                  
                  <?php }
					 }
				  ?>
                
				  <a href="#"><img src="<?php echo config::ruta();?>images/eliminar.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=addDevolucionDinero&e=borrar&id=<?php echo $v["iddevolucion_dinero"];?>');"/></a>
				  
                  </td>
                
                				
					<td align="center"><?php echo $v["nombre_cliente"];?></td>
                    <td align="center"><?php echo $v["monto"]?></td>
                    <td align="center"><?php echo $v["moneda"]?></td>
                    <td align="center"><?php echo $v["fecha"]?></td>
                    <td align="center"><?php echo $v["descripcion"]?></td>
                    <td align="center"><?php echo $v["numrecibo"]?></td>
					
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