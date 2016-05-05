<?php 
require_once("model/vendedoresModel.php");

$v=new Vendedores();

$res=$v->listarTodos();
require_once("view/vendedores.php");
?>