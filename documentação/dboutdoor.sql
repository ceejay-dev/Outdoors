-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Jul-2023 às 10:58
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dboutdoor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluguer`
--

CREATE TABLE `aluguer` (
  `fk_cliente` int(11) NOT NULL,
  `numeroPedidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `tipo` enum('particular','empresa') NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `comuna` varchar(20) DEFAULT NULL,
  `nacionalidade` int(11) DEFAULT NULL,
  `morada` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `username` varchar(40) NOT NULL,
  `passe` varchar(255) NOT NULL,
  `estado` enum('ativo','inativo') DEFAULT NULL,
  `fk_usuarioC` int(11) DEFAULT NULL,
  `atividade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nome`, `tipo`, `provincia`, `municipio`, `comuna`, `nacionalidade`, `morada`, `email`, `telefone`, `username`, `passe`, `estado`, `fk_usuarioC`, `atividade`) VALUES
(1, 'Asafe Silva', 'particular', 'Bengo', 'Ambriz', 'Ambriz', 2, 'Kilamba', 'asafe@utec.com', '123456789', 'asafe', '123', 'ativo', 3, NULL),
(2, 'Melanie Pereira', 'particular', 'Bengo', 'Ambriz', 'Ambriz', 2, 'Talatona', 'mel@utec.co.ao', '123456778', 'mele', '1234', 'ativo', 4, 'nenhuma'),
(3, 'Helpidio Mateus', 'particular', 'Benguela', 'Baía Farta', 'Beira-Alta', 3, 'Morro Bento', 'helpidio@utec.co.ao', '9333333', 'helafame', '123', 'ativo', 5, NULL),
(4, 'Jackson Junior ', 'particular', 'Bengo', 'Ambriz', 'Ambriz', 4, 'Morro Bento ', '20201076@isptec.co.ao', '123456789', 'manjack', '123', 'inativo', 7, NULL),
(6, 'Elber', 'particular', 'Bengo', 'Ambriz', 'Ambriz', 1, 'Morro Bento', '20190444@isptec.co.ao', '99999', 'ribery', '123', 'inativo', 11, NULL),
(7, 'Zulmira Bernardo', 'particular', 'Bengo', 'Ambriz', 'Ambriz', 35, 'Kifica', 'zulo@utec.com', '3512355335', 'zulo', '123', 'ativo', 12, NULL),
(13, 'Cátia Adão', 'empresa', 'Benguela', 'Baía Farta', 'Beira-Alta', 2, 'Cazenga', 'catia@utec.co.ao', '934444444', 'catia', '123', 'ativo', 20, 'Informática'),
(15, 'Jedivânia Feliciano ', 'empresa', 'Bengo', 'Ambriz', 'Ambriz', 2, 'Camama', 'jedivania@gmail.com', '934811111', 'jedis', '123', 'ativo', 22, 'Musica');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comunas`
--

CREATE TABLE `comunas` (
  `idComuna` int(11) NOT NULL,
  `nomeCom` varchar(20) DEFAULT NULL,
  `fk_municipio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `comunas`
--

INSERT INTO `comunas` (`idComuna`, `nomeCom`, `fk_municipio`) VALUES
(1, 'Ambriz', 1),
(2, 'Bengo', 1),
(3, 'Dange-Quitexe', 1),
(4, 'Kicabo', 1),
(5, 'Massabi', 1),
(6, 'Bula Atumba', 2),
(7, 'Caxito', 2),
(8, 'Gombe', 2),
(9, 'Kissomeira', 2),
(10, 'Quibaxe', 2),
(11, 'Barra do Dande', 3),
(12, 'Kicabo', 3),
(13, 'Mabubas', 3),
(14, 'Muxaluando', 3),
(15, 'Quixico', 3),
(16, 'Baía Farta', 4),
(17, 'Benguela', 4),
(18, 'Caimbambo', 4),
(19, 'Catumbela', 4),
(20, 'Ganda', 4),
(21, 'Balombo', 5),
(22, 'Baúnde', 5),
(23, 'Bocoio', 5),
(24, 'Cunhinga', 5),
(25, 'Maca', 5),
(26, 'Benguela', 6),
(27, 'Caála', 6),
(28, 'Calohanga', 6),
(29, 'Cavaco', 6),
(30, 'Chingongo', 6),
(31, 'Andulo', 7),
(32, 'Camacupa', 7),
(33, 'Catabola', 7),
(34, 'Chinguar', 7),
(35, 'Chitembo', 7),
(36, 'Cuemba', 7),
(37, 'Cunhinga', 7),
(38, 'Cuito', 7),
(39, 'Cunje', 7),
(40, 'Nharea', 7),
(41, 'Calucinga', 8),
(42, 'Cangandala', 8),
(43, 'Cunhinga', 8),
(44, 'Cunje', 8),
(45, 'Gamba', 8),
(46, 'Belize', 9),
(47, 'Buco-Zau', 9),
(48, 'Cabinda', 9),
(49, 'Cacongo', 9),
(50, 'Caio Litoral', 9),
(51, 'Necuto', 9),
(52, 'Landana', 9),
(53, 'Talatona', 9),
(54, 'Lândana', 9),
(55, 'Miconje', 9),
(56, 'Beira-Alta', 10),
(57, 'Miconje', 10),
(58, 'Necuto', 10),
(59, 'Caio Litoral', 10),
(60, 'Buco-Zau', 10),
(61, 'Calai', 11),
(62, 'Cuangar', 11),
(63, 'Cuchi', 11),
(64, 'Cuito Cuanavale', 11),
(65, 'Dirico', 11),
(66, 'Longa', 11),
(67, 'Mavinga', 11),
(68, 'Menongue', 11),
(69, 'Nancova', 11),
(70, 'Rivungo', 11),
(71, 'Alto Chicapa', 12),
(72, 'Caiundo', 12),
(73, 'Cuito Cuanavale', 12),
(74, 'Cunjamba', 12),
(75, 'Cutato', 12),
(76, 'Ambaca', 13),
(77, 'Banga', 13),
(78, 'Bolongongo', 13),
(79, 'Cambambe', 13),
(80, 'Dondo', 13),
(81, 'Golungo Alto', 13),
(82, 'Lucala', 13),
(83, 'Quiculungo', 13),
(84, 'Samba Caju', 13),
(85, 'Uíge', 13),
(86, 'Camame', 14),
(87, 'Kiwaba Nzoji', 14),
(88, 'Maquela do Zombo', 14),
(89, 'Negage', 14),
(90, 'Puri', 14),
(91, 'Amboim', 15),
(92, 'Cassongue', 15),
(93, 'Cela', 15),
(94, 'Conda', 15),
(95, 'Ebo', 15),
(96, 'Libolo', 15),
(97, 'Mussende', 15),
(98, 'Porto Amboim', 15),
(99, 'Quibala', 15),
(100, 'Sumbe', 15),
(101, 'Babaera', 16),
(102, 'Cacongo', 16),
(103, 'Dumbi', 16),
(104, 'Ebo', 16),
(105, 'Hembe', 16),
(106, 'Cahama', 17),
(107, 'Cuanhama', 17),
(108, 'Curoca', 17),
(109, 'Cuvelai', 17),
(110, 'Namacunde', 17),
(111, 'Ombadja', 17),
(112, 'Ondjiva', 17),
(113, 'Otchinjau', 17),
(114, 'Xangongo', 17),
(115, 'Chitado', 17),
(116, 'Chiedi', 18),
(117, 'Cuaname', 18),
(118, 'Cuangar', 18),
(119, 'Jamba Cueio', 18),
(120, 'Luvuei', 18),
(121, 'Bailundo', 19),
(122, 'Caála', 19),
(123, 'Catchiungo', 19),
(124, 'Chicala-Cholohanga', 19),
(125, 'Chinjenje', 19),
(126, 'Huambo', 19),
(127, 'Londuimbali', 19),
(128, 'Longonjo', 19),
(129, 'Mungo', 19),
(130, 'Tchicala-Tcholohanga', 19),
(131, 'Bailundo', 20),
(132, 'Chipipa', 20),
(133, 'Chiumbo', 20),
(134, 'Ecunha', 20),
(135, 'Huambo', 20),
(136, 'Caconda', 21),
(137, 'Cacula', 21),
(138, 'Caluquembe', 21),
(139, 'Chiange', 21),
(140, 'Chibia', 21),
(141, 'Chicomba', 21),
(142, 'Chipindo', 21),
(143, 'Humpata', 21),
(144, 'Jamba', 21),
(145, 'Lubango', 21),
(146, 'Caluquembe', 22),
(147, 'Cuvango', 22),
(148, 'Humpata', 22),
(149, 'Jamba', 22),
(150, 'Chipindo', 22),
(151, 'Belas', 23),
(152, 'Cacuaco', 23),
(153, 'Cazenga', 23),
(154, 'Icolo e Bengo', 23),
(155, 'Luanda', 23),
(156, 'Quiçama', 23),
(157, 'Quilamba Quiaxi', 23),
(158, 'Quissama', 23),
(159, 'Talatona', 23),
(160, 'Viana', 23),
(161, 'Cabiri', 24),
(162, 'Calumbo', 24),
(163, 'Camama', 24),
(164, 'Kicuxi', 24),
(165, 'Munenga', 24),
(166, 'Cambulo', 25),
(167, 'Capenda Camulemba', 25),
(168, 'Caungula', 25),
(169, 'Chitato', 25),
(170, 'Cuango', 25),
(171, 'Cuílo', 25),
(172, 'Lucapa', 25),
(173, 'Xá-Muteba', 25),
(174, 'Lóvua', 25),
(175, 'Lubalo', 25),
(176, 'Capenda Camulemba', 26),
(177, 'Cassanje', 26),
(178, 'Cuango', 26),
(179, 'Lucapa', 26),
(180, 'Xá-Muteba', 26),
(181, 'Cacolo', 27),
(182, 'Dala', 27),
(183, 'Muconda', 27),
(184, 'Saurimo', 27),
(185, 'Cacungula', 27),
(186, 'Cateco-Cangola', 27),
(187, 'Lumege-Cameia', 27),
(188, 'Cambulo', 27),
(189, 'Luachimo', 27),
(190, 'Luó', 27),
(191, 'Dala', 28),
(192, 'Luengue-Luiana', 28),
(193, 'Muxeque', 28),
(194, 'Nancova', 28),
(195, 'Saurimo', 28),
(196, 'Cacuso', 29),
(197, 'Calandula', 29),
(198, 'Cambundi-Catembo', 29),
(199, 'Cangandala', 29),
(200, 'Caombo', 29),
(201, 'Cassanje', 29),
(202, 'Massango', 29),
(203, 'Milando', 29),
(204, 'Quimbamba', 29),
(205, 'Quiuaba Nzoji', 29),
(206, 'Calumbo', 30),
(207, 'Catepa', 30),
(208, 'Cunda-Dia-Baze', 30),
(209, 'Kalandula', 30),
(210, 'Malanje', 30),
(211, 'Alto Zambeze', 31),
(212, 'Bundas', 31),
(213, 'Camanongue', 31),
(214, 'Léua', 31),
(215, 'Luacano', 31),
(216, 'Luau', 31),
(217, 'Luchazes', 31),
(218, 'Lunda', 31),
(219, 'Moxico', 31),
(220, 'Luena', 31),
(221, 'Alto Zambeze', 32),
(222, 'Bundas', 32),
(223, 'Camanongue', 32),
(224, 'Léua', 32),
(225, 'Luacano', 32),
(226, 'Bibala', 33),
(227, 'Camucuio', 33),
(228, 'Moçâmedes', 33),
(229, 'Tômbwa', 33),
(230, 'Virei', 33),
(231, 'Vire', 33),
(232, 'Praia Amélia', 33),
(233, 'Praia do Tômbua', 33),
(234, 'Praia do Saco', 33),
(235, 'Praia do Curoca', 33),
(236, 'Bentiaba', 34),
(237, 'Namibe', 34),
(238, 'Saco-Mar', 34),
(239, 'Tômbwa', 34),
(240, 'Virei', 34),
(241, 'Ambuila', 35),
(242, 'Bembe', 35),
(243, 'Buengas', 35),
(244, 'Bungo', 35),
(245, 'Damba', 35),
(246, 'Milunga', 35),
(247, 'Mucaba', 35),
(248, 'Negage', 35),
(249, 'Puri', 35),
(250, 'Uíge', 35),
(251, 'Alto Cauale', 36),
(252, 'Bembe', 36),
(253, 'Buengas', 36),
(254, 'Bungo', 36),
(255, 'Damba', 36),
(256, 'Cuimba', 37),
(257, 'M\'banza Congo', 37),
(258, 'Noqui', 37),
(259, 'Nzeto', 37),
(260, 'Soyo', 37),
(261, 'Tomboco', 37),
(262, 'Quiimba', 37),
(263, 'Quinzau', 37),
(264, 'Mpala', 37),
(265, 'N\'zeto', 37),
(266, 'Buela', 38),
(267, 'Cuimba', 38),
(268, 'M\'banza Congo', 38),
(269, 'Noqui', 38),
(270, 'Santo António do Zai', 38);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gestores`
--

CREATE TABLE `gestores` (
  `idGestor` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `comuna` varchar(20) DEFAULT NULL,
  `morada` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `username` varchar(40) NOT NULL,
  `passe` varchar(255) NOT NULL,
  `estado` enum('ativo','inativo') DEFAULT NULL,
  `fk_usuarioG` int(11) DEFAULT NULL,
  `contSolic` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `gestores`
--

INSERT INTO `gestores` (`idGestor`, `nome`, `provincia`, `municipio`, `comuna`, `morada`, `email`, `telefone`, `username`, `passe`, `estado`, `fk_usuarioG`, `contSolic`) VALUES
(1, 'Sara Chiaule', 'Benguela', 'Catumbela', 'Cela', 'Kilamba', 'raquel@utec.co.ao', '123456789', 'quelita', '1234', 'ativo', 2, 2),
(2, 'Avelar Manuel', 'Bengo', 'Ambriz', 'Ambriz', 'Cazenga', 'avelar@utec.com', '934123453', 'velinho', '1234', 'ativo', 6, 3),
(3, 'Lucas Mudile ', 'Bengo', 'Ambriz', 'Ambriz', 'Petrangol', 'mudile@gmail.com', '93985547737', 'mudile', '123', 'ativo', 23, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipios`
--

CREATE TABLE `municipios` (
  `idMunicipio` int(11) NOT NULL,
  `nomeMun` varchar(20) DEFAULT NULL,
  `fk_provincia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `municipios`
--

INSERT INTO `municipios` (`idMunicipio`, `nomeMun`, `fk_provincia`) VALUES
(1, 'Ambriz', 1),
(2, 'Bula Atumba', 1),
(3, 'Dande', 1),
(4, 'Demba Chio', 1),
(5, 'Nambuangongo', 1),
(6, 'Pango Aluquém', 1),
(7, 'Quibaxe', 1),
(8, 'Quicama', 1),
(9, 'Caxito', 1),
(10, 'Baía Farta', 2),
(11, 'Balombo', 2),
(12, 'Benguela', 2),
(13, 'Bocoio', 2),
(14, 'Caimbambo', 2),
(15, 'Catumbela', 2),
(16, 'Chongoroi', 2),
(17, 'Cubal', 2),
(18, 'Ganda', 2),
(19, 'Lobito', 2),
(20, 'Andulo', 3),
(21, 'Camacupa', 3),
(22, 'Catabola', 3),
(23, 'Chinguar', 3),
(24, 'Chitembo', 3),
(25, 'Cuemba', 3),
(26, 'Cunhinga', 3),
(27, 'Cuito', 3),
(28, 'Cunje', 3),
(29, 'Nharea', 3),
(30, 'Belize', 4),
(31, 'Buco-Zau', 4),
(32, 'Cabinda', 4),
(33, 'Cacongo', 4),
(34, 'Caio Litoral', 4),
(35, 'Necuto', 4),
(36, 'Landana', 4),
(37, 'Talatona', 4),
(38, 'Lândana', 4),
(39, 'Miconje', 4),
(40, 'Calai', 5),
(41, 'Cuangar', 5),
(42, 'Cuchi', 5),
(43, 'Cuito Cuanavale', 5),
(44, 'Dirico', 5),
(45, 'Longa', 5),
(46, 'Mavinga', 5),
(47, 'Menongue', 5),
(48, 'Nancova', 5),
(49, 'Rivungo', 5),
(50, 'Ambaca', 6),
(51, 'Banga', 6),
(52, 'Bolongongo', 6),
(53, 'Cambambe', 6),
(54, 'Dondo', 6),
(55, 'Golungo Alto', 6),
(56, 'Lucala', 6),
(57, 'Quiculungo', 6),
(58, 'Samba Caju', 6),
(59, 'Uíge', 6),
(60, 'Amboim', 7),
(61, 'Cassongue', 7),
(62, 'Cela', 7),
(63, 'Conda', 7),
(64, 'Ebo', 7),
(65, 'Libolo', 7),
(66, 'Mussende', 7),
(67, 'Porto Amboim', 7),
(68, 'Quibala', 7),
(69, 'Sumbe', 7),
(70, 'Cahama', 8),
(71, 'Cuanhama', 8),
(72, 'Curoca', 8),
(73, 'Cuvelai', 8),
(74, 'Namacunde', 8),
(75, 'Ombadja', 8),
(76, 'Ondjiva', 8),
(77, 'Otchinjau', 8),
(78, 'Xangongo', 8),
(79, 'Chitado', 8),
(80, 'Bailundo', 9),
(81, 'Caála', 9),
(82, 'Catchiungo', 9),
(83, 'Chicala-Cholohanga', 9),
(84, 'Chinjenje', 9),
(85, 'Huambo', 9),
(86, 'Londuimbali', 9),
(87, 'Longonjo', 9),
(88, 'Mungo', 9),
(89, 'Tchicala-Tcholohanga', 9),
(90, 'Caconda', 10),
(91, 'Cacula', 10),
(92, 'Caluquembe', 10),
(93, 'Chiange', 10),
(94, 'Chibia', 10),
(95, 'Chicomba', 10),
(96, 'Chipindo', 10),
(97, 'Humpata', 10),
(98, 'Jamba', 10),
(99, 'Lubango', 10),
(100, 'Belas', 11),
(101, 'Cacuaco', 11),
(102, 'Cazenga', 11),
(103, 'Icolo e Bengo', 11),
(104, 'Luanda', 11),
(105, 'Quiçama', 11),
(106, 'Quilamba Quiaxi', 11),
(107, 'Quissama', 11),
(108, 'Talatona', 11),
(109, 'Viana', 11),
(110, 'Cambulo', 12),
(111, 'Capenda Camulemba', 12),
(112, 'Caungula', 12),
(113, 'Chitato', 12),
(114, 'Cuango', 12),
(115, 'Cuílo', 12),
(116, 'Lucapa', 12),
(117, 'Xá-Muteba', 12),
(118, 'Lóvua', 12),
(119, 'Lubalo', 12),
(120, 'Cacolo', 13),
(121, 'Dala', 13),
(122, 'Muconda', 13),
(123, 'Saurimo', 13),
(124, 'Cacungula', 13),
(125, 'Cateco-Cangola', 13),
(126, 'Lumege-Cameia', 13),
(127, 'Cambulo', 13),
(128, 'Luachimo', 13),
(129, 'Luó', 13),
(130, 'Cacuso', 14),
(131, 'Calandula', 14),
(132, 'Cambundi-Catembo', 14),
(133, 'Cangandala', 14),
(134, 'Caombo', 14),
(135, 'Cuaba Nzogo', 14),
(136, 'Cuando', 14),
(137, 'Kahombo', 14),
(138, 'Malanje', 14),
(139, 'Massango', 14),
(140, 'Alto Zambeze', 15),
(141, 'Bundas', 15),
(142, 'Camanongue', 15),
(143, 'Léua', 15),
(144, 'Luacano', 15),
(145, 'Luau', 15),
(146, 'Luchazes', 15),
(147, 'Lunda', 15),
(148, 'Moxico', 15),
(149, 'Luena', 15),
(150, 'Bibala', 16),
(151, 'Camucuio', 16),
(152, 'Moçâmedes', 16),
(153, 'Tômbwa', 16),
(154, 'Virei', 16),
(155, 'Vire', 16),
(156, 'Praia Amélia', 16),
(157, 'Praia do Tômbua', 16),
(158, 'Praia do Saco', 16),
(159, 'Praia do Curoca', 16),
(160, 'Ambuila', 17),
(161, 'Bembe', 17),
(162, 'Buengas', 17),
(163, 'Bungo', 17),
(164, 'Damba', 17),
(165, 'Milunga', 17),
(166, 'Mucaba', 17),
(167, 'Negage', 17),
(168, 'Puri', 17),
(169, 'Uíge', 17),
(170, 'Cuimba', 18),
(171, 'Mbanza Congo', 18),
(172, 'Noqui', 18),
(173, 'Nzeto', 18),
(174, 'Soyo', 18),
(175, 'Tomboco', 18),
(176, 'Quiimba', 18),
(177, 'Quinzau', 18),
(178, 'Mpala', 18),
(179, 'Nzeto', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `outdoors`
--

CREATE TABLE `outdoors` (
  `idOutdoor` int(11) NOT NULL,
  `tipo` enum('Painel Luminoso','Painel Não Luminoso','Faixadas','Placas Indicativas','Lampoles') NOT NULL,
  `provincia` varchar(20) NOT NULL,
  `municipio` varchar(20) NOT NULL,
  `comuna` varchar(20) DEFAULT NULL,
  `preco` float NOT NULL,
  `estado` enum('disponivel','aguardando','validando','ocupado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `outdoors`
--

INSERT INTO `outdoors` (`idOutdoor`, `tipo`, `provincia`, `municipio`, `comuna`, `preco`, `estado`) VALUES
(2, 'Painel Luminoso', 'Bengo', 'Ambriz', 'Ambriz', 450000, 'validando'),
(3, 'Faixadas', 'Cabinda', 'Belize', 'Calumbo', 1000000, 'validando'),
(4, 'Faixadas', 'Bengo', 'Bula Atumba', 'Bula Atumba', 9000000, 'disponivel'),
(5, 'Placas Indicativas', 'Bengo', 'Ambriz', 'Dange-Quitexe', 75000, 'disponivel'),
(8, 'Placas Indicativas', 'Benguela', 'Baía Farta', 'Beira-Alta', 34000, 'disponivel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `idPaises` int(11) NOT NULL,
  `nomePaises` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`idPaises`, `nomePaises`) VALUES
(1, 'África do Sul'),
(2, 'Angola'),
(3, 'Argélia'),
(4, 'Benin'),
(5, 'Botswana'),
(6, 'Burquina Faso'),
(7, 'Burundi'),
(8, 'Cabo Verde'),
(9, 'Camarões'),
(10, 'Chade'),
(11, 'Comores'),
(12, 'Congo'),
(13, 'Costa do Marfim'),
(14, 'Djibuti'),
(15, 'Egito'),
(16, 'Eritreia'),
(17, 'Eswatini'),
(18, 'Etiópia'),
(19, 'Gabão'),
(20, 'Gâmbia'),
(21, 'Gana'),
(22, 'Guiné'),
(23, 'Guiné-Bissau'),
(24, 'Guiné Equatorial'),
(25, 'Lesoto'),
(26, 'Libéria'),
(27, 'Líbia'),
(28, 'Madagáscar'),
(29, 'Maláui'),
(30, 'Mali'),
(31, 'Marrocos'),
(32, 'Maurícia'),
(33, 'Mauritânia'),
(34, 'Moçambique'),
(35, 'Namíbia'),
(36, 'Níger'),
(37, 'Nigéria'),
(38, 'Quénia'),
(39, 'República Centro-Afr'),
(40, 'República Democrátic'),
(41, 'Ruanda'),
(42, 'São Tomé e Príncipe'),
(43, 'Senegal'),
(44, 'Seicheles'),
(45, 'Serra Leoa'),
(46, 'Somália'),
(47, 'Sudão'),
(48, 'Sudão do Sul'),
(49, 'Tanzânia'),
(50, 'Togo'),
(51, 'Tunísia'),
(52, 'Uganda'),
(53, 'Zâmbia'),
(54, 'Zimbábue');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedidos` int(11) NOT NULL,
  `dataI` date NOT NULL,
  `dataF` date NOT NULL,
  `pagamento` float NOT NULL,
  `fk_outdoor` int(11) DEFAULT NULL,
  `fk_cliente` int(11) DEFAULT NULL,
  `fk_gestor` int(11) DEFAULT NULL,
  `numeroPedidos` int(11) DEFAULT 0,
  `imagem` varchar(255) DEFAULT NULL,
  `comprovativo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedidos`, `dataI`, `dataF`, `pagamento`, `fk_outdoor`, `fk_cliente`, `fk_gestor`, `numeroPedidos`, `imagem`, `comprovativo`) VALUES
(19, '2023-07-24', '2023-07-27', 3000000, 3, 2, 3, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `provincias`
--

CREATE TABLE `provincias` (
  `idProvincia` int(11) NOT NULL,
  `nomeProv` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `nomeProv`) VALUES
(1, 'Bengo'),
(2, 'Benguela'),
(3, 'Bié'),
(4, 'Cabinda'),
(5, 'Cuando Cubango'),
(6, 'Cuanza Norte'),
(7, 'Cuanza Sul'),
(8, 'Cunene'),
(9, 'Huambo'),
(10, 'Huíla'),
(11, 'Luanda'),
(12, 'Lunda Norte'),
(13, 'Lunda Sul'),
(14, 'Malanje'),
(15, 'Moxico'),
(16, 'Namibe'),
(17, 'Uíge'),
(18, 'Zaire');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `tipo` enum('cliente','admin','gestor') DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `passe` varchar(255) NOT NULL,
  `estado` enum('ativo','inativo') DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `tipo`, `username`, `passe`, `estado`, `email`) VALUES
(1, 'admin', 'admin', 'madrid', 'ativo', 'candidojoao12@gmail.com'),
(2, 'gestor', 'quelita', '1234', 'ativo', NULL),
(3, 'cliente', 'asafe', '123', 'ativo', NULL),
(4, 'cliente', 'mele', '1234', 'ativo', 'mel@utec.co.ao'),
(5, 'cliente', 'helafame', '123', 'ativo', NULL),
(6, 'gestor', 'velinho', '1234', 'ativo', NULL),
(7, 'cliente', 'manjack', '123', 'inativo', NULL),
(11, 'cliente', 'ribery', '123', 'inativo', NULL),
(12, 'cliente', 'zulo', '123', 'ativo', NULL),
(20, 'cliente', 'catia', '123', 'ativo', NULL),
(22, 'cliente', 'jedis', '123', 'ativo', 'jedivania@gmail.com'),
(23, 'gestor', 'mudile', '123', 'inativo', 'mudile@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluguer`
--
ALTER TABLE `aluguer`
  ADD PRIMARY KEY (`fk_cliente`,`numeroPedidos`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `nacionalidade` (`nacionalidade`),
  ADD KEY `fk_usuarioC` (`fk_usuarioC`);

--
-- Índices para tabela `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`idComuna`),
  ADD KEY `fk_municipio` (`fk_municipio`);

--
-- Índices para tabela `gestores`
--
ALTER TABLE `gestores`
  ADD PRIMARY KEY (`idGestor`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_usuarioG` (`fk_usuarioG`);

--
-- Índices para tabela `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`idMunicipio`),
  ADD KEY `fk_provincia` (`fk_provincia`);

--
-- Índices para tabela `outdoors`
--
ALTER TABLE `outdoors`
  ADD PRIMARY KEY (`idOutdoor`);

--
-- Índices para tabela `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPaises`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedidos`),
  ADD KEY `fk_outdoor` (`fk_outdoor`),
  ADD KEY `fk_cliente` (`fk_cliente`),
  ADD KEY `fk_gestor` (`fk_gestor`);

--
-- Índices para tabela `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idProvincia`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `comunas`
--
ALTER TABLE `comunas`
  MODIFY `idComuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de tabela `gestores`
--
ALTER TABLE `gestores`
  MODIFY `idGestor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `municipios`
--
ALTER TABLE `municipios`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de tabela `outdoors`
--
ALTER TABLE `outdoors`
  MODIFY `idOutdoor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `paises`
--
ALTER TABLE `paises`
  MODIFY `idPaises` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedidos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `provincias`
--
ALTER TABLE `provincias`
  MODIFY `idProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluguer`
--
ALTER TABLE `aluguer`
  ADD CONSTRAINT `aluguer_ibfk_1` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`idCliente`);

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`nacionalidade`) REFERENCES `paises` (`idPaises`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`fk_usuarioC`) REFERENCES `usuarios` (`idUsuario`);

--
-- Limitadores para a tabela `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunas_ibfk_1` FOREIGN KEY (`fk_municipio`) REFERENCES `municipios` (`idMunicipio`);

--
-- Limitadores para a tabela `gestores`
--
ALTER TABLE `gestores`
  ADD CONSTRAINT `gestores_ibfk_1` FOREIGN KEY (`fk_usuarioG`) REFERENCES `usuarios` (`idUsuario`);

--
-- Limitadores para a tabela `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`fk_provincia`) REFERENCES `provincias` (`idProvincia`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`fk_outdoor`) REFERENCES `outdoors` (`idOutdoor`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`fk_cliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`fk_gestor`) REFERENCES `gestores` (`idGestor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
