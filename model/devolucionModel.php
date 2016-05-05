<?php

class Devolucion {
	static $tabla="devolucion";
	static $idTabla="iddevolucion";
	static $objeto;
	static $lastId;
	
	public  $total;
	public  $fecha;
	public  $cantidad;
	public $idingreso;
	public $cliente;
	public $idcliente;
	public $terminado;
	public $moneda;
	public $estado;
	public $idventas;
	public $tipodevolucion;
	public $iddeudas;
	public $saldo;
 
	
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
					
						
					 public function   detalleDevolucionVenta($idventa){
				 global $db;
				$sql="SELECT detalle_devolucion.idlibros,detalle_devolucion.precio_unit,detalle_devolucion.precio_total,devolucion.idventas,devolucion.moneda  FROM ".self::$tabla.", detalle_devolucion WHERE devolucion.estado='DEVUELTO' AND devolucion.terminado=1 AND detalle_devolucion.devolucion_iddevolucion=devolucion.iddevolucion AND devolucion.idventas='".$idventa."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				 public function   detalleDevolucionDeuda($iddeudas){
				 global $db;
				$sql="SELECT detalle_devolucion.idlibros,detalle_devolucion.precio_unit,detalle_devolucion.precio_total,devolucion.idventas,devolucion.moneda  FROM ".self::$tabla.", detalle_devolucion WHERE devolucion.estado='DEVUELTO' AND devolucion.terminado=1 AND detalle_devolucion.devolucion_iddevolucion=devolucion.iddevolucion AND devolucion.iddeudas='".$iddeudas."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				public function devolucion_ingreso($idingreso){
					
					global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE idingreso='".$idingreso."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
					
					public function updateSaldo($iddevolucion,$monto){
					
					global $db;
				$sql="UPDATE ".self::$tabla." SET saldo=saldo-".$monto." WHERE iddevolucion='".$iddevolucion."'";
				$res=$db->query($sql);
					
					}
					
					public function getSaldo($iddevolucion){
					
					global $db;
				$sql="SELECT saldo FROM ".self::$tabla." WHERE iddevolucion='".$iddevolucion."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["saldo"]);
					
					}
						public function sumarDevolucion($idventa,$moneda){
					
					 global $db;
				$sql="SELECT sum(total) as sumtotal FROM devolucion   WHERE  idventas='".$idventa."'  AND moneda='".$moneda."' AND  estado='DEVUELTO'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumtotal"]);
					}
	public function sumarDevolucionDeuda($iddeuda,$moneda){
					
					 global $db;
				$sql="SELECT sum(total) as sumtotal FROM devolucion   WHERE  iddeudas='".$iddeuda."'  AND moneda='".$moneda."' AND  estado='DEVUELTO'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumtotal"]);
					}
	  
	}


	?>