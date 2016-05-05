<?php
class Deuda{
	static $tabla="deudas";
	static $idTabla="iddeudas";
	static $objeto;
	static $lastId;

	public  $saldo_inicial;
	public  $saldo_actual;
	public  $saldo;
	public  $descripcion;
	public  $fecha;
	public  $fechavencimiento;
	public  $clientes_idclientes;
	public   $moneda;
	public   $nombre_cliente;
	public $dias_credito;
	public $numcuotas;
	public $comision;
	public $idvendedores;


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
				private function selectAll(){
        $this->get_objeto();

        $string=self::$idTabla.",";

        $string.=join(",",array_keys(self::$objeto));

        return($string);
    }
     public function   listarTodosMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

              public function   listarTodosRango($fecha1 ,$fecha2){
              global $db;
              $this->get_objeto();
              $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where (fecha BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
              $res=$db->query($sql)->fetchAll();
              return ($res);

    }
				 public function listarTodos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." order by fecha";
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
				self::$lastId=$db->lastID("idstock");
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

				  public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}

			public function borrar($id){

							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
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
				$sql="UPDATE ".self::$tabla." SET saldo_actual=saldo_actual+'".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}

					public function sumarDeuda($idcliente,$anio,$moneda){

							global $db;
				$sql="SELECT  sum(saldo) as montodeuda from deudas WHERE  (YEAR(fecha) BETWEEN 1990 AND '".$anio."') AND  moneda='".$moneda."' AND clientes_idclientes='".$idcliente."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);

				return ($res);
						}

						public function getDeudasVencidas($mes,$anio){

				 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT   iddeudas,nombre_cliente,fechavencimiento,fecha,saldo_inicial,saldo,saldo_actual,moneda,numcuotas,descripcion,clientes_idclientes FROM deudas WHERE  (fechavencimiento BETWEEN '2000-01-01' AND '".$f."') ";
				$res=$db->query($sql)->fetchAll();

				return ($res);
						}

						public function getDeudasVencidasRango($f1,$f2){

				 global $db;

				$sql="SELECT   iddeudas,nombre_cliente,fechavencimiento,fecha,saldo_inicial,saldo,saldo_actual,moneda,numcuotas,descripcion,clientes_idclientes FROM deudas WHERE  (fechavencimiento BETWEEN '".$f1."' AND '".$f2."') ";
				$res=$db->query($sql)->fetchAll();

				return ($res);
						}


}
?>
