<?php require_once("head.php");?>
<script type="application/javascript">
   $(document).ready(function() {
	   
	    $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#libros-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
	   
$('#libros-table').dataTable( {
		
		
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
		"aaSorting": [ [0,'asc'] ],
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
            
            
            <h2 id="contact">LIBROS</h2>
              <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addLibros" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR LIBRO </a>

            
 <form  style="float:right" action="<?php echo config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><a href="">  <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></a><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="listaLibros"  />

</form>
</div>
            <div>
           <table border="0"  cellpadding="0" cellspacing="0" id="libros-table" style="font-size:9px;">
                <thead>
				<tr>
					
					
                    <th class="">Codigo</th>
                    <th  width="250" class="">Titulo</th>
                    <th class="">Categoria</th>
                    <th class="">Proveedor</th>
                    <th class="">Foto</th>
                    <th class="">Tomo</th>
                    <th class="">Stock </th>
                    <th class="">Stock Minimo </th>
                     <th class="">Precio Venta</th>
                    <th class="">Precio CIF</th>
                    <th class="">Precio Sucursal</th>
                   	<th class="">Opciones</th>
				</tr>
				</thead>
                <tbody>
                <?php 
				
				foreach($res as $v){
				?><tr>
				
					
					<td style="font-weight:bold;"><?php echo $v["codigo"];?></td>
                                        <td><?php echo $v["titulo"]?></td>

                     <td><?php $res2=$cat->getId($v["categorias_idcategorias"]); echo $res2["descripcion"];?></td>
                      <td><?php $res3=$p->getId($v["proveedores_idproveedores"]); echo $res3["nombre"];?></td>
                    <td><img src="<?php echo $v["foto"]; ?>" title="<?php echo $v["codigo"]; ?>"/></td>
                    <td><?php echo $v["tomo"]?></td>
                    
                    <?php if($v["stock"]<=$v["stock_minimo"]){?>
                    <td  style="background-color:#ECA6BB;"><?php echo $ingreso->getStockActual($v["idlibros"])-$egreso->getStockActual($v["idlibros"]);?></td><?php } 
					else{?>
                     <td><?php echo $ingreso->getStockActual($v["idlibros"])-$egreso->getStockActual($v["idlibros"]);?></td><?php }?>
                    <td ><?php echo $v["stock_minimo"]?></td>
                    
                    <td ><?php echo $v["pv"]?></td>
                    <td ><?php echo $v["cif"]?></td>
                                        <td ><?php echo $v["ps"]?></td>

                                          

					<td >
					<a href="<?php echo config::ruta();?>?accion=addLibros&e=el&id=<?php echo $v["idlibros"];?>" title="Editar" ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
                    
					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=libros&e=bl&id=<?php echo $v["idlibros"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
				
					</td>
				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>
				
					<th class="">Codigo</th>
                   <th  width="250" class="">Titulo</th>
                    <th class="">Categoria</th>
                    <th class="">Proveedor</th>
                    <th class="">Foto</th>
                    <th class="">Tomo</th>
                    <th class="">Stock </th>
                    <th class="">Stock Minimo </th>
                     <th class="">Precio Venta</th>
                    <th class="">Precio CIF</th>
                                        <th class="">Precio Sucursal</th>

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