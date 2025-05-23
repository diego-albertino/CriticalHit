-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/05/2025 às 15:46
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
  `id_com` int(10) NOT NULL,
  `texto` varchar(1000) NOT NULL,
  `data` date NOT NULL,
  `nota_avaliacao` char(1) NOT NULL,
  `id_jogo` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_plataforma` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id_com`, `texto`, `data`, `nota_avaliacao`, `id_jogo`, `id_usuario`, `id_plataforma`) VALUES
(25, 'jogo muito bom', '2025-05-21', '5', 1, 1, 1),
(26, 'As coisas são muitos caras no começo', '2025-05-21', '1', 1, 1, 1),
(27, 'good game', '2025-05-21', '4', 1, 1, 1),
(28, 'mais ou menos', '2025-05-21', '3', 1, 1, 1),
(29, 'num sei', '2025-05-21', '2', 1, 1, 1),
(30, 'sem opinião', '2025-05-21', '0', 1, 1, 1),
(32, '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\n⣿⠟⠫⢻⣿⣿⣿⣿⢟⣩⡍⣙⠛⢛⣿⣿⣿⠛⠛⠛⠛⠻⣿⣿⣿⣿⣿⡿⢿⣿\n⣿⠤⠄⠄⠙⢿⣿⣿⣿⡿⠿⠛⠛⢛⣧⣿⠇⠄⠂⠄⠄⠄⠘⣿⣿⣿⣿⠁⠄⢻\n⣿⣿⣿⣿⣶⣄⣾⣿⢟⣼⠒⢲⡔⣺⣿⣧⠄⠄⣠⠤⢤⡀⠄⠟⠉⣠⣤⣤⣤⣾\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣟⣀⣬⣵⣿⣿⣿⣶⡤⠙⠄⠘⠃⠄⣴⣾⣿⣿⣿⣿⣿\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⢻⠿⢿⣿⣿⠿⠋⠁⠄⠂⠉⠒⢘⣿⣿⣿⣿⣿⣿⣿\n⣿⣿⣿⣿⣿⣿⣿⣿⡿⣡⣷⣶⣤⣤⣀⡀⠄⠄⠄⠄⠄⠄⠄⣾⣿⣿⣿⣿⣿⣿\n⣿⣿⣿⣿⣿⣿⣿⡿⣸⣿⣿⣿⣿⣿⣿⣿⣷⣦⣰⠄⠄⠄⠄⢾⠿⢿⣿⣿⣿⣿\n⣿⡿⠋⣡⣾⣿⣿⣿⡟⠉⠉⠈⠉⠉⠉⠉⠉⠄⠄⠄⠑⠄⠄⠐⡇⠄⠈⠙⠛⠋\n⠋⠄⣾⣿⣿⣿⣿⡿⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⢠⡇⠄⠄⠄⠄⠄\n⠄⢸⣿⣿⣿⣿⣿⣯⠄⢠⡀⠄⠄⠄⠄⠄⠄⠄⠄⣀⠄⠄⠄⠄⠁⠄⠄⠄⠄⠄\n⠁⢸⣿⣿⣿⣿⣿⣯⣧⣬⣿⣤⣐⣂⣄⣀⣠⡴⠖⠈⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄\n⠈⠈⣿⣟⣿⣿⣿⣿⣿⣿⣿⣿⣽⣉⡉⠉⠈⠁⠄⠁⠄⠄⠄⠄⡂⠄⠄⠄⠄⠄\n⠄⠄⠙⣿⣿⠿⣿⣿⣿⣿⣷⡤⠈⠉⠉⠁⠄⠄⠄⠄⠄⠄⠄⠠⠔⠄⠄⠄⠄⠄\n⠄⠄⠄⡈⢿⣷⣿⣿⢿⣿⣿⣷⡦⢤⡀⠄⠄⠄⠄⠄⠄⢐⣠⡿⠁⠄⠄⠄⠄⠄', '2025-05-21', '0', 1, 1, 1),
(34, '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠛⠉⠉⠛⠛⠛⠿⢿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠁⠄⠄⠄⠄⠄⠄⠄⠄⠄⠹⣿⣿⣿\r\n⣿⣿⣿⣿⣿⠻⠟⣻⣿⣟⠛⣿⣿⣿⠋⠄⠄⢀⣤⣤⣴⣶⣶⣤⣀⠄⠄⠘⢻⣿\r\n⣿⣿⣿⣿⣧⢀⣀⣻⣿⣿⣦⣿⣿⣯⠄⠄⠄⢾⣿⣿⣿⣿⣿⣿⣿⣧⠄⠄⠄⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⢻⣿⣿⣿⣿⡓⠄⠄⠄⣝⣭⠉⠩⣽⡍⠉⢐⣿⡆⠄⠄⣸\r\n⣿⣿⣿⣿⣿⣿⣿⣆⣄⣶⣿⣿⣿⣧⣄⠄⢸⣿⣾⣾⣾⣿⣷⣾⣿⣿⡇⠄⣰⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⠄⢿⣿⡿⠷⠂⠒⢿⣿⣿⠃⢀⣿⣿\r\n⣿⠉⢹⣿⡏⠉⡏⠉⣿⡏⠉⣿⣿⣿⠉⠉⠃⠄⠙⠁⢠⠄⠠⠄⠈⠁⠄⢸⣿⣿\r\n⣿⠄⢸⣿⡇⠄⡇⠄⣿⡇⠄⣿⣿⡏⠄⠄⠰⠄⠄⠄⠄⠄⠄⠄⠄⠄⢠⣼⣿⣿\r\n⣿⠄⠸⠿⡇⠄⠇⠄⣾⡇⠄⠿⢿⠇⠄⡀⠄⣇⡀⠄⠄⠄⠄⠄⠄⠄⣼⣿⣿⣿\r\n⣿⠤⢤⣤⣷⣦⣤⠶⢿⡧⠤⡤⠼⢤⣼⣿⠶⠾⠿⣦⣤⣤⣤⣦⣤⣴⣿⣿⣿⣿\r\n⣿⠄⢸⣿⡏⠄⢹⠄⢸⠇⢠⡇⠄⡀⠈⢻⠄⢀⣀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⠄⢸⣿⡇⠄⢸⡇⠈⠄⢸⡇⠄⠁⢀⣾⠄⢀⣀⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣀⣈⣁⣇⣀⣼⣿⣀⣀⣿⣇⣀⣇⣀⣹⣀⣀⣉⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿', '2025-05-21', '5', 1, 1, 1),
(35, '⣿⣿⣿⣿⠄⠄⡄⠘⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠄⢰⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⠄⠄⡅⠄⢻⣿⣿⣿⣿⣿⣿⠟⠄⠄⠄⣸⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⠄⠄⡃⠄⢸⣿⣿⣿⠿⠛⠁⢀⣠⠄⢠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⡆⠄⠁⠄⠄⢿⠟⠁⠄⠄⠄⠐⠁⢀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣀⠄⠄⠄⠈⠄⠄⠄⠄⠄⠄⠄⠻⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⡄⠠⢀⢀⡄⠄⠄⠄⠄⠄⠄⠄⠄⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⡇⣿⣟⠄⠔⠄⡁⠄⠄⠄⢀⣰⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⡇⣿⣿⣦⣤⣀⣣⣴⣶⠐⠨⣝⡿⢿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⢧⣿⣟⣿⣿⣿⣿⣿⣿⣮⣔⣮⣽⣷⣶⣯⡻⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⡇⣿⡿⢿⠏⠉⠙⠫⣿⣯⣾⣿⣿⡿⢿⣿⣿⡿⢹⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣇⠄⠄⠄⠄⠄⠄⠺⣿⣿⣿⣿⣿⡿⠏⠁⠄⠄⠹⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⣷⡀⠄⠄⠄⢰⡜⢶⢋⠙⠛⠋⠄⠄⠄⠄⣀⣼⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⣿⡏⠄⠄⠄⠄⠙⣶⡕⠦⡄⣷⣗⢼⣿⠻⣹⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⣿⣃⠄⠄⠄⢠⣀⣀⠙⢶⡌⠙⠋⠼⠄⢸⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⡿⣣⣋⣽⣵⣫⣿⣿⣿⣿⣄⢙⢃⣀⣀⣴⣿⣿⣿⣿⣿⣿⣿', '2025-05-21', '5', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` int(10) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `url_img` int(255) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogo`
--

INSERT INTO `jogo` (`id`, `nome`, `url_img`, `descricao`) VALUES
(1, 'Stardew Valley', 1, 'Você herdou a antiga fazenda do seu avô, em Stardew Valley. Com ferramentas de segunda-mão e algumas moedas, você parte para dar início a sua nova vida. Será que você vai aprender a viver da terra, a transformar esse matagal em um próspero lar?');

-- --------------------------------------------------------

--
-- Estrutura para tabela `plataforma`
--

CREATE TABLE `plataforma` (
  `id` int(5) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `plataforma`
--

INSERT INTO `plataforma` (`id`, `nome`) VALUES
(1, 'PC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Leandro', 'leandro@gmail.com', '$2y$10$mOxF3h9pAdFCA/gLM3Tr5uUa.9uzkn62VDyWeEKnV9jPUdjpFu5Za');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_jogo` (`id_jogo`),
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
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_com` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_jogo`) REFERENCES `jogo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_3` FOREIGN KEY (`id_plataforma`) REFERENCES `plataforma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
