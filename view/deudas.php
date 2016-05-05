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


            <h2 id="contact">ADMINISTRACION >  DEUDAS POR COBRAR</h2>
            <div  style=" background-color:#FBFACE;margin-bottom:20px;"> <a  href="<?php echo config::ruta();?>?accion=addDeuda" style="font-weight:bold;"><img  src="<?php echo config::ruta();?>/images/adicionar.png" width="35" height="35"/>REGISTRAR   DEUDA CLIENTE </a></div>
            <div>
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
          <td><?php echo date("d/m/Y",strtotime($v["fecha"])); ?></td>
                    <td><?php echo date("d/m/Y",strtotime($v["fechavencimiento"])); ?></td>

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
