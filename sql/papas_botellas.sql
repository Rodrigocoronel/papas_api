-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-08-2019 a las 00:57:18
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `papas_botellas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenes`
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
-- Volcado de datos para la tabla `almacenes`
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
-- Estructura de tabla para la tabla `botella`
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
-- Volcado de datos para la tabla `botella`
--

INSERT INTO `botella` (`id`, `folio`, `insumo`, `desc_insumo`, `fecha_compra`, `almacen_id`, `transito`, `motivo`, `created_at`, `updated_at`) VALUES
(41, 3035, 100111, 'LICOR ABSINTHE 700 ML', '2019-07-11', 1, 0, NULL, '2019-08-06 11:37:20', '2019-08-06 11:37:20'),
(42, 3036, 100111, 'LICOR ABSINTHE 700 ML', '2019-07-11', 1, 0, NULL, '2019-08-06 11:37:22', '2019-08-06 11:37:22'),
(43, 3037, 100111, 'LICOR ABSINTHE 700 ML', '2019-07-11', 1, 0, NULL, '2019-08-06 11:37:26', '2019-08-06 11:37:26'),
(44, 3117, 100133, 'BOT.RON BARAIMA 700 ML', '2019-07-11', 1, 0, NULL, '2019-08-06 11:37:36', '2019-08-06 11:37:36'),
(45, 3118, 100133, 'BOT.RON BARAIMA 700 ML', '2019-07-11', 1, 0, NULL, '2019-08-06 11:37:40', '2019-08-06 11:37:40'),
(46, 3119, 100133, 'BOT.RON BARAIMA 700 ML', '2019-07-11', 1, 0, NULL, '2019-08-06 11:37:46', '2019-08-06 11:37:46'),
(47, 3072, 100238, 'BOT.MOET CHANDON NECTAR 750 ML', '2019-01-29', 1, 0, NULL, '2019-08-06 11:40:33', '2019-08-06 11:40:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_movimientos`
--

CREATE TABLE `lista_movimientos` (
  `id` int(11) NOT NULL,
  `botella_id` int(11) NOT NULL,
  `movimiento_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `trasp_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `lista_movimientos`
--

INSERT INTO `lista_movimientos` (`id`, `botella_id`, `movimiento_id`, `almacen_id`, `trasp_id`, `fecha`, `user`) VALUES
(130, 41, 1, 1, NULL, '2019-08-06 11:37:20', 1),
(131, 42, 1, 1, NULL, '2019-08-06 11:37:22', 1),
(132, 43, 1, 1, NULL, '2019-08-06 11:37:26', 1),
(133, 44, 1, 1, NULL, '2019-08-06 11:37:36', 1),
(134, 45, 1, 1, NULL, '2019-08-06 11:37:40', 1),
(135, 46, 1, 1, NULL, '2019-08-06 11:37:46', 1),
(136, 47, 1, 1, NULL, '2019-08-06 11:40:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
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
-- Estructura de tabla para la tabla `oauth_access_tokens`
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
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('033f67312b062dfeb92d351325936e3a92ff8f4fcbed8dc46b86913769dd49929ee9aaaca1f2df04', 1, 2, NULL, '[]', 1, '2019-06-26 17:29:53', '2019-06-26 17:29:53', '2020-06-26 10:29:53'),
('044bafbcc37f0e7192ae5f77ad14f8d68893562490a6f132d659dc94703143845862a756842bb36d', 1, 2, NULL, '[]', 1, '2019-06-08 21:03:43', '2019-06-08 21:03:43', '2020-06-08 14:03:43'),
('0580b0f7395bdec6acbee86a03e2ba46f2ace3b7eefe992c231bfd3d109369a84663c81ed2a9cfc2', 4, 2, NULL, '[]', 1, '2019-07-02 21:24:22', '2019-07-02 21:24:22', '2020-07-02 14:24:22'),
('05cbed6359d01760bf7f2a70442ecaac63cc5ca03bed98093480d94b9f499025b9bdfd0392ea8702', 1, 2, NULL, '[]', 1, '2019-04-29 23:53:11', '2019-04-29 23:53:11', '2020-04-29 16:53:11'),
('07d15e02e0dff76ba06188b38744d7759681349a636736c511cf220f15d3c53a58dffbd8836ff3d3', 3, 2, NULL, '[]', 1, '2019-06-08 20:58:22', '2019-06-08 20:58:22', '2020-06-08 13:58:22'),
('0c66daadc4ca2d9b3c16c9e515d61428fa4a9406c6acf0c710b0cecb13e7d5f039a36221bf5b93be', 1, 2, NULL, '[]', 1, '2019-06-08 20:54:52', '2019-06-08 20:54:52', '2020-06-08 13:54:52'),
('1d9a2600b9ff0a93078e5eb36f6649947507d8c2ff58a052e0cbe34f2b0bae2fa19cd563a9f26099', 1, 2, NULL, '[]', 0, '2019-08-01 18:36:41', '2019-08-01 18:36:41', '2020-08-01 11:36:41'),
('214d1e13a245de6fbc9c002f41cf3a21d1fba4a3c9c3cd91f509ba4398e3c8454ef6b37aff80f229', 1, 2, NULL, '[]', 0, '2019-06-26 18:06:51', '2019-06-26 18:06:51', '2020-06-26 11:06:51'),
('222485d719ce58220cb66451530bc9c01e4c54ab94e12bdcfcd72bc2eb68d00a7a6db44c0cd28e54', 1, 2, NULL, '[]', 1, '2019-07-03 23:41:19', '2019-07-03 23:41:19', '2020-07-03 16:41:19'),
('29c399109779b4b8746e6bb908a287f7519fb605eabadb9f705665e2fc178e947b528e0c7fb33963', 2, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:40:02', '2019-06-08 00:40:02', '2020-06-07 17:40:02'),
('2c8ffccc530c5a26ef7955fce6b1f22981975156611e9b063564cae1b4171dc5cea088ef587da3fc', 1, 2, NULL, '[]', 0, '2019-08-04 03:35:38', '2019-08-04 03:35:38', '2020-08-03 20:35:38'),
('2cfbf531575b3f863252e76c23e63e299e97640da27cda12dcda33307db4b8c9ce506b5e260ed75b', 7, 2, NULL, '[]', 1, '2019-06-26 17:30:59', '2019-06-26 17:30:59', '2020-06-26 10:30:59'),
('2d8178c3796e28ba3b13edfc02367b8a54962f192b013c9bc00b265656091a77dcbde93cf7f6b1aa', 1, 2, NULL, '[]', 0, '2019-07-24 17:11:17', '2019-07-24 17:11:17', '2020-07-24 10:11:17'),
('339aeb0beaf3e43e628f8f716eaa5df460c7efd0a47404a46ed389bcad6b20b8c653a3c97402e3d0', 1, 2, NULL, '[]', 0, '2019-07-24 17:11:18', '2019-07-24 17:11:18', '2020-07-24 10:11:18'),
('391eace343ac94b49f627415a59eacdc1cb1d5d0e3f11ea32a1f2fd4d8892af4c458325a60a2bcd1', 1, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:40:17', '2019-06-08 00:40:17', '2020-06-07 17:40:17'),
('3c4b804c04559c05fee6917899c5bd73507c0bf3b82e9866398e94e688033fa16880b6bf2021116f', 7, 2, NULL, '[]', 0, '2019-07-02 23:56:37', '2019-07-02 23:56:37', '2020-07-02 16:56:37'),
('3e829c51bec7631aeff097c0ef3bef3c781622c940a8cf19070f68474653dde6d1ea9d0e0fb5137f', 3, 2, NULL, '[]', 1, '2019-06-08 20:56:36', '2019-06-08 20:56:36', '2020-06-08 13:56:36'),
('3e918c65a5d5b819fbb5e221bd1688dd3293225b421ea3a9b8b3fa91e4d67edf0180d3ed4b73c2dc', 1, 2, NULL, '[]', 0, '2019-06-25 21:09:21', '2019-06-25 21:09:21', '2020-06-25 14:09:21'),
('436100d75628048c293292101e9edf718fa42b18eabea45a0189dabd90a34018d0b268bdd082fec3', 1, 2, NULL, '[]', 1, '2019-04-29 23:38:08', '2019-04-29 23:38:08', '2020-04-29 16:38:08'),
('46a4f8fc08b8dbcbf746317994c65b0b3a85e14ab7a296bf69d644d1eb12ac6941ea7bb63cb63b51', 7, 3, 'Personal Access Token', '[]', 1, '2019-04-30 17:38:08', '2019-04-30 17:38:08', '2020-04-30 10:38:08'),
('46a76f7cfb81996c108e219b265ae40698d79d43136d15897455b2f8c999445deec829af1e182532', 1, 2, NULL, '[]', 1, '2019-06-26 17:30:40', '2019-06-26 17:30:40', '2020-06-26 10:30:40'),
('4751df4cb86caeb6e5cb2956b4dad825988278893b5b9533fccf0e08ef8335a097e554344904de70', 1, 2, NULL, '[]', 1, '2019-06-08 20:58:46', '2019-06-08 20:58:46', '2020-06-08 13:58:46'),
('497e55ea6f98266ceaaca2efabd224841d7522902422142a871ea7f33e9af827f99d27c4bcfc17a2', 1, 2, NULL, '[]', 1, '2019-06-15 18:44:25', '2019-06-15 18:44:25', '2020-06-15 11:44:25'),
('522f5b76e572acfd3d1139205f5040de3a339a6c8ded69dd54c46867273ceb8ab867382fd9c725bf', 4, 2, NULL, '[]', 1, '2019-07-02 21:25:43', '2019-07-02 21:25:43', '2020-07-02 14:25:43'),
('574c588982a5fc593f2af131764a19fcc5f7fc1295afdec721444b280ec2b832ce99739ac52cc4c0', 1, 2, NULL, '[]', 0, '2019-07-22 21:23:29', '2019-07-22 21:23:29', '2020-07-22 14:23:29'),
('5862aa9178dac15a49b5105d3ca9d83b3d8bda7351693e9a57470911d4b541e7c1b6cf7297016f74', 1, 2, NULL, '[]', 1, '2019-07-22 20:05:06', '2019-07-22 20:05:06', '2020-07-22 13:05:06'),
('5b68155c133732ffd7d0f6e52e84f5f84ca3827827b5265b16ccb6c2bda83dade2b0650fb61c0bc0', 1, 2, NULL, '[]', 0, '2019-06-27 16:59:07', '2019-06-27 16:59:07', '2020-06-27 09:59:07'),
('6728d4bf911f619f21c4d2535996ca86272cd89335ac7f0bd3c39552141e50da4c5333535c529f29', 1, 2, NULL, '[]', 1, '2019-04-30 17:28:09', '2019-04-30 17:28:09', '2020-04-30 10:28:09'),
('6df237bfa4212e78307cb27bccb22aae533050b0ac5a155918bd71caba97728668c04d2dbcf50334', 1, 2, NULL, '[]', 1, '2019-06-07 19:29:07', '2019-06-07 19:29:07', '2020-06-07 12:29:07'),
('6e3ba8f3f1b52919e4962890256b41287beb6641cc2a1b03cee0ff139300533f942f94749cc87ab9', 1, 2, NULL, '[]', 1, '2019-06-28 19:07:37', '2019-06-28 19:07:37', '2020-06-28 12:07:37'),
('6f6a5b56395150e399c449ee560e565b4085af8156bb935cf54e32c983e35df98fae5dadaded8d66', 1, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:38:26', '2019-06-08 00:38:26', '2020-06-07 17:38:26'),
('7345d42ebdd85d1a63c113e95eaefc436b51a97d9ae653a505bb5bad08b338ebdf3a36ef8fe624da', 7, 3, 'Personal Access Token', '[]', 1, '2019-05-14 00:53:59', '2019-05-14 00:53:59', '2020-05-13 17:53:59'),
('7459aa3fcf04c6d726b784bb1ec0c6ffb8f4b4503059f096f3533a3c8d1638730d4175d791497ebd', 3, 2, NULL, '[]', 1, '2019-06-08 21:04:19', '2019-06-08 21:04:19', '2020-06-08 14:04:19'),
('7878418cfca1bbf8a44edc94a9501354c29b169111dfcb203d56056dcbd75b45acd1fb2683dc73a8', 1, 2, NULL, '[]', 0, '2019-08-02 17:35:01', '2019-08-02 17:35:01', '2020-08-02 10:35:01'),
('8098de775faae27115d69cefab298d51f87f8914cdd000bd0d2e4ef618174b7c072df0fe8c7b2a08', 1, 2, NULL, '[]', 1, '2019-06-26 16:41:21', '2019-06-26 16:41:21', '2020-06-26 09:41:21'),
('850b7e2250b24715ef7792eb058fd13a34dbb9c5e3546bcf20ac89357c6ac14fd44fbaf8605c9baf', 2, 2, NULL, '[]', 1, '2019-06-26 17:29:37', '2019-06-26 17:29:37', '2020-06-26 10:29:37'),
('85896c7d8bed3746d0dd4249cc4a24795445e082b740d203e0577fa2cb01da1d89cd63cedb3491d1', 1, 2, NULL, '[]', 1, '2019-06-14 18:50:47', '2019-06-14 18:50:47', '2020-06-14 11:50:47'),
('8d9d5fe2b778c6f4cc94d9cd02bdff0acd8e7f59fe756d2b66a64de3ea211066b3af60929306ff53', 1, 2, NULL, '[]', 1, '2019-06-08 20:57:46', '2019-06-08 20:57:46', '2020-06-08 13:57:46'),
('8dddd6bd43ee34ff2d47f49d65e61314919980f4b5eb6119088d00c093207586c2c1c638d1a5f275', 1, 2, NULL, '[]', 0, '2019-08-01 18:36:40', '2019-08-01 18:36:40', '2020-08-01 11:36:40'),
('9119f4edcdf12b7d976427c09879f89c8a0420dc81db02bd557591462ade2e2bce312e3e69d7e14a', 1, 2, NULL, '[]', 0, '2019-05-13 17:33:05', '2019-05-13 17:33:05', '2020-05-13 10:33:05'),
('9c5c34fb89c313db4785cd1c4a3a1087f6e2361b735e90d157e8daa528c67e3e884315e30ee1c27f', 2, 2, NULL, '[]', 1, '2019-06-08 20:55:31', '2019-06-08 20:55:31', '2020-06-08 13:55:31'),
('a32c0b446147a077dd5d13a8992cfdb135bf03c8cf4e50df695e9880321f5c3e3fad7e687ac8da2c', 7, 3, 'Personal Access Token', '[]', 0, '2019-04-30 17:42:26', '2019-04-30 17:42:26', '2020-04-30 10:42:26'),
('a60332c9e92a629761aee9bc0fac66376e305d74214b04dc12f3d76d2c8a6276acc6c3933ed47b7e', 1, 2, NULL, '[]', 0, '2019-06-17 19:08:09', '2019-06-17 19:08:09', '2020-06-17 12:08:09'),
('aa0dc3ddc003d1f5753672abcaa1bb23a34172a86a53f9cc4b4eea31ba49b9d739823ef46e2ecfbc', 5, 2, NULL, '[]', 1, '2019-04-29 23:39:11', '2019-04-29 23:39:11', '2020-04-29 16:39:11'),
('ab4fb2a36490786efc3c021dc26c96b04ca57ee58fbb00661a51554d619f966da167eede049577fc', 1, 2, NULL, '[]', 1, '2019-07-02 22:03:37', '2019-07-02 22:03:37', '2020-07-02 15:03:37'),
('ac067410c591347a260fb4a52cf1f1f7e74c1bbe8d934735683c3bc023c50ada56356c6b0ade43b0', 2, 2, NULL, '[]', 1, '2019-06-08 20:52:26', '2019-06-08 20:52:26', '2020-06-08 13:52:26'),
('b220966a74f9ab36f0feabe2d985c8fb592bff2ff88c7a5dc7061475b144d41e7baf18e2f7366deb', 1, 2, NULL, '[]', 1, '2019-06-08 20:56:12', '2019-06-08 20:56:12', '2020-06-08 13:56:12'),
('b3e7e131b3e2cb8093ee6da44691c97744ac1056f47defa8aee99cae87a6618934819acd45cde8ad', 1, 2, NULL, '[]', 1, '2019-08-01 17:03:24', '2019-08-01 17:03:24', '2020-08-01 10:03:24'),
('b7237b4d9dcc0de8bb1c425e50871eeef6119526358cd6a76dbc031048b75684c05617929575ebd4', 1, 2, NULL, '[]', 1, '2019-05-14 01:15:47', '2019-05-14 01:15:47', '2020-05-13 18:15:47'),
('b974ba88416d96a9e36993a08387cadcc1e5f1322cebe9a4e492c51431ac115cb9f346596d95551b', 1, 2, NULL, '[]', 1, '2019-04-30 17:29:46', '2019-04-30 17:29:46', '2020-04-30 10:29:46'),
('ba78ad4f64e856c38a5309484816fce9c60730adea139d93d8de781ba2fa3b7a7939845be67d2dbb', 2, 2, NULL, '[]', 1, '2019-06-08 21:02:42', '2019-06-08 21:02:42', '2020-06-08 14:02:42'),
('bcf248e0c05647638721059efc4d0caf39bbfa3a5e3db2cf2c32e8766636044e0f3eaa84fe56b2e2', 1, 2, NULL, '[]', 1, '2019-06-08 21:04:36', '2019-06-08 21:04:36', '2020-06-08 14:04:36'),
('bdad8d6b05c7ec9afd9d96a19dd685c79b7e81d54805400093f13096d4ffb29eaab188662aeaf2a5', 2, 3, 'Personal Access Token', '[]', 1, '2019-05-14 01:13:21', '2019-05-14 01:13:21', '2020-05-13 18:13:21'),
('c35e05bca4ea9bfde94283db66c3455b8d38b4c837bdfe551354cf7718d5a3bd88531eeb1abe8dd7', 3, 2, NULL, '[]', 0, '2019-06-08 21:04:56', '2019-06-08 21:04:56', '2020-06-08 14:04:56'),
('c7bca294dd8f22d283339c6b55f29f1234a90136a0f631d3a16989b7095ed69634c7fb15e883e0c2', 2, 3, 'Personal Access Token', '[]', 1, '2019-06-08 00:38:13', '2019-06-08 00:38:13', '2020-06-07 17:38:13'),
('cd1908e5709f4586592626689bc7794b83f468209b3a2047e981dd7a2fcf2eda9f272f9870c9a94b', 1, 2, NULL, '[]', 0, '2019-07-18 16:40:49', '2019-07-18 16:40:49', '2020-07-18 09:40:49'),
('dceb5a3b7f5dc580226dbdbdff35927a317571d9480e857dbfcd09fafbb43b125a95432399c390f8', 1, 2, NULL, '[]', 1, '2019-05-14 01:07:11', '2019-05-14 01:07:11', '2020-05-13 18:07:11'),
('ddd69bf4576e1756e730ace3f2fe6a7d30d45075bf514dca70c934e6bb180abc914162c6e4409477', 7, 3, 'Personal Access Token', '[]', 1, '2019-05-14 01:13:37', '2019-05-14 01:13:37', '2020-05-13 18:13:37'),
('dea369adb125b444c5aac4815f55145fa5c3dc9bb5e0a18be3778c619b9f26828784a15015634de9', 1, 2, NULL, '[]', 1, '2019-05-14 00:40:32', '2019-05-14 00:40:32', '2020-05-13 17:40:32'),
('ded9854981627db6e15f33a050c29082cb89b436c60a9a663ec6fe997cb3137c70dab2ae47d4489d', 1, 2, NULL, '[]', 1, '2019-06-08 20:55:47', '2019-06-08 20:55:47', '2020-06-08 13:55:47'),
('f3621914a8ac976decdc91201831c7f8987e8a050d88f33c886369b252d10eebc907ea8a91a3cfb9', 7, 3, 'Personal Access Token', '[]', 1, '2019-04-30 17:42:13', '2019-04-30 17:42:13', '2020-04-30 10:42:13'),
('f73d62449517472e3b8df2461751f92234c28590fb936e014274ee380a7e13cd88685287b0437cc1', 1, 2, NULL, '[]', 0, '2019-06-08 21:09:46', '2019-06-08 21:09:46', '2020-06-08 14:09:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
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
-- Estructura de tabla para la tabla `oauth_clients`
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
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'HIyRgELdx9xynbGiKuGDIf9LUaHvLnrOiTptMrUZ', 'http://localhost', 1, 0, 0, '2018-09-26 17:03:08', '2018-09-26 17:03:08'),
(2, NULL, 'Laravel Password Grant Client', 'D64E8GGRiUFFyajFkP8ZRqLK1sHxUKEaOn38m3vB', 'http://localhost', 0, 1, 0, '2018-09-26 17:03:08', '2018-09-26 17:03:08'),
(3, NULL, 'logtarjeta', 'HrGKBfZZk8W41QOiYALAUrIaK4REZcR8MkAY8O2v', 'http://localhost', 1, 0, 0, '2019-04-30 17:37:34', '2019-04-30 17:37:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 3, '2019-04-30 17:37:34', '2019-04-30 17:37:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('0265ab76dbe18ebdf19f2b1122c181f961a68e4beca630e409a86bc6b2eaf30226e013e31346bb17', 'c35e05bca4ea9bfde94283db66c3455b8d38b4c837bdfe551354cf7718d5a3bd88531eeb1abe8dd7', 0, '2020-06-08 14:04:56'),
('03b5a125d68374b93bbd3d993c0df223a2c913283673e3cdb12dd3b920ad743f1aaf8e837e51393f', 'a60332c9e92a629761aee9bc0fac66376e305d74214b04dc12f3d76d2c8a6276acc6c3933ed47b7e', 0, '2020-06-17 12:08:09'),
('05c6062c5b6fc3009731d053087fc0de0eda49babb09aa85262a1263a77a1bdf71bdad6093a65e36', 'cd1908e5709f4586592626689bc7794b83f468209b3a2047e981dd7a2fcf2eda9f272f9870c9a94b', 0, '2020-07-18 09:40:49'),
('0722ef77c450e277643e25c5f090b2b766bcf75b5254d4faa0315611c367ccc681ac7bb3d4143887', '46a76f7cfb81996c108e219b265ae40698d79d43136d15897455b2f8c999445deec829af1e182532', 0, '2020-06-26 10:30:40'),
('0921837ed82d32b286587c13dae4d54ebe80f1310b4e551425a9f6b925daf03e5b771005491a3e86', '3e918c65a5d5b819fbb5e221bd1688dd3293225b421ea3a9b8b3fa91e4d67edf0180d3ed4b73c2dc', 0, '2020-06-25 14:09:22'),
('109bb7b447527eb4d6881968bd578b551d5b4d1115c4a0eb3fc73e2b770938ced2542bf0fd7836ef', 'ab4fb2a36490786efc3c021dc26c96b04ca57ee58fbb00661a51554d619f966da167eede049577fc', 0, '2020-07-02 15:03:37'),
('1a1668c16803b939a5e916cae8b90c3f9d2336d94c82de01222778328b440760fad656452dba7b28', '05cbed6359d01760bf7f2a70442ecaac63cc5ca03bed98093480d94b9f499025b9bdfd0392ea8702', 0, '2020-04-29 16:53:11'),
('1c6980b3765b463fc80a01253cd62bfcde211c3402ebab72acbeda3ebcc42e2c02827a3304a07434', 'dceb5a3b7f5dc580226dbdbdff35927a317571d9480e857dbfcd09fafbb43b125a95432399c390f8', 0, '2020-05-13 18:07:11'),
('1f358f262363cb9c8ffcf1d4063c3a88352628a59114326ae2ab71fc80bfce42154efcc481a8da3d', '9c5c34fb89c313db4785cd1c4a3a1087f6e2361b735e90d157e8daa528c67e3e884315e30ee1c27f', 0, '2020-06-08 13:55:31'),
('25864b9900af7e4e58ea02f4bb8688387f44c58e142f736995526c439b7894a587c9160e1320f611', '222485d719ce58220cb66451530bc9c01e4c54ab94e12bdcfcd72bc2eb68d00a7a6db44c0cd28e54', 0, '2020-07-03 16:41:19'),
('2ad032be6b3fac494b0155a3fd0b67c9805272ac671742e2f661b8d6e6ff96865b65857ad3ca5504', 'ba78ad4f64e856c38a5309484816fce9c60730adea139d93d8de781ba2fa3b7a7939845be67d2dbb', 0, '2020-06-08 14:02:42'),
('469a7f21486bf8fb9ce967a3079ac311d0f2b4a1a8abddcd523a3dfd7e9b9659578f9fc4c929aa52', '4751df4cb86caeb6e5cb2956b4dad825988278893b5b9533fccf0e08ef8335a097e554344904de70', 0, '2020-06-08 13:58:46'),
('46e0491e67f80ceed28e532403094224159637bdce9f871aa85543d7d7ff630a06bc0d7d70eae270', '033f67312b062dfeb92d351325936e3a92ff8f4fcbed8dc46b86913769dd49929ee9aaaca1f2df04', 0, '2020-06-26 10:29:53'),
('470dcb67e951ce924a6d189c041609f15cda8165d14aae96dfcd3c401f3064dbcb8c88e240f7752f', '07d15e02e0dff76ba06188b38744d7759681349a636736c511cf220f15d3c53a58dffbd8836ff3d3', 0, '2020-06-08 13:58:22'),
('471b2b9589a2ec2de8dc2180f2ee3256f95e47e49064dd594347c41a6ad875b133e395c2f57bb504', '436100d75628048c293292101e9edf718fa42b18eabea45a0189dabd90a34018d0b268bdd082fec3', 0, '2020-04-29 16:38:08'),
('4943117101a60e9e00780a11d8c487a30a77b6dea5c7cc9a869ff8b6e45d0c549cf82acbdbda543e', '044bafbcc37f0e7192ae5f77ad14f8d68893562490a6f132d659dc94703143845862a756842bb36d', 0, '2020-06-08 14:03:43'),
('4fa46c3d1f5971259cabaebbc543c178c3c4e9f552bcfa9ede2903a22832389f242d1d3917bb81fb', '7459aa3fcf04c6d726b784bb1ec0c6ffb8f4b4503059f096f3533a3c8d1638730d4175d791497ebd', 0, '2020-06-08 14:04:19'),
('5140401367007fccb4a5eb4d5dfc802a0a530a95f08f4eee5fd1bf7541b5ef4f987b427250fec1a6', '214d1e13a245de6fbc9c002f41cf3a21d1fba4a3c9c3cd91f509ba4398e3c8454ef6b37aff80f229', 0, '2020-06-26 11:06:51'),
('53c36261b8cb4fdc3ec72d4df613f3c564905708e01ee6ca5e48017c39e76bbc5f503441507175ca', '8098de775faae27115d69cefab298d51f87f8914cdd000bd0d2e4ef618174b7c072df0fe8c7b2a08', 0, '2020-06-26 09:41:21'),
('55ffc845a6d424d9d7ddffd2bb442a810687d9996addfb388b06324e3c1ccb9fae722ef2d7a270cc', '1d9a2600b9ff0a93078e5eb36f6649947507d8c2ff58a052e0cbe34f2b0bae2fa19cd563a9f26099', 0, '2020-08-01 11:36:41'),
('587deb2e6806ed7f3ca4294fc8ca7b456dc4e7c881b98c4d309d2ffbc2a2628f886645f9a9e23905', '574c588982a5fc593f2af131764a19fcc5f7fc1295afdec721444b280ec2b832ce99739ac52cc4c0', 0, '2020-07-22 14:23:29'),
('5d0a80676c6682c002dfc4325bea60500ee9a6b50920289eb18ac9f8350b2df0dc7ff358aede532a', '85896c7d8bed3746d0dd4249cc4a24795445e082b740d203e0577fa2cb01da1d89cd63cedb3491d1', 0, '2020-06-14 11:50:48'),
('5da399fda859235a24c3574ee9736d978589b4a4c4bf5a9d437e53520ea0f2b942b04d36cc69954a', 'aa0dc3ddc003d1f5753672abcaa1bb23a34172a86a53f9cc4b4eea31ba49b9d739823ef46e2ecfbc', 0, '2020-04-29 16:39:11'),
('6093357886dce014f5131d67c0a468b909ecf0d511408492436d8115d8db0c972f3de667680dec11', '5b68155c133732ffd7d0f6e52e84f5f84ca3827827b5265b16ccb6c2bda83dade2b0650fb61c0bc0', 0, '2020-06-27 09:59:07'),
('6159107e92b0a149fc106746cf7ac2601af8ef06f4e74ed2046eeaaf839f53fef62ef1353a2da276', 'b3e7e131b3e2cb8093ee6da44691c97744ac1056f47defa8aee99cae87a6618934819acd45cde8ad', 0, '2020-08-01 10:03:24'),
('63abc13e4433ac295cd68045231d8af3a83ef369a4740f5af3b2349af2448d3ec26cac2a3f12f265', '9119f4edcdf12b7d976427c09879f89c8a0420dc81db02bd557591462ade2e2bce312e3e69d7e14a', 0, '2020-05-13 10:33:06'),
('6a8f0ac9143a686fe07a0d368a93ebcf7110849648974eb1fd52e562d280e8cd7f766a65d844d368', '522f5b76e572acfd3d1139205f5040de3a339a6c8ded69dd54c46867273ceb8ab867382fd9c725bf', 0, '2020-07-02 14:25:43'),
('7091a141c6b67965a2433252480d720bbac281f722597fbcf8f7b386619c6366a578abc0fdd3370e', 'f73d62449517472e3b8df2461751f92234c28590fb936e014274ee380a7e13cd88685287b0437cc1', 0, '2020-06-08 14:09:46'),
('7397a4d8e516dc54b041d95dc72cc8b0596b7c8dadc42c2bb950a9d8bd84c5cede63649842404fbe', '2c8ffccc530c5a26ef7955fce6b1f22981975156611e9b063564cae1b4171dc5cea088ef587da3fc', 0, '2020-08-03 20:35:38'),
('84a91dbc9bd510d0318420f613407f45e58080b2528fb85e0cacf614140b1efb17b799f5a5c38178', '2cfbf531575b3f863252e76c23e63e299e97640da27cda12dcda33307db4b8c9ce506b5e260ed75b', 0, '2020-06-26 10:30:59'),
('84b31a9f8b150d38b2bcdd4e420b832a5d0643fed2a7ab3e210710100c964da86c9852054af55238', '850b7e2250b24715ef7792eb058fd13a34dbb9c5e3546bcf20ac89357c6ac14fd44fbaf8605c9baf', 0, '2020-06-26 10:29:37'),
('9aada51eb13a3687292c5a53641180e87e7c16712f0c585444b0277ab5bf5a76be594e9a9ec2981a', 'b220966a74f9ab36f0feabe2d985c8fb592bff2ff88c7a5dc7061475b144d41e7baf18e2f7366deb', 0, '2020-06-08 13:56:12'),
('9e262fdb9acfeeddb5a8ebbd7bb5b0bbcfc4bac9a398637a3a577f1d01f63b9cc35096e14fcf10d6', '3e829c51bec7631aeff097c0ef3bef3c781622c940a8cf19070f68474653dde6d1ea9d0e0fb5137f', 0, '2020-06-08 13:56:36'),
('a4e090a1bc33401b99941f0e161e5ae6ca299489246d3a32dade11089dda033e09404537f15e3ae5', '6728d4bf911f619f21c4d2535996ca86272cd89335ac7f0bd3c39552141e50da4c5333535c529f29', 0, '2020-04-30 10:28:10'),
('aa61eefb9bde8451b1c9d094957f3267f67b91cd0a7490ccde5ae92689e1d757e7bf02b9eca5ec90', '6df237bfa4212e78307cb27bccb22aae533050b0ac5a155918bd71caba97728668c04d2dbcf50334', 0, '2020-06-07 12:29:08'),
('aee218de1de65b482548c1dfc494567bb360c5cfc69437d48450c07b07e9e72f24253b6060bacaaf', '8d9d5fe2b778c6f4cc94d9cd02bdff0acd8e7f59fe756d2b66a64de3ea211066b3af60929306ff53', 0, '2020-06-08 13:57:46'),
('b67d9046a7ca692484117499571b3bc2aeba8cc1199f8f3570c9a137ad2d02302d9c424740b2f30a', 'ded9854981627db6e15f33a050c29082cb89b436c60a9a663ec6fe997cb3137c70dab2ae47d4489d', 0, '2020-06-08 13:55:47'),
('b99e073cf1d70b66e30f1a7d2ffc3b058a49e1ecba6a7bcc7459ced962b17e876db1a23e357e5f10', 'ac067410c591347a260fb4a52cf1f1f7e74c1bbe8d934735683c3bc023c50ada56356c6b0ade43b0', 0, '2020-06-08 13:52:26'),
('bc6377cdad8242402c50571ca047cbc5833a5742dcb5da5dfc215d2a28e66cb975f92fdd1656e9c1', '7878418cfca1bbf8a44edc94a9501354c29b169111dfcb203d56056dcbd75b45acd1fb2683dc73a8', 0, '2020-08-02 10:35:01'),
('bc6c1ccf6fc75505692e10e07632cacb647533c7a77b86067fcee1a0913fc5b7a52a57d6334fae4f', '5862aa9178dac15a49b5105d3ca9d83b3d8bda7351693e9a57470911d4b541e7c1b6cf7297016f74', 0, '2020-07-22 13:05:06'),
('c2bbd1bf72be06fbe710156f64f4eff4d1fa5781a2c627e28a144d4aec5aedcda1bb5390dce11500', '0580b0f7395bdec6acbee86a03e2ba46f2ace3b7eefe992c231bfd3d109369a84663c81ed2a9cfc2', 0, '2020-07-02 14:24:22'),
('c3ea603c924a7846c56f0d66091577894e21be01843f0982ebaf3b91740dfb4549f162c929fef643', 'b974ba88416d96a9e36993a08387cadcc1e5f1322cebe9a4e492c51431ac115cb9f346596d95551b', 0, '2020-04-30 10:29:46'),
('caeef50e6467a5eb0cf139642832a74a182d61c31f6187cdf98d62c18afcbb7d32825e10fa6437fa', 'dea369adb125b444c5aac4815f55145fa5c3dc9bb5e0a18be3778c619b9f26828784a15015634de9', 0, '2020-05-13 17:40:32'),
('cf9563a7b68b99013c9329c817d79d0cc2adb2c258e4ce00d611850a38314fb87596890234447e73', '339aeb0beaf3e43e628f8f716eaa5df460c7efd0a47404a46ed389bcad6b20b8c653a3c97402e3d0', 0, '2020-07-24 10:11:18'),
('d26928c3f29596b061a9d8209d527a25ad3748c03585786b0f272ea8cc55a26ede7adec85cb5f626', '3c4b804c04559c05fee6917899c5bd73507c0bf3b82e9866398e94e688033fa16880b6bf2021116f', 0, '2020-07-02 16:56:37'),
('d97dab9729f7a26226b09728944d64eae41def4e85dfce76e8548b41e3cd12ce421a6d7edb5cb81f', '2d8178c3796e28ba3b13edfc02367b8a54962f192b013c9bc00b265656091a77dcbde93cf7f6b1aa', 0, '2020-07-24 10:11:17'),
('ddc024bbd6e4f1ff765ce6b60c7061a6807e4d73e5cc4346c91bd871430af55b6d6214da35d42685', 'b7237b4d9dcc0de8bb1c425e50871eeef6119526358cd6a76dbc031048b75684c05617929575ebd4', 0, '2020-05-13 18:15:47'),
('e78f7e38faf3c7bb80cc01dc3c3a4a097c919c8668dd92518cd848e5a2e088abe3ff5db33a1b391f', '8dddd6bd43ee34ff2d47f49d65e61314919980f4b5eb6119088d00c093207586c2c1c638d1a5f275', 0, '2020-08-01 11:36:40'),
('e925bf4c9e61ab7dfbd3696280ff6daee870e22e5ddd2516c6ef82e20275f26ba003e5f9538c1dd1', '0c66daadc4ca2d9b3c16c9e515d61428fa4a9406c6acf0c710b0cecb13e7d5f039a36221bf5b93be', 0, '2020-06-08 13:54:52'),
('edb66f28c1453a14d093471025ce2d2529bbea6cc22d0db59499830e9194a7d2422a98f5d8512ff9', '497e55ea6f98266ceaaca2efabd224841d7522902422142a871ea7f33e9af827f99d27c4bcfc17a2', 0, '2020-06-15 11:44:25'),
('f7060ebe746fb47f0eb47680ba7c8d23a792db6fb838a919d4ffc072013c549135befe6776155003', 'bcf248e0c05647638721059efc4d0caf39bbfa3a5e3db2cf2c32e8766636044e0f3eaa84fe56b2e2', 0, '2020-06-08 14:04:36'),
('f74c398be30a51b8df296142dd831edb8a6126d5a06d8ecb0277aebc12eb406a24bcd9c89b344f87', '6e3ba8f3f1b52919e4962890256b41287beb6641cc2a1b03cee0ff139300533f942f94749cc87ab9', 0, '2020-06-28 12:07:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspasos`
--

CREATE TABLE `traspasos` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `origen` int(5) NOT NULL,
  `destino` varchar(25) NOT NULL,
  `recibe` varchar(60) NOT NULL,
  `edit` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `tarjeta`, `area`, `tipo`, `activo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fernando', 'cf_fernandez@hotmail.com', '$2y$10$2uMTlTr3pKT5IeE7bL241eVG2I0.04j3r2ftBm2vCfemskQt9x2GK', '1370010000003023991', -3, 3, 1, NULL, '2018-09-26 18:29:58', '2019-07-02 22:38:55'),
(2, 'bladi', 'bladi@email.com', '$2y$10$PJ0Hrtok50DUaNjNhqKBMuoqdg9Tt1XPP1QoGrniMazANYNiCGLUO', '0210010000001070991', -3, 3, 1, NULL, '2019-01-08 19:00:10', '2019-07-02 21:06:39'),
(3, 'rico', 'rico@gmail.com', '$2y$10$kHDg7wWFOHjCoiWLBsQTCuGCGANK3uVCRMGSGrKCY.8P/oLMkWdke', NULL, 2, 5, 1, NULL, '2019-01-09 16:21:20', '2019-06-08 21:04:44'),
(4, 'raul', 'raul@we', '$2y$10$DJt6N/kxuIBgyfJb1qbdku1mqYHGkmRmxrvNNuYZc0crO.qREC.fS', NULL, 4, 6, 0, NULL, '2019-01-09 17:14:26', '2019-04-26 20:33:05'),
(5, 'rodrigo', 'rodrigo@gmail.com', '$2y$10$ao7J5.DEfhqrtn6S9B0u4ui3rBwpQg1fPlvFTo1oJ8wOj6BngWxL2', NULL, 1, 4, 1, NULL, '2019-04-26 20:40:57', '2019-04-26 20:40:57'),
(6, 'rodrigo', 'rodrigo2@gmail.com', '$2y$10$2VyzwC3nJ1zNu4bsp1GTmeUoLtD/0yrQVbEZ6rfsfNvvJWwBddqVy', NULL, 2, 5, 1, NULL, '2019-04-26 20:47:13', '2019-04-26 20:47:13'),
(7, 'rico', 'rico@hotmail.com', '$2y$10$2RJz1D41vGRWjWflsl3yXuPmIB22VKFuRetKnZtXzcy3Xy5nBMuaW', ';1370010000003023=991?', 3, 6, 1, NULL, '2019-04-30 17:27:34', '2019-06-26 17:30:50'),
(8, 'rico', 'rodrigotrash6@gmail.com', '$2y$10$44x7MWymUviD1b8ltyXAsOz/znJXhkWde.XBGfUW60v2OTNpwqdJi', NULL, 2, 5, 1, NULL, '2019-06-07 20:49:51', '2019-06-07 20:49:51'),
(9, 'gina', 'gina@papas.com', '$2y$10$qMgwVOwHfnUloUIBlRn0ZejZMxpnxF7hcEIq65m9A.IdWtmWkR4bm', 'ñ0210010000001070¿991_', -3, 3, 1, NULL, '2019-06-07 22:42:41', '2019-06-08 00:05:08'),
(10, 'rodrigo', 'rodrigo.coronel.14@gmail.com', '$2y$10$d1GObxw6mg0DsCgH0F5x2.eTHo1/sJzQx.7KLbq/fVdt5Aq.RRoCW', '123132', -3, 3, 1, NULL, '2019-06-07 23:05:36', '2019-06-07 23:53:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `botella`
--
ALTER TABLE `botella`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `folio` (`folio`);

--
-- Indices de la tabla `lista_movimientos`
--
ALTER TABLE `lista_movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `traspasos`
--
ALTER TABLE `traspasos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacenes`
--
ALTER TABLE `almacenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `botella`
--
ALTER TABLE `botella`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `lista_movimientos`
--
ALTER TABLE `lista_movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `traspasos`
--
ALTER TABLE `traspasos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
