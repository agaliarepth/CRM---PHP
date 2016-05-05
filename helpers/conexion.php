<?php 

 class conexion{
	 
	private  $conn;
	private  $server="localhost";
    private  $pass="";
	private $name_db="visual";
	private $user="root";
		private $sql;
		
	public function __construct(){
		
		try{
			ini_set('memory_set',-1);
		$this->conn=new PDO("mysql:host=$this->server;dbname=$this->name_db",$this->user,$this->pass);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
		echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
                              	}
     public function query($sql){
	      $this->sql=$sql;	
		
		try{
			$res= $this->conn->query($this->sql);
		return $res;
		
		}
		catch(PDOException $e){
			
			echo "ERROR: ".$e->getMessage()."<br>".$this->sql;
             return false;
			
			}
				 }
				 
				 /* public function query($sql){
	      $this->sql=$sql;	
		$stmt = $this->conn->prepare($sql);
		
			
		
			$OK = $stmt->execute();
            $error = $stmt->errorInfo();
             if (!$OK) {
                echo $error[2];
                        }
						else{
							$res= $this->conn->query($this->sql);
							return $res;
							}
		
				 }*/
				 
				 
				 public function Execute($sql){
					 
					 $stmt = $this->conn->prepare($sql);
					 $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
		//$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();
		return $result;
					 
					 }
		 public function lastID($id){
			
			return $this->conn->lastInsertId($id);
			}
		 private function limpiar($sql){
                $magic	=get_magic_quotes_gpc();
				$aux=function_exists("mysql_real_escape_string");
				if($aux){
					if($magic){
						$sql=stripcslashes($sql);
						}
						$sql=mysql_real_escape_string($sql);
					
					}
				else{
					if(!$magic){
						$sql=addslashes($sql);
						}
					}	
					return $sql;
						 
			 
			 }
		 private function error(){
			 echo "ERROR de CONSULTA==>".$this->sql;
			 
			 }
	}
	
	$dataBase=new conexion();
	$db=$dataBase;
	//$sql="select / from libr";

	//echo gettype($db->query($sql)); 
  
?>