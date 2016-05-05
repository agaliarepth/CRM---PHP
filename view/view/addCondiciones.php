<?php require_once("head.php");?>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">VENTAS > ADICIONAR CONDICIONES</h2>
            <div>
           VENTAS .... VISUAL EDICIONES
            </div>
           <table width="100%" border="1">
  <tr>
    <td width="201">CLIENTE</td>
    <td width="201">Razon social</td>
    <td width="50">NIT</td>
    <td width="55">PAIS </td>
    <td width="55">CIUDAD</td>
    <td width="30">TELF</td>
  </tr>
  <tr>
    <td><?php echo $res["nombre"];?></td>
    <td><?php echo $res["razonsocial"];?></td>
    <td><?php echo $res["nit"];?></td>
    <td><?php echo $res["pais"];?></td>
    <td><?php echo $res["ciudad"];?></td>
    <td><?php echo $res["telf"];?></td>
  </tr>
</table>
<HR />
<table width="100%" border="1">
  <tr>
    <td width="8%">Codigo</td>
    <td width="50%">Descripcion</td>
    <td width="6%">Vol</td>
    <td width="10%">CANT</td>
    <td width="10%">P. Unit</td>
    <td width="10%">P.TOTAL</td>
  </tr>
  <?php foreach($res2 as $r){?>
  <tr>
    <td><?php echo $r["codigo"];?></td>
    <td><?php echo $r["titulo"];?></td>
    <td><?php echo $r["volumen"];?></td>
    <td><?php echo $r["cantidad"];?></td>
    <td><?php echo $r["precio_unit"];?></td>
    <td><?php echo $r["precio_total"];?></td>
  </tr>
  <?php }?>
  <tr>
  <td colspan="2">&nbsp;</td>
    <td>TOTAL</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> 
            <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>