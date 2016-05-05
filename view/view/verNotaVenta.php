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
 
 <div ><?php if(isset($_GET["id"])){?>
     <p><a href="javascript:void(0)" id="imprime"><img src="<?php config::ruta();?>images/imprimir.png"  width="35" height="35"alt="imprimir">Imprimir</a> </p>
     <?php } ?>

     
      
 <script type="text/javascript">
$("#imprime").click(function (){
$("div#myPrintArea").printArea();
})
</script></div>
 <div id="myPrintArea"  style="width:600px; margin:auto 10px; border:hidden;">
<table id="exportar" border="0" style="font-family:calibri; font-size:10px; border:hidden;">
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
    <td colspan="4" align="center" ><span style="font-size:18px; font-family:calibri; font-weight:bold; text-decoration:underline;  margin-left:130px;"> NOTA DE VENTA</span></p></td>
    <td width="76"  ></td>
    <td align="center" width="100"  style=" border:groove;"><span   style="font-size:18px; font-weight:bold;">N&ordm;: <?php echo Helpers::rellenarCeros($res["idventas"],6); ?></span></td>
  </tr>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:hidden; font-size:10px; font-family:calibri; font-style:normal;" >
  <tr>
    <td   colspan="2"width="55%" style="font-weight:bolder; font-size:11px; text-decoration:!important; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif;;font-style:italic;"><strong>CLIENTE : <?php echo utf8_decode($res["nombre"]); ?></strong></td>
    <td  width="25%"    style="font-weight:bolder; font-size:11px; text-decoration:!important; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif;">NIT/CI : <?php echo $res["nit"]; ?></td>
   <!-- <td width="150"  class="negrita">TELF: <?php echo $res["telf"]; ?></td>-->
    <td width="25%"  align="left"  colspan="2" style="font-weight:bolder; font-size:12px; text-decoration:!important; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>FECHA : <?php echo date("d-m-Y",strtotime($res["fecha"])); ?></strong></td>
    <!--<td width="150"   colspan="2"class="negrita">CIUDAD: <?php echo $res["ciudad"]; ?></td>-->
    
    </tr>
    <tr>
    <td class="negrita"  width="50%"colspan="2">DIR :  <?php echo utf8_decode($cliente->getDireccion($res["clientes_idclientes"]));?></td>
    <td  class="negrita">TELEFONO: <?php echo $res["telf"];?></td>
     <td  align="left" colspan="2"  class="negrita">DESTINO: <?php echo $res["destino"]; ?></td>
    
    </tr>
  <tr>
    <td width="170" class="negrita">TIPO DE VENTA : <?php echo $res["tipoventa"];?></td>
    <td colspan="5" class="negrita"><?php if($res["tipoventa"]=="CREDITO"){?>CONDICIONES PAGO : <?php if($res3["dias"]>0) { echo $res3["dias"]." DIAS DE GRACIA ";} echo $res3["diaspago"];?> DIAS DE PAGO<?php }if($res["tipoventa"]=="CONTADO"){?>RI: <?php  echo $res4["numingreso"]." F:".$res4["numfactura"];}?>
    </td>
    </tr>
    
	
	
</table>
</td>
</tr>
<tr>
<td>
<table width="650" border="1" style="font-family:calibri; font-size:10px;" cellspacing="0" >
<thead>
  <tr>
  
   
    <td style="font-weight:bold; background-color:#EFEFEF;"align="center" width="35" class="negrita">CODIGO</td>
    
    <td align="center" width="347" class="negrita">DESCRIPCION</td>
    
    <td align="center" width="25" class="negrita">VOL</td><td align="center" width="47" class="negrita">CANTIDAD</td>
    <td width="56" align="center" class="negrita">P.UNITARIO</td>
    <td width="61" align="center" class="negrita">P.TOTAL</td>
     
    
  </tr>
  </thead>
  <tbody>
  <?php $cont =1; foreach($res2 as $v){ ?>
  <tr >
  
    <td  align="center"style="font-weight:bold; background-color:#EFEFEF;"><?php echo $v["codigo"];?></td>
    <td><?php echo  utf8_decode($v["titulo"]);?></td>
    <td align="center"><?php echo Helpers::ceros( $v["volumen"],2);?></td>
    <td align="center"><?php echo $v["cantidad"];?></td>
    <td align="right"><?php echo number_format($v["precio_unit"], 2, ',', '.');?></td>
    <td align="right"><?php echo number_format($v["precio_total"], 2, ',', '.');?></td>
   
     
  </tr>
  <?php $cont++;}?>
  </tbody>
  
  <tfoot  >
 
  <tr>
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="right"  colspan="3" class="negrita">TOTAL : </td>
    <td align="CENTER"> <b><?php echo number_format($res["cantidad"], 0, ',', '.'); ?></b></td>
    <td align="right">&nbsp;</td>
    <td   align="right" style="font-weight:bold; background-color:#EFEFEF;" class="negrita"><?php echo number_format($res["total"], 2, ',', '.'); ?></td>
    
    </tr>
    
		
		
		 <?php if($res["tipoventa"]=="CREDITO" & $res3["adelanto"]>0){?>
    <tr  align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="right"  colspan="5" class="negrita"><span style="background-color: #EFEFEF">A CUENTA :</span></td>
    <td   align="right" style="font-weight:bold; background-color:#EFEFEF;" class="negrita"><?php echo number_format($res3["adelanto"], 2, ',', '.'); ?></td>
    
    </tr>
    <?php }?>
   
    <!--<tr align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="right"  colspan="5" class="negrita"><span style="background-color: #EFEFEF">Total Cancelar:</span></td>
    <td   align="right" style="font-weight:bold; background-color:#EFEFEF;" class="negrita"><?php echo number_format(($res["total"]-$res["monto_descuento"]), 2, ',', '.'); ?></td>
    
    </tr>-->
    <?php if($res["tipoventa"]=="CONTADO" ){?>
	 
	 
	  <tr  align="center">
    <td  style="font-weight:bold; background-color:#EFEFEF;"align="right"  colspan="5" class="negrita"><span style="background-color: #EFEFEF">CANCELADO :</span></td>
    <td   align="right" style="font-weight:bold; background-color:#EFEFEF;" class="negrita"><?php echo number_format($res4["monto"], 2, ',', '.'); ?></td>
    
    </tr>
	 
	 
	 
	 
	 <?php }?>
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
<td width="150"><p  style="margin:auto 0; text-align:left; font-size:9px">Valor Cambio:<?php echo $res["cambio"]; ?></p></td>

</tr>
<?php
 if($res["tipoventa"]=="CREDITO"){
	 if($res3["adelanto"]>0){
		 $literal=new EnLetras();
	 ?>
<tr>
<td class="negrita" style="font-size:10px;" colspan="2">
Monto cancelado : <?php echo strtoupper($literal->ValorEnLetras($res3["adelanto"],$res["moneda"]));?>
	

</td>
</tr>
<tr>
	<?php  }
	}?>
    <?php if($res["tipoventa"]=="CONTADO"){
	 if($res4["monto"]>0){
		 $literal=new EnLetras();
	 ?>
<tr>
<td class="negrita" style="font-size:10px;" colspan="2">
Monto cancelado : <?php echo strtoupper($literal->ValorEnLetras($res4["monto"],$res["moneda"]));?>
	

</td>
</tr>
<tr>
	<?php  }
	}?>
<td>
<div style=" width:260px; float:right;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;margin-left:15px; ">----------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">VENDEDOR</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;"><?php echo $res["vendedor"]; ?></p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center; font-size:10px;">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;">&nbsp;</p>
</div>
</td>
<td colspan="3" align="center">
<div style=" width:260px; float:left;">
<p  style="margin:auto 0; text-align:left;margin-left:15px; ">&nbsp;</p>
<p  style="margin:auto 0; text-align:center;margin-left:15px; "> --------------------------------------</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;">CLIENTE CI:</p>
<p  style="margin:auto 0; text-align:center
;  font-size:10px;"><?php echo $res["nombre"]; ?></p>
</div>

</td>
</tr>

<TR style="font-size:9px">
<TD colspan="4"></TD>

</TR>
<tr style="font-size:8px;">
<td colspan="1" width="50%" >
    <strong>MEDIO DE TRANSPORTE PARA EL DESPACHO: </strong> <?php echo $res["transporte"];?>
    </td>
    <td  align="right"colspan="2" style="font-size:7px; font-weight:bold; font-style:italic;">LA MERCADERIA VIAJA POR CUENTA Y RIESGO DEL CLIENTE</td>

</tr>
<tr>
<td colspan="2"  align="right" style="font-size:7px; font-weight:bold; font-style:italic;"></td>
</tr>

</table>
</td>
</tr>
</table>










 </div>
 
</body>
