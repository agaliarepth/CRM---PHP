<?php
class descuentoPago{
	static $tabla="descuentoPago";
	static $idTabla="iddescuentoPago";
	static $objeto;
	static $lastId;
	
	public  $monto;
	public  $descripcion;
	public  $pagoVentasCredito_idpagoVentasCredito;
	
	
	
	
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
				$sql="SELECT * FROM ".self::$tabla." order by fecha";
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
				self::$lastId=$db->lastID("idstock"); 
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
				
				  public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				public   function getPago($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE pagoVentasCredito_idpagoVentasCredito='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
			public function borrar($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				
				return ($res);
						}
							public function   kardexCliente($idpago){
				 global $db;
				$sql="SELECT iddescuentoPago, monto,descripcion FROM descuentoPago WHERE pagoVentasCredito_idpagoVentasCredito='".$idpago."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				public function   sumDescuentosPago($idpago){
				 global $db;
				$sql="SELECT sum(monto) as total  FROM descuentoPago WHERE pagoVentasCredito_idpagoVentasCredito='".$idpago."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
				
				}
			
	         
}
?>