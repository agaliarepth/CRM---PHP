<?php
//require_once("../helpers/conexion.php");
class ventasContado{
	static $tabla="ventasContado";
	static $idTabla="idventasContado";
	static $objeto;
	static $lastId;
	
	public  $numfactura;
	public  $numingreso;
	public  $ventas_idventas;
	public  $monto;
	public  $saldo;
	public  $tipopago;
	public  $cuentabanco;
	public  $razonsocial;
	  
	
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
			
			public function get_id(){
							
			           return self::$idTabla;
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
				
				 public function   listarTodos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC";
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
				
				self::$lastId=$db->lastID("idventascredito"); 
				
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
						
						
			public function borrarVenta($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ventas_idventas='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
		public function   getVenta($id){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ventas_idventas='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				
			public function   kardexCliente($idventas){
				 global $db;
				$sql="SELECT numfactura,numingreso,monto,tipopago, cuentabanco  FROM ".self::$tabla." WHERE ventas_idventas='".$idventas."'"; 
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
					
					public function   getNumFactura($id){
				 global $db;
				$sql="SELECT numfactura FROM ".self::$tabla." WHERE ventas_idventas='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
		
					
				
	}

	?>