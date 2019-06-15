-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2019 at 10:45 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `papas_botellas`
--

-- --------------------------------------------------------

--
-- Table structure for table `almacenes`
--

CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `activo` int(1) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `almacenes`
--

INSERT INTO `almacenes` (`id`, `nombre`, `activo`, `descripcion`, `created_at`, `updated_at`) VALUES
(-3, 'Todos', 0, 'Todos los almacenes (ADMIN)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(-2, 'Baja Por Merma', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(-1, 'Vendido', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(0, '<En transito>', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 'Almacen General', 1, 'Almacen General', '0000-00-00 00:00:00', '2018-11-21 19:37:22'),
(2, 'Almacen De Licor', 1, 'Almacen De Licor', '0000-00-00 00:00:00', '2018-11-21 19:37:24'),
(3, 'Barra 1', 1, 'Primer Piso - Entrada', '0000-00-00 00:00:00', '2019-04-26 13:55:07'),
(4, 'Barra 2', 1, 'Segundo Piso - Entrada', '0000-00-00 00:00:00', '2018-11-21 19:37:28'),
(5, 'Barra 3', 1, 'Segundo Piso - Fondo', '0000-00-00 00:00:00', '2019-04-26 13:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `botella`
--

CREATE TABLE `botella` (
  `id` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `insumo` int(11) NOT NULL,
  `desc_insumo` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_compra` date NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `transito` int(11) NOT NULL,
  `motivo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `botella`
--

INSERT INTO `botella` (`id`, `folio`, `insumo`, `desc_insumo`, `fecha_compra`, `almacen_id`, `transito`, `motivo`, `created_at`, `updated_at`) VALUES
(1, 2973, 100089, 'BOT.HIPNOTIC 750 ML', '2019-05-23', -2, 1, '3:Gina la tiro', '2019-06-15 13:34:36', '2019-06-15 13:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `lista_movimientos`
--

CREATE TABLE `lista_movimientos` (
  `id` int(11) NOT NULL,
  `botella_id` int(11) NOT NULL,
  `movimiento_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `lista_movimientos`
--

INSERT INTO `lista_movimientos` (`id`, `botella_id`, `movimiento_id`, `almacen_id`, `fecha`, `user`) VALUES
(1, 1, 1, 1, '2019-06-15 13:34:36', 1),
(2, 1, 5, 1, '2019-06-15 13:35:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('044bafbcc37f0e7192ae5f77ad14f8d68893562490a6f132d659dc94703143845862a756842bb36d', 1, 2, NULL, '[]', 1, '2019-06-08 21:03:43', '2019-06-08 21:03:43', '2020-06-08 14:03:43'),
('05cbed6359d01760bf7f2a70442ecaac63cc5ca03bed98093480d94b9f499025b9bdfd0392ea8702', 1, 2, NULL, '[]', 1, '2019-04-29 23:53:11', '2019-04-29 23:53:11', '2020-04-29 16:53:11'),
('07d15e02e0dff76ba06188b38744d7759681349a636736c511cf220f15d3c53a58dffbd8836ff3d3', 3, 2, NULL, '[]', 1, '2019-06-08 20:58:22', '2019-06-08 20:58:22', '2020-06-08 13:58:22'),
('0c66daadc4ca2d9b3c16c9e515d61428fa4a9406c6acf0c710b0cecb13e7d5f039a36221bf5b93be', 1, 2, NULL, '[]', 1, '2019-06-08 20:54:52', '2019-06-08 20:54:52', '2020-06-08 13:54:52'),
('29c399109779b4b8746e6bb908a287f7519fb605eabadb9f705665e2fc178e947b528e0c7fb33963', 2, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:40:02', '2019-06-08 00:40:02', '2020-06-07 17:40:02'),
('391eace343ac94b49f627415a59eacdc1cb1d5d0e3f11ea32a1f2fd4d8892af4c458325a60a2bcd1', 1, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:40:17', '2019-06-08 00:40:17', '2020-06-07 17:40:17'),
('3e829c51bec7631aeff097c0ef3bef3c781622c940a8cf19070f68474653dde6d1ea9d0e0fb5137f', 3, 2, NULL, '[]', 1, '2019-06-08 20:56:36', '2019-06-08 20:56:36', '2020-06-08 13:56:36'),
('436100d75628048c293292101e9edf718fa42b18eabea45a0189dabd90a34018d0b268bdd082fec3', 1, 2, NULL, '[]', 1, '2019-04-29 23:38:08', '2019-04-29 23:38:08', '2020-04-29 16:38:08'),
('46a4f8fc08b8dbcbf746317994c65b0b3a85e14ab7a296bf69d644d1eb12ac6941ea7bb63cb63b51', 7, 3, 'Personal Access Token', '[]', 1, '2019-04-30 17:38:08', '2019-04-30 17:38:08', '2020-04-30 10:38:08'),
('4751df4cb86caeb6e5cb2956b4dad825988278893b5b9533fccf0e08ef8335a097e554344904de70', 1, 2, NULL, '[]', 1, '2019-06-08 20:58:46', '2019-06-08 20:58:46', '2020-06-08 13:58:46'),
('497e55ea6f98266ceaaca2efabd224841d7522902422142a871ea7f33e9af827f99d27c4bcfc17a2', 1, 2, NULL, '[]', 0, '2019-06-15 18:44:25', '2019-06-15 18:44:25', '2020-06-15 11:44:25'),
('6728d4bf911f619f21c4d2535996ca86272cd89335ac7f0bd3c39552141e50da4c5333535c529f29', 1, 2, NULL, '[]', 1, '2019-04-30 17:28:09', '2019-04-30 17:28:09', '2020-04-30 10:28:09'),
('6df237bfa4212e78307cb27bccb22aae533050b0ac5a155918bd71caba97728668c04d2dbcf50334', 1, 2, NULL, '[]', 1, '2019-06-07 19:29:07', '2019-06-07 19:29:07', '2020-06-07 12:29:07'),
('6f6a5b56395150e399c449ee560e565b4085af8156bb935cf54e32c983e35df98fae5dadaded8d66', 1, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:38:26', '2019-06-08 00:38:26', '2020-06-07 17:38:26'),
('7345d42ebdd85d1a63c113e95eaefc436b51a97d9ae653a505bb5bad08b338ebdf3a36ef8fe624da', 7, 3, 'Personal Access Token', '[]', 1, '2019-05-14 00:53:59', '2019-05-14 00:53:59', '2020-05-13 17:53:59'),
('7459aa3fcf04c6d726b784bb1ec0c6ffb8f4b4503059f096f3533a3c8d1638730d4175d791497ebd', 3, 2, NULL, '[]', 1, '2019-06-08 21:04:19', '2019-06-08 21:04:19', '2020-06-08 14:04:19'),
('85896c7d8bed3746d0dd4249cc4a24795445e082b740d203e0577fa2cb01da1d89cd63cedb3491d1', 1, 2, NULL, '[]', 1, '2019-06-14 18:50:47', '2019-06-14 18:50:47', '2020-06-14 11:50:47'),
('8d9d5fe2b778c6f4cc94d9cd02bdff0acd8e7f59fe756d2b66a64de3ea211066b3af60929306ff53', 1, 2, NULL, '[]', 1, '2019-06-08 20:57:46', '2019-06-08 20:57:46', '2020-06-08 13:57:46'),
('9119f4edcdf12b7d976427c09879f89c8a0420dc81db02bd557591462ade2e2bce312e3e69d7e14a', 1, 2, NULL, '[]', 0, '2019-05-13 17:33:05', '2019-05-13 17:33:05', '2020-05-13 10:33:05'),
('9c5c34fb89c313db4785cd1c4a3a1087f6e2361b735e90d157e8daa528c67e3e884315e30ee1c27f', 2, 2, NULL, '[]', 1, '2019-06-08 20:55:31', '2019-06-08 20:55:31', '2020-06-08 13:55:31'),
('a32c0b446147a077dd5d13a8992cfdb135bf03c8cf4e50df695e9880321f5c3e3fad7e687ac8da2c', 7, 3, 'Personal Access Token', '[]', 0, '2019-04-30 17:42:26', '2019-04-30 17:42:26', '2020-04-30 10:42:26'),
('aa0dc3ddc003d1f5753672abcaa1bb23a34172a86a53f9cc4b4eea31ba49b9d739823ef46e2ecfbc', 5, 2, NULL, '[]', 1, '2019-04-29 23:39:11', '2019-04-29 23:39:11', '2020-04-29 16:39:11'),
('ac067410c591347a260fb4a52cf1f1f7e74c1bbe8d934735683c3bc023c50ada56356c6b0ade43b0', 2, 2, NULL, '[]', 1, '2019-06-08 20:52:26', '2019-06-08 20:52:26', '2020-06-08 13:52:26'),
('b220966a74f9ab36f0feabe2d985c8fb592bff2ff88c7a5dc7061475b144d41e7baf18e2f7366deb', 1, 2, NULL, '[]', 1, '2019-06-08 20:56:12', '2019-06-08 20:56:12', '2020-06-08 13:56:12'),
('b7237b4d9dcc0de8bb1c425e50871eeef6119526358cd6a76dbc031048b75684c05617929575ebd4', 1, 2, NULL, '[]', 1, '2019-05-14 01:15:47', '2019-05-14 01:15:47', '2020-05-13 18:15:47'),
('b974ba88416d96a9e36993a08387cadcc1e5f1322cebe9a4e492c51431ac115cb9f346596d95551b', 1, 2, NULL, '[]', 1, '2019-04-30 17:29:46', '2019-04-30 17:29:46', '2020-04-30 10:29:46'),
('ba78ad4f64e856c38a5309484816fce9c60730adea139d93d8de781ba2fa3b7a7939845be67d2dbb', 2, 2, NULL, '[]', 1, '2019-06-08 21:02:42', '2019-06-08 21:02:42', '2020-06-08 14:02:42'),
('bcf248e0c05647638721059efc4d0caf39bbfa3a5e3db2cf2c32e8766636044e0f3eaa84fe56b2e2', 1, 2, NULL, '[]', 1, '2019-06-08 21:04:36', '2019-06-08 21:04:36', '2020-06-08 14:04:36'),
('bdad8d6b05c7ec9afd9d96a19dd685c79b7e81d54805400093f13096d4ffb29eaab188662aeaf2a5', 2, 3, 'Personal Access Token', '[]', 1, '2019-05-14 01:13:21', '2019-05-14 01:13:21', '2020-05-13 18:13:21'),
('c35e05bca4ea9bfde94283db66c3455b8d38b4c837bdfe551354cf7718d5a3bd88531eeb1abe8dd7', 3, 2, NULL, '[]', 0, '2019-06-08 21:04:56', '2019-06-08 21:04:56', '2020-06-08 14:04:56'),
('c7bca294dd8f22d283339c6b55f29f1234a90136a0f631d3a16989b7095ed69634c7fb15e883e0c2', 2, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:38:13', '2019-06-08 00:38:13', '2020-06-07 17:38:13'),
('dceb5a3b7f5dc580226dbdbdff35927a317571d9480e857dbfcd09fafbb43b125a95432399c390f8', 1, 2, NULL, '[]', 1, '2019-05-14 01:07:11', '2019-05-14 01:07:11', '2020-05-13 18:07:11'),
('ddd69bf4576e1756e730ace3f2fe6a7d30d45075bf514dca70c934e6bb180abc914162c6e4409477', 7, 3, 'Personal Access Token', '[]', 1, '2019-05-14 01:13:37', '2019-05-14 01:13:37', '2020-05-13 18:13:37'),
('dea369adb125b444c5aac4815f55145fa5c3dc9bb5e0a18be3778c619b9f26828784a15015634de9', 1, 2, NULL, '[]', 1, '2019-05-14 00:40:32', '2019-05-14 00:40:32', '2020-05-13 17:40:32'),
('ded9854981627db6e15f33a050c29082cb89b436c60a9a663ec6fe997cb3137c70dab2ae47d4489d', 1, 2, NULL, '[]', 1, '2019-06-08 20:55:47', '2019-06-08 20:55:47', '2020-06-08 13:55:47'),
('f3621914a8ac976decdc91201831c7f8987e8a050d88f33c886369b252d10eebc907ea8a91a3cfb9', 7, 3, 'Personal Access Token', '[]', 1, '2019-04-30 17:42:13', '2019-04-30 17:42:13', '2020-04-30 10:42:13'),
('f73d62449517472e3b8df2461751f92234c28590fb936e014274ee380a7e13cd88685287b0437cc1', 1, 2, NULL, '[]', 0, '2019-06-08 21:09:46', '2019-06-08 21:09:46', '2020-06-08 14:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'HIyRgELdx9xynbGiKuGDIf9LUaHvLnrOiTptMrUZ', 'http://localhost', 1, 0, 0, '2018-09-26 17:03:08', '2018-09-26 17:03:08'),
(2, NULL, 'Laravel Password Grant Client', 'D64E8GGRiUFFyajFkP8ZRqLK1sHxUKEaOn38m3vB', 'http://localhost', 0, 1, 0, '2018-09-26 17:03:08', '2018-09-26 17:03:08'),
(3, NULL, 'logtarjeta', 'HrGKBfZZk8W41QOiYALAUrIaK4REZcR8MkAY8O2v', 'http://localhost', 1, 0, 0, '2019-04-30 17:37:34', '2019-04-30 17:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2019-04-30 17:37:34', '2019-04-30 17:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('0265ab76dbe18ebdf19f2b1122c181f961a68e4beca630e409a86bc6b2eaf30226e013e31346bb17', 'c35e05bca4ea9bfde94283db66c3455b8d38b4c837bdfe551354cf7718d5a3bd88531eeb1abe8dd7', 0, '2020-06-08 14:04:56'),
('1a1668c16803b939a5e916cae8b90c3f9d2336d94c82de01222778328b440760fad656452dba7b28', '05cbed6359d01760bf7f2a70442ecaac63cc5ca03bed98093480d94b9f499025b9bdfd0392ea8702', 0, '2020-04-29 16:53:11'),
('1c6980b3765b463fc80a01253cd62bfcde211c3402ebab72acbeda3ebcc42e2c02827a3304a07434', 'dceb5a3b7f5dc580226dbdbdff35927a317571d9480e857dbfcd09fafbb43b125a95432399c390f8', 0, '2020-05-13 18:07:11'),
('1f358f262363cb9c8ffcf1d4063c3a88352628a59114326ae2ab71fc80bfce42154efcc481a8da3d', '9c5c34fb89c313db4785cd1c4a3a1087f6e2361b735e90d157e8daa528c67e3e884315e30ee1c27f', 0, '2020-06-08 13:55:31'),
('2ad032be6b3fac494b0155a3fd0b67c9805272ac671742e2f661b8d6e6ff96865b65857ad3ca5504', 'ba78ad4f64e856c38a5309484816fce9c60730adea139d93d8de781ba2fa3b7a7939845be67d2dbb', 0, '2020-06-08 14:02:42'),
('469a7f21486bf8fb9ce967a3079ac311d0f2b4a1a8abddcd523a3dfd7e9b9659578f9fc4c929aa52', '4751df4cb86caeb6e5cb2956b4dad825988278893b5b9533fccf0e08ef8335a097e554344904de70', 0, '2020-06-08 13:58:46'),
('470dcb67e951ce924a6d189c041609f15cda8165d14aae96dfcd3c401f3064dbcb8c88e240f7752f', '07d15e02e0dff76ba06188b38744d7759681349a636736c511cf220f15d3c53a58dffbd8836ff3d3', 0, '2020-06-08 13:58:22'),
('471b2b9589a2ec2de8dc2180f2ee3256f95e47e49064dd594347c41a6ad875b133e395c2f57bb504', '436100d75628048c293292101e9edf718fa42b18eabea45a0189dabd90a34018d0b268bdd082fec3', 0, '2020-04-29 16:38:08'),
('4943117101a60e9e00780a11d8c487a30a77b6dea5c7cc9a869ff8b6e45d0c549cf82acbdbda543e', '044bafbcc37f0e7192ae5f77ad14f8d68893562490a6f132d659dc94703143845862a756842bb36d', 0, '2020-06-08 14:03:43'),
('4fa46c3d1f5971259cabaebbc543c178c3c4e9f552bcfa9ede2903a22832389f242d1d3917bb81fb', '7459aa3fcf04c6d726b784bb1ec0c6ffb8f4b4503059f096f3533a3c8d1638730d4175d791497ebd', 0, '2020-06-08 14:04:19'),
('5d0a80676c6682c002dfc4325bea60500ee9a6b50920289eb18ac9f8350b2df0dc7ff358aede532a', '85896c7d8bed3746d0dd4249cc4a24795445e082b740d203e0577fa2cb01da1d89cd63cedb3491d1', 0, '2020-06-14 11:50:48'),
('5da399fda859235a24c3574ee9736d978589b4a4c4bf5a9d437e53520ea0f2b942b04d36cc69954a', 'aa0dc3ddc003d1f5753672abcaa1bb23a34172a86a53f9cc4b4eea31ba49b9d739823ef46e2ecfbc', 0, '2020-04-29 16:39:11'),
('63abc13e4433ac295cd68045231d8af3a83ef369a4740f5af3b2349af2448d3ec26cac2a3f12f265', '9119f4edcdf12b7d976427c09879f89c8a0420dc81db02bd557591462ade2e2bce312e3e69d7e14a', 0, '2020-05-13 10:33:06'),
('7091a141c6b67965a2433252480d720bbac281f722597fbcf8f7b386619c6366a578abc0fdd3370e', 'f73d62449517472e3b8df2461751f92234c28590fb936e014274ee380a7e13cd88685287b0437cc1', 0, '2020-06-08 14:09:46'),
('9aada51eb13a3687292c5a53641180e87e7c16712f0c585444b0277ab5bf5a76be594e9a9ec2981a', 'b220966a74f9ab36f0feabe2d985c8fb592bff2ff88c7a5dc7061475b144d41e7baf18e2f7366deb', 0, '2020-06-08 13:56:12'),
('9e262fdb9acfeeddb5a8ebbd7bb5b0bbcfc4bac9a398637a3a577f1d01f63b9cc35096e14fcf10d6', '3e829c51bec7631aeff097c0ef3bef3c781622c940a8cf19070f68474653dde6d1ea9d0e0fb5137f', 0, '2020-06-08 13:56:36'),
('a4e090a1bc33401b99941f0e161e5ae6ca299489246d3a32dade11089dda033e09404537f15e3ae5', '6728d4bf911f619f21c4d2535996ca86272cd89335ac7f0bd3c39552141e50da4c5333535c529f29', 0, '2020-04-30 10:28:10'),
('aa61eefb9bde8451b1c9d094957f3267f67b91cd0a7490ccde5ae92689e1d757e7bf02b9eca5ec90', '6df237bfa4212e78307cb27bccb22aae533050b0ac5a155918bd71caba97728668c04d2dbcf50334', 0, '2020-06-07 12:29:08'),
('aee218de1de65b482548c1dfc494567bb360c5cfc69437d48450c07b07e9e72f24253b6060bacaaf', '8d9d5fe2b778c6f4cc94d9cd02bdff0acd8e7f59fe756d2b66a64de3ea211066b3af60929306ff53', 0, '2020-06-08 13:57:46'),
('b67d9046a7ca692484117499571b3bc2aeba8cc1199f8f3570c9a137ad2d02302d9c424740b2f30a', 'ded9854981627db6e15f33a050c29082cb89b436c60a9a663ec6fe997cb3137c70dab2ae47d4489d', 0, '2020-06-08 13:55:47'),
('b99e073cf1d70b66e30f1a7d2ffc3b058a49e1ecba6a7bcc7459ced962b17e876db1a23e357e5f10', 'ac067410c591347a260fb4a52cf1f1f7e74c1bbe8d934735683c3bc023c50ada56356c6b0ade43b0', 0, '2020-06-08 13:52:26'),
('c3ea603c924a7846c56f0d66091577894e21be01843f0982ebaf3b91740dfb4549f162c929fef643', 'b974ba88416d96a9e36993a08387cadcc1e5f1322cebe9a4e492c51431ac115cb9f346596d95551b', 0, '2020-04-30 10:29:46'),
('caeef50e6467a5eb0cf139642832a74a182d61c31f6187cdf98d62c18afcbb7d32825e10fa6437fa', 'dea369adb125b444c5aac4815f55145fa5c3dc9bb5e0a18be3778c619b9f26828784a15015634de9', 0, '2020-05-13 17:40:32'),
('ddc024bbd6e4f1ff765ce6b60c7061a6807e4d73e5cc4346c91bd871430af55b6d6214da35d42685', 'b7237b4d9dcc0de8bb1c425e50871eeef6119526358cd6a76dbc031048b75684c05617929575ebd4', 0, '2020-05-13 18:15:47'),
('e925bf4c9e61ab7dfbd3696280ff6daee870e22e5ddd2516c6ef82e20275f26ba003e5f9538c1dd1', '0c66daadc4ca2d9b3c16c9e515d61428fa4a9406c6acf0c710b0cecb13e7d5f039a36221bf5b93be', 0, '2020-06-08 13:54:52'),
('edb66f28c1453a14d093471025ce2d2529bbea6cc22d0db59499830e9194a7d2422a98f5d8512ff9', '497e55ea6f98266ceaaca2efabd224841d7522902422142a871ea7f33e9af827f99d27c4bcfc17a2', 0, '2020-06-15 11:44:25'),
('f7060ebe746fb47f0eb47680ba7c8d23a792db6fb838a919d4ffc072013c549135befe6776155003', 'bcf248e0c05647638721059efc4d0caf39bbfa3a5e3db2cf2c32e8766636044e0f3eaa84fe56b2e2', 0, '2020-06-08 14:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `tarjeta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` int(5) NOT NULL,
  `tipo` int(5) NOT NULL,
  `activo` int(5) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `tarjeta`, `area`, `tipo`, `activo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fernando', 'cf_fernandez@hotmail.com', '$2y$10$2uMTlTr3pKT5IeE7bL241eVG2I0.04j3r2ftBm2vCfemskQt9x2GK', '1370010000003023991', -3, 3, 1, NULL, '2018-09-26 18:29:58', '2019-06-08 00:39:13'),
(2, 'bladi', 'bladi@email.com', '$2y$10$PJ0Hrtok50DUaNjNhqKBMuoqdg9Tt1XPP1QoGrniMazANYNiCGLUO', '0210010000001070991', 2, 5, 1, NULL, '2019-01-08 19:00:10', '2019-06-08 20:52:14'),
(3, 'rico', 'rico@gmail.com', '$2y$10$kHDg7wWFOHjCoiWLBsQTCuGCGANK3uVCRMGSGrKCY.8P/oLMkWdke', NULL, 2, 5, 1, NULL, '2019-01-09 16:21:20', '2019-06-08 21:04:44'),
(4, 'raul', 'raul@we', '$2y$10$DJt6N/kxuIBgyfJb1qbdku1mqYHGkmRmxrvNNuYZc0crO.qREC.fS', NULL, 4, 6, 0, NULL, '2019-01-09 17:14:26', '2019-04-26 20:33:05'),
(5, 'rodrigo', 'rodrigo@gmail.com', '$2y$10$ao7J5.DEfhqrtn6S9B0u4ui3rBwpQg1fPlvFTo1oJ8wOj6BngWxL2', NULL, 1, 4, 1, NULL, '2019-04-26 20:40:57', '2019-04-26 20:40:57'),
(6, 'rodrigo', 'rodrigo2@gmail.com', '$2y$10$2VyzwC3nJ1zNu4bsp1GTmeUoLtD/0yrQVbEZ6rfsfNvvJWwBddqVy', NULL, 2, 5, 1, NULL, '2019-04-26 20:47:13', '2019-04-26 20:47:13'),
(7, 'rico', 'rico@hotmail.com', '$2y$10$baxKMF/lV/Do5TLeTmaj0e/q4wGHcCSHAPG.jMKjYS0hhtslZ2m1.', ';1370010000003023=991?', -3, 3, 1, NULL, '2019-04-30 17:27:34', '2019-04-30 17:30:03'),
(8, 'rico', 'rodrigotrash6@gmail.com', '$2y$10$44x7MWymUviD1b8ltyXAsOz/znJXhkWde.XBGfUW60v2OTNpwqdJi', NULL, 2, 5, 1, NULL, '2019-06-07 20:49:51', '2019-06-07 20:49:51'),
(9, 'gina', 'gina@papas.com', '$2y$10$qMgwVOwHfnUloUIBlRn0ZejZMxpnxF7hcEIq65m9A.IdWtmWkR4bm', 'ñ0210010000001070¿991_', -3, 3, 1, NULL, '2019-06-07 22:42:41', '2019-06-08 00:05:08'),
(10, 'rodrigo', 'rodrigo.coronel.14@gmail.com', '$2y$10$d1GObxw6mg0DsCgH0F5x2.eTHo1/sJzQx.7KLbq/fVdt5Aq.RRoCW', '123132', -3, 3, 1, NULL, '2019-06-07 23:05:36', '2019-06-07 23:53:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `botella`
--
ALTER TABLE `botella`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `folio` (`folio`);

--
-- Indexes for table `lista_movimientos`
--
ALTER TABLE `lista_movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `botella`
--
ALTER TABLE `botella`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lista_movimientos`
--
ALTER TABLE `lista_movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
