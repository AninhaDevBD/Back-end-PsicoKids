-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 22-Maio-2022 às 21:57
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAtualizaCrianca` (IN `spnomeCrianca` VARCHAR(100), IN `spidade` INT(11), IN `spserie` INT(11), IN `spsexo` VARCHAR(10), IN `spimagemPerfil` VARCHAR(50))  UPDATE crianca SET nomeCrianca = spnome, idade = spidade, serie = spserie, sexo = spsexo, imagemPerfil = spimagemPerfil
    WHERE idCrianca = spidCrianca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spAtualizaResponsavel` (IN `nomeResponsavel` VARCHAR(90), `telefone` VARCHAR(15), `email` VARCHAR(100), `senhaEmail` VARCHAR(20))  BEGIN
    UPDATE responsavel SET nomeResponsavel = spnomeResponsavel, telefone = sptelefone, email = spemail, senhaEmail = spsenhaEmail
    WHERE idResponsavel = spidResponsavel;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCadastraCrianca` (IN `nomeCrianca` VARCHAR(100), IN `idade` INT(11), IN `serie` INT(11), IN `sexo` VARCHAR(10), IN `avaliacao` VARCHAR(10), IN `nivel` INT(11), IN `imagemPerfil` VARCHAR(50))  INSERT INTO crianca (nomeCrianca, idade, serie, sexo, avaliacao, nivel, imagemPerfil) 
    VALUES (nomeCrianca = spnomeCrianca, idade = spidade, serie = spserie, sexo = spsexo, avaliacao = spavaliacao, nivel = spnivel, imagemPerfil = spimagemPerfil)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spCadastraResponsavel` (IN `nomeResponsavel` VARCHAR(90), IN `telefone` VARCHAR(15), IN `email` VARCHAR(100), IN `senhaEmail` VARCHAR(20), IN `senhaAcesso` INT(6), IN `nivelacesso` INT)  BEGIN
    INSERT INTO responsavel (nomeResponsavel, telefone, email, senhaEmail, senhaAcesso,
                             nivelacesso) 
    VALUES (nomeResponsavel, telefone, email, senhaEmail, senhaAcesso, nivelacesso);    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultaCrianca` (IN `nomeCrianca` VARCHAR(100), IN `idade` INT(11), IN `serie` INT(11), IN `sexo` VARCHAR(10), IN `imagemPerfil` VARCHAR(50))  SELECT idCrianca, nomeCrianca, idade, serie, sexo, imagemPerfil FROM crianca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spConsultaResponsavel` (IN `nomeResponsavel` VARCHAR(90), IN `telefone` VARCHAR(15), IN `email` VARCHAR(100), IN `senhaEmail` VARCHAR(20))  SELECT idResponsavel, nomeResponsavel, telefone, email FROM responsavel$$

DELIMITER ;

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
  `imagemPerfil` varchar(50) NOT NULL
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
  `senhaAcesso` int(6) NULL,
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
