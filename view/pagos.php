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


            <h2 id="contact">VENTAS > PAGOS</h2>
            <div  style=" ">
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
<input  id="bconsultar" type="submit"  value="Consultar" /><td>
</tr>
</table>
<input type="hidden"  name="bEnviar" value="bEnviar" />
</form>

<form  style="float:right" action="<?php echo config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="listaVentas"  />

</form>
</div>

          <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>
					<th class="">Acciones</th>
					<th class="">Num <br />Pago</th>
                    <th class="">Num Venta</th>
                    <th class="">Cliente</th>
                    <th class="">Num Cuota</th>
                    <th class="">Monto</th>
                    <th class="">Moneda</th>
                    <th class="">Fecha Pago</th>
                    <th class="">Factura</th>
                    <th class="">Recibo</th>
                    <th class="">Tipo Pago</th>
                    <th class="">Cuenta Banco</th>
				</tr>
				</thead>
                <tbody>
                <?php

				foreach($res as $v){
				?><tr>


					<td>


			   <?php if ($v["terminado"]==1 && $v["referencia"]=="deuda"){?>

					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagoDeuda&e=borrar&id=<?php echo $v["idpagoVentasCredito"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>

                    <?php if(isset($_SESSION["modulo_administracion"])){ ?>
				 <a  href="<?php echo config::ruta();?>?accion=editPagoDeudaAdmin&id=<?php echo $v["idpagoVentasCredito"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Pago Pago " /></a>
					<?php }?>

					<?php }?>

                     <?php if ($v["terminado"]==1 && $v["referencia"]=="credito"){?>

					<a href="#" title="Borrar"  onclick="eliminar('<?php echo config::ruta();?>?accion=addPagocuota&e=borrar&id=<?php echo $v["idpagoVentasCredito"];?>');"><img src="<?php echo config::ruta();?>images/eliminar.png" width="25" height="25"/></a>
					<?php }?>

                    <?php if ($v["terminado"]==0 && $v["referencia"]=="deuda"){?>
						 <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarPago('<?php echo config::ruta();?>?accion=addPagoDeuda&id=<?php echo $v["idpagoVentasCredito"];?>&e=confirmar');"  width="35" height="35" alt="Enviar Nota" title="Enviar Pago" /></a>

                  <a  href="<?php echo config::ruta();?>?accion=addPagoDeuda&e=editar&id=<?php echo $v["idpagoVentasCredito"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Pago Pago " /></a>



					  <?php }?>



                      <?php if ($v["terminado"]==0 && $v["referencia"]=="credito"){?>
						 <a href="#"><img src="<?php echo config::ruta();?>images/aceptar.png" onclick="enviarPago('<?php echo config::ruta();?>?accion=addPagocuota&id=<?php echo $v["idpagoVentasCredito"];?>&e=confirmar');"  width="35" height="35" alt="Enviar Nota" title="Enviar Pago" /></a>

                  <a  href="<?php echo config::ruta();?>?accion=addPagocuota&e=editar&id=<?php echo $v["idpagoVentasCredito"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Pago  " /></a>
					  <?php }?>
					<?php if(isset($_SESSION["modulo_administracion"])&&$v["terminado"]==1 && $v["referencia"]=="credito"){ ?>
				 <a  href="<?php echo config::ruta();?>?accion=editPagoAdmin&id=<?php echo $v["idpagoVentasCredito"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Pago Pago " /></a>
					<?php }?>
                    </td>

                    <td align="center"><?php echo $v["idpagoVentasCredito"];?></td>
                    <td align="center"><?php echo Helpers::rellenarCeros($v["idventas"],6);?></td>
                    <td width="280"><a  title="VER DEUDAS" href="<?php config::ruta()?>?accion=addPagos&id=<?php echo $v["idcliente"];?>"><?php echo $v["cliente"];?></a></td>
                    <td align="center"><?php echo $v["numcuota"];?></td>
                    <td align="right"><?php echo sprintf("%01.2f",$v["monto"]);?></td>
                    <td align="center"><?php echo $v["moneda"];?></td>
                    <td align="center"><?php echo date("d/m/Y",strtotime($v["fecha"]));?></td>
                    <td align="center"><?php echo $v["numfactura"];?></td>
                    <td align="center"><?php echo $v["numrecibo"];?></td>
                    <td align="center"><?php echo $v["tipopago"];?></td>
                    <td align="center"><?php echo $v["cuentabanco"];?></td>








				</tr><?php
				}
				?>
                </tbody>


				</table>
            <div>

            </div>

            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->

            </div> <!-- END #contact_info -->

          </div> <!-- END .container -->

        </div> <!-- END #contact_area -->

    </div>
<?php require_once("footer.php");?>
