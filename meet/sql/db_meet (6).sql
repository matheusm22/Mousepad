-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 28/06/2023 às 17:11
-- Versão do servidor: 8.0.31-0ubuntu0.20.04.1
-- Versão do PHP: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_meet`
--
CREATE DATABASE IF NOT EXISTS `db_meet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_meet`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_acessos`
--

DROP TABLE IF EXISTS `tb_acessos`;
CREATE TABLE IF NOT EXISTS `tb_acessos` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `matricula` int NOT NULL,
  `ativo` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nivel` int DEFAULT NULL,
  `dta_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tb_acessos`
--

INSERT INTO `tb_acessos` (`id_usuario`, `usuario`, `senha`, `matricula`, `ativo`, `nivel`, `dta_criacao`) VALUES
(1, 'matheus', '$2y$10$BavRW1UWuKK56vWkuWxc4.9RY3f5td9qLB0I77e/gzGXvlbZhk9Iy', 3226, 'Sim', 2, '2023-06-26 16:04:12'),
(10, 'caio_silva', '$2y$10$YEalr5ixlcXgXp.9gBxRruW2Nieaf4V88lU2XacSywU.3MBLrVRoC', 3228, 'Sim', 1, '2023-06-27 11:08:05'),
(11, 'matheus1', '$2y$10$w31zhcdlZHqBTOnViondv.R0lOX3gBmsEZ5QHPZgJDQCnOeZBYiwC', 4545, 'Sim', 1, '2023-06-27 16:23:24'),
(12, 'joao_1', '$2y$10$AOm1HY.s5w/4NuiXUwNR6uaWKXrgCiViTPM4rp..Ha44PjGvssN0m', 3555, 'Sim', 1, '2023-06-27 16:41:25'),
(13, 'jaqueline_motta', '$2y$10$tJLuHgqpRmtYRNf5IoIUp.KIRFIlu./KSmvgdWLDJL2.sL11TWRKW', 9999, 'Sim', 1, '2023-06-27 17:18:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `chave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link_1` varchar(100) NOT NULL,
  `link_2` varchar(100) NOT NULL,
  `ativo` varchar(10) NOT NULL,
  `dta_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nome` (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `chave`, `link_1`, `link_2`, `ativo`, `dta_criacao`) VALUES
(1, 'Klu%*', 'https://meet.google.com/jxg-ftrm-qqe', 'https://meet.google.com/kef-pqqe-cew', 'Sim', '2023-04-26 16:11:59'),
(2, 'Jql@#', 'https://meet.google.com/kdj-nqqb-onf', 'https://meet.google.com/xdz-hiaf-fnq', 'Sim', '2023-04-26 16:11:59'),
(3, 'Ygh#%', 'https://meet.google.com/jag-vjfo-oin', 'https://meet.google.com/svw-zaxw-cvz', 'Sim', '2023-04-26 16:11:59'),
(4, 'Sxw#@', 'https://meet.google.com/kdj-nqqb-onf', 'https://meet.google.com/nft-avjr-ggn', 'Sim', '2023-04-26 16:11:59'),
(5, 'Cfj#$', 'https://meet.google.com/tkk-upft-vva', 'https://meet.google.com/vkk-qjxn-uwt', 'Sim', '2023-04-26 16:11:59'),
(6, 'Nho*%', 'https://meet.google.com/nyz-cuhd-mbx', 'https://meet.google.com/drj-ifuc-hxt', 'Sim', '2023-04-26 16:14:38'),
(8, 'W2bK5', 'https://meet.google.com/hby-zuwc-qmn', 'https://meet.google.com/feq-tooj-vbu', 'Sim', '2023-04-26 16:31:16'),
(9, 'CFm48', 'https://meet.google.com/oht-riri-ewo', 'https://meet.google.com/nuj-ytos-ywr', 'Sim', '2023-04-26 16:33:09'),
(10, 'yUf3d', 'https://meet.google.com/mmj-fxrw-aqy', 'https://meet.google.com/yvo-uxxi-wdt', 'Sim', '2023-04-27 15:48:58'),
(66, '9Uk$K', 'https://meet.google.com/tkk-upft-vva', 'https://meet.google.com/vkk-qjxn-uwt', 'Sim', '2023-06-06 13:37:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
