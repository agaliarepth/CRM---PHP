  <?php if(isset($_SESSION["modulo_administracion"])&&isset($_SESSION["ses_id"])&&isset($_SESSION["sucursal"])&&$_SESSION["sucursal"]==SUCURSAL){?>  

<?php 

require_once("view/admin.php");



?>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>