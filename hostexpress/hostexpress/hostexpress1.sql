-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 15/03/2025 às 04:49
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
-- Banco de dados: `hostexpress1`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `idc` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `endereconum` int(11) DEFAULT NULL,
  `cidade` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`idc`, `nome`, `celular`, `email`, `senha`, `cep`, `endereco`, `endereconum`, `cidade`, `bairro`) VALUES
(1, 'Enzo', 2147483647, 'enzomala88@gmail.com', 'Enzo2008', 13212863, 'Rua raymundo lucente', 31, '', ''),
(2, 'João Silva', 2147483647, 'joao.silva@email.com', 'senha123', 12345000, 'Rua das Flores', 100, 'São Paulo', 'Centro'),
(3, 'Maria Oliveira', 2147483647, 'maria.oliveira@email.com', 'senha456', 23456000, 'Avenida Brasil', 200, 'São Paulo', 'Jardim Paulista'),
(4, 'Carlos Souza', 2147483647, 'carlos.souza@email.com', 'senha789', 34567000, 'Rua do Sol', 300, 'São Paulo', 'Vila Mariana'),
(5, 'Luciana Pereira', 987654321, 'luciana.pereira@email.com', 'senha101', 45678000, 'Avenida Rio Branco', 50, 'Rio de Janeiro', 'Centro'),
(6, 'Felipe Costa', 912345678, 'felipe.costa@email.com', 'senha202', 67890100, 'Rua da Paz', 120, 'Belo Horizonte', 'Savassi'),
(7, 'Ana Silva', 998877665, 'ana.silva@email.com', 'senha303', 12345000, 'Rua da Liberdade', 200, 'São Paulo', 'Liberdade'),
(8, 'Pedro Santos', 987654321, 'pedro.santos@email.com', 'senha404', 34567800, 'Rua dos Três', 500, 'Curitiba', 'Centro'),
(9, 'Fernanda Lima', 998877665, 'fernanda.lima@email.com', 'senha505', 23456000, 'Avenida Paulista', 1010, 'São Paulo', 'Jardim Paulista');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `ide` int(11) NOT NULL,
  `cnpj` int(11) DEFAULT NULL,
  `razao_social` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cep` int(11) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `endereconum` int(11) DEFAULT NULL,
  `produtos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`ide`, `cnpj`, `razao_social`, `cpf`, `tel`, `email`, `senha`, `cep`, `estado`, `cidade`, `bairro`, `endereco`, `endereconum`, `produtos`) VALUES
(1, 2147483647, 'Empresa ABC Ltda', '12345678901', 1123456789, '2100830m@escolas.anchieta.br', '123', 12345000, 'São Paulo', 'São Paulo', 'Centro', 'Rua das Empresas', 100, 'Produtos eletrônicos'),
(2, 2147483647, 'Tech Solutions', '23456789012', 1198765432, 'tech.solutions@email.com', 'tech123', 67890000, 'Rio de Janeiro', 'Rio de Janeiro', 'Botafogo', 'Avenida das Tecnologias', 500, 'Equipamentos de TI'),
(3, 2147483647, 'Loja Fashion', '34567890123', 1187654321, 'loja.fashion@email.com', 'loja123', 11223344, 'São Paulo', 'São Paulo', 'Vila Mariana', 'Rua das Roupas', 200, 'Roupas e acessórios'),
(4, 2147483647, 'Construtora Ponto Alto', '45678901234', 1134567890, 'construtora@email.com', 'construtora123', 33445566, 'Brasília', 'Distrito Federal', 'Asa Norte', 'Avenida das Construções', 300, 'Materiais de construção'),
(5, 2147483647, 'Supermercados Açaí', '56789012345', 1145678901, 'acaimarket@email.com', 'acaimarket123', 55667788, 'Salvador', 'Bahia', 'Pituba', 'Rua dos Supermercados', 400, 'Alimentos e bebidas');

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
  `nome` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `categ` varchar(255) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `unidade` varchar(255) DEFAULT NULL,
  `valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `idv` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `prod` int(11) DEFAULT NULL,
  `quant` float DEFAULT NULL
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
  ADD PRIMARY KEY (`ide`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`idimg`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idp`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idv`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `ide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
