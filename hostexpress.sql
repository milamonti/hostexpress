-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 23/07/2025 às 02:14
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
-- Banco de dados: `hostexpress`
--
CREATE DATABASE IF NOT EXISTS `hostexpress` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hostexpress`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_clientes`
--

CREATE TABLE `he_clientes` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `TELEFONE` varchar(20) DEFAULT NULL,
  `ENDERECO` varchar(255) DEFAULT NULL,
  `ENDERECO_NUM` int(11) DEFAULT NULL,
  `DATA_CADASTRO` timestamp NULL DEFAULT current_timestamp(),
  `CIDADE` varchar(100) DEFAULT NULL,
  `BAIRRO` varchar(100) DEFAULT NULL,
  `CEP` char(8) DEFAULT NULL,
  `COMPLEMENTO` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `he_clientes`
--

INSERT INTO `he_clientes` (`ID`, `NOME`, `EMAIL`, `TELEFONE`, `ENDERECO`, `ENDERECO_NUM`, `DATA_CADASTRO`, `CIDADE`, `BAIRRO`, `CEP`, `COMPLEMENTO`) VALUES
(1, 'Lorenzo Milamonti', '2100830m@escolas.anchieta.br', '11999999999', 'Rua José Zorzi', 68, '2025-05-23 14:20:22', 'Jundiaí', 'Cidade Nova 1', '13219461', NULL),
(2, 'Leo', 'milamontilorenzo@gmail.com', '34190931292', 'Avenida Moisés Raphael', 23442, '2025-07-12 02:31:07', 'Jundiaí', 'Cidade Nova', '13219500', 'dasdasdasdas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_empresas`
--

CREATE TABLE `he_empresas` (
  `EMPRESA_ID` int(11) NOT NULL,
  `ATIVO` char(1) DEFAULT NULL,
  `CNPJ` char(14) NOT NULL,
  `RAZAO_SOCIAL` varchar(255) NOT NULL,
  `NOME_FANTASIA` varchar(255) DEFAULT NULL,
  `TELEFONE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `ESPECIALIDADE` varchar(20) DEFAULT NULL,
  `CEP` char(8) NOT NULL,
  `CIDADE` varchar(100) NOT NULL,
  `BAIRRO` varchar(50) DEFAULT NULL,
  `ENDERECO` varchar(150) DEFAULT NULL,
  `ENDERECO_NUM` int(11) NOT NULL,
  `COMPLEMENTO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `he_empresas`
--

INSERT INTO `he_empresas` (`EMPRESA_ID`, `ATIVO`, `CNPJ`, `RAZAO_SOCIAL`, `NOME_FANTASIA`, `TELEFONE`, `EMAIL`, `ESPECIALIDADE`, `CEP`, `CIDADE`, `BAIRRO`, `ENDERECO`, `ENDERECO_NUM`, `COMPLEMENTO`) VALUES
(1, 'N', '74371717000186', '', 'FAVARO MATERIAL PARA CONSTRUCAO LTDA', '1148171477', NULL, 'Construções', '13212210', 'JUNDIAI', 'JARDIM ERMIDA II', 'LUIZ JOSE SERENO', 1120, 'OIOIOIOIOIOOIOI'),
(2, 'S', '12345678901234', '', 'HostExpress', '11971573456', NULL, '', '13219500', 'Jundiaí', 'Vianelo', 'Rua Bom Jesus de Pirapora', 100, 'Escola'),
(3, NULL, '54654654654646', 'Lojinha Insana', 'Lojinha', '41231313133', '2100832@escolas.anchieta.br', '1', '13219461', 'Jundiaí', 'Cidade Nova', 'Rua José Zorzi', 68, 'dsasdaadsd');

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_produtos`
--

CREATE TABLE `he_produtos` (
  `PRODUTO_ID` int(11) NOT NULL,
  `EMPRESA_ID` int(11) DEFAULT NULL,
  `DESCRICAO` text DEFAULT NULL,
  `CATEGORIA` varchar(100) DEFAULT NULL,
  `UNIDADE` varchar(10) DEFAULT NULL,
  `QTD` int(11) NOT NULL,
  `PRECO_UN` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `he_produtos`
--

INSERT INTO `he_produtos` (`PRODUTO_ID`, `EMPRESA_ID`, `DESCRICAO`, `CATEGORIA`, `UNIDADE`, `QTD`, `PRECO_UN`) VALUES
(1, 1, 'SACO DE CIMENTO', 'construção', 'KG', 50, 30.90),
(16, 1, 'Cimento CP II-E 32', 'construção', 'saco', 50, 32.50),
(17, 1, 'Areia Média Lavada', 'construção', 'm³', 1, 120.00),
(18, 1, 'Brita 1', 'construção', 'm³', 1, 140.00),
(19, 1, 'Tijolo Cerâmico 9 Furos', 'construção', 'unidade', 1, 0.85),
(20, 1, 'Bloco de Concreto 14x39x19cm', 'construção', 'unidade', 1, 2.10),
(21, 1, 'Vergalhão CA-50 10mm', 'construção', 'barra', 1, 32.00),
(22, 1, 'Massa Corrida 25kg', 'construção', 'balde', 25, 55.90),
(23, 1, 'Tinta Acrílica Branco Fosco 18L', 'construção', 'lata', 18, 165.00),
(24, 1, 'Rejunte para Porcelanato 1kg', 'construção', 'saco', 1, 6.80),
(25, 1, 'Argamassa AC-I 20kg', 'construção', 'saco', 20, 18.90),
(26, 1, 'Tubulação PVC 100mm', 'construção', 'barra', 6, 59.00),
(27, 1, 'Caixa d’Água 1000L', 'construção', 'unidade', 1, 490.00),
(28, 1, 'Viga U Metálica 6m', 'construção', 'barra', 6, 230.00),
(29, 1, 'Chapa de Madeira Compensada 15mm', 'construção', 'unidade', 1, 110.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_users`
--

CREATE TABLE `he_users` (
  `USER` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `TYPE` varchar(6) NOT NULL,
  `NAME` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `he_users`
--

INSERT INTO `he_users` (`USER`, `PASSWORD`, `TYPE`, `NAME`) VALUES
('2100830m@escolas.anchieta.br', '$2y$10$4ytraP2y541EjrqIYSdefeGprbsNmqUsEJ/eu5uAYF6jwPA5qSyza', 'CLIENT', 'Lorenzo Milamonti'),
('2100832@escolas.anchieta.br', '$2y$10$gZhLVTX3P59dPlnaFi4D9OmSdvd2IRCRpb2h7L88lY/kSuR3LcToy', 'SHOP', 'Lojinha Insana'),
('milamontilorenzo@gmail.com', '$2y$10$eWXsNsild6ENn/I.rXf/m.c0kZB0N451fgEoKkVm860etUv22a.eG', 'CLIENT', 'Leo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `he_clientes`
--
ALTER TABLE `he_clientes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Índices de tabela `he_empresas`
--
ALTER TABLE `he_empresas`
  ADD PRIMARY KEY (`EMPRESA_ID`);

--
-- Índices de tabela `he_produtos`
--
ALTER TABLE `he_produtos`
  ADD PRIMARY KEY (`PRODUTO_ID`),
  ADD KEY `EMPRESA_ID` (`EMPRESA_ID`);

--
-- Índices de tabela `he_users`
--
ALTER TABLE `he_users`
  ADD PRIMARY KEY (`USER`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `he_clientes`
--
ALTER TABLE `he_clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `he_empresas`
--
ALTER TABLE `he_empresas`
  MODIFY `EMPRESA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `he_produtos`
--
ALTER TABLE `he_produtos`
  MODIFY `PRODUTO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
