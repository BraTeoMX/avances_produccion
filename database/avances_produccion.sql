-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para avances_produccion
CREATE DATABASE IF NOT EXISTS `avances_produccion` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `avances_produccion`;

-- Volcando estructura para tabla avances_produccion.cat_areas
CREATE TABLE IF NOT EXISTS `cat_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.cat_areas: ~9 rows (aproximadamente)
INSERT INTO `cat_areas` (`id`, `area`) VALUES
	(1, 'BELL'),
	(2, 'BN3'),
	(3, 'CH'),
	(4, 'MAR'),
	(5, 'NUDS'),
	(6, 'ELITE'),
	(7, 'EMPAQUE'),
	(8, 'ENNTO'),
	(9, 'VS');

-- Volcando estructura para tabla avances_produccion.cat_clientes
CREATE TABLE IF NOT EXISTS `cat_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientes` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.cat_clientes: ~10 rows (aproximadamente)
INSERT INTO `cat_clientes` (`id`, `clientes`) VALUES
	(1, 'V.S'),
	(2, 'CH'),
	(3, 'BN3'),
	(4, 'NUDS'),
	(5, 'BELL'),
	(6, 'LEQ'),
	(7, 'MAR'),
	(8, 'ELITE'),
	(9, 'EMPAQUE'),
	(10, 'ENTTO');

-- Volcando estructura para tabla avances_produccion.cat_modulos
CREATE TABLE IF NOT EXISTS `cat_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Modulo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.cat_modulos: ~47 rows (aproximadamente)
INSERT INTO `cat_modulos` (`id`, `Modulo`) VALUES
	(1, '101A'),
	(2, '102A'),
	(3, '103A'),
	(4, '104A'),
	(5, '105A'),
	(6, '107A'),
	(7, '110A'),
	(8, '111A'),
	(9, '112A'),
	(10, '113A'),
	(11, '114A'),
	(12, '115A'),
	(13, '117A'),
	(14, '118A'),
	(15, '120A'),
	(16, '121A'),
	(17, '122A'),
	(18, '123A'),
	(19, '125A'),
	(20, '127A'),
	(21, '128A'),
	(22, '130A'),
	(23, '131A'),
	(24, '133A'),
	(25, '138A'),
	(26, '139A'),
	(27, '140A'),
	(28, '143A'),
	(29, '148A'),
	(30, '150A'),
	(31, '152A'),
	(32, '154A'),
	(33, '162A'),
	(34, '164A'),
	(35, '167A'),
	(36, '168A'),
	(37, '172A'),
	(38, '199A'),
	(39, '830A'),
	(40, '119A'),
	(41, '124A'),
	(42, '126A'),
	(43, '135A'),
	(44, '136A'),
	(45, '146A'),
	(46, '147A'),
	(47, '149A');

-- Volcando estructura para tabla avances_produccion.cat_team_leader
CREATE TABLE IF NOT EXISTS `cat_team_leader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_leader` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.cat_team_leader: ~16 rows (aproximadamente)
INSERT INTO `cat_team_leader` (`id`, `team_leader`) VALUES
	(1, 'ALEJANDRA'),
	(2, 'AMBAR'),
	(3, 'ANGELA'),
	(4, 'ARACELI'),
	(5, 'DOMINGO'),
	(6, 'ELIAS'),
	(7, 'ELVIA'),
	(8, 'FAUSTINO'),
	(9, 'FRANCISCO'),
	(10, 'GUADALUPE'),
	(11, 'HEIDI'),
	(12, 'J. CARLOS'),
	(13, 'LORENA'),
	(14, 'MARENA'),
	(15, 'NOE'),
	(16, 'RAYMUNDO');

-- Volcando estructura para tabla avances_produccion.formato_p07
CREATE TABLE IF NOT EXISTS `formato_p07` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicial` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `planta` varchar(50) DEFAULT NULL,
  `cliente` varchar(50) DEFAULT NULL,
  `modulo` varchar(50) DEFAULT NULL,
  `cantidad_d1` varchar(50) DEFAULT NULL,
  `eficiencia_d1` varchar(50) DEFAULT NULL,
  `minutos_prod_d1` varchar(50) DEFAULT NULL,
  `minutos_100_d1` varchar(50) DEFAULT NULL,
  `cantidad_d2` varchar(50) DEFAULT NULL,
  `eficiencia_d2` varchar(50) DEFAULT NULL,
  `minutos_prod_d2` varchar(50) DEFAULT NULL,
  `minutos_100_d2` varchar(50) DEFAULT NULL,
  `cantidad_d3` varchar(50) DEFAULT NULL,
  `eficiencia_d3` varchar(50) DEFAULT NULL,
  `minutos_prod_d3` varchar(50) DEFAULT NULL,
  `minutos_100_d3` varchar(50) DEFAULT NULL,
  `cantidad_d4` varchar(50) DEFAULT NULL,
  `eficiencia_d4` varchar(50) DEFAULT NULL,
  `minutos_prod_d4` varchar(50) DEFAULT NULL,
  `minutos_100_d4` varchar(50) DEFAULT NULL,
  `cantidad_d5` varchar(50) DEFAULT NULL,
  `eficiencia_d5` varchar(50) DEFAULT NULL,
  `minutos_prod_d5` varchar(50) DEFAULT NULL,
  `minutos_100_d5` varchar(50) DEFAULT NULL,
  `cantidad_total` varchar(50) DEFAULT NULL,
  `eficiencia_total` varchar(50) DEFAULT NULL,
  `minutos_prod_total` varchar(50) DEFAULT NULL,
  `minutos_100_total` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.formato_p07: ~18 rows (aproximadamente)
INSERT INTO `formato_p07` (`id`, `fecha_inicial`, `fecha_final`, `planta`, `cliente`, `modulo`, `cantidad_d1`, `eficiencia_d1`, `minutos_prod_d1`, `minutos_100_d1`, `cantidad_d2`, `eficiencia_d2`, `minutos_prod_d2`, `minutos_100_d2`, `cantidad_d3`, `eficiencia_d3`, `minutos_prod_d3`, `minutos_100_d3`, `cantidad_d4`, `eficiencia_d4`, `minutos_prod_d4`, `minutos_100_d4`, `cantidad_d5`, `eficiencia_d5`, `minutos_prod_d5`, `minutos_100_d5`, `cantidad_total`, `eficiencia_total`, `minutos_prod_total`, `minutos_100_total`, `created_at`, `update_at`, `deleted_at`) VALUES
	(2, '2023-11-06', '2023-11-10', 'Planta I', 'NU Chicos PI 1T', '101A', '461', '36.7', '6576', '17905', '489', '38.9', '6969', '17905', '516', '41.1', '7361', '17905', '627', '40', '7156', '17905', '515', '38', '3886', '10231', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(3, '2023-11-06', '2023-11-10', 'Planta I', 'Chicos  PI  1T', '121A', '316', '36.2', '6255', '17287', '242', '32.8', '5669', '17287', '198', '31.5', '5452', '17287', '211', '33.7', '5829', '17287', '125', '35', '3454', '9878', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(4, '2023-11-06', '2023-11-10', 'Planta I', 'NU Chicos PI 1T', '162A', '701', '30.6', '4161', '13583', '749', '32.3', '4382', '13583', '799', '34.5', '4680', '13583', '850', '36.6', '4977', '13583', '502', '37.9', '2941', '7762', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(5, '2023-11-06', '2023-11-10', 'Planta I', 'Chicos  PI  1T', '148A', '429', '68.2', '3368', '4939', '440', '70', '3457', '4939', '440', '70', '3456', '4939', '440', '70', '3457', '4939', '251', '70', '1976', '2822', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(6, '2023-11-06', '2023-11-10', 'Planta I', 'NU PI 1T', '168A', '481', '68.4', '3383', '4945', '492', '70', '3463', '4945', '492', '70', '3462', '4945', '448', '70', '3462', '4945', '252', '70', '1978', '2826', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(7, '2023-11-06', '2023-11-10', 'Planta I', 'NU PI 1T', '107A', '362', '43.2', '4266', '9878', '381', '45.4', '4482', '9878', '398', '47.4', '4684', '9878', '412', '49.1', '4848', '9878', '240', '50', '2822', '5645', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(8, '2023-11-06', '2023-11-10', 'Planta I', 'NU PI 1T', '110A', '250', '31.7', '4111', '12965', '254', '33.6', '4362', '12965', '241', '35.8', '4645', '12965', '256', '38', '4929', '12965', '151', '39.3', '2909', '7409', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(9, '2023-11-06', '2023-11-10', 'Planta I', 'Chicos  PI  1T', '103A', '1009', '100', '4321', '4322', '1010', '100.1', '4324', '4322', '1010', '100.1', '4324', '4322', '1009', '100', '4321', '4322', '577', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(10, '2023-11-06', '2023-11-10', 'Planta I', 'Chicos  PI  1T', '128A', '1010', '100', '4322', '4322', '1010', '100', '4323', '4322', '1009', '100', '4321', '4322', '1009', '100', '4320', '4322', '577', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(11, '2023-11-06', '2023-11-10', 'Planta I', 'Chicos  PI  1T', '150A', '288', '25.9', '1232', '4763', '309', '27.7', '1322', '4763', '330', '29.6', '1411', '4763', '413', '31.8', '1768', '5557', '245', '33.1', '1050', '3175', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(12, '2023-11-06', '2023-11-10', 'Planta I', 'BN3  PI 1T', '133A', '740', '63.8', '7094', '11113', '795', '65.2', '7245', '11113', '817', '67', '7446', '11113', '840', '68.8', '7649', '11113', '486', '69.7', '4428', '6350', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(13, '2023-11-06', '2023-11-10', 'Planta I', 'BN3  PI 1T', '199A', '162', '25', '2161', '8644', '165', '25', '2163', '8644', '151', '25', '2162', '8644', '161', '25', '2162', '8644', '105', '25', '1235', '4939', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(14, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '152A', '693', '85', '3674', '4322', '693', '85', '3673', '4322', '693', '85', '3674', '4322', '693', '85', '3674', '4322', '396', '85', '2099', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(15, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '167A', '816', '100', '4322', '4322', '816', '100', '4322', '4322', '816', '100', '4323', '4322', '816', '100', '4322', '4322', '466', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(16, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '138A', '1003', '86.2', '3724', '4322', '1028', '88.4', '3819', '4322', '1052', '90.4', '3908', '4322', '1072', '92.1', '3980', '4322', '618', '93', '2296', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(17, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '111A', '712', '61.2', '2645', '4322', '737', '63.4', '2738', '4322', '762', '65.4', '2828', '4322', '780', '67.1', '2899', '4322', '452', '68', '1679', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(18, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '114A', '689', '59.2', '2558', '4322', '714', '61.4', '2652', '4322', '740', '63.6', '2747', '4322', '763', '65.6', '2834', '4322', '442', '66.5', '1643', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(19, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '105A', '1023', '100', '4322', '4322', '1056', '100', '4321', '4322', '1039', '100', '4323', '4322', '1009', '96.7', '4180', '4322', '490', '74.6', '1844', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(20, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '118A', '1060', '100', '4320', '4322', '1034', '100', '4322', '4322', '1076', '100', '4321', '4322', '1031', '100', '4321', '4322', '585', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(21, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '139A', '1035', '90.1', '3896', '4322', '1054', '91.8', '3967', '4322', '1074', '93.5', '4042', '4322', '1100', '95.8', '4139', '4322', '636', '97', '2395', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(22, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '172A', '1149', '100.1', '4324', '4322', '1148', '100', '4321', '4322', '1148', '100', '4321', '4322', '1148', '100', '4323', '4322', '656', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(23, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '120A', '1148', '100', '4323', '4322', '1148', '100', '4322', '4322', '1148', '100', '4320', '4322', '1148', '100', '4323', '4322', '656', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(24, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '122A', '989', '86.2', '3724', '4322', '1014', '88.4', '3818', '4322', '1038', '90.4', '3908', '4322', '1057', '92', '3977', '4322', '610', '93', '2297', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(25, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '123A', '1035', '90.2', '3897', '4322', '1053', '91.8', '3965', '4322', '1074', '93.5', '4042', '4322', '1100', '95.8', '4139', '4322', '636', '97', '2396', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(26, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '143A', '828', '72.1', '3117', '4322', '847', '73.8', '3188', '4322', '867', '75.6', '3265', '4322', '893', '77.7', '3360', '4322', '518', '79', '1951', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(27, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '115A', '1640', '100', '4321', '4322', '1640', '100', '4323', '4322', '1640', '100', '4322', '4322', '1640', '100', '4322', '4322', '937', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(28, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '130A', '1690', '97', '4194', '4322', '1739', '98.8', '4270', '4322', '1772', '100', '4322', '4322', '1772', '100', '4322', '4322', '1013', '100', '2470', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(29, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '113A', '435', '26.2', '1132', '4322', '472', '28.4', '1227', '4322', '508', '30.6', '1321', '4322', '544', '32.8', '1416', '4322', '323', '34', '839', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(30, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '140A', '1462', '88.2', '3811', '4322', '1500', '90.3', '3901', '4322', '1527', '91.9', '3970', '4322', '1558', '93.7', '4052', '4322', '902', '95', '2346', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(31, '2023-11-06', '2023-11-10', 'Planta I', 'VS  PI 1T', '117A', '76', '4.6', '197', '4322', '148', '8.9', '386', '4322', '214', '12.9', '556', '4322', '263', '15.8', '683', '4322', '166', '17.5', '431', '2470', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(32, '2023-11-06', '2023-11-10', 'Planta I', 'Marena 1T', '131A', '247', '32', '1777', '5557', '242', '32', '1778', '5557', '242', '32', '1779', '5557', '234', '32', '1779', '5557', '102', '32', '1016', '3175', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(33, '2023-11-06', '2023-11-10', 'Planta I', 'Marena 1T', '154A', '355', '45', '1389', '3087', '285', '45', '1389', '3087', '583', '45', '1389', '3087', '303', '45', '1389', '3087', '225', '45', '794', '1764', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(34, '2023-11-06', '2023-11-10', 'Planta I', 'Marena 1T', '127A', '213', '34', '2310', '6791', '192', '34', '2310', '6791', '284', '34', '2309', '6791', '245', '34', '2309', '6791', '110', '34', '1319', '3881', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL),
	(35, '2023-11-06', '2023-11-10', 'Planta I', 'Pacific  PI 1T', '141A', '310', '41.2', '5340', '12965', '327', '43.4', '5623', '12965', '343', '45.6', '5907', '12965', '358', '47.6', '6166', '12965', '209', '48.5', '3593', '7409', '117464', '58.1', '587823', '1010888', NULL, NULL, NULL);

-- Volcando estructura para tabla avances_produccion.indicadores
CREATE TABLE IF NOT EXISTS `indicadores` (
  `id` int(11) DEFAULT NULL,
  `indicador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.indicadores: ~0 rows (aproximadamente)

-- Volcando estructura para tabla avances_produccion.planeacion
CREATE TABLE IF NOT EXISTS `planeacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `team_leader` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `modulo` varchar(50) DEFAULT NULL,
  `estilo` varchar(50) DEFAULT NULL,
  `op_real` varchar(50) DEFAULT NULL COMMENT 'operadores reales',
  `op_presencia` varchar(50) DEFAULT NULL COMMENT 'operadores presencia',
  `pxhrs` varchar(50) DEFAULT NULL COMMENT 'permisos x hora',
  `capacitacion` varchar(50) DEFAULT NULL,
  `utility` varchar(50) DEFAULT NULL,
  `sam_P07` varchar(50) DEFAULT NULL COMMENT 'Ax',
  `meta_proyectada` varchar(50) DEFAULT NULL COMMENT 'Fast React',
  `sam` varchar(50) DEFAULT NULL COMMENT '= sam P07',
  `piezas_meta` varchar(50) DEFAULT NULL COMMENT 'Fast REact',
  `mix_x_producir` varchar(50) DEFAULT NULL COMMENT 'piezas meta x sam',
  `min_presencia` varchar(50) DEFAULT NULL COMMENT 'op presencia * tiempo de desocupacion',
  `min_presencia_netos` varchar(50) DEFAULT NULL COMMENT '(min presencia -(pxhrs+capcacitacion))+ utility',
  `eficiencia_meta` varchar(50) DEFAULT NULL COMMENT 'min x producir / min presencia netos',
  `eficiencira_real` varchar(50) DEFAULT NULL COMMENT 'eficiencia meta  *100',
  `eficiencia_P07_pago` varchar(50) DEFAULT NULL COMMENT 'FastReact',
  `tiempo_desocupacion` varchar(50) DEFAULT NULL COMMENT '630*0.98',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.planeacion: ~38 rows (aproximadamente)
INSERT INTO `planeacion` (`id`, `fecha`, `team_leader`, `area`, `modulo`, `estilo`, `op_real`, `op_presencia`, `pxhrs`, `capacitacion`, `utility`, `sam_P07`, `meta_proyectada`, `sam`, `piezas_meta`, `mix_x_producir`, `min_presencia`, `min_presencia_netos`, `eficiencia_meta`, `eficiencira_real`, `eficiencia_P07_pago`, `tiempo_desocupacion`) VALUES
	(2, '2023-11-09', '1', '1', '125A', '11173458', '4', '3', '0', '0', '0', '0', '0', '0', '6968', '1852', '1852', '1852', '1', '100', '100', '617'),
	(3, '2023-11-09', '15', '1', '105A', '11229158', '7', '7', '0', '0', '0', '4', '1039', '4', '1039', '4322', '4322', '4322', '1', '100', '100', '617'),
	(4, '2023-11-09', '15', '1', '118A', '11229158', '7', '7', '0', '0', '0', '4', '1076', '4', '1076', '4322', '4322', '4322', '1', '100', '100', '617'),
	(5, '2023-11-09', '5', '1', '111A', '11202010', '7', '7', '0', '0', '0', '4', '762', '4', '762', '2830', '4322', '4322', '1', '65', '65', '617'),
	(6, '2023-11-09', '5', '1', '114A', '11202010', '7', '7', '0', '0', '630', '4', '740', '4', '846', '3142', '4322', '4952', '1', '63', '64', '617'),
	(7, '2023-11-09', '5', '1', '130A', '11214898', '7', '7', '0', '0', '0', '2', '1772', '2', '1772', '4396', '4322', '4322', '1', '100', '100', '617'),
	(8, '2023-11-09', '5', '1', '138A', '11202010', '7', '7', '0', '0', '630', '4', '1052', '4', '1202', '4464', '4322', '4952', '1', '90', '90', '617'),
	(9, '2023-11-09', '12', '1', '113A', '11214897', '7', '7', '0', '0', '0', '3', '508', '3', '508', '1321', '4322', '4322', '0', '31', '31', '617'),
	(10, '2023-11-09', '12', '1', '117A', '11160742', '7', '7', '0', '0', '0', '3', '214', '3', '214', '556', '4322', '4322', '0', '13', '13', '617'),
	(11, '2023-11-09', '2', '1', '115A', '11219207', '7', '7', '0', '0', '0', '3', '1640', '3', '1640', '4322', '4322', '4322', '1', '100', '100', '617'),
	(12, '2023-11-09', '2', '1', '140A', '11160742', '7', '7', '0', '0', '0', '3', '1527', '3', '1527', '3971', '4322', '4322', '1', '92', '92', '617'),
	(13, '2023-11-09', '11', '1', '139A', '11173458', '7', '7', '0', '0', '0', '4', '1074', '4', '1074', '4043', '4322', '4322', '1', '94', '94', '617'),
	(14, '2023-11-09', '11', '1', '152A', '11229151', '7', '7', '0', '630', '630', '5', '693', '5', '693', '3672', '4322', '4322', '1', '85', '85', '617'),
	(15, '2023-11-09', '11', '1', '167A', '11229151', '7', '7', '0', '0', '0', '5', '816', '5', '816', '4324', '4322', '4322', '1', '100', '100', '617'),
	(16, '2023-11-09', '11', '1', '103A', '11202010', '7', '7', '0', '0', '0', '4', '1010', '4', '582', '2161', '4322', '4322', '1', '50', '50', '617'),
	(17, '2023-11-09', '11', '1', '128A', '11160742', '7', '7', '0', '0', '0', '3', '1009', '3', '831', '2161', '4322', '4322', '0', '50', '50', '617'),
	(18, '2023-11-09', '1', '1', '120A', '11173458', '7', '7', '0', '0', '0', '4', '1148', '4', '1148', '4321', '4322', '4322', '1', '100', '100', '617'),
	(19, '2023-11-09', '1', '1', '122A', '11173458', '7', '6', '0', '0', '630', '4', '1038', '4', '1038', '3907', '3704', '4334', '1', '90', '90', '617'),
	(20, '2023-11-09', '1', '1', '123A', '11173458', '7', '6', '0', '0', '630', '4', '1074', '4', '1074', '4043', '3704', '4334', '1', '93', '94', '617'),
	(21, '2023-11-09', '1', '1', '143A', '11173458', '7', '7', '0', '0', '0', '4', '867', '4', '867', '3263', '4322', '4322', '1', '76', '76', '617'),
	(22, '2023-11-09', '1', '1', '172A', '11173458', '7', '7', '0', '0', '0', '4', '1148', '4', '1148', '4321', '4322', '4322', '1', '100', '100', '617'),
	(23, '2023-11-09', '6', '2', '101A', '070-23C110832', '29', '29', '0', '1260', '1260', '14', '516', '14', '516', '7470', '17905', '17905', '0', '42', '41', '617'),
	(24, '2023-11-09', '8', '2', '121A', '070-21C98335', '28', '28', '0', '1260', '1260', '27', '198', '27', '198', '5265', '17287', '17287', '0', '30', '30', '617'),
	(25, '2023-11-09', '4', '2', '148A', '670-14C01523', '8', '8', '0', '0', '0', '8', '440', '8', '440', '3458', '4939', '4939', '1', '70', '70', '617'),
	(26, '2023-11-09', '4', '2', '168A', '14C02208R', '8', '8', '0', '630', '630', '7', '492', '7', '397', '2790', '4939', '4939', '1', '56', '57', '617'),
	(27, '2023-11-09', '12', '2', '150A', '007-21C96563', '8', '8', '0', '0', '0', '4', '330', '4', '330', '1413', '4939', '4939', '0', '29', '30', '617'),
	(28, '2023-11-09', '10', '2', '162A', '30826', '21', '21', '0', '630', '1260', '6', '799', '6', '799', '4690', '12965', '13595', '0', '34', '35', '617'),
	(29, '2023-11-09', '2', '3', '133A', 'M111026', '17', '17', '0', '0', '630', '9', '817', '9', '816', '7450', '10496', '11126', '1', '67', '67', '617'),
	(30, '2023-11-09', '4', '4', '107A', 'W-183', '16', '15', '0', '1890', '2520', '12', '398', '12', '398', '4685', '9261', '9891', '0', '47', '47', '617'),
	(31, '2023-11-09', '7', '5', '110A', '9015', '21', '19', '0', '0', '630', '17', '241', '17', '256', '4416', '11731', '12361', '0', '36', '36', '617'),
	(32, '2023-11-09', '15', '6', '141A', 'AMC0030', '21', '21', '0', '630', '1890', '17', '343', '17', '389', '6474', '12965', '14225', '0', '46', '46', '617'),
	(33, '2023-11-09', '3', '7', '154A', 'AB3', '5', '4', '0', '0', '0', '5', '583', '5', '228', '1112', '2470', '2470', '0', '45', '45', '617'),
	(34, '2023-11-09', '9', '7', '131A', 'LGA', '8', '8', '0', '0', '630', '7', '242', '7', '242', '1777', '4939', '5569', '0', '32', '32', '617'),
	(35, '2023-11-09', '3', '7', '127A', 'FBA', '11', '11', '0', '0', '630', '12', '284', '12', '209', '2515', '6791', '7421', '0', '34', '34', '617'),
	(36, '2023-11-09', '13', '8', '199A', 'NOM-ENTRENAMIENTO', '13', '13', '0', '0', '0', '13', '151', '13', '151', '2010', '8026', '8026', '0', '25', '25', '617'),
	(37, '2023-11-09', ' ', '1', '198A', 'NOM-ENTRENAMIENTO', '27', '15', '0', '2520', '2520', '0', '0', '0', '1', '0', '9261', '9261', '0', '1', '0', '617'),
	(38, '2023-11-09', '12', '10', '802A', 'NOM-ENTRENAMIENTO', '7', '7', '0', '0', '0', '0', '348', '0', '1', '0', '4322', '4322', '0', '1', '0', '617'),
	(39, '2023-11-09', '16', '9', '830A', 'EMPAQUE', '15', '15', '0', '0', '0', '0', '0', '1', '7429', '6761', '9261', '9261', '1', '0', '0', '617');

-- Volcando estructura para tabla avances_produccion.planeación_diaria
CREATE TABLE IF NOT EXISTS `planeación_diaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_planeacion` int(11) DEFAULT NULL,
  `meta_10` int(11) DEFAULT NULL,
  `piezas_10` int(11) DEFAULT NULL,
  `efic_10` int(11) DEFAULT NULL,
  `min_prod_10` int(11) DEFAULT NULL,
  `proy_min_10` int(11) DEFAULT NULL,
  `meta_11` int(11) DEFAULT NULL,
  `piezas_11` int(11) DEFAULT NULL,
  `efic_11` int(11) DEFAULT NULL,
  `min_prod_11` int(11) DEFAULT NULL,
  `proy_min_11` int(11) DEFAULT NULL,
  `meta_12` int(11) DEFAULT NULL,
  `piezas_12` int(11) DEFAULT NULL,
  `efic_12` int(11) DEFAULT NULL,
  `min_prod_12` int(11) DEFAULT NULL,
  `proy_min_12` int(11) DEFAULT NULL,
  `meta_13` int(11) DEFAULT NULL,
  `piezas_13` int(11) DEFAULT NULL,
  `efic_13` int(11) DEFAULT NULL,
  `min_prod_13` int(11) DEFAULT NULL,
  `proy_min_13` int(11) DEFAULT NULL,
  `meta_14` int(11) DEFAULT NULL,
  `piezas_14` int(11) DEFAULT NULL,
  `efic_14` int(11) DEFAULT NULL,
  `min_prod_14` int(11) DEFAULT NULL,
  `proy_min_14` int(11) DEFAULT NULL,
  `meta_15` int(11) DEFAULT NULL,
  `piezas_15` int(11) DEFAULT NULL,
  `efic_15` int(11) DEFAULT NULL,
  `min_prod_15` int(11) DEFAULT NULL,
  `proy_min_15` int(11) DEFAULT NULL,
  `meta_16` int(11) DEFAULT NULL,
  `piezas_16` int(11) DEFAULT NULL,
  `min_prod_16` int(11) DEFAULT NULL,
  `proy_min_16` int(11) DEFAULT NULL,
  `meta_17` int(11) DEFAULT NULL,
  `piezas_17` int(11) DEFAULT NULL,
  `efic_17` int(11) DEFAULT NULL,
  `min_prod_17` int(11) DEFAULT NULL,
  `proy_min_17` int(11) DEFAULT NULL,
  `meta_18` int(11) DEFAULT NULL,
  `piezas_18` int(11) DEFAULT NULL,
  `efic_18` int(11) DEFAULT NULL,
  `min_prod_18` int(11) DEFAULT NULL,
  `proy_min_18` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Índice 2` (`id_planeacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.planeación_diaria: ~0 rows (aproximadamente)

-- Volcando estructura para tabla avances_produccion.team_modulo
CREATE TABLE IF NOT EXISTS `team_modulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_leader` int(11) DEFAULT NULL,
  `modulo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla avances_produccion.team_modulo: ~45 rows (aproximadamente)
INSERT INTO `team_modulo` (`id`, `team_leader`, `modulo`) VALUES
	(1, 6, 1),
	(2, 0, 2),
	(3, 11, 3),
	(4, 15, 4),
	(5, 15, 5),
	(6, 4, 6),
	(7, 7, 7),
	(8, 12, 8),
	(9, 5, 9),
	(10, 12, 10),
	(11, 12, 11),
	(12, 2, 12),
	(13, 11, 13),
	(14, 15, 14),
	(15, 1, 15),
	(16, 8, 16),
	(17, 1, 17),
	(18, 1, 18),
	(19, 1, 19),
	(20, 3, 20),
	(21, 11, 21),
	(22, 5, 22),
	(23, 9, 23),
	(24, 2, 24),
	(25, 5, 25),
	(26, 11, 26),
	(27, 2, 27),
	(28, 1, 28),
	(29, 4, 29),
	(30, 12, 30),
	(31, 11, 31),
	(32, 3, 32),
	(33, 10, 33),
	(34, 5, 34),
	(35, 11, 35),
	(36, 4, 36),
	(37, 1, 37),
	(38, 13, 38),
	(39, 16, 39),
	(40, 2, 40),
	(41, 15, 41),
	(42, 15, 42),
	(43, 3, 43),
	(44, 10, 44),
	(45, 6, 45);

-- Volcando estructura para tabla avances_produccion.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `no_empleado` varchar(20) NOT NULL,
  `password` varchar(191) DEFAULT NULL,
  `puesto` varchar(200) DEFAULT NULL,
  `inactivo` varchar(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `fecha_ultimo_acceso` datetime DEFAULT NULL,
  `fecha_ultima_notificacion` datetime DEFAULT NULL,
  `usuario_creacion_id` bigint(20) unsigned DEFAULT NULL,
  `usuario_actualizacion_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE,
  UNIQUE KEY `users_no_empleado_unique` (`no_empleado`) USING BTREE,
  KEY `users_usuario_creacion_id_foreign` (`usuario_creacion_id`) USING BTREE,
  KEY `users_usuario_actualizacion_id_foreign` (`usuario_actualizacion_id`) USING BTREE,
  KEY `Índice 6` (`password`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=490 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla avances_produccion.users: 131 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `no_empleado`, `password`, `puesto`, `inactivo`, `remember_token`, `fecha_ultimo_acceso`, `fecha_ultima_notificacion`, `usuario_creacion_id`, `usuario_actualizacion_id`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador del Sistema', 'admin@hotmail.com', '1', '$2y$10$Rq5ZnRyS8TYIKaV4yVb8hubGOJ1eI57d2C4.h/0FwjVDuAPsenqYS', 'administrador', '0', NULL, '2023-03-23 12:22:49', '2023-02-01 00:00:00', NULL, NULL, '2020-11-04 19:34:26', '2023-03-23 18:22:49'),
	(2, 'Gerardo Vergara Mendoza', 'gvm7506@gmail.com', '2', '$2y$10$Rq5ZnRyS8TYIKaV4yVb8hubGOJ1eI57d2C4.h/0FwjVDuAPsenqYS', 'Administrador', '0', NULL, '2023-10-25 11:05:16', '2023-02-01 00:00:00', NULL, NULL, '2020-11-04 19:34:26', '2023-10-25 17:05:16'),
	(474, 'AZUCENA GIL BALDERAS', 'azgil@intimark .com.mx', '515795', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-20 18:08:10', NULL, NULL, NULL, '2023-04-21 00:07:50', '2023-04-21 00:08:10'),
	(473, 'IVONNE LOPEZ MARTINEZ', 'ilopez@intimark.com.mx', '22183', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-25 18:58:10', NULL, NULL, NULL, '2023-04-20 23:12:15', '2023-04-26 00:58:10'),
	(472, 'francisco david lopez balderas', 'supinventarios@intimark.com.mx', '9996', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-04-26 15:45:35', '2023-05-17 00:00:00', NULL, NULL, '2023-04-20 21:42:43', '2023-05-17 15:46:24'),
	(471, 'MARITZA GONZALEZ CHIMAL', 'mgonzalez@intimark.com.mx', '10444', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE DE COSTOS Y RUTAS DE FABRICACION', '0', NULL, NULL, '2023-04-20 00:00:00', NULL, NULL, '2023-04-20 15:04:16', '2023-04-20 15:04:16'),
	(470, 'Salvador Flores Huitron', 'sflores@intimark.com.mx', '507019', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-06-27 10:08:16', NULL, NULL, NULL, '2023-04-18 18:26:47', '2023-06-27 16:08:16'),
	(469, 'AZUCENA GIL BALDERAS', 'azgil@intimark.com.mx', '05015795', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', 'X', NULL, '2023-04-18 12:37:58', '2023-05-17 00:00:00', NULL, NULL, '2023-04-18 18:19:17', '2023-05-17 15:49:48'),
	(468, 'ARACELI CORDERO PIÑA ', 'araceli_corderopia@yahoo.com.mx', '21842', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-25 16:26:12', NULL, NULL, NULL, '2023-04-18 17:10:01', '2023-04-25 22:26:12'),
	(467, 'Maria Fernanda Contreras López', 'fernanda24031996@gmail.com', '17342', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-20 19:34:11', NULL, NULL, NULL, '2023-04-18 17:05:38', '2023-04-21 01:34:11'),
	(466, 'Teofila Flores Huitron', 'teofilaflores0602@gmail.com', '6238', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-20 13:52:25', NULL, NULL, NULL, '2023-04-17 21:02:24', '2023-04-20 19:52:25'),
	(465, 'Jose Luis Corona Cardoso', 'jcorona@intimark.com.mx', '376', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-09-20 15:33:05', '2023-04-17 00:00:00', NULL, NULL, '2023-04-17 16:40:58', '2023-09-20 21:33:05'),
	(464, 'Vigilancia', 'vigilancia@intimark.com.mx', '0', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-10-25 11:07:12', '2023-04-14 00:00:00', NULL, NULL, '2023-04-14 20:16:21', '2023-10-25 17:07:12'),
	(463, 'ALEJANDRA PEREZ BAHENA', 'alepba@outlook.es', '22270', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-19 10:08:01', '2023-04-12 00:00:00', NULL, NULL, '2023-04-12 23:23:47', '2023-05-19 16:08:01'),
	(462, 'YOLANDA CARDENAS MEJIA', 'ycardenas@intimark.com.mx', '6445', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-05-05 11:40:55', NULL, NULL, NULL, '2023-04-12 23:23:44', '2023-05-05 17:40:55'),
	(461, 'ANGELICA  MENDOZA ORTIZ', 'amendoza@intimark.com.mx', '10192', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-04-24 11:30:27', '2023-05-02 00:00:00', NULL, NULL, '2023-04-12 18:38:28', '2023-05-02 15:17:07'),
	(459, 'GERARDO GUTIERREZ GARCIA', 'gerardoguga1209@gmail.com', '515432', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-06-05 15:44:57', '2023-05-02 00:00:00', NULL, NULL, '2023-04-10 20:03:34', '2023-06-05 21:44:57'),
	(458, 'SILBESTRE HERNANDEZ MEJIA', 'silverr10851@gmail.com', '10851', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 17:01:22', '2023-04-25 00:00:00', NULL, NULL, '2023-04-10 18:16:36', '2023-05-18 23:01:22'),
	(457, 'VERONICA GARCIA MIRANDA', 'vgarcia@intimark.com.mx', '6587', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-20 18:35:50', NULL, NULL, NULL, '2023-03-30 22:57:48', '2023-04-21 00:35:50'),
	(456, 'EFRAIN SALINAS ORTEGA', 'almacenmpp1@intimark.com.mx', '505641', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'COORDINADOR DE ALMACEN MATERIA PRIMA', '0', NULL, '2023-04-26 19:52:01', '2023-05-15 00:00:00', NULL, NULL, '2023-03-29 23:38:31', '2023-05-15 16:22:30'),
	(454, 'Maricela Garcia Miranda', 'mgarcia@intimark.com.mx', '6588', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-04 12:42:08', '2023-04-26 00:00:00', NULL, NULL, '2023-03-28 20:02:32', '2023-05-04 18:42:08'),
	(453, 'JAVIER GONZALEZ QUINTANILLA', 'jgonzalez@intimark.com.mx', '5742', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'VICEPRESIDENTE RECURSOS HUMANOS', '0', NULL, '2023-05-16 18:52:21', '2023-04-17 00:00:00', NULL, NULL, '2023-03-24 19:13:31', '2023-05-17 00:52:21'),
	(452, 'NICOLAS ALBERTO ARANGO', 'narango@intimark.com.mx', '18405', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'VICEPRESIDENTE EJECUTIVO VENTAS', '0', NULL, '2023-03-24 13:51:23', '2023-03-24 00:00:00', NULL, NULL, '2023-03-24 19:12:37', '2023-03-24 19:51:23'),
	(449, 'ISRAEL VENTURA LUCIANO', 'iventura@intimark.com.mx', '6899', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 19:45:31', '2023-03-23 00:00:00', NULL, NULL, '2023-03-23 22:41:31', '2023-05-19 01:45:31'),
	(451, 'JESUS FRANCISCO HINOJOSA SALAZAR', 'fhinojosa@intimark.com.mx', '1236', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'VICEPRESIDENTE DE MANUFACTURA', '0', NULL, '2023-05-18 17:38:27', '2023-03-24 00:00:00', NULL, NULL, '2023-03-24 19:02:04', '2023-05-18 23:38:27'),
	(447, 'FRANCISCO ALEXANDRO HERNANDEZ GARCIA', 'alexhergar0209@gmail.com', '18133', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-03-23 14:02:45', NULL, NULL, NULL, '2023-03-23 20:02:26', '2023-03-23 20:02:45'),
	(445, 'BEATRIZ SALOME', 'baranda@intimark.com.mx', '22493', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-03-23 11:04:04', NULL, NULL, NULL, '2023-03-23 17:03:50', '2023-03-23 17:04:04'),
	(443, 'CLAUDIA VERONICA GOMORA GONZALEZ', 'cgomora@intimark.com.mx', '12934', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-11 19:47:47', NULL, NULL, NULL, '2023-03-22 20:52:18', '2023-04-12 01:47:47'),
	(442, 'Juan Sanchez Hernandez', 'incentivosp1@intimark.com.mx', '13637', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-17 10:53:20', NULL, NULL, NULL, '2023-03-22 19:30:22', '2023-04-17 16:53:20'),
	(441, 'Mayra Lizbeth Flores Torres', 'capturanominasp1@intimark.com.mx', '18593', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-24 18:46:12', NULL, NULL, NULL, '2023-03-22 19:22:00', '2023-04-25 00:46:12'),
	(440, 'ERNESTO BECERRIL ENRIQUEZ', 'becerrilernesto@gmail.com', '18899', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-03-23 14:06:42', NULL, NULL, NULL, '2023-03-22 18:44:18', '2023-03-23 20:06:42'),
	(439, 'ERICK FLORES MERCADO ', 'erickflomercado@gmial.com', '12008', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-05-16 17:41:02', NULL, NULL, NULL, '2023-03-22 18:38:03', '2023-05-16 23:41:02'),
	(438, 'Juan Elorreaga Trujillo', 'truelo3169@gmail.com', '22972', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 19:40:47', '2023-03-22 00:00:00', NULL, NULL, '2023-03-22 17:51:16', '2023-05-19 01:40:47'),
	(437, 'Marisela Gonzalez Hernandez', 'mar.go.h.29111995@gmail.com', '13702', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 13:56:34', '2023-03-22 00:00:00', NULL, NULL, '2023-03-22 17:15:29', '2023-05-18 19:56:34'),
	(436, 'ROBERTO HERNANDEZ LAZARO', 'robtohl.85@outlook.com', '22334', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 16:09:37', '2023-05-11 00:00:00', NULL, NULL, '2023-03-22 17:08:28', '2023-05-18 22:09:37'),
	(435, 'heidi miscel cortez sanchez', 'princesa_miscel10@hotmail.com', '22651', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 19:49:32', '2023-03-22 00:00:00', NULL, NULL, '2023-03-22 17:00:39', '2023-05-19 01:49:32'),
	(434, 'YESENIA MEJIA JIMENEZ', 'intimarkmantto@intimark.com.mx', '521230', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-15 10:43:56', '2023-04-24 00:00:00', NULL, NULL, '2023-03-22 16:53:36', '2023-05-15 16:43:56'),
	(433, 'adolfo davila mateo', 'toquesdavila085@gmail.com', '15599', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-22 14:06:11', '2023-05-17 00:00:00', NULL, NULL, '2023-03-22 15:09:32', '2023-05-22 20:06:11'),
	(432, 'Gesler González García', 'geslergonzalez76@gmail.com', '9146', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-17 10:17:33', '2023-04-25 00:00:00', NULL, NULL, '2023-03-22 14:58:11', '2023-05-17 16:17:33'),
	(431, 'MARIELA VAZQUEZ', 'mvazquez@intimark.com.mx', '22303', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-05-16 17:36:36', NULL, NULL, NULL, '2023-03-22 14:06:15', '2023-05-16 23:36:36'),
	(430, 'OSCAR PEREZ SANDOVAL', 'operez@intimark.com.mx', '501812', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-24 19:30:58', NULL, NULL, NULL, '2023-03-22 00:15:23', '2023-04-25 01:30:58'),
	(429, 'Sonia Rodriguez Garcia ', 'srodriguez@intimark.com.mx', '21382', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-05-11 09:57:44', NULL, NULL, NULL, '2023-03-22 00:11:17', '2023-05-11 15:57:44'),
	(428, 'BRENDA MORENO REYES', 'bmoreno@intimark.com.mx', '17806', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-20 18:37:03', NULL, NULL, NULL, '2023-03-22 00:10:21', '2023-04-21 00:37:03'),
	(427, 'Nancy Ballesteros Noyola', 'nballesteros@intimark.com.mx', '1861', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-11 19:46:23', NULL, NULL, NULL, '2023-03-22 00:05:27', '2023-04-12 01:46:23'),
	(426, 'maria margarita barrera jimenez', 'margaritabarrera1985@gmail.com', '6329', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 13:56:32', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 23:39:26', '2023-05-18 19:56:32'),
	(425, 'LORENA SANCHEZ GONZAGA', 'lsanchez@intimark.com.mx', '21372', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-11 11:46:20', '2023-04-24 00:00:00', NULL, NULL, '2023-03-21 23:09:12', '2023-05-11 17:46:20'),
	(423, 'LORENZO SALAZAR GUTIERREZ', 'lsalazar@intimark.com.mx', '15429', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-17 16:46:53', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 22:26:35', '2023-05-17 22:46:53'),
	(422, 'NOE MARTINEZ GUTIERREZ', '12544martinez@gmail.com', '12544', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 14:58:13', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 21:33:12', '2023-05-18 20:58:13'),
	(421, 'FRANCISCO JERONIMO CHAVEZ', 'fjeronimoc11211@gmail.com', '11211', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 10:18:55', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 21:24:20', '2023-05-18 16:18:55'),
	(420, 'BEATRIZ GONZALEZ SOTO', 'bgonzalez@intimark.com.mx', '3206', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 17:54:57', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 21:20:03', '2023-05-18 23:54:57'),
	(419, 'ANGELA GONZALEZ GERVACIO', 'paolasahara390@gmail.com', '18655', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 16:54:00', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 21:14:42', '2023-05-18 22:54:00'),
	(418, 'PEDRO ALBERTO CABRERA TRISTAN', 'pealcatri11@gmail.com', '16141', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 11:52:19', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 21:11:11', '2023-05-18 17:52:19'),
	(417, 'GUADALUPE JOSE MARTINEZ', 'guadalupejmartinez234@gmail.com', '12689', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-11 16:43:33', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 21:06:59', '2023-05-11 22:43:33'),
	(416, 'AMBAR DE LOS ANGELES MENDOZA AGUILAR', 'ambaraguilarm@gmail.com', '17991', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 18:09:33', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 20:59:42', '2023-05-19 00:09:33'),
	(415, 'ELVIA GONZALEZ ALEJO', 'elviagonzalezalejo@gmail.com', '12970', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 19:53:33', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 20:54:04', '2023-05-19 01:53:33'),
	(414, 'ARACELI LARA MEDELLÍN', 'aracelilaramed1@gmail.com', '4523', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-19 09:21:16', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 20:47:43', '2023-05-19 15:21:16'),
	(413, 'SANDRA SERRANO VARELA', 'sandys.sv28@gmail.com', '661', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-17 11:23:09', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 20:42:23', '2023-05-17 17:23:09'),
	(412, 'ROSARIO VALDEZ RODRIGUEZ', 'rvaldez@intimark.com.mx', '20162', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-16 12:38:27', '2023-04-24 00:00:00', NULL, NULL, '2023-03-21 19:59:14', '2023-05-16 18:38:27'),
	(411, 'RENATO LOPEZ AVILA', 'rlopez@intimark.com.mx', '620', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'Vicepresidente Finanzas', '0', NULL, '2023-05-18 10:30:47', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 19:44:34', '2023-05-18 16:30:47'),
	(410, 'Lisandro Yafte Lopez Sanchez', 'llopez@intimark.com.mx', '18890', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-04-24 14:02:04', '2023-04-24 00:00:00', NULL, NULL, '2023-03-21 19:34:22', '2023-04-24 20:02:04'),
	(409, 'GERARDO VERGARA MENDOZA', 'gvergara@intimark.com.mx', '23162', '$2y$10$.AZ1d/nMxHeR1he.KdaFE.lEb.cb7EtdAAy4VySpAmKduEzBI5SGS', 'PERSONAL ADMINISTRATIVO', '0', 'XG7GpUh8fx74Eehc8DrklAwjMy6g4ERWc8uXsNa6WxcgJXXUlG0tZ39BuPwH', '2023-10-25 11:05:40', '2023-10-25 00:00:00', NULL, NULL, '2023-03-21 18:21:11', '2023-10-25 17:05:40'),
	(408, 'JUANA ANTONIO LAZARO', 'muestras@intimark.com.mx', '4857', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-17 13:14:29', '2023-05-17 00:00:00', NULL, NULL, '2023-03-21 18:20:14', '2023-05-17 19:14:29'),
	(407, 'JOSE FAUSTINO MORALES SEGUNDO', 'faustimor@yahoo.com.mx', '6111', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 17:15:55', '2023-03-21 00:00:00', NULL, NULL, '2023-03-21 18:07:37', '2023-05-18 23:15:55'),
	(406, 'Esthela Maldonado Reyes', 'emaldonado@intimark.com.mx', '16140', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-04-24 18:50:37', NULL, NULL, NULL, '2023-03-21 15:01:01', '2023-04-25 00:50:37'),
	(404, 'ROBERTO MORENO SALVADOR', 'rmoreno@intimark.com.mx', '13038', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE RECURSOS HUMANOS', '0', NULL, '2023-05-18 10:50:47', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:41:21', '2023-05-18 16:50:47'),
	(403, 'ABIGAIL MATIAS GONZALEZ', 'amatias@intimark.com.mx', '23007', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE INTEGRACION DE TALENTO', '0', NULL, '2023-03-30 12:22:49', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:40:54', '2023-03-30 18:22:49'),
	(402, 'ALIETH GARCIA CRUZ', 'coordinadorreclutamientosb@intimark.com.mx', '21839', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE ATRACCION DE TALENTO', '0', NULL, '2023-05-18 20:10:26', '2023-04-25 00:00:00', NULL, NULL, '2023-03-17 20:40:31', '2023-05-19 02:10:26'),
	(401, 'VICTOR HUGO REBOLLO RODRIGUEZ', 'empaquepii@intimark.com.mx', '4350', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE EMPAQUE', '0', NULL, '2023-05-18 10:07:10', '2023-05-04 00:00:00', NULL, NULL, '2023-03-17 20:40:07', '2023-05-18 16:07:10'),
	(400, 'ELMER ALEXIS MARTINEZ MARTINEZ', 'analistacierrep2t1@intimark.com.mx', '16434', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA PRODUCCION', 'X', NULL, NULL, '2023-05-17 00:00:00', NULL, NULL, '2023-03-17 20:39:36', '2023-05-17 16:04:06'),
	(398, 'ROSA MARIA VALDES ORDOÑES', 'acalidadpii@intimark.com.mx', '17229', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA CALIDAD', '0', NULL, '2023-05-18 09:25:00', '2023-04-27 00:00:00', NULL, NULL, '2023-03-17 20:38:29', '2023-05-18 15:25:00'),
	(399, 'DULCE VALERIA BECERRIL CARREON', 'dbecerril@intimark.com.mx', '21871', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE SERVICIO CLIENTE ESTAMPADO', '0', NULL, '2023-05-16 17:41:33', '2023-05-17 00:00:00', NULL, NULL, '2023-03-17 20:39:09', '2023-05-17 15:50:27'),
	(446, 'FRANCISCO OSORNIO CRUZ', 'almcostura@intimark.com.mx', '9826', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-15 17:23:23', '2023-04-25 00:00:00', NULL, NULL, '2023-03-23 18:06:38', '2023-05-15 23:23:23'),
	(396, 'ESTEBAN MARTIN MARTINEZ GONZALEZ', 'emartinez@intimark.com.mx', '2369', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE PRODUCCION', '0', NULL, '2023-05-18 16:12:47', '2023-04-24 00:00:00', NULL, NULL, '2023-03-17 20:37:40', '2023-05-18 22:12:47'),
	(395, 'JANET RIVERA NARCISO', 'aproduccionp2t1@intimark.com.mx', '22773', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA PRODUCCION', '0', NULL, '2023-05-19 09:03:51', '2023-04-17 00:00:00', NULL, NULL, '2023-03-17 20:37:07', '2023-05-19 15:03:51'),
	(394, 'ALEJANDRO ROJAS RAMIREZ', 'arojas@intimark.com.mx', '22806', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE MEJORA CONTINUA', '0', NULL, '2023-05-08 18:36:55', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:35:04', '2023-05-09 00:36:55'),
	(444, 'Guadalupe Soyuky Miranda Jalpilla', 'entrenamientopii@intimark.com.mx', '12695', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-18 15:48:55', '2023-04-26 00:00:00', NULL, NULL, '2023-03-23 14:31:59', '2023-05-18 21:48:55'),
	(393, 'JOSE RICARDO TORRES OLVERA', 'rtorres@intimark.com.mx', '16679', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE SENIOR ESTAMPADO', '0', NULL, '2023-09-13 19:24:59', '2023-05-17 00:00:00', NULL, NULL, '2023-03-17 20:34:35', '2023-09-14 01:24:59'),
	(391, 'OSCAR CARRASCO CID', 'ocarrasco@intimark.com.mx', '17353', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE CONTROL DE CALIDAD', '0', NULL, '2023-05-02 09:42:20', '2023-05-04 00:00:00', NULL, NULL, '2023-03-17 20:33:37', '2023-05-04 18:49:02'),
	(390, 'MARISELA OROZCO ORTIZ', 'morozco@intimark.com.mx', '5894', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE SERV AL CLIENTE', '0', NULL, '2023-05-11 18:32:16', '2023-05-11 00:00:00', NULL, NULL, '2023-03-17 20:33:03', '2023-05-12 00:32:16'),
	(389, 'GUADALUPE GONZALEZ GERVACIO', 'ggonzalez@intimark.com.mx', '3038', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE RECURSOS HUMANOS', '0', NULL, '2023-05-17 14:46:51', '2023-03-23 00:00:00', NULL, NULL, '2023-03-17 20:32:34', '2023-05-17 20:46:51'),
	(388, 'TOMAS BUSTOS CISNEROS', 'tbustos@intimark.com.mx', '16644', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE AUDITOR SISTEMA MODULAR', '0', NULL, '2023-04-27 19:13:25', '2023-04-27 00:00:00', NULL, NULL, '2023-03-17 20:32:06', '2023-04-28 01:13:25'),
	(386, 'URIEL MANJARREZ MUCIÑO', 'umanjarrez@intimark.com.mx', '13080', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE PLANEACION', '0', NULL, '2023-08-22 09:43:00', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:31:09', '2023-08-22 15:43:00'),
	(387, 'MIGDALIA PERALTA MARCELINO', 'mperalta@intimark.com.mx', '6006', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE INTEGRACION DE TALENTO', '0', NULL, NULL, '2023-03-17 00:00:00', NULL, NULL, '2023-03-17 20:31:38', '2023-03-17 20:31:38'),
	(385, 'MAURO VELASCO SAN AGUSTIN', 'mvelasco@intimark.com.mx', '520199', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE TECNICO DESARROLLO PRODUCTO', '0', NULL, '2023-05-02 17:24:21', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:30:42', '2023-05-02 23:24:21'),
	(384, 'BIYU CANTU CORTES', 'bcantu@intimark.com.mx', '9218', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE DESARROLLO PRODUCTO Y MUESTRAS', '0', NULL, '2023-06-27 10:09:04', '2023-05-08 00:00:00', NULL, NULL, '2023-03-17 20:30:12', '2023-06-27 16:09:04'),
	(382, 'OSWALDO GARCIA VELAZQUEZ', 'ogarcia@intimark.com.mx', '10', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE COSTOS Y GSD', '0', NULL, '2023-10-10 15:24:42', '2023-03-17 00:00:00', NULL, NULL, '2023-03-17 20:29:15', '2023-10-10 21:24:42'),
	(383, 'IRIS GARCIA PINZON', 'igarcia@intimark.com.mx', '20203', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE DESARROLLO MATERIALES', '0', NULL, '2023-05-18 19:30:26', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:29:45', '2023-05-19 01:30:26'),
	(381, 'LINO BRACAMONTE ORDOÑEZ', 'lbracamonte@intimark.com.mx', '1147', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE DE IMPUESTOS', '0', NULL, '2023-06-27 10:30:34', '2023-03-28 00:00:00', NULL, NULL, '2023-03-17 20:28:47', '2023-06-27 16:30:34'),
	(380, 'ESTRELLA DIAZ MORALES', 'ediaz@intimark.com.mx', '16678', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE CUENTAS POR  PAGAR', '0', NULL, '2023-05-16 18:58:56', '2023-03-22 00:00:00', NULL, NULL, '2023-03-17 20:28:18', '2023-05-17 00:58:56'),
	(379, 'RICARDO HUAZO URIBE', 'rhuazo@intimark.com.mx', '14581', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE SERV AL CLIENTE', '0', NULL, '2023-05-16 18:50:59', '2023-04-20 00:00:00', NULL, NULL, '2023-03-17 20:27:36', '2023-05-17 00:50:59'),
	(377, 'ANA LILIA BAÑUELOS ROSALES', 'serviciomedico@intimark.com.mx', '21833', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE SERVICIO MEDICO', '0', NULL, '2023-05-17 18:11:35', '2023-04-26 00:00:00', NULL, NULL, '2023-03-17 20:26:33', '2023-05-18 00:11:35'),
	(378, 'LUIS ENRIQUE BARRIOS HERNANDEZ', 'ebarrios@intimark.com.mx', '12031', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE LOGISTICA', '0', NULL, '2023-05-18 18:13:05', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:27:05', '2023-05-19 00:13:05'),
	(376, 'ISRAEL HERNANDEZ HIPOLITO', 'ihernandez@intimark.com.mx', '21371', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE DESARROLLO PROYECTOS ESPECIALES', '0', NULL, '2023-09-22 09:55:54', '2023-03-23 00:00:00', NULL, NULL, '2023-03-17 20:26:01', '2023-09-22 15:55:54'),
	(375, 'MARICARMEN REYES SALAZAR', 'mreyes@intimark.com.mx', '5491', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE ATRACCION DE TALENTO', '0', NULL, '2023-05-19 09:35:01', '2023-05-19 00:00:00', NULL, NULL, '2023-03-17 20:25:20', '2023-05-19 19:05:24'),
	(374, 'BENJAMIN FLORES PEREZ', 'bflores@intimark.com.mx', '9134', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE METODOS Y PROCEDIMIENTOS', '0', NULL, '2023-09-22 09:54:58', '2023-09-22 00:00:00', NULL, NULL, '2023-03-17 20:24:48', '2023-09-22 15:55:29'),
	(373, 'JOSE LUIS FLORES VELAZQUEZ', 'jflores@intimark.com.mx', '9516', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE PLANEACION', '0', NULL, '2023-05-05 11:38:36', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:24:19', '2023-05-05 17:38:36'),
	(372, 'MARIA DE LOS DOLORES GONZALEZ CHIMAL', 'lgonzalez@intimark.com.mx', '5215', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE ESTRUCTURA PRODUCTO', '0', NULL, '2023-06-20 09:34:17', '2023-04-20 00:00:00', NULL, NULL, '2023-03-17 20:23:29', '2023-06-20 15:34:17'),
	(370, 'JESUS RAMIREZ FLORES', 'jrflores@intimark.com.mx', '9337', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE DE CONTABILIDAD', '0', NULL, '2023-05-17 09:31:29', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:22:22', '2023-05-17 15:31:29'),
	(371, 'ROSALBA SANTANA BERNAL', 'rsantana@intimark.com.mx', '518931', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE TECNICO DESARROLLO PRODUCTO', '0', NULL, NULL, '2023-03-17 00:00:00', NULL, NULL, '2023-03-17 20:22:56', '2023-03-17 20:22:56'),
	(369, 'MARIA VERONICA MARTINEZ NAVARRETE', 'vmartinez@intimark.com.mx', '171', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE DE COMPRAS', '0', NULL, '2023-05-18 09:54:56', '2023-04-25 00:00:00', NULL, NULL, '2023-03-17 20:21:38', '2023-05-18 15:54:56'),
	(368, 'MINERVA SALAZAR CRUZ', 'msalazar@intimark.com.mx', '517404', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE SEGURIDAD E HIGIENE', '0', NULL, '2023-05-15 15:10:31', '2023-04-25 00:00:00', NULL, NULL, '2023-03-17 20:21:13', '2023-05-15 21:10:31'),
	(367, 'AZUCENA TAPIA RODRIGUEZ', 'atapia@intimark.com.mx', '14809', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'COORDINADOR RECURSOS HUMANOS', '0', NULL, '2023-05-19 09:06:12', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:20:37', '2023-05-19 15:06:12'),
	(365, 'JENIFER ORDOÑEZ LIBRADO', 'aproduccionp1t1@intimark.com.mx', '17812', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA PRODUCCION', '0', NULL, '2023-05-19 09:07:36', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:19:37', '2023-05-19 15:07:36'),
	(366, 'ERIC REYES ESQUIVEL', 'ereyes@intimark.com.mx', '7083', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE PRODUCCION', '0', NULL, '2023-05-18 20:41:00', '2023-04-19 00:00:00', NULL, NULL, '2023-03-17 20:20:10', '2023-05-19 02:41:00'),
	(364, 'CECILIA GABRIELA LOPEZ REYES', 'clopez@intimark.com.mx', '19937', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE COLOR PRODUCTO', '0', NULL, '2023-05-15 10:22:29', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:19:02', '2023-05-15 16:22:29'),
	(363, 'ROBERTO RIVERA ESTRADA', 'rrivera@intimark.com.mx', '17989', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE SENIOR CORTE', '0', NULL, '2023-05-12 09:21:29', '2023-03-17 00:00:00', NULL, NULL, '2023-03-17 20:18:30', '2023-05-12 15:21:29'),
	(361, 'RAYMUNDO REBOLLO MONROY', 'rrebollo@intimark.com.mx', '808', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE EMPAQUE', '0', NULL, '2023-09-28 09:48:03', '2023-04-24 00:00:00', NULL, NULL, '2023-03-17 20:17:20', '2023-09-28 15:48:03'),
	(362, 'JOEL PABLO FUSTER LOPEZ', 'pfuster@intimark.com.mx', '8575', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE PROPIEDADES DEL PRODUCTO', '0', NULL, '2023-08-22 09:50:44', '2023-05-16 00:00:00', NULL, NULL, '2023-03-17 20:17:58', '2023-08-22 15:50:44'),
	(360, 'JESUS NIPITA AVELAR', 'jnipita@intimark.com.mx', '13140', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE SENIOR MEJORA CONTINUA', '0', NULL, '2023-06-20 09:39:50', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:16:47', '2023-06-20 15:39:50'),
	(359, 'GUMERCINDO MIGUEL ANGELES', 'mgumercindo@intimark.com.mx', '500575', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE ASEGURANZA USOS', '0', NULL, '2023-04-27 13:36:12', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:15:58', '2023-04-27 19:36:12'),
	(357, 'JUAN CARLOS SANCHEZ GIL', 'jsanchezg@intimark.com.mx', '173', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE ALMACEN CONTROL PT', '0', NULL, '2023-03-24 10:42:08', '2023-03-23 00:00:00', NULL, NULL, '2023-03-17 20:14:37', '2023-03-24 16:42:08'),
	(358, 'JUANA ANGELICA GONZALEZ SIMON', 'jagonzalez@intimark.com.mx', '6816', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA CALIDAD', '0', NULL, '2023-08-24 10:39:13', '2023-04-27 00:00:00', NULL, NULL, '2023-03-17 20:15:10', '2023-08-24 16:39:13'),
	(356, 'LOPEZ MARMOLEJO MOISES', 'mlopez@intimark.com.mx', '958', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'COORDINADOR MATERIALES LABORATORIO', '0', NULL, '2023-05-04 14:49:18', '2023-05-04 00:00:00', NULL, NULL, '2023-03-17 20:13:30', '2023-05-04 20:49:18'),
	(355, 'ROBERTO BARRERA RODRIGUEZ', 'rbarrera@intimark.com.mx', '13135', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE SENIOR MANUFACTURA', '0', NULL, '2023-05-18 18:00:43', '2023-05-18 00:00:00', NULL, NULL, '2023-03-17 20:12:42', '2023-05-19 00:00:43'),
	(353, 'ANEL OLMOS PLATA', 'aolmos@intimark.com.mx', '6081', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE MUESTRAS', '0', NULL, '2023-05-12 09:15:18', '2023-05-17 00:00:00', NULL, NULL, '2023-03-17 20:11:23', '2023-05-17 15:50:57'),
	(354, 'ELIZABETH ALEJO SANTIAGO', 'analistacierrep1t1@intimark.com.mx', '13636', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA ORDENES MANUFACTURA', '0', NULL, '2023-04-25 17:34:44', '2023-03-21 00:00:00', NULL, NULL, '2023-03-17 20:11:59', '2023-04-25 23:34:44'),
	(352, 'ROBERTO RABADAN BUSTOS', 'rrabadan@intimark.com.mx', '10506', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE MEJORA CONTINUA', '0', NULL, '2023-05-17 09:54:50', '2023-04-24 00:00:00', NULL, NULL, '2023-03-17 20:10:38', '2023-05-17 15:54:50'),
	(351, 'VICTOR MANUEL PATIÑO OSORIO', 'vpatino@intimark.com.mx', '22465', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE MECANICOS', '0', NULL, '2023-05-17 08:50:46', '2023-04-10 00:00:00', NULL, NULL, '2023-03-17 20:09:59', '2023-05-17 14:50:46'),
	(350, 'MARIA RUBI ANTONIO CANDIDO', 'asistentedecorte@intimark.com.mx', '22304', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'ANALISTA CORTE', '0', NULL, '2023-05-18 09:03:17', '2023-05-17 00:00:00', NULL, NULL, '2023-03-17 20:09:24', '2023-05-18 15:03:17'),
	(349, 'EDGAR ELI ESPINOSA MEJIA', 'eespinosa@intimark.com.mx', '14045', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'SUBGERENTE MECATRONICA', '0', NULL, '2023-05-19 09:25:42', '2023-04-27 00:00:00', NULL, NULL, '2023-03-17 20:08:35', '2023-05-19 15:25:42'),
	(347, 'LORENA MENA VALDEZ', 'entrenamientopit1@intimark.com.mx', '9067', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'SUPERVISOR ENTRENAMIENTO', '0', NULL, '2023-05-17 19:31:38', '2023-04-25 00:00:00', NULL, NULL, '2023-03-17 20:04:19', '2023-05-18 01:31:38'),
	(450, 'ROBERTO OLVERA PAREDES', 'rolvera@intimark.com.mx', '500396', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', '0', NULL, '2023-05-16 16:12:50', '2023-05-04 00:00:00', NULL, NULL, '2023-03-23 23:02:31', '2023-05-16 22:12:50'),
	(346, 'SANDRA CLAUDIA ORDAZ BARRAGAN', 'sordaz@intimark.com.mx', '11165', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE CONTROL DE CALIDAD', '0', NULL, '2023-04-28 12:07:22', '2023-03-22 00:00:00', NULL, NULL, '2023-03-17 20:03:14', '2023-04-28 18:07:22'),
	(460, 'maribel albino rayon', 'malbino@intimark.com.mx', '8620', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-05-03 12:41:27', NULL, NULL, NULL, '2023-04-12 18:38:15', '2023-05-03 18:41:27'),
	(341, 'DIONISIO GARCIA JUAREZ', 'nominas@intimark.com.mx', '2808', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE DE NOMINAS', '0', NULL, '2023-05-18 18:46:29', '2023-03-22 00:00:00', NULL, NULL, '2023-03-17 14:43:23', '2023-05-19 00:46:29'),
	(340, 'VIRGILIO JAVIER PAREDES', 'vjavier@intimark.com.mx', '2891', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE DE NOMINAS', '0', NULL, '2023-05-17 09:56:45', '2023-05-04 00:00:00', NULL, NULL, '2023-03-17 01:10:44', '2023-05-17 15:56:45'),
	(455, 'JAVIER ANTONIO SAAVEDRA BENITEZ', 'jsaavedra@intimark.com.mx', '21864', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'GERENTE DE SISTEMAS', '0', NULL, '2023-03-29 16:34:35', '2023-05-04 00:00:00', NULL, NULL, '2023-03-29 22:33:18', '2023-05-04 18:41:47'),
	(339, 'FELISA ANDRES MORALES', 'fandres@intimark.com.mx', '15470', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'Nominas', '0', NULL, '2023-08-24 10:51:29', '2023-05-12 00:00:00', NULL, NULL, '2023-03-17 01:09:30', '2023-08-24 16:51:29'),
	(348, 'ABRAHAM DE JESUS PEREZ', 'aperez@intimark.com.mx', '23105', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'PROGRAMADOR', '0', NULL, '2023-05-19 09:16:23', '2023-05-19 00:00:00', NULL, NULL, '2023-03-17 20:05:17', '2023-05-19 15:17:10'),
	(344, 'JOSE LUIS ESCAMILLA GONZALEZ', 'jescamilla@intimark.com.mx', '501531', '$2y$10$srI5Pkk0yIyHnDaBUM9cDuEiAn5sHbPmGvlmL8x8vmXGNb4C9//c.', 'JEFE ALMACEN MAT PRIMA', '0', NULL, '2023-05-17 14:12:37', '2023-04-25 00:00:00', NULL, NULL, '2023-03-17 20:00:55', '2023-05-17 20:12:37'),
	(489, 'ANASTACIO CHAVARRIA MATEO', 'prueba1000@intimark.com.mx', '3213', '$2y$10$BQusApvC139EXGbcgKSduutMlfbdmw58lc7pdCG/lIdevYqKk7X9e', 'PERSONAL ADMINISTRATIVO', NULL, NULL, '2023-09-20 19:24:58', NULL, NULL, NULL, '2023-09-21 01:22:01', '2023-09-21 01:24:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
