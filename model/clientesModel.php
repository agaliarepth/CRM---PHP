<?php

class Clientes {
	static $tabla="clientes";
	static $idTabla="idclientes";
	static $objeto;

	public $nombres; 	
	public $apellidos; 	
	public $direccion; 	
	public $telefono; 	
	public $celular; 	
	public $email; 	
	public $fax; 	
	public $empresa; 	
	public $esposo; 	
	public $nitruc; 	
	public $origen;
	public $localidad;
	public $gracia; 	
	public $credito; 	
	public $cuotas; 	
	public $numletra; 	
	public $importeletra;
	public $vencimiento;
    public $ciudad;
	public $razonsocial;
  
  
	
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
				
				 public function   listarTodosOrden($orden){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".$orden."";
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
		
				if(!$db->query($sql))
				return false;
				
				else
				return true;				
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
				public   function getNombre($id){
				global $db;
				$sql="SELECT apellidos,nombres,ciudad,origen,localidad FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				public   function getDireccion($id){
				global $db;
				$sql="SELECT direccion FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["direccion"]);
				
				}	
				
				public   function getDeudasCompras($idcliente){
				global $db;
				$sql="SELECT cuotas.idcuotas,cuotas.numpago,cuotas.fecha,cuotas.saldo_inicial,cuotas.saldo_actual,ventas.idventas,ventas.moneda,ventas.fecha as fechavencimiento,ventas.total FROM ventas,cuotas,creditoVentas WHERE creditoVentas.idcreditoVentas=cuotas.creditoVentas_idcreditoVentas AND creditoVentas.ventas_idventas=ventas.idventas AND ventas.clientes_idclientes='".$idcliente."' ORDER BY ventas.idventas asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				public   function getDeudas($idcliente){
				global $db;
				$sql="SELECT deudas.saldo_inicial,deudas.saldo_actual,deudas.descripcion,deudas.moneda,deudas.dias_credito,deudas.numcuotas,deudas.iddeudas , deudas.fecha , deudas.fechavencimiento FROM deudas,clientes WHERE  deudas.clientes_idclientes=clientes.idclientes AND deudas.clientes_idclientes='".$idcliente."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
	
	}
	//$thumb=new thumbnail();
/*$l=new Libros();
$l->sumarStock(2,10);*/
	?>