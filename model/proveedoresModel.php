<?php
require_once("helpers/resize.php");
class Proveedores {
	static $tabla="proveedores";
	static $objeto;
	static $idTabla="idproveedores";
	
	public  $nombre;
	public  $contacto;
	public  $direccion;
	public  $telf1;
	public  $telf2;
	public  $telf3;
	public  $rucnit;
	public  $email;
	public  $pais;
	public  $ciudad;
	public  $banco;
	public  $numcuenta;
	public  $tiempogracia;
	public  $condiciones;
	
	
  
  
	
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
					 public   function getNombre($id){
				global $db;
				$sql="SELECT nombre  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
				 public function   listarTodos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla;
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
				
				public function borrarFoto($dir){
					unlink($dir);
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
			public function autocompletar(){
					global $db;
					
				$sql="SELECT idproveedores, nombre FROM ".self::$tabla." ORDER BY idproveedores ASC";	
				$res=$db->query($sql)->fetchALL();
				return $res;
     
     
				}
	
	
				
	
	}