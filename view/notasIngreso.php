<?php require_once("head.php");?>
<script language="javascript">
$(document).ready(function() {

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


            <h2 id="contact">ALMACEN > NOTAS DE INGRESO</h2>
            <div>


 <form  style="float:right" action="<?php echo config::ruta();?>?accion=reportes" method="post" target="_blank" id="FormularioExportacion">
<p><a href="###">  <img  width="30" height="30"src="<?php config::ruta();?>images/excel.jpg" class="botonExcel" /></a><b>Exportar a Excel</b></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar"   />
<input type="hidden" id="tipo" name="tipo"  value="listaVentas"  />

</form>
             <div  style=" background-color:#FBFACE;margin-bottom:20px;">
             <a  href="<?php echo config::ruta();?>?accion=addIngreso" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/> NUEVA NOTA DE INGRESO </a>

</div>
<form method="post" action="" style="width:65%;display:table">
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
<input type="text" class="fechas" id="fecha" name="fechainicio" value="<?php echo date("d-m-Y")?>">


</th>
<th id="filtroFechaFin" style="display:none" >
<label for="fechafin"  >FECHA FIN</label>
<input type="text" class="fechas" id="fecha2" name="fechafin" value="<?php echo date("d-m-Y")?>">
</th>


<th id="filtroFechaAcumulado"  style="display:none">

 <label for="fechaacumulado">TODOS HASTA:</label>
<input type="text" class="fechas" id="fecha3" name="fechaacumulado" value="<?php echo date("d-m-Y")?>">


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
<input  id="bconsultar" type="submit"  value="Consultar" />  <td>
  </tr>
  </table>
  <input type="hidden"  name="contratos" value="contratos" />
  </form>
           <table border="0" width="100%" cellpadding="0" cellspacing="0" id="categorias-table">
                <thead>
				<tr>


                    <th class="">Acciones </th>
                    <th class="">Nº Ingreso </th>

                    <th class="">Fecha</th>
                    <th class="">Envia</th>
                    <th class="">Recibe</th>
                   <th class="">Concepto</th>
                      <th class="">Estado</th>
                   <th class="">Borrar</th>



				</tr>
				</thead>
                <tbody>
                <?php
				$cont=1;
				foreach($res as $v){
				?><tr>
                <td>  <?php if($v["estado"]=="Sin Enviar"){ ?>


<a href="#"><img src="<?php echo config::ruta();?>images/download.png" onclick="enviarIngreso('<?php echo config::ruta();?>?accion=addIngreso&id=<?php echo $v["idingreso"];?>&e=n');"  width="35" height="35" alt="Enviar Nota" title="Enviar Nota" /></a>





                  <?php }?>

                  <?php if($v["terminado"]==0 && $v["estado"]=="Sin Enviar"){?>
                  <a  href="<?php echo config::ruta();?>?accion=addIngreso&e=ei&id=<?php echo $v["idingreso"];?>"><img src="<?php echo config::ruta();?>images/editar.png" width="25" height="25"  alt="editar" title="Editar Nota" /></a><?php }?>

                  <img src="<?php echo config::ruta();?>images/imprimir.png" width="35" height="35" onclick="imprimir('<?php echo config::ruta();?>?accion=verIngreso&id=<?php echo $v["idingreso"];?>');"/></a>
                  </td>


					<td align="center"><?php echo $v["idingreso"];?></td>

                     <td align="center"><?php echo date("d/m/Y",strtotime($v["fecha"]));?></td>
                    <td><?php echo $v["envia"]?></td>
                    <td><?php echo $v["recibe"]?></td>
                    <td align="center"><?php echo $v["concepto"]?></td>

                      <?php if($v["estado"]=="Sin Enviar"){?>
                    <td style="background-color:#EBA0B7;"><?php echo $v["estado"]?></td><?php }?>
                     <?php if($v["estado"]=="Enviado"){?>
                    <td style="background-color:#D0FBCE;"><?php echo $v["estado"]?></td><?php }?>
                     <?php if($v["estado"]=="Procesando"){?>
                    <td style="background-color:#FC6;"><?php echo $v["estado"]?></td><?php }?>
                  <td >

                   <?php if($v["estado"]!="Procesando"){?>
 <img src="<?php echo config::ruta();?>images/eliminar.png" width="35" height="35" onclick="eliminar('<?php echo config::ruta();?>?accion=notasIngreso&e=bi&sw=<?php echo $v["estado"];?>&ii=<?php echo $v["idingreso"];?>');"/></a>


					<?php }?>




                  </td>

				</tr><?php
				}
				?>
                </tbody>
                <tfoot>
				<tr>

                 <th class="">Acciones</th>
                     <th class="">Nº Ingreso </th>
                    <th class="">Fecha</th>
                    <th class="">Envia</th>
                    <th class="">Recibe</th>
                   <th class="">Concepto</th>
                     <th class="">Estado</th>
                   <th class="">Borrar</th>

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
