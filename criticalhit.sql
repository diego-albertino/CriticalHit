-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/04/2025 às 16:35
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `criticalhit`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_com` varchar(10) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `nota_avaliacao` int(2) NOT NULL,
  `id_jogo` varchar(255) NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `id_plataforma` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `url_img` int(255) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `plataforma`
--

CREATE TABLE `plataforma` (
  `id` varchar(5) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` varchar(10) NOT NULL,
  `nome` int(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_jogo` (`id_jogo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_plataforma` (`id_plataforma`);

--
-- Índices de tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `plataforma`
--
ALTER TABLE `plataforma`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_jogo`) REFERENCES `jogo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_3` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
