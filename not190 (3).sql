-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2022 a las 00:00:57
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `not190`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `id_acta` int(11) NOT NULL,
  `id_cotejo1` int(11) NOT NULL,
  `id_tipo1` int(11) DEFAULT NULL,
  `id_esc_tipo` int(11) DEFAULT NULL,
  `id_esc_vol` int(11) DEFAULT NULL,
  `ac_esc` varchar(1000) DEFAULT NULL,
  `ac_vol` varchar(500) DEFAULT NULL,
  `a_que_cont` int(11) DEFAULT NULL,
  `id_contenido` int(11) DEFAULT NULL,
  `a_favor` int(11) DEFAULT NULL,
  `id_persona1` int(11) DEFAULT NULL,
  `id_empresa1` int(11) DEFAULT NULL,
  `id_sociedad1` int(11) DEFAULT NULL,
  `id_tipo_emitido1` int(11) DEFAULT NULL,
  `id_emitido1` int(11) DEFAULT NULL,
  `act_fecha` int(11) DEFAULT NULL,
  `a_dia` int(11) DEFAULT NULL,
  `id_mes` int(11) DEFAULT NULL,
  `a_ano` int(11) DEFAULT NULL,
  `a_targeta` varchar(1000) DEFAULT NULL,
  `id_targetas1` int(11) DEFAULT NULL,
  `ac_idoficial1` int(11) DEFAULT NULL,
  `a_idmex` varchar(1000) DEFAULT NULL,
  `id_factura1` int(11) DEFAULT NULL,
  `a_factura` varchar(1000) DEFAULT NULL,
  `id_otro` int(11) DEFAULT NULL,
  `a_otro` varchar(1000) DEFAULT NULL,
  `ac_manual` varchar(1000) DEFAULT NULL,
  `usuario4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_targetas`
--

CREATE TABLE `acta_targetas` (
  `id_targetas` int(11) NOT NULL,
  `tipo_targetas` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_a_que_conts`
--

CREATE TABLE `ac_a_que_conts` (
  `ac_a_que_conts` int(11) NOT NULL,
  `tipo_que_contiene` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_a_que_conts`
--

INSERT INTO `ac_a_que_conts` (`ac_a_que_conts`, `tipo_que_contiene`) VALUES
(1, 'QUE CONTIENE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_contenidos`
--

CREATE TABLE `ac_contenidos` (
  `id_contenido` int(11) NOT NULL,
  `ac_contenido` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_de_fechas`
--

CREATE TABLE `ac_de_fechas` (
  `id_ac_fecha` int(11) NOT NULL,
  `de_fecha` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_de_fechas`
--

INSERT INTO `ac_de_fechas` (`id_ac_fecha`, `de_fecha`) VALUES
(1, 'de fecha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_emitido`
--

CREATE TABLE `ac_emitido` (
  `id_emitido` int(11) NOT NULL,
  `emitido` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_emitido_tipo`
--

CREATE TABLE `ac_emitido_tipo` (
  `id_ac_emitido` int(11) NOT NULL,
  `tipo_emitido` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_emitido_tipo`
--

INSERT INTO `ac_emitido_tipo` (`id_ac_emitido`, `tipo_emitido`) VALUES
(1, 'emitido por');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_en_favor`
--

CREATE TABLE `ac_en_favor` (
  `id_ac_favor` int(11) NOT NULL,
  `tipo_favor` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_facturas`
--

CREATE TABLE `ac_facturas` (
  `id_factura` int(11) NOT NULL,
  `tipo_factura` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_identificaciones`
--

CREATE TABLE `ac_identificaciones` (
  `ac_idoficial` int(11) NOT NULL,
  `tipo_identificacion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_idotros`
--

CREATE TABLE `ac_idotros` (
  `ac_idotro` int(11) NOT NULL,
  `tipo_otros` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_tipos`
--

CREATE TABLE `ac_tipos` (
  `id_ac_tipo` int(11) NOT NULL,
  `n_tipo` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_tipos`
--

INSERT INTO `ac_tipos` (`id_ac_tipo`, `n_tipo`) VALUES
(1, 'Escritura'),
(2, 'Tarjetas de circulación'),
(3, 'Factura'),
(4, 'Identificación oficial'),
(5, 'Otro'),
(6, 'Manual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotejos`
--

CREATE TABLE `cotejos` (
  `id_cotejo` int(11) NOT NULL,
  `c_nocotejo` int(11) NOT NULL,
  `c_libro` int(50) NOT NULL,
  `c_hoja` int(11) NOT NULL,
  `c_tantos_soli` int(11) NOT NULL,
  `c_tamaño` int(11) NOT NULL,
  `c_lados` int(11) NOT NULL,
  `c_mostrada` int(11) NOT NULL,
  `c_persona` int(11) DEFAULT NULL,
  `c_empresa` int(11) DEFAULT NULL,
  `c_tiposociedad` int(11) DEFAULT NULL,
  `c_hoja_anexa` int(11) NOT NULL,
  `copia` int(11) DEFAULT NULL,
  `plano` int(11) DEFAULT NULL,
  `c_fecha` date DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `id_usuario3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotejos`
--

INSERT INTO `cotejos` (`id_cotejo`, `c_nocotejo`, `c_libro`, `c_hoja`, `c_tantos_soli`, `c_tamaño`, `c_lados`, `c_mostrada`, `c_persona`, `c_empresa`, `c_tiposociedad`, `c_hoja_anexa`, `copia`, `plano`, `c_fecha`, `fname`, `name`, `id_usuario3`) VALUES
(47, 6476, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 1, 1, 1, '2022-09-13', '20220926181056_6476-', '6476-', 1),
(48, 6477, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181538_6477 -', '6477 -', 1),
(49, 6478, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181755_6478 -', '6478 -', 1),
(50, 6479, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181802_6479 -', '6479 -', 1),
(51, 6480, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181810_6480 -', '6480 -', 1),
(52, 6481, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181817_6481 -', '6481 -', 1),
(53, 6482, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181841_6482 -', '6482 -', 1),
(54, 6483, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181847_6483 -', '6483 -', 1),
(55, 6484, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181853_6484 -', '6484 -', 1),
(56, 6485, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926181859_6485 -', '6485 -', 1),
(57, 6486, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182044_6486 -', '6486 -', 1),
(58, 6487, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182051_6487 -', '6487 -', 1),
(59, 6488, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182058_6488 -', '6488 -', 1),
(60, 6489, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182104_6489 -', '6489 -', 1),
(61, 6491, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182118_6491 -', '6491 -', 1),
(62, 6492, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182124_6492 -', '6492 -', 1),
(63, 6493, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182130_6493 -', '6493 -', 1),
(64, 6494, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182304_6634 -', '6634 -', 1),
(65, 6495, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182326_6635 -', '6635 -', 1),
(66, 6496, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182332_6636 -', '6636 -', 1),
(67, 6497, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182658_6497-', '6497-', 1),
(68, 6498, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926182705_6498 -', '6498 -', 1),
(69, 6499, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(70, 6500, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(71, 6501, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(72, 6502, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(73, 6503, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(74, 6504, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(75, 6505, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(76, 6506, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(77, 6507, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(78, 6508, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(79, 6509, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(80, 6510, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(81, 6511, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(82, 6512, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(83, 6513, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(84, 6514, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(85, 6515, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(86, 6516, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(87, 6517, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(88, 6518, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(89, 6519, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(90, 6520, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(91, 6521, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(92, 6522, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(93, 6523, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(94, 6524, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(95, 6525, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(96, 6526, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(97, 6527, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(98, 6528, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(99, 6529, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(100, 6530, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(101, 6531, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(102, 6532, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(103, 6533, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(104, 6534, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(105, 6535, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(106, 6536, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(107, 6537, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(108, 6538, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(109, 6539, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(110, 6540, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(111, 6541, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(112, 6542, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(113, 6543, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(114, 6544, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(115, 6545, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(116, 6546, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(117, 6547, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(118, 6548, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(119, 6549, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(120, 6550, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(121, 6551, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(122, 6552, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(123, 6553, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(124, 6554, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(125, 6555, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(126, 6556, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(127, 6557, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(128, 6558, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(129, 6559, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(130, 6560, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(131, 6561, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(132, 6562, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(133, 6563, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(134, 6564, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(135, 6565, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(136, 6566, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(137, 6567, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(138, 6568, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(139, 6569, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(140, 6570, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(212, 6474, 8, 34, 1, 1, 1, 1, NULL, 12, 2, 2, 1, 1, '2022-09-13', '20220926190144_6474-', '6474-', 1),
(213, 6475, 8, 13, 1, 1, 1, 1, NULL, 12, 2, 2, 1, 1, '2022-09-13', '20220926190339_6475 -', '6475 -', 1),
(214, 6490, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926190609_6476 -', '6476 -', 1),
(215, 6571, 8, 1, 3, 1, 1, 1, NULL, 15, 1, 2, 1, 1, '2022-09-13', '20220926191101_6477 -', '6477 -', 1),
(216, 6572, 8, 4, 1, 1, 1, 1, NULL, 29, 2, 2, 1, 1, '2022-09-13', '20220926191244_6478 -', '6478 -', 1),
(217, 6573, 8, 4, 1, 1, 1, 1, NULL, 13, 1, 2, 1, 1, '2022-09-13', '20220926191440_6479 -', '6479 -', 1),
(218, 6574, 8, 3, 1, 1, 1, 1, NULL, 26, 1, 2, 1, 2, '2022-09-13', '20220926191649_6480 -', '6480 -', 1),
(219, 6575, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(220, 6576, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(221, 6577, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(222, 6578, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(223, 6579, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(224, 6580, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(225, 6581, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(226, 6582, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(227, 6583, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(228, 6584, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(229, 6585, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(230, 6586, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(231, 6587, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(232, 6588, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(233, 6589, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(234, 6590, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(235, 6591, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(236, 6592, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(237, 6593, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(238, 6594, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(239, 6595, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(240, 6596, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(241, 6597, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(242, 6598, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(243, 6599, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(244, 6600, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(245, 6601, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(246, 6602, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(247, 6603, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(248, 6604, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(249, 6605, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(250, 6606, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(251, 6607, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(252, 6608, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(253, 6609, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(254, 6610, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(255, 6611, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(256, 6612, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(257, 6613, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(258, 6614, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(259, 6615, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(260, 6616, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(261, 6617, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(262, 6618, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(263, 6619, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(264, 6620, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(265, 6621, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(266, 6622, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(267, 6623, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(268, 6624, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(269, 6625, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(270, 6626, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(271, 6627, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(272, 6628, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(273, 6629, 8, 2, 7, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220929160823_', '', 1),
(274, 6630, 8, 47, 7, 1, 1, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220929160402_', '', 1),
(275, 6631, 8, 27, 7, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220929155956_', '', 1),
(276, 6632, 8, 38, 7, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220929155051_', '', 1),
(277, 6633, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(278, 6634, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(279, 6635, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(280, 6636, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(281, 6637, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(282, 6638, 8, 1, 1, 1, 2, 2, NULL, 12, 2, 2, 1, 2, '2022-09-13', '20220926183016_6499 -', '6499 -', 1),
(411, 6639, 8, 12, 3, 1, 1, 1, NULL, 6, 1, 2, 2, 1, '2022-09-30', '20220930163801_6639 -union lorenzo.pdf', '6639 -union lorenzo.pdf', 1),
(420, 6640, 8, 1, 1, 1, 2, 1, 28, NULL, NULL, 2, 1, 1, '2022-10-03', '20221003164258_6640 -6320.pdf', '6640 -6320.pdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_libro`
--

CREATE TABLE `cot_libro` (
  `id_libro` int(11) NOT NULL,
  `no_libro` int(11) NOT NULL,
  `inicio` int(11) NOT NULL,
  `final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cot_libro`
--

INSERT INTO `cot_libro` (`id_libro`, `no_libro`, `inicio`, `final`) VALUES
(1, 1, 1, 913),
(2, 2, 914, 1810),
(3, 3, 1811, 2710),
(4, 4, 2711, 3610),
(5, 5, 3611, 4510),
(6, 6, 4511, 5410),
(7, 7, 5411, 6310),
(8, 8, 6311, 7210);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `nombre_dep` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_dep`) VALUES
(1, 'Admin_Full'),
(2, 'Cotejos'),
(3, 'contaduria'),
(5, 'recepción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `e_nombre` varchar(1000) NOT NULL,
  `id_tiposciedad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `e_nombre`, `id_tiposciedad`) VALUES
(6, 'FLYCORP SERVICES', 1),
(7, 'GALERÍA DEL CHOCOLATE', 3),
(8, 'KIA MÉXICO', 1),
(9, 'IGM CHEMIE', 1),
(10, 'SEGURIDAD PRIVADA ASEGURIMEX', 1),
(11, 'VIVIENDAS DE SUBASTAS RESTAURADAS', 1),
(12, 'ICH 002', 2),
(13, 'SEGURITECH PRIVADA', 1),
(14, 'AGENCIA FUNERARIA GAYOSSO', 1),
(15, 'B3-FLYSERVICES', 1),
(16, 'SUPERALARM', 1),
(18, 'ARABELA', 1),
(19, 'CONSORCIO ACADÉMICO UNIVERSITARIO', 5),
(20, 'GRUPO INMOBILIARIO DM', 1),
(21, 'SECO TOOLS DE MÉXICO', 1),
(23, 'ÍNDIGO PROAMBIENTAL', 2),
(25, 'VACCINTECH INTERNATIONAL', 1),
(26, 'E-TRANSPORTS', 1),
(27, 'ARQUITECTURA EN MOVIMIENTO FIA', 3),
(28, 'RIO PAPALOAPAN 45 INMOBILIARIA', 1),
(29, 'DESARROLLOS LL', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esc_tipo`
--

CREATE TABLE `esc_tipo` (
  `id_esc_tipo` int(11) NOT NULL,
  `tipo_esc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `esc_tipo`
--

INSERT INTO `esc_tipo` (`id_esc_tipo`, `tipo_esc`) VALUES
(1, 'ESCRITURA'),
(2, 'INSTRUMENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojas`
--

CREATE TABLE `hojas` (
  `id_hoja` int(11) NOT NULL,
  `h_tamaño` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hojas`
--

INSERT INTO `hojas` (`id_hoja`, `h_tamaño`) VALUES
(1, 'Carta'),
(2, '8.5x13.40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojas_anexas`
--

CREATE TABLE `hojas_anexas` (
  `id_hoja_anexa` int(11) NOT NULL,
  `hoja_anexa` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hojas_anexas`
--

INSERT INTO `hojas_anexas` (`id_hoja_anexa`, `hoja_anexa`) VALUES
(1, 'Ultima Hoja'),
(2, 'Hoja Anexa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `isr`
--

CREATE TABLE `isr` (
  `id_isr` int(11) NOT NULL,
  `escritura` int(200) NOT NULL,
  `id_tipo1` int(11) NOT NULL,
  `volumen` int(100) NOT NULL,
  `id_mes1` int(11) NOT NULL,
  `enajenante` varchar(200) DEFAULT NULL,
  `adquiriente` varchar(200) DEFAULT NULL,
  `federativa` decimal(50,0) DEFAULT NULL,
  `entidad` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  `folio` int(11) NOT NULL,
  `id_uif1` int(11) NOT NULL,
  `cfdi` varchar(50) DEFAULT NULL,
  `id_usuario1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lados`
--

CREATE TABLE `lados` (
  `id_lado` int(11) NOT NULL,
  `l_lado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lados`
--

INSERT INTO `lados` (`id_lado`, `l_lado`) VALUES
(1, 'ambos lados'),
(2, 'un solo lado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `id_lugares` int(11) NOT NULL,
  `Nombre_del_lugar` varchar(50) NOT NULL,
  `municipio` varchar(300) NOT NULL,
  `hora_abre` time DEFAULT NULL,
  `hora_cierra` time DEFAULT NULL,
  `id_motivo2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mes`
--

CREATE TABLE `mes` (
  `id_mes` int(11) NOT NULL,
  `mes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mes`
--

INSERT INTO `mes` (`id_mes`, `mes`) VALUES
(1, 'enero'),
(2, 'febrero'),
(3, 'marzo'),
(4, 'abril'),
(5, 'mayo'),
(6, 'junio'),
(7, 'julio'),
(8, 'agosto'),
(9, 'septiembre'),
(10, 'octubre'),
(11, 'noviembre'),
(12, 'diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mostrado`
--

CREATE TABLE `mostrado` (
  `id_mostrado` int(11) NOT NULL,
  `m_lados` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mostrado`
--

INSERT INTO `mostrado` (`id_mostrado`, `m_lados`) VALUES
(1, 'anverso y reverso'),
(2, 'anverso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_ruta`
--

CREATE TABLE `motivo_ruta` (
  `id_motivo` int(11) NOT NULL,
  `motivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `motivo_ruta`
--

INSERT INTO `motivo_ruta` (`id_motivo`, `motivo`) VALUES
(10, 'PAGO DE TRASLADO'),
(11, 'FIRMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `p_nombre` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `p_nombre`) VALUES
(26, 'ALDO GRANADOS GONZALEZ'),
(27, 'RENE BUSTOS SOLER'),
(28, 'CARLOS ALBERTO ANAYA BALLESTEROS'),
(29, 'JUSTINO HERNANDEZ GARCIA'),
(30, 'BÉNÉDICTE MERMET'),
(32, 'VÍCTOR MANUEL ORNELAS OSORIO'),
(33, 'RAÚL GARCÍA BECERRIL'),
(34, 'MARGARITA GÓMEZ PALOMARES '),
(35, 'VÍCTOR MANUEL ALVAREZ AGUILAR'),
(36, 'ESCOBEDO ROLAND ALFONSO'),
(37, 'JUSTO GALINDO BURGOS'),
(38, 'SALVADOR EMMANUEL PAREDEZ CANTAREY'),
(39, 'RODRIGO MEZA ALCÁNTARA'),
(40, 'RICARDO RODRÍGUEZ ACEVEDO'),
(41, 'EMMANUEL ANTONIO CÁRDENAS ROJAS'),
(42, 'ROGELIO ROCHA GONZÁLEZ'),
(43, 'JESUS ANTONIO FLORES MAYA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL,
  `id_lugar1` int(50) DEFAULT NULL,
  `lugar_no_comun` varchar(50) DEFAULT NULL,
  `persona` varchar(200) DEFAULT NULL,
  `id_motivo1` int(11) DEFAULT NULL,
  `documentos` varchar(500) DEFAULT NULL,
  `notas` varchar(500) DEFAULT NULL,
  `id_ususario2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposociedad`
--

CREATE TABLE `tiposociedad` (
  `id_tiposociedad` int(11) NOT NULL,
  `t_sociedad` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposociedad`
--

INSERT INTO `tiposociedad` (`id_tiposociedad`, `t_sociedad`) VALUES
(1, 'SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE'),
(2, 'SOCIEDAD ANÓNIMA PROMOTORA DE INVERSIÓN DE CAPITAL VARIABLE'),
(3, 'SOCIEDAD DE RESPONSABILIDAD LIMITADA DE CAPITAL VARIABLE'),
(5, 'SOCIEDAD CIVIL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_isr`
--

CREATE TABLE `tipo_isr` (
  `id_tipo` int(11) NOT NULL,
  `irs_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_isr`
--

INSERT INTO `tipo_isr` (`id_tipo`, `irs_tipo`) VALUES
(1, 'Ordinario'),
(2, 'Especial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uif`
--

CREATE TABLE `uif` (
  `id_uif` int(11) NOT NULL,
  `validez` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `uif`
--

INSERT INTO `uif` (`id_uif`, `validez`) VALUES
(1, 'A'),
(2, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `u_nombre` varchar(100) NOT NULL,
  `u_apellido_pat` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `u_apellido_mat` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `u_departamento` int(11) DEFAULT NULL,
  `u_nivel` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `u_nombre`, `u_apellido_pat`, `nickname`, `u_apellido_mat`, `contrasena`, `u_departamento`, `u_nivel`) VALUES
(1, 'Jesus Antonio', 'Flores', 'Five5', 'Maya', '12345678', 1, 3),
(2, 'José Gadyel', 'González', 'cotejos', 'Maldonado', '12345678', 2, 3),
(7, 'Andrea ', '-', 'contaduria', '-', '12345678', 3, 2),
(8, 'ALFREDO ', 'JARAMILLO ', 'Fredy', 'MANZUR', '12345678', 1, 3),
(9, 'Nivel 1', 'ejemplo1', 'ejemplo1', 'ejemplo1', '12345678', NULL, 1),
(10, 'Nivel 2', 'ejemplo2', 'ejemplo2', 'ejemplo2', '12345678', NULL, 2),
(11, 'recepcion', 'recepcion', 'recepcion', 'recepcion', '12345678', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vol_tipo`
--

CREATE TABLE `vol_tipo` (
  `id_vol_tipo` int(11) NOT NULL,
  `vol_tipo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vol_tipo`
--

INSERT INTO `vol_tipo` (`id_vol_tipo`, `vol_tipo`) VALUES
(1, 'VOLUMEN'),
(2, 'LIBRO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
  ADD PRIMARY KEY (`id_acta`),
  ADD KEY `fk_acco_idx` (`id_cotejo1`),
  ADD KEY `fk_tipoac_idx` (`id_tipo1`),
  ADD KEY `fk_escac_idx` (`id_esc_tipo`),
  ADD KEY `fk_volac_idx` (`ac_vol`),
  ADD KEY `fk_conte_idx` (`id_contenido`),
  ADD KEY `fk_perac_idx` (`id_persona1`),
  ADD KEY `fk_empac_idx` (`id_empresa1`),
  ADD KEY `fk_socac_idx` (`id_sociedad1`),
  ADD KEY `fk_emac_idx` (`id_emitido1`),
  ADD KEY `fk_mesac_idx` (`id_mes`),
  ADD KEY `fk_usuac_idx` (`usuario4`),
  ADD KEY `fk_volac_idx1` (`id_esc_vol`),
  ADD KEY `fk_actar_idx` (`id_targetas1`),
  ADD KEY `fk_acemi_idx` (`id_tipo_emitido1`),
  ADD KEY `fk_facac_idx` (`id_factura1`),
  ADD KEY `fk_idac_idx` (`ac_idoficial1`),
  ADD KEY `fk_otac_idx` (`id_otro`),
  ADD KEY `fk_fechaac_idx` (`act_fecha`),
  ADD KEY `fk_qcontac_idx` (`a_que_cont`),
  ADD KEY `fk_favor_idx` (`a_favor`);

--
-- Indices de la tabla `acta_targetas`
--
ALTER TABLE `acta_targetas`
  ADD PRIMARY KEY (`id_targetas`);

--
-- Indices de la tabla `ac_a_que_conts`
--
ALTER TABLE `ac_a_que_conts`
  ADD PRIMARY KEY (`ac_a_que_conts`);

--
-- Indices de la tabla `ac_contenidos`
--
ALTER TABLE `ac_contenidos`
  ADD PRIMARY KEY (`id_contenido`);

--
-- Indices de la tabla `ac_de_fechas`
--
ALTER TABLE `ac_de_fechas`
  ADD PRIMARY KEY (`id_ac_fecha`);

--
-- Indices de la tabla `ac_emitido`
--
ALTER TABLE `ac_emitido`
  ADD PRIMARY KEY (`id_emitido`);

--
-- Indices de la tabla `ac_emitido_tipo`
--
ALTER TABLE `ac_emitido_tipo`
  ADD PRIMARY KEY (`id_ac_emitido`);

--
-- Indices de la tabla `ac_en_favor`
--
ALTER TABLE `ac_en_favor`
  ADD PRIMARY KEY (`id_ac_favor`);

--
-- Indices de la tabla `ac_facturas`
--
ALTER TABLE `ac_facturas`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `ac_identificaciones`
--
ALTER TABLE `ac_identificaciones`
  ADD PRIMARY KEY (`ac_idoficial`);

--
-- Indices de la tabla `ac_idotros`
--
ALTER TABLE `ac_idotros`
  ADD PRIMARY KEY (`ac_idotro`);

--
-- Indices de la tabla `ac_tipos`
--
ALTER TABLE `ac_tipos`
  ADD PRIMARY KEY (`id_ac_tipo`);

--
-- Indices de la tabla `cotejos`
--
ALTER TABLE `cotejos`
  ADD PRIMARY KEY (`id_cotejo`),
  ADD KEY `fk_taco_idx` (`c_tamaño`),
  ADD KEY `fk_peco_idx` (`c_persona`),
  ADD KEY `fk_empco_idx` (`c_empresa`),
  ADD KEY `fk_tsoco_idx` (`c_tiposociedad`),
  ADD KEY `fk_laco_idx` (`c_lados`),
  ADD KEY `fk_usucot_idx` (`id_usuario3`),
  ADD KEY `fk_hojaneco_idx` (`c_hoja_anexa`),
  ADD KEY `fk_moscot_idx` (`c_mostrada`),
  ADD KEY `fk_cot_libro_idx` (`c_libro`);

--
-- Indices de la tabla `cot_libro`
--
ALTER TABLE `cot_libro`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_emtiso_idx` (`id_tiposciedad`);

--
-- Indices de la tabla `esc_tipo`
--
ALTER TABLE `esc_tipo`
  ADD PRIMARY KEY (`id_esc_tipo`);

--
-- Indices de la tabla `hojas`
--
ALTER TABLE `hojas`
  ADD PRIMARY KEY (`id_hoja`);

--
-- Indices de la tabla `hojas_anexas`
--
ALTER TABLE `hojas_anexas`
  ADD PRIMARY KEY (`id_hoja_anexa`);

--
-- Indices de la tabla `isr`
--
ALTER TABLE `isr`
  ADD PRIMARY KEY (`id_isr`),
  ADD KEY `fk_isr_ususario_idx` (`id_usuario1`),
  ADD KEY `fk_tipo_isr_idx` (`id_tipo1`),
  ADD KEY `fk_tipo_isr1` (`id_tipo1`),
  ADD KEY `fk_tipo_isr_idx2` (`id_tipo1`),
  ADD KEY `mes_ms_idx` (`id_mes1`),
  ADD KEY `fk_uif_isr_idx` (`id_uif1`);

--
-- Indices de la tabla `lados`
--
ALTER TABLE `lados`
  ADD PRIMARY KEY (`id_lado`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id_lugares`),
  ADD KEY `fk_lumo_idx` (`id_motivo2`);

--
-- Indices de la tabla `mes`
--
ALTER TABLE `mes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indices de la tabla `mostrado`
--
ALTER TABLE `mostrado`
  ADD PRIMARY KEY (`id_mostrado`);

--
-- Indices de la tabla `motivo_ruta`
--
ALTER TABLE `motivo_ruta`
  ADD PRIMARY KEY (`id_motivo`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `fk_ruta_usuario_idx` (`id_ususario2`),
  ADD KEY `fk_ruta_lugar_idx` (`id_lugar1`),
  ADD KEY `fk_ruta_motivo_idx` (`id_motivo1`),
  ADD KEY `fk_ruta_motivo` (`id_motivo1`);

--
-- Indices de la tabla `tiposociedad`
--
ALTER TABLE `tiposociedad`
  ADD PRIMARY KEY (`id_tiposociedad`);

--
-- Indices de la tabla `tipo_isr`
--
ALTER TABLE `tipo_isr`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `uif`
--
ALTER TABLE `uif`
  ADD PRIMARY KEY (`id_uif`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_depus_idx` (`u_departamento`);

--
-- Indices de la tabla `vol_tipo`
--
ALTER TABLE `vol_tipo`
  ADD PRIMARY KEY (`id_vol_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
  MODIFY `id_acta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `acta_targetas`
--
ALTER TABLE `acta_targetas`
  MODIFY `id_targetas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_a_que_conts`
--
ALTER TABLE `ac_a_que_conts`
  MODIFY `ac_a_que_conts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ac_contenidos`
--
ALTER TABLE `ac_contenidos`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_de_fechas`
--
ALTER TABLE `ac_de_fechas`
  MODIFY `id_ac_fecha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ac_emitido`
--
ALTER TABLE `ac_emitido`
  MODIFY `id_emitido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_emitido_tipo`
--
ALTER TABLE `ac_emitido_tipo`
  MODIFY `id_ac_emitido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ac_en_favor`
--
ALTER TABLE `ac_en_favor`
  MODIFY `id_ac_favor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_facturas`
--
ALTER TABLE `ac_facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_identificaciones`
--
ALTER TABLE `ac_identificaciones`
  MODIFY `ac_idoficial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_idotros`
--
ALTER TABLE `ac_idotros`
  MODIFY `ac_idotro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ac_tipos`
--
ALTER TABLE `ac_tipos`
  MODIFY `id_ac_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cotejos`
--
ALTER TABLE `cotejos`
  MODIFY `id_cotejo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT de la tabla `cot_libro`
--
ALTER TABLE `cot_libro`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `esc_tipo`
--
ALTER TABLE `esc_tipo`
  MODIFY `id_esc_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hojas`
--
ALTER TABLE `hojas`
  MODIFY `id_hoja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hojas_anexas`
--
ALTER TABLE `hojas_anexas`
  MODIFY `id_hoja_anexa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `isr`
--
ALTER TABLE `isr`
  MODIFY `id_isr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lados`
--
ALTER TABLE `lados`
  MODIFY `id_lado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id_lugares` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mes`
--
ALTER TABLE `mes`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `mostrado`
--
ALTER TABLE `mostrado`
  MODIFY `id_mostrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `motivo_ruta`
--
ALTER TABLE `motivo_ruta`
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `tiposociedad`
--
ALTER TABLE `tiposociedad`
  MODIFY `id_tiposociedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_isr`
--
ALTER TABLE `tipo_isr`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `uif`
--
ALTER TABLE `uif`
  MODIFY `id_uif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vol_tipo`
--
ALTER TABLE `vol_tipo`
  MODIFY `id_vol_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actas`
--
ALTER TABLE `actas`
  ADD CONSTRAINT `fk_acco` FOREIGN KEY (`id_cotejo1`) REFERENCES `cotejos` (`id_cotejo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acemi` FOREIGN KEY (`id_tipo_emitido1`) REFERENCES `ac_emitido_tipo` (`id_ac_emitido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_conte` FOREIGN KEY (`id_contenido`) REFERENCES `ac_contenidos` (`id_contenido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emac` FOREIGN KEY (`id_emitido1`) REFERENCES `ac_emitido` (`id_emitido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empac` FOREIGN KEY (`id_empresa1`) REFERENCES `empresas` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_escac` FOREIGN KEY (`id_esc_tipo`) REFERENCES `esc_tipo` (`id_esc_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_facac` FOREIGN KEY (`id_factura1`) REFERENCES `ac_facturas` (`id_factura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favor` FOREIGN KEY (`a_favor`) REFERENCES `ac_en_favor` (`id_ac_favor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fechaac` FOREIGN KEY (`act_fecha`) REFERENCES `ac_de_fechas` (`id_ac_fecha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idac` FOREIGN KEY (`ac_idoficial1`) REFERENCES `ac_identificaciones` (`ac_idoficial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mesac` FOREIGN KEY (`id_mes`) REFERENCES `mes` (`id_mes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_otac` FOREIGN KEY (`id_otro`) REFERENCES `ac_idotros` (`ac_idotro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perac` FOREIGN KEY (`id_persona1`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_qcontac` FOREIGN KEY (`a_que_cont`) REFERENCES `ac_a_que_conts` (`ac_a_que_conts`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_socac` FOREIGN KEY (`id_sociedad1`) REFERENCES `tiposociedad` (`id_tiposociedad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_targac` FOREIGN KEY (`id_targetas1`) REFERENCES `acta_targetas` (`id_targetas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipoac` FOREIGN KEY (`id_tipo1`) REFERENCES `ac_tipos` (`id_ac_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuac` FOREIGN KEY (`usuario4`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_volac` FOREIGN KEY (`id_esc_vol`) REFERENCES `vol_tipo` (`id_vol_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cotejos`
--
ALTER TABLE `cotejos`
  ADD CONSTRAINT `fk_cot_libro` FOREIGN KEY (`c_libro`) REFERENCES `cot_libro` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empco` FOREIGN KEY (`c_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hojaneco` FOREIGN KEY (`c_hoja_anexa`) REFERENCES `hojas_anexas` (`id_hoja_anexa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_laco` FOREIGN KEY (`c_lados`) REFERENCES `lados` (`id_lado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_moscot` FOREIGN KEY (`c_mostrada`) REFERENCES `mostrado` (`id_mostrado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perco` FOREIGN KEY (`c_persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_taco` FOREIGN KEY (`c_tamaño`) REFERENCES `hojas` (`id_hoja`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tsoco` FOREIGN KEY (`c_tiposociedad`) REFERENCES `tiposociedad` (`id_tiposociedad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usucot` FOREIGN KEY (`id_usuario3`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `isr`
--
ALTER TABLE `isr`
  ADD CONSTRAINT `fk_isr_ususario` FOREIGN KEY (`id_usuario1`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_uif_isr` FOREIGN KEY (`id_uif1`) REFERENCES `uif` (`id_uif`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `isr_ibfk_1` FOREIGN KEY (`id_tipo1`) REFERENCES `tipo_isr` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mes_ms` FOREIGN KEY (`id_mes1`) REFERENCES `mes` (`id_mes`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD CONSTRAINT `fk_lumo` FOREIGN KEY (`id_motivo2`) REFERENCES `motivo_ruta` (`id_motivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `fk_ruta_lugar` FOREIGN KEY (`id_lugar1`) REFERENCES `lugares` (`id_lugares`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruta_usuario` FOREIGN KEY (`id_ususario2`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rutas_ibfk_1` FOREIGN KEY (`id_motivo1`) REFERENCES `motivo_ruta` (`id_motivo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_depus` FOREIGN KEY (`u_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
