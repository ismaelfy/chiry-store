-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para db_ventas
CREATE DATABASE IF NOT EXISTS `db_ventas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_ventas`;

-- Volcando estructura para tabla db_ventas.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.brand: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` (`id`, `nombre`) VALUES
	(1, 'Zapatillas'),
	(2, 'Polos'),
	(3, 'Camizas'),
	(4, 'Celular'),
	(5, 'Tasa');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.cargo
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.cargo: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` (`id`, `nombre`) VALUES
	(1, 'admin'),
	(2, 'empleado');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.client
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pwd` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.client: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id`, `nombre`, `direccion`, `email`, `pwd`, `telefono`, `estado`) VALUES
	(1, 'ismael', 'jr. chancay 924', 'jhowrayson12@gmail.com', '6ebe76c9fb411be97b3b0d48b791a7c9', 987654321, 1);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.detalle_venta
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `idprod` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,0) NOT NULL DEFAULT '0',
  `importe` decimal(11,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.detalle_venta: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` (`id`, `id_venta`, `idprod`, `descripcion`, `cantidad`, `precio`, `importe`) VALUES
	(1, '1', 8, 'ZAPATILLAS NIKE', 1, 90, 90),
	(2, '1', 4, 'ZAPATILLAS ADIDAS NEO', 1, 150, 150),
	(3, '1', 2, 'taza ilove linux ', 1, 25, 25),
	(4, '2', 4, 'ZAPATILLAS ADIDAS NEO', 1, 150, 150),
	(5, '2', 2, 'taza ilove linux ', 1, 25, 25),
	(6, '2', 3, 'samsung galaxsy ', 1, 400, 400),
	(7, '3', 4, 'ZAPATILLAS ADIDAS NEO', 1, 150, 150),
	(8, '3', 6, 'Zapatillas DC ', 1, 85, 85);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.favorite
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.favorite: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` (`id`, `id_prod`, `id_cli`) VALUES
	(1, 8, 1);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double(8,2) NOT NULL,
  `oferta` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_brand` (`id_brand`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.product: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `nombre`, `descripcion`, `imagen`, `precio`, `oferta`, `stock`, `id_brand`) VALUES
	(1, 'Polo negro', 'polo negro de algondon ', '0a4b12af8e501838f2f5de88eab38d4f.jpg', 20.00, 0, 10, 2),
	(2, 'taza ilove linux ', 'taza para programadores ', '447740a14d9ca0b55dab2afb4ebc7d0c.jpg', 25.00, 1, 10, 5),
	(3, 'samsung galaxsy ', 'colo negro ', 'c31c2438fc108bda9d428fb966783e45.jpg', 400.00, 0, 10, 4),
	(4, 'ZAPATILLAS ADIDAS NEO', 'Zapattilas adidas neo moda lima 2018', '6d0d6db3c3ffac381c423224922cd10c.jpg', 150.00, 1, 20, 1),
	(5, 'camisa blanca con rayas negras ', 'camisa con rayas negras ', 'fbbacb4fdacaa59f688f90b3c50a4e73.jpg', 23.00, 0, 15, 3),
	(6, 'Zapatillas DC ', 'zapatilla color negro ', '4c44a744eeb2f6def4c22706c51f5f72.jpg', 85.00, 0, 10, 1),
	(7, 'tasa coffee java', 'tasa coffee java color blanco', '16cda41bea83ebda8286133ee884be59.jpg', 30.00, 0, 10, 5),
	(8, 'ZAPATILLAS NIKE', 'zapatilla nike color negro ', 'c4aca7dd7899a204807418ba4b63350c.jpg', 90.00, 1, 20, 1),
	(9, 'ejemplo', 'wnfniie ', '8bee7645df5e4e9f82e9cb563b2185c0.jpg', 10.00, 0, 9, 1);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.suscribe
CREATE TABLE IF NOT EXISTS `suscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.suscribe: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `suscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `suscribe` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.tipo_pago
CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla db_ventas.tipo_pago: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_pago` DISABLE KEYS */;
INSERT INTO `tipo_pago` (`id`, `nombre`, `estado`) VALUES
	(1, 'Transferencia', 1),
	(2, 'pago contraentrega', 1),
	(3, 'tarjeta', 1);
/*!40000 ALTER TABLE `tipo_pago` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usu` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pwd` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `nombre`, `usu`, `pwd`, `id_cargo`, `estado`) VALUES
	(1, 'administrador', 'nAdmin', 'dc28eeb1d5e78cc18d151723ecaf58e0', 1, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Volcando estructura para tabla db_ventas.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `ndoc` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `id_cli` int(11) NOT NULL,
  `tipo_pago` int(11) NOT NULL DEFAULT '0',
  `invoice_number` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `payment_id` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `payment_method` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `payer_id` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `payment_token` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `confirm` int(11) NOT NULL DEFAULT '0' COMMENT '1) confirm to page (fail, gracias)',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0) pendiente a pagar, 1) pagado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla db_ventas.ventas: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` (`id`, `fecha`, `ndoc`, `id_cli`, `tipo_pago`, `invoice_number`, `payment_id`, `payment_method`, `payer_id`, `payment_token`, `confirm`, `status`) VALUES
	(1, '2020-07-09 19:37:39', 'R00-01', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(2, '2020-07-10 05:42:19', 'DC-000-0002', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(3, '2020-07-12 17:16:52', 'DC-000-0003', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(4, '2020-07-14 04:00:06', 'DC-000-0004', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(5, '2020-07-14 04:02:17', 'DC-000-0005', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(6, '2020-07-14 04:03:03', 'DC-000-0006', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(7, '2020-07-14 04:04:03', 'DC-000-0007', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(8, '2020-07-14 04:05:02', 'DC-000-0008', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(9, '2020-07-14 04:05:36', 'DC-000-0009', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(10, '2020-07-14 04:11:26', 'DC-000-00010', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(11, '2020-07-14 04:12:28', 'DC-000-00011', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(12, '2020-07-14 04:12:50', 'DC-000-00012', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(13, '2020-07-14 04:13:51', 'DC-000-00013', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(14, '2020-07-14 04:14:19', 'DC-000-00014', 1, 0, NULL, NULL, 'pedido', NULL, NULL, 1, 0),
	(15, '2020-07-14 04:46:59', 'DC-000-00015', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(16, '2020-07-14 04:48:01', 'DC-000-00016', 1, 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
	(17, '2020-07-14 05:21:11', 'DC-000-00017', 1, 0, '5f0d40c63b653', 'PAYID-L4GUBRQ4CF37383XH771394A', 'paypal', '8QEZHAE9B76GN', 'EC-65U34781AX0935605', 1, 1);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
