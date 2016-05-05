 <?php if(isset($_SESSION["modulo_catalogo"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php
require_once("model/librosModel.php");
require_once("model/categoriasModel.php");
require_once("model/proveedoresModel.php");



	 $c=new Libros();
	 $cate=new Categorias();
	 $edit=new Proveedores();
	$res= $cate->autocompletar();
	$res2=$edit->autocompletar();
	
	
	if(isset($_GET["id"]) && isset($_GET["e"]) && $_GET["e"]=="el")
{  
$res=$c->getId($_GET["id"]);
$res2= $cate->autocompletar();
	$res3=$edit->autocompletar();
require_once("view/addLibros.php");

	
	}
	
	if(isset($_POST["editar"])&& $_POST["editar"]=="editar"){
		 $c->foto=$c->guardarFoto();
	 $c->codigo=$_POST["codigo"];
     $c->titulo=htmlentities($_POST["titulo"], ENT_QUOTES,'UTF-8');
     $c->stock=$_POST["stock"];
	 $c->stock_minimo=$_POST["stock_minimo"];
	 $c->tomo=$_POST["tomo"];
	 $c->pv=$_POST["pv"];
	 $c->cif=$_POST["cif"];
	 $c->ps=$_POST["ps"];
	 $c->categorias_idcategorias=$_POST["categorias_idcategorias"];
	 $c->proveedores_idproveedores=$_POST["proveedores_idproveedores"];
	 $c->actualizar($_POST["idlibros"]);	
	 echo "<script type='text/javascript' >
alert('La edicion fue exitosa!!!');
location.href='".config::ruta()."?accion=libros'
</script>"; 
	//header("Location:".config::ruta()."?accion=libros");
		
		}
	
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
	
    	
	 $c->foto=$c->guardarFoto();
	 $c->codigo=$_POST["codigo"];
     $c->titulo=htmlentities($_POST["titulo"], ENT_QUOTES,'UTF-8');
     $c->stock="0";
	 $c->stock_minimo=$_POST["stock_minimo"];
	 $c->tomo=$_POST["tomo"];
	 $c->pv=$_POST["pv"];
	 $c->cif=$_POST["cif"];
	 $c->ps=$_POST["ps"];
	 $c->categorias_idcategorias=$_POST["categorias_idcategorias"];
	 $c->proveedores_idproveedores=$_POST["proveedores_idproveedores"];
	 $c->nuevo();	
	  echo "
	   <script type='text/javascript' >
if(confirm('Se ha registrado un nuevo Libro.. Desea volver?')){
	location.href='".config::ruta()."?accion=libros'}
	</script>";
	//header("Location:".config::ruta()."?accion=addLibros&m=1");


	 
 }

require_once("view/addLibros.php");

?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>