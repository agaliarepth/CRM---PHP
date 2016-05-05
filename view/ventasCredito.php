<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {
     $(".botonExcel").click(function(event) {
     $("#datos_a_enviar").val( $("<div>").append( $("#ventas-table").eq(0).clone()).html());
     $("#FormularioExportacion").submit();
});
        $("#filtro").change(function(){

             if($(this).val()=="MES"){ $("#filtroAnio").css("display","inline-table");$("#filtroMes").css("display","inline-table");$("#filtroFechaAcumulado").css("display","none");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");}
             if($(this).val()=="RANGO"){$("#filtroAnio").css("display","none");$("#filtroFechaInicio").css("display","inline-table"); $("#filtroFechaAcumulado").css("display","none"); $("#filtroFechaFin").css("display","inline-table"); $("#filtroMes").css("display","none");}
             if($(this).val()=="ACUMULADO"){$("#filtroAnio").css("display","none");$("#filtroFechaAcumulado").css("display","inline-table");$("#filtroFechaInicio").css("display","none"); $("#filtroFechaFin").css("display","none");$("#filtroMes").css("display","none");}


             });
});
</script>
<div id="main_content">

        <div id="contact_area">

            <div class="container">


            <h2 id="contact" style="font-weight:bold">VENTAS > LISTA DE VENTAS</h2>

                        <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addVenta" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR VENTA </a>
<form method="post" action="" style="width:70%">
 <table style="background-color:#E6E6E6;width:100% ">
 <tr>
 <td  WIDTH="">

  </td>
  <th>

  <label for="filtro">FILTRO POR :</label>
  <select name="filtro" id="filtro" class="inp-form">
  <option value="MES">POR MES</option>
  <option value="RANGO">RANGO DE FECHAS</option>
  <option value="ACUMULADO">ACUMULADO </option>

</select>
</th>
<th id="filtroMes">
 <label for="mes">MES</label>

<select name="mes" class="inp-form">
<option value="1" <?php if(date("m")==1) {?> selected="selected"<?php }?>>ENERO</option>
<option value="2"  <?php if(date("m")==2) {?> selected="selected"<?php }?>>FEBRERO</option>
<option value="3" <?php if(date("m")==3) {?> selected="selected"<?php }?>>MARZO</option>
<option value="4" <?php if(date("m")==4) {?> selected="selected"<?php }?>>ABRIL</option>
<option value="5" <?php if(date("m")==5) {?> selected="selected"<?php }?>>MAYO</option>
<option value="6" <?php if(date("m")==6) {?> selected="selected"<?php }?>>JUNIO</option>
<option value="7" <?php if(date("m")==7) {?> selected="selected"<?php }?>>JULIO</option>
<option value="8" <?php if(date("m")==8) {?> selected="selected"<?php }?>>AGOSTO</option>
<option value="9" <?php if(date("m")==9) {?> selected="selected"<?php }?>>SEPTIEMBRE</option>
<option value="10" <?php if(date("m")==10) {?> selected="selected"<?php }?>>OCTUBRE</option>
<option value="11" <?php if(date("m")==11) {?> selected="selected"<?php }?>>NOVIEMBRE</option>
<option value="12" <?php if(date("m")==12) {?> selected="selected"<?php }?>>DICIEMBRE</option>
</select>
</th>



<th id="filtroFechaInicio"  style="display:none">

 <label for="fechainicio">FECHA INICIO</label>
<input type="text" class="fechas" id="fecha" name="fechainicio" value="<?php echo date("Y-m-d")?>">


</th>
<th id="filtroFechaFin" style="display:none" >
<label for="fechafin"  >FECHA FIN</label>
<input type="text" class="fechas" id="fecha2" name="fechafin" value="<?php echo date("Y-m-d")?>">
</th>


<th id="filtroFechaAcumulado"  style="display:none">

 <label for="fechaacumulado">TODOS HASTA:</label>
<input type="text" class="fechas" id="fecha3" name="fechaacumulado" value="<?php echo date("Y-m-d")?>">


</th>
<th id="filtroAnio"><label for="anio">AÑO </label><select name="anio" class="inp2-form">
<option value="2013"   <?php if(date("Y")==2013) {?> selected="selected"<?php }?>>2013</option>
<option value="2014"   <?php if(date("Y")==2014) {?> selected="selected"<?php }?>>2014</option>
<option value="2015"   <?php if(date("Y")==2015) {?> selected="selected"<?php }?>>2015</option>
<option value="2016"   <?php if(date("Y")==2016) {?> selected="selected"<?php }?>>2016</option>
<option value="2017"   <?php if(date("Y")==2017) {?> selected="selected"<?php }?>>2017</option>
<option value="2018"   <?php if(date("Y")==2018) {?> selected="selected"<?php }?>>2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>



</select>

</th>
 <td>
  <input  id="bconsultar" type="submit"  value="Consultar" />
</td>
  <td>
  </tr>
  </table>
  <input type="hidden"  name="contratos" value="contratos" />
  </form>

 <form  style="float:right" action="<?php echo config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><a href="###">  <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></a><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="listaVentas"  />

</form>
</div>
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="ventas-table" >
                <thead>

				<tr>

                    <th class="">Nº Venta</th>
                     <th class="">Fecha</th>
                     <th class="">Vendedor</th>
                    <th class="">Cliente</th>
                     <th class="">Mon<br />eda</th>
                    <th class="">Precio<br />Venta</th>
                    <th class="">Monto <br /> Cancelado</th>
                    <th>Recibo<br />Ingreso</th>
                    <th>Factura</th>
                    <th>Banco</th>
                      <th class="">Destino</th>
                      <th class="">tipo de Venta</th>
                      <th class="">Estado</th>
                 	<th class="">Opciones</th>




				</tr>
				</thead>
                <tbody>
                <?php
				$cont=0;
				foreach($res as $v){
				?><tr>


                    <td align="center"><?php echo  VENTA."-".Helpers::rellenarceros($v["idventas"],6);?></td>
                     <td align="center"><?php echo date("d/m/Y",strtotime($v["fecha"]));?></td>
                     <td align="center"><?php echo $v["vendedor"];?></td>
                    <td><?php  echo $v["nombre"];?></td>
                    <td align="center"><?php echo $v["moneda"];?></td>
                    <td align="right"><?php $cont+=$v["total"];echo number_format($v["total"], 2, ',', '.');?></td>
                    <td align="right"><?php $res3=$cv->getVenta($v["idventas"]);
$res4=$vcon->getVenta($v["idventas"]);

 if($v["tipoventa"]=="CONTADO"){
	 echo $res4["monto"];

	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["adelanto"];

	 }
?>

</td>
<td align="center"><?php
if($v["tipoventa"]=="CONTADO"){
	 echo $res4["numingreso"];

	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["reciboadelanto"];

	 }
?>


</td>

<td align="center"><?php
if($v["tipoventa"]=="CONTADO"){
	 echo $res4["numfactura"];

	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["facturaadelanto"];

	 }

?>


</td>
<td align="center"><?php
if($v["tipoventa"]=="CONTADO"){
	 echo $res4["cuentabanco"];

	 }
	 if($v["tipoventa"]=="CREDITO"){
	 echo $res3["cuentabanco"];

	 }

?>


</td>
                    <td align="center"><?php echo $v["destino"]?></td>
                    <td align="center"><?php echo $v["tipoventa"]?></td>
                    <td  align="center"><?php echo $v["estado"]?></td>

                   <td>
                     <?php if($v["terminado"]==0 ){?>
                  <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarVentaCredito('<?php echo config::ruta();?>?accion=ventasCredito&id=<?php echo $v["idventas"];?>&e=confirmar');"  width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a>

                  <a  href="<?php echo config::ruta();?>?accion=addVenta&e=ev&id=<?php echo $v["idventas"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota Venta" /></a><?php }?>

                  <?php if(isset($_SESSION["modulo_almacenes"])&&$v["terminado"]==1){?>

				  <a  href="<?php echo config::ruta();?>?accion=addVenta&e=evadmin&id=<?php echo $v["idventas"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota Venta" /></a>

				  <?php }?>

                   <a><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25" onclick="eliminar('<?php echo config::ruta();?>?accion=ventasCredito&e=b&id=<?php echo $v["idventas"];?>');"/></a>



                	<?php if($v["terminado"]=="1"){ ?>

                  <a><img src="<?php echo config::ruta();?>images/imprimir.png" width="25" height="25" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $v["idventas"];?>');"/></a>


                  <?php }?>


                  </td>



				</tr><?php
				}
				?>
                </tbody>
                <tfoot>

                <tr>
                  <th ></th>
                   <th ></th>
                    <th ></th>
                     <th ></th>
                  <th  align="right"></th>
                  <th  align="right"></th>
                  <th ></th>
                   <th ></th>
                    <th ></th>
                     <th ></th>
                      <th ></th>
                       <th ></th>
                        <th ></th>

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
