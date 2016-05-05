<?php
//require_once("../helpers/conexion.php");
class creditoVentas{
	static $tabla="creditoventas";
	static $idTabla="idcreditoVentas";
	static $objeto;
	static $lastId;
	
	public  $saldo_inicial;
	public  $saldo_actual;
	public  $num_cuotas;
	public $monto_cuotas;
	public $dias;
	public $ventas_idventas;
	public $adelanto;
	public $fechaprimerpago;
	public $diaspago;
	public $tipoadelanto;
	public $cuentabanco;
	public $reciboadelanto;
	public $facturaadelanto;
	

		

	
  
	
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
				
				 public function   getVenta($id){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ventas_idventas='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				 public function   getCredito($id){
				 global $db;
				$sql="SELECT idcreditoVentas,adelanto,num_cuotas,monto_cuotas,dias,tipoadelanto,cuentabanco,reciboadelanto,facturaadelanto,fechaprimerpago,diaspago FROM ".self::$tabla." WHERE ventas_idventas='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				
				 public function   actualizarMontosDevolucion($idcredito,$saldo_inicial,$saldo_actual,$monto_cuotas){
				 global $db;
				$sql="UPDATE   ".self::$tabla." SET saldo_inicial=saldo_inicial-'".$saldo_inicial."', saldo_actual=saldo_actual-'".$saldo_actual."', monto_cuotas=monto_cuotas-'".$monto_cuotas."'  WHERE  ".self::$idTabla."='".$idcredito."'";
				$res=$db->query($sql);
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
				self::$lastId=$db->lastID("idcreditoVentas");
				
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
				//echo $sql;
				$db->query($sql);
				
				}
				public  function actualizarMontos($id,$si,$sa,$mc){
				global $db;
				
				$sql=" UPDATE  ".self::$tabla." SET  saldo_inicial='".$si."',saldo_actual=".$sa.",monto_cuotas='".$mc."'  WHERE ".self::$idTabla."='".$id."'";
				echo $sql;
				$db->query($sql);
				
				}
				
				public  function actualizarMontosDevolucion2($id,$si,$sa){
				global $db;
				
				$sql=" UPDATE  ".self::$tabla." SET  saldo_inicial='".$si."',saldo_actual=".$sa."  WHERE ventas_idventas='".$id."'";
				echo $sql;
				$db->query($sql);
				
				}
				
				
			public function borrar($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
						
							public function borrarVenta($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ventas_idventas='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
			public function updateSaldo($id,$monto){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo_actual=saldo_actual-'".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
						public function sumarSaldo($id,$monto){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo_actual=saldo_actual+'".$monto."' where ventas_idventas='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						public function sumarSaldo1($id,$monto){
							
							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo_actual=saldo_actual+'".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
			
						
						
						
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				public   function getCreditoByVenta($idventa){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ventas_idventas='".$idventa."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
			
					
				
					public function getCondiciones($idventas){
					 global $db;
					$sql="SELECT  dias,diaspago,num_cuotas FROM ".self::$tabla." WHERE   ventas_idventas='".$idventas."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}
					
					
			
				
					
					
					
				
					
				
					
					
	}

	?>