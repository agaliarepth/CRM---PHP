<?php
class detalleDevolucion {
	static $tabla="detalle_devolucion";
	static $idTabla="iddetalle_devolucion";
	static $objeto;
	static $consulta;
	
	public  $cantidad;
	public  $codigo;
	public  $titulo;
	public  $tomo;
	public  $precio_unit;
	public  $precio_total;
	public  $devolucion_iddevolucion;
	public  $idlibros;
	
	
	
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
				public function borrarPorNota($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE devolucion_iddevolucion='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
			 public function getDetalle($id){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla."  WHERE devolucion_iddevolucion='".$id."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
			public function nuevo(){
				global $db;
				
				self::$consulta=substr(self::$consulta, 0, -1);
			    $this->get_objeto();
				$sql="INSERT INTO ".self::$tabla."(";
				$sql.=join(",",array_keys(self::$objeto));
				$sql.=") VALUES ";
		        $sql.=self::$consulta;
				if(!$db->query($sql))
				return false;
				else{
				self::$consulta="";
				return  $sql;
				}
				
				}	
			public function insertar(){
				 $this->get_objeto();
				 
				
			   self::$consulta.= "('";
				self::$consulta.=join("','",array_values(self::$objeto));
				self::$consulta.="'),";
				
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
				if(!$db->query($sql))
				return false;
				else
				return true;
				
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
				$sql="SELECT devolucion.fecha,devolucion.idingreso,devolucion.moneda,detalle_devolucion.cantidad,detalle_devolucion.codigo,detalle_devolucion.titulo,detalle_devolucion.precio_unit,detalle_devolucion.precio_total FROM devolucion,detalle_devolucion WHERE  detalle_devolucion.devolucion_iddevolucion=devolucion.iddevolucion AND YEAR(devolucion.fecha)='".$anio."' AND devolucion.idcliente='".$idcliente."'";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					
		public function sumarDevoluciones($anio,$idcliente,$moneda){
					
					 global $db;
					 
				$sql="SELECT sum(detalle_devolucion.precio_total)as total  FROM detalle_devolucion, devolucion WHERE detalle_devolucion.devolucion_iddevolucion=devolucion.iddevolucion AND   (YEAR(devolucion.fecha) between 1990 AND '".$anio."') AND devolucion.moneda='".$moneda."' AND devolucion.idcliente='".$idcliente."' AND devolucion.terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
					}
	  public   function sumarTotalDevolucion($id,$nv,$valor){
				global $db;
				$sql="SELECT sum(precio_total) as total_fila FROM ".self::$tabla." WHERE devolucion_iddevolucion='".$id."' AND ".$nv."='".$valor."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total_fila"]);
				
				}	

}
?>