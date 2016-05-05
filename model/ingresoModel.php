<?php

class Ingreso {
	static $tabla="ingreso";
	static $idTabla="idingreso";
	static $objeto;
	static $lastId;
	
	public  $recibe;
	public  $envia;
	public  $fecha;
	public $concepto;
	public $cant_total;
	public $estado;
	public $precio_total;
	public $terminado;
    public $moneda;
	public $valor_cambio;
	public $obs;
	public $nombre_usuarios;
	public $documento;
	
	
	
  
  
	
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
				 public function   listarTodosMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}

              public function   listarTodosRango($fecha1 ,$fecha2){
              global $db;
              $this->get_objeto();
              $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where (fecha BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
              $res=$db->query($sql)->fetchAll();
              return ($res);

    }
			private function selectAll(){
        $this->get_objeto();

        $string=self::$idTabla.",";

        $string.=join(",",array_keys(self::$objeto));

        return($string);
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
				self::$lastId=$db->lastID("idingreso"); 
				
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
					
			public  function actualizarEstado($id){
				global $db;
				
				$sql="UPDATE ".self::$tabla." SET  terminado =1, estado='Enviado' WHERE ".self::$idTabla."='".$id."'";
				$db->query($sql);
				
				}
				public  function updateEstado($id,$estado,$terminado){
				global $db;
				
				$sql="UPDATE ".self::$tabla." SET  terminado ='".$terminado."', estado='".$estado."' WHERE ".self::$idTabla."='".$id."'";
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
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					
					public function listarDevoluciones(){
					
					global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE concepto ='DEVOLUCION EN VENTA' and estado='Enviado' and terminado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}
	  
	}


	?>