<?php
//require_once("../helpers/conexion.php");

require_once("helpers/resize.php");
class Libros {
	static $tabla="libros";
	static $idTabla="idlibros";
	static $objeto;
	
	public  $codigo;
	public  $titulo;
	public  $stock;
	public  $stock_minimo;
	public  $foto;
	
	public $pv;
	public $cif;
	public $ps;
	public $tomo;
    public  $proveedores_idproveedores;
	public $categorias_idcategorias;
	
	

  
  
	
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
				$sql="SELECT * FROM ".self::$tabla." ORDER BY codigo asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				 public function   listarporCategorias($idcategorias){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where categorias_idcategorias='".$idcategorias."' ORDER BY  codigo ASC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
		    public function guardarFoto(){
				$ruta="";
				if($_FILES["logo"]["name"]==""){
					 $ruta=config::ruta()."images/fotos/libros/sinFoto.jpg";
					return $ruta;
					
					}
				
				else{
				copy($_FILES["logo"]["tmp_name"],"images/fotos/libros/".$_FILES["logo"]["name"]);
				
				
				
                $thumb=new SimpleImage();
				$thumb->load("images/fotos/libros/".$_FILES["logo"]["name"]);
				if ( ($_FILES["logo"]["type"]) != 'image/gif' ){//Si la imagen no es de tipo gif, y marcamos en el formulario como thumbnail
            $var_nuevo_archivo = time().rand().".jpg"; //asignamos un nombre aleatorio al nuevo archivo, para evitar sobreescritura
            $thumb->resize("80","80"); //redimensionamos la imagen, con los valores de ancho y alto que hemos especificado
        }
		else{ //sino
            $var_nuevo_archivo = time().rand().$_FILES["logo"]["name"]; //se agregará al nombre original de la imagen una serie de números aleatorios
        }
        $var_nuevo_archivo = strtolower(str_replace(' ', '_', $var_nuevo_archivo)); //reemplazamos los espacios en blanco con sub-guiones, para hacer más compatible el nombre del archivo
        $thumb->save("images/fotos/libros/".$var_nuevo_archivo); //guardamos los cambios efectuados en la imagen
        unlink("images/fotos/libros/".$_FILES["logo"]["name"]); //eliminamos del temporal la imagen que estabamos subiendo
		       
				$ruta="images/fotos/libros/".$var_nuevo_archivo;
			
				return $ruta;
				}
				
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
				
				public  function actualizarVentas($id,$foto,$pv){
				global $db;
				
				$sql="UPDATE ".self::$tabla." SET foto='".$foto."',pv='".$pv."'";
				
				$sql.=" WHERE ".self::$idTabla."='".$id."'";
				$db->query($sql);
				
				}
				
				public function borrarFoto($dir){
					@unlink($dir);
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
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					public function getStock($id){
						global $db;
				         $sql="SELECT stock FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."' LIMIT 1";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["stock"]);
						}
						
						public function getCodigoTitulo($id){
						global $db;
				         $sql="SELECT codigo, titulo FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
						}
						/*public function getStockReservado($id){
						global $db;
				         $sql="SELECT stock_reservado FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res["stock_reservado"]);
						}*/
						
						
						/*public function getStockDisponible($id){
						global $db;
				         $sql="SELECT stock_disponible FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res["stock_disponible"]);
						}*/
						
						
						
						public function sumarStock($id,$cantidad){
					 
						global $db;
						
							$sql="UPDATE ".self::$tabla." SET stock=stock+$cantidad WHERE ".self::$idTabla."='".$id."'";
	            if(!$db->query($sql))
				return false;
				
				else
				return true;	
				
										}
							
							
					public function reservar($id,$cantidad){
						$res=$this->getStockReservado($id);
					     $stock=$this->getStock($id);
						$dis=$this->getStockDisponible($id);
						
						$cant_reservado=$res+$cantidad;
						if($cant_reservado>$stock)
						$cant_reservado=$stock;
						$disponible=$stock-$cant_reservado;
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado='".$cant_reservado."'".", stock_disponible='".$disponible."'"." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql);
						}
						
						public function quitarStock($id,$cantidad){
						//$sr=$this->getStockReservado($id);
					     $stock=$this->getStock($id);
						//$dis=$this->getStockDisponible($id);
						
						// $cant_reservado=$sr-$cantidad;
						// if($cant_reservado<=0)
						// $cant_reservado=0;
						 
						$stockActual=$stock-$cantidad;
						if($stockActual<=0){
						$stockActual=0;
						
						}
						//$disponible=$stockActual-$cant_reservado;

						global $db;
				$sql="UPDATE ".self::$tabla." SET stock='".$stockActual."'"." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql);
						}
						
						public function reponerReserva($id,$cantidad){
						$res=$this->getStockReservado($id);
						$dis=$this->getStockDisponible($id);
					 $stock=$this->getStock($id);

						$sr=$res-$cantidad;
						$sd=$dis+$cantidad;
						if($sr<=0){
						$sr=0;
						$sd=$stock;
						}
						
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado='".$sr."'".", stock_disponible='".$sd."'"." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql);
						}
						
						
						
	  public function reponerStock($id,$cantidad){
				
						$dis=$this->getStockDisponible($id);
		                $stock=$this->getStock($id);

						$st=$stock+$cantidad;
						$sd=$dis+$cantidad;
										
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_disponible='".$sd."'".", stock='".$st."'"." WHERE ".self::$idTabla."='".$id."'" ;
						$res=$db->query($sql);
						}
	public function getCodigo($id){
						global $db;
				         $sql="SELECT codigo ,titulo FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res);
						}
	
	
	
	public function getLibroStock($id){
						global $db;
				         $sql="SELECT codigo ,titulo,tomo FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				      return $res;
						}
						
						public function getPrecios($id){
						global $db;
				         $sql="SELECT pv ,cif,ps FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				      return $res;
						}
						
						
				public function getLibrosCifTodos(){
						global $db;
				         $sql="SELECT idlibros,titulo,tomo,cif,codigo FROM ".self::$tabla;
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				      return $res;
						}		
						
	
	}
	//$thumb=new thumbnail();
/*$l=new Libros();
$l->sumarStock(2,10);*/
	?>