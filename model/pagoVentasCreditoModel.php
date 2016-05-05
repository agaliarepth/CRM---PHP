<?php
//require_once("../helpers/conexion.php");
class pagoVentasCredito{
	static $tabla="pagoVentasCredito";
	static $idTabla="idpagoVentasCredito";
	static $objeto;
	static $lastId;

	public  $monto;
	public  $fecha;
	public  $numfactura;
	public  $idventas;
	public  $tipopago;
	public  $numrecibo;
	public  $cuentabanco;
	public  $cliente;
	public  $numcuota;
	public  $cuotas_idcuotas;
	public  $deudas_iddeudas;
	public  $moneda;
	public  $valorcambio;
	public  $referencia;
	public  $idcliente;
	public  $terminado;








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

				 public function  getId($id){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
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

				$res=$db->query($sql);

				self::$lastId=$db->lastID("idpagoVentasCredito");
				return $res;
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

		public function numpagos($idcredito){

							global $db;
				$sql="SELECT count(numpagos) FROM ".self::$tabla." WHERE creditoVentas_idcreditoVentas='".$idcredito."'";
				$res=$db->query->fetchColumn();

				return ($res);
		}

		public function updateTerminado($id,$valor){

							global $db;
				$sql="UPDATE ".self::$tabla." SET terminado='".$valor."' WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
		}

				public function   kardexCliente($idcliente,$anio,$referencia){
				 global $db;
				$sql="SELECT idpagoVentasCredito,numrecibo,moneda,cuentabanco,tipopago,numfactura,monto,numcuota,idventas,moneda,fecha FROM pagoventascredito WHERE YEAR(fecha)='".$anio."' AND idcliente='".$idcliente."' AND referencia='".$referencia."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}


					public function   kardexCliente2($idcliente,$anio){
				 global $db;
				$sql="SELECT pagoventascredito.idpagoVentasCredito,pagoventascredito.numrecibo,pagoventascredito.cuentabanco,pagoventascredito.tipopago,pagoventascredito.numfactura,pagoventascredito.monto,pagoventascredito.numcuota,pagoventascredito.idventas,pagoventascredito.moneda,pagoventascredito.fecha ,deudas.descripcion FROM pagoventascredito, deudas WHERE YEAR(pagoventascredito.fecha)='".$anio."' AND pagoventascredito.idcliente='".$idcliente."' AND  pagoventascredito.deudas_iddeudas=deudas.iddeudas";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

		public function listaPagos($anio,$idcliente,$moneda){

					 global $db;

				$sql="SELECT  idpagoVentasCredito,monto  FROM pagoventascredito WHERE   (YEAR(fecha) between 1990 AND '".$anio."') AND moneda='".$moneda."' AND idcliente='".$idcliente."' AND terminado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function sumarPagosVenta($mes,$anio,$moneda,$idventa){

					 global $db;

				$sql="SELECT SUM(monto) as  total   FROM pagoventascredito WHERE  (fecha BETWEEN '2000-01-01' AND '".$f."') AND moneda='".$moneda."' AND idventas='".$idventa."' AND terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
					}
					public function sumarPagosVenta2($mes,$anio,$moneda,$idventa){

					 global $db;

				$sql="SELECT SUM(monto) as  total   FROM pagoventascredito WHERE  MONTH(fecha)='".$mes."'  AND YEAR(fecha)='".$anio."'AND moneda='".$moneda."' AND idventas='".$idventa."' AND terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
					}

					public function sumarPagosDeuda($mes,$anio,$iddeuda){

					 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT SUM(monto) as  total   FROM pagoventascredito WHERE  (fecha BETWEEN '2000-01-01' AND '".$f."')AND deudas_iddeudas='".$iddeuda."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}
					public function sumarPagosCuotas($mes,$anio,$idcuota){

					 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT SUM(monto) as  total   FROM pagoventascredito WHERE  (fecha BETWEEN '2000-01-01' AND '".$f."')AND cuotas_idcuotas='".$idcuota."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}
					public function listarPagosMesDeuda($mes,$anio,$iddeuda){

					 global $db;

				$sql="SELECT monto , idpagoVentasCredito  ,fecha ,numrecibo FROM pagoventascredito WHERE            MONTH(fecha)='".$mes."'AND YEAR(fecha)='".$anio."' AND deudas_iddeudas='".$iddeuda."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function listarPagosMesCuota($mes,$anio,$idcuota){

					 global $db;

				$sql="SELECT monto , idpagoVentasCredito  ,fecha,numrecibo,idventas  FROM pagoventascredito WHERE  MONTH(fecha)='".$mes."'AND YEAR(fecha)='".$anio."' AND cuotas_idcuotas='".$idcuota."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

						public function listaPagosDeudas($mes,$anio,$iddeuda){

					 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT idpagoVentasCredito  FROM pagoventascredito WHERE  (fecha BETWEEN '2000-01-01' AND '".$f."')AND deudas_iddeudas='".$iddeuda."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function listaPagosMesVentas($mes,$anio,$idvendedor){

					 global $db;

				$sql="SELECT DISTINCT  pagoVentasCredito.idventas,ventas.idegreso,ventas.nombre,ventas.fecha,ventas.moneda,ventas.total,ventas.tipoventa FROM pagoventascredito ,ventas WHERE month(pagoVentasCredito.fecha)='".$mes."'AND YEAR(pagoVentasCredito.fecha)='".$anio."' and referencia='credito' AND pagoVentasCredito.idventas=ventas.idventas AND  ventas.idvendedores='".$idvendedor."' ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function listaPagosMesDeudasVendedor($mes,$anio,$idvendedor){

					 global $db;

				$sql="SELECT  pagoVentasCredito.deudas_iddeudas,pagoVentasCredito.monto,pagoVentasCredito.numrecibo,pagoVentasCredito.idpagoVentasCredito,deudas.descripcion,deudas.nombre_cliente,deudas.fecha,deudas.fechavencimiento,deudas.saldo_inicial,deudas.saldo_actual,deudas.clientes_idclientes,deudas.moneda,deudas.dias_credito,deudas.numcuotas,deudas.saldo,deudas.comision,deudas.idvendedores FROM pagoventascredito ,deudas WHERE month(pagoVentasCredito.fecha)='".$mes."'AND YEAR(pagoVentasCredito.fecha)='".$anio."' and referencia='deuda' AND pagoVentasCredito.deudas_iddeudas=deudas.iddeudas AND  deudas.idvendedores='".$idvendedor."' ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}


					public function listaPagosMesVentas2($mes,$anio,$idventas){

					 global $db;

				$sql="SELECT pagoVentasCredito.idpagoVentasCredito,pagoVentasCredito.idventas,pagoVentasCredito.monto,pagoVentasCredito.numrecibo,ventas.moneda FROM pagoventascredito ,ventas WHERE month(pagoVentasCredito.fecha)='".$mes."'AND YEAR(pagoVentasCredito.fecha)='".$anio."' and referencia='credito' AND pagoVentasCredito.idventas=ventas.idventas  AND  pagoVentasCredito.idventas='".$idventas."'  ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function listaPagosCuotas($mes,$anio,$idcuota){

					 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT idpagoVentasCredito  FROM pagoventascredito WHERE  (fecha BETWEEN '2000-01-01' AND '".$f."')AND cuotas_idcuotas='".$idcuota."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function listaPagosCuotas2($idcuota){

					 global $db;

				$sql="SELECT idpagoVentasCredito,monto FROM pagoventascredito WHERE  cuotas_idcuotas='".$idcuota."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function listarTodosMes($mes,$anio){

					 global $db;
					 $f=$anio."-".$mes."-31";
				$sql="SELECT * FROM pagoventascredito WHERE  Month(fecha)='".$mes."' AND Year(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function listarTodosRango($f1,$f2){

					 global $db;
					
				$sql="SELECT * FROM pagoventascredito WHERE (fecha BETWEEN '".$f1."' AND '".$f2."')";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
	}

	?>
