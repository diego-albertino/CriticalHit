-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2025 às 14:18
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
(3, 'Não tõ bom', '2025-05-26', '3', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` int(10) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogo`
--

INSERT INTO `jogo` (`id`, `nome`, `url_img`, `descricao`, `nota`) VALUES
(1, 'Silent Hill 2', 'https://flowgames.gg/wp-content/uploads/2023/03/image-2023-03-29T122128.598.jpg', 'Atraído por uma carta misteriosa de sua falecida esposa, James explora a misteriosa cidade de Silent Hill. O que o aguarda é um pesadelo encoberto por ferrugem e névoa e habitado por monstros. ', 4),
(2, 'Stardew Valley', 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/413150/capsule_616x353.jpg?t=1711128146', '“Você herdou a antiga fazenda do seu avô, em Stardew Valley. Com ferramentas de segunda-mão e algumas moedas, você parte para dar início a sua nova vida.”', 5),
(3, 'NFS Heat', 'https://cdn.ome.lt/OjcTwVSBNIDFU3p78EocjNCYpNA=/1200x630/smart/extras/conteudos/need-for-speed-heat_7zA2m8l.jpg', 'Trabalhe de dia e arrisque tudo à noite em Need for Speed™ Heat, um jogo eletrizante de corridas de rua, onde a lei desaparece com o pôr do sol.', 2),
(4, 'Spider-Man 2', 'https://media.vandal.net/i/1200x675/106797/marvels-spiderman-2-20236910113885_1.jpg', 'Pendure-se, pule e plane com as novas Asas de Teia para percorrer a Nova York da Marvel. Alterne rapidamente entre Peter Parker e Miles Morales para jogar histórias diferentes e usar novos poderes épicos enquanto o infame vilão Venom ameaça a vida deles, ', 3),
(5, 'The Last of Us', 'https://assets1.ignimgs.com/vid/thumbnails/user/2014/03/26/lastofusreviewmimig2.jpg', 'Em uma civilização devastada, em que infectados e sobreviventes veteranos estão à solta, Joel, um protagonista abatido, é contratado para tirar uma garota de 14 anos, Ellie, de uma zona de quarentena militar. No entanto, o que começa como um pequeno servi', 5);

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
(1, 'Steam');

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
(1, 'Leandro', 'leandro@gmail.com', '$2y$10$mOxF3h9pAdFCA/gLM3Tr5uUa.9uzkn62VDyWeEKnV9jPUdjpFu5Za'),
(2, 'maykon', 'maykon@gmail.com', 'maykon123'),
(3, 'joana', 'joana@gmail', '$2y$10$Zmu8ckQGy3qe3bDYHPSg3.jJPzskcKjyQ7v01c5JVN8HoyL72EpAm'),
(4, 'jao', 'jao@gmail.com', 'jao123');

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
  MODIFY `id_com` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
