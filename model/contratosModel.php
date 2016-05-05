<?php
class Contrato {
	static $tabla="contratos";
	static $idTabla="idcontrato";
	static $objeto;
	static $lastId;
	
	
public $nombres; 	
public $apellidopaterno; 	
public $apellidomaterno; 	
public $edad; 	
public $ci;
public $expedidoci; 	
public $nit; 	
public $direccion;
public $dir_num; 	
public $telf; 	
public $cel; 	
public $barrio;
public $zona; 	
public $tipocasa; 	
public $tiempo_vive; 	
public $fechavigente;
public $nombrepropietariocasa; 	
public $detallecasa;
public $telfpropietario; 	
public $emailpropietario;
public $centrotrabajo; 	
public $cargoocupa; 	
public $antiguedad;
public $jefeinmediato; 	
public $direcciontrabajo; 	
public $numtrabajo;
public $telftrabajo; 	
public $barriotrabajo; 	
public $zonatrabajo;
public $ingreso; 	
public $otrosingresos; 	
public $totalingresos; 	
public $nombrepareja; 	
public $cipareja; 	
public $celpareja;
public $trabajopareja; 	
public $cargopareja; 	
public $antiguedadpareja;
public $dirtrabajopareja; 	
public $numdirtrabajopareja; 	
public $telftrabajopareja;
public $barriotrabajopareja; 	
public $zonatrabajopareja;
public $nombrehijos1; 	
public $colegiohijos1; 	
public $cursohijos1; 	
public $zonahijos1;
public $nombrehijos2; 	
public $colegiohijos2; 	
public $cursohijos2; 	
public $zonahijos2;
public $otrasref; 	
public $nombregarante; 	
public $cigarante; 	
public $expedidogarante;
public $dirgarante; 	
public $numgarante; 	
public $telfgarante; 	
public $celgarante; 	
public $barriogarante;
public $zonagarante; 	
public $trabajogarante; 	
public $cargogarante; 	
public $antiguedadgarante;
public $dirtrabajogarante; 	
public $numtrabajogarante; 	
public $tel_trabajogarante;
public $barriotrabajogarante; 	
public $zonatrabajogarante; 	
public $numcontrato;
public $numcuentacontratoss; 	
public $localidadcontrato; 	
public $fechacontrato; 	
public $preciototal;
public $cuotainicial; 	
public $saldo; 	
public $numpagos; 	
public $montopagos; 	
public $nombrevendedor; 	
public $idvendedor; 	
public $idcliente; 	
public $idcobrador; 	
public $idusuarios; 	
public $nombrecobrador; 	
public $diacobrar; 	
public $horascobrar; 	
public $observaciones; 	
public $numrecibo; 	
public $numreporte; 	
public $tipocontrato; 	
public $lugarcobranza; 	
public $fecharecibo;
public $carnetcobrador; 	
public $montorecibo;
public $valorcomisionable;
public $porcentajecomision; 	
public $montocomision;
public $terminado;
public $supervisor;


  
	
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
				 public function   listarTodosDiferidos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where tipocontrato='DIFERIDO' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				 public function   listarTodosNulos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where tipocontrato='Anulado' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				 public function   listarTodosVentas1(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where tipocontrato='VENTA' OR tipocontrato='CUENTA' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				 public function   listarTodosVentas2(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where tipocontrato='VENTA' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}

			public function nuevo(){
				global $db;
				
				
			    $this->get_objeto();

				$sql="INSERT INTO `contratos` (`idcontrato`, `nombres`, `apellidopaterno`, `apellidomaterno`, `edad`, `ci`, `expedidoci`, `nit`, `direccion`, `dir_num`, `telf`, `cel`, `barrio`, `zona`, `tipocasa`, `tiempovive`, `fechavigente`, `nombrepropietariocasa`, `detallecasa`, `telfpropietario`, `emailpropietario`, `centrotrabajo`, `cargoocupa`, `antiguedad`, `jefeinmediato`, `direcciontrabajo`, `numtrabajo`, `telftrabajo`, `barriotrabajo`, `zonatrabajo`, `ingreso`, `otrosingresos`, `totalingresos`, `nombrepareja`, `cipareja`, `celpareja`, `trabajopareja`, `cargopareja`, `antiguedadpareja`, `dirtrabajopareja`, `numdirtrabajopareja`, `telftrabajopareja`, `barriotrabajopareja`, `zonatrabajopareja`, `nombrehijos1`, `colegiohijos1`, `cursohijos1`, `zonahijos1`, `nombrehijos2`, `colegiohijos2`, `cursohijos2`, `zonahijos2`, `otrasref`, `nombregarante`, `cigarante`, `expedidogarante`, `dirgarante`, `numgarante`, `telfgarante`, `celgarante`, `barriogarante`, `zonagarante`, `trabajogarante`, `cargogarante`, `antiguedadgarante`, `dirtrabajogarante`, `numtrabajogarante`, `telftrabajogarante`, `barriotrabajogarante`, `zonatrabajogarante`, `numcontrato`, `numcuentacontrato`, `localidadcontrato`, `fechacontrato`, `preciototal`, `cuotainicial`, `saldo`, `numpagos`, `montopagos`, `nombrevendedor`, `idvendedor`, `idcliente`, `idcobrador`, `idusuarios`, `nombrecobrador`, `diacobrar`, `horascobrar`, `observaciones`, `numrecibo`, `numreporte`, `tipocontrato`, `lugarcobranza`, `fecharecibo`,`carnetcobrador`, `montorecibo`, `valorcomisionable`,`porcentajecomision`, `montocomision`,`terminado`,`supervisor`) VALUES (
NULL, '$this->nombres', '$this->apellidopaterno', '$this->apellidomaterno', '$this->edad', '$this->ci', '$this->expedidoci', '$this->nit', '$this->direccion', '$this->dir_num', '$this->telf', '$this->cel', ' $this->barrio', ' $this->zona', '$this->tipocasa', ' $this->tiempovive', ' $this->fechavigente', '$this->nombrepropietariocasa', '$this->detallecasa', '$this->telfpropietario', '$this->emailpropietario', '$this->centrotrabajo', '$this->cargoocupa', '$this->antiguedad', '$this->jefeinmediato', '$this->direcciontrabajo', '$this->numtrabajo', '$this->telftrabajo', '$this->barriotrabajo', '$this->zonatrabajo', '$this->ingreso', '$this->otrosingresos', '$this->totalingresos', '$this->nombrepareja', '$this->cipareja', '$this->celpareja', '$this->trabajopareja', '$this->cargopareja', '$this->antiguedadpareja', '$this->dirtrabajopareja', '$this->numdirtrabajopareja', '$this->telftrabajopareja', '$this->barriotrabajopareja', '$this->zonatrabajopareja', '$this->nombrehijos1', '$this->colegiohijos1', '$this->cursohijos1', '$this->zonahijos1', '$this->nombrehijos2', '$this->colegiohijos2', '$this->cursohijos2', '$this->zonahijos2', '$this->otrasref', '$this->nombregarante', '$this->cigarante', '$this->expedidogarante', '$this->dirgarante', '$this->numgarante', '$this->telfgarante', '$this->celgarante', '$this->barriogarante', '$this->zonagarante', '$this->trabajogarante', '$this->cargogarante', '$this->antiguedadgarante', '$this->dirtrabajogarante', '$this->numtrabajogarante', '$this->telftrabajogarante', '$this->barriotrabajogarante', '$this->zonatrabajogarante', '$this->numcontrato', '$this->numcuentacontrato', '$this->localidadcontrato', '$this->fechacontrato', '$this->preciototal', '$this->cuotainicial', '$this->saldo', '$this->numpagos', '$this->montopagos', '$this->nombrevendedor', '$this->idvendedor', '$this->idcliente', '$this->idcobrador', '$this->idusuarios', '$this->nombrecobrador', '$this->diacobrar', '$this->horascobrar', '$this->observaciones', '$this->numrecibo', '$this->numreporte', '$this->tipocontrato', '$this->lugarcobranza', '$this->fecharecibo', '$this->carnetcobrador', '$this->montorecibo','$this->valorcomisionable', '$this->porcentajecomision', '$this->montocomision','$this->terminado','$this->supervisor');";
				
			
		
				$db->query($sql);
				self::$lastId=$db->lastID("idcontrato"); 
				//return  $sql;
				
				}	
				
				
			public  function actualizar($id){
				global $db;
				$this->get_objeto();
				
				 
				$sql ="UPDATE `contratos` SET `nombres` = '$this->nombres', `apellidopaterno` = '$this->apellidopaterno', `apellidomaterno` = '$this->apellidomaterno', `edad` = '$this->edad', `ci` = '$this->ci', `expedidoci` = '$this->expedidoci', `nit` = '$this->nit', `direccion` = '$this->direccion', `dir_num` = '$this->dir_num', `telf` = '$this->telf', `cel` = '$this->cel', `barrio` = ' $this->barrio', `zona` = '$this->zona', `tipocasa` = '$this->tipocasa', `tiempovive` = '$this->tiempovive', `fechavigente` = '$this->fechavigente', `nombrepropietariocasa` = '$this->nombrepropietariocasa', `detallecasa` = '$this->detallecasa', `telfpropietario` = '$this->telfpropietario', `emailpropietario` = '$this->emailpropietario', `centrotrabajo` = '$this->centrotrabajo', `cargoocupa` = '$this->cargoocupa', `antiguedad` = '$this->antiguedad', `jefeinmediato` = '$this->jefeinmediato', `direcciontrabajo` = '$this->direcciontrabajo', `numtrabajo` = '$this->numtrabajo', `telftrabajo` = '$this->telftrabajo', `barriotrabajo` = 'barriotrabajo', `zonatrabajo` = '$this->zonatrabajo', `ingreso` = '$this->ingreso', `otrosingresos` = '$this->otrosingresos', `totalingresos` = '$this->totalingresos', `nombrepareja` = '$this->nombrepareja', `cipareja` = '$this->cipareja', `celpareja` = '$this->celpareja', `trabajopareja` = 'trabajopareja', `cargopareja` = 'cargopareja', `antiguedadpareja` = '$this->antiguedadpareja', `dirtrabajopareja` = '$this->dirtrabajopareja', `numdirtrabajopareja` = '$this->numdirtrabajopareja', `telftrabajopareja` = '$this->telftrabajopareja', `barriotrabajopareja` = '$this->barriotrabajopareja', `zonatrabajopareja` = '$this->zonatrabajopareja', `nombrehijos1` = '$this->nombrehijos1', `colegiohijos1` = '$this->colegiohijos1', `cursohijos1` = '$this->cursohijos1', `zonahijos1` = '$this->zonahijos1', `nombrehijos2` = '$this->nombrehijos2', `colegiohijos2` = '$this->colegiohijos2', `cursohijos2` = '$this->cursohijos2', `zonahijos2` = '$this->zonahijos2', `otrasref` = '$this->otrasref', `nombregarante` = '$this->nombregarante', `cigarante` = '$this->cigarante', `expedidogarante` = '$this->expedidogarante', `numgarante` = '$this->numgarante',`dirgarante` = '$this->dirgarante', `telfgarante` = '$this->telfgarante',`antiguedadgarante` = '$this->antiguedadgarante',`celgarante` = '$this->celgarante', `barriogarante` = '$this->barriogarante', `zonagarante` = '$this->zonagarante', `trabajogarante` = '$this->trabajogarante', `cargogarante` = '$this->cargogarante', `dirtrabajogarante` = '$this->dirtrabajogarante', `numtrabajogarante` = '$this->numtrabajogarante', `telftrabajogarante` = '$this->telftrabajogarante', `barriotrabajogarante` = '$this->barriotrabajogarante', `zonatrabajogarante` = '$this->zonatrabajogarante', `numcontrato` = '$this->numcontrato', `numcuentacontrato` = '$this->numcuentacontrato', `localidadcontrato` = '$this->localidadcontrato', `fechacontrato` = '$this->fechacontrato', `preciototal` = '$this->preciototal', `cuotainicial` = '$this->cuotainicial',  `saldo` = '$this->saldo',
`numpagos` = '$this->numpagos',
`montopagos` = '$this->montopagos',
`nombrevendedor` = '$this->nombrevendedor',
`idvendedor` = '$this->idvendedor',
`idcliente` = '$this->idcliente',
`idcobrador` = '$this->idcobrador',
`idusuarios` = '$this->idusuarios',
`nombrecobrador` = '$this->nombrecobrador',
`diacobrar` = '$this->diacobrar',
`horascobrar` = '$this->horascobrar',
`observaciones` = '$this->observaciones',
`numrecibo` = '$this->numrecibo',
`numreporte` = '$this->numreporte',
`tipocontrato` = '$this->tipocontrato',
`lugarcobranza` = '$this->lugarcobranza',
`fecharecibo` = '$this->fecharecibo',
`carnetcobrador` = '$this->carnetcobrador',
`montorecibo` = '$this->montorecibo',
`valorcomisionable` = '$this->valorcomisionable',
`valorcomisionable` = '$this->valorcomisionable',
`porcentajecomision` = '$this->porcentajecomision',
`montocomision` = '$this->montocomision' WHERE `contratos`.`idcontrato` ='".$id."'";
				$db->query($sql);
				
				}
				
				
				public  function actualizarVenta($id,$numcuenta,$numrecibo,$numreporte,$montorecibo,$fecharecibo,$idcobrador,$nombrecobrador,$carnetcobrador){
				global $db;
				$this->get_objeto();
				
				 
				$sql ="UPDATE `contratos` SET `numcuentacontrato` = '".$numcuenta."', `numrecibo` = '".$numrecibo."', `numreporte`='".$numreporte."' ,`montorecibo`='".$montorecibo."',`fecharecibo`='".$fecharecibo."',`idcobrador`='".$idcobrador."',`nombrecobrador`='".$nombrecobrador."',`carnetcobrador`='".$carnetcobrador."',`tipocontrato`='VENTA' WHERE `contratos`.`idcontrato` ='".$id."'";
				$db->query($sql);
				}
				
				
				public  function borrarVenta($id){
				global $db;
				$this->get_objeto();
				
				 
				$sql ="UPDATE `contratos` SET `numcuentacontrato` = '', `numrecibo` = '', `numreporte`='' ,`montorecibo`='',`fecharecibo`='',`tipocontrato`='DIFERIDO' WHERE `contratos`.`idcontrato` ='".$id."'";
				$db->query($sql);
				}
				
				public  function updateEstado($id,$estado){
				global $db;
				$this->get_objeto();
				
				 
				$sql ="UPDATE `contratos` SET `tipocontrato`='".$estado."' WHERE `contratos`.`idcontrato` ='".$id."'";
				$db->query($sql);
				}
				
				public  function updateTerminado($id,$terminado){
				global $db;
				$this->get_objeto();
				
				 
				$sql ="UPDATE `contratos` SET `terminado`='".$terminado."' WHERE `contratos`.`idcontrato` ='".$id."'";
				$db->query($sql);
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
				public   function getAsignaciones($id){
				global $db;
				$sql="SELECT diacobrar,montopagos FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
				  public   function getContratosVendidosFecha($mes, $anio,  $orden){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'  AND tipocontrato!='DIFERIDO' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				  public   function getContratosDiferidosFecha($mes, $anio,$orden){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato='DIFERIDO'    ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
					  public   function getContratosDiferidosFecha1($mes, $anio,$orden,$id){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato='DIFERIDO'  AND idcontrato='".$id."'    ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				  public   function getContratosVendidosFecha1($mes, $anio,$orden,$id){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato!='DIFERIDO'  AND idcontrato='".$id."'    ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				  public   function getContratosVendidosCobrador($mes, $anio,  $orden,$idcobrador){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'  AND tipocontrato!='DIFERIDO' AND idcobrador='".$idcobrador."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				  public   function getContratosVendidosVendedor($mes, $anio,$orden, $idvendedor){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato!='DIFERIDO' and idvendedor='".$idvendedor."'   ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				  public   function getContratosDiferidosCobrador($mes, $anio,  $orden,$idCobrador){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'  AND tipocontrato='DIFERIDO' AND idcobrador='".$idcobrador."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				  public   function getContratosDiferidosVendedor($mes, $anio,$orden,$idvendedor){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte FROM ".self::$tabla." WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato='DIFERIDO'   and idvendedor='".$idvendedor."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
				
				public function getMesVendidos($mes,$anio){
					
					global $db;
				$sql="SELECT idcontrato  FROM ".self::$tabla." WHERE  (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}
					
					public function getMesVendidos2($fecha){
					
					global $db;
				$sql="SELECT idcontrato  FROM ".self::$tabla." WHERE  (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND fecharecibo between '2013-1-1' AND '".$fecha."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}
					
					public function kardexMayorTotal($mes,$anio){
					
					global $db;
				$sql="SELECT DISTINCT detalle_contrato.codigo ,detalle_contrato.libros_idlibros FROM `detalle_contrato`, contratos WHERE  detalle_contrato.contratos_idcontratos=contratos.idcontrato AND  (contratos.tipocontrato='CUENTA' or contratos.tipocontrato='VENTA') AND MONTH(contratos.fecharecibo)='".$mes."' AND  YEAR(contratos.fecharecibo)='".$anio."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}
					
						
						public function reporteAsignaciones($id){
					
					global $db;
				$sql="SELECT diacobrar,montopagos FROM ".self::$tabla." WHERE idcontrato='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
					
						
				public function produccionDiaria($fecha){
					
					global $db;
				$sql="SELECT nombrevendedor, COUNT(numcuentacontrato) as cont,SUM(preciototal) as ptotal,SUM(valorcomisionable) as comision, SUM(cuotainicial) as cuota FROM contratos GROUP BY nombrevendedor,fecharecibo,tipocontrato HAVING (tipocontrato='VENTA' or tipocontrato='CUENTA') AND fecharecibo='".$fecha."'"; 
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}	
						
						
				public function produccionMensual($idVendedor){
					
					global $db;
				$sql="SELECT contratos.nombres,contratos.apellidopaterno,contratos.apellidomaterno,contratos.numcuentacontrato,contratos.numcontrato,contratos.preciototal,contratos.cuotainicial,contratos.valorcomisionable,contratos.porcentajecomision,contratos.montocomision,contratos.nombrevendedor,contratos.idcontrato  FROM `contratos` WHERE (tipocontrato='VENTA' OR tipocontrato='CUENTA')AND contratos.idvendedor='".$idVendedor."'"; 
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}			
							
				
			public function getVendedoresProduccion($mes ,$anio){
					
					global $db;
				$sql="SELECT distinct contratos.idvendedor FROM `contratos` WHERE (tipocontrato='VENTA' OR tipocontrato='CUENTA')AND MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					
					}				
			
	           public function getNumCuenta(){
				   	global $db;
				$sql="SELECT max(numcuentacontrato) as num FROM `contratos` ";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
				   
				   }
				   
				   	public function getContratosContado($mes,$anio){
					
					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuentacontrato)as cuentas FROM `contratos` WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numpagos=0) AND saldo=0 and MONTH(fecharecibo)='".$mes."' and YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
						public function getContratosDosPagos($mes,$anio){
					
					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuentacontrato)as cuentas FROM `contratos` WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and numpagos=1 AND MONTH(fecharecibo)='".$mes."' and YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
					public function getContratosCuatroPagos($mes,$anio){
					
					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuentacontrato)as cuentas FROM `contratos` WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numpagos=2 or numpagos=3) AND MONTH(fecharecibo)='".$mes."' and YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
	public function getContratosSeisPagos($mes,$anio){
					
					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuentacontrato)as cuentas FROM `contratos` WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numpagos=4 or numpagos=5) AND MONTH(fecharecibo)='".$mes."' and YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
					public function getContratosOchoPagos($mes,$anio){
					
					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuentacontrato)as cuentas FROM `contratos` WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numpagos=6 or numpagos=7) AND MONTH(fecharecibo)='".$mes."' and YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
					public function getContratosDiezPagos($mes,$anio){
					
					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuentacontrato)as cuentas FROM `contratos` WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and numpagos=9 AND MONTH(fecharecibo)='".$mes."' and YEAR(fecharecibo)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					}
	
	}

	?>