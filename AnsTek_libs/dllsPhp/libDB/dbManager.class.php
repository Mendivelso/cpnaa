<?php



include_once("config.class.php");







// desarrollado por ANSTEK S.A.S



class dbManager



{



	private $host;



	private $user;



	private $pass;



	private $base_datos;



	private $motor;



	private $DB;



	private $result;



	private $arrayDatos;







	private static $_instancia;







	/*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/



	private function __construct()



	{



		$this->setConexion();



		$this->conectar();



	}







	/*Metodo para establecer los parámetros de la conexión*/



	private function setConexion()



	{



		$conf = Config::getInstance();



		$this->host=$conf->getHostDB();



		$this->user=$conf->getUserDB();



		$this->pass=$conf->getPassDB();



		$this->base_datos=$conf->getDB();



		$this->motor=$conf->getMotorDB();



	}







	/*Evitamos el clonaje del objeto. Patrón Singleton*/



	private function __clone(){}



	private function __wakeup(){}







   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde



   fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/



	public static function getInstance()



	{



		if (!(self::$_instancia instanceof self))



			self::$_instancia=new self();



		return self::$_instancia;



	}







	/*Realiza la conexión a la base de datos utilizando PDO.*/



	private function conectar()



	{



		switch ($this->motor)



		{



			case 'mysql':



				try



				{



					$this->DB = new PDO('mysql:host='.$this->host.'; dbname='.$this->base_datos.';charset=utf8', $this->user, $this->pass);



					$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



					$this->DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);



				} catch (PDOExeption $e)



				{



					echo $e->getMessage();



					die();



				}



			break;



		}



	}







	/**



	 * Método para ejecutar una sentencia select de sql



	 */



	public function ejecutar($sql)



	{



		switch ($this->motor)



		{



			case 'mysql':



				$this->result = $this->DB->query($sql);



			break;



		}



		return $this->result;



	}







	/**



	 * Ingresa datos a la BD



	 * @param $data: Informacion a ingresar, tipo array



	 * @param $table: Tabla a la cual se ingresar� la informaci�n



	 */



	public function insertData($data,$table){



		//Prerara el Insert



		$dat = substr($this->prepareDat($data), 0, strlen($this->prepareDat($data))- 1);



		$cmp = str_replace(":", "", $dat);







		$sql = "INSERT INTO ".$table." (".$cmp.") VALUES (".$dat.")";



		//echo $sql;







		$result = $this->DB->prepare($sql);



		if($result->execute($data)){



			return true;



		}



		else{



			return false;



		}



	}







	/**



	 * Ingresa datos a la BD



	 * @param $data: Informacion a ingresar, tipo array



	 * @param $where: condición del registro a modificar



	 * @param $table: Tabla a la cual se ingresar� la informaci�n



	 */



	public function updateData($data,$where,$table){



		$set = substr($this->prepareDat($data,1), 0, strlen($this->prepareDat($data,1))- 2);







		if(strpos($where,'where') === false)



			$where = "WHERE ".$where;







		$sql = "UPDATE ".$table." SET ".$set."  ".$where;



		//echo $sql;






		$result = $this->DB->prepare($sql);



		if($result->execute()){



			return true;



		}



		else{



			return false;



		}



	}







	/**



	 * Elimina datos a la BD



	 * @param $table: Tabla de la cual se eliminará la informaci�n



	 * @param $idDel: id(s) a eliminar, tipo array



	 */



	public function deleteData($table,$idDel){



		$sql = "DELETE FROM ".$table." WHERE id in(".$idDel.")";



		//echo $sql;



		$result = $this->DB->prepare($sql);



		if($result->execute()){



			return true;



		}



		else{



			return false;



		}



	}







	/*Metodo para obtener una fila de resultados de la sentencia sql*/



	public function datos($result)



	{



		switch ($this->motor)



		{



			case 'mysql':



				$this->arrayDatos = $result->fetch(PDO::FETCH_ASSOC);



			break;



		}



		return $this->arrayDatos;



	}







	/**



	 * Retorna el numero de resultados de una consulta



	 * @param $result



	 */



	public function numRows($result) {



		return $result !== false;



	}







	/**



	 * Trae el ultimo registro ingresado a la tabla



	 * @param $table: Nombre de la tabla a consultar



	 * @param $pref: Prefijo de la tabla a utilizar



	 */



	public function lastInsert(){



		$id = 0;



		switch ($this->motor)



		{



			case 'mysql':



				$id = $this->DB->lastInsertId();



			break;



		}



		return $id;



	}







	/**



	 *  prepara los datos a enviar a la db en insert a la base de datos



	 */



	private function prepareDat($dat, $accion=0){



		//Acción: 0 = Realiza Insert, 1 = Realiza Update



		$out = '';



		foreach($dat as $k => $v){



			if ($accion==0) {



				//Prepara Insert



				if(preg_match("/^[A-Za-z0-9]+\((.*)\)$/",$v)){



				$out .= ':'.$k;



				}



				else{



					$out .= ":".$k;



				}



				if($k < count($dat) - 1){



					$out .= ',';



				}



			}



			else{



				//Prepara Update



				if(preg_match("/^[A-Za-z0-9]+\((.*)\)$/",$data[$i])){



					$out .= $k." = ".$v;



				}



				else{



					$out .= $k." = '".$v."'";



				}



				if($k < count($dat) - 1){



					$out .= ', ';



				}



			}



		}



		return $out;



	}



}



