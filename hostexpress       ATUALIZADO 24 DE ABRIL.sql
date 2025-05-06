-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/04/2025 às 15:18
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `idc` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `celular` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cep` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `endereconum` int(11) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`idc`, `nome`, `celular`, `email`, `senha`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `endereconum`, `complemento`) VALUES
(1, 'Hendel', '1196', 'cacadsaad', 'aa', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', '', 0, 'a'),
(2, 'Hendel', '1196', 'cacadsaad', 'aa', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', '', 0, 'a'),
(3, 'Hendel', '1196', 'cacadsaad', 'aa', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', '', 0, 'a'),
(5, 'Enzo Mariano', '11956591294', 'enzomala88@gmail.com', 'enzo2008', 13212863, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 31, ''),
(6, 'Enzo Mariano', '11956591294', 'enzomala88@gmail.com', 'enzo2008', 13212863, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 31, ''),
(7, 'Enzo Mariano', '11956591294', 'enzomala88@gmail.com', 'enzo2008', 13212863, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 31, ''),
(8, 'Enzo Mariano', '11956591294', 'enzomala88@gmail.com', 'enzo2008', 13212863, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 31, ''),
(9, 'DASDD', 'SADSA', 'DSADSA', 'DSADSA', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 0, ''),
(10, 'DASDD', 'SADSA', 'DSADSA', 'DSADSA', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 0, ''),
(11, 'Hendel', 'a', 'cacadsaad', 'adad', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 21, ''),
(12, 'Hendel', 'a', 'cacadsaad', 'adad', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 21, ''),
(13, 'Hendel', 'a', 'cacadsaad', 'adad', 13218892, 'Rua Dois', 'Jardim Tarantela', 'Jundiaí', 'SP', 21, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `ide` int(11) NOT NULL,
  `cnpj` int(11) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `tel` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cep` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `endereconum` int(11) NOT NULL,
  `especialidade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `idimg` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `idprodu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `idp` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL,
  `categ` varchar(255) NOT NULL,
  `estoque` int(11) NOT NULL,
  `unidade` varchar(255) NOT NULL,
  `valor` float NOT NULL,
  `responsavel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `idv` int(11) NOT NULL,
  `valor` float NOT NULL,
  `cliente` int(11) NOT NULL,
  `prod` int(11) NOT NULL,
  `quant` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idc`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`ide`),
  ADD UNIQUE KEY `razao_social` (`razao_social`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`idimg`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idp`),
  ADD KEY `fk_responsavel` (`responsavel`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idv`),
  ADD KEY `fk_produto` (`prod`),
  ADD KEY `fk_cliente` (`cliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `ide` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `idimg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `idv` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_responsavel` FOREIGN KEY (`responsavel`) REFERENCES `empresas` (`razao_social`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`idc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produto` FOREIGN KEY (`prod`) REFERENCES `produto` (`idp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
