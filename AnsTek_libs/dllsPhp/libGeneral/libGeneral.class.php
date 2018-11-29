<?php
	//*************** FUNCION PARA GENERAR PASSWORD ALEATORIO ***********************
	function generarPass($length = 8)
	{	// generamos un cadena aleatorio con las funciones rand que genera un valor 
		// aleatorio, luego hacemos uso de uniqid que genera un valor único basado
		// en la hora actual en microsegundos, y si a esto le añadimos el valor
		// true al segundo parametro, le dara mayor entropía al valor generado. 
		// Mediante md5 encriptamos el valor. Un valor de ejemplo generado con esta 
		// función: 38b70ba0.  
		$code = md5(uniqid(rand(), true));  
		if ($length != "") 
			return substr($code, 0, $length);  
		else 
			return $code;
	}
	//*******************************************************************************


	// **************** FUNCION PARA COMPROBAR ESTRUCTURA DE EMAIL *****************
	// Comprueba que la direccion de email que se esta enviando contenga la estructura
	// adecuada.
	function comprobarEmail($email)
	{
		$mail_correcto = 0;
		//compruebo unas cosas primeras
		if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
		   if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
			  //miro si tiene caracter .
			  if (substr_count($email,".")>= 1){
				 //obtengo la terminacion del dominio
				 $term_dom = substr(strrchr ($email, '.'),1);
				 //compruebo que la terminación del dominio sea correcta
				 if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
					//compruebo que lo de antes del dominio sea correcto
					$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
					$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
					if ($caracter_ult != "@" && $caracter_ult != "."){
					   $mail_correcto = 1;
					}
				 }
			  }
		   }
		}
		if ($mail_correcto)
		   return 1;
		else
		   return 0;
	} 
	//********************************************************************************
	
	
	//*************************** FUNCION PARA ENVIAR EMAIL **************************
	// Función para enviar email, se deben pasar los parametros especificados en el 
	// cabezote de la funcion.
	function enviarEmail($emailDestino = null,$asunto = null,$mensaje = null,$emailRemitente = null) 
	{
		if ($emailDestino != null) {
			$header = 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$header .= 'From: ' . $emailRemitente . "\r\n";
			$estado=mail($emailDestino,$asunto,$mensaje,$header);
			return $estado;
		}
		else
			return false;
	}	
	//********************************************************************************
	
	
	// ************* FUNCION PARA OBTENER LA IP DE LA MAQUINA DEL CLIENTE ************
	//Con esta función se puede obtener la direccion ip de la maquina del cliente.
	function getIP() 
	{
		$ipCliente = getenv('REMOTE_ADDR');
		if($ipCliente=='127.0.0.1')
		{
			$datosIP = explode("\n",`arp -a`);
			$ipSeparada = explode(" ",$datosIP[1]);
			$ip = $ipSeparada[1];
		}
		else
		{
			$ip = $ipCliente;	
		}
		return $ip;
	}
	//********************************************************************************
	
	
	//****************  FUNCION QUE CAPTURA LA MACADRRES DEL CLIENTE ****************
	function getMacAddress()
	{
		// Separar el texto separado por \n del texto resultado del comando `arp -a`
		$arpSplitted = explode("\n",`arp -a`);
		// Leer la ip remota del cliente
		$ipCliente = getenv('REMOTE_ADDR');
		if($ipCliente=='127.0.0.1')
			return "localhost";
		else
			$remoteIp = $this->getIP();
		// Recorrer el array $arpSplitted
		foreach ($arpSplitted as $value) 
		{
			// Separar el texto separado por espacios de cada entrada en $value
			$valueSplitted = split(" ",$value);
			// Recorrer el array $valueSplitted
			foreach ($valueSplitted as $spLine) 
			{
				// Comparar el valor de cada $spLine  con la IP del cliente
				if (preg_match("/$remoteIp/",$spLine)) 
				{
					// Econtrada la coincidencia de la IP del cliente, se recorre nuevamente el array $valueSplitted
					foreach ($valueSplitted as $spLine) 
					{
						// Comparar el valor de cada $spLine con una estructura valida de mac-address 
						if (preg_match(
						"/[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f][:-]".
						"[0-9a-f][0-9a-f]/i",$spLine)) 
						{
							// Se econtro la mac-address que corresponde a la entrada en la variable $spLine
							return $spLine;
						}
					}
				}
			}
		}
	}
	//********************************************************************************
	
	//******************** FUNCION QUE COMPARA DOS FECHAS ****************************
	// la función usa expresiones regulares para que admita fechas tanto en formato "dd-mm-aaaa" 
	// como con formato "dd/mm/aaaa".
	function comparaFechas($fecha1,$fecha2)        
	{	// valida la fecha numero 1 verificando que contenga el separador /
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
			// con la funcion split toma la fecha y la convierte en un arreglo separada por el caracter /
			// y con la funcion list, asigna los campos correspondientes a cada variable contenida en los parametros de la funcion list
			list($dia1,$mes1,$año1)=split("/",$fecha1);
		// valida que la funcion fecha 1 contenga el caracter separador -
        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
            // con la funcion split toma la fecha y la convierte en un arreglo separada por el caracter /
			// y con la funcion list, asigna los campos correspondientes a cada variable contenida en los parametros de la funcion list
			list($dia1,$mes1,$año1)=split("-",$fecha1);
        
		
		// valida la fecha numero 2 verificando que contenga el separador /
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
            // con la funcion split toma la fecha y la convierte en un arreglo separada por el caracter /
			// y con la funcion list, asigna los campos correspondientes a cada variable contenida en los parametros de la funcion list
			list($dia2,$mes2,$año2)=split("/",$fecha2);
        // valida la fecha numero 1 verificando que contenga el separador -
		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
            // con la funcion split toma la fecha y la convierte en un arreglo separada por el caracter /
			// y con la funcion list, asigna los campos correspondientes a cada variable contenida en los parametros de la funcion list
			list($dia2,$mes2,$año2)=split("-",$fecha2);
        
		// la variable dif almacena el resultado de restar la fecha numero 2 a la fecha numero 1
		// despues se retorna la diferencia entre las dos fechas, $dif, almacena la cantidad de segundos.
		$dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
		return ($dif);                        
    }
	//********************************************************************************
	
 	
	//********************* FUNCION PARA FORMATEAR FECHAS ****************************
	function formatoFecha($fecha)
	{	// con la funcion split toma la fecha y la convierte en un arreglo separada por el caracter /
		// y con la funcion list, asigna los campos correspondientes a cada variable contenida en los parametros de la funcion list
		list($año,$mes,$dia)=split("-",$fecha);
		$fechaFormateada = $dia."-".$mes."-".$año;
		return $fechaFormateada;
	}
	//********************************************************************************
	
	
	//***************** FUNCION PARA ADICIONAR TIEMPO A UNA FECHA ********************
	//Con esta funcion es posible sumar o agregar dias a una fecha especifica.
	function fechaAdd($fecha,$ndias)
    {	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
        	list($dia,$mes,$año)=split("/", $fecha);
        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
        	list($dia,$mes,$año)=split("-",$fecha);
        
		$nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
        return $nuevafecha;  
	}
	//********************************************************************************


	//*********** FUNCION PARA REGISTRAR LOG Y GENERAR PROCESO INVERSO ***************//
	// esta funcion controla mediante log de procesos todas las actividades que se 
	// realicen en la db, permitiendo tener un control de regresion del proceso en 
	// el caso que se quiera regresar lo realizado.
	function logsDb($sql)
	{
		// obtiene el tipo de accion a realizar
		$sql = strtoupper($sql);
		$accion = substr(trim($sql),0,6);
		 
		// estructura a retornar para el log.
		$logDB = array('fecha' => date("Y-m-d h:m:s"),
					   'usuario' => 'Javier Mosquera D',
					   'idUsuario' => '1',
					   'accionRealizada' => $accion,
					   'queryEjecutado' => $sql,
					   'infoAnterior' => '',
					   'InfoNueva' => '',
					   'ipAddress' => getIP(),
					   'macAddress' => getMacAddress(),
					   'accionInversa' => '',
					   'queryInverso' => '');
		
		switch($accion)
		{
			// aplica accion inversa del proceso de insert, lo que hace es eliminar el registro ingresado en el momento que se
			// quiera, permitiendo realizar un retroceso a cada insert.
			case 'INSERT':
				$NomTablaIni = strpos($sql,"INTO") + 4;
				$NomTablaFin = strpos($sql,"VALUES");
				$NomTabla = trim(substr($sql,$NomTablaIni,$NomTablaFin-$NomTablaIni));
				$logDB['accionInversa']='DELETE';
				$logDB['queryInverso']= "DELETE FROM ".$NomTabla." WHERE ".$NomTabla."_ID = ";
			break;
			// aplica acción inversa al proceso delete, lo que permite que se recupere nuevamente la información eliminada,
			// esto permite que cuando se elimine un registro sin querer se pueda recuperar la información.
			case 'DELETE':
				// verificar si existe un where, si existe solo buscamos el registro que se necesita eliminar y organizar en 
				// la estructura inversa, si no existe un where quiere decir que va a borrar toda la tabla, entonces vamos a buscar 
				// la informacion de toda la tabla y despues evaluamos el tamaño de la tabla pare revisar si guardamos el bd p   		 			
				// guardamos en un solo registro nada mas
			break;
			// aplica acción inversa al proceso update, 
			case 'UPDATE':
				// verificar si existe un where dentro del sql si existe un where entonces es porque se va a modificar en toda la   			 			
				// tabla, si existe entonces es porque solo se va a modificar un unico registro, segun la estructura entonces se 
				// organiza la sentencia inversa para el retroceso del proceso a utilizar.
			break;
		}
		return $logDB;
	}
	
	/**
	 * Sube archivo a un directorio
	 * @param string $file
	 * @param string $name
	 * @param string $path
	 * @param string $basepath
	 */
	function upload_file($file,$name, $path,$basepath = "temp/"){
		
		$basepath = PATH_BASE.$basepath;
		
		if ($_FILES[$file]["error"] > 0){
	    	return false;
	    }
	  	else{
	  		$ext = explode('.',$_FILES[$file]['name']);
	  		$ext = end($ext);
	  		
	  		create_path($basepath.$path);
	    	if(move_uploaded_file($_FILES[$file]["tmp_name"],$basepath.$path.$name.'.'.$ext)){
	      		return $path.$name.'.'.$ext;
	      	}
	      	else{
	      		return false;
	      	}
	    }
	}
	
	/**
	 * Crea directorios, si no existen, de una ruta a un directorio
	 * @param string $path
	 */
	function create_path($path){
		$apath = explode('\\',str_replace(array('/'),'\\',$path));
		foreach($apath as $k => $v){
			if($v != ''){
				$pt .= $v.'/';
				if(!file_exists($pt)){
					mkdir($pt);
				}
			}
		}
		
	}
?>