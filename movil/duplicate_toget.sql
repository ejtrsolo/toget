-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.13-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para yiired
CREATE DATABASE IF NOT EXISTS `yiired` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yiired`;

-- Volcando estructura para tabla yiired.a02_profile
CREATE TABLE IF NOT EXISTS `a02_profile` (
  `a02_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `a01_id` int(11) NOT NULL COMMENT 'Usuario',
  `a02_name` varchar(100) NOT NULL COMMENT 'Nombre',
  `a02_flastname` varchar(100) NOT NULL COMMENT 'Apellido paterno',
  `a02_slastname` varchar(100) NOT NULL COMMENT 'Apellido materno',
  `a02_photo` text NOT NULL COMMENT 'Foto de perfil',
  `c03_id` int(11) DEFAULT NULL COMMENT 'Estado',
  `c02_id` int(11) DEFAULT NULL COMMENT 'País',
  `a02_status` int(11) NOT NULL COMMENT 'Estado',
  `a02_usercreate` int(11) DEFAULT NULL COMMENT 'Usuario de alta',
  `a02_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `a02_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `a02_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`a02_id`),
  KEY `fk_a02_a01_create` (`a02_usercreate`),
  KEY `fk_a02_g02_state` (`c03_id`),
  KEY `fk_a02_g02_country` (`c02_id`),
  KEY `a01_id` (`a01_id`),
  CONSTRAINT `fk_a02_a01_user` FOREIGN KEY (`a01_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_a02_c02` FOREIGN KEY (`c02_id`) REFERENCES `c02_country` (`c02_id`),
  CONSTRAINT `fk_a02_c03_state` FOREIGN KEY (`c03_id`) REFERENCES `c03_states` (`c03_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.a02_profile: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `a02_profile` DISABLE KEYS */;
INSERT INTO `a02_profile` (`a02_id`, `a01_id`, `a02_name`, `a02_flastname`, `a02_slastname`, `a02_photo`, `c03_id`, `c02_id`, `a02_status`, `a02_usercreate`, `a02_datecreate`, `a02_userupdate`, `a02_dateupdate`) VALUES
	(1, 1, 'Ernesto Jacobo', 'Troncoso', 'de la Riva', 'XGY5dc1FlNz4YYosr3WIslNbSbe9stQK.png', 1, 1, 1, NULL, '2016-07-04 13:27:41', 1, '2017-05-22 10:11:29'),
	(2, 2, 'Ernesto', ' ', ' ', 'ca30b0c121576caf4ee326c3544f9fef.jpg', 1, 1, 1, NULL, '2016-07-04 13:27:41', NULL, '2017-05-23 09:02:32'),
	(9, 1, 'dsfgh', 'adfg', 'sdf', 'default.png', 4, 1, 1, 1, '2017-05-23 09:55:01', NULL, NULL),
	(10, 1, 'jhgjg', 'jhgjhg', 'jhgjhg', 'default.png', 5, 1, 1, 1, '2017-05-23 09:57:37', NULL, NULL),
	(11, 1, 'jhgjg', 'jhgjhg', 'jhgjhg', 'default.png', 5, 1, 1, 1, '2017-05-23 09:59:13', NULL, NULL),
	(12, 1, 'jhgjg', 'jhgjhg', 'jhgjhg', 'default.png', 5, 1, 1, 1, '2017-05-23 09:59:17', NULL, NULL),
	(13, 1, 'jhgjg', 'jhgjhg', 'jhgjhg', 'default.png', 5, 1, 1, 1, '2017-05-23 09:59:23', NULL, NULL),
	(14, 1, 'jhgjg', 'jhgjhg', 'jhgjhg', 'default.png', 5, 1, 1, 1, '2017-05-23 09:59:27', NULL, NULL),
	(15, 3, 'jhgjg', 'jhgjhg', 'jhgjhg', 'default.png', 5, 1, 1, 1, '2017-05-23 09:59:34', NULL, NULL);
/*!40000 ALTER TABLE `a02_profile` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla yiired.auth_assignment: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla yiired.auth_item: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla yiired.auth_item_child: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla yiired.auth_rule: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.auth_social
CREATE TABLE IF NOT EXISTS `auth_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `user_id` int(11) NOT NULL COMMENT 'Usuario',
  `source` varchar(255) NOT NULL COMMENT 'Recurso',
  `source_id` varchar(255) NOT NULL COMMENT 'Id recurso',
  PRIMARY KEY (`id`),
  KEY `fk_auth_user_id_user_id` (`user_id`),
  CONSTRAINT `fk_auth_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.auth_social: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_social` DISABLE KEYS */;
INSERT INTO `auth_social` (`id`, `user_id`, `source`, `source_id`) VALUES
	(1, 2, 'facebook', '1415984128417955'),
	(2, 3, 'google', '106497743156457100671');
/*!40000 ALTER TABLE `auth_social` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c01_colores
CREATE TABLE IF NOT EXISTS `c01_colores` (
  `c01_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c01_nombre` varchar(50) NOT NULL COMMENT 'Nombre',
  `c01_r` int(11) NOT NULL COMMENT 'Red',
  `c01_g` int(11) NOT NULL COMMENT 'Green',
  `c01_b` int(11) NOT NULL COMMENT 'Blue',
  `c01_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `c01_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c01_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c01_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c01_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c01_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c01_colores: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `c01_colores` DISABLE KEYS */;
INSERT INTO `c01_colores` (`c01_id`, `c01_nombre`, `c01_r`, `c01_g`, `c01_b`, `c01_status`, `c01_usercreate`, `c01_datecreate`, `c01_userupdate`, `c01_dateupdate`) VALUES
	(1, 'Azul', 65, 70, 153, 1, 1, '2016-11-22 20:04:09', 1, '2016-11-22 21:17:00'),
	(2, 'Rosa', 229, 68, 181, 1, 1, '2016-11-22 20:04:09', NULL, NULL),
	(3, 'Violeta', 134, 56, 153, 1, 1, '2016-11-22 20:04:09', NULL, NULL),
	(5, 'Café', 153, 73, 35, 1, 1, '2016-11-22 20:04:09', NULL, NULL),
	(6, 'Naranja', 255, 87, 17, -1, 2, '2016-11-22 20:04:09', 3, '2017-01-12 11:28:26'),
	(7, 'Blanco', 245, 245, 245, 1, 1, '2016-11-22 20:04:09', NULL, NULL),
	(8, 'hoklahs', 152, 0, 0, 1, 1, '2017-01-14 11:59:35', 1, '2017-01-14 11:59:52');
/*!40000 ALTER TABLE `c01_colores` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c01_viajes
CREATE TABLE IF NOT EXISTS `c01_viajes` (
  `c01_id` int(11) NOT NULL AUTO_INCREMENT,
  `c01_start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `c01_repeat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`c01_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c01_viajes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `c01_viajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `c01_viajes` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c02_country
CREATE TABLE IF NOT EXISTS `c02_country` (
  `c02_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c02_name` varchar(100) NOT NULL COMMENT 'Nombre',
  `c02_active` int(11) NOT NULL COMMENT 'Estatus',
  `c02_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c02_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c02_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c02_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c02_id`),
  KEY `fk_c02_a01_create` (`c02_usercreate`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c02_country: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `c02_country` DISABLE KEYS */;
INSERT INTO `c02_country` (`c02_id`, `c02_name`, `c02_active`, `c02_usercreate`, `c02_datecreate`, `c02_userupdate`, `c02_dateupdate`) VALUES
	(1, 'México', 1, 1, '2016-10-14 13:39:24', NULL, '2016-10-14 13:42:36'),
	(2, 'sdfsdf', 1, 3, '2016-10-14 17:20:22', NULL, NULL);
/*!40000 ALTER TABLE `c02_country` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c03_states
CREATE TABLE IF NOT EXISTS `c03_states` (
  `c03_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c03_name` varchar(100) NOT NULL COMMENT 'Nombre',
  `c03_active` int(11) NOT NULL COMMENT 'Estatus',
  `c03_usercreate` int(11) DEFAULT NULL COMMENT 'Usuario de alta',
  `c03_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c03_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c03_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c03_id`),
  KEY `fk_c03_a01_create` (`c03_usercreate`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c03_states: ~33 rows (aproximadamente)
/*!40000 ALTER TABLE `c03_states` DISABLE KEYS */;
INSERT INTO `c03_states` (`c03_id`, `c03_name`, `c03_active`, `c03_usercreate`, `c03_datecreate`, `c03_userupdate`, `c03_dateupdate`) VALUES
	(1, 'Aguascalientes', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(2, '	Baja California', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(3, 'Baja California Sur', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(4, 'Campeche', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(5, '	Coahuila', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(6, 'Colima', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(7, 'Chiapas', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(8, 'Chihuahua', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(9, 'Ciudad de México', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(10, '	Durango', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(11, 'Guanajuato', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(12, 'Guerrero', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(13, '	Hidalgo', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(14, '	Jalisco', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(15, 'México', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(16, 'Michoacán', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(17, 'Morelos', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(18, 'Nayarit', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(19, '	Nuevo León', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(20, 'Oaxaca', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(21, 'Puebla', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(22, '	Querétaro', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(23, '	Quintana Roo', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(24, '	San Luis Potosí', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(25, 'Sinaloa', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(26, 'Sonora', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(27, 'Tabasco', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(28, 'Tamaulipas', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(29, 'Tlaxcala', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(30, '	Veracruz', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(31, '	Yucatán', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(32, '	Zacatecas', 1, 1, '2016-10-14 13:42:24', NULL, NULL),
	(33, 'sdfsdf', 1, 3, '2016-10-14 17:20:22', NULL, NULL);
/*!40000 ALTER TABLE `c03_states` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c04_mensajes
CREATE TABLE IF NOT EXISTS `c04_mensajes` (
  `c04_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c05_tipo` int(11) NOT NULL COMMENT 'Tipo',
  `c04_mensaje` varchar(500) NOT NULL COMMENT 'Mensaje',
  `g02_tipo_mjs` int(11) NOT NULL COMMENT 'Tipo de mensaje',
  `c04_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `c04_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c04_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c04_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c04_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c04_id`),
  KEY `idTipo` (`c05_tipo`),
  KEY `FK2_c04_g02` (`g02_tipo_mjs`),
  CONSTRAINT `FK1_c04_c05` FOREIGN KEY (`c05_tipo`) REFERENCES `c05_tipos` (`c05_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c04_mensajes: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `c04_mensajes` DISABLE KEYS */;
INSERT INTO `c04_mensajes` (`c04_id`, `c05_tipo`, `c04_mensaje`, `g02_tipo_mjs`, `c04_status`, `c04_usercreate`, `c04_datecreate`, `c04_userupdate`, `c04_dateupdate`) VALUES
	(1, 4, '¡Hey! Ya estoy lleno, ya sácame la basura...', 3, 1, 1, '2016-11-22 20:06:02', NULL, '2016-11-22 20:39:23'),
	(2, 4, '¡Cuidado! Ya casi me lleno...', 4, 1, 1, '2016-11-22 20:06:02', NULL, '2016-11-22 20:39:26'),
	(3, 4, 'Me siento limpio por que no tengo basura...', 5, 1, 1, '2016-11-22 20:06:02', NULL, '2016-11-22 20:39:35'),
	(4, 4, 'Recomendación en mi...', 6, 1, 1, '2016-11-22 20:06:02', NULL, '2016-11-22 20:39:38'),
	(5, 1, 'Cuidado!!! Ya me estoy secando...', 3, 1, 1, '2016-11-22 21:38:46', NULL, NULL);
/*!40000 ALTER TABLE `c04_mensajes` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c05_tipos
CREATE TABLE IF NOT EXISTS `c05_tipos` (
  `c05_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c05_nombre` varchar(50) NOT NULL COMMENT 'Nombre',
  `c05_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `c05_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c05_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c05_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c05_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c05_id`),
  UNIQUE KEY `nombre` (`c05_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c05_tipos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `c05_tipos` DISABLE KEYS */;
INSERT INTO `c05_tipos` (`c05_id`, `c05_nombre`, `c05_status`, `c05_usercreate`, `c05_datecreate`, `c05_userupdate`, `c05_dateupdate`) VALUES
	(1, 'Maceta', 1, 1, '2016-11-22 20:07:39', NULL, NULL),
	(2, 'Televisión', 1, 1, '2016-11-22 20:07:39', NULL, NULL),
	(3, 'Tupperware', 1, 1, '2016-11-22 20:07:39', NULL, NULL),
	(4, 'Bote de basura', 1, 1, '2016-11-22 20:07:39', NULL, NULL);
/*!40000 ALTER TABLE `c05_tipos` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c06_objetos
CREATE TABLE IF NOT EXISTS `c06_objetos` (
  `c06_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c06_nombre` varchar(100) NOT NULL COMMENT 'Nombre',
  `c06_imagen` varchar(200) NOT NULL DEFAULT '404.png' COMMENT 'Imagen',
  `c05_tipo` int(11) NOT NULL COMMENT 'Tipo',
  `c07_dispositivo` int(11) DEFAULT NULL COMMENT 'Dispositivo',
  `c08_persona` int(11) DEFAULT NULL COMMENT 'Persona',
  `c06_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `c06_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c06_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c06_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c06_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c06_id`),
  KEY `idTipo` (`c05_tipo`),
  KEY `idDispositivo` (`c07_dispositivo`),
  KEY `c06_c08` (`c08_persona`),
  CONSTRAINT `c06_c05` FOREIGN KEY (`c05_tipo`) REFERENCES `c05_tipos` (`c05_id`),
  CONSTRAINT `c06_c07` FOREIGN KEY (`c07_dispositivo`) REFERENCES `c07_dispositivos` (`c07_id`),
  CONSTRAINT `c06_c08` FOREIGN KEY (`c08_persona`) REFERENCES `c08_personas` (`c08_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c06_objetos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `c06_objetos` DISABLE KEYS */;
INSERT INTO `c06_objetos` (`c06_id`, `c06_nombre`, `c06_imagen`, `c05_tipo`, `c07_dispositivo`, `c08_persona`, `c06_status`, `c06_usercreate`, `c06_datecreate`, `c06_userupdate`, `c06_dateupdate`) VALUES
	(3, 'Maceta Sala', 'logo.png', 1, 1, 1, 1, 1, '2016-11-22 20:08:19', NULL, NULL),
	(4, 'Televisión sala', '4426.png', 2, NULL, 1, 1, 1, '2016-11-22 20:08:19', NULL, NULL),
	(5, 'Tupper cuarto', '404.png', 3, NULL, 1, 1, 1, '2016-11-22 20:08:19', NULL, '2016-12-04 20:44:41'),
	(6, 'Basura cocina', 'bote.jpg', 4, NULL, 1, 1, 1, '2016-11-22 20:08:19', NULL, NULL);
/*!40000 ALTER TABLE `c06_objetos` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c07_dispositivos
CREATE TABLE IF NOT EXISTS `c07_dispositivos` (
  `c07_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c07_device` varchar(50) NOT NULL COMMENT 'Device',
  `c07_last_con` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Última Conexión',
  `c08_persona` int(11) NOT NULL COMMENT 'Persona',
  `c06_objeto` int(11) DEFAULT NULL COMMENT 'Objeto',
  `c07_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `c07_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c07_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c07_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c07_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c07_id`),
  KEY `idObjeto` (`c06_objeto`),
  KEY `c07_c08` (`c08_persona`),
  CONSTRAINT `c07_c06` FOREIGN KEY (`c06_objeto`) REFERENCES `c06_objetos` (`c06_id`),
  CONSTRAINT `c07_c08` FOREIGN KEY (`c08_persona`) REFERENCES `c08_personas` (`c08_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c07_dispositivos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `c07_dispositivos` DISABLE KEYS */;
INSERT INTO `c07_dispositivos` (`c07_id`, `c07_device`, `c07_last_con`, `c08_persona`, `c06_objeto`, `c07_status`, `c07_usercreate`, `c07_datecreate`, `c07_userupdate`, `c07_dateupdate`) VALUES
	(1, '2302', '2016-04-15 20:10:51', 1, 3, 1, 1, '2016-11-22 20:08:59', NULL, NULL),
	(2, '234', '2016-04-15 20:10:56', 1, NULL, 1, 1, '2016-11-22 20:08:59', NULL, NULL);
/*!40000 ALTER TABLE `c07_dispositivos` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.c08_personas
CREATE TABLE IF NOT EXISTS `c08_personas` (
  `c08_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c08_nombre` varchar(100) NOT NULL COMMENT 'Nombre',
  `c08_apaterno` varchar(80) NOT NULL COMMENT 'Apellido paterno',
  `c08_amaterno` varchar(80) NOT NULL COMMENT 'Apellido materno',
  `c08_imagen` varchar(200) NOT NULL DEFAULT '500.png' COMMENT 'Imagen',
  `c08_usuario` varchar(80) NOT NULL COMMENT 'Usuario',
  `c08_password` text NOT NULL COMMENT 'Contraseña',
  `c08_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `c08_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `c08_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `c08_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `c08_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`c08_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.c08_personas: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `c08_personas` DISABLE KEYS */;
INSERT INTO `c08_personas` (`c08_id`, `c08_nombre`, `c08_apaterno`, `c08_amaterno`, `c08_imagen`, `c08_usuario`, `c08_password`, `c08_status`, `c08_usercreate`, `c08_datecreate`, `c08_userupdate`, `c08_dateupdate`) VALUES
	(1, 'José', 'Hernandez', 'García', 'lock.jpg', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL),
	(2, 'Alejandra', 'Damasco', 'Leyva', 'avatar1.jpg', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL),
	(3, 'Carlos', 'Mendoza', 'Magallanes', '500.png', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL),
	(4, 'Gustavo', 'Castanedo', 'Casas', '500.png', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL),
	(5, 'Mónica', 'Ávila', 'Leyva', '500.png', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL),
	(6, 'Karina', 'Ávila', 'Leyva', '500.png', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL),
	(7, 'Alexis Santiago', 'Troncoso', 'Damasco', '500.png', '0', '', 1, 1, '2016-11-22 20:09:38', NULL, NULL);
/*!40000 ALTER TABLE `c08_personas` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.g01_group
CREATE TABLE IF NOT EXISTS `g01_group` (
  `g01_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `g01_name` varchar(100) NOT NULL COMMENT 'Nombre',
  PRIMARY KEY (`g01_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.g01_group: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `g01_group` DISABLE KEYS */;
INSERT INTO `g01_group` (`g01_id`, `g01_name`) VALUES
	(1, 'Tipo de usuario'),
	(2, 'Tipo de mensajes'),
	(3, 'Repetición de tiempo');
/*!40000 ALTER TABLE `g01_group` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.g02_option
CREATE TABLE IF NOT EXISTS `g02_option` (
  `g02_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `g01_id` int(11) NOT NULL COMMENT 'Grupo',
  `g02_value` int(11) NOT NULL COMMENT 'Valor',
  `g02_descrip` varchar(100) NOT NULL COMMENT 'Descripción',
  `g02_active` int(11) NOT NULL COMMENT 'Estado',
  `g02_usercreate` int(11) NOT NULL COMMENT 'Usuario de alta',
  `g02_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `g02_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `g02_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`g02_id`),
  KEY `fk_g02_a01_create` (`g02_usercreate`),
  KEY `g01_id` (`g01_id`),
  KEY `g02_value` (`g02_value`),
  CONSTRAINT `fk_g02_g01` FOREIGN KEY (`g01_id`) REFERENCES `g01_group` (`g01_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.g02_option: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `g02_option` DISABLE KEYS */;
INSERT INTO `g02_option` (`g02_id`, `g01_id`, `g02_value`, `g02_descrip`, `g02_active`, `g02_usercreate`, `g02_datecreate`, `g02_userupdate`, `g02_dateupdate`) VALUES
	(1, 1, 1, 'Administrador', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(2, 1, 2, 'Normal', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(3, 2, 1, 'Rojo', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(4, 2, 2, 'Amarillo', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(5, 2, 3, 'Verde', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(6, 2, 4, 'Recomendación', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(7, 3, 1, 'Una vez', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(8, 3, 2, 'Cada día', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(9, 3, 3, 'Cada semana', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(10, 3, 4, 'Cada mes', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42'),
	(11, 3, 5, 'Cada año', 1, 1, '2016-07-04 10:35:37', NULL, '2016-11-22 19:30:42');
/*!40000 ALTER TABLE `g02_option` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.menu: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.migration: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1467089787),
	('m130524_201442_init', 1467089789),
	('m140506_102106_rbac_init', 1471720967),
	('m140602_111327_create_menu_table', 1471719964),
	('m160312_050000_create_user', 1471720828);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.r01_recomendaciones
CREATE TABLE IF NOT EXISTS `r01_recomendaciones` (
  `r01_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c08_persona` int(11) NOT NULL COMMENT 'Persona',
  `a01_id` int(11) NOT NULL COMMENT 'Usuario',
  `c06_objeto` int(11) NOT NULL COMMENT 'Objeto',
  `r01_fecha_inicio` date NOT NULL COMMENT 'Fecha de inicio',
  `r01_fecha_fin` date DEFAULT NULL COMMENT 'Fecha de fin',
  `r01_repeticion_tiempo` int(11) NOT NULL COMMENT 'Repetición',
  `r01_hora` time NOT NULL COMMENT 'Hora',
  `r01_duracion_leds` double(6,2) NOT NULL COMMENT 'Duración de led´s',
  `r01_descripcion` varchar(400) DEFAULT NULL COMMENT 'Descripción',
  `r01_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `r01_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `r01_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `r01_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `r01_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`r01_id`),
  KEY `idPersona` (`c08_persona`),
  KEY `idUsuario` (`a01_id`),
  KEY `idUsuario_2` (`a01_id`),
  KEY `idObjeto` (`c06_objeto`),
  CONSTRAINT `res_3` FOREIGN KEY (`c08_persona`) REFERENCES `c08_personas` (`c08_id`),
  CONSTRAINT `res_4` FOREIGN KEY (`a01_id`) REFERENCES `user` (`id`),
  CONSTRAINT `res_5` FOREIGN KEY (`c06_objeto`) REFERENCES `c06_objetos` (`c06_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.r01_recomendaciones: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `r01_recomendaciones` DISABLE KEYS */;
INSERT INTO `r01_recomendaciones` (`r01_id`, `c08_persona`, `a01_id`, `c06_objeto`, `r01_fecha_inicio`, `r01_fecha_fin`, `r01_repeticion_tiempo`, `r01_hora`, `r01_duracion_leds`, `r01_descripcion`, `r01_status`, `r01_usercreate`, `r01_datecreate`, `r01_userupdate`, `r01_dateupdate`) VALUES
	(1, 1, 1, 3, '2015-09-28', '2015-09-28', 1, '23:07:00', 2.00, 'jhgjhg', 1, 1, '2016-11-22 20:10:35', NULL, NULL),
	(3, 1, 1, 3, '2016-02-13', '2016-02-13', 3, '07:48:00', 5.00, 'Prueba', 1, 1, '2016-11-22 20:10:35', NULL, NULL),
	(4, 1, 1, 3, '2016-12-17', '0000-00-00', 1, '23:45:00', 4.00, 'Prueba con registro', 1, 1, '2016-11-22 20:10:35', NULL, '2016-12-04 09:20:58'),
	(5, 1, 1, 4, '2016-04-13', NULL, 1, '11:45:51', 3.00, ' PRUEBA', 1, 1, '2016-11-22 20:10:35', NULL, NULL),
	(6, 1, 1, 5, '2016-12-17', NULL, 7, '17:28:00', 1.00, 'Holaaaaa', 1, 1, '2016-12-04 11:19:40', NULL, NULL),
	(7, 1, 1, 6, '2016-12-22', NULL, 9, '11:53:00', 2.00, 'asdasdsa', 1, 1, '2016-12-04 11:53:46', NULL, NULL),
	(8, 1, 1, 6, '2016-12-22', NULL, 9, '11:53:00', 2.00, 'asdasdsa', 1, 1, '2016-12-04 11:56:22', NULL, NULL),
	(9, 1, 1, 6, '2016-12-22', NULL, 9, '11:53:00', 2.00, 'asdasdsa', 1, 1, '2016-12-04 11:57:00', NULL, NULL),
	(10, 1, 1, 6, '2016-12-22', NULL, 9, '11:53:00', 2.00, 'asdasdsa', 1, 1, '2016-12-04 11:59:40', NULL, NULL),
	(11, 1, 1, 4, '2016-12-29', NULL, 7, '20:25:00', 12.00, 'kjhkdjsh', 1, 1, '2016-12-04 20:26:08', NULL, NULL);
/*!40000 ALTER TABLE `r01_recomendaciones` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.r02_registros
CREATE TABLE IF NOT EXISTS `r02_registros` (
  `r02_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c06_objeto` int(11) NOT NULL COMMENT 'Objeto',
  `c08_persona` int(11) NOT NULL COMMENT 'Persona',
  `r02_recomendacion` int(11) NOT NULL COMMENT 'Recomendación',
  `r02_urgencia` int(11) NOT NULL COMMENT 'Urgencia',
  `r02_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha',
  `r02_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `r02_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `r02_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `r02_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `r02_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`r02_id`),
  KEY `idObjeto` (`c06_objeto`),
  KEY `idPersona` (`c08_persona`),
  CONSTRAINT `res_6` FOREIGN KEY (`c06_objeto`) REFERENCES `c06_objetos` (`c06_id`),
  CONSTRAINT `res_7` FOREIGN KEY (`c08_persona`) REFERENCES `c08_personas` (`c08_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.r02_registros: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `r02_registros` DISABLE KEYS */;
INSERT INTO `r02_registros` (`r02_id`, `c06_objeto`, `c08_persona`, `r02_recomendacion`, `r02_urgencia`, `r02_fecha`, `r02_status`, `r02_usercreate`, `r02_datecreate`, `r02_userupdate`, `r02_dateupdate`) VALUES
	(1, 6, 1, 0, 3, '2016-02-13 13:46:37', 1, 1, '2016-11-22 20:11:19', NULL, NULL),
	(2, 6, 1, 0, 1, '2016-02-12 13:13:22', 1, 1, '2016-11-22 20:11:19', NULL, NULL),
	(3, 6, 1, 0, 2, '2011-12-01 08:43:15', 1, 1, '2016-11-22 20:11:19', NULL, '2016-12-31 10:11:30'),
	(4, 3, 1, 4, 0, '2016-02-14 02:25:22', 1, 1, '2016-11-22 20:11:19', NULL, NULL),
	(5, 6, 1, 0, 2, '2016-02-18 13:19:48', 1, 1, '2016-11-22 20:11:19', NULL, NULL),
	(6, 3, 1, 0, 1, '2016-02-18 03:35:15', 1, 1, '2016-11-22 20:11:19', NULL, NULL);
/*!40000 ALTER TABLE `r02_registros` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.r03_relacion
CREATE TABLE IF NOT EXISTS `r03_relacion` (
  `r03_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c01_color` int(11) NOT NULL COMMENT 'Color',
  `a01_id` int(11) NOT NULL COMMENT 'Usuario',
  `c08_persona` int(11) NOT NULL COMMENT 'Persona',
  `r03_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `r03_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `r03_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `r03_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `r03_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  `cambiarAmigos` int(11) DEFAULT NULL,
  `agregarUsuarios` int(11) DEFAULT NULL,
  `hacerRecomendaciones` int(11) DEFAULT NULL,
  `verCalendario` int(11) DEFAULT NULL,
  `asignarObjetos` int(11) DEFAULT NULL,
  `cambiarPermisos` int(11) DEFAULT NULL,
  `cambiarObjetos` int(11) DEFAULT NULL,
  PRIMARY KEY (`r03_id`),
  KEY `idColor` (`c01_color`),
  KEY `idUsuario` (`a01_id`),
  KEY `idPersona` (`c08_persona`),
  CONSTRAINT `r03_a01` FOREIGN KEY (`a01_id`) REFERENCES `user` (`id`),
  CONSTRAINT `res_13` FOREIGN KEY (`c01_color`) REFERENCES `c01_colores` (`c01_id`),
  CONSTRAINT `res_15` FOREIGN KEY (`c08_persona`) REFERENCES `c08_personas` (`c08_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.r03_relacion: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `r03_relacion` DISABLE KEYS */;
INSERT INTO `r03_relacion` (`r03_id`, `c01_color`, `a01_id`, `c08_persona`, `r03_status`, `r03_usercreate`, `r03_datecreate`, `r03_userupdate`, `r03_dateupdate`, `cambiarAmigos`, `agregarUsuarios`, `hacerRecomendaciones`, `verCalendario`, `asignarObjetos`, `cambiarPermisos`, `cambiarObjetos`) VALUES
	(1, 1, 1, 1, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 1, 1, 1, 1, 1, 1, 1),
	(2, 6, 1, 2, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 1, 1, 0, 0, 0, 0, 0),
	(3, 2, 1, 3, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 0, 1, 1, 0, 0, 0, 0),
	(4, 3, 1, 4, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 0, 1, 0, 0, 0, 0, 0),
	(5, 5, 1, 5, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 0, 0, 0, 0, 0, 0, 0),
	(6, 2, 2, 1, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 0, 1, 1, 1, 1, 1, 0),
	(13, 5, 3, 1, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 0, 1, 1, 0, 0, 0, 0),
	(15, 3, 3, 3, 1, 1, '2016-11-22 20:12:01', NULL, NULL, 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `r03_relacion` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.r04_relacion_permisos
CREATE TABLE IF NOT EXISTS `r04_relacion_permisos` (
  `r04_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `c08_persona` int(11) NOT NULL COMMENT 'Persona',
  `c06_objeto` int(11) NOT NULL COMMENT 'Objeto',
  `a01_id` int(11) NOT NULL COMMENT 'Usuario',
  `r04_recomendacion` int(11) NOT NULL COMMENT 'Recomendación',
  `r04_urgencia` int(11) DEFAULT NULL COMMENT 'Urgencia',
  `r04_status` int(11) NOT NULL DEFAULT '1' COMMENT 'Estatus',
  `r04_usercreate` int(11) NOT NULL DEFAULT '1' COMMENT 'Usuario de alta',
  `r04_datecreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `r04_userupdate` int(11) DEFAULT NULL COMMENT 'Usuario de modificación',
  `r04_dateupdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
  PRIMARY KEY (`r04_id`),
  KEY `idPersona` (`c08_persona`),
  KEY `idObjeto` (`c06_objeto`),
  KEY `idUsuario` (`a01_id`),
  CONSTRAINT `res_10` FOREIGN KEY (`c06_objeto`) REFERENCES `c06_objetos` (`c06_id`),
  CONSTRAINT `res_11` FOREIGN KEY (`a01_id`) REFERENCES `user` (`id`),
  CONSTRAINT `res_9` FOREIGN KEY (`c08_persona`) REFERENCES `c08_personas` (`c08_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla yiired.r04_relacion_permisos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `r04_relacion_permisos` DISABLE KEYS */;
INSERT INTO `r04_relacion_permisos` (`r04_id`, `c08_persona`, `c06_objeto`, `a01_id`, `r04_recomendacion`, `r04_urgencia`, `r04_status`, `r04_usercreate`, `r04_datecreate`, `r04_userupdate`, `r04_dateupdate`) VALUES
	(1, 1, 3, 1, 1, 1, 1, 1, '2016-11-22 20:12:41', NULL, NULL),
	(3, 1, 6, 1, 1, 1, 1, 1, '2016-11-22 20:12:41', NULL, NULL),
	(7, 1, 4, 1, 0, 1, 1, 1, '2016-11-22 20:12:41', NULL, NULL),
	(8, 1, 4, 2, 1, 1, 1, 1, '2016-11-22 20:12:41', NULL, NULL),
	(9, 1, 6, 2, 0, 0, 1, 1, '2016-11-22 20:12:41', NULL, NULL),
	(10, 1, 3, 2, 1, 1, 1, 1, '2016-11-22 20:12:41', NULL, NULL);
/*!40000 ALTER TABLE `r04_relacion_permisos` ENABLE KEYS */;

-- Volcando estructura para tabla yiired.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `FK1_a01_g02` (`tipo`),
  CONSTRAINT `FK1_a01_g02` FOREIGN KEY (`tipo`) REFERENCES `g02_option` (`g02_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla yiired.user: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `tipo`) VALUES
	(1, 'ejtrsolo', 'kzrKAxiGj8cNyww-MT3o_psMvpXKI_fM', '$2y$13$WP/QPPya2hyOGi2lg03upe7WV1K6RHTiWBZ1NP.teTG5SGfzHG8hS', 'j6eYJAOgRfs2qD_agAxss2LPDvs96oOo_1484492130', 'ejtrsolo@gmail.com', 10, 1467090732, 1494475257, 1),
	(2, 'Ernesto Troncoso De La Riva', 'qRBYCFDH0dTwbYReXRgWzjuTYwq-8Na8', '$2y$13$iLvJV4iIxzTWuaAuzH.yquoMl5Me1IduJAhDG3Ipq7mRNKh65V9P2', NULL, 'loko_ernez@hotmail.com', 10, 1471738425, 1471738425, 2),
	(3, 'Ernesto Troncoso', 'w3XszWV09-BQ6UZUY-tmcc8bWpVOLaNw', '$2y$13$tcI4ghbZWhIDWcJgWk26he9RLBYt5No52p2OGpkTLIL4HCN8G.aZO', NULL, 'ejtr.solo@gmail.com', 10, 1472173373, 1472173373, 2),
	(4, 'admin', 'kzrKAxiGj8cNyww-MT3o_psMvpXKI_fM', '$2y$13$pmt9HaS.qya0n4pNb/kmzu.ZvC1D0YSHuAbxkayorM.F06U1mDtoe', '$2y$13$pmt9HaS.qya0n4pNb/kmzu.ZvC1D0YSHuAbxkayorM.F06U1mDtoe', 'prueba4@gmail.com', 10, 1479786483, 1479786483, 2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
