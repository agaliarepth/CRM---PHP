<?php require_once("head.php");?>
 <script type="text/javascript">

 $(document).ready(function() {
    	$('#deudasCompras-table').dataTable( {



        "bLengthChange": true,

        "bSort": true,
		"aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers",
		 "sDom": '<"top"if>rt<"bottom"lp><"clear">'

    } );
});
$(function()
		{
			// configuramos el control para realizar la busqueda de los productos
			$("#cliente").autocomplete({
				source: "ajax/buscarCliente.php", 				/* este es el formulario que realiza la busqueda */
				minLength: 1,									/* le decimos que espere hasta que haya 2 caracteres escritos */
				select: clienteSeleccionado/* esta es la rutina que extrae la informacion del registro seleccionado */

			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a><strong>" + item.nombres + " / " + item.empresa + "</a>" )
    .appendTo( ul );
};
		});


		function clienteSeleccionado(event, ui)
		{

			$( "#cliente" ).val( ui.item.nombres );
			$( "#idcliente" ).val( ui.item.idclientes );

			return false;

		}


</script>
<div id="main_content">

        <div id="contact_area">

            <div class="container">


            <h2 id="contact">COBRANZA >  REGISTRAR PAGOS CLIENTES</h2>
            <div>
            <form class="notas" id="form" name="form" method="post" action="">
            <table>
            <tr>
            <td>
            <label>CLIENTE</label><input  type="text" size="50"  name="cliente" id="cliente"/>
            </td>
            <td>
            <input type="submit"  name="bconsultar" class="consultar" id="bconsultar" value="Consultar Deudas"/>
            <input type="hidden" name="idcliente" id="idcliente" />
            <input type="hidden" name="consultar" id="consultar" value="consultar" />
             </td>
            </tr>
            </table>

            </form>
            <HR />
           <?php if((isset($_POST["consultar"])&& $_POST["consultar"]=="consultar") || (isset($_GET["accion"])&& isset($_GET["id"]))){?>
             <h2 style="text-align:center; margin:auto; text-decoration:underline; font-weight:bold;">DEUDAS PENDIENTES POR COMPRAS</h2>

           <table id="deudasCompras-table" >
           <thead>
           <tr style="">
           <th colspan="9" style="background:#047EC8;color:#FF0">DEUDAS POR COMPRAS : <?php echo utf8_decode($res3["nombres"]." ".$res3["apellidos"]); ?></th>
           </tr>
           <tr>
           <th>NOTA DE VENTA</th>
           <th>FECHA DE COMPRA</th>
           <th style="">MONTO<BR />TOTAL<BR /> COMPRA</th>

           <th>Fecha  Vencimiento</th>
           <th>Numero Pago</th>
           <th>Monto a Pagar</th>
           <th>saldo Actual</th>
          <th>Moneda</th>

           <th>Acciones</th>

           </tr>

           </thead>
           <tbody>
           <?php foreach($res as $r){ ?>

           <tr >
           <td  align="center"><h3><a href="#" onclick="imprimir('<?php echo config::ruta();?>?accion=vernotaVenta&id=<?php echo $r["idventas"];?>');"><?php echo "10-".Helpers::rellenarCeros($r["idventas"],6); ?></a></h3></td>
           <td align="center"><?php echo date("d-m-Y",strtotime($r["fechavencimiento"]));  ?></td>
            <td align="right" style="background-color:#FFC; font-weight:bold;"><?php echo $r["total"]; ?></td>
             <td align="center"><?php echo date("d-m-Y",strtotime($r["fecha"]));  ?></td>

            <td align="center"><?php echo $r["numpago"]; ?></td>
           <td align="right"><?php echo $r["saldo_inicial"]; ?></td>
           <td align="right"><?php echo $r["saldo_actual"]; ?></td>
           <td  align="center"><?php echo $r["moneda"]; ?></td>
           <?php if($r["saldo_actual"]==0){?>
           <td  align="right"style="background-color:#6C9; font-weight:bold"> CANCELADO</td><?php }
		   else{?>
           <td align="LEFT"><a href="<?php echo  config::ruta();?>?accion=addPagoCuota&id=<?php echo $r["idcuotas"];?>">REGISTRAR PAGO</a></td><?php }?>

           </tr>
           <?php }?>

           </tbody>
           </table>

  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <h2 style="text-align:center; margin:auto; text-decoration:underline; font-weight:bold;">OTRAS DEUDAS PENDIENTES</h2>

   <table id="categorias-table2" >
           <thead>
           <tr>
            <th colspan="9" style="background:#047EC8;color:#FF0">DEUDAS ANTERIORES : <?php echo utf8_decode($res3["nombres"]." ".$res3["apellidos"]); ?></th>
           </tr>
           <tr>
           <th width="150">Descripcion deuda</th>
           <th>Fecha  Compra</th>
           <th>Fecha  Vencimiento</th>
           <th>Dias Credito</th>
           <th>Num Pago</th>
           <th>Monto de la deuda</th>
           <th>Saldo Actual</th>
           <th>Moneda</th>
            <th>Acciones</th>

           </tr>

           </thead>
           <tbody>
           <?php foreach($res2 as $v){ ?>

           <tr>
           <td align="center"><?php echo $v["descripcion"]; ?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($v["fecha"]));  ?></td>
            <td align="center"><?php echo date("d-m-Y",strtotime($v["fechavencimiento"]));  ?></td>
           <td align="center"><?php echo $v["dias_credito"]; ?></td>
           <td align="center"><?php echo $v["numcuotas"]; ?></td>
           <td align="right"><?php echo $v["saldo_inicial"]; ?></td>
           <td align="right"><?php echo $v["saldo_actual"]; ?></td>
           <td><?php echo $v["moneda"]; ?></td>

           <?php if($v["saldo_actual"]==0){?>
           <td  align="right"style="background-color:#6C9; font-weight:bold" > CANCELADO</td><?php }
		   else{?>
           <td><a href="<?php echo  config::ruta();?>?accion=addPagoDeuda&id=<?php echo $v["iddeudas"];?>">REGISTRAR PAGO</a></td><?php }?>

           </tr>
           <?php }?>

           </tbody>
           </table>
           <?php }?>

            </div>

            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->

            </div> <!-- END #contact_info -->

            </div> <!-- END .container -->

        </div> <!-- END #contact_area -->

    </div>
<?php require_once("footer.php");?>
