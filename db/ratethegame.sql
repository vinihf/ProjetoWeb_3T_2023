  -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2023 às 18:47
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ratethegame`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Ação'),
(2, 'Aventura'),
(3, 'Estratégia'),
(4, 'RPG'),
(5, 'Esportes'),
(6, 'Simulação'),
(7, 'Corrida'),
(8, 'Quebra-cabeça'),
(9, 'Plataforma'),
(10, 'FPS'),
(11, 'MMO'),
(12, 'Terror'),
(13, 'Luta'),
(14, 'Casual'),
(15, 'Indie');

-- --------------------------------------------------------

--
-- Estrutura para tabela `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `items`
--

INSERT INTO `items` (`id`, `name`, `image_url`) VALUES
(4, 'GTA V', 'uploads/6566b17d791be_imagem_2023-11-29_003421220.png'),
(5, 'The Witcher 3: Wild Hunt', 'uploads/6566b19ed1ce8_imagem_2023-11-29_003557857.png'),
(6, 'Minecraft', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOeGlFDL1furAXFVJ5R9A0qHiXX5OQrRr86A&usqp=CAU'),
(7, 'FIFA 21', 'https://cdn.folhape.com.br/img/pc/1100/1/dn_arquivo/2020/10/fifa-21-intros.jpg'),
(8, 'Call of Duty: Warzone', 'https://image.api.playstation.com/vulcan/ap/rnd/202306/2400/e5cf467175f4a1455ce65b4688952b391d3e15bde9114698.png'),
(9, "Assassin\'s Creed Valhalla", 'https://m.media-amazon.com/images/I/91lmTAVXgHL._AC_UF1000,1000_QL80_.jpg'),
(10, 'Red Dead Redemption 2', 'https://image.api.playstation.com/cdn/UP1004/CUSA03041_00/Hpl5MtwQgOVF9vJqlfui6SDB5Jl4oBSq.png'),
(11, 'Cyberpunk 2077', 'https://cdn1.epicgames.com/offer/77f2b98e2cef40c8a7437518bf420e47/EGS_Cyberpunk2077_CDPROJEKTRED_S1_03_2560x1440-359e77d3cd0a40aebf3bbc130d14c5c7'),
(12, 'Among Us', 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_1240/b_white/f_auto/q_auto/ncom/software/switch/70010000036098/758ab0b61205081da2466386940752c70e0e5ea43bd39e8b9b13eaa455c69b7e'),
(13, 'Animal Crossing: New Horizons', 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/software/switch/70010000027619/9989957eae3a6b545194c42fec2071675c34aadacd65e6b33fdfe7b3b6a86c3a'),
(14, 'League of Legends', 'https://sm.ign.com/ign_br/game/l/league-of-/league-of-legends_d152.jpg'),
(15, 'Resident Evil Village', 'https://image.api.playstation.com/vulcan/ap/rnd/202101/0812/uAhJNbCgYUmUOuCDiMNXtYBC.png'),
(16, 'Super Mario Odyssey', 'https://http2.mlstatic.com/D_NQ_NP_970852-MLB71008451611_082023-O.webp'),
(17, 'Fortnite', 'https://cdn2.unrealengine.com/blade-2560x1440-2560x1440-6b1174ff6f66.jpg'),
(18, 'Valorant', 'https://s2-ge.glbimg.com/CnHlwtKtIAGBtwvbTxMKJrOtWPU=/1200x/smart/filters:cover():strip_icc()/i.s3.glbimg.com/v1/AUTH_bc8228b6673f488aa253bbcb03c80ec5/internal_photos/bs/2020/4/G/xXHeVfTGe4bMldoEdMRQ/valorant-riot-games.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `items_categoria`
--

CREATE TABLE `items_categoria` (
  `id` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `items_categoria`
--

INSERT INTO `items_categoria` (`id`, `id_item`, `id_categoria`) VALUES
(1, 4, 1),
(2, 5, 4),
(3, 6, 6),
(4, 7, 5),
(5, 8, 10),
(6, 9, 1),
(7, 10, 4),
(8, 11, 11),
(9, 12, 14),
(10, 13, 15),
(11, 14, 11),
(12, 15, 12),
(13, 16, 9),
(14, 17, 10),
(15, 18, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `rating` enum('like','dislike') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `item_id`, `rating`) VALUES
(86, 6, 4, 'like'),
(87, 6, 5, 'dislike');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`) VALUES
(1, 'admin@aluno.feliz.ifrs.edu.br', 'Admin', '$2y$10$dt5XxW5G2VDWoTkVwegIc.8N8Wl/6RVhxsuYi..AAy/dr0BemLanS', 'manager'),
(2, 'a@aluno.feliz.ifrs.edu.br', 'gustavop', '$2y$10$KqSgzXBPmiUip1UCbMQMUeprdHKO35ivb6MqZWc9fM5N/MdFmC7Fu', 'user'),
(3, 'ab@aluno.feliz.ifrs.edu.br', 'asdadasd1', '$2y$10$kXMpKff57oOr.hIp9U5Gpu5aorheXphuNNeVuGC3IgNFOu.5sbuDu', 'user'),
(4, 'abc@aluno.feliz.ifrs.edu.br', 'abaaa', '$2y$10$UtTaNhO3oFaJ0iLHK/mvVO4mr23Uwm8wSaHl0iJe5DMG7aIvk4TH2', 'user'),
(5, 'd@aluno.feliz.ifrs.edu.br', 'dasda', '$2y$10$dt5XxW5G2VDWoTkVwegIc.8N8Wl/6RVhxsuYi..AAy/dr0BemLanS', 'user'),
(6, 'das@aluno.feliz.ifrs.edu.br', 'das', '$2y$10$XgbHiIrxhEumBAsw9EUQn.H3gOdqOUrC/I2Ipu8msnWJjCL18G.wS', 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `items_categoria`
--
ALTER TABLE `items_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`id_categoria`),
  ADD KEY `fk_item` (`id_item`);

--
-- Índices de tabela `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `items_categoria`
--
ALTER TABLE `items_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `items_categoria`
--
ALTER TABLE `items_categoria`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`id_item`) REFERENCES `items` (`id`);

--
-- Restrições para tabelas `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
