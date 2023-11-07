-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/11/2023 às 02:01
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
-- Banco de dados: `diariobordo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `ID_CATEGORIA` int(11) NOT NULL,
  `NOME_CATEGORIA` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`ID_CATEGORIA`, `NOME_CATEGORIA`) VALUES
(1, 'Fases do Desenvolvimento'),
(2, 'Aspectos Técnicos'),
(3, 'Impacto na Comunidade'),
(4, 'Conclusão');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(250) NOT NULL,
  `DATA_PUBLICACAO` date NOT NULL,
  `ID_CATEGORIA` int(11) DEFAULT NULL,
  `CONTEUDO` longtext NOT NULL,
  `IMAGEM` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`ID`, `TITULO`, `DATA_PUBLICACAO`, `ID_CATEGORIA`, `CONTEUDO`, `IMAGEM`) VALUES
(1, 'O Início da Jornada', '2023-04-01', 1, 'Olá, pessoal! Hoje marcamos o ponto de partida de uma jornada incrível. Nosso grupo de desenvolvedores está animado para compartilhar com vocês o início do projeto de criação do jogo de memória para crianças com autismo. Estamos cheios de ideias e determinados a criar algo especial e inclusivo. Fiquem ligados para mais atualizações!', ''),
(2, 'Nossa Missão e Visão', '2023-04-20', 3, 'Descubra mais sobre a missão e visão por trás do nosso projeto. Queremos criar um espaço de diversão e aprendizado para todas as crianças, com especial atenção às necessidades das crianças com autismo.', ''),
(3, 'Processo de ideias', '2023-05-03', 1, 'Nesta fase crucial, estamos imersos em um processo de brainstorming criativo. Cada ideia é considerada. Estamos explorando temas, mecânicas de jogo e histórias que não apenas desafiam, mas também estimulam o desenvolvimento cognitivo das crianças com autismo.', ''),
(4, 'Protótipo: Testes Iniciais', '2023-06-21', 1, 'Apresentamos nosso primeiro protótipo! Nossa equipe de programadores está trabalhando para criar uma experiência interativa e cativante. Cada feedback recebido está sendo cuidadosamente analisado para refinar nosso jogo, garantindo que ele atenda às expectativas e necessidades específicas do público-alvo.', ''),
(5, 'A Customização do Jogo', '2023-06-21', 1, 'Entrando na fase de customização! Estamos adicionando elementos especiais ao jogo para garantir que ele atenda às necessidades específicas das crianças com autismo. A personalização é a chave, e mal podemos esperar para revelar as surpresas que preparamos!', ''),
(6, 'Superando Bugs e Limitações', '2023-08-08', 2, 'Compartilhamos alguns dos desafios técnicos que enfrentamos durante o desenvolvimento. Desde bugs inesperados até limitações de plataforma, este post destaca como superamos obstáculos técnicos para melhorar constantemente o jogo.', ''),
(7, 'Abordagens em Cibersegurança', '2023-08-15', 2, 'A segurança é nossa prioridade. Neste post, discutimos as medidas de segurança implementadas no jogo para proteger dados sensíveis e garantir uma experiência segura para os usuários, desde a prevenção de ataques até práticas recomendadas de codificação segura.', ''),
(8, 'A Magia dos Detalhes', '2023-08-20', 4, 'Detalhes importam! Revelamos como cada pequeno elemento do jogo foi meticulosamente planejado para criar uma experiência mágica e envolvente para as crianças. Dos personagens às animações, cada detalhe foi concebido para transmitir uma mensagem de inclusão e diversão.', ''),
(9, 'Testes Finais e Ajustes', '2023-09-05', 4, 'Estamos nos aproximando da fase final! Testes finais estão em andamento, e ajustes estão sendo feitos para garantir uma experiência perfeita.', ''),
(10, 'Reconhecimento e Feedback Pós-Lançamento', '2023-09-19', 4, 'Compartilhamos as primeiras reações ao jogo. O reconhecimento recebido e o feedback inicial foram essenciais para o nosso desenvolvimento. Esta jornada foi incrível, e queremos agradecer a todos que nos apoiaram.', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_CATEGORIA`);

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_CATEGORIA` (`ID_CATEGORIA`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`ID_CATEGORIA`) REFERENCES `categoria` (`ID_CATEGORIA`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
