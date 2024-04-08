-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-04-2024 a las 19:21:01
-- Versión del servidor: 8.2.0
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_inventariosDIF`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `portada` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `status`, `ruta`) VALUES
(3, 'Nave', 'Una zapatilla de ballet', 'img_fae94789f7d4607b95d8360f12056079.jpg', '2024-01-16 12:34:39', 0, 'nave'),
(4, 'Zapatillas2', 'Un par de zapatillas talla 22', 'img_6a97778ff58f25491469cc7e6f1e38e2.jpg', '2024-01-16 12:35:26', 0, 'zapatillas2'),
(5, 'Zapatillas', 'Zapatillas talla 24', 'img_2e463b422eb7f9b0922f6cdddf78ff61.jpg', '2024-01-16 13:07:27', 1, 'zapatillas'),
(6, 'Zapatilla de media punta', 'Unas zapatillas de media punta talla 23', 'img_9b9d2c6b5380ec8089b0ef6026c5d82d.jpg', '2024-01-16 13:07:39', 0, 'zapatilla-de-media-punta'),
(7, 'Ejemplo a', 'Es un ejemplo de categoria', 'img_eae8a34affc6ef90c38c3b174ba2d95f.jpg', '2024-03-03 12:27:59', 0, 'ejemplo-a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `pedidoid` bigint NOT NULL,
  `productoid` bigint NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pedidoid` (`pedidoid`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
CREATE TABLE IF NOT EXISTS `detalle_temp` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `personaid` bigint NOT NULL,
  `productoid` bigint NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int NOT NULL,
  `transaccionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `personaid` (`personaid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_temp`
--

INSERT INTO `detalle_temp` (`id`, `personaid`, `productoid`, `precio`, `cantidad`, `transaccionid`) VALUES
(11, 1, 2345, 1333.00, 2, 'g1s1rri8r7undgonda1bdrmbk2'),
(14, 1, 2345, 1333.00, 2, '3isijbk415mtlu63j1eqf0uqkq'),
(15, 1, 2345, 1333.00, 2, 'dm6gqivgtuk8os4ovat4d08rjb'),
(20, 1, 2345, 1333.00, 1, 'a1tdtmo8v9infrqt92bmmq39vr'),
(21, 1, 2345, 1333.00, 1, 'pamu0vdr6knvt3q394fg5eadcc');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `productoid` bigint NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productoid` (`productoid`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`, `name`) VALUES
(113, 2345, 'pro_95febc20c35d7801e75dffbf2557d450.jpg', '#img1706464326208'),
(118, 2345, 'pro_0df4d72c4aebc5832ef41856093554e4.jpg', '#img1706468017660'),
(119, 2345, 'pro_e7caf5d766e29313bdcc98344b9e64fa.jpg', '#img1706468029299'),
(120, 2345, 'pro_b2afd844d14ee4ed636ceadecde478c9.jpg', '#img1706468037246');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

DROP TABLE IF EXISTS `modulo`;
CREATE TABLE IF NOT EXISTS `modulo` (
  `idmodulo` bigint NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmodulo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios Del Sistema', 1),
(3, 'Clientes', 'Clientes de tienda', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Categorias', 'Categorias de la tienda', 1),
(8, 'a', 'C', 0),
(10, 'Intento', '2', 0),
(11, 'Otro intento', 'B', 0),
(12, 'D', 'Otro', 0),
(13, 'inteno', 'V', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` bigint NOT NULL AUTO_INCREMENT,
  `personaid` bigint NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `monto` decimal(11,2) NOT NULL,
  `tipopagoid` bigint NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpedido`),
  KEY `personaid` (`personaid`),
  KEY `tipopagoid` (`tipopagoid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `idpermiso` bigint NOT NULL AUTO_INCREMENT,
  `rolid` bigint NOT NULL,
  `moduloid` bigint NOT NULL,
  `r` int NOT NULL DEFAULT '0',
  `w` int NOT NULL DEFAULT '0',
  `u` int NOT NULL DEFAULT '0',
  `d` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpermiso`),
  KEY `rolid` (`rolid`),
  KEY `moduloid` (`moduloid`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(179, 2, 1, 1, 0, 0, 0),
(180, 2, 2, 1, 0, 0, 0),
(181, 2, 3, 1, 1, 0, 0),
(182, 2, 4, 1, 1, 1, 1),
(183, 2, 5, 1, 0, 1, 0),
(184, 2, 6, 1, 1, 0, 0),
(221, 1, 1, 1, 1, 1, 1),
(222, 1, 2, 1, 1, 1, 1),
(223, 1, 3, 1, 1, 1, 1),
(224, 1, 4, 1, 1, 1, 1),
(225, 1, 5, 1, 1, 1, 1),
(226, 1, 6, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `idpersona` bigint NOT NULL AUTO_INCREMENT,
  `indentificacion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` bigint NOT NULL,
  `email_user` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombrefical` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccionfiscal` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfdi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `toke` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rolid` bigint NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idpersona`),
  KEY `rolid` (`rolid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `indentificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `rfc`, `nombrefical`, `direccionfiscal`, `cfdi`, `toke`, `rolid`, `datecreated`, `status`) VALUES
(1, '1', 'Jair', 'Garduño Rodriguez', 7225847678, 'jairgarduno@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'este tambien', 'intentando', 'a', 'actualizar cfd', '', 1, '2024-01-11 20:48:41', 1),
(2, '2', 'Alan', 'Diaz', 7225847678, 'alan@diaz.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'viendo si fu', 'rfc', 'tenango', 'funciona', '', 1, '2024-01-11 21:33:39', 1),
(14, '3', 'Ricardo', 'Bautista Pichardo', 7225847678, 'ricardo@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '', '', '', '', '', 1, '2024-04-08 12:19:48', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prods`
--

DROP TABLE IF EXISTS `prods`;
CREATE TABLE IF NOT EXISTS `prods` (
  `ARTICULO` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESCRIP` longtext COLLATE utf8mb4_unicode_ci,
  `LINEA` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MARCA` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PRECIO1` double NOT NULL DEFAULT '0',
  `PRECIO2` double NOT NULL DEFAULT '0',
  `PRECIO3` double NOT NULL DEFAULT '0',
  `PRECIO4` double NOT NULL DEFAULT '0',
  `PRECIO5` double NOT NULL DEFAULT '0',
  `PRECIO6` double NOT NULL DEFAULT '0',
  `PRECIO7` double NOT NULL DEFAULT '0',
  `PRECIO8` double NOT NULL DEFAULT '0',
  `PRECIO9` double NOT NULL DEFAULT '0',
  `PRECIO10` double NOT NULL DEFAULT '0',
  `EXISTENCIA` double NOT NULL DEFAULT '0',
  `COSTO_U` double NOT NULL DEFAULT '0',
  `COSTO` double NOT NULL DEFAULT '0',
  `UNIDAD` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `POR_RECIB` double NOT NULL DEFAULT '0',
  `POR_SURT` double NOT NULL DEFAULT '0',
  `IMPUESTO` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MINIMO` double NOT NULL DEFAULT '0',
  `MAXIMO` double NOT NULL DEFAULT '0',
  `OBSERV` longtext COLLATE utf8mb4_unicode_ci,
  `COSTO_STD` double NOT NULL DEFAULT '0',
  `KIT` smallint NOT NULL DEFAULT '0',
  `SERIE` smallint NOT NULL DEFAULT '0',
  `LOTE` smallint NOT NULL DEFAULT '0',
  `INVENT` smallint NOT NULL DEFAULT '0',
  `IMAGEN` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PARAVENTA` smallint NOT NULL DEFAULT '0',
  `URL` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Curso` smallint NOT NULL DEFAULT '0',
  `USUARIO` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `USUHORA` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `USUFECHA` datetime DEFAULT NULL,
  `Exportado` smallint NOT NULL DEFAULT '0',
  `EN_VENTA` double NOT NULL DEFAULT '0',
  `Recalcular` smallint NOT NULL DEFAULT '0',
  `Granel` smallint NOT NULL DEFAULT '0',
  `Peso` double NOT NULL DEFAULT '0',
  `BajoCosto` smallint NOT NULL DEFAULT '0',
  `Bloqueado` smallint NOT NULL DEFAULT '0',
  `U1` double NOT NULL DEFAULT '0',
  `U2` double NOT NULL DEFAULT '0',
  `U3` double NOT NULL DEFAULT '0',
  `U4` double NOT NULL DEFAULT '0',
  `U5` double NOT NULL DEFAULT '0',
  `U6` double NOT NULL DEFAULT '0',
  `U7` double NOT NULL DEFAULT '0',
  `U8` double NOT NULL DEFAULT '0',
  `U9` double NOT NULL DEFAULT '0',
  `U10` double NOT NULL DEFAULT '0',
  `Acaja` smallint NOT NULL DEFAULT '0',
  `MODIFICAPRECIO` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Fraccionario` smallint NOT NULL DEFAULT '0',
  `IESPECIAL` double NOT NULL DEFAULT '0',
  `UBICACION` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `C2` double NOT NULL DEFAULT '0',
  `C3` double NOT NULL DEFAULT '0',
  `C4` double NOT NULL DEFAULT '0',
  `C5` double NOT NULL DEFAULT '0',
  `C6` double NOT NULL DEFAULT '0',
  `C7` double NOT NULL DEFAULT '0',
  `C8` double NOT NULL DEFAULT '0',
  `C9` double NOT NULL DEFAULT '0',
  `C10` double NOT NULL DEFAULT '0',
  `Movimientos` double NOT NULL DEFAULT '0',
  `Clasificacion` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ROP` double NOT NULL DEFAULT '0',
  `rotacion` double NOT NULL DEFAULT '0',
  `clasifant` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eoq` double NOT NULL DEFAULT '0',
  `etiquetas` int NOT NULL DEFAULT '0',
  `modelo` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `talla` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speso` smallint NOT NULL DEFAULT '0',
  `etiqueta` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` int NOT NULL DEFAULT '0',
  `carton` int NOT NULL DEFAULT '0',
  `ubicaetiq` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidadrecibe` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidadempaque` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinvolumen` smallint NOT NULL DEFAULT '0',
  `Presentacion` smallint NOT NULL DEFAULT '0',
  `Servicio` smallint NOT NULL DEFAULT '0',
  `numeroservicios` int NOT NULL DEFAULT '0',
  `claveproveedor` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dp` double NOT NULL DEFAULT '0',
  `familia` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subfamilia` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subfam1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subfam2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Entradas` double NOT NULL DEFAULT '0',
  `Salidas` double NOT NULL DEFAULT '0',
  `cantent` double NOT NULL DEFAULT '0',
  `cantsal` double NOT NULL DEFAULT '0',
  `pronostico` double NOT NULL DEFAULT '0',
  `oferta` smallint NOT NULL DEFAULT '0',
  `costoentrada` double NOT NULL DEFAULT '0',
  `costosalida` double NOT NULL DEFAULT '0',
  `unidadesentrada` double NOT NULL DEFAULT '0',
  `unidadessalida` double NOT NULL DEFAULT '0',
  `donativo` double NOT NULL DEFAULT '0',
  `costopeps` double NOT NULL DEFAULT '0',
  `costoueps` double NOT NULL DEFAULT '0',
  `contenido` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presentacionextra` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesoextra` double NOT NULL DEFAULT '0',
  `autor` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tema` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editorial` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fabricante` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preciousd` double NOT NULL DEFAULT '0',
  `costousd` double NOT NULL DEFAULT '0',
  `puntos` int NOT NULL DEFAULT '0',
  `autocodigo` int NOT NULL,
  `inventariopiezas` double DEFAULT NULL,
  `diasstockmaximo` int DEFAULT NULL,
  `diasstockminimo` int DEFAULT NULL,
  `requerimiento` int DEFAULT NULL,
  `tiempoAire` smallint NOT NULL DEFAULT '0',
  `SSMA_TimeStamp` tinyblob NOT NULL,
  `ensambladoenlinea` int DEFAULT '0',
  `iepslitro` double(8,4) DEFAULT NULL,
  `numerodeselecciones` int DEFAULT NULL,
  `GUID` char(36) COLLATE utf8mb4_unicode_ci DEFAULT 'newid()',
  `SStime` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int DEFAULT '0',
  `claveprodserv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '01010101',
  `claveunidad` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'H87',
  `ObjetoImp` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '02'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prods`
--

INSERT INTO `prods` (`ARTICULO`, `DESCRIP`, `LINEA`, `MARCA`, `PRECIO1`, `PRECIO2`, `PRECIO3`, `PRECIO4`, `PRECIO5`, `PRECIO6`, `PRECIO7`, `PRECIO8`, `PRECIO9`, `PRECIO10`, `EXISTENCIA`, `COSTO_U`, `COSTO`, `UNIDAD`, `POR_RECIB`, `POR_SURT`, `IMPUESTO`, `MINIMO`, `MAXIMO`, `OBSERV`, `COSTO_STD`, `KIT`, `SERIE`, `LOTE`, `INVENT`, `IMAGEN`, `PARAVENTA`, `URL`, `Curso`, `USUARIO`, `USUHORA`, `USUFECHA`, `Exportado`, `EN_VENTA`, `Recalcular`, `Granel`, `Peso`, `BajoCosto`, `Bloqueado`, `U1`, `U2`, `U3`, `U4`, `U5`, `U6`, `U7`, `U8`, `U9`, `U10`, `Acaja`, `MODIFICAPRECIO`, `Fraccionario`, `IESPECIAL`, `UBICACION`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `Movimientos`, `Clasificacion`, `ROP`, `rotacion`, `clasifant`, `eoq`, `etiquetas`, `modelo`, `color`, `talla`, `speso`, `etiqueta`, `numero`, `carton`, `ubicaetiq`, `unidadrecibe`, `unidadempaque`, `sinvolumen`, `Presentacion`, `Servicio`, `numeroservicios`, `claveproveedor`, `dp`, `familia`, `subfamilia`, `subfam1`, `subfam2`, `Entradas`, `Salidas`, `cantent`, `cantsal`, `pronostico`, `oferta`, `costoentrada`, `costosalida`, `unidadesentrada`, `unidadessalida`, `donativo`, `costopeps`, `costoueps`, `contenido`, `presentacionextra`, `pesoextra`, `autor`, `tema`, `editorial`, `fabricante`, `preciousd`, `costousd`, `puntos`, `autocodigo`, `inventariopiezas`, `diasstockmaximo`, `diasstockminimo`, `requerimiento`, `tiempoAire`, `SSMA_TimeStamp`, `ensambladoenlinea`, `iepslitro`, `numerodeselecciones`, `GUID`, `SStime`, `version`, `claveprodserv`, `claveunidad`, `ObjetoImp`) VALUES
('2345', 'ZapatillaR', '5', 'Adidas', 1333, 488, 888, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 'IVA', 0, 0, NULL, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, NULL, 0, 0, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, 'ADIDAS A', 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, '', 0, NULL, NULL, 'newid()', NULL, 0, '01010101', 'H87', '02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` bigint NOT NULL AUTO_INCREMENT,
  `categoriaid` bigint NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idproducto`),
  KEY `categoriaid` (`categoriaid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `categoriaid`, `datecreated`, `status`) VALUES
(1, 5, '2024-01-19 15:41:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idrol` bigint NOT NULL AUTO_INCREMENT,
  `nombrerol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a todo el sistema', 1),
(2, 'Supervisores', 'Supervisor de tienda', 1),
(8, 'Ejemplo rol', 'Ejemplo rol sitema', 0),
(9, 'Coordinador', 'Coordinador', 0),
(10, 'Consulta Ventas', 'Consulta Ventas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

DROP TABLE IF EXISTS `tipopago`;
CREATE TABLE IF NOT EXISTS `tipopago` (
  `idtipopago` bigint NOT NULL,
  `tipopago` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`idtipopago`, `tipopago`, `status`) VALUES
(1, 'Paypal', 1),
(2, 'Efectivo', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`tipopagoid`) REFERENCES `tipopago` (`idtipopago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
