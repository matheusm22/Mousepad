-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 03/08/2023 às 11:40
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tb_acessos`
--

INSERT INTO `tb_acessos` (`id_usuario`, `usuario`, `senha`, `matricula`, `ativo`, `nivel`, `dta_criacao`) VALUES
(1, 'admin1', '$2y$10$mKii3dzo97QeVynuDfdrROgCzkZhHxFe4aqiWXLIzRw2ZF1qAooQK', 0, 'Sim', 2, '2023-07-10 14:19:31'),
(2, 'matheus', '$2y$10$ex6TBipEvlYwqyFtHOE09uMX2.ckbEQSzH2yi7UShT2cwe5x5iTGW', 3226, 'Sim', 2, '2023-07-10 14:20:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_links`
--

DROP TABLE IF EXISTS `tb_links`;
CREATE TABLE IF NOT EXISTS `tb_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ultimo_uso` datetime DEFAULT NULL,
  `ativo` varchar(10) NOT NULL,
  `dta_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tb_links`
--

INSERT INTO `tb_links` (`id`, `chave`, `link`, `ultimo_uso`, `ativo`, `dta_criacao`) VALUES
(1, 'Klu%*', 'https://meet.google.com/jxg-ftrm-qqe', '2023-08-02 16:34:35', 'Sim', '2023-04-26 16:11:59'),
(2, 'Jql@#', 'https://meet.google.com/kdj-nqqb-onf', '2023-08-02 17:21:29', 'Sim', '2023-04-26 16:11:59'),
(3, 'Ygh#%', 'https://meet.google.com/jag-vjfo-oin', '2023-08-03 08:47:13', 'Sim', '2023-04-26 16:11:59'),
(4, 'Sxw#@', 'https://meet.google.com/kdj-nqqb-onf', '2023-08-03 11:00:16', 'Sim', '2023-04-26 16:11:59'),
(5, 'Cfj#$', 'https://meet.google.com/tkk-upft-vva', '2023-08-04 11:04:33', 'Sim', '2023-04-26 16:11:59'),
(6, 'Nho*%', 'https://meet.google.com/nyz-cuhd-mbx', '2023-08-03 11:05:41', 'Sim', '2023-04-26 16:14:38'),
(8, 'W2bK5', 'https://meet.google.com/hby-zuwc-qmn', '2023-08-03 11:02:44', 'Sim', '2023-04-26 16:31:16'),
(9, 'CFm48', 'https://meet.google.com/oht-riri-ewo', '2023-08-03 10:54:33', 'Sim', '2023-04-26 16:33:09'),
(10, 'yUf3d', 'https://meet.google.com/mmj-fxrw-aqy', '2023-08-03 10:25:54', 'Sim', '2023-04-27 15:48:58'),
(66, '9Uk$K', 'https://meet.google.com/tkk-upft-vva', '2023-07-31 17:06:53', 'Sim', '2023-06-06 13:37:58'),
(68, 'vQ%39', 'https://meet.google.com/kef-pqqe-cew', '2023-07-31 17:06:53', 'Sim', '2023-08-02 11:20:51'),
(69, '25s8@', 'https://meet.google.com/xdz-hiaf-fnq', '2023-07-31 17:06:53', 'Sim', '2023-08-02 11:20:51'),
(70, '5w^F3', 'https://meet.google.com/svw-zaxw-cvz', '2023-08-02 16:49:26', 'Sim', '2023-08-02 11:20:51'),
(71, '41Q7m', 'https://meet.google.com/nft-avjr-ggn', '2023-08-03 11:25:00', 'Sim', '2023-08-02 11:20:51'),
(72, 'r7!04', 'https://meet.google.com/vkk-qjxn-uwt', '2023-08-02 17:29:59', 'Sim', '2023-08-02 11:20:51'),
(73, 'Rg08!', 'https://meet.google.com/drj-ifuc-hxt', '2023-08-03 10:26:25', 'Sim', '2023-08-02 11:20:51'),
(74, '53#Y3', 'https://meet.google.com/feq-tooj-vbu', '2023-08-03 11:09:59', 'Sim', '2023-08-02 11:20:51'),
(75, '4%Lt6', 'https://meet.google.com/nuj-ytos-ywr', '2023-07-31 17:06:53', 'Sim', '2023-08-02 11:20:51'),
(76, '#73Jy', 'https://meet.google.com/yvo-uxxi-wdt', '2023-08-03 11:38:09', 'Sim', '2023-08-02 11:20:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
