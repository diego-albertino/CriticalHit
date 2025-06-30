-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2025 às 22:55
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
(4, 'Amei mimosa', '2025-06-02 17:56:39', '5', 2, 3, 1),
(5, 'adorei amores, tudo de bom, arrasou', '2025-06-30 17:25:26', '5', 2, 3, 1),
(7, '(°_°)', '2025-06-30 14:42:51', '0', 4, 3, 1),
(22, 'Stardew Valley é um jogo que proporciona uma experiência única e imersiva no gênero de simulação agrícola. O que mais chama atenção é a combinação equilibrada entre a simplicidade dos gráficos pixelados e a complexidade das atividades disponíveis, que vão desde o cultivo de plantas até a interação profunda com os moradores da vila. O sistema de progressão é bastante recompensador, permitindo que o jogador personalize sua fazenda e desenvolva suas habilidades de forma gradual, o que mantém o interesse a longo prazo.\r\n\r\nAlém disso, o jogo oferece um ritmo tranquilo, ideal para quem busca uma pausa do estresse cotidiano, sem abrir mão de desafios e objetivos claros. A variedade de missões, eventos sazonais e exploração de cavernas traz uma dinâmica que evita a monotonia. Outro ponto forte é a narrativa sutil e envolvente, que cria uma conexão emocional com os personagens, incentivando o jogador a investir tempo para conhecê-los melhor.\r\n👨‍🌾👨‍🌾👨‍🌾🌽🍓🍅', '2025-06-30 18:33:15', '5', 2, 3, 1),
(23, '⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿\r\n⣿⠟⠫⢻⣿⣿⣿⣿⢟⣩⡍⣙⠛⢛⣿⣿⣿⠛⠛⠛⠛⠻⣿⣿⣿⣿⣿⡿⢿⣿\r\n⣿⠤⠄⠄⠙⢿⣿⣿⣿⡿⠿⠛⠛⢛⣧⣿⠇⠄⠂⠄⠄⠄⠘⣿⣿⣿⣿⠁⠄⢻\r\n⣿⣿⣿⣿⣶⣄⣾⣿⢟⣼⠒⢲⡔⣺⣿⣧⠄⠄⣠⠤⢤⡀⠄⠟⠉⣠⣤⣤⣤⣾\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⣟⣀⣬⣵⣿⣿⣿⣶⡤⠙⠄⠘⠃⠄⣴⣾⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⢻⠿⢿⣿⣿⠿⠋⠁⠄⠂⠉⠒⢘⣿⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⣿⡿⣡⣷⣶⣤⣤⣀⡀⠄⠄⠄⠄⠄⠄⠄⣾⣿⣿⣿⣿⣿⣿\r\n⣿⣿⣿⣿⣿⣿⣿⡿⣸⣿⣿⣿⣿⣿⣿⣿⣷⣦⣰⠄⠄⠄⠄⢾⠿⢿⣿⣿⣿⣿\r\n⣿⡿⠋⣡⣾⣿⣿⣿⡟⠉⠉⠈⠉⠉⠉⠉⠉⠄⠄⠄⠑⠄⠄⠐⡇⠄⠈⠙⠛⠋\r\n⠋⠄⣾⣿⣿⣿⣿⡿⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄⢠⡇⠄⠄⠄⠄⠄\r\n⠄⢸⣿⣿⣿⣿⣿⣯⠄⢠⡀⠄⠄⠄⠄⠄⠄⠄⠄⣀⠄⠄⠄⠄⠁⠄⠄⠄⠄⠄\r\n⠁⢸⣿⣿⣿⣿⣿⣯⣧⣬⣿⣤⣐⣂⣄⣀⣠⡴⠖⠈⠄⠄⠄⠄⠄⠄⠄⠄⠄⠄\r\n⠈⠈⣿⣟⣿⣿⣿⣿⣿⣿⣿⣿⣽⣉⡉⠉⠈⠁⠄⠁⠄⠄⠄⠄⡂⠄⠄⠄⠄⠄\r\n⠄⠄⠙⣿⣿⠿⣿⣿⣿⣿⣷⡤⠈⠉⠉⠁⠄⠄⠄⠄⠄⠄⠄⠠⠔⠄⠄⠄⠄⠄\r\n⠄⠄⠄⡈⢿⣷⣿⣿⢿⣿⣿⣷⡦⢤⡀⠄⠄⠄⠄⠄⠄⢐⣠⡿⠁⠄⠄⠄⠄⠄', '2025-06-30 17:26:03', '4', 2, 4, 2),
(24, '(°o°)', '2025-06-30 17:25:49', '5', 2, 2, 1),
(27, 'Muito emocionate, pena que o Joel...', '2025-06-30 17:28:21', '5', 5, 2, 1),
(28, 'Faz o Elli', '2025-06-30 17:28:01', '2', 5, 5, 1),
(34, 'ruim', '2025-06-16 00:52:58', '5', 4, 1, 2),
(43, 'rancho feliz', '2025-06-18 18:45:37', '5', 2, 7, 1),
(44, 'Jogabilidade refinada, com combates tensos e furtivos', '2025-06-18 18:51:34', '5', 5, 7, 1),
(45, 'Gráficos incríveis, com Nova York ainda mais viva e detalhada.', '2025-06-18 19:17:22', '5', 4, 6, 2),
(46, 'NFS Heat resgata a essência das melhores fases da franquia.', '2025-06-18 19:18:02', '5', 3, 6, 1),
(47, 'Jogo relaxante, perfeito para quem busca uma pausa da rotina', '2025-06-18 19:18:35', '5', 2, 5, 1),
(48, 'Silent Hill 2 é uma obra-prima que mistura horror, drama e tragédia humana', '2025-06-18 19:19:11', '5', 1, 7, 1),
(54, '░░░░▄▄▄▄▀▀▀▀▀▀▀▀▄▄▄▄▄▄\r\n░░░░█░░░░▒▒▒▒▒▒▒▒▒▒▒▒░░▀▀▄\r\n░░░█░░░▒▒▒▒▒▒░░░░░░░░▒▒▒░░█\r\n░░█░░░░░░▄██▀▄▄░░░░░▄▄▄░░░█\r\n░▀▒▄▄▄▒░█▀▀▀▀▄▄█░░░██▄▄█░░░█\r\n█▒█▒▄░▀▄▄▄▀░░░░░░░░█░░░▒▒▒▒▒█\r\n█▒█░█▀▄▄░░░░░█▀░░░░▀▄░░▄▀▀▀▄▒█\r\n░█▀▄░█▄░█▀▄▄░▀░▀▀░▄▄▀░░░░█░░█\r\n░░█░░▀▄▀█▄▄░█▀▀▀▄▄▄▄▀▀█▀██░█\r\n░░░█░░██░░▀█▄▄▄█▄▄█▄████░█\r\n░░░░█░░░▀▀▄░█░░░█░███████░█\r\n░░░░░▀▄░░░▀▀▄▄▄█▄█▄█▄█▄▀░░█\r\n░░░░░░░▀▄▄░▒▒▒▒░░░░░░░░░░█\r\n░░░░░░░░░░▀▀▄▄░▒▒▒▒▒▒▒▒▒▒░█\r\n░░░░░░░░░░░░░░▀▄▄▄▄▄░░░░░█', '2025-06-30 17:27:04', '3', 1, 4, 1),
(55, '░░░░░░███████ ]▄▄▄▄▄▄▄▄\r\n ▂▄▅█████████▅▄▃▂        \r\n[███████████████████]. \r\n◥⊙▲⊙▲⊙▲⊙▲⊙▲⊙▲⊙◤..', '2025-06-18 20:26:25', '0', 3, 7, 1),
(56, '░░░░░░░░░░░░░░░░▄▓▄\r\n░░░░▄█▄░░░░░░░░▄▓▓▓▄\r\n░░▄█████▄░░░░░▄▓▓▓▓▓▄\r\n░▀██┼█┼██▀░░░▄▓▓▓▓▓▓▓▄\r\n▄▄███████▄▄▄▄▄▄▄▄█▄▄▄▄', '2025-06-18 20:27:42', '5', 2, 7, 1),
(57, 'Um jogo para se emocionar!\r\n\r\nNão sou de escrever tantas resenhas detalhadas na Steam, mas acabei de zerar TLOU 2 no exato momento em que estou escrevendo isso, e acho que seria injusto não falar de uma história tão fantástica quanto este jogo é! Pouparei os spoilers por aqui porque já sofri muito com eles nos últimos 4 anos em que aguardei pela chegada dessa franquia para PC, e acho que, apesar de não ter afetado tanto a minha diversão experienciando este jogo, acabou limitando a minha emoção e na imersão que eu poderia ter tido de uma maneira muito maior se não soubesse de absolutamente nada do que aconteceria.\r\n\r\nJogabilidade: 10/10\r\n\r\nPra quem acompanha páginas de jogos no falecido \"Twitter\", sabe que posts elogiando a gameplay de TLOU 2 são tão genéricos quanto falar do jardineiro do Leicester City, mas convenhamos: que jogabilidade delicinha! Variar a maneira de matar inimigos, seja no 100% stealthy ou botando o p4u na mesa e chegando no estilo \"tiro, porrada e bomba\" é uma das m', '2025-06-18 20:29:49', '5', 5, 1, 1),
(58, 'Gameplay com os carros, compra das peças e customização é até divertida, no entanto a mecânica de perseguição de polícia e ter que seguir a pista passando por certos \"pontos de checagem\" obrigatórios tira quase que completamente a graça do jogo! No início do jogo é basicamente impossível fugir da polícia o que gera penalidade de vc perder dinheiro o que apaga parte do seu progresso as vezes de horas. Conforme vc melhora o carro não muda muita coisa tbm. Simplesmente uma das piores mecânicas que já vi em qualquer jogo!! Daria uma nota 7.5/10, mas como existe o lixo da polícia roubada e vc não poder cortar caminho... no máximo dou 5/10... só vale comprar na promoção e olhe lá!', '2025-06-18 20:31:08', '3', 3, 6, 1),
(59, 'mais um jogo do tipo console,não tem câmera interna,não tem opção de configurar os controles,os carros parece que estão amarrados.jogo não presta para quem tem cockpit no pc', '2025-06-18 20:32:38', '1', 3, 3, 1),
(60, 'Tentei jogar e não consegui! Avançava um pouco no mapa e dava erro na engine Unreal saindo do game. Meu PC supera as configs recomendadas, mas parece que o motor gráfico ( Unreal 5) não está 100%. Estou louco pra jogar esse clássico, mas infelizmente não foi dessa vez...lamento.', '2025-06-18 20:33:41', '1', 1, 3, 1),
(61, '🐯', '2025-06-23 17:25:24', '5', 11, 6, 1),
(62, '\"Dê um trocado pro seu bruxo, oh vale abundante...\"', '2025-06-23 17:26:14', '5', 10, 7, 3),
(66, 'Cj', '2025-06-30 18:34:05', '2', 8, 7, 3),
(67, 'Star Wars sempre foi uma saga épica que combina aventura, mistério e muita ação... ATCHIM! Desculpa, estava só pensando na Força e me deu um espirro aqui. Mas falando sério, os efeitos especiais continuam incríveis, e o universo expandido só cresce, deixando a gente cada vez mais fã dessa galáxia muito, muito distante.', '2025-06-30 19:42:31', '5', 14, 11, 1),
(68, 'Prefiro a marvel', '2025-06-30 19:44:33', '1', 13, 11, 1),
(69, 'Criatividade é que nos limita, jogo sensacional.', '2025-06-30 19:45:21', '5', 19, 11, 1),
(70, 'Como jogador, preciso dizer que Elden Ring é ao mesmo tempo uma obra-prima e um teste de paciência. O mundo aberto é imersivo, com paisagens épicas e uma liberdade de exploração que poucos jogos oferecem. No entanto, a dificuldade extrema em certos momentos pode parecer punitiva demais, especialmente para jogadores menos experientes. A ausência de um sistema de orientação mais claro às vezes torna a progressão frustrante. Apesar disso, a sensação de conquista após vencer chefes difíceis é única. No geral, é um jogo brilhante, mas definitivamente não é para todos.', '2025-06-30 19:48:20', '5', 17, 11, 3),
(71, 'Como jogador, GTA: San Andreas marcou época e ainda hoje é um dos títulos mais memoráveis da franquia. A ambientação nos anos 90, a trilha sonora e a história do CJ são envolventes do início ao fim. ', '2025-06-30 19:49:12', '4', 8, 11, 3),
(72, ' A ideia é incrível, e domar criaturas gigantes sempre é empolgante. Porém, o jogo peca na otimização — mesmo em máquinas potentes, os bugs e quedas de desempenho são frequentes. O sistema de progressão é interessante, mas o grind pode ser exagerado. Em multiplayer, a experiência melhora muito, com tribos e disputas territoriais que tornam tudo mais dinâmico. No geral, ARK é divertido, mas exige paciência com seus problemas técnicos.', '2025-06-30 19:50:07', '3', 15, 7, 3),
(73, 'O universo de naruto é incrível, o jogo me faz me sentir no anime', '2025-06-30 19:50:54', '5', 20, 7, 2),
(75, 'Batalhas insanas', '2025-06-30 19:51:48', '5', 16, 7, 2),
(76, 'A mecânica do parkour é boa, mas poderia ser melhor como no Assassins Cred', '2025-06-30 19:53:06', '3', 14, 7, 1),
(77, '8 Ball Pool é um jogo de sinuca para celular com jogabilidade viciante, gráficos de qualidade e diversos modos de jogo. No entanto, a experiência é prejudicada pela grande quantidade de anúncios e a impossibilidade de sacar as moedas e notas acumuladas. Além disso, a física do jogo parece falhar em alguns momentos, me passa a  sensação de que a mesa de jogo está torta.', '2025-06-30 19:56:44', '2', 22, 13, 1),
(78, 'Joguei o novo jogo do Superman e achei interessante como tentaram capturar a sensação de voar rápido e salvar pessoas. Só que, sinceramente, ninguém consegue sair voando a mais de 1000 km/h sem ficar meio tonto, né? Quer dizer, não que eu saiba de alguém que já tenha feito isso pessoalmente... 😅\r\n', '2025-06-30 20:01:06', '4', 13, 6, 1),
(79, 'League of Legends é basicamente um teste psicológico disfarçado de jogo. Você entra pra jogar uma partidinha rápida e sai questionando suas escolhas de vida. O matchmaking parece feito por um dado de 6 lados, onde 5 são \"time troll\" e 1 é \"chance de vitória\". E o chat? Um verdadeiro zoológico, mas sem jaula. O jogo até tem sua dose de estratégia e habilidade, mas isso tudo vai por água abaixo quando o top resolve fazer cosplay de torre. Enfim, LoL é divertido… até você apertar \"Iniciar\".', '2025-06-30 20:04:21', '1', 24, 17, 4),
(80, 'Domar dinossauros nunca foi tão divertido! Só falta domar o lag agora.', '2025-06-30 20:11:12', '4', 15, 1, 3),
(81, 'Quando achei que estava seguro, um T-Rex apareceu do nada. Ark é adrenalina pura!', '2025-06-30 20:11:12', '5', 15, 2, 3),
(82, 'O multiplayer é caótico e maravilhoso, mas meus amigos sempre me deixam pra trás!', '2025-06-30 20:11:12', '4', 15, 3, 3),
(83, 'Construir base é legal, mas os raids noturnos me tiram o sono!', '2025-06-30 20:11:12', '3', 15, 4, 3),
(84, 'Se você gosta de desafios e surpresas, Ark é o jogo certo. Só não se apegue aos seus dinos...', '2025-06-30 20:11:12', '5', 15, 5, 3),
(85, 'Comecei construindo uma casa, terminei criando uma cidade inteira. Minecraft é infinito!', '2025-06-30 20:11:12', '5', 19, 6, 1),
(86, 'Nada como minerar diamante e cair na lava logo depois. Emoção garantida!', '2025-06-30 20:11:12', '4', 19, 7, 1),
(87, 'Jogo perfeito para relaxar ou perder a noção do tempo. Recomendo!', '2025-06-30 20:15:05', '5', 19, 15, 1),
(88, 'Redstone é magia negra, mas quando funciona é lindo demais.', '2025-06-30 20:25:49', '5', 19, 16, 1),
(89, 'Sobreviver à primeira noite é só o começo do vício!', '2025-06-30 20:11:12', '5', 19, 12, 1),
(90, 'Fazer combos com o Naruto nunca cansa! Jogo top demais!', '2025-06-30 20:11:12', '5', 20, 13, 2),
(91, 'O modo história me fez chorar de novo, igual ao anime.', '2025-06-30 20:11:12', '5', 20, 14, 2),
(92, 'Lutar contra amigos é sempre uma zoeira, principalmente de Itachi.', '2025-06-30 20:11:12', '4', 20, 15, 2),
(93, 'Os gráficos e as lutas são insanas, só faltou um modo online melhor.', '2025-06-30 20:11:12', '4', 20, 16, 2),
(94, 'Naruto Storm 4 é fan service puro, e eu amei cada segundo!', '2025-06-30 20:11:12', '5', 20, 17, 2),
(95, 'Morri para o primeiro chefe e já sabia que ia amar esse jogo!', '2025-06-30 20:11:12', '5', 17, 1, 3),
(96, 'O mapa é gigantesco, cada canto tem uma surpresa (ou uma morte).', '2025-06-30 20:11:12', '5', 17, 2, 3),
(97, 'A trilha sonora faz cada batalha parecer épica!', '2025-06-30 20:11:12', '5', 17, 3, 3),
(98, 'Nunca pensei que apanhar tanto de um jogo fosse tão divertido.', '2025-06-30 20:11:12', '4', 17, 4, 3),
(99, 'Elden Ring é difícil, mas a sensação de vitória é indescritível.', '2025-06-30 20:11:12', '5', 17, 5, 3),
(100, 'Dota 2: onde a amizade acaba e o tilt começa!', '2025-06-30 20:11:12', '3', 12, 6, 1),
(101, 'Cada partida é uma história diferente, geralmente de sofrimento.', '2025-06-30 20:11:12', '4', 12, 7, 1),
(102, 'Quando o time acerta as ultimates, é lindo de ver!', '2025-06-30 20:11:12', '5', 12, 10, 1),
(103, 'Jogo há anos e ainda não aprendi a wardar direito.', '2025-06-30 20:11:12', '2', 12, 11, 1),
(104, 'Dota é amor e ódio em doses iguais. Impossível largar.', '2025-06-30 20:11:12', '4', 12, 12, 1),
(105, 'Kong finalmente ganhou um jogo só dele! Senti falta de mais bananas, mas valeu a aventura.', '2025-06-30 20:13:30', '4', 21, 4, 3),
(106, 'Os gráficos são bonitos, mas a câmera me deixou tonto em algumas partes.', '2025-06-30 20:13:30', '3', 21, 5, 3),
(107, 'Batalhar contra monstros gigantes é sempre divertido, só queria que o Kong pulasse mais alto!', '2025-06-30 20:13:30', '4', 21, 6, 3),
(108, 'A história é simples, mas ver o Kong crescer é muito satisfatório.', '2025-06-30 20:13:30', '5', 21, 7, 3),
(109, 'Jogo curto, mas intenso. Recomendo para quem curte ação sem enrolação.', '2025-06-30 20:13:30', '4', 21, 11, 3),
(110, 'Geralt é o bruxão mais carismático dos games! As escolhas realmente mudam tudo.', '2025-06-30 20:13:30', '5', 10, 1, 3),
(111, 'Passei mais tempo jogando Gwent do que caçando monstros. Viciante!', '2025-06-30 20:13:30', '5', 10, 2, 3),
(112, 'O mundo aberto é lindo, mas as missões secundárias são o verdadeiro destaque.', '2025-06-30 20:13:30', '5', 10, 3, 3),
(113, 'Trilha sonora épica, história envolvente e gráficos de cair o queixo.', '2025-06-30 20:13:30', '5', 10, 4, 3),
(114, 'Só não dou nota máxima porque o inventário me deixou perdido no começo.', '2025-06-30 20:13:30', '4', 10, 5, 3),
(115, 'CJ, volta pra Grove Street! Nostalgia pura, melhor GTA de todos.', '2025-06-30 20:13:30', '5', 8, 6, 3),
(116, 'As missões de bicicleta são um clássico, mas apanhei pra passar algumas.', '2025-06-30 20:13:30', '4', 8, 7, 3),
(117, 'Trilha sonora perfeita para sair dirigindo sem rumo por Los Santos.', '2025-06-30 20:13:30', '5', 8, 10, 3),
(118, 'O mapa é enorme, sempre descubro algo novo mesmo depois de anos.', '2025-06-30 20:13:30', '5', 8, 11, 3),
(119, 'Só não gostei dos gráficos envelhecidos, mas a diversão compensa tudo.', '2025-06-30 20:13:30', '4', 8, 12, 3),
(120, 'Dominar tigres-dente-de-sabre é a melhor parte do jogo!', '2025-06-30 20:13:30', '5', 11, 13, 1),
(121, 'A ambientação pré-histórica é incrível, me senti um verdadeiro caçador.', '2025-06-30 20:13:30', '4', 11, 14, 1),
(122, 'Faltou um pouco mais de variedade nas armas, mas a experiência é única.', '2025-06-30 20:13:30', '4', 11, 15, 1),
(123, 'Gráficos lindos e trilha sonora imersiva, recomendo para quem gosta de aventura.', '2025-06-30 20:13:30', '5', 11, 16, 1),
(124, 'Jogar com lanças e tacapes é diferente de tudo que já vi em Far Cry.', '2025-06-30 20:13:30', '5', 11, 17, 1),
(125, 'A sensação de usar o sabre de luz é simplesmente incrível! Me senti um verdadeiro Jedi.', '2025-06-30 20:17:39', '5', 14, 1, 1),
(126, 'A história é envolvente e cheia de reviravoltas, digno do universo Star Wars.', '2025-06-30 20:17:39', '5', 14, 2, 1),
(127, 'Os puzzles são desafiadores, mas nada que a Força não resolva!', '2025-06-30 20:17:39', '4', 14, 3, 1),
(128, 'Os combates são intensos, mas às vezes a câmera atrapalha um pouco.', '2025-06-30 20:17:39', '4', 14, 4, 1),
(129, 'O melhor jogo de Star Wars dos últimos anos, recomendo para todos os fãs!', '2025-06-30 20:17:39', '5', 14, 5, 1),
(135, 'A sensação de usar o sabre de luz é simplesmente incrível! Me senti um verdadeiro Jedi.', '2025-06-30 20:17:54', '5', 14, 1, 1),
(136, 'A história é envolvente e cheia de reviravoltas, digno do universo Star Wars.', '2025-06-30 20:17:54', '5', 14, 2, 1),
(137, 'Os puzzles são desafiadores, mas nada que a Força não resolva!', '2025-06-30 20:17:54', '4', 14, 3, 1),
(138, 'Os combates são intensos, mas às vezes a câmera atrapalha um pouco.', '2025-06-30 20:17:54', '4', 14, 4, 1),
(144, 'A sensação de usar o sabre de luz é simplesmente incrível! Me senti um verdadeiro Jedi.', '2025-06-30 20:18:09', '5', 14, 1, 1),
(145, 'A história é envolvente e cheia de reviravoltas, digno do universo Star Wars.', '2025-06-30 20:18:09', '5', 14, 2, 1),
(146, 'Os puzzles são desafiadores, mas nada que a Força não resolva!', '2025-06-30 20:18:09', '4', 14, 3, 1),
(147, 'Os combates são intensos, mas às vezes a câmera atrapalha um pouco.', '2025-06-30 20:18:09', '4', 14, 4, 1),
(148, 'O melhor jogo de Star Wars dos últimos anos, recomendo para todos os fãs!', '2025-06-30 20:18:09', '5', 14, 5, 1),
(154, 'Humor ácido e piadas para adultos, Conker é único!', '2025-06-30 20:18:09', '5', 23, 13, 1),
(155, 'Nunca ri tanto jogando um game, as referências são geniais.', '2025-06-30 20:18:09', '5', 23, 14, 1),
(156, 'Os gráficos envelheceram, mas a diversão continua garantida.', '2025-06-30 20:18:09', '4', 23, 15, 1),
(157, 'Jogo perfeito para quem gosta de zoeira e desafios inesperados.', '2025-06-30 20:18:09', '5', 23, 16, 1),
(158, 'Conker é politicamente incorreto e maravilhoso, um clássico cult!', '2025-06-30 20:18:09', '5', 23, 17, 1),
(159, 'League of Legends é diversão e rage na mesma medida. Nunca sei se vou rir ou chorar!', '2025-06-30 20:23:27', '3', 24, 6, 4),
(160, 'O matchmaking é uma caixinha de surpresas, mas as partidas épicas compensam.', '2025-06-30 20:23:27', '4', 24, 7, 4),
(161, 'Quando o time joga junto, é lindo de ver. Pena que quase nunca acontece!', '2025-06-30 20:23:27', '2', 24, 10, 4),
(162, 'A comunidade é tóxica, mas não consigo parar de jogar. É um vício!', '2025-06-30 20:23:27', '3', 24, 11, 4),
(163, 'Cada atualização muda tudo, sempre tem algo novo para aprender.', '2025-06-30 20:23:27', '4', 24, 12, 4);

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
(1, 'Silent Hill 2', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5l7s.png', 'Atraído por uma carta misteriosa de sua falecida esposa, James explora a misteriosa cidade de Silent Hill. O que o aguarda é um pesadelo encoberto por ferrugem e névoa e habitado por monstros. ', 3, 'silent-hill-2', 1),
(2, 'Stardew Valley', 'https://images.igdb.com/igdb/image/upload/t_cover_big/xrpmydnu9rpxvxfjkiu7.png', '“Você herdou a antiga fazenda do seu avô, em Stardew Valley. Com ferramentas de segunda-mão e algumas moedas, você parte para dar início a sua nova vida.”', 5, 'stardew-valley', 1),
(3, 'NFS Heat', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co209t.png', 'Trabalhe de dia e arrisque tudo à noite em Need for Speed™ Heat, um jogo eletrizante de corridas de rua, onde a lei desaparece com o pôr do sol.', 2, 'need-for-speed-heat', 1),
(4, 'Marvel\'s Spider-Man 2: Launch Edition', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6niz.png', 'Pendure-se, pule e plane com as novas Asas de Teia para percorrer a Nova York da Marvel. Alterne rapidamente entre Peter Parker e Miles Morales para jogar histórias diferentes e usar novos poderes épicos enquanto o infame vilão Venom ameaça a vida deles, ', 3, 'marvels-spider-man-2-launch-edition', 2),
(5, 'The Last of Us', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5ziw.png', 'Em uma civilização devastada, em que infectados e sobreviventes veteranos estão à solta, Joel, um protagonista abatido, é contratado para tirar uma garota de 14 anos, Ellie, de uma zona de quarentena militar. No entanto, o que começa como um pequeno servi', 4, 'the-last-of-us', 1),
(8, 'Grand Theft Auto: San Andreas', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2lb9.jpg', 'Returning after his mother\\\'s murder to the semi-fictional city of Los Santos (based on Los Angeles), Carl Johnson, a former gang banger, must take back the streets for his family and friends by gaining respect and once again gaining control over the stre', 4, 'grand-theft-auto-san-andreas', 3),
(10, 'The Witcher 3: Wild Hunt', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1wyy.jpg', 'The Witcher 3: Wild Hunt is an open-world action role-playing game developed by CD Projekt Red.\\n\\nSet in a dark fantasy world, the game follows Geralt of Rivia, a monster hunter searching for his adopted daughter, Ciri, while navigating political conflic', 5, 'the-witcher-3-wild-hunt', 3),
(11, 'Far Cry: Primal', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co28ha.jpg', 'Gamers play as TAKKAR, a seasoned hunter and the last surviving member of his hunting group. Arriving in the majestic and savage land of Oros, players will pursue one single goal; survive in a world where humans are the prey. They will meet a cast of memo', 5, 'far-cry-primal', 1),
(12, 'Dota 2', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6ene.jpg', 'Dota 2 is a multiplayer online battle arena video game and the stand-alone sequel to the Defense of the Ancients (DotA) mod. With regular updates that ensure a constant evolution of gameplay, features, and heroes, Dota 2 has taken on a life of its own.', 4, 'dota-2', 1),
(13, 'Superman: The New Superman Adventures', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2b3i.jpg', 'Superman: The New Adventures, often referred to as Superman 64, is a 1999 adventure video game developed and published by Titus Software for the Nintendo 64 video game console. The game is based on the television series Superman: The Animated Series. Supe', 2, 'superman-the-new-superman-adventures', 1),
(14, 'Star Wars Jedi: Fallen Order', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rbi.jpg', 'Star Wars Jedi: Fallen Order is a narratively driven, single-player game puts you in the role of a Jedi Padawan who narrowly escaped the purge of Order 66 following the events of Episode III: Revenge of the Sith. On a quest to rebuild the Jedi Order, you ', 4, 'star-wars-jedi-fallen-order', 1),
(15, 'Ark: Ultimate Survivor Edition', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3h8q.jpg', 'ARK: Ultimate Survivor Edition includes base game ARK: Survival Evolved and the following Expansion Packs:\\n- Scorched Earth\\n- Aberration\\n- Extinction\\n- Genesis Parts 1 & 2.\\n\\nAs an additional bonus, this compilation also includes original soundtracks', 4, 'ark-ultimate-survivor-edition', 3),
(16, 'Dragon Ball Xenoverse and Dragon Ball Xenoverse 2 Double Pack', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co7zoy.jpg', 'Includes both Dragon Ball Xenoverse and Dragon Ball Xenoverse 2.', 5, 'dragon-ball-xenoverse-and-dragon-ball-xenoverse-2-double-pack', 2),
(17, 'Elden Ring', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co4jni.jpg', 'Elden Ring is an action RPG developed by FromSoftware and published by Bandai Namco Entertainment, released in February 2022. Directed by Hidetaka Miyazaki, with world-building contributions from novelist George R. R. Martin, the game features an expansiv', 5, 'elden-ring', 3),
(18, 'Mario Kart 64', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co67hm.jpg', 'Mario Kart 64 is the second main installment of the Mario Kart series. It is the first game in the series to use three-dimensional graphics, however, the characters and items in this game are still two-dimensional, pre-rendered sprites. The game offers tw', 0, 'mario-kart-64', 1),
(19, 'Minecraft', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co8fu7.jpg', 'Minecraft focuses on allowing the player to explore, interact with, and modify a dynamically-generated map made of one-cubic-meter-sized blocks. In addition to blocks, the environment features plants, mobs, and items. Some activities in the game include m', 5, 'minecraft', 1),
(20, 'Naruto Shippuden: Ultimate Ninja Storm 4', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3whm.jpg', 'Experience the exhilarating full-adventure Naruto Shippuden and follow Naruto Uzumaki on all his fights.\\n\\nWith more than 12 million Naruto Shippuden Ultimate Ninja STORM games sold worldwide, this series established itself among the pinnacle of Anime & ', 5, 'naruto-shippuden-ultimate-ninja-storm-4', 2),
(21, 'Skull Island: Rise of Kong', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co70sr.jpg', 'Embark on a 3rd person action-adventure quest to avenge the death of your parents at the hands of the ultimate alpha predator: Gaw. Conquer waves of primal beasts and defeat the minions of your arch-nemesis on your way to becoming the rightful King of Sku', 4, 'skull-island-rise-of-kong', 3),
(22, '8 Ball Pool', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2pcx.jpg', 'Play with friends! Play with Legends. Play the hit Miniclip 8 Ball Pool game on your mobile and become the best!\\n\\nRefine your skills in the practice arena, take on the world in 1-vs-1 matches, or enter tournaments to win trophies and exclusive cues!', 2, '8-ball-pool', 1),
(23, 'Conker\\\'s Bad Fur Day', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1uq6.jpg', 'Humorous action-platformer that does away with the tedious item collection found in most games in the genre. Instead, BFD employs a combination of standard jump, run and explore mechanics and context-sensitive gags and actions. For instance, in the beginn', 5, 'conker-s-bad-fur-day', 1),
(24, 'League of Legends', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co49wj.jpg', 'League of Legends is a fast-paced, competitive online game that blends the speed and intensity of an RTS with RPG elements. Two teams of powerful champions, each with a unique design and playstyle, battle head-to-head across multiple battlefields and game', 3, 'league-of-legends', 4);

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
-- Estrutura para tabela `solicitacao_jogo`
--

CREATE TABLE `solicitacao_jogo` (
  `id_solicitacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo_solicitado` text NOT NULL,
  `desc_solicitado` text NOT NULL,
  `solicitacao_atendida` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `solicitacao_jogo`
--

INSERT INTO `solicitacao_jogo` (`id_solicitacao`, `id_usuario`, `titulo_solicitado`, `desc_solicitado`, `solicitacao_atendida`) VALUES
(2, 1, 'GTA San Andreas', 'Queria GTA San Andreas... amo esse jogo! Por favor, incluam ae', 1),
(3, 7, 'Dota', '', 1),
(4, 3, 'Superman 64', '', 1),
(5, 8, 'Elden Ring', '', 1),
(6, 9, 'Minecraft', '', 1),
(7, 12, 'Skull Island: Rise of Kong', '', 1),
(8, 15, 'Naruto Storm 4', '', 1),
(9, 14, 'Mario Kart', '', 1),
(10, 8, 'Dragon Ball', '', 1),
(11, 1, 'Ark', '', 1),
(12, 11, 'Star wars', '', 1),
(13, 7, '8 Ball Pool', '', 1),
(14, 17, 'Conker\'s Bad Fur Day', '', 1),
(15, 17, 'Lol', '', 1),
(16, 1, 'Hollow Knight', 'Jogo de plataforma com arte linda, gostaria muito de ver no site!', 0),
(17, 2, 'Red Dead Redemption 2', 'Seria incrível ter esse clássico do velho oeste na lista!', 0),
(18, 3, 'Celeste', 'Jogo indie premiado, perfeito para quem gosta de desafio.', 0),
(19, 4, 'God of War Ragnarok', 'A continuação da saga do Kratos merece um espaço aqui!', 0),
(20, 5, 'Cyberpunk 2077', 'Agora que está otimizado, vale a pena adicionar ao catálogo!', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` char(60) NOT NULL,
  `is_superuser` tinyint(1) DEFAULT NULL,
  `avatar` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `is_superuser`, `avatar`) VALUES
(1, 'Leandro', 'leandro@gmail.com', '$2y$10$mOxF3h9pAdFCA/gLM3Tr5uUa.9uzkn62VDyWeEKnV9jPUdjpFu5Za', NULL, 4),
(2, 'maykon', 'maykon@gmail.com', '$2y$10$GqF4oIOJtvNoiSs/Qz3FwOSYhRq3zNwaIroXDRGurIr13uWUxT1NC', NULL, 13),
(3, 'joana', 'joana@gmail', '$2y$10$Zmu8ckQGy3qe3bDYHPSg3.jJPzskcKjyQ7v01c5JVN8HoyL72EpAm', NULL, 5),
(4, 'jao', 'jao@gmail.com', '$2y$10$c90m13s3fdjv9Bmg8777je05caInZJ.cVwwi8oWcnRYBJWnfVf3xm', NULL, 14),
(5, 'lokoabreu', 'lokoabreu@gmail.com', '$2y$10$iXgMq24L/eJbONg1I3UpG.K8XHYzEEkI9o6SYYkZL8SUWSsSNRUmK', NULL, 8),
(6, 'Kalel', 'kalel@hotmail.com', '$2y$10$sI29sK8QrMoXxOkMnUmyi.T.RpMzHi0z0Q7Vr1p71wyHax8FjRITe', 1, 13),
(7, 'Diego', 'diego@gmail.com', '$2y$10$vrusuh3ttVs9hFW5.yvkbOkyBVKK7WXx31GgzjnY9.pccttMnlMB6', NULL, 11),
(10, 'admin', 'admin@criticalhit.com', '$2y$10$ajnrB7ONWL0rMbAPzMlUQ.QIi86o3XYwCnRZtSF83hlNGY3K1SrDW', 1, 1),
(11, 'Lucas Liz', 'Lucas@hotmail.com', '$2y$10$7g.bE1My/U4juCC4Q.titugV/K3XvUt7z22q7XSMhaIl0f0ijdc7i', NULL, 10),
(12, 'Karol_1834', 'Karol@gmail.com', '$2y$10$q53OSQ6BH/XNG4KW/QW.W.oyXywcDMaBQ/2olPmrlrD8JLNfefOHG', NULL, 15),
(13, 'Agenor_ReiDoCapa', 'agenor123@gmail.com', '$2y$10$Xfkfnw0.a2AT4vsAAgfuU.pDtSsS9G8sY4UJ4mJW/GOfuys9pHJPy', NULL, 4),
(14, 'Hi-Man do Ceará', 'Himan@hotmail.com', '$2y$10$BLipwwYNwAH4uqiSGwTm6.UaZHFnY/zzWFrgglMEvVN/BaWqpDCyW', NULL, 6),
(15, 'Xaolim du Xertão', 'Xaolim@gmail.com', '$2y$10$Og1mapVHHps5A99sUpRvc.6zQqbu.oyKWzgqA.mMr7C3rrCuJYlme', NULL, NULL),
(16, 'Vinicius13', 'vinicius13@gmail.com', '$2y$10$B.iKhqicYzZAojEd8c/4eOTVxdwNcThen0ZxtYwkOiYr.rESxZILC', NULL, 10),
(17, 'xandão', 'xandao@gmail.com', '$2y$10$cKocAgJh1dxVCROmnZ0wKOl9ciefxkqFXVQaLrFCVSEpmTZKMpAFi', NULL, 7);

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
-- Índices de tabela `solicitacao_jogo`
--
ALTER TABLE `solicitacao_jogo`
  ADD PRIMARY KEY (`id_solicitacao`);

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
  MODIFY `id_com` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `solicitacao_jogo`
--
ALTER TABLE `solicitacao_jogo`
  MODIFY `id_solicitacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
