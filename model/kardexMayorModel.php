<?php
//require_once("../helpers/conexion.php");
class kardexMayor {
	static $tabla="kardexmayor";
	static $idTabla="idkardexmayor";
	static $objeto;
	
	public  $idlibros;
	public  $fecha;
	public  $procedencia;
	public  $num_doc;
	public  $ingreso;
	public $salida;
	public $saldo;
	public $concepto1;
	public $concepto2;
    public $obs;
  
	 public $idingreso;
	public $idegreso;
  
	
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
				$sql="SELECT * FROM ".self::$tabla;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				 public function   getMes($idlibro,$mes,$anio,$orden){
				 global $db;
				$sql="SELECT * FROM  ".self::$tabla." WHERE idlibros='".$idlibro."' AND MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' ORDER BY ".$orden;
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
				
				 public   function sumIngreso($fecha,$idlibro){
				global $db;
				$sql="SELECT sum(ingreso) as suma FROM ".self::$tabla." WHERE fecha between '2013-1-1' AND '".$fecha."' AND idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				 public   function sumEgreso($fecha,$idlibro){
				global $db;
				$sql="SELECT sum(salida)  as suma FROM ".self::$tabla." WHERE fecha between '2013-1-1' AND '".$fecha."' AND idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
					public function borrarPorNotaIngreso($idingreso){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE idingreso='".$idingreso."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
						public function borrarPorNotaEgreso($idegreso){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE idegreso='".$idegreso."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
	         	public function kardexMayorTotal($mes,$anio){
							
							global $db;
				$sql="SELECT * FROM  ".self::$tabla." WHERE   MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
						}
	
	}

//$v=new kardexVendedor();
//print_r($v->todasRemisiones("1"));

	?>