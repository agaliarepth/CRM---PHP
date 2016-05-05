<?php
class detalleVentas{
	static $tabla="detalleVentas";
	static $idTabla="iddetalleVentas";
	static $objeto;
	static $consulta;
	
	public  $cantidad;
	public  $precio_total;
	public  $precio_unit;
	public  $ventas_idventas;
	public  $libros_idlibros;
	public  $codigo;
	public  $titulo;
	public  $volumen;
	
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
				$sql="SELECT * FROM ".self::$tabla." WHERE ventas_idventas='".$id."' ORDER BY codigo";
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
					public function borrarPorNota($idventas){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ventas_idventas='".$idventas."'";
				$res=$db->query($sql);
				 
				return ($res);
						} 
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
				public function kardexCliente($idventa){
					
					global $db;
				$sql="SELECT * FROM  detalleventas_view  WHERE  idventas='".$idventa."' AND despachado=1";
				
				$res=$db->query($sql)->fetchAll();
				return $res;
					}
					
					
				
				public function totalVentas($anio,$idcliente,$moneda){
					
					 global $db;
					 
				$sql="SELECT  sum(precio_total)as total FROM detalleventas_view WHERE  clientes_idclientes='".$idcliente."' AND (YEAR(fecha) between 1990 AND '".$anio."') AND moneda='".$moneda."' AND  despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
					}
					
					
					public function relacionObrasVendidas($mes,$anio){
					
					global $db;
					$sql="SELECT DISTINCT codigo ,libros_idlibros,titulo FROM detalleventas_view WHERE   MONTH(fecha)='".$mes."' AND  YEAR(fecha)='".$anio."' AND despachado=1 order by codigo";
				
				$res=$db->query($sql)->fetchAll();
				return $res;
					}
					//**CONSULTAS PARA REPORTE OBRAS VENDIDAS POR RANGO
					public function listaCodigosMeses($mes1,$mes2,$anio){
					
					global $db;
					$sql="SELECT  distinct  codigo, titulo FROM detalleventas_view where  month(fecha) between ".$mes1." and ".$mes2." AND YEAR(fecha)='".$anio."' order by codigo";
				
				$res=$db->query($sql)->fetchAll();
				return $res;
					}
					public function listaCodigosMesesVendedor($mes1,$mes2,$anio,$idvendedor){
					
					global $db;
					$sql="SELECT  distinct  codigo, titulo FROM detalleventas_view where  month(fecha) between ".$mes1." and ".$mes2." AND YEAR(fecha)='".$anio."' AND idvendedores='".$idvendedor."' order by codigo";
				
				$res=$db->query($sql)->fetchAll();
				return $res;
					}
					public function sumarPorCodigo2($codigo,$mes, $anio){
					
					 global $db;
				$sql="SELECT sum(cantidad) as sumcantidad   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND codigo ='".$codigo."'   AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumcantidad"]);
					}
					public function sumarPorCodigoVendedor($codigo,$mes, $anio,$idvendedor){
					
					 global $db;
				$sql="SELECT sum(cantidad) as sumcantidad   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND codigo ='".$codigo."' AND  idvendedores='".$idvendedor."'  AND  despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumcantidad"]);
					}
					
					public function sumarPorMes($mes, $anio){
					
					 global $db;
				$sql="SELECT sum(cantidad) as sum   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'   AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sum"]);
					}
					public function sumarPorMesVendedor($mes, $anio,$idvendedor){
					
					 global $db;
				$sql="SELECT sum(cantidad) as sum   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'   AND  idvendedores='".$idvendedor."' AND  despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sum"]);
					}
					
					//
					
					public function sumarPorCodigo($codigo,$mes, $anio,$idvendedor){
					
					 global $db;
				$sql="SELECT sum(cantidad) as sumcantidad   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND codigo ='".$codigo."'  AND idvendedores='".$idvendedor."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}
					
					public function sumarPrecioPorCodigo($codigo,$mes, $anio,$moneda){
					
					 global $db;
				$sql="SELECT sum(precio_total) as sumprecio   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND codigo ='".$codigo."'  AND moneda='".$moneda."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumprecio"]);
					}
					public function listaVendedores($mes, $anio){
					
					 global $db;
				$sql="SELECT  DISTINCT idvendedores,vendedor FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND despachado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					
					
					public function listaClientes($mes, $anio,$vendedor){
					
					 global $db;
				$sql="SELECT  DISTINCT clientes_idclientes,nombre,vendedor FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idvendedores='".$vendedor."' AND despachado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function listaClientesTodos($mes, $anio){
					
					 global $db;
				$sql="SELECT  DISTINCT clientes_idclientes FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  AND despachado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function listaClientesPeriodo($mes1,$mes2, $anio,$vendedor){
					
					 global $db;
				$sql="SELECT  DISTINCT clientes_idclientes, vendedor FROM detalleventas_view   WHERE  ( MONTH(fecha) BETWEEN ".$mes1." AND ".$mes2.") AND YEAR(fecha)='".$anio."' AND idvendedores='".$vendedor."' AND despachado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function listaClientesPeriodoTodos($mes1,$mes2, $anio){
					
					 global $db;
				$sql="SELECT  DISTINCT clientes_idclientes FROM detalleventas_view   WHERE  MONTH(fecha) BETWEEN ".$mes1." AND ".$mes2." AND YEAR(fecha)='".$anio."' AND despachado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function sumarCantidadPorCliente($mes, $anio,$idcliente,$tipo){
					
					 global $db;
				$sql="SELECT sum(cantidad) as sumcantidad   FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND clientes_idclientes ='".$idcliente."'   AND tipoventa='".$tipo."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumcantidad"]);
					}
					
					public function sumarPrecioPorCliente($mes, $anio,$idcliente,$moneda,$tipo){
					
					 global $db;
				$sql="SELECT sum(precio_total) as sumprecio  FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND clientes_idclientes ='".$idcliente."'   AND moneda='".$moneda."' AND  tipoventa='".$tipo."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumprecio"]);
					}
					
					public function sumarPrecioPorCliente2($mes, $anio,$idcliente,$moneda){
					
					 global $db;
				$sql="SELECT sum(precio_total) as sumprecio  FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND clientes_idclientes ='".$idcliente."'  AND moneda='".$moneda."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumprecio"]);
					}
					
					public function sumarTotalMesTodos($mes, $anio,$moneda){
					
					 global $db;
				$sql="SELECT sum(precio_total) as sumprecio  FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND  moneda='".$moneda."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumprecio"]);
					}
					
					
					public function sumarTotalMesVendedor($mes, $anio,$idvendedor,$moneda){
					
					 global $db;
				$sql="SELECT sum(precio_total) as sumprecio  FROM detalleventas_view   WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND  moneda='".$moneda."'  AND idvendedores='".$idvendedor."' AND despachado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["sumprecio"]);
					}
}
?>
				 
	