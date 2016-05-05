<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_catalogo"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
		<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#categorias-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>

 <div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">CATEGORIAS > LISTAR</h2>
            
            <div>
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					
					<th class="">ID </th>
                    	<th class="">Codigo</th>
					
					<th class="">Descripcion</th>
					<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
					
					
					<td><?php echo $v["idcategorias"];?></td>
                    <td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                    <td><?php echo $v["descripcion"]?></td>

					<td >
					<a href="<?php echo config::ruta();?>?accion=addCategorias&e=ec&id=<?php echo $v["idcategorias"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=categorias&e=bc&ic=<?php echo $v["idcategorias"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
					
					<th class="">ID </th>
						<th class="">Codigo</th>
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
        
    </div> <!-- END #main_content -->
    
    
				
				
				<!--  end product-table................................... --> 
				
			<?php require_once("footer.php");?>
<!-- end footer -->
 

<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>