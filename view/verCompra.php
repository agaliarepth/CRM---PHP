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
 
 <div >
 <form action="<?php config::ruta();?>?accion=reporteNotaIngreso" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="<?php config::ruta();?>images/iconos/excel.jpg" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="numero" name="numero" value="<?php echo $res["idingreso"];  ?>" />
<input type="hidden" id="fecha" name="fecha" />
</form>
</div>
 <div id="myPrintArea"  style="width:600px; margin:auto 10px;">
<table id="exportar" border="0" style="font-family:calibri; font-size:10px;">
<tr>
<td>
<table width="650" border="0" align="center" style="font-family:calibri; font-size:10px;">
  <tr>
    <td colspan="6"><img src="<?php echo config::ruta();?>images/logo2.png" width="95" height="40"/></td>
    </tr>
  <tr>
    <td colspan="2" align="center" > <p >&nbsp;</p>
      </td>
    <td width="167" align="center" ><span style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;">NOTA DE COMPRA</span></br>
    (Expresado en <?php if( $res["moneda"]=="bs")echo "Bolivianos"; else echo "Dolares";?>)
    </td>
       <td width="10" ></td>
        <td width="135" ></td>
       <td  style=" border:groove;" colspan="2"><span   style="font-size:18px; font-weight:bold;">N&ordm;:<?php echo $res["idcompras"]; ?></span></td>
  </tr>
  <tr>
    <td width="59"  class="negrita">EMPRESA :</td>
    <td width="138"  class="negrita"> <?php  $pro=$p->getId($res["proveedores_idproveedores"]);echo $pro["nombre"]; ?></td>
    <td colspan="3"  class="negrita">DIRECCION: <?php echo $pro["direccion"]; ?>       </td>
    <td width="113"  class="negrita">FECHA:<?php echo $res["fecha"]; ?></td>
    </tr>
  <tr>
    <td class="negrita">CIUDAD:</td>
    <td class="negrita"> <?php echo $pro["ciudad"]; ?></td>
    <td colspan="2" class="negrita">PAIS:<?php echo $pro["pais"];?></td>
    <td class="negrita" colspan="2">TELEFONOS: <?php echo $pro["telf1"]." ".$pro["telf2"]." ".$pro["telf3"]; ?></td>
    </tr>
    <tr>
    <td class="negrita">RUC/NIT:</td>
    <td class="negrita"> <?php echo $pro["rucnit"]; ?></td>
    <td colspan="3" class="negrita">EMAIL: <?php echo $pro["email"]; ?></td>
    <td class="negrita">TIPO DE COMPRA:<?php echo $res["tipo"]; ?></td>
    <td></td>
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
    <td width="56" align="center" class="negrita">P/UNITARIO</td>
    <td width="61" align="center" class="negrita">P/TOTAL</td>
     <td width="61" align="center" class="negrita">OBS</td>
    
  </tr>
  </thead>
  <tbody>
  <?php $cont =1; $cont2=0;foreach($res2 as $v){ ?>
  <tr align="center">
    <td><?php echo $cont;?></td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><?php $det=$l->getId($v["libros_idlibros"]);echo $det["codigo"];?></td>
    <td><?php $cont2+=$v["cantidad"];echo $v["cantidad"];?></td>
    <td align="left"><?php echo $det["titulo"];?></td>
    <td><?php echo $det["tomo"];?></td>
    <td><?php echo $v["precio_unit"];?></td>
    <td><?php echo $v["precio_total"];?></td>
      <td><?php echo $v["obs"];?></td>
  </tr>
  <?php $cont++;}?>
  </tbody>
  <tfoot>
  <tr align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="CENTER"  colspan="2" class="negrita">C/TOTAL</td>
    <td style="font-weight:bold; background-color:#EFEFEF;"><span class="negrita"><?php echo $cont2; ?></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td  style="font-weight:bold; background-color:#EFEFEF;" class="negrita">P/TOTAL :</td>
    <td class="negrita" style="font-weight:bold; background-color:#EFEFEF;"><?php echo $res["total"]; ?></td>
    </tr>
  </tfoot>
</table>

</td>
</tr>
<tr>
<td>
<table width="100%" border="0">
<tr>

<td>

<p  style="margin:auto 0; text-align:left; font-size:9px;">Moneda:<?php echo $res["moneda"]; ?></p>
</td>
<td><p  style="margin:auto 0; text-align:left; font-size:9px">Valor Cambio:<?php echo $res["cambio"]; ?></p></td>

</tr>

</table>
</td>
</tr>
</table>










 </div><?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/imprimir.png" alt="imprimir">Imprimir</a> </p>
     <?php } ?>

     
      <p><a href="<?php config::ruta();?>?accion=notasIngreso">Volver </a></p>
      <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script>
</body>
