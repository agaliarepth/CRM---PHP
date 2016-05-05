  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 
require_once("model/vendedoresModel.php");
require_once("model/usuariosModel.php");


$v=new Vendedores();
$u=new Usuario();
$user=$u->listarTodos();
if(isset($_GET["e"])&& $_GET["e"]=="editar"){
	$res=$v->getId($_GET["id"]);
	}
 if(isset($_POST["enviar"])&&$_POST["enviar"]=="enviar"){
	 $v->nombres=strtoupper($_POST["nombres"]);
	 
	 $v->nuevo();
	 header("location:".config::ruta()."?accion=vendedores");
	 
	 }
	 
	  if(isset($_POST["editar"])&&$_POST["editar"]=="editar"){
	 $v->nombres=strtoupper($_POST["nombres"]);
	 $v->actualizar($_POST["idvendedor"]);
	 header("location:".config::ruta()."?accion=vendedores");
	 
	 }
	 require_once("view/addVendedor.php");
?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>