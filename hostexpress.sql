-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 20/05/2025 às 03:58
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
-- Banco de dados: `hostexpress`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_clientes`
--

CREATE TABLE `he_clientes` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `SENHA` varchar(255) DEFAULT NULL,
  `TELEFONE` varchar(20) DEFAULT NULL,
  `ENDERECO` varchar(255) DEFAULT NULL,
  `ENDERECO_NUM` int(11) DEFAULT NULL,
  `DATA_CADASTRO` timestamp NULL DEFAULT current_timestamp(),
  `CIDADE` varchar(100) DEFAULT NULL,
  `BAIRRO` varchar(100) DEFAULT NULL,
  `CEP` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_empresas`
--

CREATE TABLE `he_empresas` (
  `EMPRESA_ID` int(11) NOT NULL,
  `CNPJ` char(14) NOT NULL,
  `NOME_FANTASIA` varchar(255) DEFAULT NULL,
  `TELEFONE` varchar(20) DEFAULT NULL,
  `CEP` char(8) NOT NULL,
  `ESPECIALIDADE` varchar(20) DEFAULT NULL,
  `ENDERECO` varchar(150) DEFAULT NULL,
  `ENDERECO_NUM` int(11) NOT NULL,
  `COMPLEMENTO` varchar(200) DEFAULT NULL,
  `BAIRRO` varchar(50) DEFAULT NULL,
  `CIDADE` varchar(100) NOT NULL,
  `CONFIRMADA` char(1) DEFAULT NULL,
  `ATIVO` char(1) DEFAULT NULL,
  `PERMISSAO` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `SENHA` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `he_empresas`
--

INSERT INTO `he_empresas` (`EMPRESA_ID`, `CNPJ`, `NOME_FANTASIA`, `TELEFONE`, `CEP`, `ESPECIALIDADE`, `ENDERECO`, `ENDERECO_NUM`, `COMPLEMENTO`, `BAIRRO`, `CIDADE`, `CONFIRMADA`, `ATIVO`, `PERMISSAO`, `EMAIL`, `SENHA`) VALUES
(1, '74371717000186', 'FAVARO MATERIAL PARA CONSTRUCAO LTDA', '1148171477', '13212210', 'Construções', 'LUIZ JOSE SERENO', 1120, 'OIOIOIOIOIOOIOI', 'JARDIM ERMIDA II', 'JUNDIAI', 'N', 'N', 'EMPRESA', NULL, NULL),
(2, '12345678901234', 'HostExpress', '11971573456', '13219500', '', 'Rua Bom Jesus de Pirapora', 100, 'Escola', 'Vianelo', 'Jundiaí', 'S', 'S', 'ADMIN', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `he_produtos`
--

CREATE TABLE `he_produtos` (
  `PRODUTO_ID` int(11) NOT NULL,
  `EMPRESA_ID` int(11) DEFAULT NULL,
  `DESCRICAO` text DEFAULT NULL,
  `CATEGORIA` varchar(100) DEFAULT NULL,
  `UNIDADE` varchar(2) DEFAULT NULL,
  `QTD` int(11) NOT NULL,
  `PRECO_UN` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `he_clientes`
--
ALTER TABLE `he_clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `he_empresas`
--
ALTER TABLE `he_empresas`
  MODIFY `EMPRESA_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `he_produtos`
--
ALTER TABLE `he_produtos`
  MODIFY `PRODUTO_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
