-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 10:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myqualitynetworkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accidentes`
--

CREATE TABLE `accidentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accidentes`
--

INSERT INTO `accidentes` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(2, 'Larugod', '2025-07-06 00:40:18', '2025-07-06 00:40:18'),
(3, 'Fractura de cuello', '2025-07-09 05:02:30', '2025-07-09 05:02:30'),
(5, 'Fractura de cuello', '2025-07-09 05:02:32', '2025-07-09 05:02:32'),
(6, 'sisis', '2025-07-11 00:02:51', '2025-07-11 00:02:51'),
(9, 'Antonio', '2025-07-17 02:53:01', '2025-07-17 02:53:01'),
(11, 'hola', '2025-07-17 02:53:25', '2025-08-05 06:15:32'),
(13, 'pancho', '2025-07-17 02:53:32', '2025-08-05 06:17:30'),
(17, 'goku', '2025-08-05 06:15:42', '2025-08-05 06:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `acciones`
--

CREATE TABLE `acciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_centros_consumo`
--

CREATE TABLE `admin_centros_consumo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `propiedad` varchar(255) NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_centros_consumo`
--

INSERT INTO `admin_centros_consumo` (`id`, `nombre`, `propiedad`, `categoria`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Mexkali', 'Palacio Mundo Imperial', 'Vip', NULL, '2025-06-12 05:34:21', '2025-06-12 05:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `agentes`
--

CREATE TABLE `agentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agente` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agentes`
--

INSERT INTO `agentes` (`id`, `agente`, `created_at`, `updated_at`) VALUES
(1, 'Químicos', '2025-06-07 05:58:18', '2025-06-07 05:58:18');

-- --------------------------------------------------------

--
-- Table structure for table `antecedentes_heredofamiliares`
--

CREATE TABLE `antecedentes_heredofamiliares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `fimicos` varchar(255) NOT NULL,
  `luéticos` varchar(255) NOT NULL,
  `diabéticos` varchar(255) NOT NULL,
  `cardiópatas` varchar(255) NOT NULL,
  `epilépticos` varchar(255) NOT NULL,
  `oncologicos` varchar(255) NOT NULL,
  `malf_congen` varchar(255) NOT NULL,
  `atópicos` varchar(255) NOT NULL,
  `otro` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antecedentes_heredofamiliares`
--

INSERT INTO `antecedentes_heredofamiliares` (`id`, `empleados_id`, `fimicos`, `luéticos`, `diabéticos`, `cardiópatas`, `epilépticos`, `oncologicos`, `malf_congen`, `atópicos`, `otro`, `created_at`, `updated_at`) VALUES
(1, 1, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 2, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 3, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 4, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 5, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 6, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 7, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 8, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 9, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 10, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 11, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 12, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 13, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `antecedentes_no_patologicos`
--

CREATE TABLE `antecedentes_no_patologicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `no_patologicos_tabaquismo` varchar(255) NOT NULL,
  `no_patologicos_tabaquismo_especifica` varchar(255) DEFAULT NULL,
  `no_patologicos_alcoholismo` varchar(255) NOT NULL,
  `no_patologicos_alcoholismo_especifica` varchar(255) DEFAULT NULL,
  `no_patologicos_toxicomania` varchar(255) NOT NULL,
  `no_patologicos_toxicomania_especifica` varchar(255) DEFAULT NULL,
  `no_patologicos_menarquia` varchar(255) DEFAULT NULL,
  `no_patologicos_ritmo` varchar(255) DEFAULT NULL,
  `no_patologicos_fum` varchar(255) DEFAULT NULL,
  `no_patologicos_disminorrea` varchar(255) DEFAULT NULL,
  `no_patologicos_ivsa` varchar(255) DEFAULT NULL,
  `no_patologicos_fup` varchar(255) DEFAULT NULL,
  `no_patologicos_doc` varchar(255) DEFAULT NULL,
  `no_patologicos_pf` varchar(255) DEFAULT NULL,
  `no_patologicos_g` varchar(255) DEFAULT NULL,
  `no_patologicos_p` varchar(255) DEFAULT NULL,
  `no_patologicos_c` varchar(255) DEFAULT NULL,
  `no_patologicos_a` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antecedentes_no_patologicos`
--

INSERT INTO `antecedentes_no_patologicos` (`id`, `empleados_id`, `no_patologicos_tabaquismo`, `no_patologicos_tabaquismo_especifica`, `no_patologicos_alcoholismo`, `no_patologicos_alcoholismo_especifica`, `no_patologicos_toxicomania`, `no_patologicos_toxicomania_especifica`, `no_patologicos_menarquia`, `no_patologicos_ritmo`, `no_patologicos_fum`, `no_patologicos_disminorrea`, `no_patologicos_ivsa`, `no_patologicos_fup`, `no_patologicos_doc`, `no_patologicos_pf`, `no_patologicos_g`, `no_patologicos_p`, `no_patologicos_c`, `no_patologicos_a`, `created_at`, `updated_at`) VALUES
(1, 1, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 2, 'Si', NULL, 'Si', NULL, 'Si', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 3, 'Si', NULL, 'Si', NULL, 'Si', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 4, 'Si', NULL, 'Si', NULL, 'Si', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 5, 'Si', NULL, 'Si', NULL, 'Si', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 6, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 7, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 8, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 9, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 10, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 11, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 12, 'No', NULL, 'No', NULL, 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 13, 'Si', NULL, 'Si', NULL, 'Si', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `antecedentes_patologicos`
--

CREATE TABLE `antecedentes_patologicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `fimicos` varchar(255) NOT NULL,
  `lueticos` varchar(255) NOT NULL,
  `diabeticos` varchar(255) NOT NULL,
  `renales` varchar(255) NOT NULL,
  `cardiacos` varchar(255) NOT NULL,
  `hipertensos` varchar(255) NOT NULL,
  `atopicos` varchar(255) NOT NULL,
  `lumbalgias` varchar(255) NOT NULL,
  `traumaticos` varchar(255) NOT NULL,
  `oncologicos` varchar(255) NOT NULL,
  `epilepticos` varchar(255) NOT NULL,
  `quirurgicos` varchar(255) NOT NULL,
  `otro` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `antecedentes_patologicos`
--

INSERT INTO `antecedentes_patologicos` (`id`, `empleados_id`, `fimicos`, `lueticos`, `diabeticos`, `renales`, `cardiacos`, `hipertensos`, `atopicos`, `lumbalgias`, `traumaticos`, `oncologicos`, `epilepticos`, `quirurgicos`, `otro`, `created_at`, `updated_at`) VALUES
(1, 1, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 2, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 3, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 4, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 5, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 6, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 7, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 8, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 9, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 10, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 11, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 12, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 13, 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `archivos`
--

CREATE TABLE `archivos` (
  `id_archivo` int(11) NOT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `tipoarchivo_mime` varchar(200) NOT NULL,
  `tamano` bigint(20) NOT NULL,
  `fechasubida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seccion` varchar(60) NOT NULL,
  `subseccion` varchar(50) NOT NULL,
  `carpeta_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proceso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_documento` varchar(100) NOT NULL DEFAULT '',
  `identificacion` varchar(255) NOT NULL DEFAULT '',
  `responsable_almacenamiento` varchar(255) DEFAULT NULL,
  `tiempo_conservacion` varchar(100) NOT NULL DEFAULT '',
  `disposicion_final` varchar(100) NOT NULL DEFAULT '',
  `edicion` varchar(100) NOT NULL DEFAULT '',
  `estatus_actual` varchar(100) NOT NULL DEFAULT '',
  `se_ha_hecho_cambio` tinyint(1) NOT NULL DEFAULT 0,
  `cambio_realizado` text DEFAULT NULL,
  `medio_soporte` varchar(100) NOT NULL DEFAULT '',
  `razon_eliminacion` text DEFAULT NULL,
  `fecha_eliminacion` date DEFAULT NULL,
  `responsable_eliminacion` varchar(255) DEFAULT NULL,
  `tipo_proceso` varchar(255) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `nueva_edicion` varchar(100) DEFAULT NULL,
  `responsable_cambio` varchar(100) DEFAULT NULL,
  `firma1` tinyint(1) NOT NULL DEFAULT 0,
  `fechafirma1` timestamp NULL DEFAULT NULL,
  `firma2` tinyint(1) NOT NULL DEFAULT 0,
  `fechafirma2` timestamp NULL DEFAULT NULL,
  `firma3` tinyint(1) NOT NULL DEFAULT 0,
  `fechafirma3` timestamp NULL DEFAULT NULL,
  `nueva_fecha_emision` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archivos`
--

INSERT INTO `archivos` (`id_archivo`, `nombre_archivo`, `ruta_archivo`, `tipoarchivo_mime`, `tamano`, `fechasubida`, `seccion`, `subseccion`, `carpeta_id`, `proceso_id`, `visible`, `created_at`, `updated_at`, `tipo_documento`, `identificacion`, `responsable_almacenamiento`, `tiempo_conservacion`, `disposicion_final`, `edicion`, `estatus_actual`, `se_ha_hecho_cambio`, `cambio_realizado`, `medio_soporte`, `razon_eliminacion`, `fecha_eliminacion`, `responsable_eliminacion`, `tipo_proceso`, `fecha_emision`, `nueva_edicion`, `responsable_cambio`, `firma1`, `fechafirma1`, `firma2`, `fechafirma2`, `firma3`, `fechafirma3`, `nueva_fecha_emision`) VALUES
(195, '18° Estudio sobre los Habitos de Personas Usuarias de Internet en Mexico 2022 (Publica) v2.pdf', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//IytYnfX3aoD9RMnHvpzPC4LTWk8lBfLX82fFQD1Q.pdf', 'application/pdf', 1621059, '2025-04-01 18:34:15', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-04-02 00:34:15', '2025-04-02 00:34:15', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(196, 'Captura.JPG', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//6UYw9wcs7YxXwgFNck3l4T9Ecz7X6z8cRgNYZqcL.jpg', 'image/jpeg', 131889, '2025-04-03 19:25:16', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-04-04 01:25:16', '2025-04-04 01:25:16', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(197, 'Captura.JPG', 'archivos/calidad/procesos_operativos/Carpeta adicional//D7AUt9yZ7gyZ1fOL54UDp2cBsuEVpJdlpRouKf3F.jpg', 'image/jpeg', 131889, '2025-04-03 19:29:22', 'calidad', 'procesos_operativos', 73, NULL, 1, '2025-04-04 01:29:22', '2025-04-04 01:29:22', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(198, 'Anteproyecto y documentos de recidencias.pdf', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento/Subcarpeta//Y8QSMDDL04Ltu0emuTAZFI7Rs7GSYAiSJI5oS3LK.pdf', 'application/pdf', 1326506, '2025-04-19 19:22:34', 'calidad', 'procesos_de_apoyo', 79, 6, 1, '2025-04-20 01:22:34', '2025-04-20 01:22:34', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(199, '66ba3f6b8997a_Plan_de_Accion (11).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//0Cc71AoN460Mo7Qe7a5e6NpKU6aLN2f71vS3msPT.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(200, '6723c8c8b6ead_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//Eo08RdlyLKukoiqef7JtD42Uhi2PUDpAmcUFq6d2.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(201, '6723c8c009892_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//d2HLo6NqWGIk3HtJZfEc84uUyJEkvNkXuDE4vSfT.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(202, '6723c8ca5ff00_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//7w9hSyaIWPY5bQNqir2XG7jSY9xTkOI2wtDuqrt2.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(203, '6723ca4f0fcfb_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//qyLbcFNpeuKGfPXERkTV54xrH42iPNB4bQwTSvjv.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(204, '6723ca46bfb4e_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//uW3wjnPF1B9LUZ0lKq6U0vxuUmTy6FyAxBrBmV3Z.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(205, '6723ca513b88f_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//tLSpNyelTw4Y5MoFpw3i50YfN2noBekiG20rh4yQ.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(206, '6723d1e7034a5_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//z9FR8W2egt29Zzfv6giACXmURLOLAm7fkXx8QFb0.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(207, '6723d02e53dd9_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//bdlvOWvV8z5LubZtY5qr0vIchoekiMVYiHKhIig7.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(208, '6723d05dc77a1_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//5ig2sPPUSCYszOycP0IylzSeKploJvraU9wGSsgq.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(209, '6723d22cd2d69_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//hNv1tW24eSW0dlHJH9WlLTTbbsEtDooSxqlooLPL.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(210, '6723d22e7120d_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//XQLrc5RIQOw1QHyz9Rk3k0PqSD4T8L4TWmzoDblB.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(211, '6723d0299cc28_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//ydvrMiv7g88U1bhW1arP5ytuP2d6EjgYsXMcqkHO.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(212, '6723d21852188_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//haAsAiWh1SI1qjnxYn76YEhJP35S62Os0TucKMda.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(213, '6723d22824010_test_plan.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//HY3MQnBO4mbMFM0CIiBOptz74BGEiM5mCvnnj7Ow.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(214, '6733ac59b7caa_Plan_de_Accion (2).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//kV3y21VbQWucxSV07wzhNN09KbcgyjQaI6K1glk6.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(215, '6733d21c3d8dc_Plan_de_Accion (1).jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//KEksciJXxAbZwMO5JqZFYVNi8T8VuqUdXiug2jUd.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(216, '67129f0535077_Plan_de_Accion.jpg', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento//9vKqN1V7cTNPeBy5ObuC8A983Hxp8WKl1hA9nKoj.png', 'image/jpeg', 53619, '2025-05-27 20:05:48', 'calidad', 'procesos_de_apoyo', 71, 6, 1, '2025-05-28 02:05:48', '2025-05-28 02:05:48', '', '', NULL, '', '', '', '', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(217, 'Firma.png', 'archivos/calidad/procesos_operativos/Alimentos y Bebidas-Alimentos y Bebidas/prueba1//AlLiY1OEfYOwQlJbLoZjrVZpUp4LlxqJbWEgXRHq.png', 'image/png', 6255, '2025-06-11 18:33:47', 'calidad', 'procesos_operativos', 104, 17, 0, '2025-06-12 00:29:44', '2025-06-12 00:33:47', 'Interna', 'Por Nombre', 'Andrea', '4 meses', 'Destrucción', '02', 'Vigente', 0, NULL, 'Carpeta Física', 'ya no sirve', '2025-11-06', 'Andrea', 'Alimentos y Bebidas', '2025-11-06', NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL),
(218, 'Firma.png', 'archivos/calidad/procesos_operativos/Alimentos y Bebidas-Alimentos y Bebidas/prueba1//TI7CHp4viGniRWc7uvbrxdQGwZmuQQRTLXk2kODN.png', 'image/png', 6255, '2025-06-11 18:55:10', 'calidad', 'procesos_operativos', 104, 17, 1, '2025-06-12 00:49:27', '2025-06-12 00:55:10', 'Interna', 'Por Nombre', 'Karla', '4 meses', 'Destrucción', '05', 'Obsoleto', 1, 'njjkkljbhjkl', 'Carpeta Física', NULL, NULL, NULL, 'Alimentos y Bebidas', '2025-11-06', '07', 'hjljhbljbhl', 0, NULL, 0, NULL, 0, NULL, '2025-11-06'),
(219, 'FirmaMedico.png', 'archivos/calidad/procesos_operativos/Alimentos y Bebidas-Alimentos y Bebidas/prueba1//14Et1YzM8IEihHFzdqKRFtNOGdGW16yBgcGYWjRn.png', 'image/png', 5941, '2025-06-11 18:49:27', 'calidad', 'procesos_operativos', 104, 17, 1, '2025-06-12 00:55:10', '2025-06-12 00:55:10', 'Interna', 'Por Nombre', 'hjljhbljbhl', '4 meses', 'Destrucción', '07', 'Vigente', 0, NULL, 'Carpeta Física', NULL, NULL, NULL, 'Alimentos y Bebidas', '2025-11-06', NULL, NULL, 0, NULL, 0, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `areas_procedencia`
--

CREATE TABLE `areas_procedencia` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas_procedencia`
--

INSERT INTO `areas_procedencia` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(4, 'Cocina Marché', '2025-06-05 04:49:35', '2025-06-05 04:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `asignadas`
--

CREATE TABLE `asignadas` (
  `Sal_Pre` varchar(5) DEFAULT NULL,
  `N_Hab` int(11) DEFAULT NULL,
  `Tp_Hab` varchar(25) DEFAULT NULL,
  `Piso` int(11) DEFAULT NULL,
  `Status` varchar(25) DEFAULT NULL,
  `Tpo` varchar(25) DEFAULT NULL,
  `AD` int(11) DEFAULT NULL,
  `MN` int(11) DEFAULT NULL,
  `Creds` int(11) DEFAULT NULL,
  `Titular` varchar(255) DEFAULT NULL,
  `Camarista` varchar(255) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asignadas`
--

INSERT INTO `asignadas` (`Sal_Pre`, `N_Hab`, `Tp_Hab`, `Piso`, `Status`, `Tpo`, `AD`, `MN`, `Creds`, `Titular`, `Camarista`, `Fecha`, `Hora`) VALUES
(NULL, 1, 'abc', 3, 'avaible', NULL, NULL, NULL, 1, NULL, 'Andrea Pérez', '2025-06-11', '23:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `auxiliares_diagnosticos`
--

CREATE TABLE `auxiliares_diagnosticos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `radiografias` varchar(255) DEFAULT NULL,
  `torax` varchar(255) DEFAULT NULL,
  `col_lumbar` varchar(255) DEFAULT NULL,
  `laboratorio` varchar(255) DEFAULT NULL,
  `audiometria` varchar(255) DEFAULT NULL,
  `otros` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auxiliares_diagnosticos`
--

INSERT INTO `auxiliares_diagnosticos` (`id`, `empleados_id`, `radiografias`, `torax`, `col_lumbar`, `laboratorio`, `audiometria`, `otros`, `created_at`, `updated_at`) VALUES
(1, 12, 'No', 'Sí', 'No', 'No', 'No', 'Ninguno', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'No', 'No', 'No', 'Sí', 'No', 'Ninguno', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('saca001008cq0|127.0.0.1', 'i:1;', 1766515668),
('saca001008cq0|127.0.0.1:timer', 'i:1766515668;', 1766515668),
('sacarfc123456|127.0.0.1', 'i:2;', 1766515678),
('sacarfc123456|127.0.0.1:timer', 'i:1766515678;', 1766515678);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cafeteria_kali_tables`
--

CREATE TABLE `cafeteria_kali_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carpetas`
--

CREATE TABLE `carpetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre_carpeta` varchar(255) NOT NULL,
  `seccion` varchar(255) NOT NULL,
  `subseccion` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proceso_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carpetas`
--

INSERT INTO `carpetas` (`id`, `parent_id`, `nombre_carpeta`, `seccion`, `subseccion`, `ruta`, `created_at`, `updated_at`, `proceso_id`) VALUES
(71, NULL, 'Ingenieria y Mantenimiento', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento', '2025-03-25 07:20:05', '2025-03-25 07:20:05', 6),
(72, NULL, 'Prevención de Riesgos', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/Prevención de Riesgos', '2025-04-04 01:14:26', '2025-04-04 01:14:26', 7),
(73, NULL, 'Carpeta adicional', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/Carpeta adicional', '2025-04-04 01:14:43', '2025-04-04 01:14:43', NULL),
(74, NULL, 'aaaa', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/aaaa', '2025-04-04 02:05:37', '2025-04-04 02:05:37', NULL),
(78, NULL, 'Carpeta Prueba', 'calidad', 'control_planes_de_acción', 'archivos/calidad/control_planes_de_acción/Carpeta Prueba', '2025-04-15 03:05:41', '2025-04-15 03:05:41', NULL),
(79, 71, 'Subcarpeta', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/Ingenieria y Mantenimiento/Subcarpeta', '2025-04-20 01:21:11', '2025-04-20 01:21:11', 6),
(80, NULL, 'Seccion prueba', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/Seccion prueba', '2025-04-24 00:22:43', '2025-04-24 00:22:43', 6),
(81, NULL, '1', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/1', '2025-05-16 02:21:28', '2025-05-16 02:21:28', NULL),
(82, NULL, '2', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/2', '2025-05-16 02:21:39', '2025-05-16 02:21:39', NULL),
(83, NULL, '3', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/3', '2025-05-16 02:21:47', '2025-05-16 02:21:47', NULL),
(84, NULL, '4', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/4', '2025-05-16 02:21:54', '2025-05-16 02:21:54', NULL),
(85, NULL, '5', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/5', '2025-05-16 02:22:02', '2025-05-16 02:22:02', NULL),
(86, NULL, 'asdadadada', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/asdadadada', '2025-05-16 02:22:56', '2025-05-16 02:22:56', NULL),
(87, NULL, 'adasdadas', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/adasdadas', '2025-05-16 02:23:04', '2025-05-16 02:23:04', NULL),
(88, NULL, 'rqrqeqewqewqeq', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/rqrqeqewqewqeq', '2025-05-16 02:23:11', '2025-05-16 02:23:11', NULL),
(89, NULL, 'reqweqweqweqweqw', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/reqweqweqweqweqw', '2025-05-16 02:23:17', '2025-05-16 02:23:17', NULL),
(90, NULL, 'qeqe1e12e21e', 'calidad', 'procesos_de_apoyo', 'archivos/calidad/procesos_de_apoyo/qeqe1e12e21e', '2025-05-16 02:23:24', '2025-05-16 02:23:24', NULL),
(91, NULL, 'q4e1e1e12e21', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/q4e1e1e12e21', '2025-05-16 02:23:31', '2025-05-16 02:23:31', NULL),
(93, NULL, '12313', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/12313', '2025-05-20 07:36:09', '2025-05-20 07:36:09', NULL),
(94, NULL, '124555435', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/124555435', '2025-05-20 07:36:17', '2025-05-20 07:36:17', NULL),
(95, NULL, '1321445', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/1321445', '2025-05-20 07:36:24', '2025-05-20 07:36:24', NULL),
(96, NULL, '14555', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/14555', '2025-05-20 07:36:30', '2025-05-20 07:36:30', NULL),
(97, NULL, '6534673456', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/6534673456', '2025-05-20 07:36:37', '2025-05-20 07:36:37', NULL),
(98, NULL, '5235234', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/5235234', '2025-05-20 07:36:45', '2025-05-20 07:36:45', NULL),
(99, NULL, '634634525254', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/634634525254', '2025-05-20 07:36:55', '2025-05-20 07:36:55', NULL),
(100, NULL, '63634634', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/63634634', '2025-05-20 07:37:02', '2025-05-20 07:37:02', NULL),
(101, NULL, 'HGDGGDFGD', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/HGDGGDFGD', '2025-05-20 07:37:12', '2025-05-20 07:37:12', NULL),
(102, NULL, 'qeqeqweqwe', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/qeqeqweqwe', '2025-05-20 07:37:57', '2025-05-20 07:37:57', NULL),
(103, NULL, 'Alimentos y Bebidas', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/Alimentos y Bebidas-Alimentos y Bebidas', '2025-06-12 00:28:33', '2025-06-12 00:28:33', 17),
(104, 103, 'prueba1', 'calidad', 'procesos_operativos', 'archivos/calidad/procesos_operativos/Alimentos y Bebidas-Alimentos y Bebidas/prueba1', '2025-06-12 00:28:49', '2025-06-12 00:28:49', NULL),
(105, NULL, 'SExoo', 'seguridad_salud', 'gestion', 'archivos/seguridad_salud/gestion/SExoo', '2025-07-21 01:59:00', '2025-07-21 01:59:00', NULL),
(106, NULL, 'Juan juanito juan', 'seguridad_alimentaria', 'inocuidad', 'archivos/seguridad_alimentaria/inocuidad/Juan juanito juan', '2025-07-21 02:00:25', '2025-07-21 02:00:25', NULL),
(107, 105, 'ahhhhhhhhhhhhhhhh', 'seguridad_salud', 'gestion', 'archivos/seguridad_salud/gestion/SExoo/ahhhhhhhhhhhhhhhh', '2025-07-21 02:00:45', '2025-07-21 02:00:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `catalogo`
--

CREATE TABLE `catalogo` (
  `N_Hab` int(11) NOT NULL,
  `Tp_Hab` varchar(15) NOT NULL,
  `Edificio` varchar(15) NOT NULL,
  `Piso` int(11) NOT NULL,
  `Cred_Pasaje` int(11) NOT NULL,
  `Cred_Salida` int(11) NOT NULL,
  `Secciones` varchar(100) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogo`
--

INSERT INTO `catalogo` (`N_Hab`, `Tp_Hab`, `Edificio`, `Piso`, `Cred_Pasaje`, `Cred_Salida`, `Secciones`, `Status`) VALUES
(1, 'abc', 'piramide', 3, 1, 20, 'agua', 'avaible'),
(1101, 'TKOA', 'B', 4, 1, 2, NULL, 'VA-S');

-- --------------------------------------------------------

--
-- Table structure for table `causas`
--

CREATE TABLE `causas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `causas`
--

INSERT INTO `causas` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Mala', '2025-07-06 00:18:57', '2025-08-05 06:26:59');

-- --------------------------------------------------------

--
-- Table structure for table `centrosdeconsumo`
--

CREATE TABLE `centrosdeconsumo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Propiedad` varchar(100) NOT NULL,
  `Centroconsumo` varchar(100) NOT NULL,
  `Mesa` int(11) NOT NULL,
  `Habitacion` int(11) DEFAULT NULL,
  `Huesped` varchar(100) DEFAULT NULL,
  `Pax` double DEFAULT NULL,
  `Mesero` varchar(100) DEFAULT NULL,
  `Categoria` text DEFAULT NULL,
  `Cantidad` text DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Importe` text DEFAULT NULL,
  `Propina` decimal(10,2) DEFAULT NULL,
  `Descuento` decimal(10,2) DEFAULT NULL,
  `Forma_Pago` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centrosdeconsumo`
--

INSERT INTO `centrosdeconsumo` (`id`, `Propiedad`, `Centroconsumo`, `Mesa`, `Habitacion`, `Huesped`, `Pax`, `Mesero`, `Categoria`, `Cantidad`, `Descripcion`, `Importe`, `Propina`, `Descuento`, `Forma_Pago`, `created_at`, `updated_at`) VALUES
(1, 'Palacio Mundo Imperial', 'Marche', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Palacio Mundo Imperial', 'Marche', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Palacio Mundo Imperial', 'Marche', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Palacio Mundo Imperial', 'Marche', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Palacio Mundo Imperial', 'Marche', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Palacio Mundo Imperial', 'Marche', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Palacio Mundo Imperial', 'Marche', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Palacio Mundo Imperial', 'Marche', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Palacio Mundo Imperial', 'Marche', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Palacio Mundo Imperial', 'Marche', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Palacio Mundo Imperial', 'Marche', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Palacio Mundo Imperial', 'Marche', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Palacio Mundo Imperial', 'Marche', 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Palacio Mundo Imperial', 'Marche', 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Palacio Mundo Imperial', 'Marche', 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Palacio Mundo Imperial', 'Marche', 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Palacio Mundo Imperial', 'Marche', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Palacio Mundo Imperial', 'Marche', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Palacio Mundo Imperial', 'Marche', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Palacio Mundo Imperial', 'Marche', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Palacio Mundo Imperial', 'Marche', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Palacio Mundo Imperial', 'Marche', 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Palacio Mundo Imperial', 'Marche', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Palacio Mundo Imperial', 'Marche', 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Palacio Mundo Imperial', 'Marche', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Palacio Mundo Imperial', 'Marche', 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Palacio Mundo Imperial', 'Marche', 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Palacio Mundo Imperial', 'Marche', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Palacio Mundo Imperial', 'Marche', 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Palacio Mundo Imperial', 'Marche', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Palacio Mundo Imperial', 'Marche', 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Palacio Mundo Imperial', 'Marche', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Palacio Mundo Imperial', 'Marche', 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Palacio Mundo Imperial', 'Marche', 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Palacio Mundo Imperial', 'Marche', 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Palacio Mundo Imperial', 'Marche', 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Palacio Mundo Imperial', 'Marche', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Palacio Mundo Imperial', 'Marche', 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Palacio Mundo Imperial', 'Marche', 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Palacio Mundo Imperial', 'Marche', 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Palacio Mundo Imperial', 'Marche', 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Palacio Mundo Imperial', 'Marche', 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Palacio Mundo Imperial', 'Marche', 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Palacio Mundo Imperial', 'Marche', 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Palacio Mundo Imperial', 'Marche', 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Palacio Mundo Imperial', 'Marche', 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Palacio Mundo Imperial', 'Marche', 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Palacio Mundo Imperial', 'Marche', 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Palacio Mundo Imperial', 'Marche', 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Palacio Mundo Imperial', 'Marche', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Palacio Mundo Imperial', 'Marche', 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Palacio Mundo Imperial', 'Marche', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Palacio Mundo Imperial', 'Marche', 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Palacio Mundo Imperial', 'Marche', 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Palacio Mundo Imperial', 'Marche', 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'Palacio Mundo Imperial', 'Marche', 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'Palacio Mundo Imperial', 'Marche', 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Palacio Mundo Imperial', 'Marche', 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'Palacio Mundo Imperial', 'Marche', 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Palacio Mundo Imperial', 'Marche', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Palacio Mundo Imperial', 'Marche', 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Palacio Mundo Imperial', 'Marche', 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Palacio Mundo Imperial', 'Marche', 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'Palacio Mundo Imperial', 'Marche', 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Palacio Mundo Imperial', 'Marche', 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'Palacio Mundo Imperial', 'Marche', 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Palacio Mundo Imperial', 'Marche', 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'Palacio Mundo Imperial', 'Marche', 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'Palacio Mundo Imperial', 'Marche', 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Palacio Mundo Imperial', 'Marche', 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Palacio Mundo Imperial', 'Marche', 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'Palacio Mundo Imperial', 'Marche', 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'Palacio Mundo Imperial', 'Marche', 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'Palacio Mundo Imperial', 'Marche', 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Palacio Mundo Imperial', 'Marche', 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'Palacio Mundo Imperial', 'Marche', 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'Palacio Mundo Imperial', 'Marche', 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'Palacio Mundo Imperial', 'Marche', 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'Palacio Mundo Imperial', 'Marche', 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'Palacio Mundo Imperial', 'Marche', 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Palacio Mundo Imperial', 'Marche', 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'Palacio Mundo Imperial', 'Marche', 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'Palacio Mundo Imperial', 'Marche', 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Palacio Mundo Imperial', 'Marche', 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'Palacio Mundo Imperial', 'Marche', 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'Palacio Mundo Imperial', 'Marche', 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'Palacio Mundo Imperial', 'Marche', 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Palacio Mundo Imperial', 'Marche', 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Palacio Mundo Imperial', 'Marche', 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'Palacio Mundo Imperial', 'Marche', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Palacio Mundo Imperial', 'Marche', 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Palacio Mundo Imperial', 'Marche', 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'Palacio Mundo Imperial', 'Marche', 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Palacio Mundo Imperial', 'Marche', 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Palacio Mundo Imperial', 'Marche', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'Palacio Mundo Imperial', 'Marche', 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'Palacio Mundo Imperial', 'Marche', 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'Palacio Mundo Imperial', 'Marche', 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'Palacio Mundo Imperial', 'Marche', 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Palacio Mundo Imperial', 'Marche', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `centrosdeconsumo_respaldo`
--

CREATE TABLE `centrosdeconsumo_respaldo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Propiedad` varchar(100) NOT NULL,
  `Centroconsumo` varchar(100) NOT NULL,
  `Mesa` int(11) NOT NULL,
  `Habitacion` int(11) DEFAULT NULL,
  `Huesped` varchar(100) DEFAULT NULL,
  `Pax` double DEFAULT NULL,
  `Mesero` varchar(100) DEFAULT NULL,
  `Categoria` text DEFAULT NULL,
  `Cantidad` text DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Importe` text DEFAULT NULL,
  `Propina` decimal(10,2) DEFAULT NULL,
  `Descuento` decimal(10,2) DEFAULT NULL,
  `Forma_Pago` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centrosdeconsumo_respaldo`
--

INSERT INTO `centrosdeconsumo_respaldo` (`id`, `Propiedad`, `Centroconsumo`, `Mesa`, `Habitacion`, `Huesped`, `Pax`, `Mesero`, `Categoria`, `Cantidad`, `Descripcion`, `Importe`, `Propina`, `Descuento`, `Forma_Pago`, `created_at`, `updated_at`) VALUES
(1, 'Palacio Mundo Imperial', 'Marche', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Palacio Mundo Imperial', 'Marche', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Palacio Mundo Imperial', 'Marche', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Palacio Mundo Imperial', 'Marche', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Palacio Mundo Imperial', 'Marche', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Palacio Mundo Imperial', 'Marche', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Palacio Mundo Imperial', 'Marche', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Palacio Mundo Imperial', 'Marche', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Palacio Mundo Imperial', 'Marche', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Palacio Mundo Imperial', 'Marche', 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Palacio Mundo Imperial', 'Marche', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Palacio Mundo Imperial', 'Marche', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Palacio Mundo Imperial', 'Marche', 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Palacio Mundo Imperial', 'Marche', 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Palacio Mundo Imperial', 'Marche', 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Palacio Mundo Imperial', 'Marche', 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Palacio Mundo Imperial', 'Marche', 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Palacio Mundo Imperial', 'Marche', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Palacio Mundo Imperial', 'Marche', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Palacio Mundo Imperial', 'Marche', 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Palacio Mundo Imperial', 'Marche', 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Palacio Mundo Imperial', 'Marche', 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Palacio Mundo Imperial', 'Marche', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Palacio Mundo Imperial', 'Marche', 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Palacio Mundo Imperial', 'Marche', 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'Palacio Mundo Imperial', 'Marche', 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Palacio Mundo Imperial', 'Marche', 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Palacio Mundo Imperial', 'Marche', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Palacio Mundo Imperial', 'Marche', 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Palacio Mundo Imperial', 'Marche', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Palacio Mundo Imperial', 'Marche', 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Palacio Mundo Imperial', 'Marche', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Palacio Mundo Imperial', 'Marche', 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Palacio Mundo Imperial', 'Marche', 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Palacio Mundo Imperial', 'Marche', 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Palacio Mundo Imperial', 'Marche', 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Palacio Mundo Imperial', 'Marche', 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Palacio Mundo Imperial', 'Marche', 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Palacio Mundo Imperial', 'Marche', 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Palacio Mundo Imperial', 'Marche', 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Palacio Mundo Imperial', 'Marche', 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Palacio Mundo Imperial', 'Marche', 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Palacio Mundo Imperial', 'Marche', 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Palacio Mundo Imperial', 'Marche', 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Palacio Mundo Imperial', 'Marche', 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Palacio Mundo Imperial', 'Marche', 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Palacio Mundo Imperial', 'Marche', 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Palacio Mundo Imperial', 'Marche', 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Palacio Mundo Imperial', 'Marche', 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Palacio Mundo Imperial', 'Marche', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Palacio Mundo Imperial', 'Marche', 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Palacio Mundo Imperial', 'Marche', 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Palacio Mundo Imperial', 'Marche', 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Palacio Mundo Imperial', 'Marche', 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Palacio Mundo Imperial', 'Marche', 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'Palacio Mundo Imperial', 'Marche', 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'Palacio Mundo Imperial', 'Marche', 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Palacio Mundo Imperial', 'Marche', 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'Palacio Mundo Imperial', 'Marche', 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Palacio Mundo Imperial', 'Marche', 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Palacio Mundo Imperial', 'Marche', 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Palacio Mundo Imperial', 'Marche', 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Palacio Mundo Imperial', 'Marche', 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'Palacio Mundo Imperial', 'Marche', 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Palacio Mundo Imperial', 'Marche', 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'Palacio Mundo Imperial', 'Marche', 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Palacio Mundo Imperial', 'Marche', 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'Palacio Mundo Imperial', 'Marche', 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'Palacio Mundo Imperial', 'Marche', 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Palacio Mundo Imperial', 'Marche', 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Palacio Mundo Imperial', 'Marche', 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'Palacio Mundo Imperial', 'Marche', 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'Palacio Mundo Imperial', 'Marche', 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'Palacio Mundo Imperial', 'Marche', 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Palacio Mundo Imperial', 'Marche', 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'Palacio Mundo Imperial', 'Marche', 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'Palacio Mundo Imperial', 'Marche', 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'Palacio Mundo Imperial', 'Marche', 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'Palacio Mundo Imperial', 'Marche', 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'Palacio Mundo Imperial', 'Marche', 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Palacio Mundo Imperial', 'Marche', 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'Palacio Mundo Imperial', 'Marche', 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'Palacio Mundo Imperial', 'Marche', 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Palacio Mundo Imperial', 'Marche', 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'Palacio Mundo Imperial', 'Marche', 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'Palacio Mundo Imperial', 'Marche', 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'Palacio Mundo Imperial', 'Marche', 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Palacio Mundo Imperial', 'Marche', 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Palacio Mundo Imperial', 'Marche', 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'Palacio Mundo Imperial', 'Marche', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Palacio Mundo Imperial', 'Marche', 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Palacio Mundo Imperial', 'Marche', 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'Palacio Mundo Imperial', 'Marche', 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Palacio Mundo Imperial', 'Marche', 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Palacio Mundo Imperial', 'Marche', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'Palacio Mundo Imperial', 'Marche', 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'Palacio Mundo Imperial', 'Marche', 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'Palacio Mundo Imperial', 'Marche', 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'Palacio Mundo Imperial', 'Marche', 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Palacio Mundo Imperial', 'Marche', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compras`
--

CREATE TABLE `compras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `anio` smallint(6) NOT NULL,
  `mes` tinyint(4) NOT NULL,
  `tipo_residuo_id` bigint(20) UNSIGNED NOT NULL,
  `compra_kg` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compras`
--

INSERT INTO `compras` (`id`, `fecha_inicio`, `fecha_fin`, `anio`, `mes`, `tipo_residuo_id`, `compra_kg`, `created_at`, `updated_at`) VALUES
(1, '2025-06-01', '2025-06-30', 2025, 6, 2, 56.00, '2025-06-05 04:52:52', '2025-06-05 04:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `control_documental_tables`
--

CREATE TABLE `control_documental_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `control_energeticos_tables`
--

CREATE TABLE `control_energeticos_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `unidad` varchar(255) NOT NULL,
  `modulo` varchar(255) NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3490dc',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `control_energeticos_tables`
--

INSERT INTO `control_energeticos_tables` (`id`, `nombre`, `unidad`, `modulo`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Electricidad', 'kWh', 'energia', '#FFD700', '2025-06-07 03:40:02', '2025-06-07 03:40:02'),
(2, 'Gasolina', 'Litros', 'aire', '#FF6347', '2025-06-07 03:40:02', '2025-06-07 03:40:02'),
(3, 'Agua', 'm³', 'agua', '#1E90FF', '2025-06-07 03:40:02', '2025-06-07 03:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `control_plan_tables`
--

CREATE TABLE `control_plan_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `creditos`
--

CREATE TABLE `creditos` (
  `id_creditos` varchar(30) NOT NULL,
  `creditos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `creditos`
--

INSERT INTO `creditos` (`id_creditos`, `creditos`) VALUES
('1', 30);

-- --------------------------------------------------------

--
-- Table structure for table `datos_fisicos`
--

CREATE TABLE `datos_fisicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `fisico_peso` double DEFAULT NULL,
  `fisico_talla` double DEFAULT NULL,
  `fisico_ta` varchar(255) DEFAULT NULL,
  `fisico_fc` int(11) DEFAULT NULL,
  `fisico_fr` int(11) DEFAULT NULL,
  `fisico_imc` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datos_fisicos`
--

INSERT INTO `datos_fisicos` (`id`, `empleados_id`, `fisico_peso`, `fisico_talla`, `fisico_ta`, `fisico_fc`, `fisico_fr`, `fisico_imc`, `created_at`, `updated_at`) VALUES
(1, 12, 46, 50, NULL, NULL, NULL, NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 102, 134, NULL, NULL, NULL, NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `propiedad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proceso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`id`, `departamento`, `propiedad_id`, `proceso_id`, `created_at`, `updated_at`) VALUES
(1, 'Calidad Prueba', NULL, NULL, '2025-06-07 05:21:10', '2025-06-07 05:21:10'),
(2, 'Adnistrativo de Area', NULL, NULL, '2025-07-05 07:50:23', '2025-07-05 07:50:23'),
(3, 'Adnistrativo de Areaaaaa', NULL, NULL, '2025-07-05 07:54:31', '2025-07-05 07:54:31'),
(4, '20234565', NULL, NULL, '2025-07-05 08:14:48', '2025-07-05 08:14:48'),
(5, 'Adnistrativo de Areaaaaa', 2, NULL, '2025-07-11 03:18:28', '2025-07-11 03:18:28'),
(9, 'Yael', 3, NULL, '2025-07-11 08:07:38', '2025-07-11 08:07:38'),
(10, 'Yael', 1, NULL, '2025-07-16 05:30:42', '2025-07-16 05:30:42'),
(11, 'Carbajaaaaaal', 5, 18, '2025-07-19 06:46:19', '2025-07-19 06:46:19'),
(12, 'Adnistrativo de Area', 5, 7, '2025-07-20 00:46:34', '2025-07-20 00:46:34'),
(13, 'El jefaso', 6, 21, '2025-07-20 01:24:52', '2025-07-20 01:24:52'),
(14, 'Mama', 6, 22, '2025-07-21 01:19:11', '2025-07-21 01:19:11'),
(15, 'hola', 5, 19, '2025-07-23 06:10:20', '2025-07-23 06:10:20'),
(16, 'Calidad Prueba', 1, 6, '2025-08-03 00:40:04', '2025-08-03 00:40:04'),
(17, 'Calidad Prueba', 1, 23, '2025-08-16 00:24:09', '2025-08-16 00:24:09'),
(18, 'Limpieza', 1, 23, '2025-08-16 00:24:25', '2025-08-16 00:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `estado_civil` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `escolaridad` varchar(255) NOT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `no_zapato` varchar(255) DEFAULT NULL,
  `talla_playera` varchar(255) DEFAULT NULL,
  `talla_pantalon` varchar(255) DEFAULT NULL,
  `tel_emergencia` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) NOT NULL,
  `puesto_aspirante` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `edad`, `genero`, `estado_civil`, `fecha_nacimiento`, `direccion`, `telefono`, `escolaridad`, `razon_social`, `no_zapato`, `talla_playera`, `talla_pantalon`, `tel_emergencia`, `departamento`, `puesto_aspirante`, `created_at`, `updated_at`) VALUES
(1, 'Andrea Lisset Salmerón Cárdenas', 24, 'Femenino', 'Casado/a', '2000-08-10', 'Gran Vía Coloso', '7442543626', 'Licenciatura', 'Palacio Mundo Imperial', '24', '100', '28', '7442673054', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 'Karla Edith Gallardo Santos', 24, 'Femenino', 'Soltero/a', '2001-12-02', 'Colonia Colosio', '7442543626', 'Licenciatura', 'Palacio Mundo Imperial', '23', '75', '28', '1234567898', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 'Karla Edith Gallardo Santos', 24, 'Femenino', 'Soltero/a', '2001-12-02', 'Colonia Colosio', '7442543626', 'Licenciatura', 'Palacio Mundo Imperial', '23', '75', '28', '1234567898', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 'Karla Edith Gallardo Santos', 24, 'Femenino', 'Soltero/a', '2001-12-02', 'Colonia Colosio', '7442543626', 'Licenciatura', 'Palacio Mundo Imperial', '23', '75', '28', '1234567898', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 'Karla Edith Gallardo Santos', 24, 'Femenino', 'Soltero/a', '2001-12-02', 'Colonia Colosio', '7442543626', 'Licenciatura', 'Palacio Mundo Imperial', '23', '75', '28', '1234567898', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 'Maria Isabel', 24, 'Femenino', 'Separado/a', '2000-07-11', 'Colonia Progreso', '7423567898', 'Primaria', 'Palacio Mundo Imperial', '24', '70', '28', '2345678675', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 'Pulo Eddi', 34, 'Femenino', 'Union Libre', '1991-01-11', 'Colonia Colosio', '7442543626', 'Licenciatura', 'Palacio Mundo Imperial', '24', '75', '28', '1234567898', 'Calidad Prueba', 'Auxiliar de Calidad', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_abdomen`
--

CREATE TABLE `exploracion_abdomen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `megalias` varchar(255) NOT NULL,
  `hernias` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_abdomen`
--

INSERT INTO `exploracion_abdomen` (`id`, `empleados_id`, `megalias`, `hernias`, `created_at`, `updated_at`) VALUES
(1, 12, 'Negativo', 'Negativo', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Negativo', 'Negativo', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_agudeza_visual`
--

CREATE TABLE `exploracion_agudeza_visual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `SL` varchar(255) NOT NULL,
  `CL` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_agudeza_visual`
--

INSERT INTO `exploracion_agudeza_visual` (`id`, `empleados_id`, `SL`, `CL`, `created_at`, `updated_at`) VALUES
(1, 12, 'O.D.', 'O.D.', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'O.D.', 'O.D.', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_boca`
--

CREATE TABLE `exploracion_boca` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `mucosas` varchar(255) NOT NULL,
  `dentadura` varchar(255) NOT NULL,
  `lengua` varchar(255) NOT NULL,
  `encias` varchar(255) NOT NULL,
  `faringe` varchar(255) NOT NULL,
  `amigdalas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_boca`
--

INSERT INTO `exploracion_boca` (`id`, `empleados_id`, `mucosas`, `dentadura`, `lengua`, `encias`, `faringe`, `amigdalas`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_columna_cervical`
--

CREATE TABLE `exploracion_columna_cervical` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `integridad` varchar(255) NOT NULL,
  `integridad_observacion` varchar(255) DEFAULT NULL,
  `forma` varchar(255) NOT NULL,
  `forma_observacion` varchar(255) DEFAULT NULL,
  `movimientos` varchar(255) NOT NULL,
  `movimientos_observacion` varchar(255) DEFAULT NULL,
  `fuerza` varchar(255) NOT NULL,
  `fuerza_observacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_columna_cervical`
--

INSERT INTO `exploracion_columna_cervical` (`id`, `empleados_id`, `integridad`, `integridad_observacion`, `forma`, `forma_observacion`, `movimientos`, `movimientos_observacion`, `fuerza`, `fuerza_observacion`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_columna_dorsal`
--

CREATE TABLE `exploracion_columna_dorsal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `integridad` varchar(255) NOT NULL,
  `integridad_observacion` varchar(255) DEFAULT NULL,
  `forma` varchar(255) NOT NULL,
  `forma_observacion` varchar(255) DEFAULT NULL,
  `movimientos` varchar(255) NOT NULL,
  `movimientos_observacion` varchar(255) DEFAULT NULL,
  `fuerza` varchar(255) NOT NULL,
  `fuerza_observacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_columna_dorsal`
--

INSERT INTO `exploracion_columna_dorsal` (`id`, `empleados_id`, `integridad`, `integridad_observacion`, `forma`, `forma_observacion`, `movimientos`, `movimientos_observacion`, `fuerza`, `fuerza_observacion`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_columna_lumbar`
--

CREATE TABLE `exploracion_columna_lumbar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `integridad` varchar(255) NOT NULL,
  `integridad_observacion` varchar(255) DEFAULT NULL,
  `forma` varchar(255) NOT NULL,
  `forma_observacion` varchar(255) DEFAULT NULL,
  `movimientos` varchar(255) NOT NULL,
  `movimientos_observacion` varchar(255) DEFAULT NULL,
  `fuerza` varchar(255) NOT NULL,
  `fuerza_observacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_columna_lumbar`
--

INSERT INTO `exploracion_columna_lumbar` (`id`, `empleados_id`, `integridad`, `integridad_observacion`, `forma`, `forma_observacion`, `movimientos`, `movimientos_observacion`, `fuerza`, `fuerza_observacion`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_columna_vertebral`
--

CREATE TABLE `exploracion_columna_vertebral` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `escoleosis` varchar(255) NOT NULL,
  `evaluacion_escoleosis` varchar(255) DEFAULT NULL,
  `cifosis` varchar(255) NOT NULL,
  `evaluacion_cifosis` varchar(255) DEFAULT NULL,
  `lordosis` varchar(255) NOT NULL,
  `evaluacion_lordosis` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_columna_vertebral`
--

INSERT INTO `exploracion_columna_vertebral` (`id`, `empleados_id`, `escoleosis`, `evaluacion_escoleosis`, `cifosis`, `evaluacion_cifosis`, `lordosis`, `evaluacion_lordosis`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_craneo`
--

CREATE TABLE `exploracion_craneo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `forma` varchar(255) NOT NULL,
  `tamaño` varchar(255) NOT NULL,
  `pelo` varchar(255) NOT NULL,
  `cara` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_craneo`
--

INSERT INTO `exploracion_craneo` (`id`, `empleados_id`, `forma`, `tamaño`, `pelo`, `cara`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_cuello`
--

CREATE TABLE `exploracion_cuello` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `ganglios` varchar(255) NOT NULL,
  `movilidad` varchar(255) NOT NULL,
  `tiroides` varchar(255) NOT NULL,
  `pulsos` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_cuello`
--

INSERT INTO `exploracion_cuello` (`id`, `empleados_id`, `ganglios`, `movilidad`, `tiroides`, `pulsos`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_genitales`
--

CREATE TABLE `exploracion_genitales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `fimosis` varchar(255) NOT NULL,
  `varicocele` varchar(255) NOT NULL,
  `hernias` varchar(255) NOT NULL,
  `criptorquidias` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_genitales`
--

INSERT INTO `exploracion_genitales` (`id`, `empleados_id`, `fimosis`, `varicocele`, `hernias`, `criptorquidias`, `created_at`, `updated_at`) VALUES
(1, 12, 'Negativo', 'Negativo', 'Negativo', 'Negativo', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Negativo', 'Negativo', 'Negativo', 'Negativo', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_miembros_pelvicos`
--

CREATE TABLE `exploracion_miembros_pelvicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `integridad` varchar(255) NOT NULL,
  `integridad_observacion` varchar(255) DEFAULT NULL,
  `forma` varchar(255) NOT NULL,
  `forma_observacion` varchar(255) DEFAULT NULL,
  `articulaciones` varchar(255) NOT NULL,
  `articulaciones_observacion` varchar(255) DEFAULT NULL,
  `tono_muscular` varchar(255) NOT NULL,
  `tono_muscular_observacion` varchar(255) DEFAULT NULL,
  `reflejos` varchar(255) NOT NULL,
  `reflejos_observacion` varchar(255) DEFAULT NULL,
  `sensibilidad` varchar(255) NOT NULL,
  `sensibilidad_observacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_miembros_pelvicos`
--

INSERT INTO `exploracion_miembros_pelvicos` (`id`, `empleados_id`, `integridad`, `integridad_observacion`, `forma`, `forma_observacion`, `articulaciones`, `articulaciones_observacion`, `tono_muscular`, `tono_muscular_observacion`, `reflejos`, `reflejos_observacion`, `sensibilidad`, `sensibilidad_observacion`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_miembros_toracicos`
--

CREATE TABLE `exploracion_miembros_toracicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `integridad` varchar(255) NOT NULL,
  `integridad_observacion` varchar(255) DEFAULT NULL,
  `forma` varchar(255) NOT NULL,
  `forma_observacion` varchar(255) DEFAULT NULL,
  `articulaciones` varchar(255) NOT NULL,
  `articulaciones_observacion` varchar(255) DEFAULT NULL,
  `tono_muscular` varchar(255) NOT NULL,
  `tono_muscular_observacion` varchar(255) DEFAULT NULL,
  `reflejos` varchar(255) NOT NULL,
  `reflejos_observacion` varchar(255) DEFAULT NULL,
  `sensibilidad` varchar(255) NOT NULL,
  `sensibilidad_observacion` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_miembros_toracicos`
--

INSERT INTO `exploracion_miembros_toracicos` (`id`, `empleados_id`, `integridad`, `integridad_observacion`, `forma`, `forma_observacion`, `articulaciones`, `articulaciones_observacion`, `tono_muscular`, `tono_muscular_observacion`, `reflejos`, `reflejos_observacion`, `sensibilidad`, `sensibilidad_observacion`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, 'Normal', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_nariz`
--

CREATE TABLE `exploracion_nariz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `tabique` varchar(255) NOT NULL,
  `mucosas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_nariz`
--

INSERT INTO `exploracion_nariz` (`id`, `empleados_id`, `tabique`, `mucosas`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_oido`
--

CREATE TABLE `exploracion_oido` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `pabellon` varchar(255) NOT NULL,
  `cae` varchar(255) NOT NULL,
  `timpanos` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_oido`
--

INSERT INTO `exploracion_oido` (`id`, `empleados_id`, `pabellon`, `cae`, `timpanos`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_ojos`
--

CREATE TABLE `exploracion_ojos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `conjuntivas` varchar(255) NOT NULL,
  `pupilas` varchar(255) NOT NULL,
  `parpados` varchar(255) NOT NULL,
  `reflejos` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_ojos`
--

INSERT INTO `exploracion_ojos` (`id`, `empleados_id`, `conjuntivas`, `pupilas`, `parpados`, `reflejos`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_piel_anexos`
--

CREATE TABLE `exploracion_piel_anexos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `nevos` varchar(255) NOT NULL,
  `cicatrices` varchar(255) NOT NULL,
  `varices` varchar(255) NOT NULL,
  `edemas` varchar(255) NOT NULL,
  `micosis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_piel_anexos`
--

INSERT INTO `exploracion_piel_anexos` (`id`, `empleados_id`, `nevos`, `cicatrices`, `varices`, `edemas`, `micosis`, `created_at`, `updated_at`) VALUES
(1, 12, 'Negativo', 'Negativo', 'Negativo', 'Negativo', 'Negativo', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Negativo', 'Negativo', 'Negativo', 'Negativo', 'Negativo', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `exploracion_torax`
--

CREATE TABLE `exploracion_torax` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `forma` varchar(255) NOT NULL,
  `ritmos_Cardiacos` varchar(255) NOT NULL,
  `campos_pulm` varchar(255) NOT NULL,
  `mamas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exploracion_torax`
--

INSERT INTO `exploracion_torax` (`id`, `empleados_id`, `forma`, `ritmos_Cardiacos`, `campos_pulm`, `mamas`, `created_at`, `updated_at`) VALUES
(1, 12, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'Normal', 'Normal', 'Normal', 'Normal', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formulario_accidentes`
--

CREATE TABLE `formulario_accidentes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evento` varchar(255) DEFAULT NULL,
  `imss` enum('trayecto','interno','trabajo') DEFAULT NULL,
  `puesto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `propiedad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departamento_evento` varchar(255) DEFAULT NULL,
  `fecha_evento` date DEFAULT NULL,
  `hora_evento` time DEFAULT NULL,
  `fecha_reporte` date DEFAULT NULL,
  `numero_caso` varchar(255) DEFAULT NULL,
  `nombre_lesionado` varchar(255) DEFAULT NULL,
  `numero_lesionado` varchar(255) DEFAULT NULL,
  `edad_lesionado` int(11) DEFAULT NULL,
  `genero_lesionado` varchar(255) DEFAULT NULL,
  `turno_lesionado` varchar(255) DEFAULT NULL,
  `telefono_lesionado` varchar(255) DEFAULT NULL,
  `puesto_actual` varchar(255) DEFAULT NULL,
  `antiguedad_empresa` varchar(255) DEFAULT NULL,
  `antiguedad_puesto` varchar(255) DEFAULT NULL,
  `tiempo_funcion` varchar(255) DEFAULT NULL,
  `direccion_particular` varchar(255) DEFAULT NULL,
  `actividad_accidente` varchar(255) DEFAULT NULL,
  `auxilios` varchar(255) DEFAULT NULL,
  `prescripcion` varchar(255) DEFAULT NULL,
  `incapacidad` varchar(255) DEFAULT NULL,
  `atencion` varchar(255) DEFAULT NULL,
  `retiro` varchar(255) DEFAULT NULL,
  `registrable` varchar(255) DEFAULT NULL,
  `laboratorio` varchar(255) DEFAULT NULL,
  `vendaje` varchar(255) DEFAULT NULL,
  `restriccion` varchar(255) DEFAULT NULL,
  `tipo_incapacidad` text DEFAULT NULL,
  `especificar_atencion` text DEFAULT NULL,
  `lesion` varchar(255) DEFAULT NULL,
  `dias_incapacidad` int(11) DEFAULT NULL,
  `cabeza` tinyint(1) DEFAULT NULL,
  `ojo` tinyint(1) DEFAULT NULL,
  `oido` tinyint(1) DEFAULT NULL,
  `brazo` tinyint(1) DEFAULT NULL,
  `mano` tinyint(1) DEFAULT NULL,
  `espalda` tinyint(1) DEFAULT NULL,
  `dedos` tinyint(1) DEFAULT NULL,
  `pierna` tinyint(1) DEFAULT NULL,
  `cara` tinyint(1) DEFAULT NULL,
  `torso` tinyint(1) DEFAULT NULL,
  `otra_parte` text DEFAULT NULL,
  `accidente` varchar(255) DEFAULT NULL,
  `agente_accidente` varchar(255) DEFAULT NULL,
  `requiere_epp` varchar(255) DEFAULT NULL,
  `usaba_epp` varchar(255) DEFAULT NULL,
  `proporcion_epp` varchar(255) DEFAULT NULL,
  `anfitrion_trabajando` varchar(255) DEFAULT NULL,
  `capacitacion_puesto` varchar(255) DEFAULT NULL,
  `conocimiento_puesto` varchar(255) DEFAULT NULL,
  `postura_anfitrion` varchar(255) DEFAULT NULL,
  `supervision` varchar(255) DEFAULT NULL,
  `accidentes_previos` varchar(255) DEFAULT NULL,
  `descripcion_dano` text DEFAULT NULL,
  `parte_afectada` text DEFAULT NULL,
  `costo_estimado` varchar(255) DEFAULT NULL,
  `costo_real` varchar(255) DEFAULT NULL,
  `descripcion_accidente` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `descripcion_escena` text DEFAULT NULL,
  `area_trabajo` text DEFAULT NULL,
  `equipos_usados` text DEFAULT NULL,
  `objetos_encontrados` text DEFAULT NULL,
  `causa` varchar(255) DEFAULT NULL,
  `acto_inseguro` varchar(255) DEFAULT NULL,
  `condiciones_inseguras` varchar(255) DEFAULT NULL,
  `ambas` varchar(255) DEFAULT NULL,
  `incapacidad_temporal` tinyint(1) DEFAULT NULL,
  `incapacidad_parcial` tinyint(1) DEFAULT NULL,
  `incapacidad_muerte` tinyint(1) DEFAULT NULL,
  `sin_incapacidad` tinyint(1) DEFAULT NULL,
  `no_especificada` tinyint(1) DEFAULT NULL,
  `recomendaciones` text DEFAULT NULL,
  `responsable_recomendacion` varchar(255) DEFAULT NULL,
  `fecha_recomendacion` date DEFAULT NULL,
  `aval_anfitrion` varchar(255) DEFAULT NULL,
  `aval_supervisor` varchar(255) DEFAULT NULL,
  `aval_patron` varchar(255) DEFAULT NULL,
  `aval_trabajadores` varchar(255) DEFAULT NULL,
  `signaturePadAnfitrion_data` text DEFAULT NULL,
  `signaturePadSupervisor_data` text DEFAULT NULL,
  `signaturePadPatron_data` text DEFAULT NULL,
  `signaturePadTrabajador_data` text DEFAULT NULL,
  `memoria_fotografica` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formulario_accidentes`
--

INSERT INTO `formulario_accidentes` (`id`, `evento`, `imss`, `puesto_id`, `propiedad_id`, `departamento_evento`, `fecha_evento`, `hora_evento`, `fecha_reporte`, `numero_caso`, `nombre_lesionado`, `numero_lesionado`, `edad_lesionado`, `genero_lesionado`, `turno_lesionado`, `telefono_lesionado`, `puesto_actual`, `antiguedad_empresa`, `antiguedad_puesto`, `tiempo_funcion`, `direccion_particular`, `actividad_accidente`, `auxilios`, `prescripcion`, `incapacidad`, `atencion`, `retiro`, `registrable`, `laboratorio`, `vendaje`, `restriccion`, `tipo_incapacidad`, `especificar_atencion`, `lesion`, `dias_incapacidad`, `cabeza`, `ojo`, `oido`, `brazo`, `mano`, `espalda`, `dedos`, `pierna`, `cara`, `torso`, `otra_parte`, `accidente`, `agente_accidente`, `requiere_epp`, `usaba_epp`, `proporcion_epp`, `anfitrion_trabajando`, `capacitacion_puesto`, `conocimiento_puesto`, `postura_anfitrion`, `supervision`, `accidentes_previos`, `descripcion_dano`, `parte_afectada`, `costo_estimado`, `costo_real`, `descripcion_accidente`, `observaciones`, `descripcion_escena`, `area_trabajo`, `equipos_usados`, `objetos_encontrados`, `causa`, `acto_inseguro`, `condiciones_inseguras`, `ambas`, `incapacidad_temporal`, `incapacidad_parcial`, `incapacidad_muerte`, `sin_incapacidad`, `no_especificada`, `recomendaciones`, `responsable_recomendacion`, `fecha_recomendacion`, `aval_anfitrion`, `aval_supervisor`, `aval_patron`, `aval_trabajadores`, `signaturePadAnfitrion_data`, `signaturePadSupervisor_data`, `signaturePadPatron_data`, `signaturePadTrabajador_data`, `memoria_fotografica`, `created_at`, `updated_at`) VALUES
(1, 'Accidente', 'trayecto', 1, 1, 'Cocina', '2025-01-10', '08:30:00', '2025-01-11', 'CASE-2025-001', 'Ana López', 'EMP-1001', 29, 'Femenino', 'Diurno', '555100001', 'Cocinero', '3 años', '2 años', '1 año', 'Calle 1 #100', 'Corte con cuchillo', 'Ambulancia interna', 'Reposo 2 días', 'Sí', 'Clínica', 'No', 'Sí', 'No', 'Sí', 'Manejo de cuchillos', 'Temporal', 'Vendaje y antiséptico', 'Corte mano derecha', 2, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, '', 'Corte mecánico', 'Cuchillo', 'Sí', 'No', 'Guantes', 'Sí', 'Sí', 'Alto', 'Correcta', 'Adecuada', 'No', 'Corte superficial', 'Mano derecha', '200.00', '150.00', 'Ana se cortó al picar verduras.', 'Superficie mojada', 'Piso resbaladizo', 'Cocina Principal', 'Cuchillo de chef', 'Trozo de verdura', 'Acto inseguro', 'Sin guantes', 'Piso mojado', 'Sí', 0, 0, 0, 0, 0, 'Uso obligatorio de guantes antideslizantes', 'Jefe de Cocina', '2025-01-12', 'Ana López', 'Carlos Ruiz', 'Hotel X', 'Equipo Cocina', '', '', '', '', 'foto1.jpg', '2025-01-10 06:00:00', '2025-01-10 06:00:00'),
(2, 'Incidente', 'interno', 2, 2, 'Cocina', '2025-02-05', '14:00:00', '2025-02-06', 'CASE-2025-002', 'Miguel Torres', 'EMP-1002', 40, 'Masculino', 'Vespertino', '555100002', 'Ama de Llaves', '5 años', '3 años', '2 años', 'Av 2 #200', 'Caída', 'Paramédicos externos', 'Reposo 3 días', 'Sí', 'Hospital', 'Sí', 'Sí', 'No', 'No', 'N/A', 'Temporal', 'Analgésicos', 'Esguince tobillo', 3, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, '', 'Caída nivel mismo piso', 'Piso mojado', 'No', 'No', '', 'Sí', 'No', 'Medio', 'Incorrecta', 'Inadecuada', 'Sí', 'Esguince leve en tobillo', 'Tobillo izquierdo', '300.00', '250.00', 'Miguel resbaló en el pasillo.', 'Señalización de piso húmedo', 'Pasillo de habitación 101', 'Housekeeping', 'Mopa', 'Recipiente de agua', 'Condiciones inseguras', 'No esperar secado', 'Piso mojado', 'Sí', 0, 0, 0, 0, 0, 'Colocar señalización de piso húmedo', 'Supervisor Housekeeping', '2025-02-07', 'Miguel Torres', 'Laura Sánchez', 'Hotel Y', 'Equipo Housekeeping', '', '', '', '', 'foto2.jpg', '2025-02-05 06:00:00', '2025-07-30 00:37:12'),
(3, 'Accidente', 'trayecto', 3, 1, 'Mantenimiento', '2025-03-20', '09:15:00', '2025-03-21', 'CASE-2025-003', 'Luis Martínez', 'EMP-1003', 30, 'Masculino', 'Diurno', '555100003', 'Técnico Mantenimiento', '4 años', '1 año', '8 meses', 'Calle 3 #300', 'Mantenimiento preventivo', 'Primeros auxilios internos', 'Ninguna', 'No', 'Enfermería interna', 'No', 'No', 'No', 'No', 'No', 'Temporal', 'Analgésico', 'Golpe mecánico', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'Esguince', 'Herramienta', 'Sí', 'Sí', 'Casco', 'Sí', 'Sí', 'Alto', 'Correcta', 'Adecuada', 'No', 'Moretón en cabeza', 'Cabeza', '0.00', '0.00', 'Golpe con herramienta.', 'Usar casco correctamente', 'Sala de máquinas', 'Mantenimiento', 'Llave inglesa', 'Tornillo suelto', 'Acto inseguro', 'Sin asegurar herramienta', 'Espacio reducido', 'Sí', 0, 0, 0, 0, 0, 'Revisar herramientas antes de uso', 'Jefe Mantenimiento', '2025-03-22', 'Luis Martínez', 'Ana Gómez', 'Empresa X', 'Equipo Mantenimiento', '', '', '', '', 'foto3.jpg', '2025-03-20 06:00:00', '2025-03-20 06:00:00'),
(4, 'Incidente', 'trabajo', 4, 3, 'Recepción', '2025-04-12', '11:00:00', '2025-04-13', 'CASE-2025-004', 'Sofía Pérez', 'EMP-1004', 26, 'Femenino', 'Matutino', '555100004', 'Recepcionista', '2 años', '2 años', '2 años', 'Av 4 #400', 'Atención al cliente', 'Ninguno', 'Ninguna', 'No', 'Enfermería interna', 'No', 'No', 'No', 'No', 'No', 'Temporal', 'Ninguna', 'Sin lesiones', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 'Resbalón', 'Piso liso', 'No', 'No', '', 'No', 'No', 'Bajo', 'Correcta', 'Adecuada', 'Sí', 'Caída sin lesión', '', '0.00', '0.00', 'Resbalón al caminar.', 'Limpiar área', 'Vestíbulo', 'Recepción', 'N/A', 'N/A', 'Condición insegura', 'Sin calzado adecuado', 'Sin señalizar', 'No', 0, 0, 0, 0, 0, 'Colocar tapetes antideslizantes', 'Gerente Recepción', '2025-04-14', 'Sofía Pérez', 'Carlos Medina', 'Hotel Z', 'Equipo Recepción', '', '', '', '', 'foto4.jpg', '2025-04-12 06:00:00', '2025-04-12 06:00:00'),
(5, 'Accidente', 'trabajo', 5, 2, 'Mantenimiento', '2025-05-18', '22:45:00', '2025-05-19', 'CASE-2025-005', 'Pedro Gómez', 'EMP-1005', 33, 'Masculino', 'Nocturno', '555100005', 'Bartender', '1 año', '1 año', '6 meses', 'Calle 5 #500', 'Servir bebidas', 'Paramédicos externos', 'Reposo 1 día', 'Sí', 'Hospital', 'Sí', 'Sí', 'No', 'No', 'No', 'Temporal', 'Analgésico', 'Esguince muñeca', 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, '', 'Caída silla', 'Silla rota', 'No', 'No', '', 'No', 'No', 'Medio', 'Incorrecta', 'Adecuada', 'No', 'Dolor leve', 'Muñeca', '150.00', '120.00', 'Se cayó de la silla.', 'Revisar mobiliario', 'Bar', 'Bar', 'Silla', 'Silla inestable', 'Fallo equipo', 'Sentarse sin verificar', 'Superficie lisa', 'No', 0, 0, 0, 0, 0, 'Verificar sillas', 'Encargado Bar', '2025-05-20', 'Pedro Gómez', 'Laura Torres', 'Hotel Y', 'Equipo Bar', '', '', '', '', 'foto5.jpg', '2025-05-18 06:00:00', '2025-07-30 00:36:59'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-17 00:22:01', '2025-08-17 00:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `historial_clinico`
--

CREATE TABLE `historial_clinico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evento` varchar(255) DEFAULT NULL,
  `propiedad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departamento_evento` bigint(20) UNSIGNED DEFAULT NULL,
  `puesto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_reporte` date DEFAULT NULL,
  `numero_caso` varchar(255) DEFAULT NULL,
  `nombre_lesionado` varchar(255) DEFAULT NULL,
  `numero_lesionado` varchar(255) DEFAULT NULL,
  `edad_lesionado` int(11) DEFAULT NULL,
  `genero_lesionado` varchar(255) DEFAULT NULL,
  `turno_lesionado` varchar(255) DEFAULT NULL,
  `telefono_lesionado` varchar(255) DEFAULT NULL,
  `puesto_actual` varchar(255) DEFAULT NULL,
  `antiguedad_empresa` varchar(255) DEFAULT NULL,
  `antiguedad_puesto` varchar(255) DEFAULT NULL,
  `tiempo_funcion` varchar(255) DEFAULT NULL,
  `direccion_particular` varchar(255) DEFAULT NULL,
  `actividad_accidente` text DEFAULT NULL,
  `otra_parte` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historial_clinico`
--

INSERT INTO `historial_clinico` (`id`, `evento`, `propiedad_id`, `departamento_evento`, `puesto_id`, `fecha_reporte`, `numero_caso`, `nombre_lesionado`, `numero_lesionado`, `edad_lesionado`, `genero_lesionado`, `turno_lesionado`, `telefono_lesionado`, `puesto_actual`, `antiguedad_empresa`, `antiguedad_puesto`, `tiempo_funcion`, `direccion_particular`, `actividad_accidente`, `otra_parte`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 8, 13, '2025-07-31', 'Princess0001', 'ds', 'fd', 27, 'Masculino', 'dmatutino', '7414546464', 'cdads', '2', '2', '23', 'cda', 'dsd', 'gdfgdfg', '2025-07-13 10:20:02', '2025-07-13 10:20:02'),
(2, NULL, 1, 8, 13, '2025-07-31', 'Princess0001', 'ds', 'fd', 27, 'Masculino', 'dmatutino', '7414546464', 'cdads', '2', '2', '23', 'cda', 'dsd', 'gdfgdfg', '2025-07-13 10:22:33', '2025-07-13 10:22:33'),
(3, NULL, 1, 8, 13, '2025-07-31', 'Princess0001', 'ds', 'fd', 27, 'Masculino', 'dmatutino', '7414546464', 'cdads', '2', '2', '23', 'cda', 'dsd', 'gdfgdfg', '2025-07-13 10:22:37', '2025-07-13 10:22:37'),
(4, NULL, 5, 6, 9, '2025-07-14', 'Princess0001', 'ds', 'fd', 27, 'Femenino', 'dmatutino', '7414546464', 'cdads', '2', '2', '23', 'cda', 'dsd', 'fdghdfghfh', '2025-07-15 01:43:24', '2025-07-15 01:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `historial_laboral`
--

CREATE TABLE `historial_laboral` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `edad_inicio_labores` int(11) DEFAULT NULL,
  `empresas_laborado` text DEFAULT NULL,
  `puestos_ocupados` text DEFAULT NULL,
  `tiempo_laborado` text DEFAULT NULL,
  `agentes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historial_laboral`
--

INSERT INTO `historial_laboral` (`id`, `empleados_id`, `edad_inicio_labores`, `empresas_laborado`, `puestos_ocupados`, `tiempo_laborado`, `agentes`, `created_at`, `updated_at`) VALUES
(1, 1, 22, 'Mundo Imperial', 'Auxiliar de Calidad', '2 años', 'Químicos', '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 2, 23, 'Mundo Imperial', 'Auxiliar de Calidad', '1 año', 'Químicos', '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 3, 23, 'Mundo Imperial', 'Auxiliar de Calidad', '1 año', 'Químicos', '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 4, 23, 'Mundo Imperial', 'Auxiliar de Calidad', '1 año', 'Químicos', '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 5, 23, 'Mundo Imperial', 'Auxiliar de Calidad', '1 año', 'Químicos', '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 6, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 7, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 8, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 9, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 10, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 11, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 12, 21, 'Mundo Imperialism', 'Coordinadora', '1 año', 'Químicos', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 13, 34, 'Mundo Imperial', 'Recepciòn', '1 mes', 'Químicos', '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `incapacidad_por_enfermedad`
--

CREATE TABLE `incapacidad_por_enfermedad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `enfermedad` varchar(255) NOT NULL,
  `enfermedad_evaluacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incapacidad_por_enfermedad`
--

INSERT INTO `incapacidad_por_enfermedad` (`id`, `empleados_id`, `enfermedad`, `enfermedad_evaluacion`, `created_at`, `updated_at`) VALUES
(1, 1, 'No', NULL, '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 2, 'No', NULL, '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 3, 'No', NULL, '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 4, 'No', NULL, '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 5, 'No', NULL, '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 6, 'No', NULL, '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 7, 'No', NULL, '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 8, 'No', NULL, '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 9, 'No', NULL, '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 10, 'No', NULL, '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 11, 'No', NULL, '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 12, 'No', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 13, 'No', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `incapacidad_por_trabajo`
--

CREATE TABLE `incapacidad_por_trabajo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `riesgo` varchar(255) NOT NULL,
  `riesgo_evaluacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incapacidad_por_trabajo`
--

INSERT INTO `incapacidad_por_trabajo` (`id`, `empleados_id`, `riesgo`, `riesgo_evaluacion`, `created_at`, `updated_at`) VALUES
(1, 1, 'No', NULL, '2025-06-07 06:05:47', '2025-06-07 06:05:47'),
(2, 2, 'No', NULL, '2025-06-11 22:02:34', '2025-06-11 22:02:34'),
(3, 3, 'No', NULL, '2025-06-11 22:11:31', '2025-06-11 22:11:31'),
(4, 4, 'No', NULL, '2025-06-11 22:13:44', '2025-06-11 22:13:44'),
(5, 5, 'No', NULL, '2025-06-11 22:15:27', '2025-06-11 22:15:27'),
(6, 6, 'No', NULL, '2025-06-11 22:23:40', '2025-06-11 22:23:40'),
(7, 7, 'No', NULL, '2025-06-11 22:28:07', '2025-06-11 22:28:07'),
(8, 8, 'No', NULL, '2025-06-11 22:28:57', '2025-06-11 22:28:57'),
(9, 9, 'No', NULL, '2025-06-11 22:29:53', '2025-06-11 22:29:53'),
(10, 10, 'No', NULL, '2025-06-11 22:34:17', '2025-06-11 22:34:17'),
(11, 11, 'No', NULL, '2025-06-11 22:35:14', '2025-06-11 22:35:14'),
(12, 12, 'No', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(13, 13, 'No', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

CREATE TABLE `indicators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subprocess_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lesiones`
--

CREATE TABLE `lesiones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesiones`
--

INSERT INTO `lesiones` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(6, 'antonioll', '2025-08-05 06:20:22', '2025-08-05 06:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `llegadas`
--

CREATE TABLE `llegadas` (
  `Cve_Reserv` varchar(25) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `C` varchar(25) DEFAULT NULL,
  `Tpo` varchar(25) DEFAULT NULL,
  `G` varchar(25) DEFAULT NULL,
  `Seg` varchar(25) DEFAULT NULL,
  `THab` varchar(25) DEFAULT NULL,
  `Hb` tinyint(4) DEFAULT NULL,
  `P` varchar(6) DEFAULT NULL,
  `NHab` int(11) DEFAULT NULL,
  `Plan` varchar(255) DEFAULT NULL,
  `TP` varchar(15) DEFAULT NULL,
  `In` varchar(25) DEFAULT NULL,
  `Valor_A` tinyint(4) DEFAULT NULL,
  `Valor_N` tinyint(4) DEFAULT NULL,
  `Valor_J` tinyint(4) DEFAULT NULL,
  `Valor_MG` tinyint(4) DEFAULT NULL,
  `Valor_I` tinyint(4) DEFAULT NULL,
  `FechaSal` date DEFAULT NULL,
  `Noc` tinyint(4) DEFAULT NULL,
  `Edo` varchar(25) DEFAULT NULL,
  `FPgo` varchar(6) DEFAULT NULL,
  `Tarifa` decimal(10,2) DEFAULT NULL,
  `Agencia` varchar(50) DEFAULT NULL,
  `Grupo` varchar(255) DEFAULT NULL,
  `Compania` varchar(255) DEFAULT NULL,
  `MensajesRecepcion` varchar(255) DEFAULT NULL,
  `Cod_Reserva` varchar(10) DEFAULT NULL,
  `PreCheckInWeb` varchar(25) DEFAULT NULL,
  `FechaLlegada` date DEFAULT NULL,
  `Mail` varchar(255) DEFAULT NULL,
  `Calle_Colonia` varchar(255) DEFAULT NULL,
  `Municipio_Ciudad` varchar(25) DEFAULT NULL,
  `Estado` varchar(25) DEFAULT NULL,
  `CP` char(5) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Brasalete` varchar(25) DEFAULT NULL,
  `LateCheckOut` varchar(3) DEFAULT NULL,
  `Pax` double DEFAULT NULL,
  `CreditoInicial` decimal(10,2) DEFAULT NULL,
  `CreditoDisponible` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `llegadas`
--

INSERT INTO `llegadas` (`Cve_Reserv`, `Nombre`, `C`, `Tpo`, `G`, `Seg`, `THab`, `Hb`, `P`, `NHab`, `Plan`, `TP`, `In`, `Valor_A`, `Valor_N`, `Valor_J`, `Valor_MG`, `Valor_I`, `FechaSal`, `Noc`, `Edo`, `FPgo`, `Tarifa`, `Agencia`, `Grupo`, `Compania`, `MensajesRecepcion`, `Cod_Reserva`, `PreCheckInWeb`, `FechaLlegada`, `Mail`, `Calle_Colonia`, `Municipio_Ciudad`, `Estado`, `CP`, `Telefono`, `Brasalete`, `LateCheckOut`, `Pax`, `CreditoInicial`, `CreditoDisponible`) VALUES
('2', 'Juan', 'kcal', 'DRE', 'BAR', 'True', 'TKUA', 120, 'True', 1100, 'dcvscd', 'NO', 'dcscd', 1, 12, 12, 2, 2, '2025-06-11', 127, 'dfsfs', 'AX', 400000.00, 'PAGINA WEB', 'Nestle', 'ACA FUN VIAJES', 'dfsfs', 'fsfsd', NULL, '2025-06-04', 'juan@gmail.com', 'sdmkakdm', 'ssdv', 'cscd', '212', '342342', 'BLANCO MENORES', 'Si', 23, 90000.00, 434.00);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_02_221242_add_rfc_to_users_table', 2),
(5, '2025_02_03_220915_add_timestamps_to_archivos_table', 3),
(6, '2025_02_18_174826_create_carpetas_table', 4),
(7, '2025_02_18_175207_foraneaidcarpeta', 5),
(8, '2025_02_25_160856_add_parent_id_to_carpetas_table', 6),
(9, '2025_03_04_204806_create_procesos_table', 7),
(10, '2025_03_05_034037_add_proceso_id_to_archivos_table', 8),
(11, '2025_05_14_163634_add_acceso_documentacionmi_to_privilegios', 9),
(12, '2025_05_13_073716_create_module_residuos_tables', 10),
(13, '2025_05_25_184601_create_planes_table', 11),
(14, '2025_05_25_184637_create_acciones_table', 12),
(15, '2025_05_25_184651_create_reprogramados_table', 13),
(16, '2025_04_24_165856_create_bsc_tables', 14),
(17, '2025_04_24_165936_create_control_energeticos_tables', 15),
(18, '2025_04_24_170014_create_historial_clinico_tables', 16),
(19, '2025_06_04_171409_add_columns_to_archivos_table', 17),
(20, '2025_06_04_193443_add_columns_to_procesos_table', 18),
(21, '2025_04_19_154608_create_bcp_tables', 19),
(22, '2025_06_03_225528_create_admin_centros_consumo_table', 20),
(23, '2025_06_04_023149_create_centrosdeconsumo_table', 21),
(24, '2025_06_04_023153_create_centrosdeconsumo_respaldo_table', 22),
(25, '2025_04_23_190137_create_cafeteria_kali_tables', 23),
(26, '2025_04_24_165918_create_control_documental_tables', 23),
(27, '2025_04_24_165953_create_control_plan_tables', 23),
(28, '2025_04_24_170032_create_reservacion_eventos_tables', 23),
(29, '2025_04_24_170044_create_residuos_tables', 23),
(30, '2025_04_24_170101_create_revenue_reports_tables', 23),
(31, '2025_07_02_213906_create_accidentes_table', 23),
(32, '2025_07_02_214005_create_causas_table', 23),
(33, '2025_07_03_000608_create_lesiones_table', 23),
(34, '2025_07_05_014400_create_sessions_table', 24),
(37, '2025_07_08_203334_create_formulario_accidentes_table', 25),
(38, '2025_07_10_204602_add_propiedad_id_to_departamentos_table', 25),
(40, '2025_07_10_211050_remove_propiedad_from_departamentos_table', 26),
(41, '2025_07_13_032021_create_partes_afectadas_table', 27),
(42, '2025_07_13_041910_create_historial_clinico_table', 28),
(43, '2025_07_13_042045_create_partes_afectadas_table', 29),
(44, '2025_07_14_193409_add_evento_to_historial_clinico_table', 30),
(45, '2025_07_17_234500_remove_responsables_from_procesos_table', 31),
(46, '2025_07_18_000315_create_responsables_table', 32),
(47, '2025_07_19_002335_add_proceso_id_to_departamentos_table', 33),
(48, '2025_07_19_183034_add_proceso_id_to_puestos_table', 34),
(50, '2025_07_30_004348_add_imss_to_formulario_accidentes_table', 35),
(51, '2025_08_02_201027_add_relations_to_puestos_table', 36);

-- --------------------------------------------------------

--
-- Table structure for table `observaciones`
--

CREATE TABLE `observaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosticos` text DEFAULT NULL,
  `recomendaciones` text DEFAULT NULL,
  `evaluacion_satisfactoria` varchar(255) NOT NULL,
  `fecha_formulario` date NOT NULL,
  `firma_formulario` varchar(255) DEFAULT NULL,
  `salud_ocupacional` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `observaciones`
--

INSERT INTO `observaciones` (`id`, `empleados_id`, `diagnosticos`, `recomendaciones`, `evaluacion_satisfactoria`, `fecha_formulario`, `firma_formulario`, `salud_ocupacional`, `created_at`, `updated_at`) VALUES
(1, 12, 'bueno', 'nada', 'Si', '2025-06-11', 'firma_medico_1749660499.png', 'Buena', '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'bueno', 'bueno', 'Si', '2025-06-11', 'firma_medico_1749661450.png', 'bien', '2025-06-11 23:04:10', '2025-06-11 23:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `padece_alguna_enfermedad`
--

CREATE TABLE `padece_alguna_enfermedad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleados_id` bigint(20) UNSIGNED NOT NULL,
  `padece_enfermedad` varchar(255) NOT NULL,
  `especifique_enfermedad` varchar(255) DEFAULT NULL,
  `mano_dominante` varchar(255) NOT NULL,
  `firma` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `padece_alguna_enfermedad`
--

INSERT INTO `padece_alguna_enfermedad` (`id`, `empleados_id`, `padece_enfermedad`, `especifique_enfermedad`, `mano_dominante`, `firma`, `created_at`, `updated_at`) VALUES
(1, 12, 'No', NULL, 'Derecha', NULL, '2025-06-11 22:48:19', '2025-06-11 22:48:19'),
(2, 13, 'No', NULL, 'Derecha', NULL, '2025-06-11 23:04:10', '2025-06-11 23:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `partes_afectadas`
--

CREATE TABLE `partes_afectadas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `historial_id` bigint(20) UNSIGNED NOT NULL,
  `parte_cuerpo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partes_afectadas`
--

INSERT INTO `partes_afectadas` (`id`, `historial_id`, `parte_cuerpo`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ojo Derecho', '2025-07-13 10:22:33', '2025-07-13 10:22:33'),
(2, 2, 'Hipogastrio', '2025-07-13 10:22:33', '2025-07-13 10:22:33'),
(3, 3, 'Ojo Derecho', '2025-07-13 10:22:37', '2025-07-13 10:22:37'),
(4, 3, 'Hipogastrio', '2025-07-13 10:22:37', '2025-07-13 10:22:37'),
(5, 4, 'Clavícula Der', '2025-07-15 01:43:24', '2025-07-15 01:43:24'),
(6, 4, 'Mesogastrio', '2025-07-15 01:43:24', '2025-07-15 01:43:24'),
(7, 4, 'Hombro IZQ', '2025-07-15 01:43:24', '2025-07-15 01:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poblaciones`
--

CREATE TABLE `poblaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inicio` date NOT NULL,
  `anio` smallint(6) NOT NULL,
  `mes` tinyint(4) NOT NULL,
  `fecha_fin` date NOT NULL,
  `huespedes` int(11) NOT NULL,
  `anfitriones` int(11) NOT NULL,
  `visitantes` int(11) NOT NULL,
  `probedores` int(11) NOT NULL,
  `pax` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poblaciones`
--

INSERT INTO `poblaciones` (`id`, `fecha_inicio`, `anio`, `mes`, `fecha_fin`, `huespedes`, `anfitriones`, `visitantes`, `probedores`, `pax`, `created_at`, `updated_at`) VALUES
(1, '2025-06-01', 2025, 6, '2025-06-30', 300, 700, 40, 34, 1074, '2025-06-05 04:53:28', '2025-06-05 04:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `privilegios`
--

CREATE TABLE `privilegios` (
  `id_privilegio` int(11) NOT NULL,
  `acceso_calidad` tinyint(1) NOT NULL,
  `acceso_seguridadambiental` tinyint(1) NOT NULL,
  `acceso_seguridadysalud` tinyint(1) NOT NULL,
  `acceso_seguridadinformacion` tinyint(1) NOT NULL,
  `acceso_seguridadalimentaria` tinyint(1) NOT NULL,
  `acceso_contextoorg` tinyint(1) NOT NULL,
  `acceso_liderazgo` tinyint(1) NOT NULL,
  `acceso_planificacion` tinyint(1) NOT NULL,
  `acceso_apoyo` tinyint(1) NOT NULL,
  `acceso_documentacionmi` tinyint(1) NOT NULL DEFAULT 0,
  `acceso_mireservaciondeeventos` tinyint(1) NOT NULL,
  `acceso_controldocumental` tinyint(1) NOT NULL,
  `acceso_documentaciondelaoperacion` tinyint(1) NOT NULL,
  `acceso_procesosoperativos` tinyint(1) NOT NULL,
  `acceso_procesosdeapoyo` tinyint(1) NOT NULL,
  `acceso_evaldesempeño` tinyint(1) NOT NULL,
  `acceso_revenuereports` tinyint(1) NOT NULL,
  `acceso_balancescorecard` tinyint(1) NOT NULL,
  `acceso_mejora` tinyint(1) NOT NULL,
  `acceso_controlplanesdeaccion` tinyint(1) NOT NULL,
  `acceso_residuos` tinyint(1) NOT NULL,
  `acceso_controlderesiduos` tinyint(1) NOT NULL,
  `acceso_reportederesiduos` tinyint(1) NOT NULL,
  `acceso_energia` tinyint(1) NOT NULL,
  `acceso_controldeenergia` tinyint(1) NOT NULL,
  `acceso_informaciondeenergia` tinyint(1) NOT NULL,
  `acceso_agua` tinyint(1) NOT NULL,
  `acceso_controldeagua` tinyint(1) NOT NULL,
  `acceso_informaciondeagua` tinyint(1) NOT NULL,
  `acceso_aire` tinyint(1) NOT NULL,
  `acceso_controldeaire` tinyint(1) NOT NULL,
  `acceso_informaciondeaire` tinyint(1) NOT NULL,
  `acceso_comunidad` tinyint(1) NOT NULL,
  `acceso_ruido` tinyint(1) NOT NULL,
  `acceso_suelo` tinyint(1) NOT NULL,
  `acceso_recursosnaturales` tinyint(1) NOT NULL,
  `acceso_reportecontroldeenergeticos` tinyint(1) NOT NULL,
  `acceso_gestion` tinyint(1) NOT NULL,
  `acceso_atencionaemergencias` tinyint(1) NOT NULL,
  `acceso_higiene` tinyint(1) NOT NULL,
  `acceso_identificacionycontrolderiesgos` tinyint(1) NOT NULL,
  `acceso_prevencionentrabajospeligrosos` tinyint(1) NOT NULL,
  `acceso_perservaciondelasalud` tinyint(1) NOT NULL,
  `acceso_historialclinico` tinyint(1) NOT NULL,
  `acceso_drp` tinyint(1) NOT NULL,
  `acceso_controles` tinyint(1) NOT NULL,
  `acceso_riesgotecnologico` tinyint(1) NOT NULL,
  `acceso_mantenimiento` tinyint(1) NOT NULL,
  `acceso_bcp` tinyint(1) NOT NULL,
  `acceso_circulares` tinyint(1) NOT NULL,
  `acceso_cadenaalimentaria` tinyint(1) NOT NULL,
  `acceso_riesgosalimentarios` tinyint(1) NOT NULL,
  `acceso_manipulaciondealimentos` tinyint(1) NOT NULL,
  `acceso_medicion` tinyint(1) NOT NULL,
  `acceso_cafeteriadeanfitriones` tinyint(1) NOT NULL,
  `acceso_inocuidad` tinyint(1) NOT NULL,
  `acceso_administrarusuarios` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `acceso_accidentes_enfermedades` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privilegios`
--

INSERT INTO `privilegios` (`id_privilegio`, `acceso_calidad`, `acceso_seguridadambiental`, `acceso_seguridadysalud`, `acceso_seguridadinformacion`, `acceso_seguridadalimentaria`, `acceso_contextoorg`, `acceso_liderazgo`, `acceso_planificacion`, `acceso_apoyo`, `acceso_documentacionmi`, `acceso_mireservaciondeeventos`, `acceso_controldocumental`, `acceso_documentaciondelaoperacion`, `acceso_procesosoperativos`, `acceso_procesosdeapoyo`, `acceso_evaldesempeño`, `acceso_revenuereports`, `acceso_balancescorecard`, `acceso_mejora`, `acceso_controlplanesdeaccion`, `acceso_residuos`, `acceso_controlderesiduos`, `acceso_reportederesiduos`, `acceso_energia`, `acceso_controldeenergia`, `acceso_informaciondeenergia`, `acceso_agua`, `acceso_controldeagua`, `acceso_informaciondeagua`, `acceso_aire`, `acceso_controldeaire`, `acceso_informaciondeaire`, `acceso_comunidad`, `acceso_ruido`, `acceso_suelo`, `acceso_recursosnaturales`, `acceso_reportecontroldeenergeticos`, `acceso_gestion`, `acceso_atencionaemergencias`, `acceso_higiene`, `acceso_identificacionycontrolderiesgos`, `acceso_prevencionentrabajospeligrosos`, `acceso_perservaciondelasalud`, `acceso_historialclinico`, `acceso_drp`, `acceso_controles`, `acceso_riesgotecnologico`, `acceso_mantenimiento`, `acceso_bcp`, `acceso_circulares`, `acceso_cadenaalimentaria`, `acceso_riesgosalimentarios`, `acceso_manipulaciondealimentos`, `acceso_medicion`, `acceso_cafeteriadeanfitriones`, `acceso_inocuidad`, `acceso_administrarusuarios`, `user_id`, `acceso_accidentes_enfermedades`) VALUES
(19, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 38, 0),
(62, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 81, 1),
(63, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 82, 0),
(77, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 96, 0),
(78, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 97, 0),
(79, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 1, 1, 0, 98, 0),
(80, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 99, 0),
(81, 1, 0, 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 0),
(82, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 101, 0),
(83, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 102, 0),
(85, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 107, 1);

-- --------------------------------------------------------

--
-- Table structure for table `privilegios_carpetas`
--

CREATE TABLE `privilegios_carpetas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `carpeta_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `privilegios_carpetas`
--

INSERT INTO `privilegios_carpetas` (`id`, `user_id`, `carpeta_id`) VALUES
(377, 96, 71),
(378, 96, 72),
(379, 96, 73),
(380, 96, 74),
(381, 96, 78),
(382, 96, 79),
(383, 96, 80),
(455, 97, 71),
(456, 97, 72),
(457, 97, 73),
(458, 97, 74),
(459, 97, 78),
(460, 97, 79),
(461, 97, 80),
(497, 98, 71),
(498, 98, 72),
(499, 98, 73),
(500, 98, 74),
(501, 98, 78),
(502, 98, 79),
(503, 98, 80),
(504, 82, 71),
(505, 82, 72),
(506, 82, 73),
(507, 82, 74),
(508, 82, 78),
(509, 82, 79),
(510, 82, 80),
(698, 99, 71),
(699, 99, 72),
(700, 99, 73),
(701, 99, 74),
(702, 99, 78),
(703, 99, 79),
(704, 99, 80),
(705, 99, 81),
(706, 99, 82),
(707, 99, 83),
(708, 99, 84),
(709, 99, 85),
(710, 99, 86),
(711, 99, 87),
(712, 99, 88),
(713, 99, 89),
(714, 99, 90),
(715, 99, 91),
(716, 99, 93),
(717, 99, 94),
(718, 99, 95),
(719, 99, 96),
(720, 99, 97),
(721, 99, 98),
(722, 99, 99),
(723, 99, 100),
(724, 99, 101),
(725, 99, 102),
(782, 101, 71),
(783, 101, 72),
(784, 101, 73),
(785, 101, 74),
(786, 101, 78),
(787, 101, 79),
(788, 101, 80),
(789, 101, 81),
(790, 101, 82),
(791, 101, 83),
(792, 101, 84),
(793, 101, 85),
(794, 101, 86),
(795, 101, 87),
(796, 101, 88),
(797, 101, 89),
(798, 101, 90),
(799, 101, 91),
(800, 101, 93),
(801, 101, 94),
(802, 101, 95),
(803, 101, 96),
(804, 101, 97),
(805, 101, 98),
(806, 101, 99),
(807, 101, 100),
(808, 101, 101),
(809, 101, 102),
(950, 102, 71),
(951, 102, 72),
(952, 102, 73),
(953, 102, 74),
(954, 102, 78),
(955, 102, 79),
(956, 102, 80),
(957, 102, 81),
(958, 102, 82),
(959, 102, 83),
(960, 102, 84),
(961, 102, 85),
(962, 102, 86),
(963, 102, 87),
(964, 102, 88),
(965, 102, 89),
(966, 102, 90),
(967, 102, 91),
(968, 102, 93),
(969, 102, 94),
(970, 102, 95),
(971, 102, 96),
(972, 102, 97),
(973, 102, 98),
(974, 102, 99),
(975, 102, 100),
(976, 102, 101),
(977, 102, 102),
(1118, 100, 71),
(1119, 100, 72),
(1120, 100, 73),
(1121, 100, 74),
(1122, 100, 78),
(1123, 100, 79),
(1124, 100, 80),
(1125, 100, 81),
(1126, 100, 82),
(1127, 100, 83),
(1128, 100, 84),
(1129, 100, 85),
(1130, 100, 86),
(1131, 100, 87),
(1132, 100, 88),
(1133, 100, 89),
(1134, 100, 90),
(1135, 100, 91),
(1136, 100, 93),
(1137, 100, 94),
(1138, 100, 95),
(1139, 100, 96),
(1140, 100, 97),
(1141, 100, 98),
(1142, 100, 99),
(1143, 100, 100),
(1144, 100, 101),
(1145, 100, 102),
(1314, 107, 71),
(1315, 107, 72),
(1316, 107, 73),
(1317, 107, 74),
(1318, 107, 78),
(1319, 107, 79),
(1320, 107, 80),
(1321, 107, 81),
(1322, 107, 82),
(1323, 107, 83),
(1324, 107, 84),
(1325, 107, 85),
(1326, 107, 86),
(1327, 107, 87),
(1328, 107, 88),
(1329, 107, 89),
(1330, 107, 90),
(1331, 107, 91),
(1332, 107, 93),
(1333, 107, 94),
(1334, 107, 95),
(1335, 107, 96),
(1336, 107, 97),
(1337, 107, 98),
(1338, 107, 99),
(1339, 107, 100),
(1340, 107, 101),
(1341, 107, 102),
(1342, 107, 103),
(1343, 107, 104),
(1372, 81, 71),
(1373, 81, 72),
(1374, 81, 73),
(1375, 81, 74),
(1376, 81, 78),
(1377, 81, 79),
(1378, 81, 80),
(1379, 81, 81),
(1380, 81, 82),
(1381, 81, 83),
(1382, 81, 84),
(1383, 81, 85),
(1384, 81, 86),
(1385, 81, 87),
(1386, 81, 88),
(1387, 81, 89),
(1388, 81, 90),
(1389, 81, 91),
(1390, 81, 93),
(1391, 81, 94),
(1392, 81, 95),
(1393, 81, 96),
(1394, 81, 97),
(1395, 81, 98),
(1396, 81, 99),
(1397, 81, 100),
(1398, 81, 101),
(1399, 81, 102),
(1400, 38, 71),
(1401, 38, 72),
(1402, 38, 73),
(1403, 38, 74),
(1404, 38, 78),
(1405, 38, 79),
(1406, 38, 80),
(1407, 38, 81),
(1408, 38, 82),
(1409, 38, 83),
(1410, 38, 84),
(1411, 38, 85),
(1412, 38, 86),
(1413, 38, 87),
(1414, 38, 88),
(1415, 38, 89),
(1416, 38, 90),
(1417, 38, 91),
(1418, 38, 93),
(1419, 38, 94),
(1420, 38, 95),
(1421, 38, 96),
(1422, 38, 97),
(1423, 38, 98),
(1424, 38, 99),
(1425, 38, 100),
(1426, 38, 101),
(1427, 38, 102);

-- --------------------------------------------------------

--
-- Table structure for table `procesos`
--

CREATE TABLE `procesos` (
  `id_proceso` bigint(20) UNSIGNED NOT NULL,
  `nombre_proceso` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL DEFAULT 'apoyo',
  `propiedad_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procesos`
--

INSERT INTO `procesos` (`id_proceso`, `nombre_proceso`, `tipo`, `propiedad_id`, `created_at`, `updated_at`) VALUES
(6, 'Ingenieria y Mantenimiento', 'apoyo', NULL, '2025-03-05 09:47:25', '2025-03-05 09:47:25'),
(7, 'Prevención de Riesgos', 'apoyo', NULL, '2025-03-07 05:13:54', '2025-03-07 05:13:54'),
(16, 'Habitaciones', 'apoyo', NULL, '2025-04-14 23:57:17', '2025-04-14 23:57:17'),
(17, 'Alimentos y Bebidas', 'operativo', NULL, '2025-06-12 00:27:07', '2025-06-12 00:27:07'),
(19, 'Victor', 'apoyo', NULL, '2025-07-18 05:46:19', '2025-07-18 05:46:19'),
(20, 'El juan y  victor', 'operativo', NULL, '2025-07-19 07:04:36', '2025-07-19 07:04:36'),
(21, 'El juan y Yael', 'apoyo', NULL, '2025-07-20 01:24:15', '2025-07-20 01:24:15'),
(23, 'SoyGoku', 'apoyo', 1, '2025-08-16 00:23:40', '2025-08-16 00:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `processes`
--

CREATE TABLE `processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_propiedad` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propiedades`
--

CREATE TABLE `propiedades` (
  `id_propiedad` int(11) NOT NULL,
  `nombre_propiedad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propiedades`
--

INSERT INTO `propiedades` (`id_propiedad`, `nombre_propiedad`) VALUES
(1, 'Palacio Mundo Imperial'),
(2, 'Princess Mundo Imperial'),
(3, 'Pierre Mundo Imperial'),
(4, 'Arena GNP Seguros/forum'),
(5, 'Wayan'),
(6, 'Xixim');

-- --------------------------------------------------------

--
-- Table structure for table `puestos`
--

CREATE TABLE `puestos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_puesto` varchar(255) NOT NULL,
  `departamento_id` bigint(20) UNSIGNED NOT NULL,
  `proceso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `propiedad_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `puestos`
--

INSERT INTO `puestos` (`id`, `nombre_puesto`, `departamento_id`, `proceso_id`, `propiedad_id`, `created_at`, `updated_at`) VALUES
(1, 'Auxiliar de Calidad', 1, NULL, 1, '2025-06-07 05:21:55', '2025-06-07 05:21:55'),
(4, 'Director General', 1, NULL, 1, '2025-07-09 01:53:53', '2025-07-09 01:53:53'),
(5, 'Director General', 1, NULL, 1, '2025-07-09 01:54:08', '2025-07-09 01:54:08'),
(6, 'Director General', 1, NULL, 1, '2025-07-09 04:57:59', '2025-07-09 04:57:59'),
(7, 'sisis', 4, NULL, 1, '2025-07-11 00:50:11', '2025-07-11 00:50:11'),
(8, 'Director General', 5, NULL, 2, '2025-07-11 03:18:52', '2025-07-11 03:18:52'),
(18, 'pasante', 10, NULL, 1, '2025-07-16 05:31:10', '2025-07-16 05:31:10'),
(19, 'pasante', 5, NULL, 2, '2025-07-17 02:13:27', '2025-07-17 02:13:27'),
(21, 'pasante', 12, 20, 5, '2025-07-20 00:46:55', '2025-07-20 00:46:55'),
(22, 'FIliaaaa1', 11, NULL, 5, '2025-07-20 01:03:20', '2025-07-20 01:03:27'),
(23, 'jefesito', 13, 6, 6, '2025-07-20 01:25:31', '2025-07-20 01:25:31'),
(24, 'pasante', 14, 20, 6, '2025-07-21 01:19:37', '2025-07-21 01:19:37'),
(25, 'auxiliar', 16, 6, 1, '2025-08-03 00:42:26', '2025-08-03 00:42:26'),
(26, 'Auxiliar de Calidad', 16, 6, 1, '2025-08-03 00:47:21', '2025-08-03 00:47:21'),
(27, 'Auxiliar de Calidad', 10, 6, 1, '2025-08-03 01:31:23', '2025-08-03 01:31:23'),
(28, 'auxiliar_de_mrpopo', 18, 23, 1, '2025-08-16 00:25:33', '2025-08-16 00:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `reprogramados`
--

CREATE TABLE `reprogramados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservacion_eventos_tables`
--

CREATE TABLE `reservacion_eventos_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residuos`
--

CREATE TABLE `residuos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `kg` decimal(10,2) DEFAULT NULL,
  `ton` decimal(10,2) DEFAULT NULL,
  `precio_kg` decimal(10,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `reciclado` decimal(10,2) DEFAULT NULL,
  `pax` int(11) DEFAULT NULL,
  `residuo_por_pax` decimal(5,2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residuos_entradas`
--

CREATE TABLE `residuos_entradas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_entrada` date NOT NULL,
  `hora_entrada` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_residuo_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad_kg` decimal(10,2) NOT NULL,
  `cantidad_ton` decimal(10,4) DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `area_procedencia_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `residuos_salidas`
--

CREATE TABLE `residuos_salidas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_salida` date NOT NULL,
  `hora_salida` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_residuo_id` bigint(20) UNSIGNED NOT NULL,
  `quien_se_lo_lleva` varchar(255) NOT NULL,
  `testigo` varchar(255) DEFAULT NULL,
  `cantidad_kg` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entrada_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `residuos_salidas`
--

INSERT INTO `residuos_salidas` (`id`, `fecha_salida`, `hora_salida`, `tipo_residuo_id`, `quien_se_lo_lleva`, `testigo`, `cantidad_kg`, `created_at`, `updated_at`, `entrada_id`) VALUES
(1, '2025-06-05', '2025-06-04 22:52:01', 2, 'Andrea', 'Jaime', 35.00, '2025-06-05 04:52:01', '2025-06-05 04:52:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `residuos_tables`
--

CREATE TABLE `residuos_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsables`
--

CREATE TABLE `responsables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responsables`
--

INSERT INTO `responsables` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Antonio22', '2025-07-18 06:13:18', '2025-08-15 21:06:36'),
(6, 'Juan223', '2025-08-15 21:31:16', '2025-08-15 21:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_reports_tables`
--

CREATE TABLE `revenue_reports_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1UHa3rYwe3pUsXcQmYRdfoQl0sFnoW3c0dYelzmf', 81, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGI2bEltMUZhMEMxelNiUDYzd1lEODR3c0xxemlyTWtub0RCbHZXRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXNpZHVvcy9lc3RhZGlzdGljbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjgxO30=', 1766515204),
('etn8l2BXNSoEjV6SDWkTaaRFHfcytdPTfq7xoEHs', 81, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidjV6RWM2T1FRMjJZeHdEMmt6UzZBWUNJdTlIMUFHSUdiTGNaU25KVSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjk0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2VzdGFkaXN0aWNhcy1lbXBsZWFkb3M/ZGVwYXJ0YW1lbnRvPSZwdWVzdG9fYXNwaXJhbnRlPSZyYXpvbl9zb2NpYWw9Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODE7fQ==', 1766516029),
('GjR34QTiH6XUZH8Xjkz1KqZEzKhUxsfMQpNKewOp', 81, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSmIyWlpuVXRZdmhzamNjWmxJNDFmT0o3eVgzU0FjWFdYRUZvc0hydSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c3VhcmlvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjgxO30=', 1766507982);

-- --------------------------------------------------------

--
-- Table structure for table `subprocesses`
--

CREATE TABLE `subprocesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `process_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_residuos`
--

CREATE TABLE `tipos_residuos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `color` varchar(7) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipos_residuos`
--

INSERT INTO `tipos_residuos` (`id`, `nombre`, `color`, `precio`, `created_at`, `updated_at`) VALUES
(2, 'Metal (Aluminio)', '#149bc8', 30.00, '2025-06-05 04:48:44', '2025-06-05 04:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_status`
--

CREATE TABLE `tipo_status` (
  `Codigo` varchar(10) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `apellido_paterno` varchar(25) NOT NULL,
  `rfc` varchar(14) NOT NULL,
  `departamento` varchar(25) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `propiedad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `apellido_paterno`, `rfc`, `departamento`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `propiedad_id`) VALUES
(38, 'Eduardo1', 'ADMIN', 'RFC12345678KK', '22323', NULL, '$2y$12$dDdxwrYQUdcClNvV/Jd8q.oFRsEXcTt3eaGE262SvnYs1rq2HyeDK', 'XbacqBGYdjxPteDNOzxNNfmHAYElfNutahsUPPcAc8i3TQ4Me6JDgj6sbItT', '2025-02-04 02:48:17', '2025-07-21 01:29:56', 1),
(81, 'Administrador 1', 'XXXX', 'RFC12345678KW', 'Limpieza', NULL, '$2y$12$eQIGoQfX46yQ86gaNv.nX.oU3mkiEJ1uo7ieLFAMYmJj8Ny/5kEhu', NULL, '2025-03-25 07:20:52', '2025-06-14 04:10:16', 1),
(82, 'Administrador 2', 'XXXX', 'RFC12345678KP', 'Mantenimiento', NULL, '$2y$12$Rj.ZVVDq4dwM83y9.A0uKuNiZqBnARkwXprg0QkBnGYmQLmZ4qYE.', NULL, '2025-03-25 07:21:51', '2025-03-25 07:21:51', 1),
(96, 'Alejandro', 'Calderon Granados', 'RFC12345678KA', 'Cocina', NULL, '$2y$12$eDvIKb/pc4S2rwkaYzQ09O/8uc/BD0QFa2w8KfzXdxUsL8SRbQpb2', NULL, '2025-04-29 06:23:58', '2025-04-29 06:23:58', 1),
(97, 'Hatsune', 'Miku', '12345678ZZZZZ', 'musica', NULL, '$2y$12$fB2fP969wy0u2sdktyalyO8Q8HYaTuE9cMOGTin3cxymZyj5J9SHe', NULL, '2025-05-01 23:36:04', '2025-05-06 00:45:50', 3),
(98, 'Samus', 'Aram', '12345678ZZZXX', 'Metroid prime', NULL, '$2y$12$6GoN.rXXxfS0VlVSPZLNdewzyG.1JzervwGS4riBeDc/J7dQ8Sgdi', NULL, '2025-05-05 23:18:22', '2025-05-06 04:35:48', 6),
(99, 'Karla', 'Gallardo', 'GORC820724BJ3', '001', NULL, '$2y$12$lH9lx.1UBriGztMoOEsrveomtJ43yrwXLTfB/dMINFdCUSbASE7Ha', NULL, '2025-05-27 04:04:17', '2025-05-27 04:04:17', 1),
(100, 'Andrea', 'Salmerón', 'GASK010213MM9', 'Calidad', NULL, '$2y$12$J0Aj.9uQWT6lU24rsZ2hOurwi.WLv4kRMgVpmUMmihghoUx6mzbui', NULL, '2025-05-27 04:09:02', '2025-06-10 06:04:36', 1),
(101, 'Octavio', 'Sanchez', 'RFC12345678OC', 'Calidad', NULL, '$2y$12$.vqYMwHKdlvmabrEczSLA.j3rEGRjo4.87scuqgSEy.CCZNHfHWCK', NULL, '2025-05-28 04:41:58', '2025-05-28 04:41:58', 2),
(102, 'Jaime', 'Huerta', 'RFC12345678JH', 'Calidad', NULL, '$2y$12$Q7UaIqZM4eYrEi44E.V3dOnGIEXMZwrvaLTW/QVaZhii7Dq4wyj2K', NULL, '2025-05-28 04:44:03', '2025-05-28 05:23:04', 2),
(107, 'Andrea', 'Gallardo', 'RFC1234567810', 'Calidad Prueba', NULL, '$2y$12$Prp9I.2BSXU5DQZoUTKV.O9wHUPiJPL6kYS9nW8RooBDzbPBppKL2', NULL, '2025-06-13 06:02:45', '2025-06-13 06:02:45', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accidentes`
--
ALTER TABLE `accidentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_centros_consumo`
--
ALTER TABLE `admin_centros_consumo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `antecedentes_heredofamiliares`
--
ALTER TABLE `antecedentes_heredofamiliares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentes_heredofamiliares_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `antecedentes_no_patologicos`
--
ALTER TABLE `antecedentes_no_patologicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentes_no_patologicos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `antecedentes_patologicos`
--
ALTER TABLE `antecedentes_patologicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `antecedentes_patologicos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id_archivo`),
  ADD KEY `archivos_carpeta_id_foreign` (`carpeta_id`),
  ADD KEY `archivos_proceso_id_foreign` (`proceso_id`);

--
-- Indexes for table `areas_procedencia`
--
ALTER TABLE `areas_procedencia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auxiliares_diagnosticos`
--
ALTER TABLE `auxiliares_diagnosticos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auxiliares_diagnosticos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cafeteria_kali_tables`
--
ALTER TABLE `cafeteria_kali_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carpetas`
--
ALTER TABLE `carpetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carpetas_parent_id_foreign` (`parent_id`),
  ADD KEY `fk_proceso` (`proceso_id`);

--
-- Indexes for table `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`N_Hab`),
  ADD KEY `catalogo_status_index` (`Status`);

--
-- Indexes for table `causas`
--
ALTER TABLE `causas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centrosdeconsumo`
--
ALTER TABLE `centrosdeconsumo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centrosdeconsumo_respaldo`
--
ALTER TABLE `centrosdeconsumo_respaldo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_tipo_residuo_id_foreign` (`tipo_residuo_id`);

--
-- Indexes for table `control_documental_tables`
--
ALTER TABLE `control_documental_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `control_energeticos_tables`
--
ALTER TABLE `control_energeticos_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `control_plan_tables`
--
ALTER TABLE `control_plan_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id_creditos`);

--
-- Indexes for table `datos_fisicos`
--
ALTER TABLE `datos_fisicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_fisicos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exploracion_abdomen`
--
ALTER TABLE `exploracion_abdomen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_abdomen_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_agudeza_visual`
--
ALTER TABLE `exploracion_agudeza_visual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_agudeza_visual_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_boca`
--
ALTER TABLE `exploracion_boca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_boca_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_columna_cervical`
--
ALTER TABLE `exploracion_columna_cervical`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_columna_cervical_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_columna_dorsal`
--
ALTER TABLE `exploracion_columna_dorsal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_columna_dorsal_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_columna_lumbar`
--
ALTER TABLE `exploracion_columna_lumbar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_columna_lumbar_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_columna_vertebral`
--
ALTER TABLE `exploracion_columna_vertebral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_columna_vertebral_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_craneo`
--
ALTER TABLE `exploracion_craneo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_craneo_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_cuello`
--
ALTER TABLE `exploracion_cuello`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_cuello_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_genitales`
--
ALTER TABLE `exploracion_genitales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_genitales_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_miembros_pelvicos`
--
ALTER TABLE `exploracion_miembros_pelvicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_miembros_pelvicos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_miembros_toracicos`
--
ALTER TABLE `exploracion_miembros_toracicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_miembros_toracicos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_nariz`
--
ALTER TABLE `exploracion_nariz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_nariz_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_oido`
--
ALTER TABLE `exploracion_oido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_oido_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_ojos`
--
ALTER TABLE `exploracion_ojos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_ojos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_piel_anexos`
--
ALTER TABLE `exploracion_piel_anexos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_piel_anexos_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `exploracion_torax`
--
ALTER TABLE `exploracion_torax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exploracion_torax_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `formulario_accidentes`
--
ALTER TABLE `formulario_accidentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_clinico`
--
ALTER TABLE `historial_clinico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historial_laboral`
--
ALTER TABLE `historial_laboral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial_laboral_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `incapacidad_por_enfermedad`
--
ALTER TABLE `incapacidad_por_enfermedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incapacidad_por_enfermedad_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `incapacidad_por_trabajo`
--
ALTER TABLE `incapacidad_por_trabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incapacidad_por_trabajo_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `indicators`
--
ALTER TABLE `indicators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `indicators_subprocess_id_foreign` (`subprocess_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesiones`
--
ALTER TABLE `lesiones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `llegadas`
--
ALTER TABLE `llegadas`
  ADD PRIMARY KEY (`Cve_Reserv`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observaciones`
--
ALTER TABLE `observaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `observaciones_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `padece_alguna_enfermedad`
--
ALTER TABLE `padece_alguna_enfermedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `padece_alguna_enfermedad_empleados_id_foreign` (`empleados_id`);

--
-- Indexes for table `partes_afectadas`
--
ALTER TABLE `partes_afectadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partes_afectadas_historial_id_foreign` (`historial_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poblaciones`
--
ALTER TABLE `poblaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id_privilegio`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `privilegios_carpetas`
--
ALTER TABLE `privilegios_carpetas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `carpeta_id` (`carpeta_id`);

--
-- Indexes for table `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`id_proceso`),
  ADD UNIQUE KEY `procesos_nombre_proceso_unique` (`nombre_proceso`),
  ADD KEY `idx_procesos_propiedad_id` (`propiedad_id`);

--
-- Indexes for table `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_processes_propiedad` (`id_propiedad`);

--
-- Indexes for table `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id_propiedad`);

--
-- Indexes for table `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puestos_departamento_id_foreign` (`departamento_id`),
  ADD KEY `puestos_propiedad_id_foreign` (`propiedad_id`),
  ADD KEY `fk_puestos_proceso` (`proceso_id`);

--
-- Indexes for table `reprogramados`
--
ALTER TABLE `reprogramados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservacion_eventos_tables`
--
ALTER TABLE `reservacion_eventos_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residuos`
--
ALTER TABLE `residuos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residuos_entradas`
--
ALTER TABLE `residuos_entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `residuos_entradas_tipo_residuo_id_foreign` (`tipo_residuo_id`),
  ADD KEY `residuos_entradas_area_procedencia_id_foreign` (`area_procedencia_id`);

--
-- Indexes for table `residuos_salidas`
--
ALTER TABLE `residuos_salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `residuos_salidas_tipo_residuo_id_foreign` (`tipo_residuo_id`),
  ADD KEY `residuos_salidas_entrada_id_foreign` (`entrada_id`);

--
-- Indexes for table `residuos_tables`
--
ALTER TABLE `residuos_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue_reports_tables`
--
ALTER TABLE `revenue_reports_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subprocesses`
--
ALTER TABLE `subprocesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subprocesses_process_id_foreign` (`process_id`);

--
-- Indexes for table `tipos_residuos`
--
ALTER TABLE `tipos_residuos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_status`
--
ALTER TABLE `tipo_status`
  ADD PRIMARY KEY (`Codigo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfc` (`rfc`),
  ADD KEY `fk_propiedad` (`propiedad_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accidentes`
--
ALTER TABLE `accidentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_centros_consumo`
--
ALTER TABLE `admin_centros_consumo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `antecedentes_heredofamiliares`
--
ALTER TABLE `antecedentes_heredofamiliares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `antecedentes_no_patologicos`
--
ALTER TABLE `antecedentes_no_patologicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `antecedentes_patologicos`
--
ALTER TABLE `antecedentes_patologicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `areas_procedencia`
--
ALTER TABLE `areas_procedencia`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auxiliares_diagnosticos`
--
ALTER TABLE `auxiliares_diagnosticos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cafeteria_kali_tables`
--
ALTER TABLE `cafeteria_kali_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carpetas`
--
ALTER TABLE `carpetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `causas`
--
ALTER TABLE `causas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `centrosdeconsumo`
--
ALTER TABLE `centrosdeconsumo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `centrosdeconsumo_respaldo`
--
ALTER TABLE `centrosdeconsumo_respaldo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `compras`
--
ALTER TABLE `compras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `control_documental_tables`
--
ALTER TABLE `control_documental_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `control_energeticos_tables`
--
ALTER TABLE `control_energeticos_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `control_plan_tables`
--
ALTER TABLE `control_plan_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `datos_fisicos`
--
ALTER TABLE `datos_fisicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exploracion_abdomen`
--
ALTER TABLE `exploracion_abdomen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_agudeza_visual`
--
ALTER TABLE `exploracion_agudeza_visual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_boca`
--
ALTER TABLE `exploracion_boca`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_columna_cervical`
--
ALTER TABLE `exploracion_columna_cervical`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_columna_dorsal`
--
ALTER TABLE `exploracion_columna_dorsal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_columna_lumbar`
--
ALTER TABLE `exploracion_columna_lumbar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_columna_vertebral`
--
ALTER TABLE `exploracion_columna_vertebral`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_craneo`
--
ALTER TABLE `exploracion_craneo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_cuello`
--
ALTER TABLE `exploracion_cuello`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_genitales`
--
ALTER TABLE `exploracion_genitales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_miembros_pelvicos`
--
ALTER TABLE `exploracion_miembros_pelvicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_miembros_toracicos`
--
ALTER TABLE `exploracion_miembros_toracicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_nariz`
--
ALTER TABLE `exploracion_nariz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_oido`
--
ALTER TABLE `exploracion_oido`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_ojos`
--
ALTER TABLE `exploracion_ojos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_piel_anexos`
--
ALTER TABLE `exploracion_piel_anexos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exploracion_torax`
--
ALTER TABLE `exploracion_torax`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formulario_accidentes`
--
ALTER TABLE `formulario_accidentes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `historial_clinico`
--
ALTER TABLE `historial_clinico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `historial_laboral`
--
ALTER TABLE `historial_laboral`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `incapacidad_por_enfermedad`
--
ALTER TABLE `incapacidad_por_enfermedad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `incapacidad_por_trabajo`
--
ALTER TABLE `incapacidad_por_trabajo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `indicators`
--
ALTER TABLE `indicators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesiones`
--
ALTER TABLE `lesiones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `observaciones`
--
ALTER TABLE `observaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `padece_alguna_enfermedad`
--
ALTER TABLE `padece_alguna_enfermedad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partes_afectadas`
--
ALTER TABLE `partes_afectadas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poblaciones`
--
ALTER TABLE `poblaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id_privilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `privilegios_carpetas`
--
ALTER TABLE `privilegios_carpetas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1428;

--
-- AUTO_INCREMENT for table `procesos`
--
ALTER TABLE `procesos`
  MODIFY `id_proceso` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `processes`
--
ALTER TABLE `processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id_propiedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reprogramados`
--
ALTER TABLE `reprogramados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservacion_eventos_tables`
--
ALTER TABLE `reservacion_eventos_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residuos`
--
ALTER TABLE `residuos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `residuos_entradas`
--
ALTER TABLE `residuos_entradas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `residuos_salidas`
--
ALTER TABLE `residuos_salidas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `residuos_tables`
--
ALTER TABLE `residuos_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `revenue_reports_tables`
--
ALTER TABLE `revenue_reports_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subprocesses`
--
ALTER TABLE `subprocesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipos_residuos`
--
ALTER TABLE `tipos_residuos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antecedentes_heredofamiliares`
--
ALTER TABLE `antecedentes_heredofamiliares`
  ADD CONSTRAINT `antecedentes_heredofamiliares_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `antecedentes_no_patologicos`
--
ALTER TABLE `antecedentes_no_patologicos`
  ADD CONSTRAINT `antecedentes_no_patologicos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `antecedentes_patologicos`
--
ALTER TABLE `antecedentes_patologicos`
  ADD CONSTRAINT `antecedentes_patologicos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_carpeta_id_foreign` FOREIGN KEY (`carpeta_id`) REFERENCES `carpetas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivos_proceso_id_foreign` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id_proceso`) ON DELETE SET NULL;

--
-- Constraints for table `auxiliares_diagnosticos`
--
ALTER TABLE `auxiliares_diagnosticos`
  ADD CONSTRAINT `auxiliares_diagnosticos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carpetas`
--
ALTER TABLE `carpetas`
  ADD CONSTRAINT `carpetas_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `carpetas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_proceso` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id_proceso`) ON DELETE SET NULL;

--
-- Constraints for table `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_tipo_residuo_id_foreign` FOREIGN KEY (`tipo_residuo_id`) REFERENCES `tipos_residuos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `datos_fisicos`
--
ALTER TABLE `datos_fisicos`
  ADD CONSTRAINT `datos_fisicos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_abdomen`
--
ALTER TABLE `exploracion_abdomen`
  ADD CONSTRAINT `exploracion_abdomen_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_agudeza_visual`
--
ALTER TABLE `exploracion_agudeza_visual`
  ADD CONSTRAINT `exploracion_agudeza_visual_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_boca`
--
ALTER TABLE `exploracion_boca`
  ADD CONSTRAINT `exploracion_boca_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_columna_cervical`
--
ALTER TABLE `exploracion_columna_cervical`
  ADD CONSTRAINT `exploracion_columna_cervical_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_columna_dorsal`
--
ALTER TABLE `exploracion_columna_dorsal`
  ADD CONSTRAINT `exploracion_columna_dorsal_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_columna_lumbar`
--
ALTER TABLE `exploracion_columna_lumbar`
  ADD CONSTRAINT `exploracion_columna_lumbar_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_columna_vertebral`
--
ALTER TABLE `exploracion_columna_vertebral`
  ADD CONSTRAINT `exploracion_columna_vertebral_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_craneo`
--
ALTER TABLE `exploracion_craneo`
  ADD CONSTRAINT `exploracion_craneo_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_cuello`
--
ALTER TABLE `exploracion_cuello`
  ADD CONSTRAINT `exploracion_cuello_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_genitales`
--
ALTER TABLE `exploracion_genitales`
  ADD CONSTRAINT `exploracion_genitales_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_miembros_pelvicos`
--
ALTER TABLE `exploracion_miembros_pelvicos`
  ADD CONSTRAINT `exploracion_miembros_pelvicos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_miembros_toracicos`
--
ALTER TABLE `exploracion_miembros_toracicos`
  ADD CONSTRAINT `exploracion_miembros_toracicos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_nariz`
--
ALTER TABLE `exploracion_nariz`
  ADD CONSTRAINT `exploracion_nariz_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_oido`
--
ALTER TABLE `exploracion_oido`
  ADD CONSTRAINT `exploracion_oido_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_ojos`
--
ALTER TABLE `exploracion_ojos`
  ADD CONSTRAINT `exploracion_ojos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_piel_anexos`
--
ALTER TABLE `exploracion_piel_anexos`
  ADD CONSTRAINT `exploracion_piel_anexos_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exploracion_torax`
--
ALTER TABLE `exploracion_torax`
  ADD CONSTRAINT `exploracion_torax_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `historial_laboral`
--
ALTER TABLE `historial_laboral`
  ADD CONSTRAINT `historial_laboral_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incapacidad_por_enfermedad`
--
ALTER TABLE `incapacidad_por_enfermedad`
  ADD CONSTRAINT `incapacidad_por_enfermedad_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `incapacidad_por_trabajo`
--
ALTER TABLE `incapacidad_por_trabajo`
  ADD CONSTRAINT `incapacidad_por_trabajo_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `indicators`
--
ALTER TABLE `indicators`
  ADD CONSTRAINT `indicators_subprocess_id_foreign` FOREIGN KEY (`subprocess_id`) REFERENCES `subprocesses` (`id`);

--
-- Constraints for table `observaciones`
--
ALTER TABLE `observaciones`
  ADD CONSTRAINT `observaciones_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `padece_alguna_enfermedad`
--
ALTER TABLE `padece_alguna_enfermedad`
  ADD CONSTRAINT `padece_alguna_enfermedad_empleados_id_foreign` FOREIGN KEY (`empleados_id`) REFERENCES `empleados` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `partes_afectadas`
--
ALTER TABLE `partes_afectadas`
  ADD CONSTRAINT `partes_afectadas_historial_id_foreign` FOREIGN KEY (`historial_id`) REFERENCES `historial_clinico` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `privilegios`
--
ALTER TABLE `privilegios`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `privilegios_carpetas`
--
ALTER TABLE `privilegios_carpetas`
  ADD CONSTRAINT `privilegios_carpetas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `privilegios_carpetas_ibfk_2` FOREIGN KEY (`carpeta_id`) REFERENCES `carpetas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `procesos`
--
ALTER TABLE `procesos`
  ADD CONSTRAINT `fk_procesos_propiedad` FOREIGN KEY (`propiedad_id`) REFERENCES `propiedades` (`id_propiedad`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `processes`
--
ALTER TABLE `processes`
  ADD CONSTRAINT `fk_processes_propiedad` FOREIGN KEY (`id_propiedad`) REFERENCES `propiedades` (`id_propiedad`);

--
-- Constraints for table `puestos`
--
ALTER TABLE `puestos`
  ADD CONSTRAINT `fk_puestos_proceso` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id_proceso`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `puestos_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `puestos_propiedad_id_foreign` FOREIGN KEY (`propiedad_id`) REFERENCES `propiedades` (`id_propiedad`) ON DELETE CASCADE;

--
-- Constraints for table `residuos_entradas`
--
ALTER TABLE `residuos_entradas`
  ADD CONSTRAINT `residuos_entradas_area_procedencia_id_foreign` FOREIGN KEY (`area_procedencia_id`) REFERENCES `areas_procedencia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `residuos_entradas_tipo_residuo_id_foreign` FOREIGN KEY (`tipo_residuo_id`) REFERENCES `tipos_residuos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `residuos_salidas`
--
ALTER TABLE `residuos_salidas`
  ADD CONSTRAINT `residuos_salidas_entrada_id_foreign` FOREIGN KEY (`entrada_id`) REFERENCES `residuos_entradas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `residuos_salidas_tipo_residuo_id_foreign` FOREIGN KEY (`tipo_residuo_id`) REFERENCES `tipos_residuos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subprocesses`
--
ALTER TABLE `subprocesses`
  ADD CONSTRAINT `subprocesses_process_id_foreign` FOREIGN KEY (`process_id`) REFERENCES `processes` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_propiedad` FOREIGN KEY (`propiedad_id`) REFERENCES `propiedades` (`id_propiedad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
