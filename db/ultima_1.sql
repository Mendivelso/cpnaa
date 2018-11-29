/*
SQLyog Community v12.08 (64 bit)
MySQL - 10.1.10-MariaDB : Database - desarrollo_cpnaa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`desarrollo_cpnaa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `desarrollo_cpnaa`;

/*Table structure for table `arquitectos` */

DROP TABLE IF EXISTS `arquitectos`;

CREATE TABLE `arquitectos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `Nombres` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombres del arq',
  `Apellidos` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Apellidos del arq',
  `Cedula` bigint(40) NOT NULL COMMENT 'Cedula Arquitecto',
  `Email` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email',
  `Telefono` bigint(30) NOT NULL COMMENT 'TElefono',
  `Nit_empresa` varchar(200) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Empresa a la que pertenece',
  `Nivel_educativo` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Tecnico, porf, auxiliar',
  `Cedula_RL` bigint(40) NOT NULL COMMENT 'Cedula_representante_legal',
  `Status` int(2) NOT NULL COMMENT 'Estado',
  `Created_date` datetime NOT NULL COMMENT 'FEcha creacion',
  `Created_by` int(11) NOT NULL COMMENT 'Quien regsitra',
  `Updated_date` datetime DEFAULT NULL COMMENT 'Fecha actualiza',
  `Updated_by` int(11) DEFAULT NULL COMMENT 'Quien actualiza',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `arquitectos` */

insert  into `arquitectos`(`Id`,`Nombres`,`Apellidos`,`Cedula`,`Email`,`Telefono`,`Nit_empresa`,`Nivel_educativo`,`Cedula_RL`,`Status`,`Created_date`,`Created_by`,`Updated_date`,`Updated_by`) values (1,'Cristian Arq','Mendivelso',1022422710,'cr@gmail.com',7730351,'97884653','Arquitecto',1015451163,1,'2018-11-29 11:27:29',10,NULL,NULL),(2,'Angelica','Gomes',42255742,'ang@gmail.com',7730351,'97884653','Arquitecto',1015451163,1,'2018-11-29 11:32:07',10,NULL,NULL);

/*Table structure for table `beneficios` */

DROP TABLE IF EXISTS `beneficios`;

CREATE TABLE `beneficios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificar del registro',
  `Titulo` varchar(45) NOT NULL COMMENT 'titulo del servicio',
  `Descripcion` varchar(900) NOT NULL COMMENT 'Descripcion del servicio',
  `Enlace` varchar(60) DEFAULT NULL COMMENT 'Tiene enlace en internet',
  `Imagen_principal` varchar(300) NOT NULL COMMENT 'Imagen principal del servicio',
  `Status` int(1) NOT NULL COMMENT 'Estado del registro',
  `Created_by` varchar(45) NOT NULL COMMENT 'Usuario que crea el registro',
  `Created_date` date NOT NULL COMMENT 'Fecha creacion del registro',
  `Updated_by` varchar(45) DEFAULT NULL COMMENT 'Usuario que actualiza el registro',
  `Updated_date` date DEFAULT NULL COMMENT 'Fecha de actualizacion del registro',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `beneficios` */

insert  into `beneficios`(`Id`,`Titulo`,`Descripcion`,`Enlace`,`Imagen_principal`,`Status`,`Created_by`,`Created_date`,`Updated_by`,`Updated_date`) values (5,'01','Charlas grupales para el ejercicio ético de la profesión','google.com.co','public/beneficios/5/beneficio 1.jpg',1,'1','2018-11-29',NULL,NULL),(6,'02','Acceso empresarial al aula virtual de aprendizaje sobre ética. Acompañamiento y seguimiento para capacitaciones en procesos de inducción y reinducción de arquitectos y profesionales auxiliares de la arquitectura en tu organización.','','public/beneficios/6/beneficio2.jpg',1,'1','2018-11-29',NULL,NULL),(7,'03','Acceso a documentos y módulos de aprendizaje a través de la página web del CPNAA','','public/beneficios/7/beneficios_1.png',1,'1','2018-11-29',NULL,NULL),(8,'04','Acompañamiento para que los arquitectos y/o profesionales auxiliares de la arquitectura colombianos que no cuenten con Matrícula y o certificado de inscripción profesional, la tramiten para que ejerzan con todas las de la ley y no pierdan experiencia profesional.','google.com.co','public/beneficios/8/beneficio4.jpg',1,'1','2018-11-29',NULL,NULL),(9,'05','Acompañamiento con el apoyo de migración Colombia para normalizar el trabajo de arquitectos extranjeros en Colombia, ya sea a través de matrícula Temporal especial o indicándoles las opciones para convalidación en Colombia.','google.com.co','public/beneficios/9/beneficio 5.jpg',1,'1','2018-11-29',NULL,NULL),(10,'06','Canales de comunicación para que el área de recursos humanos pueda validar rápidamente si un arquitecto o profesional auxiliar de la arquitectura extranjero y/ o colombiano tiene matrícula profesional.','','public/beneficios/10/beneficio 6.jpg',1,'1','2018-11-29',NULL,NULL),(11,'07','Área especial en nuestra página web para que puedas reportar, consultar y comunicarte con el CPNAA sobre temas relacionados con el ejercicio ético y responsable de la Profesión. ','google.com.co','public/beneficios/11/beneficio 7.jpg',1,'1','2018-11-29',NULL,NULL),(12,'08','Invitaciones a Talleres y actividades gratuitas del CPNAA sobre ética, normatividad  y temas de la profesión. ','google.com.co','public/beneficios/12/beneficio 8.jpg',1,'1','2018-11-29',NULL,NULL),(13,'09','Acceso a descuentos para participación en eventos de los aliados al CPNAA de todos los profesionales que pertenezcan a las empresas que han firmado el pacto.','','public/beneficios/13/beneficio 9.jpg',1,'1','2018-11-29',NULL,NULL),(14,'10','Entrega de material digital para que sea incluido en los programas de recursos humanos en el ejercicio ético.','','public/beneficios/14/beneficio 10.jpg',1,'1','2018-11-29',NULL,NULL);

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

/*Table structure for table `firmantes` */

DROP TABLE IF EXISTS `firmantes`;

CREATE TABLE `firmantes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `Razon_social` varchar(400) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Razon social',
  `Nit` varchar(200) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nit',
  `Telefono_emp` bigint(50) NOT NULL COMMENT 'Telefono empresa',
  `Pagina_web` varchar(40) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Pagina web',
  `Nombre_Repre` varchar(90) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre representante',
  `Cedula_Repre` bigint(40) NOT NULL COMMENT 'Cedula representatne',
  `Telefono_Repre` bigint(40) NOT NULL COMMENT 'Telefono representante',
  `Email_Repre` varchar(90) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email representante',
  `Responsable_pacto` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Responsable',
  `Cedula_Res` bigint(40) NOT NULL COMMENT 'Cedula responsable',
  `Telefono_Res` bigint(40) NOT NULL COMMENT 'Telefono responsable',
  `Email_Res` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Email responsable',
  `Status` int(2) NOT NULL COMMENT 'Stado',
  `Created_date` datetime NOT NULL COMMENT 'Fecha',
  `Created_by` bigint(20) NOT NULL COMMENT 'Quien crea',
  `Updated_date` datetime DEFAULT NULL COMMENT 'Fecha actualiza',
  `Updated_by` bigint(20) DEFAULT NULL COMMENT 'Quien actualiza',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `firmantes` */

insert  into `firmantes`(`Id`,`Razon_social`,`Nit`,`Telefono_emp`,`Pagina_web`,`Nombre_Repre`,`Cedula_Repre`,`Telefono_Repre`,`Email_Repre`,`Responsable_pacto`,`Cedula_Res`,`Telefono_Res`,`Email_Res`,`Status`,`Created_date`,`Created_by`,`Updated_date`,`Updated_by`) values (1,'Conjunto digital','324534',5726542,'conjuntodigital.com','fabio',156798,5726425,'cr@gmail.com','yo',65498213,5646892,'cr@gmail.com',1,'2018-11-26 16:43:00',7,NULL,NULL),(2,'optimatm','97015468789',7730351,'optimatm.com.co','Alberto Osorio',31245698541,7730351,'cr@gmail.com','yo',1022422710,7730351,'cr@gmail.com',1,'2018-11-27 09:07:37',8,NULL,NULL),(3,'Sebas arquitectos','97884653',7730351,'sebasxxx.com.co','Sebas cantor',1015451163,7730351,'cr@gmail.com','mi papi',42556874,46541321,'papi@gmail.com',1,'2018-11-27 09:54:30',10,NULL,NULL),(4,'construir pais','97356987',7730351,'optimatm.com.co','fabio',756984,7730351,'cr@gmail.com','gustavo',42556874,7730351,'cr@gmail.com',1,'2018-11-28 12:33:25',11,NULL,NULL);

/*Table structure for table `hoja_ruta` */

DROP TABLE IF EXISTS `hoja_ruta`;

CREATE TABLE `hoja_ruta` (
  `Id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del registro',
  `Arquitecto` bigint(40) NOT NULL COMMENT 'Id registro',
  `Detalle` varchar(300) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion del paso a paso',
  `Status` int(2) NOT NULL COMMENT 'Estado del contacto',
  `Created_by` int(11) NOT NULL COMMENT 'Usuario que registra',
  `Created_date` datetime NOT NULL COMMENT 'Fecha de registro',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `hoja_ruta` */

insert  into `hoja_ruta`(`Id`,`Arquitecto`,`Detalle`,`Status`,`Created_by`,`Created_date`) values (1,1022422710,'Aprobado ',1,1,'2018-11-29 11:27:29'),(2,42255742,'Aprobado OK',1,1,'2018-11-29 11:32:07');

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
  `firma_pacto` int(1) NOT NULL COMMENT 'Validamos si ya firmo el pacto',
  `Created_at` datetime NOT NULL COMMENT 'Fecha de creación del registro',
  `Updated_by` bigint(20) DEFAULT NULL COMMENT 'usuario que actualiza',
  `Updated_at` datetime DEFAULT NULL COMMENT 'fecha de actualizacion',
  PRIMARY KEY (`Id`,`Cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`Id`,`Nombre`,`Cedula`,`Direccion`,`Telefono`,`Email`,`Usuario`,`Foto`,`Perfil`,`Password`,`Status`,`firma_pacto`,`Created_at`,`Updated_by`,`Updated_at`) values (1,'Crack',2147483647,'kra 18 # 118 - 04 norte',3219881024,'admisiones@gmail.com','Admin','public/usuarios/1/foto.png',1,'827ccb0eea8a706c4c34a16891f84e7b',1,0,'2017-12-04 14:52:09',1,'2018-11-23 17:36:49'),(2,'Juan',1030530840,'Kra 88 # 40-12',3154638542,'Juan@gmail.com','Agente 1','public/usuarios/2/foto.png',0,'e10adc3949ba59abbe56e057f20f883e',1,0,'2018-06-28 12:26:09',0,'2018-10-12 10:38:36'),(3,'Carlos',4255753,'Kra 7 # 72-40',5726508,'carlos98@gmail.com','Agente 2','public/usuarios/3/foto.png',0,'e10adc3949ba59abbe56e057f20f883e',1,0,'2018-06-28 12:43:47',0,'2018-10-12 10:38:38'),(4,'Maria',2147483647,'kra 22 # 15-20',3149524265,'maria@hotmail.com','Agente 3','public/usuarios/4/foto.png',0,'e10adc3949ba59abbe56e057f20f883e',0,0,'2018-06-28 14:05:08',0,'2018-10-12 10:07:55'),(5,'ROnaldoino',42255742,'Kra100',5726542,'cr@gmail.com','Root','public/usuarios/5/descarga (2).png',0,'e10adc3949ba59abbe56e057f20f883e',1,0,'2018-11-23 17:36:23',NULL,NULL),(6,'Angelica Nuñez',111111,'kra 18 # 118 - 04 norte',5726542,'admisiones@gmail.com','Ang','public/usuarios/6/carga.jpg',0,'81dc9bdb52d04dc20036dbd8313ed055',1,0,'2018-11-26 11:54:06',NULL,NULL),(7,'Angelica',24090905,'kra 18 # 118 - 04 norte',7730351,'cr@gmail.com','user1','public/usuarios/7/foto.png',0,'202cb962ac59075b964b07152d234b70',1,1,'2018-11-26 16:12:53',NULL,NULL),(8,'Cristian',1022422710,'Kra 118',7730351,'cr@gmail.com','cr7','public/usuarios/8/foto.png',0,'202cb962ac59075b964b07152d234b70',1,1,'2018-11-27 09:00:55',NULL,NULL),(9,'juan',1022422,'kra 112',7730351,'cr@gmail.com','juancho','public/usuarios/9/carga.jpg',0,'202cb962ac59075b964b07152d234b70',1,0,'2018-11-27 09:02:26',NULL,NULL),(10,'Sebastian Cantor',1015451163,'Kra 118',7730351,'sebas@hotmail.com','sebas1','public/usuarios/10/foto.png',0,'202cb962ac59075b964b07152d234b70',1,1,'2018-11-27 09:52:23',NULL,NULL),(11,'Ronadlo',12345,'Kra 118',7730351,'cr@gmail.com','ronal','public/usuarios/11/foto.png',0,'202cb962ac59075b964b07152d234b70',1,1,'2018-11-28 12:32:08',NULL,NULL);

/* Trigger structure for table `arquitectos` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_Arq` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insert_Arq` AFTER INSERT ON `arquitectos` FOR EACH ROW BEGIN
	INSERT INTO hoja_ruta (Arquitecto, Detalle, STATUS, Created_by, Created_date) VALUES (new.Cedula, 'Pendiente por aprobación', 1, 1, NOW());
    END */$$


DELIMITER ;

/* Trigger structure for table `hoja_ruta` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Update_hojaruta` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Update_hojaruta` AFTER UPDATE ON `hoja_ruta` FOR EACH ROW BEGIN
	UPDATE arquitectos set Status = new.Status WHERE Cedula = new.Arquitecto; 
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
