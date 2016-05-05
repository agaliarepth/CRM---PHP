<?php require_once("head.php");?>
<script type="text/javascript">


	
	  function eliminarFilaCargo(v){
		  
		
		  $.ajax({
					  
                              type: "POST",
                              url: "ajax/eliminarCargo.php",
                              data: "id="+v,
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  
								  if(parseInt(data)==0){
									  
									   location.reload();
									  }
								
									else  {
										 alert("ERROR....");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
		}

 function eliminarFilaPago(v){
		  
		
		  $.ajax({
					  
                              type: "POST",
                              url: "ajax/eliminarPago.php",
                              data: "id="+v,
                              dataType: "html",
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								  
								  if(parseInt(data)==0){
									  
									   location.reload();
									  }
								
									else  {
										 alert("ERROR....");
										 }
									  n();
									                                                
                                  
                                  
                              }
                  });
		}
</script>
<div id="main_content">
            
        <div id="contact_area">
            
            <div class="container">
            
            
            <h2 id="contact">KARDEX PROVEEDORES</h2>
            <form  method="post" action="" class="notas" id="formKardexProveedor">
            <table width="200" border="0">
  <tr>
    <td><label>Proveedor</label></td>
    <td><label>Año</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><select name="proveedores">
    <?php foreach($proveedores as $pro){?>
    <option value="<?php echo $pro["idproveedores"];?>"><?php echo $pro["nombre"]; ?></option>
    <?php }?>    
    </select></td>
    <td><select name="anio">
    <?php for($i=2014; $i<=2030; $i++){ ?>
    <option value="<?php echo $i;?>"><?php echo $i;?></option>
    <?php }?>
    
    
    </select></td>
    <td><input type="submit"  name="bEnviar" id="bconsultar" value="Consultar"/>
    <input type="hidden" name="consulta"  value="consulta"/></td>
  </tr>
</table>
</form>
<hr />
<?php if(isset($_POST["consulta"])&& $_POST["consulta"]=="consulta"){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="datosProveedor">
  <tr>
    <td><b>EMPRESA:</b> <?php echo $prove["nombre"] ?></td>
    <td><B>CONTACTO: <?php echo $prove["contacto"] ?></B></td>
    <td ><b>DIRECCION:</b> <?php echo $prove["nombre"] ?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b>CIUDAD:</b> <?php echo $prove["ciudad"];?> PAIS:<?php echo $prove["pais"]; ?></td>
    <td><b>TELEFONOS:</b> <?php echo $prove["telf1"]." ".$prove["telf2"]." ".$prove["telf3"]; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b>NIT:</b> <?php echo $prove["rucnit"] ?></td>
    <td><b>EMAIL:</b> <?php echo $prove["email"]; ?></td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1" cellspacing="0"   class="tablaKardexProveedor">
<thead>
  <tr>
    <th >Numero Compra</th>
    <th>FECHA</th>
    <th >FACTURA</th>
    <th >CODIGO</th>
    <th >DESCRIPCION</th>
    <th >CANTIDAD</th>
    <th >PRECIO</th>
    <th >DEBE</th>
    <th >HABER</th>
    <th >SALDO</th>
    <th>Borrar <br />Cargo/Pago</th>
    <th >Adicionar <br />Pago </th>
    <th >Adicionar <br />Cargo</th>
  </tr>
  </thead>
  <tbody>
  <?php $sum1=0; $sum2=0;foreach($com as $r){
	   $det1=$det->getDetalle($r["idcompras"]);
	   foreach($det1 as $r2){
	  ?>
  <tr>
    <td><?php echo $r["idcompras"];?></td>
    <td><?php echo $r["fecha"];?></td>
    <td><?php echo $r2["factura"];?></td>
    <td><?php  $l=$li->getCodigoTitulo($r2["libros_idlibros"]); echo $l["codigo"];?></td>
    <td><?php echo $l["titulo"];?></td>
    <td><?php echo $r2["cantidad"];?></td>
    <td><?php echo $r2["precio_unit"];?></td>
    <td><?php echo $r2["precio_total"];?></td>
    <td>&nbsp;</td>
    <td><?php echo $saldo=$saldo+$r2["precio_total"]; $sum1+=$r2["precio_total"];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <?php } //fin de foreach detalle de compras
    $car=$cargos->getCargos($r["idcompras"]);
  if(count($car)>0){?>
  
   <?php foreach($car as $r3){
	  ?>
  <tr style="background-color:#6CF">
    <td><?php echo $r["idcompras"];?></td>
    <td><?php echo $r3["fecha"];?></td>
    <td><?php echo $r3["numdoc"];?></td>
    <td></td>
    <td><?php echo $r3["descripcion"];?></td>
    <td></td>
    <td></td>
    <td><?php echo $r3["monto"];?></td>
    <td>&nbsp;</td>
    <td><?php echo $saldo=$saldo+$r3["monto"]; $sum1+=$r3["monto"];?></td>
    <td><img src="<?php echo config::ruta();?>images/eliminar.png" onclick="if(confirm('Realmente desea eliminar este Cargo de compra?')){eliminarFilaCargo('<?php echo $r3["idcargosCompras"]?>'); }" width="20" height="20"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <?php } //fin de foreach cargos
  
          } //fin de if si existen cargos
		  $pag=$pagos->getPagos($r["idcompras"]);
		  if(count($pag)>0){
			 foreach($pag as $r4){
	  ?>
  <tr style="background-color:#FC9;">
    <td><?php echo $r["idcompras"];?></td>
    <td><?php echo $r4["fecha"];?></td>
    <td><?php echo $r4["numdoc"];?></td>
    <td></td>
    <td><?php echo $r4["descripcion"];?></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?php echo $r4["monto"];?></td>
    <td><?php echo $saldo=$saldo-$r4["monto"]; $sum2+=$r4["monto"];?></td>
    <td><img src="<?php echo config::ruta();?>images/eliminar.png" onclick="if(confirm('Realmente desea eliminar este Pago a la compra?')){eliminarFilaPago('<?php echo $r4["idpagosCompras"]?>'); }" width="20" height="20"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <?php } //fin de foreach pagos  
			  
			  
			  }// fin de if si existen pagos
  }// fin de foreach genearal?>
  </tbody>
  <tfoot>
  <tr style="background-color:#EAEAEA; font-weight:bold;">
  <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3">TOTALES</td>
   
    <td><?php echo $sum1;?></td>
    <td><?php echo $sum2;?></td>
    <td><?php echo $sum1-$sum2;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  
  </tr>
  </tfoot>
  
</table>





<?php }?>
            <div>
            </div>
            
            <div id="contact_info"><!-- END #contact_info_left --><!-- END #contact_info_right -->
                
            </div> <!-- END #contact_info -->
            
            </div> <!-- END .container -->
            
        </div> <!-- END #contact_area -->
        
    </div>
<?php require_once("footer.php");?>