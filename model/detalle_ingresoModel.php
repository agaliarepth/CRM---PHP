<?php
class detalleIngreso {
	static $tabla="detalle_ingreso";
	static $idTabla="iddetalle_ingreso";
	static $objeto;
	static $consulta;
	
	public  $cantidad;

	public  $precio_unitario;
	public  $precio_total;
	public  $libros_idlibros;
	public  $ingreso_idingreso;
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
				public function borrarPorNotaIngreso($idingreso){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ingreso_idingreso='".$idingreso."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
			 public function getDetalle($id){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla." , libros WHERE ingreso_idingreso='".$id."' AND libros.idlibros=libros_idlibros order by libros.codigo";
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
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					public function getSaldo($cod,$mes,$anio){
					
					 global $db;
					 
				$sql="SELECT  sum(cantidad)as saldo FROM view_ingreso_detalle WHERE  codigo='".$cod."' AND MONTH(fecha) between 1 AND '".$mes."' AND YEAR(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function reportePorMes($mes,$anio){
					
					 global $db;
				$sql="SELECT * FROM view_ingreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  order by fecha asc";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					 public   function sumIngreso($fecha,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
					 public   function sumIngresoInventario($mes , $anio,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
					 public   function sumIngresoInventarioAnt($mes , $anio,$idlibro){
				global $db;
				$fecha=$anio."-".$mes."-31";
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."' AND libros_idlibros='".$idlibro."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
				
				 public function   getMes($idlibro,$ini,$fin){
				 global $db;
				$sql="SELECT * FROM  view_ingreso_detalle WHERE libros_idlibros='".$idlibro."' AND (fecha between '".$ini."' AND '".$fin."') order by fecha asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				 public function   getKardexMayor($idlibro,$ini,$fin){
				 global $db;
				$sql="SELECT view_ingreso_detalle.fecha,view_ingreso_detalle.recibe,view_ingreso_detalle.idingreso,view_ingreso_detalle.concepto,view_ingreso_detalle.cantidad,view_ingreso_detalle.envia,view_egreso_detalle.envia as enviaegreso,view_egreso_detalle.fecha as fechaegreso,view_egreso_detalle.idegreso,view_egreso_detalle.destino,view_egreso_detalle.concepto as conceptoegreso,view_egreso_detalle.cantidad as cantidadegreso FROM  view_ingreso_detalle, view_egreso_detalle WHERE view_ingreso_detalle.libros_idlibros='".$idlibro."' AND (view_ingreso_detalle.fecha between '".$ini."' AND '".$fin."')  AND (view_egreso_detalle.fecha between '".$ini."' AND '".$fin."')order by view_ingreso_detalle.fecha ,fechaegreso asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				public function getStockActual($idlibro){
					global $db;
					 $sql ="SELECT sum(cantidad) as total  FROM detalle_ingreso,ingreso WHERE detalle_ingreso.libros_idlibros='".$idlibro."' AND detalle_ingreso.ingreso_idingreso=ingreso.idingreso AND ingreso.terminado=1 AND ingreso.estado='Enviado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $ing=$res1["total"];
					return $ing;
					}
	  
}
?>