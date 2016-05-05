  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/vendedoresModel.php");
require_once("model/vendedores_usuariosModel.php");
require_once("model/usuariosModel.php");
$u=new Usuario();

$v=new Vendedores();
$vu=new VendedoresUsuarios();

$res=$vu->getVendedores($_GET["id"]);
$vendedores=$v->listarTodos();
if(isset($_POST["enviar"])){
	$vu->idvendedores=$_POST["idvendedores"];
	$vu->idusuarios=$_POST["idusuarios"];
	$vu->nuevo();
	header("Location:".config::ruta()."?accion=asignarVendedores&id=".$_POST["idusuarios"]);
	
	
	}
	if(isset($_GET["e"])&&$_GET["e"]=="quitar"){
		
		$vu->quitarvendedor($_GET["id1"],$_GET["id2"]);
		header("Location:".config::ruta()."?accion=asignarVendedores&id=".$_GET["id2"]);
		}
require_once("view/asignarVendedores.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>