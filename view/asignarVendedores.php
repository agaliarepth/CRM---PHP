<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ADMINISTRACION > USUARIOS > ASIGNACION VENDEDORES</h2>
            <div>
            <form action="" method="post" name="form">
            <table>
            <tr>
            <td><label>SELECCIONE UN VENDEDOR PARA ESTE USUARIO</label></td>
             <td><select  name="idvendedores">
             <?php foreach($vendedores as $r){?>
             <option value="<?php echo $r["idvendedores"]?>"><?php echo $r["nombres"]?></option><?php }?>
             </select></td>
             
            </tr>
            <tr>
            <td>
            <input type="button" id="bEnviar" value="Guardar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/></td>
            <td>
            <input type="button" id="cancelar" value="Cancelar" name="Cancelar" />
            <input type="hidden" name="enviar" value="enviar"/>
            <input type="hidden" name="idusuarios" value="<?php echo $_GET["id"];?>"/>
            
            </td>
            </tr>
            </table>
            </form>
            <table id="categorias-table" border="0">
            <thead>
            <tr>
            <th>VENDEDOR</th>
            <TH>OPCIONES</TH>
            
            </tr>
            <tbody>
            <?php
            foreach($res as $r){
			?>
            <tr>
            <td><?php  $n=$v->getId($r["idvendedores"]);  echo $n["nombres"];?></td>
            <td><a  href="<?php config::ruta(); ?>?accion=asignarvendedores&e=quitar&id1=<?php echo $n["idvendedores"]?>&id2=<?php echo $r["idusuarios"]?>">QUITAR VENDEDOR</a></td>
            </tr>
            <?php }?>
            
            </tbody>
            <tfoot></tfoot>
            </thead>
            
            
            
            </table>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>