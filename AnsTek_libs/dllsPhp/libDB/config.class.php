<?php
// clase para la configuracion de la base de datos.
/* esta clase esta construida bajo el patron de desarrollo singleton, 
 que evita que una clase sea instanciada mas de una vez, es decir si la 
 clase ya fue instanciada y aun esta viva, y otra persona desea crear una nueva 
 instancia lo que se hace es que se le comparte la instancia existente.
*/

class Config
{
	//private $_dominio;
	private $_userDB;
	private $_passDB;
	private $_hostDB;
	private $_db; 
	private $_motorDB;
	
	// atributo que controla la instancia de la clase
	private static $_instancia;
	
	// el modificador de acceso se hace privado para evitar que la clase sea instanciada mediante la palabra 
	// reservada new.
	private function __construct()
	{
		require 'configDB.php';
		$this->_userDB = $dataBase['user'];
		$this->_passDB = $dataBase['pass'];
		$this->_hostDB = $dataBase['host'];	
		$this->_db = $dataBase['baseDatos'];
		$this->_motorDB = $dataBase['motorDB'];
	} 
	
	// evitamos la clonacion del objeto
	private function __clone(){}
	private function __wakeup(){}
	
	// funcion encargada de instanciar el objeto
	public static function getInstance()
	{
		if(!(self::$_instancia instanceof self))
			self::$_instancia = new self();
		return self::$_instancia;
	}
	
	// funciones para obtener informacion de los parametros de la conexion.
	public function getHostDB() { return $this->_hostDB; }
	public function getUserDB() { return $this->_userDB; }
	public function getPassDB() { return $this->_passDB; }
	public function getDB() { return $this->_db; }
	public function getMotorDB() { return $this->_motorDB; }
}