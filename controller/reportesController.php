<?php 
if(isset($_POST["tipo"])){
	
	switch($_POST["tipo"]){
		
		   case "listaVentas":{require_once("view/reportes/reporteListaVentas.php"); break;}
		   case "relacionNotasIngreso":{require_once("view/reportes/relacionNotasIngreso.php"); break;}
		   case "relacionNotasEgreso":{require_once("view/reportes/relacionNotasEgreso.php"); break;}
		   case "verNotaIngreso":{require_once("view/reportes/verNotaIngreso.php"); break;}
	       case "verNotaEgreso":{require_once("view/reportes/verNotaEgreso.php"); break;}
	       case "cuadroProduccion":{require_once("view/reportes/cuadroProduccion.php"); break;}
		   case "obrasVendidas":{require_once("view/reportes/obrasVendidas.php"); break;}
  		   case "obrasVendidas2":{require_once("view/reportes/obrasVendidas2.php"); break;}
		   case "kardexCliente":{require_once("view/reportes/kardexCliente.php"); break;}
           case "registroVentas":{require_once("view/reportes/registroVentas.php"); break;}
		    case "cuentasCobrar":{require_once("view/reportes/cuentasCobrar.php"); break;}
			case "comisiones":{ require_once("view/reportes/comisiones.php"); break;}
			case "kardexMayor":{ require_once("view/reportes/kardexMayor.php"); break;}
			case "cuadroProduccion2":{ require_once("view/reportes/cuadroProduccion2.php"); break;}
			case "saldoClientes":{ require_once("view/reportes/saldoClientes.php"); break;}
			case "listaLibros":{ require_once("view/reportes/listaLibros.php"); break;}







		
		}
	
	}




?>