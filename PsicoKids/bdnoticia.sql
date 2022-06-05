-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Maio-2022 às 19:04
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdnoticia`
--
CREATE DATABASE IF NOT EXISTS `bdnoticia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdnoticia`;

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCadastrarUsuario` (IN `nome` VARCHAR(50), `email` VARCHAR(50), `senha` VARCHAR(60), `nivelacesso` INT)  BEGIN
	INSERT INTO usuario (nome, email, senha, nivelacesso) 
    VALUES (nome,email, senha, nivelacesso);	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nomecategoria` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nomecategoria`) VALUES
(9, 'Tecnologia'),
(13, 'Esportes'),
(14, 'Entretenimento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `idnoticia` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `titulo` varchar(100) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`idnoticia`, `data`, `titulo`, `idcategoria`, `conteudo`, `imagem`, `ativo`) VALUES
(21, '2022-05-18 16:06:00', 'Eclipse lunar: confira fotos da \'lua de sangue\' vista no Brasil', 9, 'Na noite do último domingo (15) aconteceu o primeiro eclipse lunar total do ano. O fenômeno — que pôde ser visto em todo o Brasil — teve seu ápice na madrugada de hoje (16) à 1h11, com o término por volta das 3h50.\r\n\r\nO eclipse também foi considerado uma \"superlua de sangue\". Isso porque, durante eclipse, a lua é encoberta pela sombra da Terra, evitando que os raios de sol cheguem até ela diretamente. Recebendo apenas algumas faixas de luz — que passam pela atmosfera do nosso planeta — o satélite ganha a cor mais avermelhada.', 'f7d0573bd7a87b0da73c7b2051fb1f60.webp', 1),
(22, '2022-05-18 16:07:00', 'Filtro de choro viraliza no TikTok e Instagram; veja como usar', 9, 'A internet possui uma incrível capacidade de reciclar e adaptar conteúdos, isso é fato. E nas últimas semanas o formato que voltou a viralizar foi o filtro de choro, que virou assunto no TikTok e Instagram.\r\n\r\nCriado em 2021 no Snapchat, a ferramenta altera o rosto da pessoa e simula como se ela estivesse chorando ou bastante chateada.\r\n\r\nO meme já estava rolando, mas tomou outras proporções principalmente depois que a cantora Anitta publicou um vídeo utilizando o recurso no domingo (15). Muitos famosos e anônimos aproveitaram a onda e entraram na brincadeira.', '6155cbde6b8601495647ac0cc8c6c774.webp', 1),
(23, '2022-05-18 16:08:00', 'Netflix pensa em fazer transmissões ao vivo de finais e especiais', 9, 'A plataforma de streaming Netflix está estudando a possibilidade de realizar transmissões ao vivo em algumas ocasiões especiais — caso de finais de reality shows muito aguardados ou especiais de comédia stand-up, por exemplo.\r\n\r\nSegundo o site Deadline, a empresa está \"em estado inicial de desenvolvimento\" da tecnologia que vai permitir a exibição de conteúdos ao vivo no serviço. Além de mostrar resultados de competições, isso pode trazer uma camada a mais de interação, no caso de programas que tenham votação ao vivo, por exemplo.', '267a58b734b7c14c1f90b038eb1cd3f3.webp', 1),
(24, '2022-05-18 16:09:00', 'Elon Musk e CEO do Twitter discutem por causa de bots e ações caem', 9, 'Em mais um episódio da “novela” na qual se transformou a venda do Twitter para Elon Musk por US$ 44 bilhões, o CEO da rede social veio a público nesta segunda-feira (16) para contestar as preocupações do bilionário sobre a existência de spam e bots na plataforma. De acordo com Parag Agrawal, a sugestão de fazer uma auditoria externa com 100 contas aleatórias não iria dar certo.\r\n\r\nElon Musk compra Twitter por US$ 44 bilhões\r\nPara o executivo, uma estimativa desse tipo não poderia ser realizada por uma empresa externa, pois demandaria a utilização de informações públicas e privadas “que não podemos compartilhar”. Destacando que nem mesmo a informação sobre o número de Usuários Ativos Diários pode ser compartilhada, Agrawal confirmou que “nossas estimativas internas reais para os últimos quatro trimestres ficaram bem abaixo de 5%”.', '70d501ce6a28cae902f8f5435cb0deb8.webp', 1),
(25, '2022-05-18 16:46:00', 'Palmeiras anuncia contratação do atacante Miguel Merentiel', 13, 'O Palmeiras anunciou nesta quarta-feira a contratação do atacante uruguaio Miguel Merentiel, do Defensa y Justicia, da Argentina. O jogador de 26 anos assinou contrato válido até 30 de junho de 2026.\r\n\r\n- A verdade é que é algo inexplicável e impressionante. Estou muito feliz por estar no atual bicampeão da América. Vou aproveitar da melhor maneira e dar tudo por essa equipe. Para a minha carreira, é algo enorme, passei de um time rival para o maior da América do Sul. Vou viver isso da melhor maneira, vou me entregar ao máximo por esse clube - afirmou Merentiel, ao site do Palmeiras.', '0b06f4d72dd3be075178cb38c4655719.webp', 1),
(26, '2022-05-18 16:47:00', 'Tom Cruise lança \'Top Gun: Maverick\' no Festival de Cannes; veja fotos', 14, 'Tom Cruise chegou chegando ao lançamento de \"Top Gun: Maverick\", no Festival de Cannes, nesta quarta-feira, 18/5. O astro de Hollywood, que fará 60 anos em 3 de julho, impactou com sua presença mais do que vip no tapete vermelho do evento, um dos mais importantes do cinema mundial.', 'ea0bd361ee563c4005e4ed608a21a28d.webp', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `nivelacesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nome`, `email`, `senha`, `nivelacesso`) VALUES
(1, 'Anderson Spera', 'andersonspera@gmail.com', '$2y$10$F7xH1M8MivlJIO39U9Ll7.IB9pLmer1v9IjBiqOmOIq00y3TpHCvu', 1),
(14, 'Fulano da Silva', 'fulano@gmail.com', '$2y$10$cICusKMMxNJF0rmOijjr6.2AEcNOvga821a.2q.fK9Lm5qubKDnnK', 2),
(15, 'Aluno', 'aluno@aluno.com', '$2y$10$k3v71QaY4z4fjGd3FsCd1ebPSMJwT32OLUle/WH3vyS98npKkQAuq', 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vwnoticias`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `vwnoticias` (
`idnoticia` int(11)
,`data` timestamp
,`titulo` varchar(100)
,`idcategoria` int(11)
,`conteudo` text
,`imagem` varchar(50)
,`ativo` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `vwnoticias`
--
DROP TABLE IF EXISTS `vwnoticias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwnoticias`  AS SELECT `noticia`.`idnoticia` AS `idnoticia`, `noticia`.`data` AS `data`, `noticia`.`titulo` AS `titulo`, `categoria`.`idcategoria` AS `idcategoria`, `noticia`.`conteudo` AS `conteudo`, `noticia`.`imagem` AS `imagem`, `noticia`.`ativo` AS `ativo` FROM (`noticia` join `categoria` on(`categoria`.`idcategoria` = `noticia`.`idcategoria`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idnoticia`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idnoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `fkcategoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
