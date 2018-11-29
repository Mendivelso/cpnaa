/*
SQLyog Community v12.08 (64 bit)
MySQL - 10.1.10-MariaDB : Database - conjunto_digital
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`conjunto_digital` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `conjunto_digital`;

/*Table structure for table `estados` */

DROP TABLE IF EXISTS `estados`;

CREATE TABLE `estados` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `Nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre del estado',
  `Status` int(1) NOT NULL COMMENT 'activo o desactivo',
  `Created_date` datetime NOT NULL COMMENT 'Fecha de registro',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `estados` */

insert  into `estados`(`Id`,`Nombre`,`Status`,`Created_date`) values (1,'Registrado',1,'2018-06-28 15:31:51'),(2,'Asignado',1,'2018-06-28 15:31:16'),(3,'Llamada a su móvil',1,'2018-07-03 10:04:44'),(4,'Se ha enviado un Email',1,'2018-07-03 10:05:14'),(5,'Pendiente para volver a llamar',1,'2018-07-03 10:07:01'),(6,'Matriculado',1,'2018-07-03 10:08:22'),(7,'Terminado la gestión',1,'2018-07-03 10:08:55'),(8,'Inscrito',1,'2018-09-12 10:00:19'),(9,'Número Equivocado / errado',1,'2018-09-12 10:00:30'),(10,'No interesado',1,'2018-09-12 10:00:48'),(11,'Duplicado',1,'2018-09-12 10:01:05'),(12,'Cargado ',1,'0000-00-00 00:00:00');

/*Table structure for table `hoja_ruta` */

DROP TABLE IF EXISTS `hoja_ruta`;

CREATE TABLE `hoja_ruta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `Registro_id` int(11) NOT NULL COMMENT 'Id registro',
  `Detalle` varchar(300) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion del paso a paso',
  `Asignado_a` int(11) NOT NULL COMMENT 'Id Agente',
  `Status` int(11) NOT NULL COMMENT 'Estado del contacto',
  `Created_by` int(11) NOT NULL COMMENT 'Usuario que registra',
  `Created_date` datetime NOT NULL COMMENT 'Fecha de registro',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `hoja_ruta` */

insert  into `hoja_ruta`(`Id`,`Registro_id`,`Detalle`,`Asignado_a`,`Status`,`Created_by`,`Created_date`) values (1,1,'El contacto se ha registrado',0,1,0,'2018-07-06 11:10:46'),(2,1,'El contacto a sido asignado a un agente',4255753,2,1,'2018-07-06 11:11:01'),(3,2,'El contacto se ha registrado',0,1,0,'2018-07-06 11:48:31'),(4,2,'El contacto a sido asignado a un agente',4255753,2,1,'2018-07-06 11:48:41'),(5,1,'Le llamamos  a su movil',4255753,3,3,'2018-07-06 12:00:47'),(6,3,'El contacto se ha registrado',0,1,0,'2018-07-06 12:01:40'),(7,3,'El contacto a sido asignado a un agente',4255753,2,1,'2018-07-06 12:02:06'),(8,2,'Mail masivo para la campaña',4255753,4,3,'2018-07-06 12:04:17'),(9,4,'El contacto se ha registrado',0,1,0,'2018-07-06 12:07:07'),(10,4,'El contacto a sido asignado a un agente',4255753,2,1,'2018-07-06 12:07:52'),(11,3,'Le llamamos a su celular',4255753,3,3,'2018-07-06 12:08:46'),(12,4,'Enviamos un correo electronico',4255753,4,3,'2018-07-06 12:09:17'),(13,6,'El contacto se ha registrado',0,1,0,'2018-07-30 11:06:35'),(14,7,'El contacto se ha registrado',0,1,0,'2018-07-30 11:08:52'),(15,8,'El contacto se ha registrado',0,1,0,'2018-07-30 11:10:12'),(16,6,'El contacto a sido asignado a un agente',2147483647,2,1,'2018-07-30 11:15:45'),(17,8,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-07-30 11:19:27'),(18,7,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-07-30 11:19:27'),(19,8,'Llamamos a su celular',1030530840,3,2,'2018-07-30 11:24:58'),(20,7,'Matricula cerrada',1030530840,6,2,'2018-07-30 11:30:28'),(21,11,'El contacto se ha registrado',0,1,0,'2018-09-11 15:07:34'),(22,11,'El contacto a sido asignado a un agente',2147483647,2,1,'2018-09-11 15:09:22'),(23,11,'Le llamamos',2147483647,3,4,'2018-09-11 15:14:17'),(24,12,'El contacto se ha registrado',0,1,0,'2018-09-11 15:17:40'),(25,12,'El contacto a sido asignado a un agente',2147483647,2,1,'2018-09-11 15:20:12'),(26,12,'Volver a llmar',2147483647,5,4,'2018-09-11 15:21:47'),(27,13,'El contacto se ha registrado',0,1,0,'2018-09-11 15:54:02'),(28,13,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-09-11 15:58:05'),(29,13,'llamamos a su movil',1030530840,3,2,'2018-09-11 15:58:53'),(30,14,'El contacto se ha registrado',0,1,0,'2018-09-12 10:59:11'),(31,15,'El contacto se ha registrado',0,1,0,'2018-09-12 10:59:49'),(32,14,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-09-12 11:01:04'),(33,15,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-09-12 11:01:21'),(34,14,'SE ha realizado la inscripcion',1030530840,8,2,'2018-09-12 11:01:59'),(35,15,'DEbemos volver a llmar',1030530840,5,2,'2018-09-12 11:02:35'),(36,16,'El contacto se ha registrado',0,1,0,'2018-09-19 11:51:23'),(37,17,'El contacto se ha registrado',0,1,0,'2018-09-19 11:51:23'),(38,18,'El contacto se ha registrado',0,1,0,'2018-09-19 11:51:23'),(39,23,'El contacto se ha cargado',0,12,0,'2018-09-19 12:11:49'),(40,24,'El contacto se ha cargado',0,12,0,'2018-09-19 12:12:37'),(41,25,'El contacto se ha cargado',0,12,0,'2018-09-19 12:14:15'),(42,26,'El contacto se ha registrado',0,1,0,'2018-09-19 12:15:03'),(43,27,'El contacto se ha cargado',0,12,0,'2018-09-19 12:15:34'),(44,28,'El contacto se ha cargado',0,12,0,'2018-09-19 12:19:15'),(45,29,'El contacto se ha cargado',0,12,0,'2018-09-19 12:25:41'),(46,30,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(47,31,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(48,32,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(49,33,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(50,34,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(51,35,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(52,36,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(53,37,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(54,38,'El contacto se ha cargado',0,12,0,'2018-09-19 12:47:37'),(55,39,'El contacto se ha cargado',0,12,0,'2018-09-19 14:35:30'),(56,40,'El contacto se ha cargado',0,12,0,'2018-09-19 14:35:31'),(57,41,'El contacto se ha cargado',0,12,0,'2018-09-19 14:40:09'),(58,42,'El contacto se ha cargado',0,12,0,'2018-09-19 14:40:09'),(59,43,'El contacto se ha registrado',0,1,0,'2018-09-25 14:08:08'),(60,26,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-10-11 09:53:32'),(61,41,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-10-11 10:01:10'),(62,44,'El contacto se ha registrado',0,1,0,'2018-10-11 10:07:37'),(63,42,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-10-11 10:09:49'),(64,40,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-10-11 10:09:50'),(65,39,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-10-11 10:09:50'),(66,35,'El contacto a sido asignado a un agente',1030530840,2,1,'2018-10-11 10:09:50'),(67,42,'se ha borrado la asignación',0,1,1,'2018-10-11 10:10:52'),(68,41,'se ha borrado la asignación',0,1,1,'2018-10-11 10:10:52'),(69,40,'se ha borrado la asignación',0,1,1,'2018-10-11 10:10:52'),(70,39,'se ha borrado la asignación',0,1,1,'2018-10-11 10:10:52'),(71,35,'se ha borrado la asignación',0,1,1,'2018-10-11 10:10:52'),(72,26,'se ha borrado la asignación',0,1,1,'2018-10-11 10:10:52'),(73,45,'El contacto se ha registrado',0,1,0,'2018-10-11 10:12:56'),(74,46,'El contacto se ha registrado',0,1,0,'2018-10-11 10:13:15'),(75,47,'El contacto se ha registrado',0,1,0,'2018-10-11 10:29:56'),(76,48,'El contacto se ha registrado',0,1,0,'2018-10-11 10:30:23'),(77,49,'El contacto se ha registrado',0,1,0,'2018-10-12 11:39:29');

/*Table structure for table `registros` */

DROP TABLE IF EXISTS `registros`;

CREATE TABLE `registros` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `Cedula` bigint(20) NOT NULL COMMENT 'Documento del registro',
  `Nombre_completo` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre regsitro',
  `Celular` bigint(20) NOT NULL COMMENT 'Celular Registro',
  `Email` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email registro',
  `Programa` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Programa que decea',
  `Mensaje` varchar(400) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Mensaje del registro',
  `Campana_Id` int(11) NOT NULL COMMENT 'Identificador campñas en medios',
  `Created_date` datetime NOT NULL COMMENT 'Fecha Creacion',
  `Status` int(11) NOT NULL COMMENT 'Estado del registro',
  `Asignado_a` int(11) NOT NULL COMMENT 'Usuario al cual se asigna',
  `Fecha_asignado` datetime DEFAULT NULL COMMENT 'Fecha de asignacion',
  `Updated_by` int(11) DEFAULT NULL COMMENT 'Usuario que actualiza',
  `Updated_date` datetime DEFAULT NULL COMMENT 'Fecha que actualiza',
  PRIMARY KEY (`Id`,`Asignado_a`),
  KEY `fk_status` (`Status`),
  CONSTRAINT `fk_status` FOREIGN KEY (`Status`) REFERENCES `estados` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `registros` */

insert  into `registros`(`Id`,`Cedula`,`Nombre_completo`,`Celular`,`Email`,`Programa`,`Mensaje`,`Campana_Id`,`Created_date`,`Status`,`Asignado_a`,`Fecha_asignado`,`Updated_by`,`Updated_date`) values (1,1022422710,'ronadlo',3144939814,'cr@gmail.com','T.P. en Seguridad e Higiene Industrial','Buenas tardes ',0,'2018-07-06 11:10:46',3,4255753,'2018-07-06 11:11:01',3,'2018-07-06 12:00:47'),(2,1024557885,'angelica',3144939814,'cr@gmail.com','T.P. en Procesos Ambientales','Beunas tardes ',0,'2018-07-06 11:48:31',4,4255753,'2018-07-06 11:48:41',3,'2018-07-06 12:04:17'),(3,425568742,'ana',314939814,'cr@gmail.com','T.P. en Seguridad e Higiene Industrial','Beunas tardes',0,'2018-07-06 12:01:40',3,4255753,'2018-07-06 12:02:06',3,'2018-07-06 12:08:46'),(4,1024225552,'Juana',3115226341,'cr@gmail.com','T.P. en Procesos de Comercio Exterior','Quiero estudiar',0,'2018-07-06 12:07:07',4,4255753,'2018-07-06 12:07:52',3,'2018-07-06 12:09:17'),(7,1022422560,'Juanita',3112556879,'cr@hotmail.com','T.P en desarrollo','Cuanto vale el semestre',0,'2018-07-30 11:08:32',6,1030530840,'2018-07-30 11:19:27',2,'2018-07-30 11:30:28'),(8,1,'Roman',3124565342,'Roman@gmail.com','T.P','Cuanto vale',0,'2018-07-30 11:10:04',3,1030530840,'2018-07-30 11:19:27',2,'2018-07-30 11:24:58'),(12,1030520,'Juan E',5224875,'juan@gmail.com','T.P en derecho','nada',0,'2018-09-11 15:17:38',5,2147483647,'2018-09-11 15:20:12',4,'2018-09-11 15:21:47'),(13,102256321,'Sebastian',5468951,'sebas@gmail.com','Derecho','Nada',0,'2018-09-11 15:53:57',3,1030530840,'2018-09-11 15:58:05',2,'2018-09-11 15:58:53'),(14,2,'Esteban',3114598754,'este@gmail.com','Derecho','Mensaje',0,'2018-09-12 10:59:07',8,1030530840,'2018-09-12 11:01:04',2,'2018-09-12 11:01:59'),(15,3,'juancho',3124578941,'juan@gmail.com','COmunicacion','Msj',0,'2018-09-12 10:59:43',5,1030530840,'2018-09-12 11:01:21',2,'2018-09-12 11:02:35'),(45,1022422710,'Yop',3144939814,'cristiangoyeneche9@gmail.com','T.P. en Procesos Ambientales','Hola como van',0,'2018-10-11 10:12:56',1,0,NULL,NULL,NULL),(46,1022422710,'Yop',3144939814,'cristiangoyeneche9@gmail.com','T.P. en Procesos Ambientales','Hola como van',0,'2018-10-11 10:13:15',1,0,NULL,NULL,NULL),(47,1022422710,'Yop',3144939814,'cristiangoyeneche9@gmail.com','T.P. en Procesos Administrativos','Hola como van',0,'2018-10-11 10:29:56',1,0,NULL,NULL,NULL),(48,1022422710,'Yop',3144939814,'cristiangoyeneche9@gmail.com','T.P. en Procesos Administrativos','Hola como van',0,'2018-10-11 10:30:23',1,0,NULL,NULL,NULL),(49,970,'yop',3526145,'cr@gmail.com','derecho','Quiero estudiar',0,'2018-10-12 11:39:26',1,0,NULL,NULL,NULL);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador del registro',
  `Nombre` varchar(150) NOT NULL COMMENT 'Nombre del cliente',
  `Cedula` int(11) NOT NULL COMMENT 'cedula del cliente',
  `Direccion` varchar(150) NOT NULL COMMENT 'Direccion del cliente',
  `Telefono` bigint(50) NOT NULL COMMENT 'Telefono del cliente',
  `Email` varchar(45) NOT NULL COMMENT 'Email del cliente',
  `Usuario` varchar(45) NOT NULL COMMENT 'Usuario para la cuenta del cliente',
  `Foto` varchar(90) NOT NULL COMMENT 'Foto de perfil usuario',
  `Perfil` int(11) NOT NULL COMMENT 'perfil del usuario',
  `Password` varchar(45) NOT NULL COMMENT '******** cuenta del cliente',
  `Status` int(1) NOT NULL COMMENT 'Estado del registro',
  `Created_at` datetime NOT NULL COMMENT 'Fecha de creación del registro',
  `Updated_by` bigint(20) DEFAULT NULL COMMENT 'usuario que actualiza',
  `Updated_at` datetime DEFAULT NULL COMMENT 'fecha de actualizacion',
  PRIMARY KEY (`Id`,`Cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`Id`,`Nombre`,`Cedula`,`Direccion`,`Telefono`,`Email`,`Usuario`,`Foto`,`Perfil`,`Password`,`Status`,`Created_at`,`Updated_by`,`Updated_at`) values (1,'Perrito Perro',2147483647,'kra 18 # 118 - 04 norte',3219881024,'admisiones@gmail.com','Admin','public/usuarios/1/foto.png',1,'827ccb0eea8a706c4c34a16891f84e7b',1,'2017-12-04 14:52:09',1,'2018-11-20 15:37:50'),(2,'Juan',1030530840,'Kra 88 # 40-12',3154638542,'Juan@gmail.com','Agente 1','public/usuarios/2/foto.png',0,'e10adc3949ba59abbe56e057f20f883e',1,'2018-06-28 12:26:09',0,'2018-10-12 10:38:36'),(3,'Carlos',4255753,'Kra 7 # 72-40',5726508,'carlos98@gmail.com','Agente 2','public/usuarios/3/foto.png',0,'e10adc3949ba59abbe56e057f20f883e',1,'2018-06-28 12:43:47',0,'2018-10-12 10:38:38'),(4,'Maria',2147483647,'kra 22 # 15-20',3149524265,'maria@hotmail.com','Agente 3','public/usuarios/4/foto.png',0,'e10adc3949ba59abbe56e057f20f883e',0,'2018-06-28 14:05:08',0,'2018-10-12 10:07:55');

/* Trigger structure for table `registros` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `inser_contacto` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `inser_contacto` AFTER INSERT ON `registros` FOR EACH ROW BEGIN	
	IF new.Status = 12 THEN
		INSERT INTO hoja_ruta (Registro_id, Detalle, Asignado_a, STATUS, Created_by, Created_date) VALUES (new.Id, 'El contacto se ha cargado', 0, 12, 0,  NOW());
		Else
		INSERT INTO hoja_ruta (Registro_id, Detalle, Asignado_a, STATUS, Created_by, Created_date) VALUES (new.Id, 'El contacto se ha registrado', 0, 1, 0,  NOW());
	END IF;
	
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
