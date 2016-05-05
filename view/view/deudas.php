<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">ADMINISTRACION >  DEUDAS POR COBRAR</h2>
            <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addDeuda" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR   DEUDA CLIENTE </a></div>
            <div>
          <table id="categorias-table" cellpadding="0" cellspacing="0">
          <thead>
          <tr>
          <th>ACCIONES</th>
          <th>CODIGO</th>
          <th>fecha Compra</th>
         <th>fecha Vencimiento</th>

          <th>Cliente</th>
          <th>Descripcion</th>
          <th>Dias Credito</th>
          <th>Num cuota</th>
          <th>Monto total <br /> Deuda</th>
          <th>Saldo Inicial <br />Deuda</th>
          <th>Saldo Actual <br />Deuda</th>
          <th>Moneda</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($res as $v){?>
          <tr>
          <td>
          <a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=deudas&e=borrar&id=<?php echo $v["iddeudas"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
          <a href="<?php echo config::ruta();?>?accion=addDeuda&e=editar&id=<?php echo $v["iddeudas"];?>" title="Editar"  ><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"/></a>
          <?php if($v["saldo_actual"]>0){?>
          
           <?php }?>
          </td>
          <TD align="center"><?php echo $v["iddeudas"];?></TD>
          <td><?php echo date("d-m-Y",strtotime($v["fecha"])); ?></td>
                    <td><?php echo date("d-m-Y",strtotime($v["fechavencimiento"])); ?></td>

          <td><?php echo $v["nombre_cliente"];?></td>
          <td><?php echo $v["descripcion"];?></td>
          <td><?php echo $v["dias_credito"];?></td>
          <td><?php echo $v["numcuotas"];?></td>
          <td align="right"><?php echo number_format($v["saldo_inicial"], 2, ',', '.');?></td>
           <td align="right"><?php echo number_format($v["saldo"], 2, ',', '.');?></td>
          <td align="right"><?php echo number_format($v["saldo_actual"], 2, ',', '.');?></td>
          <td><?php echo $v["moneda"];?></td>
          
          </tr>
          
          <?php }?>
          
          </tbody>
          </thead>
          
          </table>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>