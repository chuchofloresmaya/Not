-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-08-2022 a las 16:49:52
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
  `ac_esc` varchar(250) DEFAULT NULL,
  `ac_vol` varchar(200) DEFAULT NULL,
  `a_que_cont` int(11) DEFAULT NULL,
  `id_contenido` int(11) DEFAULT NULL,
  `a_favor` int(11) DEFAULT NULL,
  `id_persona1` int(11) DEFAULT NULL,
  `id_empresa1` int(11) DEFAULT NULL,
  `id_sociedad1` int(11) DEFAULT NULL,
  `id_emitido1` int(11) DEFAULT NULL,
  `act_fecha` int(11) NOT NULL,
  `a_dia` int(11) DEFAULT NULL,
  `id_mes` int(11) DEFAULT NULL,
  `a_ano` int(11) DEFAULT NULL,
  `a_n_oficio` varchar(500) DEFAULT NULL,
  `a_targeta` varchar(11) DEFAULT NULL,
  `id_targetas1` int(11) DEFAULT NULL,
  `a_idmex` varchar(500) DEFAULT NULL,
  `a_factura` int(11) DEFAULT NULL,
  `a_f_numero` varchar(500) DEFAULT NULL,
  `usuario4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acta_targetas`
--

CREATE TABLE `acta_targetas` (
  `id_targetas` int(11) NOT NULL,
  `tipo_targetas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `acta_targetas`
--

INSERT INTO `acta_targetas` (`id_targetas`, `tipo_targetas`) VALUES
(2, 'TARJETA DE CIRCULACIÓN DE TRANSPORTE FEDERAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_contenidos`
--

CREATE TABLE `ac_contenidos` (
  `id_contenido` int(11) NOT NULL,
  `ac_contenido` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_contenidos`
--

INSERT INTO `ac_contenidos` (`id_contenido`, `ac_contenido`) VALUES
(1, 'EL OTORGAMIENTO DE PODER'),
(2, 'LA PROTOCOLIZACIÓN DE ACTA DE'),
(4, 'EL OTORGAMIENTO DE PODERES'),
(5, 'EL RECONOCIMIENTO DE FIRMA DE RATIFICACIÓN DE CONTENIDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_emitido`
--

CREATE TABLE `ac_emitido` (
  `id_emitido` int(11) NOT NULL,
  `emitido` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_emitido`
--

INSERT INTO `ac_emitido` (`id_emitido`, `emitido`) VALUES
(1, 'LA NOTARIA 114 DEL ESTADO DE MÉXICO'),
(2, 'LA NOTARIA 190 DEL ESTADO DE MÉXICO'),
(3, 'DIRECCIÓN GENERAL DE AUTOTRANSPORTE FEDERAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ac_tipos`
--

CREATE TABLE `ac_tipos` (
  `id_ac_tipo` int(11) NOT NULL,
  `n_tipo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ac_tipos`
--

INSERT INTO `ac_tipos` (`id_ac_tipo`, `n_tipo`) VALUES
(1, 'Escritura'),
(2, 'Tarjetas de circulación'),
(3, 'Factura'),
(4, 'Identificación oficial'),
(5, 'Otro');

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
  `c_fecha` date DEFAULT NULL,
  `fname` text DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `id_usuario3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotejos`
--

INSERT INTO `cotejos` (`id_cotejo`, `c_nocotejo`, `c_libro`, `c_hoja`, `c_tantos_soli`, `c_tamaño`, `c_lados`, `c_mostrada`, `c_persona`, `c_empresa`, `c_tiposociedad`, `c_hoja_anexa`, `copia`, `c_fecha`, `fname`, `name`, `id_usuario3`) VALUES
(2366, 2, 1, 1, 1, 1, 1, 1, NULL, 11, 1, 1, 1, '2022-08-25', '20220825221439_1-', '1-', 1),
(2367, 3, 1, 1, 1, 1, 1, 1, NULL, 8, 4, 1, 1, '2022-08-25', '20220825221451_2 -', '2 -', 1),
(2368, 4, 1, 1, 1, 1, 1, 1, NULL, 6, 4, 1, 1, '2022-08-25', '20220825221456_3 -', '3 -', 1),
(2369, 5, 1, 1, 1, 1, 1, 1, NULL, 6, 4, 1, 1, '2022-08-25', '20220825221502_4 -', '4 -', 1),
(2370, 6, 1, 1, 1, 1, 1, 1, NULL, 13, 4, 1, 1, '2022-08-25', '20220825221508_5 -', '5 -', 1),
(2371, 7, 1, 1, 1, 1, 1, 1, NULL, 13, 1, 1, 1, '2022-08-25', '20220825221521_6 -', '6 -', 1),
(2372, 898, 1, 1, 1, 1, 1, 1, 28, NULL, NULL, 1, 1, '2022-08-25', '20220825221606_898-', '898-', 1),
(2373, 899, 1, 1, 1, 1, 1, 1, NULL, 6, 1, 1, 1, '2022-08-25', '20220825221615_899 -', '899 -', 1),
(2374, 900, 1, 1, 1, 1, 1, 1, 26, NULL, NULL, 1, 1, '2022-08-25', '20220825221619_900 -', '900 -', 1),
(2375, 901, 1, 1, 1, 1, 1, 1, 26, NULL, NULL, 1, 1, '2022-08-25', '20220825221624_901 -', '901 -', 1),
(2376, 902, 1, 1, 1, 1, 1, 1, 28, NULL, NULL, 1, 1, '2022-08-25', '20220825221628_902 -', '902 -', 1),
(2377, 903, 1, 1, 1, 1, 1, 1, 29, NULL, NULL, 1, 1, '2022-08-25', '20220825221633_903 -', '903 -', 1),
(2378, 904, 1, 1, 1, 1, 1, 1, 32, NULL, NULL, 1, 1, '2022-08-25', '20220825221637_904 -', '904 -', 1),
(2379, 905, 1, 1, 1, 1, 1, 1, 30, NULL, NULL, 1, 1, '2022-08-25', '20220825221642_905 -', '905 -', 1),
(2380, 906, 1, 1, 1, 1, 1, 1, 34, NULL, NULL, 1, 1, '2022-08-25', '20220825221646_906 -', '906 -', 1),
(2381, 907, 1, 1, 1, 1, 1, 1, 34, NULL, NULL, 1, 1, '2022-08-25', '20220825221651_907 -', '907 -', 1),
(2382, 908, 1, 1, 1, 1, 1, 1, 29, NULL, NULL, 1, 1, '2022-08-25', '20220825221656_908 -', '908 -', 1),
(2383, 909, 1, 1, 1, 1, 1, 1, 30, NULL, NULL, 1, 1, '2022-08-25', '20220825221701_909 -', '909 -', 1),
(2384, 910, 1, 1, 1, 1, 1, 1, 32, NULL, NULL, 1, 1, '2022-08-25', '20220825221706_910 -', '910 -', 1),
(2385, 911, 1, 1, 1, 1, 1, 1, 34, NULL, NULL, 1, 1, '2022-08-25', '20220825221711_911 -', '911 -', 1),
(2391, 912, 1, 1, 1, 1, 1, 1, NULL, 6, 1, 1, 1, '2022-08-25', '20220825235356_912 -', '912 -', 1),
(2393, 913, 1, 1, 1, 1, 1, 1, NULL, 6, 1, 1, 1, '2022-08-26', '20220826161318_913 -', '913 -', 1),
(2394, 914, 2, 1, 1, 1, 1, 1, NULL, 10, 1, 1, 1, '2022-08-26', '20220826161329_914 -', '914 -', 1),
(2395, 915, 2, 1, 1, 1, 1, 1, 30, NULL, NULL, 1, 1, '2022-08-26', '20220826161343_915 -', '915 -', 1),
(2396, 916, 2, 1, 1, 1, 1, 1, NULL, 9, 1, 1, 1, '2022-08-26', '20220826161352_916 -', '916 -', 1),
(2437, 6309, 2, 1, 1, 1, 1, 1, NULL, 10, 1, 1, 1, '2022-08-26', '20220826203209_6309-', '6309-', 1),
(2440, 6314, 8, 1, 1, 1, 1, 1, NULL, 10, 1, 1, 1, '2022-08-26', '20220829151532_6314 -ProgramaFirma-1510600344-25.08.22 (3).pdf', '6314 -ProgramaFirma-1510600344-25.08.22 (3).pdf', 1);

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
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `e_nombre` varchar(200) NOT NULL,
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
(17, '', 4),
(18, 'ARABELA', 1),
(19, 'CONSORCIO ACADÉMICO UNIVERSITARIO', 5),
(20, 'GRUPO INMOBILIARIO DM', 1),
(21, 'SECO TOOLS DE MÉXICO', 1),
(23, 'ÍNDIGO PROAMBIENTAL', 2),
(24, 'SUPERALARM', 1);

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
  `Nombre_del_lugar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`id_lugares`, `Nombre_del_lugar`) VALUES
(1, 'INVI'),
(2, 'BGBG'),
(3, 'SEGURI TECH');

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
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'Julio'),
(8, 'Agosto'),
(9, 'Septiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre');

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
(5, 'ENTREGA DE DOCUMENTOS'),
(6, 'TRAMITE DE ESCRITURA'),
(9, 'FIRMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `p_nombre` varchar(150) NOT NULL
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
(31, ''),
(32, 'VÍCTOR MANUEL ORNELAS OSORIO'),
(33, 'RAÚL GARCÍA BECERRIL'),
(34, 'MARGARITA GÓMEZ PALOMARES ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time DEFAULT NULL,
  `id_lugar1` int(50) NOT NULL,
  `lugar_no_comun` varchar(50) DEFAULT NULL,
  `persona` varchar(200) NOT NULL,
  `id_motivo1` int(11) DEFAULT NULL,
  `documentos` varchar(500) DEFAULT NULL,
  `notas` varchar(500) DEFAULT NULL,
  `id_ususario2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_ruta`, `fecha`, `hora`, `id_lugar1`, `lugar_no_comun`, `persona`, `id_motivo1`, `documentos`, `notas`, `id_ususario2`) VALUES
(33, '2022-08-27', '00:00:00', 2, 'LUGAR NO COMUN1', 'JISUS', 9, 'DOC1', 'NOT1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposociedad`
--

CREATE TABLE `tiposociedad` (
  `id_tiposociedad` int(11) NOT NULL,
  `t_sociedad` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposociedad`
--

INSERT INTO `tiposociedad` (`id_tiposociedad`, `t_sociedad`) VALUES
(1, 'SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE'),
(2, 'SOCIEDAD ANÓNIMA PROMOTORA DE INVERSIÓN DE CAPITAL VARIABLE'),
(3, 'SOCIEDAD DE RESPONSABILIDAD LIMITADA DE CAPITAL VARIABLE'),
(4, ''),
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
  `u_nivel` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `u_nombre`, `u_apellido_pat`, `nickname`, `u_apellido_mat`, `contrasena`, `u_nivel`) VALUES
(1, 'Jesus Antonio', 'Flores', 'Five5', 'Maya', '12345678', 3),
(2, 'Usuario uno', 'uduario uno ', 'usuario1', 'usuario', '12345678', 1),
(3, 'Usuario dos', 'usuario dos', 'usuario2', 'usuario', '12345678', 2),
(4, 'José Gadyel', 'González', 'GADYEL', ' Maldonado', 'santo1190', 3);

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
(0, ''),
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
  ADD KEY `fk_actar_idx` (`id_targetas1`);

--
-- Indices de la tabla `acta_targetas`
--
ALTER TABLE `acta_targetas`
  ADD PRIMARY KEY (`id_targetas`);

--
-- Indices de la tabla `ac_contenidos`
--
ALTER TABLE `ac_contenidos`
  ADD PRIMARY KEY (`id_contenido`);

--
-- Indices de la tabla `ac_emitido`
--
ALTER TABLE `ac_emitido`
  ADD PRIMARY KEY (`id_emitido`);

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
  ADD PRIMARY KEY (`id_lugares`);

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
  ADD PRIMARY KEY (`idusuario`);

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
  MODIFY `id_acta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `acta_targetas`
--
ALTER TABLE `acta_targetas`
  MODIFY `id_targetas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ac_contenidos`
--
ALTER TABLE `ac_contenidos`
  MODIFY `id_contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ac_emitido`
--
ALTER TABLE `ac_emitido`
  MODIFY `id_emitido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ac_tipos`
--
ALTER TABLE `ac_tipos`
  MODIFY `id_ac_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cotejos`
--
ALTER TABLE `cotejos`
  MODIFY `id_cotejo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2441;

--
-- AUTO_INCREMENT de la tabla `cot_libro`
--
ALTER TABLE `cot_libro`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id_lugares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_motivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vol_tipo`
--
ALTER TABLE `vol_tipo`
  MODIFY `id_vol_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actas`
--
ALTER TABLE `actas`
  ADD CONSTRAINT `fk_acco` FOREIGN KEY (`id_cotejo1`) REFERENCES `cotejos` (`id_cotejo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_conte` FOREIGN KEY (`id_contenido`) REFERENCES `ac_contenidos` (`id_contenido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emac` FOREIGN KEY (`id_emitido1`) REFERENCES `ac_emitido` (`id_emitido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empac` FOREIGN KEY (`id_empresa1`) REFERENCES `empresas` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_escac` FOREIGN KEY (`id_esc_tipo`) REFERENCES `esc_tipo` (`id_esc_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mesac` FOREIGN KEY (`id_mes`) REFERENCES `mes` (`id_mes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perac` FOREIGN KEY (`id_persona1`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `fk_ruta_lugar` FOREIGN KEY (`id_lugar1`) REFERENCES `lugares` (`id_lugares`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruta_usuario` FOREIGN KEY (`id_ususario2`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rutas_ibfk_1` FOREIGN KEY (`id_motivo1`) REFERENCES `motivo_ruta` (`id_motivo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
