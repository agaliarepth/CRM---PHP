<?php
//require_once("../helpers/conexion.php");
class Ventas{
	static $tabla="ventas";
	static $idTabla="idventas";
	static $objeto;
	static $lastId;

	public  $total;
	public  $cantidad;
	public  $moneda;
	public $cambio;
	public $fecha;
	public $terminado;
	public $monto_descuento;
	public $usuario;
	public $estado;
    public $despachado;
	public $clientes_idclientes;
  	public $idegreso;
	public $transporte;
	public $nit;
	public $pais;
	public $telf;
    public $nombre;
	public $razonsocial;
	public $vendedor;
	public $ciudad;
	public $tipoventa;
	public $total_cancelar;
	public $tipo_desc;
	public $localidad;
	public $destino;
	public $obs;






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
			private function selectAll(){
        $this->get_objeto();

        $string=self::$idTabla.",";

        $string.=join(",",array_keys(self::$objeto));

        return($string);
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
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
					 public function   listarTodosMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

              public function   listarTodosRango($fecha1 ,$fecha2){
              global $db;
              $this->get_objeto();
              $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where   (fecha BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
              $res=$db->query($sql)->fetchAll();
              return ($res);

    }
				 public function   listarTodosCredito(){
				 global $db;
				$sql="SELECT ventas.idventas,ventas.fecha,ventas.nombre,ventas.terminado,ventas.total,ventas.estado,creditoVentas.saldo_inicial,creditoVentas.saldo_actual FROM ".self::$tabla." ,creditoVentas WHERE ventas.idventas=creditoVentas.ventas_idventas  ORDER BY idventas desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

				 public function   listarTodosContado(){
				 global $db;
				$sql="SELECT ventas.idventas,ventas.fecha,ventas.nombre,ventas.terminado,ventas.total,ventas.estado,ventasContado.numfactura,ventasContado.numingreso,ventasContado.monto,ventasContado.saldo FROM ".self::$tabla." ,ventasContado WHERE ventas.idventas=ventasContado.ventas_idventas  ORDER BY idventas desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
					 public function   listarTodosTerminado(){
				 global $db;
				$sql="SELECT ventas.idventas,ventas.fecha,ventas.nombre,ventas.terminado,ventas.total,ventas.estado, ventas.tipoventa,ventas.moneda,ventas.destino FROM ".self::$tabla."  WHERE terminado=1 AND estado='En Almacen'  ORDER BY idventas desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosTerminadoTipoVenta($tipo){
				 global $db;
				$sql="SELECT ventas.idventas,ventas.fecha,ventas.nombre,ventas.terminado,ventas.total,ventas.estado, ventas.tipoventa,ventas.moneda,ventas.destino FROM ".self::$tabla."  WHERE terminado=1 AND  despachado=1 AND tipoventa='".$tipo."' ORDER BY idventas desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				public function   listarTodosTerminadoDespachadoTodos(){
				global $db;
			 $sql="SELECT ventas.idventas,ventas.fecha,ventas.nombre,ventas.terminado,ventas.total,ventas.estado, ventas.tipoventa,ventas.moneda,ventas.destino FROM ".self::$tabla."  WHERE terminado=1 AND  despachado=1  ORDER BY idventas desc";
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

				self::$lastId=$db->lastID("idventas");

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

						public function terminado($id){

							global $db;
				$sql="UPDATE ".self::$tabla." SET terminado=1 , estado='En Almacen' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}

						public function anular($id){

							global $db;
				$sql="UPDATE ".self::$tabla." SET terminado=0 , estado='Sin Enviar' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}
							public function despachar($id,$idegreso){

							global $db;
				$sql="UPDATE ".self::$tabla." SET terminado=1 , despachado=1, estado='Despachado',idegreso='".$idegreso."' where ".self::$idTabla."='".$id."'";
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



	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}
				 public   function getMoneda($id){
				global $db;
				$sql="SELECT moneda,cambio,nombre,clientes_idclientes FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}
				 public   function getTotalVenta($id){
				global $db;
				$sql="SELECT total FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);

				}

				 public   function getFecha($id){
				global $db;
				$sql="SELECT fecha FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["fecha"]);

				}

				 public   function getTipoVenta($id){
				global $db;
				$sql="SELECT tipoventa FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["tipoventa"]);

				}
				public function validarCodigo($cod){

					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);

					}

						 public function   regVentas($mes,$anio){
				 global $db;
				$sql="SELECT *  FROM detalleventas_view WHERE YEAR(fecha)='".$anio."' AND  MONTH(fecha)='".$mes."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
					public function   regVentas2($mes,$anio,$idventa){
				 global $db;
				$sql="SELECT precio_total,precio_unit,cantidad,libros_idlibros,moneda,tipoventa,nombre,idventas,idegreso,total,clientes_idclientes  FROM detalleventas_view WHERE YEAR(fecha)='".$anio."' AND  MONTH(fecha)='".$mes."' AND idventas='".$idventa."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

					public function   regVentas3($idventa){
				 global $db;
				$sql="SELECT precio_total,precio_unit,cantidad,libros_idlibros,moneda,tipoventa,nombre,idventas,idegreso,total ,clientes_idclientes  FROM detalleventas_view WHERE  idventas='".$idventa."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
					public  function regVentasContar($idventa){
						global $db;
				$sql="SELECT count(idventas) as contar FROM detalleventas_view WHERE idventas ='".$idventa."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res["contar"]);

						}
						public function Kardexcliente($idcliente,$anio){

							 global $db;
				$sql="SELECT idventas,tipoventa, moneda FROM ".self::$tabla."  WHERE YEAR(fecha)='".$anio."' AND  clientes_idclientes='".$idcliente."' AND despachado=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
							}

				public function   getVentasMes($mes,$anio,$idvendedor,$tipo){
				 global $db;
				$sql="SELECT DISTINCT   idventas,vendedor,fecha,nombre,moneda,idegreso,clientes_idclientes,tipoventa,total FROM detalleventas_view WHERE YEAR(fecha)='".$anio."' AND  MONTH(fecha)='".$mes."' AND idvendedores='".$idvendedor."' AND despachado=1 and tipoventa='".$tipo."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}


	}

	?>
