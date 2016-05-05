<?php
//require_once("../helpers/conexion.php");
class CargosCompras{
	static $tabla="cargosCompras";
	static $idTabla="idcargosCompras";
	static $objeto;
	static $lastId;
	
	public  $monto;
	public  $fecha;
	public  $numdoc;
	public $compras_idcompras;
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
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				 public function getCargos($id){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE compras_idcompras='".$id."'";
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
				self::$lastId=$db->lastID("idcuentas"); 
				
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
						
			public function updateSaldo($id,$monto){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo_actual='".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
			public function updateEstado($id,$estado){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET estado='".$estado."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						public function updateEstado1($id,$estado){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET estado='".$estado."' where num_cuenta='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
						public function updatePorcentaje($id,$por){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET porcentaje='".$por."' where ".self::$idTabla."='".$id."'";
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
					
					public function validarRequerimiento($idreq){
					
					global $db;
				$sql="SELECT count(nota_pedido_idnota_pedido) FROM ".self::$tabla." WHERE nota_pedido_idnota_pedido ='".$idreq."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					
					public function getCuentas($idcobrador){
					
					global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE idcobrador ='".$idcobrador."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				}
	  	public function reporteAsignaciones($id){
					
					global $db;
				$sql="SELECT num_cuenta,nombre_vendedor,nombre_cliente,fecha_creacion,monto_total,idcontrato,estado,idcobrador FROM ".self::$tabla." WHERE idcuentas ='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				}
	
	
	
	
	public function cuentasPorCobrador($id ,$mes,$anio){
					
					global $db;
				$sql="SELECT idcuentas,num_cuenta,nombre_vendedor,nombre_cliente,pago_inicial,fecha_creacion,monto_total,idcontrato,estado,diacobranza,idcobrador,cuotamensual, saldo_actual,saldo FROM ".self::$tabla." WHERE idcobrador ='".$id."' and MONTH(fecha_creacion)BETWEEN 1 and '".$mes."' AND   YEAR(fecha_creacion) BETWEEN 2013 AND '".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				}
				public function cuentasPorCobrador2($id ,$mes,$anio,$fecha){
					
					
					$f2=$anio."-".$mes."-31";
					
					global $db;
				$sql="SELECT idcuentas,num_cuenta,nombre_vendedor,nombre_cliente,pago_inicial,fecha_creacion,fecha_cancelacion,monto_total,idcontrato,estado,diacobranza,idcobrador,cuotamensual, saldo_actual,saldo,fecha_anulacion FROM ".self::$tabla." WHERE idcobrador ='".$id."' and fecha_creacion BETWEEN '2013-01-01' and '".$fecha."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				}
	
	public function devitoTotal($mes,$anio,$idco){
					 global $db;
					$sql="SELECT  *  FROM pagos WHERE   MONTH(fecha) BETWEEN 1 and '".$mes."' AND   YEAR(fecha)='".$anio."' AND idcobrador='".$idcobrador."' AND cuentas_idcuentas='".$idcuenta."'  order by  fecha desc ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function bsPorCobrar($idco){
					 global $db;
					$sql="SELECT sum(saldo)  FROM cuentas WHERE   idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					public function contarCuentas($idco){
					 global $db;
					$sql="SELECT count(idcuentas)  FROM cuentas WHERE   idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function contarCuentasCanceladas($idco){
					 global $db;
					$sql="SELECT count(idcuentas)  FROM cuentas WHERE idcobrador='".$idco."' AND saldo_actual=0";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function cuentaPorCobrador($idco){
					 global $db;
					$sql="SELECT saldo,idcuentas FROM cuentas WHERE idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					
					public function updateCancelacion($idcuenta,$fecha){
					 global $db;
					$sql="UPDATE cuentas SET fecha_cancelacion='".$fecha."'  WHERE  idcuentas='".$idcuenta."'";
				$res=$db->query($sql);
				return ($res);
					}
					
					public function updateAnularCuenta($idcuenta,$fecha){
					 global $db;
					$sql="UPDATE cuentas SET fecha_anulacion='".$fecha."'  WHERE  num_cuenta='".$idcuenta."'";
				$res=$db->query($sql);
				return ($res);
					}
					public function getCuentasCanceladasTodos($mes,$anio,$orden){
					 global $db;
					$sql="SELECT  *  FROM cuentas WHERE   MONTH(fecha_cancelacion)='".$mes."' AND   YEAR(fecha_cancelacion)='".$anio."'  order by ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function getCuentasCanceladasCobrador($mes,$anio,$idcobrador,$orden){
					 global $db;
					$sql="SELECT  *  FROM cuentas WHERE   MONTH(fecha_cancelacion)='".$mes."' AND   YEAR(fecha_cancelacion)='".$anio."' AND idcobrador='".$idcobrador."'   order by ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function getCuentasPorNumero($num_cuenta){
					 global $db;
					$sql="SELECT  fecha_creacion,saldo,pago_inicial,numero_cuotas,diacobranza,cuotamensual  FROM cuentas WHERE   num_cuenta='".$num_cuenta."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}
					
					public function getSaldoActualCuenta($num_cuenta){
					 global $db;
					$sql="SELECT  saldo_actual,saldo,pago_inicial,numero_cuotas,diacobranza,cuotamensual  FROM cuentas WHERE   num_cuenta='".$num_cuenta."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}
					
					public function cuentasSinEnviar(){
					 global $db;
					$sql="SELECT  * FROM cuentas WHERE    estado='Sin Enviar'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function cuentasAprovadas(){
					 global $db;
					$sql="SELECT  * FROM cuentas WHERE    estado=''";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function aprobarCuenta($idcuenta){
					 global $db;
					$sql="UPDATE cuentas SET estado=''  WHERE  idcuentas='".$idcuenta."'";
				$res=$db->query($sql);
				return ($res);
					}
					
					
	}

	?>