<?php
class detalleEgreso {
	static $tabla="detalle_egreso";
	static $idTabla="iddetalle_egreso";
	static $objeto;
	static $consulta;
	
	public  $cantidad;
	public  $precio_total;
	public  $precio_unitario;
	public  $egreso_idegreso;
	public  $libros_idlibros;
	public  $obs;
	
	
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
			 public function getDetalle($id){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE egreso_idegreso='".$id."'";
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
				$db->query($sql);
				self::$consulta="";
				return  $sql;
				
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
				$db->query($sql);
				
				}
				
				
				
			public function borrar($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
					public function borrarPorNotaEgreso($idegreso){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE egreso_idegreso='".$idegreso."'";
				$res=$db->query($sql);
				 
				return ($res);
						} 
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
					public function reportePorMes($mes,$anio){
					
					 global $db;
				$sql="SELECT * FROM view_egreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  order by fecha asc";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
			
					
					
				
					
					public function getSaldo($cod,$mes,$anio){
					
					 global $db;
					 
				$sql="SELECT  sum(cantidad)as saldo FROM view_egreso_detalle WHERE  codigo='".$cod."' AND MONTH(fecha)between 1 AND '".$mes."' AND YEAR(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					  public   function getCif($idegreso,$idlibro){
				global $db;
				$sql="SELECT precio_unitario FROM view_egreso_detalle WHERE idegreso='".$idegreso."'  AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["precio_unitario"]);
				
				}	
				 public   function sumEgreso($fecha,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_egreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				 public   function sumEgresoInventario($mes , $anio,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_egreso_detalle WHERE MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
				
				public   function sumEgresoInventarioAnt($mes , $anio,$idlibro){
				global $db;
				$fecha=$anio."-".$mes."-31";
				$sql="SELECT sum(cantidad) as suma FROM view_egreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."' AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
				 public function   getMes($idlibro,$ini,$fin){
				 global $db;
				$sql="SELECT * FROM  view_egreso_detalle WHERE libros_idlibros='".$idlibro."' AND (fecha between '".$ini."' AND '".$fin."') order by fecha asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				public function getStockActual($idlibro){
					global $db;
					 $sql ="SELECT sum(detalle_egreso.cantidad) as total  FROM detalle_egreso,egreso WHERE detalle_egreso.libros_idlibros='".$idlibro."' AND detalle_egreso.egreso_idegreso=egreso.idegreso   AND egreso.estado='Enviado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $egr=$res1["total"];
					return $egr;
					}
}
?>
				 
	