<?php

class DevolucionDeudas {
	static $tabla="devolucion_deudas";
	static $idTabla="iddevolucion_deudas";
	static $objeto;
	static $lastId;
	
	public  $monto;
	public  $moneda;
	public  $descripcion;
	public $notaingreso;
	public $fecha;
	public $deudas_iddeudas;
	public $terminado;
	public $cliente;
	
 
	
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
					
			public  function actualizarEstado($id,$terminado,$estado){
				global $db;
				
				$sql="UPDATE ".self::$tabla." SET  terminado ='".$terminado."', estado='".$estado."'  WHERE ".self::$idTabla."='".$id."'";
				$db->query($sql);
				
				}
				
				public  function actualizarIngreso($id,$idingreso){
				global $db;
				
				$sql="UPDATE ".self::$tabla." SET  idingreso ='".$idingreso."'  WHERE ".self::$idTabla."='".$id."'";
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
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					
						
					 public function  listaDevolucion1($iddeuda,$mes,$anio){
				 global $db;
				 $fecha=$anio."-".$mes."-31";
				$sql="SELECT *  FROM ".self::$tabla."  WHERE deudas_iddeudas='".$iddeuda."' AND (fecha BETWEEN '2013-01-01' AND '".$fecha."')";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				public function getDevolucionesDeudasAnio($anio,$idcliente,$moneda){
					 global $db;
				
				$sql="SELECT sum(devolucion_deudas.monto) as total FROM ".self::$tabla.", deudas  WHERE YEAR(devolucion_deudas.fecha)='".$anio."' AND devolucion_deudas.moneda='".$moneda."' AND deudas.clientes_idclientes='".$idcliente."' AND  devolucion_deudas.deudas_iddeudas=deudas.iddeudas ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
					
					}
					public function kardexCliente($idcliente,$anio){
					
					 global $db;
				$sql="SELECT devolucion_deudas.fecha,devolucion_deudas.notaingreso,devolucion_deudas.moneda,devolucion_deudas.descripcion,devolucion_deudas.monto,deudas.descripcion as descrip  FROM ".self::$tabla.", deudas  WHERE YEAR(devolucion_deudas.fecha)='".$anio."' AND  deudas.clientes_idclientes='".$idcliente."' AND  devolucion_deudas.deudas_iddeudas=deudas.iddeudas ";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
				
	
	  
	}


	?>