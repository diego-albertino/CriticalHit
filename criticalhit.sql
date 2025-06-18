-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/06/2025 às 18:35
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
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nota_avaliacao` char(1) NOT NULL,
  `id_jogo` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_plataforma` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentario`
--

INSERT INTO `comentario` (`id_com`, `texto`, `data`, `nota_avaliacao`, `id_jogo`, `id_usuario`, `id_plataforma`) VALUES
(1, 'Não tão bom assim', '2025-06-02 17:55:23', '3', 2, 1, 1),
(4, 'Amei mimosa', '2025-06-02 17:56:39', '5', 2, 3, 1),
(5, 'adorei amores, tudo de bom, arrasou', '2025-06-02 17:56:39', '5', 2, 1, 1),
(6, '⣿⣿⣿⣿⠄⠄⡄⠘⣿⣿⣿⣿⣿⣿⣿⣿⣿⠃⠄⢰⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⠄⠄⡅⠄⢻⣿⣿⣿⣿⣿⣿⠟⠄⠄⠄⣸⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⠄⠄⡃⠄⢸⣿⣿⣿⠿⠛⠁⢀⣠⠄⢠⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⡆⠄⠁⠄⠄⢿⠟⠁⠄⠄⠄⠐⠁⢀⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣀⠄⠄⠄⠈⠄⠄⠄⠄⠄⠄⠄⠻⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⡄⠠⢀⢀⡄⠄⠄⠄⠄⠄⠄⠄⠄⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⡇⣿⣟⠄⠔⠄⡁⠄⠄⠄⢀⣰⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⡇⣿⣿⣦⣤⣀⣣⣴⣶⠐⠨⣝⡿⢿⣿⣿⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⢧⣿⣟⣿⣿⣿⣿⣿⣿⣮⣔⣮⣽⣷⣶⣯⡻⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⡇⣿⡿⢿⠏⠉⠙⠫⣿⣯⣾⣿⣿⡿⢿⣿⣿⡿⢹⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣇⠄⠄⠄⠄⠄⠄⠺⣿⣿⣿⣿⣿⡿⠏⠁⠄⠄⠹⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⣷⡀⠄⠄⠄⢰⡜⢶⢋⠙⠛⠋⠄⠄⠄⠄⣀⣼⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⣿⡏⠄⠄⠄⠄⠙⣶⡕⠦⡄⣷⣗⢼⣿⠻⣹⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⣿⣿⣃⠄⠄⠄⢠⣀⣀⠙⢶⡌⠙⠋⠼⠄⢸⣿⣿⣿⣿⣿⣿ \r\n⣿⣿⣿⣿⣿⣿⡿⣣⣋⣽⣵⣫⣿⣿⣿⣿⣄⢙⢃⣀⣀⣴⣿⣿⣿⣿⣿⣿⣿', '2025-06-02 17:58:04', '5', 1, 1, 5),
(7, '(°_°)', '2025-06-02 17:55:23', '0', 4, 1, 1),
(22, 'Stardew Valley é um jogo que proporciona uma experiência única e imersiva no gênero de simulação agrícola. O que mais chama atenção é a combinação equilibrada entre a simplicidade dos gráficos pixelados e a complexidade das atividades disponíveis, que vão desde o cultivo de plantas até a interação profunda com os moradores da vila. O sistema de progressão é bastante recompensador, permitindo que o jogador personalize sua fazenda e desenvolva suas habilidades de forma gradual, o que mantém o interesse a longo prazo.\r\n\r\nAlém disso, o jogo oferece um ritmo tranquilo, ideal para quem busca uma pausa do estresse cotidiano, sem abrir mão de desafios e objetivos claros. A variedade de missões, eventos sazonais e exploração de cavernas traz uma dinâmica que evita a monotonia. Outro ponto forte é a narrativa sutil e envolvente, que cria uma conexão emocional com os personagens, incentivando o jogador a investir tempo para conhecê-los melhor.', '2025-06-18 15:10:55', '5', 2, 3, 1),
(23, '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⠟⠫⢻⣿⣿⣿⣿⢟⣩⡍⣙⠛⢛⣿⣿⣿⠛⠛⠛⠛⠻⣿⣿⣿⣿⣿⡿⢿⣿\r\n⣿⠤⠄⠄⠙⢿⣿⣿⣿⡿⠿⠛⠛⢛⣧⣿⠇⠄⠂⠄⠄⠄⠘⣿⣿⣿⣿⠁⠄⢻\r\n⣿⣿⣿⣿⣶⣄⣾⣿⢟⣼⠒⢲⡔⣺⣿⣧⠄⠄⣠⠤⢤⡀⠄⠟⠉⣠⣤⣤⣤⣾\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣟⣀⣬⣵⣿⣿⣿⣶⡤⠙⠄⠘⠃⠄⣴⣾⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⢻⠿⢿⣿⣿⠿⠋⠁⠄⠂⠉⠒⢘⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⡿⣡⣷⣶⣤⣤⣀⡀⠄⠄⠄⠄⠄⠄⠄⣾⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⡿⣸⣿⣿⣿⣿⣿⣿⣿⣷⣦⣰⠄⠄⠄⠄⢾⠿⢿⣿⣿⣿⣿\r\n⣿⡿⠋⣡⣾⣿⣿⣿⡟⠉⠉⠈⠉⠉⠉⠉⠉⠄⠄⠄⠑⠄⠄⠐⡇⠄⠈⠙⠛⠋\r\n⠋⠄⣾⣿⣿⣿⣿⡿⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⢠⡇⠄⠄⠄⠄⠄\r\n⠄⢸⣿⣿⣿⣿⣿⣯⠄⢠⡀⠄⠄⠄⠄⠄⠄⠄⠄⣀⠄⠄⠄⠄⠁⠄⠄⠄⠄⠄\r\n⠁⢸⣿⣿⣿⣿⣿⣯⣧⣬⣿⣤⣐⣂⣄⣀⣠⡴⠖⠈⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄\r\n⠈⠈⣿⣟⣿⣿⣿⣿⣿⣿⣿⣿⣽⣉⡉⠉⠈⠁⠄⠁⠄⠄⠄⠄⡂⠄⠄⠄⠄⠄\r\n⠄⠄⠙⣿⣿⠿⣿⣿⣿⣿⣷⡤⠈⠉⠉⠁⠄⠄⠄⠄⠄⠄⠄⠠⠔⠄⠄⠄⠄⠄\r\n⠄⠄⠄⡈⢿⣷⣿⣿⢿⣿⣿⣷⡦⢤⡀⠄⠄⠄⠄⠄⠄⢐⣠⡿⠁⠄⠄⠄⠄⠄', '2025-06-02 17:56:39', '4', 2, 1, 2),
(24, '(°o°)', '2025-06-02 18:00:18', '5', 2, 1, 1),
(25, 'Miranha', '2025-06-02 18:01:58', '3', 4, 1, 2),
(26, 'Peter Park é o melhor protagonista', '2025-06-02 18:14:11', '4', 4, 1, 2),
(27, 'Muito emocionate, pena que o Joel...', '2025-06-02 18:17:47', '5', 5, 1, 1),
(28, 'Faz o Elli', '2025-06-02 18:18:35', '2', 5, 1, 1),
(33, 'Não presta!', '2025-06-16 00:51:19', '5', 4, 1, 2),
(34, 'ruim', '2025-06-18 13:44:16', '5', 4, 7, 2),
(43, 'rancho feliz', '2025-06-18 14:45:37', '5', 2, 7, 1),
(44, 'Jogabilidade refinada, com combates tensos e furtivos', '2025-06-18 14:51:34', '5', 5, 7, 1),
(45, 'Gráficos incríveis, com Nova York ainda mais viva e detalhada.', '2025-06-18 15:17:22', '5', 4, 9, 2),
(46, 'NFS Heat resgata a essência das melhores fases da franquia.', '2025-06-18 15:18:02', '5', 3, 9, 1),
(47, 'Jogo relaxante, perfeito para quem busca uma pausa da rotina', '2025-06-18 15:18:35', '5', 2, 9, 1),
(48, 'Silent Hill 2 é uma obra-prima que mistura horror, drama e tragédia humana', '2025-06-18 15:19:11', '5', 1, 9, 1),
(49, '👨‍🌾😾🌽🍓🍅', '2025-06-18 16:16:59', '4', 2, 2, 1),
(50, '😲😲😲😲', '2025-06-18 16:17:47', '4', 1, 2, 1),
(51, 'A jogabilidade é boa mas o preço não compensa.', '2025-06-18 16:19:37', '2', 3, 2, 1),
(52, '⠀⣠⣤⣶⣶⣦⣄⡀  ⠀⢀⣤⣴⣶⣶⣤⣀⠀\r\n⣼⣿⣿⣿⣿⣿⣿⣷⣤⣾⣿⣿⣿⣿⣿⣿⣧\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⠹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠏\r\n⠀⠙⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠋⠀\r\n⠀⠀⠀⠙⢿⣿⣿⣿⣿⣿⣿⣿⡿⠛⠁⠀⠀\r\n⠀⠀⠀⠀⠀⠉⢿⣿⣿⣿⠟⠋⠀⠀⠀⠀⠀\r\n⠀⠀⠀⠀⠀⠀⠀⠙⠻⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀', '2025-06-18 16:20:58', '5', 5, 2, 1),
(53, '░░▄█▀▀▀░░░░░░░░▀▀▀█▄\r\n▄███▄▄░░▀▄██▄▀░░▄▄███▄\r\n▀██▄▄▄▄████████▄▄▄▄██▀\r\n░░▄▄▄▄██████████▄▄▄▄\r\n░▐▐▀▐▀░▀██████▀░▀▌▀▌▌', '2025-06-18 16:21:56', '5', 4, 2, 2),
(54, '░░░░▄▄▄▄▀▀▀▀▀▀▀▀▄▄▄▄▄▄\r\n░░░░█░░░░▒▒▒▒▒▒▒▒▒▒▒▒░░▀▀▄\r\n░░░█░░░▒▒▒▒▒▒░░░░░░░░▒▒▒░░█\r\n░░█░░░░░░▄██▀▄▄░░░░░▄▄▄░░░█\r\n░▀▒▄▄▄▒░█▀▀▀▀▄▄█░░░██▄▄█░░░█\r\n█▒█▒▄░▀▄▄▄▀░░░░░░░░█░░░▒▒▒▒▒█\r\n█▒█░█▀▄▄░░░░░█▀░░░░▀▄░░▄▀▀▀▄▒█\r\n░█▀▄░█▄░█▀▄▄░▀░▀▀░▄▄▀░░░░█░░█\r\n░░█░░▀▄▀█▄▄░█▀▀▀▄▄▄▄▀▀█▀██░█\r\n░░░█░░██░░▀█▄▄▄█▄▄█▄████░█\r\n░░░░█░░░▀▀▄░█░░░█░███████░█\r\n░░░░░▀▄░░░▀▀▄▄▄█▄█▄█▄█▄▀░░█\r\n░░░░░░░▀▄▄░▒▒▒▒░░░░░░░░░░█\r\n░░░░░░░░░░▀▀▄▄░▒▒▒▒▒▒▒▒▒▒░█\r\n░░░░░░░░░░░░░░▀▄▄▄▄▄░░░░░█', '2025-06-18 16:23:25', '3', 1, 7, 1),
(55, '░░░░░░███████ ]▄▄▄▄▄▄▄▄\r\n ▂▄▅█████████▅▄▃▂        \r\n[███████████████████]. \r\n◥⊙▲⊙▲⊙▲⊙▲⊙▲⊙▲⊙◤..', '2025-06-18 16:26:25', '0', 3, 7, 1),
(56, '░░░░░░░░░░░░░░░░▄▓▄\r\n░░░░▄█▄░░░░░░░░▄▓▓▓▄\r\n░░▄█████▄░░░░░▄▓▓▓▓▓▄\r\n░▀██┼█┼██▀░░░▄▓▓▓▓▓▓▓▄\r\n▄▄███████▄▄▄▄▄▄▄▄█▄▄▄▄', '2025-06-18 16:27:42', '5', 2, 7, 1),
(57, 'Um jogo para se emocionar!\r\n\r\nNão sou de escrever tantas resenhas detalhadas na Steam, mas acabei de zerar TLOU 2 no exato momento em que estou escrevendo isso, e acho que seria injusto não falar de uma história tão fantástica quanto este jogo é! Pouparei os spoilers por aqui porque já sofri muito com eles nos últimos 4 anos em que aguardei pela chegada dessa franquia para PC, e acho que, apesar de não ter afetado tanto a minha diversão experienciando este jogo, acabou limitando a minha emoção e na imersão que eu poderia ter tido de uma maneira muito maior se não soubesse de absolutamente nada do que aconteceria.\r\n\r\nJogabilidade: 10/10\r\n\r\nPra quem acompanha páginas de jogos no falecido \"Twitter\", sabe que posts elogiando a gameplay de TLOU 2 são tão genéricos quanto falar do jardineiro do Leicester City, mas convenhamos: que jogabilidade delicinha! Variar a maneira de matar inimigos, seja no 100% stealthy ou botando o p4u na mesa e chegando no estilo \"tiro, porrada e bomba\" é uma das m', '2025-06-18 16:29:49', '5', 5, 9, 1),
(58, 'Gameplay com os carros, compra das peças e customização é até divertida, no entanto a mecânica de perseguição de polícia e ter que seguir a pista passando por certos \"pontos de checagem\" obrigatórios tira quase que completamente a graça do jogo! No início do jogo é basicamente impossível fugir da polícia o que gera penalidade de vc perder dinheiro o que apaga parte do seu progresso as vezes de horas. Conforme vc melhora o carro não muda muita coisa tbm. Simplesmente uma das piores mecânicas que já vi em qualquer jogo!! Daria uma nota 7.5/10, mas como existe o lixo da polícia roubada e vc não poder cortar caminho... no máximo dou 5/10... só vale comprar na promoção e olhe lá!', '2025-06-18 16:31:08', '3', 3, 9, 1),
(59, 'mais um jogo do tipo console,não tem câmera interna,não tem opção de configurar os controles,os carros parece que estão amarrados.jogo não presta para quem tem cockpit no pc', '2025-06-18 16:32:38', '1', 3, 3, 1),
(60, 'Tentei jogar e não consegui! Avançava um pouco no mapa e dava erro na engine Unreal saindo do game. Meu PC supera as configs recomendadas, mas parece que o motor gráfico ( Unreal 5) não está 100%. Estou louco pra jogar esse clássico, mas infelizmente não foi dessa vez...lamento.', '2025-06-18 16:33:41', '1', 1, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogo`
--

CREATE TABLE `jogo` (
  `id` int(10) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `url_img` varchar(500) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `nota` int(11) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogo`
--

INSERT INTO `jogo` (`id`, `nome`, `url_img`, `descricao`, `nota`, `slug`, `plataforma`) VALUES
(1, 'Silent Hill 2', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5l7s.png', 'Atraído por uma carta misteriosa de sua falecida esposa, James explora a misteriosa cidade de Silent Hill. O que o aguarda é um pesadelo encoberto por ferrugem e névoa e habitado por monstros. ', 4, 'silent-hill-2', 1),
(2, 'Stardew Valley', 'https://images.igdb.com/igdb/image/upload/t_cover_big/xrpmydnu9rpxvxfjkiu7.png', '“Você herdou a antiga fazenda do seu avô, em Stardew Valley. Com ferramentas de segunda-mão e algumas moedas, você parte para dar início a sua nova vida.”', 5, 'stardew-valley', 1),
(3, 'NFS Heat', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co209t.png', 'Trabalhe de dia e arrisque tudo à noite em Need for Speed™ Heat, um jogo eletrizante de corridas de rua, onde a lei desaparece com o pôr do sol.', 2, 'need-for-speed-heat', 1),
(4, 'Marvel\'s Spider-Man 2: Launch Edition', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6niz.png', 'Pendure-se, pule e plane com as novas Asas de Teia para percorrer a Nova York da Marvel. Alterne rapidamente entre Peter Parker e Miles Morales para jogar histórias diferentes e usar novos poderes épicos enquanto o infame vilão Venom ameaça a vida deles, ', 5, 'marvels-spider-man-2-launch-edition', 2),
(5, 'The Last of Us', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5ziw.png', 'Em uma civilização devastada, em que infectados e sobreviventes veteranos estão à solta, Joel, um protagonista abatido, é contratado para tirar uma garota de 14 anos, Ellie, de uma zona de quarentena militar. No entanto, o que começa como um pequeno servi', 5, 'the-last-of-us', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `plataforma`
--

CREATE TABLE `plataforma` (
  `id` int(5) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  `nota` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `plataforma`
--

INSERT INTO `plataforma` (`id`, `nome`, `url_img`, `nota`) VALUES
(1, 'Steam', 'https://www.teteututors.tech/wp-content/uploads/2022/04/steam-logo-fundo-azul.png', 5),
(2, 'Playstation 5', 'https://static0.gamerantimages.com/wordpress/wp-content/uploads/2024/06/playstat-ion-ps-logo-blue-background.jpg', 3),
(3, 'Xbox Series', 'https://observatoriodegames.com.br/wp-content/uploads/2023/10/logo-xbox-1024x768.png', 4),
(4, 'PC', 'https://cdn.dribbble.com/userupload/12768721/file/original-afff28bc9d644b90debc8cdc0aa80fb8.jpg', 5),
(5, 'Geforce Now', 'https://uploads.sempreupdate.com.br/2023/03/1-15-1024x576.jpg', 5),
(6, 'Nintendo Switch ', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Nintendo_Switch_logo.svg/2048px-Nintendo_Switch_logo.svg.png', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` char(60) NOT NULL,
  `is_superuser` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `is_superuser`) VALUES
(1, 'Leandro', 'leandro@gmail.com', '$2y$10$mOxF3h9pAdFCA/gLM3Tr5uUa.9uzkn62VDyWeEKnV9jPUdjpFu5Za', NULL),
(2, 'maykon', 'maykon@gmail.com', '$2y$10$muFqGsHZVhsMvAZf6H9KHur9AdyBc3mCRCWTivZL45w2BuRZi3GkS', NULL),
(3, 'joana', 'joana@gmail', '$2y$10$Zmu8ckQGy3qe3bDYHPSg3.jJPzskcKjyQ7v01c5JVN8HoyL72EpAm', NULL),
(5, 'lokoabreu', 'lokoabreu@gmail.com', '$2y$10$iXgMq24L/eJbONg1I3UpG.K8XHYzEEkI9o6SYYkZL8SUWSsSNRUmK', NULL),
(6, 'Kalel', 'kalel@gmail.com', '$2y$10$sI29sK8QrMoXxOkMnUmyi.T.RpMzHi0z0Q7Vr1p71wyHax8FjRITe', 1),
(7, 'Diego', 'diego@gmail.com', '$2y$10$vrusuh3ttVs9hFW5.yvkbOkyBVKK7WXx31GgzjnY9.pccttMnlMB6', NULL),
(9, 'jao', 'jao@gmail.com', '$2y$10$.WPM0Q4mAwq1sFbBGH8sYu.kThn3jRxpmuu5ch4wQF9kxDgvSMMvC', NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `plataforma_id` (`plataforma`);

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
  MODIFY `id_com` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

--
-- Restrições para tabelas `jogo`
--
ALTER TABLE `jogo`
  ADD CONSTRAINT `jogo_ibfk_1` FOREIGN KEY (`plataforma`) REFERENCES `plataforma` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
