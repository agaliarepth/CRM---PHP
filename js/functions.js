// JavaScript Document

var formatNumber = {
separador: ".", // separador para los miles
sepDecimal: ',', // separador para los decimales
formatear:function (num){
num +='';
var splitStr = num.split('.');
var splitLeft = splitStr[0];
var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
var regx = /(\d+)(\d{3})/;
while (regx.test(splitLeft)) {
splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
}
return this.simbol + splitLeft  +splitRight;
},
new:function(num, simbol){
this.simbol = simbol ||'';
return this.formatear(num);
}
}
 
function eliminar(ruta){
	
	if(confirm("Realmente desea Eliminar este Registro..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarAlmacen(ruta){
	
	if(confirm("Se enviara La nota  de Devolucion de Obra al Almacen. Desea continuar la Operacion..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarVentaCredito(ruta){
	
	if(confirm(" Se registrara la venta de credito en el sistema desea Continuar??")){
		window.location=ruta;
		
		}
	
	}
	
	function devolver(ruta){
	
	if(confirm("Se actualizara el inventario con las cantidades de la Nota desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function rechazarDevolucion(ruta){
	
	if(confirm("La nota de Ingreso sera Rechazada. Desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	function enviarIngreso(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Ingreso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarDevolucion(ruta){
	
	if(confirm("SE HARA EFECTIVA  DEVOLUCION DESEA CONTINUAR ..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarCompra(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Compra desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	
	
	
	function enviarDevolucion(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Devolucion desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	
	function enviarTraspaso(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Traspaso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function aprobarDevolucionObra(ruta){
	
	if(confirm("SE hara Efectivo LA Nota de Devolucion en El kardex Del Vendedor desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}

	function aprobarDevolucionIngreso(ruta){
	
	if(confirm("SE hara Efectivo La Nota de Ingreso en El Almacen  desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}	
	function crearCuenta(ruta,num,cod){
	
	if(confirm("Se Creara Una Cuenta Para el contrato::"+num+" con Cod Cliente::"+cod+" Desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function rechazarDevolucionObra(ruta){
	
	if(confirm("Se anula el proceso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	function enviarContrato(ruta){
	
	if(confirm("Se Registrara El Contrato como Diferido.. desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarPago(ruta){
	
	if(confirm("Se Registrara El Pago  ..Desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function enviarEgreso(ruta){
	
	if(confirm("Se hara Efectiva la Nota de Egreso desea Continuar..?")){
		window.location=ruta;
		
		}
	
	}
	
	function imprimir(ruta){
	
	open(ruta,'','top=10,left=290,scrollbars=yes,width=720,height=650') ; 
		
	
	
	}
		function addRemision(ruta){
	
	open(ruta,'','top=50,left=100,scrollbars=yes,width=850,height=550,menubar=si') ; 
		
	
	
	}
	function tipoCambio(ruta){
	
	open(ruta,'','top=180,left=400,width=400,height=250,menubar=no') ; 
		
	
	
	}
	function popup(ruta,alto,ancho){
	
	
	open(ruta,'',"top=50,scrollbars=yes,left=300,width=800,height=500") ; 
		
	
	
	}
	
	function limpiar(){
		
		document.form.reset();
		
		}
		
			function cancelar(ruta){
		
		if(confirm("Desea cancelar la operacion Actual..?")){
		window.location=ruta;
		
		}
		
		}
		
		 
  /*  $(function() { 
	var emailreg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
	$(".bEnviar").click(function(){  
		$(".error").fadeOut().remove();
		
        if ($(".codigo").val() == "") {  
			$(".codigo").focus().after('<span class="error">Ingrese su codigo</span>');
			return false;  
		}  
		
		
        if ($(".email").val() == "" || !emailreg.test($(".email").val())) {
			$(".email").focus().after('<span class="error">Ingrese un email correcto</span>');  
			return false;  
		}  
        if ($(".asunto").val() == "") {  
			$(".asunto").focus().after('<span class="error">Ingrese un asunto</span>');  
			return false;  
		}  
        if ($(".mensaje").val() == "") {  
			$(".mensaje").focus().after('<span class="error">Ingrese un mensaje</span>');   
			return false;  
		}  
    });  
	$(".nombre, .asunto, .mensaje").bind('blur keyup', function(){  
        if ($(this).val() != "") {  			
			$('.error').fadeOut();
			return false;  
		}  
	});	
	$(".email").bind('blur keyup', function(){  
        if ($(".email").val() != "" && emailreg.test($(".email").val())) {	
			$('.error').fadeOut();  
			return false;  
		}  
	});
});
 */