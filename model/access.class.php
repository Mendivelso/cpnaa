<?php
	class access{
		/**
		* Almacena la conexion a la base de datos
		*/
		private $db;
		/**
		* Tabla de donde se obtienen los datos
		*/
		private $table;
		/**
		* Constructor.
		* @param string db cadena de conexion de la DB
		*/
		public function __construct($db){
			$this->db = $db;
			$this->table = "usuarios";
		}
		/**
		 * Verifica usuario en base de datos
		 * en el sistema, el usuario debe estar activo.
		 * @param string $user toma el user que quiere acceder
		 * @param string $pass toma el pass que quiere acceder
		 */
		public function login($user, $pass){
			$sql = "SELECT Id, Nombre, Cedula, Direccion, Telefono, Perfil, Foto, firma_pacto
					FROM ".$this->table ." WHERE Usuario = '".$user."' AND Password = '".$pass."' and Status = 1";
					//echo $sql;
			$result = $this->db->ejecutar($sql);
			if($this->db->numRows($result)){
				return $result;
			}
			else{
				return false;
			}
		}

		/**
		 * Verifica usuario en base de datos tipo usuario
		 * en el sistema, el usuario debe estar activo.
		 * @param string $user toma el user que quiere acceder
		 * @param string $pass toma el pass que quiere acceder
		 */
		public function loginUser($user, $pass){
			$sql = "SELECT Id, Nombre, Cedula, Direccion, Telefono, Perfil
					FROM ".$this->table ." WHERE Usuario = '".$user."' AND Password = '".$pass."' and Status = 1 and Perfil = 2";
					//echo $sql;
			$result = $this->db->ejecutar($sql);
			if($this->db->numRows($result)){
				return $result;
			}
			else{
				return false;
			}
		}

		/**
		 * edita datos de la BD
		 * @param array campos a editar
		 * @param array Informacion a ingresar
		 * @param string condicion where del query
		 */
		public function RememberPass($data,$where){
			$result = $this->db->updateData($data,$where,$this->table);
			if($result){
				return true;
			}
			else{
				return false;
			}
		}
		/**
		 * Genera pasword aleatorio
		 * @param int longitud de la cadena
		 * @param bolean si se desean caracteres especiales
		 * @param bolean si se desean números dentro de la cadena
		 * @param bolean si se desean caracteres especiales
		 */
		public function randomPass($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
		{
	    $source = 'abcdefghijklmnopqrstuvwxyz';
	    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    if($n==1) $source .= '1234567890';
	    if($sc==1) $source .= '|@#~$%()=^*+&#91;&#93;{}-_';
	    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++)
        {
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
	    }
	    return $rstr;
		}
	}
?>