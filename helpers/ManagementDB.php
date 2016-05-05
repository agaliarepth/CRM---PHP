<?php 
//require_once("conexion.php");
class ManagementDB{
	
	
			
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
				
				 public function   listarTodos($tabla){
				 global $db;
				$sql="SELECT * FROM ".$tabla;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
		    public   function get_Id($campoId,$idValor,$tabla){
				global $db;
				$sql="SELECT * FROM ".$tabla." WHERE ".$campoId."='".$idValor."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
			public function nuevo($tabla,$objeto){
				global $db;
			  
				$sql="INSERT INTO ".$tabla."(";
				$sql.=join(",",array_keys($objeto));
				$sql.=") VALUES ('";
				$sql.=join("','",array_values($objeto));
				$sql.="')";
		
				$db->query($sql);
				
				}	
				
				
			public  function actualizarId($idCampo,$idValor,$tabla,$objeto){
				global $db;
				
				  $pares=array();
				  foreach($objeto as $key=>$value){
					  $pares[]="{$key}='{$value}'";
					  
					  }
				$sql="UPDATE ".$tabla." SET ";
				$sql.=join(", ",$pares);
				$sql.=" WHERE ".$idCampo."='".$idValor."'";
				$db->query($sql);
				
				}
				
			public function borrar($idcampo,$idValor,$tabla){
							
							global $db;
				$sql="delete  FROM ".$tabla." WHERE ".$idcampo."=".$idValor."";
				$res=$db->query($sql);
				
				return ($res);
						}
			
	
	}
