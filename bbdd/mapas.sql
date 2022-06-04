-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2022 at 05:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `mapas`
--

-- --------------------------------------------------------

--
-- Table structure for table `parcelas`
--

CREATE TABLE `parcelas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `color` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcelas`
--

INSERT INTO `parcelas` (`id`, `nombre`, `color`) VALUES
(1, 'Parcela nº1', 'FF8000'),
(2, 'Parcela nº2', 'F44336'),
(3, 'Parcela nº3', '2196F3'),
(4, 'Parcela nº4', 'FFF300');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` enum('admin','user','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `email`, `rol`) VALUES
(1, 'usuario', '1234', 'enriquepv@gmail.com', 'user'),
(2, 'usuario2', '1234', 'luisgg@gmail.com', 'user'),
(3, 'admin', '1234', 'admin1234@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_parcelas`
--

CREATE TABLE `usuarios_parcelas` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `parcela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios_parcelas`
--

INSERT INTO `usuarios_parcelas` (`id`, `usuario`, `parcela`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `vertices`
--

CREATE TABLE `vertices` (
  `id` int(11) NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lng` decimal(10,7) NOT NULL,
  `parcela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vertices`
--

INSERT INTO `vertices` (`id`, `lat`, `lng`, `parcela`) VALUES
(1, '38.9981639', '-0.1720151', 1),
(2, '38.9979802', '-0.1715208', 1),
(3, '38.9965934', '-0.1721850', 1),
(4, '38.9969109', '-0.1729598', 1),
(5, '38.9983908', '-0.1785001', 2),
(6, '38.9979107', '-0.1774030', 2),
(7, '38.9969825', '-0.1779657', 2),
(8, '38.9969494', '-0.1783175', 2),
(9, '38.9975874', '-0.1795887', 2),
(10, '38.9924270', '-0.1713474', 3),
(11, '38.9927512', '-0.1694416', 3),
(12, '38.9915003', '-0.1684759', 3),
(13, '38.9910870', '-0.1709218', 3),
(14, '38.9972600', '-0.1696990', 4),
(15, '38.9965630', '-0.1677000', 4),
(16, '38.9957150', '-0.1697640', 4),
(17, '38.9957320', '-0.1702940', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_parcelas_con_vertices`
-- (See below for the actual view)
--
CREATE TABLE `vista_parcelas_con_vertices` (
`id` int(11)
,`nombre` varchar(60)
,`color` varchar(6)
,`lat` decimal(10,7)
,`lng` decimal(10,7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_propiedad_parcelas`
-- (See below for the actual view)
--
CREATE TABLE `vista_propiedad_parcelas` (
`usuario` int(11)
,`parcela` int(11)
,`nombre_parcela` varchar(60)
,`color` varchar(6)
,`nombre_usuario` varchar(60)
);

-- --------------------------------------------------------

--
-- Structure for view `vista_parcelas_con_vertices`
--
DROP TABLE IF EXISTS `vista_parcelas_con_vertices`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_parcelas_con_vertices`  AS SELECT `parcelas`.`id` AS `id`, `parcelas`.`nombre` AS `nombre`, `parcelas`.`color` AS `color`, `vertices`.`lat` AS `lat`, `vertices`.`lng` AS `lng` FROM (`parcelas` join `vertices` on(`parcelas`.`id` = `vertices`.`parcela`))  ;

-- --------------------------------------------------------

--
-- Structure for view `vista_propiedad_parcelas`
--
DROP TABLE IF EXISTS `vista_propiedad_parcelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_propiedad_parcelas`  AS SELECT `usuarios_parcelas`.`usuario` AS `usuario`, `usuarios_parcelas`.`parcela` AS `parcela`, `parcelas`.`nombre` AS `nombre_parcela`, `parcelas`.`color` AS `color`, `usuarios`.`nombre` AS `nombre_usuario` FROM ((`usuarios_parcelas` join `parcelas` on(`parcelas`.`id` = `usuarios_parcelas`.`parcela`)) join `usuarios` on(`usuarios`.`id` = `usuarios_parcelas`.`usuario`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios_parcelas`
--
ALTER TABLE `usuarios_parcelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_parcela_usuario` (`usuario`),
  ADD KEY `fk_usuario_parcela_parcela` (`parcela`);

--
-- Indexes for table `vertices`
--
ALTER TABLE `vertices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vertice_parcela` (`parcela`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios_parcelas`
--
ALTER TABLE `usuarios_parcelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vertices`
--
ALTER TABLE `vertices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuarios_parcelas`
--
ALTER TABLE `usuarios_parcelas`
  ADD CONSTRAINT `fk_usuario_parcela_parcela` FOREIGN KEY (`parcela`) REFERENCES `parcelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_parcela_usuario` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vertices`