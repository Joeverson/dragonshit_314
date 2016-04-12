-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 16-Fev-2016 às 13:47
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pji`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontos`
--

CREATE TABLE `pontos` (
  `id` int(11) NOT NULL,
  `chave` int(11) NOT NULL,
  `cnpj` varchar(211) NOT NULL,
  `razao_social` varchar(211) NOT NULL,
  `nome_fantasia` varchar(211) NOT NULL,
  `agencia` double NOT NULL,
  `PACB` int(11) NOT NULL,
  `conta_corrente` varchar(221) NOT NULL,
  `responsavel` varchar(221) NOT NULL,
  `email` varchar(225) NOT NULL,
  `endereco` varchar(225) NOT NULL,
  `municipio` varchar(222) NOT NULL,
  `uf` varchar(100) NOT NULL,
  `telefone1` varchar(100) NOT NULL,
  `telefone2` varchar(100) NOT NULL,
  `ponto_avancado` tinyint(1) NOT NULL,
  `status` varchar(100) NOT NULL,
  `realizou_certificacao` tinyint(1) NOT NULL,
  `historico` text NOT NULL,
  `data_treino` date NOT NULL,
  `data_bec` date NOT NULL,
  `consultor` int(11) NOT NULL,
  `clube_vantagens` tinyint(1) NOT NULL,
  `microsseguro` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `pontos`
--
ALTER TABLE `pontos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pontos`
--
ALTER TABLE `pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
