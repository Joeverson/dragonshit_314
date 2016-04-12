-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 14-Mar-2016 às 16:22
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
  `ponto_avancado` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `realizou_certificacao` int(11) NOT NULL,
  `historico` text NOT NULL,
  `data_treino` date NOT NULL,
  `data_bec` date NOT NULL,
  `consultor` int(11) NOT NULL,
  `clube_vantagens` int(11) NOT NULL,
  `microsseguro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `producao`
--

CREATE TABLE `producao` (
  `id` int(11) NOT NULL,
  `cod_mult` int(11) NOT NULL,
  `chave` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `lime` int(11) NOT NULL,
  `conta` int(11) NOT NULL,
  `cartao` int(11) NOT NULL,
  `transacao` int(11) NOT NULL,
  `inicial` date NOT NULL,
  `final` date NOT NULL,
  `bacen` date NOT NULL,
  `clube` date NOT NULL,
  `arquivo` varchar(128) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `qualidade`
--

CREATE TABLE `qualidade` (
  `ID` int(5) NOT NULL,
  `DIR_REGIONAL` varchar(150) DEFAULT NULL,
  `GER_REGIONAL` varchar(150) DEFAULT NULL,
  `DESC_GERENCIA_AREA` varchar(150) DEFAULT NULL,
  `DESC_COORDENACAO` varchar(150) DEFAULT NULL,
  `DESC_SUPERVISAO` varchar(150) DEFAULT NULL,
  `CHAVE_LOJA` int(15) DEFAULT NULL,
  `NOME_LOJA` varchar(150) DEFAULT NULL,
  `COD_AG_REL` int(5) DEFAULT NULL,
  `NOME_AG` varchar(150) DEFAULT NULL,
  `NR_PACB` int(5) DEFAULT NULL,
  `AGENCIA` varchar(150) DEFAULT NULL,
  `CONTA` int(10) DEFAULT NULL,
  `DT_ABERTURA` date DEFAULT NULL,
  `CPF` int(1) DEFAULT NULL,
  `NOME_COMPLETO` int(1) DEFAULT NULL,
  `DATA_NASCIMENTO` int(1) DEFAULT NULL,
  `SEXO` int(1) DEFAULT NULL,
  `NACIONALIDADE` int(1) DEFAULT NULL,
  `NATURALIDADE` int(1) DEFAULT NULL,
  `TIPO_DOCUMENTO` int(1) DEFAULT NULL,
  `NUMERO_DOCUMENTO` int(1) DEFAULT NULL,
  `DATA_DE_EMISSAO` int(1) DEFAULT NULL,
  `ORGAO_EMISSOR` int(1) DEFAULT NULL,
  `UNIDADE_DA_FEDERACAO` int(1) DEFAULT NULL,
  `NOME_DO_PAI` int(1) DEFAULT NULL,
  `NOME_DA_MAE` int(1) DEFAULT NULL,
  `ESTADO_CIVIL` int(1) DEFAULT NULL,
  `NOME_CONJUGE` int(1) DEFAULT NULL,
  `PROFISSAO` int(1) DEFAULT NULL,
  `NOME_DA_RUA_E_NUMERO_RESIDENCIA` int(1) DEFAULT NULL,
  `NOME_DO_BAIRRO` int(1) DEFAULT NULL,
  `CEP` int(1) DEFAULT NULL,
  `DDD` int(1) DEFAULT NULL,
  `NUMERO_TELEFONE` int(1) DEFAULT NULL,
  `FALTA_FONTES_REFERENCIAS` int(1) DEFAULT NULL,
  `FALTA_DATA_DE_ABERTURA_E_NOME_DO_LOCAL` int(1) DEFAULT NULL,
  `FALTA_ASSINATURA_DO_CLIENTE_NA_1a_VIA_FICHA_PROP` int(1) DEFAULT NULL,
  `CARTAO_DE_AUTOGRAFOS_SEM_ASSINATURA` int(1) DEFAULT NULL,
  `NAO_ENVIOU_O_TERMO_DE_ADESAO_CESTA` int(1) DEFAULT NULL,
  `NAO_ENVIOU_O_TERMO_DE_ADESAO_PRODUTO` int(1) DEFAULT NULL,
  `ADERENTES_2025` int(1) DEFAULT NULL,
  `AUTORIZOU_ATIVACAO` int(1) DEFAULT NULL,
  `LIMS_CREDITO_PESSOAL` int(1) DEFAULT NULL,
  `LIMS_CHEQUE_ESPECIAL` int(1) DEFAULT NULL,
  `SOLICITOU_O_CARTAO_DE_CREDITO` int(1) DEFAULT NULL,
  `SOLICITOU_PRODUTOS` int(1) DEFAULT NULL,
  `CHAVE_PAA` int(5) DEFAULT NULL,
  `DATA_FORMALIZACAO` date DEFAULT NULL,
  `COD_MULT` int(5) DEFAULT NULL,
  `CONTATO` varchar(150) DEFAULT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `DDD_CONTATO` int(3) DEFAULT NULL,
  `TEL_CONTATO` varchar(15) DEFAULT NULL,
  `MES_REF` varchar(40) NOT NULL,
  `ANO_REF` int(4) NOT NULL,
  `ARQUIVO` varchar(120) NOT NULL,
  `DATA` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_USER` int(11) NOT NULL,
  `ID_MULTIPLICADOR` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos`
--

CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL,
  `name_cat` varchar(200) NOT NULL,
  `visible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `name_cat`, `visible`) VALUES
(0, 'Multiplicador', 0),
(1, 'Consultor', 0),
(2, 'super admin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(234) NOT NULL,
  `email` varchar(234) NOT NULL,
  `pass` varchar(234) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_multiplicador` int(11) NOT NULL,
  `cod_multiplicador` int(11) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `tel2` varchar(20) NOT NULL,
  `uf` varchar(5) NOT NULL,
  `login` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `pass`, `id_tipo`, `id_multiplicador`, `cod_multiplicador`, `tel`, `tel2`, `uf`, `login`) VALUES
(1, 'joe', 'joe@gmail.com', '6116afedcb0bc31083935c1c262ff4c9', 1, 0, 0, '', '', '', ''),
(2, 'MARIA', 'maria@eu.co', '6116afedcb0bc31083935c1c262ff4c9', 0, 10, 0, '', '', '', ''),
(3, 'joeverson', 'tvuvb@g.g', '6116afedcb0bc31083935c1c262ff4c9', 1, 2, 0, '', '', '', ''),
(4, 'ghu', 'ajas@d.g', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 0, '', '', '', ''),
(5, 'eu', 'eu@com.com', '6116afedcb0bc31083935c1c262ff4c9', 1, 2, 0, '', '', '', ''),
(6, 'aslid', 'aisjd@asd.asd', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 0, '', '', '', ''),
(7, 'Joerverson Barbosa Santos', 'joerverson.santos@gmail.com', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 0, '87902579', '', 'PB', 'ghuther'),
(12, 'MARIA', 'joerverson.santos@gmail.com', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 332, '47462348234', '', 'oh', 'maria'),
(14, 'ghuther', 'ajas@d.g1', '6116afedcb0bc31083935c1c262ff4c9', 2, 0, 23, '123123123', '', 'ob', 'ghuther'),
(15, 'Ghuther Antonio chavs', 'ghuther@g.com', '1e91fc390d1dfc38347c422a8ef6c0d0', 0, 0, 887, '87902579', '', 'PB', 'ghutherx1'),
(16, 'ghuther', 'jo@d.d', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 999, '987902579', '', 'oh', 'login'),
(17, 'mariacasavelha', 'ajas@d.g', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 987, '987902579', '', 'ioeir', 'login'),
(18, 'joebsantos', 'joerverson.santos@gmail.com', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 7658, '8798', '', 'on', 'login'),
(19, 'Rosínilda da silva siqueira santos pereira silva', 'pereira.silva@gmail.com', '6116afedcb0bc31083935c1c262ff4c9', 0, 0, 777, '777', '', 'JR', 'rosilda');

-- --------------------------------------------------------

--
-- Estrutura da tabela `validation`
--

CREATE TABLE `validation` (
  `id` int(11) NOT NULL,
  `date_ini` date NOT NULL,
  `date_fin` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `validation`
--

INSERT INTO `validation` (`id`, `date_ini`, `date_fin`, `id_user`, `ativo`) VALUES
(1, '2016-02-22', '2016-03-31', 12, 1),
(3, '2016-02-23', '2016-03-09', 14, 1),
(4, '2016-02-29', '2016-03-15', 15, 1),
(5, '2016-02-29', '2016-03-15', 16, 1),
(6, '2016-02-29', '2016-03-15', 17, 1),
(7, '2016-02-29', '2016-03-15', 18, 1),
(8, '2016-02-29', '2016-03-15', 19, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pontos`
--
ALTER TABLE `pontos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producao`
--
ALTER TABLE `producao`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `qualidade`
--
ALTER TABLE `qualidade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `validation`
--
ALTER TABLE `validation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pontos`
--
ALTER TABLE `pontos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `producao`
--
ALTER TABLE `producao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qualidade`
--
ALTER TABLE `qualidade`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `validation`
--
ALTER TABLE `validation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
