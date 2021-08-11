-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 11, 2021 at 03:37 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluationsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Presentación Personal, Porte y Aspecto y Puesto de Trabajo', '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(2, 'Asistencia y Puntualidad', '2021-08-11 21:29:24', '2021-08-11 21:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondName` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondSurname` char(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni` char(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` char(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_dni_unique` (`dni`),
  UNIQUE KEY `customers_phonenumber_unique` (`phoneNumber`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `secondName`, `surname`, `secondSurname`, `dni`, `phoneNumber`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Juan', 'Ernesto', 'Lopez', 'Tellez', '001-171085-0009G', '505 8730 5240', 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(2, 'Karla', 'Carolina', 'Estrada', 'Aguirre', '001-200590-0004K', '505 8842 6987', 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(3, 'Mario', 'Antonio', 'Morales', 'Corea', '481-171085-0005B', '505 5757 5240', 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(4, 'Ana', 'Sofia', 'Aleman', 'Sanchez', '401-200590-0002C', '505 7856 5656', 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(5, 'Mariano', 'Antonio', 'Ruiz', 'Tapia', '005-120368-0001X', '505 8757 5200', 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(6, 'Marcos', 'Jose', 'Suarez', 'Sanchez', '401-030593-0002Z', '505 7899 3256', 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUser` int(10) UNSIGNED NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `score` tinyint(4) NOT NULL,
  `bond` decimal(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluations_iduser_foreign` (`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_details`
--

DROP TABLE IF EXISTS `evaluation_details`;
CREATE TABLE IF NOT EXISTS `evaluation_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idEvaluation` int(10) UNSIGNED NOT NULL,
  `idIndicator` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluation_details_idevaluation_foreign` (`idEvaluation`),
  KEY `evaluation_details_idindicator_foreign` (`idIndicator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indicators`
--

DROP TABLE IF EXISTS `indicators`;
CREATE TABLE IF NOT EXISTS `indicators` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCategory` int(10) UNSIGNED NOT NULL,
  `description` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indicators_idcategory_foreign` (`idCategory`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `indicators`
--

INSERT INTO `indicators` (`id`, `idCategory`, `description`, `score`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pantalón limpio y planchado', 1, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(2, 1, 'Uñas (limpias, bien cuidadas y no tan largas', 1, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(3, 1, 'Cabello (Peinado)', 1, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(4, 1, 'Cubre Boca', 2, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(5, 1, 'Gorro', 1, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(6, 1, 'Piso Limpio', 1, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(7, 1, 'Mesa de Trabajo Ordenada', 1, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(8, 1, 'Uso de Telefono unicamente en el lugar de descanso', 5, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(9, 2, 'Ausencias Injustificadas', 4, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(10, 2, 'Llegadas tardes', 4, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24'),
(11, 2, 'Permisos Extraordinarios', 4, 1, '2021-08-11 21:29:24', '2021-08-11 21:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_07_30_031903_create_customers_table', 1),
(2, '2021_08_07_032300_create_categories_table', 1),
(3, '2021_08_07_030912_create_indicators_table', 1),
(4, '2021_08_07_032849_create_evaluations_table', 1),
(5, '2021_08_09_163436_create_evaluation_details_table', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
