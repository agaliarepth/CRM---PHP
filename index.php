<?php 
include_once("config.php");

if(isset($_SESSION["ses_id"])){
	
if(!empty($_GET['accion'])){
	$accion=$_GET['accion'];}
	
	else
	{
		$accion='index';
		
		}
		
	if(is_file("controller/".$accion."Controller.php"))
	{
		
		require_once("controller/".$accion."Controller.php");
		}
	
	else
	{
		require_once("controller/errorController.php");
		}
}
else
{
	require_once("controller/indexController.php");
	
	}
	
?>