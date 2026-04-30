-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql107.infinityfree.com
-- Tempo de geração: 30/04/2026 às 00:38
-- Versão do servidor: 11.4.10-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_41764451_galerasite`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `convidado_por` varchar(50) DEFAULT NULL,
  `aprovado` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `criado_em` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha_hash`, `convidado_por`, `aprovado`, `admin`, `criado_em`) VALUES
(1, 'Clover', '$2y$10$yqdeCjRQP3iLsUCeSGv9CeTW2fcJAFjmi93BqzCKHpEMmsJAGq.je', 'eu mesmo', 1, 1, '2026-04-28 02:27:05'),
(5, 'a', '$2y$10$WYf8tKLkpAARYQmGCTThXeKF9Tq7Gxt.GbkzL7tW3eJhb5ssPBWEe', 'a', 1, 0, '2026-04-28 19:16:54'),
(6, 'Portelo', '$2y$10$hBu5bDM20wQzWndj0n5Re.o4nVt8gTkX6llMzWyMk35ke20m/m69S', 'Israel luís vilar pereira', 1, 0, '2026-04-29 21:02:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `secao` varchar(50) NOT NULL,
  `criado_em` timestamp NULL DEFAULT current_timestamp(),
  `privada` tinyint(1) NOT NULL DEFAULT 0,
  `dono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `videos`
--

INSERT INTO `videos` (`id`, `url`, `secao`, `criado_em`, `privada`, `dono`) VALUES
(270, 'https://www.instagram.com/reel/DXsi9HAjoKV/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 12:29:45', 0, NULL),
(272, 'https://www.instagram.com/reel/DXqX-AoiNKK/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloveredits', '2026-04-29 12:33:28', 0, NULL),
(273, 'https://youtu.be/WJeeA_O88Zw?list=RDWJeeA_O88Zw', 'cloverreflexivos', '2026-04-29 12:36:08', 0, NULL),
(274, 'https://youtu.be/CAA_zE5a3JQ', 'cloverreflexivos', '2026-04-29 12:37:34', 0, NULL),
(275, 'https://www.instagram.com/reel/DXfUD-ij7Gt/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 12:38:14', 0, NULL),
(276, 'https://www.instagram.com/reel/DXsPJ_VCiGn/?utm_source=ig_web_copy_link', 'cloveredits', '2026-04-29 12:38:51', 0, NULL),
(277, 'https://www.instagram.com/reel/DXctd10gfPA/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloverinfo', '2026-04-29 12:48:45', 0, NULL),
(278, 'https://www.instagram.com/reel/DXZfKYtBbrD/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 12:49:07', 0, NULL),
(279, 'https://www.instagram.com/reel/DXkidpnCJnZ/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:08:34', 0, NULL),
(280, 'https://www.instagram.com/reel/DXR_LCPkdXL/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:08:44', 0, NULL),
(281, 'https://www.instagram.com/reel/DXkWMC-D4ku/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:08:54', 0, NULL),
(282, 'https://www.instagram.com/reel/DXes0VRgtwV/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:09:25', 0, NULL),
(283, 'https://www.instagram.com/reel/DXcArdmkR_5/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:10:00', 0, NULL),
(284, 'https://www.instagram.com/reel/DXO6w23jsvi/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:10:13', 0, NULL),
(285, 'https://www.instagram.com/reel/DXWAUnDkTsF/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloverreflexivos', '2026-04-29 13:11:12', 0, NULL),
(286, 'https://www.instagram.com/reel/DXUYB9pjJWV/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloverreflexivos', '2026-04-29 13:11:49', 0, NULL),
(287, 'https://www.instagram.com/reel/DXYePpjCkVX/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloveredits', '2026-04-29 13:12:10', 0, NULL),
(288, 'https://www.instagram.com/reel/DWz61ObIYMi/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:49:06', 0, NULL),
(289, 'https://www.instagram.com/reel/DW3kSZ4ERMz/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:49:47', 0, NULL),
(290, 'https://www.instagram.com/reel/DXS4QQRkT6W/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:50:04', 0, NULL),
(291, 'https://www.instagram.com/reel/DUVkzEBDqpL/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:50:28', 0, NULL),
(292, 'https://www.instagram.com/reel/DXZr6JBhqME/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:51:01', 0, NULL),
(293, 'https://www.instagram.com/reel/DXSdO3QjXt0/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloveredits', '2026-04-29 13:51:45', 0, NULL),
(294, 'https://www.instagram.com/reel/DXVmQDoDY5k/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloveredits', '2026-04-29 13:51:58', 0, NULL),
(295, 'https://www.instagram.com/reel/DXVBGYQjkt7/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:52:34', 0, NULL),
(296, 'https://www.instagram.com/reel/DXVASDNEcVF/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:52:45', 0, NULL),
(297, 'https://www.instagram.com/reel/DXRQ1jxhMMF/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:53:48', 0, NULL),
(298, 'https://www.instagram.com/reel/DXQ0vxygQCB/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloverreflexivos', '2026-04-29 13:54:32', 0, NULL),
(299, 'https://www.instagram.com/reel/DXSXYCbEQFL/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'clovermemes', '2026-04-29 13:55:20', 0, NULL),
(300, 'https://www.instagram.com/reel/DXN2Z-kCQwb/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==', 'cloveredits', '2026-04-29 13:56:12', 0, NULL),
(301, 'https://youtu.be/TlvFG6WWOAk', 'clovermusics', '2026-04-29 14:01:29', 0, NULL),
(302, 'https://youtu.be/Wg9AL5LHzxE', 'clovermusics', '2026-04-29 14:01:46', 0, NULL),
(303, 'https://youtu.be/pYdc5LvFHg0', 'clovermusics', '2026-04-29 14:01:58', 0, NULL),
(304, 'https://youtu.be/k-8J4pMkcBU', 'clovermusics', '2026-04-29 14:02:18', 0, NULL),
(305, 'https://youtu.be/H_bjpVezmgE?list=PLEMkEAXMVL-FWA8wdYatbyTxZ6USwxOc4', 'clovermusics', '2026-04-29 14:02:35', 0, NULL),
(306, 'https://youtu.be/4LP8QFR9Qvc', 'clovermusics', '2026-04-29 14:04:36', 0, NULL),
(307, 'https://youtu.be/FV8bNtEicV4', 'clovermemes', '2026-04-29 14:05:20', 0, NULL),
(308, 'https://youtu.be/BFgPg6L5kl0', 'cloveredits', '2026-04-29 14:05:43', 0, NULL),
(309, 'https://youtu.be/5J6iqUzOK4k', 'clovermusics', '2026-04-29 14:06:47', 0, NULL),
(310, 'https://youtu.be/hEreDfK8mH4', 'clovermusics', '2026-04-29 14:07:04', 0, NULL),
(311, 'https://youtu.be/x5XBF7kSZCM', 'clovermusics', '2026-04-29 14:07:15', 0, NULL),
(312, 'https://youtu.be/nyZla3Lm4iI', 'clovermusics', '2026-04-29 14:08:00', 0, NULL),
(313, 'https://youtu.be/NUI9nqWX_EI', 'clovermusics', '2026-04-29 14:10:36', 0, NULL),
(314, 'https://youtu.be/mRNKqJU3RUo', 'cloveredits', '2026-04-29 14:11:56', 0, NULL),
(315, 'https://youtu.be/y08KxR_M0-o', 'cloverreflexivos', '2026-04-29 14:13:05', 0, NULL),
(316, 'https://youtu.be/gEBxKPhf5TE', 'cloveredits', '2026-04-29 14:14:13', 0, NULL),
(318, 'https://www.youtube.com/shorts/zewvFWv58f8?feature=share', 'cloverreflexivos', '2026-04-29 14:19:25', 0, NULL),
(320, 'https://youtu.be/UBMQk_inEOs', 'cloverpriv_videos', '2026-04-29 14:25:11', 1, 'Clover'),
(321, 'https://www.youtube.com/watch?v=-3r3km62jeY&list=WL&index=301&pp=iAQBsAgC', 'clovermusics', '2026-04-29 18:50:48', 0, NULL),
(322, 'https://youtu.be/H0LxBRYZs5o', 'clovermusics', '2026-04-29 18:51:51', 0, NULL),
(323, 'https://www.youtube.com/watch?v=hJHgTRbpbEc&list=WL&index=1036&pp=iAQBsAgC', 'clovermusics', '2026-04-29 18:52:50', 0, NULL),
(324, 'https://youtu.be/46oX43dp_cQ', 'clovermusics', '2026-04-29 18:54:15', 0, NULL),
(325, 'https://youtu.be/rY52G8xA72k', 'clovermusics', '2026-04-29 18:54:30', 0, NULL),
(326, 'https://youtu.be/lusPtF_yJ3E', 'cloveredits', '2026-04-29 18:55:36', 0, NULL),
(329, 'https://www.youtube.com/watch?v=xw8cENWfbbQ', 'portelomemes', '2026-04-29 21:11:13', 0, NULL),
(330, 'https://pjgnrff.tykslxqyphqo.hath.network:58327/h/33aeb328bee46210b314af393cebff70bfc432a6-175475-1216-832-jpg/keystamp=1777497600-3df84f37db;fileindex=214744177;xres=org/1997546758134780188_1.jpg', 'portelomaisdezoito', '2026-04-29 21:13:54', 0, NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_secao` (`secao`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
