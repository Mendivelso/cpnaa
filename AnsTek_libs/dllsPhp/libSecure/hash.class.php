<?php
/**
 * hash.class.php
 *
 * Clase para manejo "hashing" de las palabras (Escencial para asegurar los passwords). 
 * Es posible que solo usando SHA1 haya colisiones de hash haciendo el sistema vulnerable.
 * 
 */
class Hash {

	// Algoritmo 
	private static $algo = 'sha256';

	// costo
	private static $cost = 2048;

	/**
     * String para "salar" un hash
     */
	public static function unique_salt() {
		return substr(sha1(mt_rand()),0,32);
	}

	/**
     * Genera hash de un string
     * @param string $str Texto a convertir en hash
     * @param string $slt Texto para "salar" el hash, si esta vacio genera una unica
     */
	public static function str2hash($str,$slt = '') {
        $salt = $slt;
        if($slt == ''){
            $salt = self::unique_salt();
        }
        
        $hash = hash(self::$algo,$salt.$str);
        
        for($i = 0;$i <= self::$cost;$i++){
            $hash = hash(self::$algo,$hash);
        }

		return array('hash' => $hash,'salt' => $salt);

	}

	/** 
     * Compara un hash previamente genrado contra el hash de un nuevo texto
     * @param string $hash hash previo
     * @param string $str Texto a comparar con el hash dado
     * @param string $salt Texto para "salar" el texto dado
     */
	public static function checkstr($hash, $str, $salt) {

		$new_hash = self::str2hash($str, $salt);
        
        // Retorna true si el hash dado es igual al generado
		return ($hash == $new_hash['hash']);

	}

}

?>