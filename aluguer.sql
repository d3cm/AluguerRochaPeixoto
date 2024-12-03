-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 09:58 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aluguer`
--

-- --------------------------------------------------------

--
-- Table structure for table `espaco`
--

CREATE TABLE `espaco` (
  `id_espaco` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `tipo_espaco` enum('Campo','Quadra','Auditorio','Sala','Mesa','Piscina') NOT NULL,
  `capacidade` int(11) NOT NULL,
  `valor_hora` decimal(50,0) NOT NULL,
  `disponibilidade` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `espaco`
--

INSERT INTO `espaco` (`id_espaco`, `nome`, `descricao`, `tipo_espaco`, `capacidade`, `valor_hora`, `disponibilidade`) VALUES
(1, 'Piscina Escolar', 'Piscina semiolímpica coberta para aulas de natação', 'Piscina', 30, '100', 1),
(2, 'Campo Exterior de Futebol', 'Campo gramado para treinos e jogos de futebol', 'Campo', 22, '50', 0),
(3, 'Campo Sintético', 'Campo sintético multifuncional com iluminação noturna', 'Campo', 20, '60', 1),
(4, 'Ginásio Escolar', 'Espaço interior para desportos variados como voleibol e futsal', 'Auditorio', 50, '80', 1),
(5, 'Quadra de Basquetebol', 'Quadra equipada com tabelas profissionais e bancadas', 'Quadra', 20, '40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `espaco_horario`
--

CREATE TABLE `espaco_horario` (
  `id` int(11) NOT NULL,
  `id_tipo_espaco` int(11) NOT NULL,
  `nome_espaco` varchar(100) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `ID_horario` int(11) NOT NULL,
  `dia_semana` enum('Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo') DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `ID_espaco` int(11) DEFAULT NULL,
  `horario_ferias` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id_Material` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_espaco` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `data_reserva` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  `status_reserva` enum('Confirmada','Cancelada','Pendente') DEFAULT 'Pendente',
  `id_utilizador` int(11) DEFAULT NULL,
  `id_espaco` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `data_reserva`, `hora_inicio`, `hora_fim`, `status_reserva`, `id_utilizador`, `id_espaco`) VALUES
(1, '2024-12-01', '09:00:00', '10:00:00', 'Confirmada', 1, 3),
(2, '2024-12-02', '11:00:00', '12:30:00', 'Pendente', 2, 2),
(3, '2024-12-03', '15:00:00', '16:00:00', 'Cancelada', 3, 1),
(4, '2024-12-04', '14:00:00', '15:30:00', 'Confirmada', 4, 5),
(5, '2024-12-05', '10:00:00', '11:30:00', 'Pendente', 5, 4),
(8, '2024-12-18', '20:35:00', '21:35:00', 'Pendente', 7, 1),
(7, '2024-12-09', '12:30:00', '13:30:00', 'Pendente', 7, NULL),
(9, '2020-01-01', '20:50:00', '21:50:00', 'Pendente', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `reserva_espaco`
--

CREATE TABLE `reserva_espaco` (
  `ID_reserva_espaco` int(11) NOT NULL,
  `ID_reserva` int(11) DEFAULT NULL,
  `ID_espaco` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserva_espaco`
--

INSERT INTO `reserva_espaco` (`ID_reserva_espaco`, `ID_reserva`, `ID_espaco`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 3, 1),
(4, 4, 5),
(5, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `utilizador`
--

CREATE TABLE `utilizador` (
  `id_utilizador` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `tipo_user` enum('Professor','Aluno','Externo') NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `nome`, `email`, `telefone`, `tipo_user`, `senha`) VALUES
(7, 'Alberto Caeiro', 'alberto.caeiro@gmail.com', 916233649, 'Externo', 'senha123'),
(1, 'Maria Alberta', 'maria.oliveira@gmail.com', 913456789, 'Professor', 'senha123'),
(2, 'Carlos Costa', 'carlos.costa123@gmail.com', 914567890, 'Externo', '123senha'),
(3, 'Ana Martins', 'ana.martins@gmail.com', 915678901, 'Aluno', 'senha123'),
(4, 'Pedro Santos', 'pedro.santos@gmail.com', 916789012, 'Professor', 'senha123'),
(5, 'Antonio Mendes', 'antonio@gmail.com', 919456591, 'Aluno', 'senha123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `espaco`
--
ALTER TABLE `espaco`
  ADD PRIMARY KEY (`id_espaco`);

--
-- Indexes for table `espaco_horario`
--
ALTER TABLE `espaco_horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_espaco` (`id_tipo_espaco`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`ID_horario`),
  ADD KEY `ID_espaco` (`ID_espaco`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_Material`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_utilizador` (`id_utilizador`),
  ADD KEY `id_espaco` (`id_espaco`);

--
-- Indexes for table `reserva_espaco`
--
ALTER TABLE `reserva_espaco`
  ADD PRIMARY KEY (`ID_reserva_espaco`),
  ADD KEY `ID_reserva` (`ID_reserva`),
  ADD KEY `ID_espaco` (`ID_espaco`);

--
-- Indexes for table `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_utilizador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `espaco`
--
ALTER TABLE `espaco`
  MODIFY `id_espaco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `espaco_horario`
--
ALTER TABLE `espaco_horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `ID_horario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id_Material` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `reserva_espaco`
--
ALTER TABLE `reserva_espaco`
  MODIFY `ID_reserva_espaco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
