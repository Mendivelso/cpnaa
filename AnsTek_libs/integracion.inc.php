<?php
	/**
	 * integracion.inc.php
	 *
	 * Script para la administración de recursos del core
	 * 
	 */
    
    	/**
	* incluye config
	*/
	include_once ("config_app.php");

	/**
	* incluye administracion de base de datos
	*/
	include_once ("dllsPhp/libDB/dbManager.class.php");
    
	/**
	* incluye administracion de sessiones y de manejo de hash
	*/
	include_once ("dllsPhp/libSecure/session.class.php");
	include_once ("dllsPhp/libSecure/hash.class.php");
    
	/**
	* incluye administracion de mails
	*/
	include_once ("dllsPhp/libMailer/class.phpmailer.php");
	include_once ("dllsPhp/libMailer/class.pop3.php");
	include_once ("dllsPhp/libMailer/class.smtp.php");
	include_once ("dllsPhp/libMailer/PHPMailerAutoload.php");

	/**
	 * Libreria de uso general
	 */
	include_once("dllsPhp/libGeneral/libGeneral.class.php");
	
	
	/** 
	* instancia la DB 
	*/
   	$db = dbManager::getInstance();
?>