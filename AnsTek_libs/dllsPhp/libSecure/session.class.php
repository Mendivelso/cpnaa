<?php
/**
 * Clase para el manejo de sesiones y cookies.
 */

class Session {

	/**
	 * Constructor
	 */
	private function __construct() { }
	
	/**
	 * Actualiza los parametros de configuracion
	 * @access public
	 * @param string $key
	 * @param mixed $key
	 * @return boolean 
	 * @static
	 */
	public static function config($key, $value = '') {
		Resession::getInstance()->config($key, $value);
	}

	/**
	 * Agrega un valor a la sesion
	 * @access public
	 * @param string $key
	 * @param string $value
	 * @return void
	 * @static
	 */
	public static function set($key, $value) { 
		Resession::getInstance()->set($key, $value);
	}
	
	/**
	 * Obtiene unvalor de la sesion
	 * @access public
	 * @param string $key
	 * @return mixed
	 * @static
	 */
	public static function get($key) {
		return Resession::getInstance()->get($key);
	}
	
	/**
	 * Elimina un arreglo de valores o uno solo
	 * @access public
	 * @param array/string $keys
	 * @return void
	 * @static
	 */
	public static function clear($keys) {
		Resession::getInstance()->clear($keys);
	}
	
	/**
	 * Destruye la sesion
	 * @access public
	 * @return void
	 * @static
	 */
	public static function destroy() {
		Resession::getInstance()->destroy();
	}
	
	/**
	 * Redirecciona a otra url
	 * @access public
	 * @param string $path
	 * @return void
	 * @static
	 */
	public static function redirect($path) {
		Resession::getInstance()->redirect($path);
	}
	
	/**
	 * Obtiene el id de sesion del usuario
	 * @access public
	 * @return string
	 * @static
	 */
	public static function getId() {
		return Resession::getInstance()->getId();
	}
	
	/**
	 * Regenera y establece un nuevo id a la sesion
	 * @access public
	 * @param boolean $delete
	 * @return int
	 * @static
	 */
	public static function regenerate($delete = true) {
		return Resession::getInstance()->regenerate($delete);
	}
	
	/**
	 * Regenera y establece un nuevo id a la sesion
	 * @access public
	 * @param boolean $delete
	 * @return int
	 * @static
	 */
	public static function valida_sesion($url,$rURL = 'index.php'){
		return Resession::getInstance()->valida_sesion($url,$rURL);
	}
	
	/**
	 * Cierra la sesion
	 * @access public
	 * @param boolean $url URL a redireccionar
	 */
	public function logout($url = "index.php"){
		return Resession::getInstance()->logout($url);
	}
	
	/**
	 * Establece una cookie
	 * @access public
	 * @param string $name: Nombre de la cookie
	 * @param string $value: Valor de la cookie
	 * @param string $expire: Tiempo en segundos en el que expira la cookie (0= expira cuando se cierre el navegador)
	 * @param string $path
	 * @param string $domain
	 * @param boolean $secure
	 * @param boolean $HTTPOnly
	 * @return void
	 * @static
	 */
	public static function setCookie($name, $value = '', $expire = 0, $path = '', $domain = '', $secure = false, $HTTPOnly = false) {
  		setcookie($name,$value,$expire,$path,$domain,$secure,$HTTPOnly);
	}
	
	/**
	 * Elimina una cookie
	 * @access public
	 * @param string $name: Nombre de la cookie
	 * @return boolean
	 * @static
	 */
	public static function delCookie($name){
		if ( isset( $_COOKIE[$name] ) ) {
		    setCookie($name, '', time() - 3600);
	        return true;    
		}
		else{
			return false;
		}
	}
}

class Resession {
	
	/**
	 * Contiene el user agent / browser del usuario
	 * @access private
	 * @var string
	 */
	private $__agent;
	
	/**
	 * Huella
	 * @access private
	 * @var string
	 */
	private $__fp;
	
	/**
	 * Array de configuracion
	 * @access private
	 * @var array
	 */
	private $__config = array(
		'security' 	=> 'high',
		'name'		=> 'ANTKSESSID',
		'cookies'	=> true
	);
	
	/**
	 * Id de sesion del usuario
	 * @access private
	 * @var string
	 */
	private $__id;

	/**
	 * Instancia de sesion
	 * @access private
	 * @var instance|object
	 * @static
	 */
	private static $__instance;
	
	/**
	 * Constructor
	 * @access private
	 * @return void
	 */
	private function __construct() {
		$uri = (isset($_SERVER['SCRIPT_URI'])) ? $_SERVER['SCRIPT_URI'] : '';
		if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || (mb_strpos($uri, 'https://') !== false)) {
			ini_set('session.cookie_secure', 1);
		}
		
		ini_set('session.name', $this->__config['name']);
		ini_set('session.use_trans_sid', 0);
		ini_set('url_rewriter.tags', '');
		
		if ($this->__config['cookies'] === true) {
			ini_set('session.use_cookies', true);
			ini_set('session.use_only_cookies', true);
			//~ ini_set('session.cookie_domain', $_SERVER['HTTP_HOST']);
		}
		
		switch ($this->__config['security']) {
			case 'high':
			case 'medium':
			default:
				$timeout = 180;
				if ($this->__config['security'] == 'high') {
					$lifetime = $timeout * 5;
				} else {
					$lifetime = $timeout * 15;
				}
				
				ini_set('session.referer_check', $_SERVER['HTTP_HOST']);
				//ini_set('session.cookie_lifetime', $lifetime);
				ini_set('session.cookie_httponly', true);
			break;
			case 'low':
				ini_set('session.cookie_lifetime', 0);
			break;
		}
		
		session_write_close();
		
		if (headers_sent()) {
			if (empty($_SESSION)) {
				$_SESSION = array();
			}
			return false;
		} else {
			session_start();
		}
		
		$this->__id = session_id();
		$this->__agent = md5($_SERVER['HTTP_USER_AGENT']);
		$this->__fp = $this->_fingerprint();
		
		return $this->__id;
	}
	
	/**
	 * Retorna la instancia actual de la sesion
	 * @access public
	 * @return instance
	 * @static
	 */
	public static function getInstance() {
		if (!isset(self::$__instance)){
			self::$__instance = new Resession();
		}
		
		$resession = self::$__instance;
		
		// Check user agent
		if ($resession->__config['security'] == 'high' && $resession->__agent != md5($_SERVER['HTTP_USER_AGENT'])) {
			$resession->destroy();
			$resession->regenerate(true);
		}
		
		return $resession;
	}
	
	/**
	 * Actualiza el array de configuracion
	 * @access public
	 * @param string $key
	 * @param mixed $key
	 * @return boolean
	 */
	public function config($key, $value = '') {
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				self::config($k, $v);
			}
		} else {
			$this->__config[$key] = $value;
		}
		
		return true;
	}

	/**
	 * Agrega un valor a la sesion
	 * @access public
	 * @param string $key
	 * @param string $value
	 * @return void
	 */
	public function set($key, $value) {
		if (mb_strpos($key, '.')) {
			$keys = explode('.', $key);
			
			if (!isset($_SESSION[$keys[0]])) {
				self::set($keys[0], array());
			}
			
			$_SESSION[$keys[0]][$keys[1]] = $value;
		} else {
			$_SESSION[$key] = $value;
		}
	}
	
	/**
	 * Obtiene un valor de la sesion
	 * @access public
	 * @param string $key
	 * @return mixed
	 */
	public function get($key) {
		if (mb_strpos($key, '.')) {
			$keys = explode('.', $key);
			
			if (isset($_SESSION[$keys[0]][$keys[1]])) {
				return $_SESSION[$keys[0]][$keys[1]];
			} else {
				return null;
			}
		} else {
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			} else {
				return null;
			}
		}
	}
	
	/**
	 * Elimina un array de valores de sesion o uno solo
	 * @access public
	 * @param array/string $keys
	 * @return void
	 */
	public function clear($key) {
		if (mb_strpos($key, '.')) {
			$keys = explode('.', $key);
			unset($_SESSION[$keys[0]][$keys[1]]);
			
		} else if (is_array($key)){
			foreach ($key as $k) {
				self::clear($k);
			}
			
		} else {
			unset($_SESSION[$key]);
		}	
	}
	
	/**
	 * Destruye la sesion
	 * @access public
	 * @return void
	 */
	public function destroy() {
		$_SESSION = array();
		$this->__id = null;
		
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time() - 42000, '/');
		}
		
		session_destroy();
	}
	
	/**
	 * Redirecciona a otra url
	 * @access public
	 * @param string $path
	 * @return void
	 */
	public function redirect($path) {
		header('Location: '. $path);
		exit();
	}
	
	/**
	 * Retorna el id de sesion del usuario
	 * @access public
	 * @return int
	 */
	public function getId() {
		if ($this->__id) {
			return $this->__id;
		} else {
			return self::regenerate(true);
		}
	}
	
	/**
	 * Regenera y establece un nuevo id para la sesion
	 * @access public
	 * @param boolean $delete
	 * @return int
	 */
	public function regenerate($delete) {
		session_regenerate_id($delete);
		$this->__id = session_id();
		return $this->__id;
	}
	
	/**
	 * Genera huella
	 * @access public
	 */
	private function _fingerprint()
    {
        $fingerprint = $this->__config['name'];
        if ($this->__config['security'] == 'high') {
            $fingerprint .= $_SERVER['HTTP_USER_AGENT'];
        }
        if ($this->__config['security'] == 'high') {
			$num_blocks = 4;
            $blocks = explode('.', $_SERVER['REMOTE_ADDR']);
            for ($i = 0; $i < $num_blocks; $i++) {
                $fingerprint .= $blocks[$i] . '.';
            }
        }
        return md5($fingerprint);
    } 	
	
	/**
	 * Cierra la sesion
	 * @access public
	 * @param boolean $url URL a redireccionar
	 */
	public function logout($url){
		self::destroy();
		//~ self::redirect($url);
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		echo "<html><head><title>Cerrando sesion...</title>
				<script>top.location = '$url';</script>
			</head><body></body></html>";

		exit();
	}

	/**
	 * Valida la session activa
	 * @access public
	 * @param boolean $url URL del script a validar sesion y comprobar permisos
	 * @param boolean $rURL URL va ha redirecionar en caso de problemas con la sesion
	 */
	public function valida_sesion($url,$rURL){
		$perm = array('list' => 0,'add' => 0,'edit' => 0,'del' => 0);
		if(self::get("sess_id") == self::getId() && $this->__fp == self::_fingerprint() && self::get("sess_access") === true ){
         return true;
		}
		else{
			self::logout($rURL);
		}
	}
	
	/**
	 * Desactiva uso de clone
	 * @return void
	 */
	private function __clone() {}
	
}


?>