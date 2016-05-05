<?php require_once("config.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>VISUAL::<?php echo ABREV?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo config::ruta();?>css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo config::ruta();?>css/main.css" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/jquery-ui.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/jquery.dataTables.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet"  href="<?php echo config::ruta();?>css/default1.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php echo config::ruta();?>css/validationEngine.jquery.css" type="text/css"/>




<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/zebra_datepicker.js"></script>
<script src="<?php echo config::ruta();?>js/jquery-u-min.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/dataTableFilter.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php echo config::ruta();?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo config::ruta();?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

 <script>


              $(document).ready(function() {

				   $('#fecha').Zebra_DatePicker({
		  view: 'days',
		  days_abbr:['Dom', 'Lu', 'Mar', 'Mi', 'Jue', 'Vie', 'Sab'],
		   format: 'd-m-Y'

		 });

		   $('#fecha2').Zebra_DatePicker({
		  view: 'days',
		  days_abbr:['Dom', 'Lu', 'Mar', 'Mi', 'Jue', 'Vie', 'Sab'],
		     format: 'd-m-Y'
		 });
    $('#categorias-table').dataTable( {


        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"

        },


        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
		"aaSorting": [ [1,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"

    } );


/*$('#ventas-table').dataTable({
		"aoColumns": [
			{ "sWidth": "200px" },
			null,
			null
		]
	} )
		  .columnFilter({ sPlaceHolder: "head:before",
			aoColumns: [ { type: "text" },
				     { type: "date-range" },
                                     { type: "date-range"  }
				]

		});*/

	$('#ventas-table').dataTable( {



        "bLengthChange": true,

        "bSort": true,
		"aaSorting": [ [0,'desc'] ],
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers",
		 "sDom": '<"top"if>rt<"bottom"lp><"clear">'

    } );
	/*.columnFilter({
	                sPlaceHolder: "head:after",
					aoColumns: [
					           null,
							   { type:  "text"},
							   { type: "select", values: [ 'Power on Server']  },
                               { type: "select", values: [ 'Complete','Failed','Incomplete'] },
                               { type:  "text"},{ type: "text" },{ type: "text" }
                               ]

                        });*/




	$('#categorias-table2').dataTable( {
        "bPaginate": true,
		"oLanguage": {
            "sLengthMenu": "<B>Mostrando _MENU_ registros  por pagina</B>",
            "sZeroRecords": "Ningun Registro Encontrado",
            "sInfo": "Mostrar _START_ a _END_ de _TOTAL_ Registros",
            "sInfoEmpty": "<B>Mostrando 0 a 0 de 0 Registros</B>",
            "sInfoFiltered": "(Filtrados _MAX_  de un total de Registros)",
			 "sSearch": "<B>BUSCAR:</B>"

        },

        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
		 "iDisplayLength": 300,
		"aLengthMenu": [[25,50,100,200,500,1000,-1], [25, 50, 100,200,500,1000, "Todos"]],
		"sPaginationType": "full_numbers"

    } );

} );
		</script>

</head>
<body>

    <div id="header">

        <div class="container">

        <h1><a href="#">Inicio</a></h1>
        <h2 style="font-size:20px; font-stretch:expanded;font-weight:bold; margin:auto; margin-bottom:-10px; color:#FF3; background-color:#047EC8; width:100%;text-align:center;  ">SUCURSAL - <?php echo SUCURSAL?></h2>

        <div id="main_menu">

            <ul>
            <li class="first_list with_dropdown"><a href="<?php echo config::ruta();?>?accion=home" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/home.png"/> INICIO</a>
             <ul>
                        <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=editUser" class="main_menu_second"> <img  src="<?php echo config::ruta();?>images/user.png" />CAMBIAR MIS DATOS</a></li></ul>

            </li>




              <?php if(isset($_SESSION["modulo_catalogo"])){?>

                <li class="first_list with_dropdown">
                    <a href="#"  class="main_menu_first"><img  src="<?php echo config::ruta();?>images/libros.png" /> CATALOGO</a>
                    <ul>
                        <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=libros" class="main_menu_second"> <img  src="<?php echo config::ruta();?>images/libros.png" /> LIBROS</a></li>
                        <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=addlibros" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/add.png" /> REGISTRAR LIBROS</a></li>
                        <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=categorias" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/CATEGORY.png" /> CATEGORIAS </a></li>
                         <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=addcategorias" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/add.png" /> REGISTRAR CATEGORIAS </a></li>

                    </ul>
                </li>

                <?php }?>



                <?php if(isset($_SESSION["modulo_clientes"])||isset($_SESSION["modulo_proveedores"])){?>

                <li class="first_list with_dropdown">
                    <a  style="font-size:9PX;"href="<?php echo config::ruta();?>?accion=proveedores" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/truck.png" /> PROVEEDORES / CLIENTES</a>
                    <ul> <?php if(isset($_SESSION["modulo_proveedores"])){?>
                         <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=proveedores" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/listar.png" /> LISTAR PROVEEDORES</a></li>
                        <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=addProveedores" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/truckplus.png" /> REGISTRAR PROVEEDORES </a></li> <?php }?>

                    <?php if(isset($_SESSION["modulo_clientes"])){?>
                    <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=clientes" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/listar.png" /> LISTAR CLIENTES </a></li>
                          <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=addClientes" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/addcliente.png" /> REGISTRAR CLIENTES </a></li>


                          <?php }?>
                          </ul>
                </li>

                <?php }?>




                <?php if(isset($_SESSION["modulo_compras"])){?>
                <!--<li class="first_list with_dropdown">
                    <a href="<?php echo config::ruta();?>?accion=compras" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/dinero.png" />COMPRAS</a>
                    <ul>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=addCompras" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/compras.gif" /> REGISTRAR COMPRA </a></li>

                      <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=kardexProveedor" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/kardexpro.png"  width="20" height="20"/> KARDEX PROVEEDORES </a></li>
                      <li class="second_list second_list_border"><a href="#" onclick="tipoCambio('<?php echo config::ruta();?>?accion=tipoCambio');" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/cambio.png" />   TIPO DE CAMBIO </a></li>


                    </ul>
                </li>-->
                <?php }?>



                <?php if(isset($_SESSION["modulo_ventas"])){?>
                 <li class="first_list with_dropdown">
                    <a href="<?php echo config::ruta();?>?accion=ventasCredito" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/store.png" />VENTAS</a>
                    <ul>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=ventasCredito" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/compras.gif" /> VENTAS </a></li>

                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=librosVentas" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/compras.gif" /> LIBROS </a></li>

                          <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=devoluciones" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/compras.gif" /> DEVOLUCIONES</a></li>

                       <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=kardexCliente" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/compras.gif" /> KARDEX CLIENTE </a></li>

                      <li class="second_list second_list_border"><a href="#" onclick="tipoCambio('<?php echo config::ruta();?>?accion=tipoCambio');" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/cambio.png" />   TIPO DE CAMBIO </a></li>



                    </ul>
                </li>
                <?php }?>

                 <?php if(isset($_SESSION["modulo_cobranzas"])){?>
                 <li class="first_list with_dropdown">
                    <a href="<?php echo config::ruta();?>?accion=pagos" class="main_menu_first"><img   width="20" height="20"src="<?php echo config::ruta();?>images/currency.png" />COBRANZAS</a>
                    <ul>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=addPagos" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/moneys.png" /> REGISTRAR PAGOS</a></li>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=pagos" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/moneys.png" /> LISTAR PAGOS </a></li>




                    </ul>
                </li>
                <?php }?>


                <?php if(isset($_SESSION["modulo_almacenes"])){?>
                <li class="first_list with_dropdown">
                    <a href="#" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/almacen.png" /> ALMACEN</a>
                    <ul>
                     <li   class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=notasIngreso" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/ni.png" width="20" height="20" /> NOTAS DE INGRESO </a></li>
                      <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=notasEgreso" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/ne.png"  width="20" height="20"/> NOTAS DE EGRESO </a></li>
                       <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=pendientes" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/inventario.png" width="20" height="20"/> ENTREGAS PENDIENTES </a></li>


                       <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=inventario" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/download.png" width="20" height="20"/> INVENTARIO </a></li>
                        <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=kardexMayor" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/download.png" width="20" height="20"/> 	KARDEX MAYOR </a></li>
                         <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=relacionNotas" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/download.png" width="20" height="20"/> 	RELACION DE  NOTAS </a></li>




                    </ul>
                </li>
                <?php }?>


                <?php if(isset($_SESSION["modulo_administracion"])){?>
                <li class="first_list with_dropdown">
                    <a href="<?php echo config::ruta();?>?accion=compras" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/ADMIN.png" />ADMIN</a>
                    <ul>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=roles" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/perfiles.png" /> ROLES DE USUARIO</a></li>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=usuarios" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/user.png" /> USUARIOS </a></li>

                      <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=vendedores" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/user.png" /> VENDEDORES </a></li>
                     <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=deudas" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/dinero.png" /> DEUDAS POR COBRAR </a></li>
                       <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=devolucionDinero" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/dinero.png" /> DEVOLUCION DINERO</a></li>
                      <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=editarVenta" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/dinero.png" /> EDITAR VENTAS </a></li>

                      <li class="second_list second_list_border"><a href="#" onclick="tipoCambio('<?php echo config::ruta();?>?accion=tipoCambio');" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/cambio.png" />   TIPO DE CAMBIO </a></li>


                    </ul>
                </li>



                <?php }?>

                 <?php if(isset($_SESSION["modulo_reportes"])){?>
                 <li class="first_list with_dropdown">
                    <a href="#"  class="main_menu_first"><img  src="<?php echo config::ruta();?>images/reports.png" /> REPORTES</a>
                    <ul>
                      <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=registroVentas" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/reporte1.png" /> REGISTRO DE VENTAS</a></li>

                      <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=obrasVendidas" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/reporte1.png" /> RELACION DE OBRAS VENDIDAS </a></li>
                          <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=produccionVentas" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/reporte1.png" /> CUADRO DE PRODUCCION </a></li>
                            <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=comisiones" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/reporte1.png" /> COMISIONES DE COBRANZA</a></li>

                             <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=cuentasCobrar" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/reporte1.png" / > CUENTAS POR COBRAR</a></li>
                                <li class="second_list second_list_border"><a href="<?php echo config::ruta();?>?accion=saldoClientes" class="main_menu_second"><img  src="<?php echo config::ruta();?>images/reporte1.png" / > SALDO CLIENTES</a></li>



                    </ul>
                </li>
                   <?php }?>
                <li class="first_list"><a href="<?php echo config::ruta();?>?accion=logout" class="main_menu_first"><img  src="<?php echo config::ruta();?>images/salir.png"/> SALIR</a></li>
            </ul>

        </div> <!-- END #main_menu -->

        </div> <!-- END .container -->

    </div> <!-- END #header -->
