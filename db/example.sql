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

/*Table structure for table `usuarios` */

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador del registro',
  `Nombre` varchar(150) NOT NULL COMMENT 'Nombre del cliente',
  `Cedula` int(11) NOT NULL COMMENT 'cedula del cliente',
  `Direccion` varchar(150) NOT NULL COMMENT 'Direccion del cliente',
  `Telefono` bigint(20) NOT NULL COMMENT 'Telefono del cliente',
  `Email` varchar(45) NOT NULL COMMENT 'Email del cliente',
  `Usuario` varchar(45) NOT NULL COMMENT 'Usuario para la cuenta del cliente',
  `Foto` varchar(90) NOT NULL COMMENT 'Foto de perfil usuario',
  `Perfil` int(11) NOT NULL COMMENT 'perfil del usuario',
  `Password` varchar(45) NOT NULL COMMENT '******** cuenta del cliente',
  `Status` int(1) NOT NULL COMMENT 'Estado del registro',
  `Created_at` datetime NOT NULL COMMENT 'Fecha de creación del registro',
  `Updated_by` bigint(20) DEFAULT NULL COMMENT 'usuario que actualiza',
  `Updated_at` datetime DEFAULT NULL COMMENT 'fecha de actualizacion',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`Id`,`Nombre`,`Cedula`,`Direccion`,`Telefono`,`Email`,`Usuario`,`Foto`,`Perfil`,`Password`,`Status`,`Created_at`,`Updated_by`,`Updated_at`) values (1,'Cristian Goyeneche M',1022422710,'kra 18 # 118 - 04 norte',3144939814,'cronaldo@conjuntodigital.com','Admin','public/usuarios/1/foto.png',1,'e10adc3949ba59abbe56e057f20f883e',1,'2017-12-04 14:52:09',1,'2017-12-05 10:12:18'),(2,'Juan perez',1030530687,'kra 18 # 118-04',3112504210,'Jperez@conjuntodigital.com','Juan','public/usuarios/2/perfil.png',0,'202cb962ac59075b964b07152d234b70',1,'2017-12-04 15:11:48',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
