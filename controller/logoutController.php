<?php 
require_once("model/usuariosModel.php");
$user=new Usuario();
 echo "<script type='text/javascript' >
if(confirm('DESEA SALIR DE LA APLICACION???'))
{".$user->logout()."
}
else{
	alert ('dsfsdf')
	}
</script>"; 


?>