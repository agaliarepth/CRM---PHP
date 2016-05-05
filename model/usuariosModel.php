<?php
class Usuario{
	static $tabla="usuarios";
	static $idTabla="idusuarios";
	static $objeto;
	
	public  $username;
	public  $password;
	public  $nombres;
	public  $cargo;
	public  $perfiles_idperfiles;
	
	
	function __construct(){
		
		self::$objeto=get_object_vars($this);
		}
		public function get_objeto(){
			
			self::$objeto=get_object_vars($this);
			
			return self::$objeto;
			}
			
			public function get_tabla(){
							
			           return self::$tabla;
			}
			
			
				private  static function instanciar($reg){
					$obj=new self;
					foreach($reg as $atrib=>$valor){
						if($obj->atributos($atrib))
						$obj->$atrib=$valor;
						}
					return $obj;
					}
				private function atributos($atributo){
					$var=get_object_vars($this);
					return array_key_exists($atributo,$var);
					
					}	
				
				 public function listarTodos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
		    
			public function nuevo(){
				global $db;
			    $this->get_objeto();
				$sql="INSERT INTO ".self::$tabla."(";
				$sql.=join(",",array_keys(self::$objeto));
				$sql.=") VALUES ('";
				$sql.=join("','",array_values(self::$objeto));
				$sql.="')";
		
				$db->query($sql);
				
				}	
				
				
			public  function actualizar($id){
				global $db;
				$this->get_objeto();
				  $pares=array();
				  foreach(self::$objeto as $key=>$value){
					  $pares[]="{$key}='{$value}'";
					  
					  }
				$sql="UPDATE ".self::$tabla." SET ";
				$sql.=join(", ",$pares);
				$sql.=" WHERE ".self::$idTabla."='".$id."'";
				$db->query($sql);
				
				}
				
				
				
			public function borrar($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				
				return ($res);
						}
			
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
                
                 public   function getUserVendedor(){
				global $db;
				$sql="SELECT   usuarios.username, usuarios.password,usuarios.nombres FROM usuarios, vendedores  WHERE usuarios.idvendedores=vendedores.idVendedores";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				public function validarUsername($username){
					
					global $db;
				$sql="SELECT count(username) FROM ".self::$tabla." WHERE username ='".$username."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
				
				
				public function logout(){
				session_destroy();
				header("Location:".config::server());
				
				
				}
			
			public function logeo(){
				global $db;
				if($_POST["username"]==""&&$_POST["password"]=="" ){
					
					header("Location:".config::ruta()."?accion=index&m=1");exit;
					
					}
					$sql="SELECT * FROM ".self::$tabla." WHERE username='".$_POST["username"]."' AND password='".$_POST["password"]."'";
					$res=$db->query($sql)->fetchColumn() ;
					
					if($res==0){
						
						header("Location:".config::ruta()."?accion=index&m=2");exit;
						
						}
						else{
							if($res1=$db->query($sql)->fetchObject())
							{
								$_SESSION["ses_id"]=$res1->idusuarios;
								$_SESSION["ses_username"]=$_POST["username"];
								$_SESSION["nombres"]=$res1->nombres;
								$_SESSION["cargo"]=$res1->cargo;
								$_SESSION["idperfiles"]=$res1->perfiles_idperfiles;
								$_SESSION["sucursal"]=SESSION;
								
							
								header("Location:".config::ruta()."?accion=home");
								
							}
							
							
							}
										
				
			}
			
			
			
      
}

	?>