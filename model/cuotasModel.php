<?php
//require_once("../helpers/conexion.php");
class Cuotas{
	static $tabla="cuotas";
	static $idTabla="idcuotas";
	static $objeto;
	static $lastId;


	public  $fecha;
	public  $numpago;
	public  $saldo_inicial;
	public  $saldo_actual;
	public  $creditoVentas_idcreditoVentas;






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



			public function nuevo(){
				global $db;


			    $this->get_objeto();
				$sql="INSERT INTO ".self::$tabla."(";
				$sql.=join(",",array_keys(self::$objeto));
				$sql.=") VALUES ('";
				$sql.=join("','",array_values(self::$objeto));
				$sql.="')";

				$db->query($sql);



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

		public function numpagos($idcredito){

							global $db;
				$sql="SELECT count(numpagos) FROM ".self::$tabla." WHERE creditoVentas_idcreditoVentas='".$idcredito."'";
				$res=$db->query->fetchColumn();

				return ($res);
		}

					public function getCredito($id){

							global $db;
				$sql="SELECT creditoVentas_idcreditoVentas FROM ".self::$tabla." WHERE idcuotas='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);

				return ($res);
		}
			public function listarCuotasCredito($id){

							global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE creditoVentas_idcreditoVentas='".$id."'";
				$res=$db->query($sql)->fetchAll();

				return ($res);
		}
			public function updateSaldo($id,$monto){

							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo_actual=saldo_actual-'".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}

			public function actualizarMontos($id,$saldo_inicial,$saldo_actual){

							global $db;

				$sql="UPDATE ".self::$tabla." SET saldo_inicial=saldo_inicial-'".$saldo_inicial."',saldo_actual=saldo_actual-'".$saldo_actual."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}

						public function actualizarSaldo($id,$saldo_inicial){

							global $db;

				$sql="UPDATE ".self::$tabla." SET saldo_inicial=saldo_inicial-'".$saldo_inicial."', saldo_actual=saldo_inicial where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}


						public function sumarSaldo($id,$monto){

							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo_actual=saldo_actual+'".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}

							public function getCuotasVencidas($mes,$anio){

				 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT   cuotas.idcuotas,cuotas.saldo_inicial,cuotas.saldo_actual,cuotas.creditoVentas_idcreditoVentas,cuotas.fecha, cuotas.numpago,ventas.clientes_idclientes,ventas.idventas,ventas.idegreso,ventas.nombre,ventas.moneda FROM cuotas,creditoventas,ventas  WHERE  (cuotas.fecha  BETWEEN '2000-01-01' AND '".$f."') AND cuotas.creditoVentas_idcreditoVentas=creditoVentas.idcreditoVentas AND creditoVentas.ventas_idventas=ventas.idventas";
				$res=$db->query($sql)->fetchAll();

				return ($res);
						}

						public function getCuotasVencidasRango($f1,$f2){

			 global $db;

			$sql="SELECT   cuotas.idcuotas,cuotas.saldo_inicial,cuotas.saldo_actual,cuotas.creditoVentas_idcreditoVentas,cuotas.fecha, cuotas.numpago,ventas.clientes_idclientes,ventas.idventas,ventas.idegreso,ventas.nombre,ventas.moneda FROM cuotas,creditoventas,ventas  WHERE  (cuotas.fecha  BETWEEN '".$f1."' AND '".$f2."') AND cuotas.creditoVentas_idcreditoVentas=creditoVentas.idcreditoVentas AND creditoVentas.ventas_idventas=ventas.idventas";
			$res=$db->query($sql)->fetchAll();

			return ($res);
					}

							public function getCuotasCredito($idcredito){

				 global $db;
				$sql="SELECT   cuotas.idcuotas,cuotas.saldo_inicial,cuotas.saldo_actual,cuotas.creditoVentas_idcreditoVentas,cuotas.fecha, cuotas.numpago FROM cuotas WHERE  cuotas.creditoVentas_idcreditoVentas='".$idcredito."'";
				$res=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

				return ($res);
						}

						public function borrarPorCredito($idcredito){

				 global $db;
				$sql="DELETE FROM cuotas WHERE   creditoVentas_idcreditoVentas='".$idcredito."'";
				$res=$db->query($sql);

				return ($res);
						}




	}

	?>
