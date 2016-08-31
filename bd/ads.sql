-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2016 at 07:23 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ads`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `locality_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8_unicode_ci,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `locality_id` int(11) DEFAULT NULL,
  `subcategory_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `announceId` bigint(20) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `negotiable` tinyint(1) NOT NULL,
  `post` datetime DEFAULT NULL,
  `path` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `slug`, `description`, `icon`) VALUES
(1, 'Automobiles', 'automobiles', 'Descripcion categoria automobiles', NULL),
(2, 'Servicios', 'servicios', 'Descripcion categoria servicios', NULL),
(3, 'Ventas', 'ventas', 'Descripcion categoria ventas', NULL),
(4, 'Propiedades', 'propiedades', 'Descripcion categoria propiedades', NULL),
(5, 'Aprendizaje', 'aprendizaje', 'Descripcion categoria aprendizaje', NULL),
(6, 'Trabajo', 'trabajo', 'Descripcion categoria trabajo', NULL),
(7, 'Mascotas', 'mascotas', 'Descripcion categoria mascotas', NULL),
(8, 'Comunidad', 'comunidad', 'Descripcion categoria comunidad', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `slug`) VALUES
(1, 'Cuba', 'cuba');

-- --------------------------------------------------------

--
-- Table structure for table `locality`
--

CREATE TABLE `locality` (
  `id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `locality`
--

INSERT INTO `locality` (`id`, `state_id`, `name`, `slug`, `postal_code`) VALUES
(1, 1, 'Consolación del Sur', 'consolacion-sur', '1234'),
(2, 1, 'Guane', 'guane', '1234'),
(3, 1, 'La Palma', 'la-palma', '1234'),
(4, 1, 'Los Palacios', 'los-palacios', '1234'),
(5, 1, 'Mantua', 'mantua', '1234'),
(6, 1, 'Minas de Matahambre', 'minas-matahambre', '1234'),
(7, 1, 'Pinar del Río', 'pinar-del-rio', '1234'),
(8, 1, 'San Juan y Martínez', 'san-juan-martinez', '1234'),
(9, 1, 'San Luis', 'san-luis', '1234'),
(10, 1, 'Sandino', 'sandino', '1234'),
(11, 1, 'Vinales', 'vinales', '1234'),
(12, 2, 'Alquízar', 'alquizar', '1234'),
(13, 2, 'Artemisa', 'artemisa', '1234'),
(14, 2, 'Bauta', 'bauta', '1234'),
(15, 2, 'Caimito', 'caimito', '1234'),
(16, 2, 'Guanajay', 'guanajay', '1234'),
(17, 2, 'Güira de Melena', 'guira-melena', '1234'),
(18, 2, 'Mariel', 'mariel', '1234'),
(19, 2, 'San Antonio de los Baños', 'san-antonio-banos', '1234'),
(20, 2, 'Candelaria', 'candelaria', '1324'),
(21, 2, 'San Cristóbal', 'san-cristobal', '1234'),
(22, 2, 'Bahía Honda', 'bahia-honda', '1234'),
(23, 3, 'Arroyo Naranjo', 'arroyo-naranjo', '1234'),
(24, 3, 'Boyeros', 'boyeros', '1234'),
(25, 3, 'Centro Habana', 'centro-habana', '1234'),
(26, 3, 'Cerro', 'cerro', '1234'),
(27, 3, 'Cotorro', 'cotorro', '1234'),
(28, 3, 'Diez de Octubre', 'diez-octubre', '1234'),
(29, 3, 'Guanabacoa', 'guanabacoa', '1234'),
(30, 3, 'La Habana del Este', 'habana-este', '1234'),
(31, 3, 'La Habana Vieja', 'habana-vieja', '1234'),
(32, 3, 'La Lisa', 'la-lisa', '1234'),
(33, 3, 'Marianao', 'marianao', '1234'),
(34, 3, 'Playa', 'playa', '1234'),
(35, 3, 'Plaza de la Revolución', 'plaza-revolucion', '1234'),
(36, 3, 'Regla', 'regla', '1234'),
(37, 3, 'San Miguel del Padrón', 'san-miguel-padron', '1234'),
(38, 4, 'Batabanó', 'batabano', '1234'),
(39, 4, 'Bejucal', 'bejucal', '1234'),
(40, 4, 'Güines', 'guines', '1234'),
(41, 4, 'Jaruco', 'jaruco', '1234'),
(42, 4, 'Madruga', 'madruga', '1234'),
(43, 4, 'Melena del Sur', 'melena-sur', '1234'),
(44, 4, 'Nueva Paz', 'nueva-paz', '1234'),
(45, 4, 'Quivicán', 'quivican', '1234'),
(46, 4, 'San José de las Lajas', 'san-jose-lajas', '1234'),
(47, 4, 'San Nicolás', 'san-nicolas', '1234'),
(48, 4, 'Santa Cruz del Norte', 'santa-cruz-norte', '1234'),
(49, 5, 'Calimete', 'calimete', '1234'),
(50, 5, 'Cárdenas', 'cardenas', '1234'),
(51, 5, 'Ciénaga de Zapata', 'cienaga-zapata', '1234'),
(52, 5, 'Colón', 'colon', '1234'),
(53, 5, 'Jagüey Grande', 'jaguey-grande', '1234'),
(54, 5, 'Jovellanos', 'jovellanos', '1234'),
(55, 5, 'Limonar', 'limonar', '1234'),
(56, 5, 'Los Arabos', 'los-arabos', '1234'),
(57, 5, 'Martí', 'marti', '1234'),
(58, 5, 'Matanzas', 'matanzas', '1234'),
(59, 5, 'Pedro Betancourt', 'pedro-betancourt', '1234'),
(60, 5, 'Perico', 'perico', '1234'),
(61, 5, 'Unión de Reyes', 'union-reyes', '1234'),
(62, 5, 'Varadero', 'varadero', '1234'),
(63, 6, 'Abreus', 'abreus', '1234'),
(64, 1, 'Aguada de Pasajeros', 'aguada-pasajeros', '1234'),
(65, 6, 'Cienfuegos', 'cienfuegos', '1234'),
(66, 6, 'Cruces', 'cruces', '1234'),
(67, 6, 'Cumanayagua', 'cumanayagua', '1234'),
(68, 6, 'Lajas', 'lajas', '1234'),
(69, 6, 'Palmira', 'palmira', '1234'),
(70, 6, 'Rodas', 'rodas', '1234'),
(71, 7, 'Caibarién', 'caibarien', '1234'),
(72, 7, 'Camajuaní', 'camajuani', '1234'),
(73, 7, 'Cifuentes', 'cifuentes', '1234'),
(74, 7, 'Corralillo', 'corralillo', '1234'),
(75, 7, 'Encrucijada', 'encrucijada', '1234'),
(76, 7, 'Manicaragua', 'manicaragua', '1234'),
(77, 7, 'Placetas', 'placetas', '1234'),
(78, 7, 'Quemado de Güines', 'quemado-guines', '1234'),
(79, 7, 'Ranchuelo', 'ranchuelo', '1234'),
(80, 7, 'San Juan de los Remedios', 'san-juan-remedios', '1234'),
(81, 7, 'Sagua la Grande', 'sagua-grande', '1234'),
(82, 7, 'Santo Domingo', 'santo-domingo', '1234'),
(83, 8, 'Cabaiguán', 'cabaiguan', '1234'),
(84, 8, 'Fomento', 'fomento', '1234'),
(85, 8, 'Jatibonico', 'jatibonico', '1234'),
(86, 8, 'La Sierpe', 'la-sierpe', '1234'),
(87, 8, 'Sancti Spíritus', 'sancti-spiritus', '1234'),
(88, 8, 'Taguasco', 'taguasco', '1234'),
(89, 8, 'Trinidad', 'trinidad', '1234'),
(90, 8, 'Yaguajay', 'yaguajay', '1234'),
(91, 9, 'Baraguá', 'baragua', '1234'),
(92, 9, 'Bolivia', 'bolivia', '1234'),
(93, 9, 'Chambas', 'chambas', '1234'),
(94, 9, 'Ciego de Avila', 'ciego-avila', '1234'),
(95, 9, 'Ciro Redondo', 'ciro-redondo', '1234'),
(96, 9, 'Florencia', 'florencia', '1234'),
(97, 9, 'Majagua', 'majagua', '1234'),
(98, 9, 'Morón', 'moron', '1234'),
(99, 9, 'Primero de Enero', 'primero-enero', '1234'),
(100, 9, 'Venezuela', 'venezuela', '1234'),
(101, 10, 'Camagüey', 'camaguey', '1234'),
(102, 10, 'Carlos M. de Céspedes', 'carlos-cespedes', '1234'),
(103, 10, 'Esmeralda', 'esmeralda', '1234'),
(104, 10, 'Florida', 'florida', '1234'),
(105, 10, 'Guáimaro', 'guaimaro', '1234'),
(106, 10, 'Jimaguayú', 'jimaguayu', '1234'),
(107, 10, 'Minas', 'minas', '1234'),
(108, 10, 'Najasa', 'najasa', '1234'),
(109, 10, 'Nuevitas', 'nuevitas', '1234'),
(110, 10, 'Santa Curz del Sur', 'santa-cruz-sur', '1234'),
(111, 10, 'Sibanicú', 'sibanicu', '1234'),
(112, 10, 'Sierra de Cubitas', 'sierra-cubitas', '1234'),
(113, 10, 'Vertientes', 'vertientes', '1234'),
(114, 11, 'Amancio', 'amancio', '1234'),
(115, 11, 'Colombia', 'colombia', '1234'),
(116, 11, 'Jesús Menéndez', 'jesus-menendez', '1234'),
(117, 11, 'Jobabo', 'jobabo', '1234'),
(118, 11, 'Majibacoa', 'majibacoa', '1234'),
(119, 11, 'Manatí', 'manati', '1234'),
(120, 11, 'Puerto Padre', 'puerto-padre', '1234'),
(121, 11, 'Las Tunas', 'las-tunas', '1234'),
(122, 12, 'Antilla', 'antilla', '1234'),
(123, 12, 'Báguanos', 'baguanos', '1234'),
(124, 12, 'Banes', 'banes', '1234'),
(125, 12, 'Cacocum', 'cacocum', '1234'),
(126, 12, 'Calixto García', 'calixto-garcia', '1234'),
(127, 12, 'Cueto', 'cueto', '1234'),
(128, 12, 'Frank País', 'frank-pais', '1234'),
(129, 12, 'Gibara', 'gibara', '1234'),
(130, 12, 'Holguín', 'holguin', '1234'),
(131, 12, 'Mayarí', 'mayari', '1234'),
(132, 12, 'Moa', 'moa', '1234'),
(133, 12, 'Rafael Freyre', 'rafael-freyre', '1234'),
(134, 12, 'Sagua de Tánamo', 'sagua-tanamo', '1234'),
(135, 12, 'Urbano Noris', 'urbano-noris', '1234'),
(136, 13, 'Bartolomé Masó', 'bartolome-maso', '1234'),
(137, 13, 'Bayamo', 'bayamo', '1234'),
(138, 13, 'Buey Arriba', 'buey-arriba', '1234'),
(139, 13, 'Campechuela', 'campechuela', '1234'),
(140, 13, 'Cauto Cristo', 'cauto-cristo', '1234'),
(141, 13, 'Guisa', 'guisa', '1234'),
(142, 13, 'Jiguaní', 'jiguani', '1234'),
(143, 13, 'Manzanillo', 'manzanillo', '1234'),
(144, 13, 'Media Luna', 'media-luna', '1234'),
(145, 13, 'Niquero', 'niquero', '1234'),
(146, 13, 'Pilón', 'pilon', '1234'),
(147, 13, 'Río Cauto', 'rio-cauto', '1234'),
(148, 13, 'Yara', 'yara', '1234'),
(149, 14, 'Contramaestre', 'contramaestre', '1234'),
(150, 14, 'Guama', 'guama', '1234'),
(151, 14, 'Mella', 'mella', '1234'),
(152, 14, 'Palma Soriano', 'palma-soriano', '1234'),
(153, 14, 'San Luis', 'san-luis', '1234'),
(154, 14, 'Santiago de Cuba', 'santiago-cuba', '1234'),
(155, 14, 'Segundo Frente', 'segundo-frente', '1234'),
(156, 14, 'Songo la Maya', 'songo-maya', '1234'),
(157, 14, 'Tercer Frente', 'tercer-frente', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `abrev` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `name`, `slug`, `abrev`) VALUES
(1, 1, 'Pinar del Rio', 'pinar-rio', 'Pr'),
(2, 1, 'Artemisa', 'artemisa', 'Ar'),
(3, 1, 'Ciudad Habana', 'ciudad-habana', 'Ch'),
(4, 1, 'Mayabeque', 'mayabeque', 'My'),
(5, 1, 'Matanzas', 'matanzas', 'Mtz'),
(6, 1, 'Cienfuegos', 'cienfuegos', 'Cf'),
(7, 1, 'Villa Clara', 'villa-clara', 'Vc'),
(8, 1, 'Sancti Spíritus', 'sancti-spiritus', 'Ss'),
(9, 1, 'Ciego de Avila', 'ciego-avila', 'Cav'),
(10, 1, 'Camagüey', 'camaguey', 'Ca'),
(11, 1, 'Las Tunas', 'las-tunas', 'Lt'),
(12, 1, 'Holguín', 'holguin', 'H'),
(13, 1, 'Granma', 'granma', 'Gr'),
(14, 1, 'Santiago de Cuba', 'santiago-cub', 'Sc');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` bigint(20) NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `category_id`, `parent_id`, `name`, `slug`, `description`) VALUES
(1, 1, 1, 'Carros, Partes y Accesorios', 'carros-partes-accesorios', 'Description subcategoria Partes de Carros y Accesorios'),
(2, 1, 2, 'Motos, Partes y Accesorios', 'motos-partes-accesorios', 'Descripcion de categoria Motos, Partes y Accesorios');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `iam` tinyint(1) DEFAULT NULL,
  `cel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D4E6F8188823A92` (`locality_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`announceId`),
  ADD KEY `IDX_E6D6DD7588823A92` (`locality_id`),
  ADD KEY `IDX_E6D6DD755DC6FE57` (`subcategory_id`),
  ADD KEY `IDX_E6D6DD75A76ED395` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `UNIQ_64C19C1989D9B62` (`slug`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locality`
--
ALTER TABLE `locality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E1D6B8E65D83CC1` (`state_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A393D2FBF92F3E70` (`country_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD UNIQUE KEY `UNIQ_DDCA448989D9B62` (`slug`),
  ADD KEY `IDX_DDCA44812469DE2` (`category_id`),
  ADD KEY `IDX_DDCA448727ACA70` (`parent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `announceId` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `locality`
--
ALTER TABLE `locality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_D4E6F8188823A92` FOREIGN KEY (`locality_id`) REFERENCES `locality` (`id`);

--
-- Constraints for table `announce`
--
ALTER TABLE `announce`
  ADD CONSTRAINT `FK_E6D6DD755DC6FE57` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`subcategory_id`),
  ADD CONSTRAINT `FK_E6D6DD7588823A92` FOREIGN KEY (`locality_id`) REFERENCES `locality` (`id`),
  ADD CONSTRAINT `FK_E6D6DD75A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `locality`
--
ALTER TABLE `locality`
  ADD CONSTRAINT `FK_E1D6B8E65D83CC1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `FK_A393D2FBF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `FK_DDCA44812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `FK_DDCA448727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `subcategory` (`subcategory_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
