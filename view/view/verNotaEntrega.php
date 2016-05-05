 <style type="text/css">
/* 
	Web20 Table Style
	written by Netway Media, http://www.netway-media.com
*/

table {
  border-collapse: collapse;
  border: 1px solid #666666;
  font: normal 11px verdana, arial, helvetica, sans-serif;
  color: #363636;
  background: #FFF;
  text-align:left;
  }
caption {
  text-align: center;
  font: bold 16px arial, helvetica, sans-serif;
  background: transparent;
  padding:6px 4px 8px 0px;
  color: #CC00FF;
  text-transform: uppercase;
}
thead, tfoot {
background:url(bg1.png) repeat-x;
text-align:left;
height:30px;
}
thead th, tfoot th {
padding:5px;
}
table a {
color: #333333;
text-decoration:none;
}
table a:hover {
text-decoration:underline;
}
tr.odd {
background: #f1f1f1;
}
tbody th, tbody td {
padding:5px;
}
.negrita{
	font-weight:bold;
	
	}
		.titulo{ font-size:18px; font-weight:bold; text-decoration:underline; }
 </style>
<script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>

 <script src="<?php echo config::ruta();?>js/PrintArea.js" type="text/javascript"></script>
   <script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#exportar").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
});
</script>
 <body>
 <div id="myPrintArea"  style="width:600px; margin:auto 10px;">
  <table id="exportar" border="0" style="font-family:calibri; font-size:10px; border:hidden;" >
<tr>
<td>
<table width="650" border="0" align="center" style="font-family:calibri; font-size:10px; ">
  <tr>
    <td colspan="4"><img  style="float:left" src="<?php echo config::ruta();?>images/logo2.png" width="90" height="51"/>
      <table border="0" style="border:hidden;"  cellpadding="0" cellspacing="0">
      <tr>
        <td width="358" align="center"><div align="center"><strong>VISUAL EDICIONES S.R.L</strong>
        <BR><span style="font-weight:bold; font-size:8px;">SUCURSAL- <?php echo SUCURSAL;?></span></td>
        
        </tr>
        <TR style="font-size:9px;">
          <TD><div align="center"><?php echo CABECERA;?></div></TD></TR>
   </table>
    <td>
    
    
    

    
    </td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td colspan="4" align="center" ><span style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;  margin-left:130px;"> NOTA DE ENTREGA</span></p></td>
    <td width="76"  ></td>
    <td align="center" width="100"  style=" border:groove;"><span   style="font-size:18px; font-weight:bold;">N&ordm;: <?php echo Helpers::rellenarCeros($res["idegreso"],6); ?></span></td>
  </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:hidden; font-size:10px; font-family:calibri; font-style:normal;" ><TR>
    <td width="59"  class="negrita">RECIBE :</td>
    <td width="210"  class="negrita"> <?php echo $res["recibe"]; ?></td>
    <td colspan="3"  class="negrita">ENVIA: <?php echo $res["envia"]; ?>       </td>
    <td width="113"  class="negrita">FECHA:<?php echo $res["fecha"]; ?></td>
    </tr>
  <tr>
    <td class="negrita">DESTINO:</td>
    <td class="negrita"> <?php echo $res["destino"]; ?></td>
    <td colspan="2" class="negrita">CONCEPTO: <?php echo $res["concepto"]; ?></td>
    <td  colspan="2"class="negrita">NOTA VENTA: <?php echo Helpers::rellenarCeros($res["idventas"],6); ?></td>
    </tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="650" border="1" style="font-family:calibri; font-size:10px;" cellspacing="0" >
<thead>
  <tr>
  
    <td align="center" width="33" class="negrita">N</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"align="center" width="35" class="negrita">CODIGO</td>
    <td align="center" width="47" class="negrita">CANTIDAD</td>
    <td align="center" width="347" class="negrita">TITULO</td>
    <td align="center" width="25" class="negrita">VOL</td>
    
    
    
  </tr>
  </thead>
  <tbody>
  <?php $cont =1; foreach($res2 as $v){ ?>
  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php $det=$l->getId($v["libros_idlibros"]);echo $det["codigo"];?></td>
    <td><?php echo $v["cantidad"];?></td>
    <td align="left"><?php echo utf8_decode( $det["titulo"]);?></td>
    <td><?php echo Helpers::ceros( $det["tomo"],2);?></td>
    
     
  </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="CENTER"  colspan="2" class="negrita">C./TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><span class="negrita"><?php echo $res["cant_total"]; ?></span></td>
    <td colspan="3">&nbsp;</td>
    </tr>
  </tfoot>
</table>

</td>
</tr>
<tr>
<td>
<table width="100%" border="0">
<tr>
<td >

<p  style="margin:auto 0; text-align:left; font-size:9px;">Usuario:<?php echo $res["nombre_usuarios"]; ?></p>


</td>
<td>

<p  style="margin:auto 0; text-align:left; font-size:9px;">Moneda:<?php echo $res["moneda"]; ?></p>
</td>
<td><p  style="margin:auto 0; text-align:left; font-size:9px">Valor Cambio:<?php echo $res["valor_cambio"]; ?></p></td>

</tr>
<tr>
<td colspan="3" align="center">
<div style=" width:260px; float:left;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;margin-left:15px; ">--------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">DESPACHADO POR</br>
<?php  ?>
</br>ENCARGADO DE ALMACEN</p>
</div>

</td>
<td>
<div style=" width:260px; float:right;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">----------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">RECIBIDO POR</p>
<p  style="margin:auto 0; text-align:center; font-size:10px;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
</div>
</td>
</tr>
<tr>
<td colspan="5"><p style="font-family:calibri; font-size:10px;" ><b>Observaciones:</b><?php echo $res["obs"]; ?></p></td>

</tr>
</table>
</td>
</tr>
</table>










 </div><?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/imprimir.png" alt="imprimir">Imprimir</a> </p>
     <?php } ?>

     
      <p><a href="<?php config::ruta();?>?accion=notasEgreso">Volver </a></p>
      <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
</body>
