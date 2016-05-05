<?php

class DevolucionDinero {
	static $tabla="devolucion_dinero";
	static $idTabla="iddevolucion_dinero";
	static $objeto;
	static $lastId;
	
	public  $clientes_idclientes;
	public  $monto;
	public  $fecha;
	public $numrecibo;
	public $terminado;
	public $moneda;
	public $nombre_cliente;
	public $descripcion;
	
 
	
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
				$sql="SELECT * FROM ".self::$tabla."  ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				 public function   listarTodosTerminado(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE terminado=1  and estado='Almacen' ORDER BY ".self::$idTabla."  DESC";
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
				//return  $sql;
				self::$lastId=$db->lastID("iddevolucion_dinero"); 
				
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
					
		
				public  function actualizarTerminado($id,$terminado){
				global $db;
				
				$sql="UPDATE ".self::$tabla." SET  terminado ='".$terminado."'  WHERE ".self::$idTabla."='".$id."'";
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
				
				
					public function kardexCliente($idcliente,$anio){
					
					 global $db;
				$sql="SELECT monto,moneda,fecha,descripcion,numrecibo FROM ".self::$tabla."  WHERE YEAR(fecha)='".$anio."' AND  clientes_idclientes='".$idcliente."' order by fecha asc";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
				
	
	  
	}


	?>