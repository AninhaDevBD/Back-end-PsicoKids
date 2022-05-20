-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 19-Maio-2022 às 06:33
-- Versão do servidor: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdpsicokids`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `crianca`
--

CREATE TABLE `crianca` (
  `idCrianca` int(11) NOT NULL,
  `nomeCrianca` varchar(100) NOT NULL,
  `idade` int(11) NOT NULL,
  `serie` int(11) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `avaliacao` varchar(10) NOT NULL,
  `nivel` int(11) NOT NULL,
  `imagemPerfil` varchar(50) NOT NULL,
  `garrafas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `idResponsavel` int(11) NOT NULL,
  `nomeResponsavel` varchar(90) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senhaEmail` varchar(20) NOT NULL,
  `senhaAcesso` int(6) NOT NULL,
  `idCrianca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crianca`
--
ALTER TABLE `crianca`
  ADD PRIMARY KEY (`idCrianca`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`idResponsavel`),
  ADD KEY `idCrianca` (`idCrianca`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crianca`
--
ALTER TABLE `crianca`
  MODIFY `idCrianca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `idResponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `FKidCrianca` FOREIGN KEY (`idCrianca`) REFERENCES `crianca` (`idCrianca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* Storad procedure */
DELIMITER //
CREATE PROCEDURE spCadastraCrianca 
(
    IN 
    nomeCrianca VARCHAR(100),
  	idade INT(11) NOT NULL,
  	serie INT(11) NOT NULL,
  	sexo VARCHAR(10) NOT NULL,
  	avaliacao VARCHAR(10) NOT NULL,
  	nivel INT(11) NOT NULL,
  	imagemPerfil VARCHAR(50) NOT NULL
)
BEGIN
    INSERT INTO crianca (nomeCrianca, idade, serie, sexo, avaliacao, nivel, imagemPerfil) 
    VALUES (nomeCrianca, idade, serie, sexo, avaliacao, nivel, imagemPerfil);
    
CREATE PROCEDURE spAtualizaCrianca
(
    IN
    nomeCrianca VARCHAR(100) NOT NULL,
    idade INT(11) NOT NULL,
    serie INT(11) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    imagemPerfil VARCHAR(50) NOT NULL    
)
BEGIN
    UPDATE crianca SET nomeCrianca = :nome, idade = :idade, serie = :serie, sexo = :sexo, imagemPerfil = :imagemPerfil
    WHERE idCrianca = :idCrianca

CREATE PROCEDURE spConsultaCrianca
(
    IN
    nomeCrianca VARCHAR(100) NOT NULL,
    idade INT(11) NOT NULL,
    serie INT(11) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    imagemPerfil VARCHAR(50) NOT NULL
)
BEGIN
    SELECT nomeCrianca, idade, serie, sexo, imagemPerfil WHERE idCrianca = idCrianca

CREATE PROCEDURE spCadastraResponsavel
(
    IN
    nomeResponsavel VARCHAR(90) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senhaEmail VARCHAR(20) NOT NULL,
    senhaAcesso INT(6) NOT NULL
)
BEGIN
    INSERT INTO responsavel (nomeResponsavel, telefone, email, senhaEmail, senhaAcesso) VALUES (nomeResponsavel, telefone, email, senhaEmail, senhaAcesso)

CREATE PROCEDURE spAtualizaResponsavel
(
    IN
    nomeResponsavel VARCHAR(90) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senhaEmail VARCHAR(20) NOT NULL
)
BEGIN
    UPDATE responsavel SET nomeResponsavel = nomeResponsavel, telefone = telefone, email = email, senhaEmail = senhaEmail
    WHERE idResponsavel = idResponsavel

CREATE PROCEDURE spConsultaResponsavel
(
    IN

)
BEGIN
    SELECT nomeResponsavel, telefone, email, senhaEmail WHERE idResponsavel = idResponsavel
END //