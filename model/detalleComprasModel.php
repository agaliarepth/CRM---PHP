<?php
class detalleCompras {
	static $tabla="detalleCompras";
	static $idTabla="iddetalleCompras";
	static $objeto;
	static $consulta;
	
	public  $cantidad;
	public  $precio_total;
	public  $precio_unit;
	public  $compras_idcompras;
	public  $libros_idlibros;
	public  $obs;
	public  $factura;
	
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
				$sql="SELECT * FROM ".self::$tabla." WHERE compras_idcompras='".$id."'";
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
					public function borrarPorNota($idcompras){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE compras_idcompras='".$idcompras."'";
				$res=$db->query($sql);
				 
				return ($res);
						} 
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
					public function reportePorMes($orden="codigo",$mes,$anio, $idalmacen,$destino){
					
					 global $db;
				$sql="SELECT * FROM view_egreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."' AND destino='".$destino."'   order by  ".$orden;
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
			public function reportePorMesPaginado($orden="codigo",$mes,$anio, $idalmacen,$destino,$page){
					
					 global $db;
				$sql="SELECT * FROM view_egreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."' AND destino='".$destino."'   order by  ".$orden." LIMIT ".(($page-1)*5000).", 5000 ";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function reportePorMesTodosPaginado($orden="codigo",$mes,$anio, $idalmacen,$page){
					
					 global $db;
					 
				$sql="SELECT  *  FROM view_egreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."'  order by  ".$orden." LIMIT ".(($page-1)*5000).", 5000 ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function reportePorMesTodos($orden="codigo",$mes,$anio, $idalmacen){
					
					 global $db;
					 
				$sql="SELECT  *  FROM view_egreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."'  order by  ".$orden." ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function getSaldo($cod,$mes,$anio){
					
					 global $db;
					 
				$sql="SELECT  sum(cantidad)as saldo FROM view_egreso_detalle WHERE  codigo='".$cod."' AND MONTH(fecha)between 1 AND '".$mes."' AND YEAR(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
				
}
?>
				 
	