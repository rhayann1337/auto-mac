-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2021 às 05:08
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `autokratchei_v1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone_fixo` varchar(20) NOT NULL,
  `telefone_movel` varchar(20) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `placa` varchar(50) NOT NULL,
  `veiculo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `sobrenome`, `cpf`, `email`, `telefone_fixo`, `telefone_movel`, `endereco`, `sexo`, `placa`, `veiculo`) VALUES
(4, 'Rhayann', 'Schuvantek', '', 'rhayannbianco@gmail.com', '(41) 99735-4484', '(41) 99735-4484', 'Rua Magdalena Taborda Ribas', '0', 'BCM1234', 'Peugeot 307 2008'),
(5, 'John', 'Doe', '', 'john@mail.com', '(11) 11111-1111', '(11) 11111-1111', 'Teste', 'Masculino', 'ABM3232', 'Gol Quadrado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `marca` varchar(200) DEFAULT NULL,
  `contato` varchar(45) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `endereco` varchar(145) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `descricao` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `marca`, `contato`, `telefone`, `email`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `foto`, `descricao`) VALUES
(1, 'FORD', 'James', '41997221457', 'james@ford.br', '81120320', 'Rua Desembargador Gamalho', 'Uberaba', 'Curitiba', 'PR', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Ford_logo_flat.svg/2560px-Ford_logo_flat.svg.png', 'Vende peças da ford.'),
(2, 'Volkswagen', 'Ismael', '41997221457', 'ismael@volkss.com.br', '81120320', 'Rua Desembargador Gamalho', 'Uberaba', 'Curitiba', 'PR', 'https://logodownload.org/wp-content/uploads/2014/02/volkswagen-vw-logo.png', 'Vende peças da volkswagen.'),
(3, 'Chevrolet', 'Ryan', '4192157741', 'ryan@chevrolet.br.ind', NULL, 'Rua Magalhães', 'Uberaba', 'Curitiba', 'PR', 'https://http2.mlstatic.com/D_NQ_NP_774702-MLB43442917805_092020-O.jpg', 'Vende peças da chevrolet'),
(4, 'Toyota', 'Silvia', '4130298121', 'silvia@toyo.br', NULL, 'Rua Alfredo Polis', 'Almira', 'Adamantina', 'SC', 'https://logospng.org/download/toyota/logo-toyota-2048.png', 'Vende peças da toyota'),
(5, 'Fiat', 'Lucas Carvalho', '3399652154', 'lucas@fiat.com.br', '82105200', 'Rua Silvia Jardim 323', 'Quitandinha', 'Belo Horizonte', 'MG', 'https://www.fratar.com.br/wp-content/uploads/2018/12/fiat-logo-1.png', 'Vende peças da fiat.'),
(11, 'Loja Geral Veículos', 'Loja Geral Veículos', '(11) 1111-1111', 'geral@mail.com', '11111-111', 'Rua Geral', 'Geral', 'Curitiba', 'PR', 'http://localhost/automac/assets/imagens/fornecedores/oficina.jpg', 'Conteúdos gerais para utilizar em veículos.'),
(12, 'Honda', 'João Silva', '(41) 9932-1542', 'joao@honda.com', '80030-020', 'Rua Marechal', 'Centro', 'Curitiba', 'PR', 'http://localhost/automac/assets/imagens/fornecedores/honda.png', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome_funcionario` varchar(45) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone_fixo` varchar(20) NOT NULL,
  `telefone_movel` varchar(20) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `cargo` varchar(50) NOT NULL,
  `data_registro` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome_funcionario`, `sobrenome`, `cpf`, `email`, `telefone_fixo`, `telefone_movel`, `endereco`, `sexo`, `rg`, `data_nascimento`, `foto`, `cargo`, `data_registro`) VALUES
(4, 'SXNhYmVsbGE=', 'S3JhdGNoZWk=', 'MTIzLjQ1Ni43ODktMTI=', 'aXNhYmVsbGFAbWFpbC5jb20=', 'KDExKSAxMTExMS0xMTEx', 'KDExKSAxMTExMS0xMTEx', 'VGVzdGU=', 'TWFzY3VsaW5v', 'MTEtMTExLTExMS0x', '0000-00-00', 'http://localhost/automac/assets/imagens/funcionarios/anti-social-social-club-11.jpg', 'Gerente', '2021-11-23 19:55:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `nome_material` varchar(45) NOT NULL,
  `fornecedor_id` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `quantidade_minima` varchar(45) NOT NULL,
  `material` varchar(45) NOT NULL,
  `observacoes` varchar(1000) NOT NULL,
  `foto` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `quantidade`, `valor`, `nome_material`, `fornecedor_id`, `modelo`, `quantidade_minima`, `material`, `observacoes`, `foto`) VALUES
(7, 2, 250, 'Radiador Corsa GM', '3', 'Corsa GM Hatch', '1', 'ferro', '- Se encaixa em padrões chevrolet', 'http://localhost/automac/assets/imagens/materiais/radiador_corsa_antigo.jpg'),
(8, 3, 890, 'Grade Golf GTI', '10', 'Golf GTI', '1', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/grade_golf_gti.jpg'),
(9, 5, 230, 'Kit faróis Gol 2006-2008', '2', 'Gol 2006-2008', '2', 'outro', '', 'http://localhost/automac/assets/imagens/materiais/kit_farol_gol_bola.jpg'),
(10, 1, 300, 'Kit faróis Gol G5', '2', 'Gol G5', '1', 'outro', '', 'http://localhost/automac/assets/imagens/materiais/kit_farol_gol_novo.jpg'),
(11, 2, 150, 'Kit faróis Gol quadrado', '2', 'Gol Quadrado', '1', 'outro', '', 'http://localhost/automac/assets/imagens/materiais/kit_farol_gol_quadrado.jpg'),
(13, 28, 25, 'Kit Grampos', '11', 'Geral', '5', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/kit_grampo_forro.jpg'),
(14, 45, 50, 'Kit lâmpadas led', '11', 'Geral', '20', 'outro', '', 'http://localhost/automac/assets/imagens/materiais/kit_lampadas.jpg'),
(15, 23, 30, 'Óleo Motul', '11', 'Sintético', '5', 'outro', '- Óleo sintético', 'http://localhost/automac/assets/imagens/materiais/kit_oleo_motul.jpg'),
(16, 7, 120, 'Kit pastilha freio fox', '2', 'Volkswagen Fox', '5', 'ferro', '', 'http://localhost/automac/assets/imagens/materiais/kit_pastilha_freio_fox.jpg'),
(17, 14, 150, 'Kit pastilha de freio Gol/Polo/Up', '2', 'Gol G5', '5', 'ferro', '', 'http://localhost/automac/assets/imagens/materiais/kit_pastilha_gol.jpg'),
(18, 3, 30, 'Moldura paralama Corsa', '3', 'Corsa Sedan', '1', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/moldura_paralama_corsa.jpg'),
(19, 1, 120, 'Parachoque Celta', '3', 'Celta', '3', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_celta.jpg'),
(20, 3, 120, 'Parachoque Corsa Hatch', '11', 'Corsa Hatch', '5', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_corsa_hatch.jpg'),
(21, 5, 120, 'Parachoque Corsa Sedan', '3', 'Corsa Sedan', '3', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_corsa_sedan.jpg'),
(22, 5, 150, 'Parachoque Gol G5', '2', 'Gol G5', '3', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_gol_novo.jpg'),
(23, 3, 80, 'Parachoque Gol 2006-2008', '2', 'Gol 2006-2008', '5', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_gol_velho.jpg'),
(24, 0, 300, 'Parachoque Honda Civic 2006', '12', 'Honda Civic 2006', '3', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_honda_civic_2006.jpg'),
(25, 3, 80, 'Parachoque Uno Mile', '5', 'Uno mile', '2', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/parachoque_uno.jpg'),
(26, 3, 90, 'Paralama Gol 2006-2008', '12', 'Gol 2006-2008', '3', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/paralam_gol_velho1.jpg'),
(27, 3, 80, 'Paralama Corsa Sedan', '12', 'Corsa Sedan', '1', 'plastico', '', 'http://localhost/automac/assets/imagens/materiais/paralama_corsa.jpg'),
(28, 5, 180, 'Paralama Gol G5', '2', 'Gol G5', '3', 'outro', '', 'http://localhost/automac/assets/imagens/materiais/paralama_gol_novo.jpg'),
(29, 0, 89, 'Paralama Gol Quadrado', '2', 'Gol Quadrado', '1', 'ferro', '', 'http://localhost/automac/assets/imagens/materiais/paralama_gol_quadrado.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `oficina`
--

CREATE TABLE `oficina` (
  `id` int(11) NOT NULL,
  `razao_social` varchar(145) DEFAULT NULL,
  `nome_fantasia` varchar(145) DEFAULT NULL,
  `cnpj` varchar(25) DEFAULT NULL,
  `ie` varchar(25) DEFAULT NULL,
  `telefone_fixo` varchar(25) DEFAULT NULL,
  `telefone_movel` varchar(25) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site_url` varchar(100) DEFAULT NULL,
  `cep` varchar(25) DEFAULT NULL,
  `endereco` varchar(145) DEFAULT NULL,
  `numero` varchar(25) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `txt_ordem_servico` tinytext DEFAULT NULL,
  `data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `oficina`
--

INSERT INTO `oficina` (`id`, `razao_social`, `nome_fantasia`, `cnpj`, `ie`, `telefone_fixo`, `telefone_movel`, `email`, `site_url`, `cep`, `endereco`, `numero`, `cidade`, `estado`, `txt_ordem_servico`, `data_alteracao`) VALUES
(1, 'Conserto e manutenção de veículos', 'Auto Mac', '47.289.547/0001-12', '159527024562', '(41) 3333-4444', '(41) 99733-1234', 'automac@mail.com', 'automac.com.br', '81050-000', 'Rua Alfredo Silva', '332', 'Curitiba', 'PR', 'TEXTO', '2021-11-23 20:06:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `funcionario_id` int(11) DEFAULT NULL,
  `valor_total` float DEFAULT NULL,
  `descricao` varchar(1500) DEFAULT NULL,
  `data` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamentos`
--

INSERT INTO `orcamentos` (`id`, `cliente_id`, `funcionario_id`, `valor_total`, `descricao`, `data`) VALUES
(1, 1, 2, 123, 'teste', '2021-11-20 06:26:44'),
(2, 5, 4, 450, 'teste', '2021-11-23 20:00:30');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `registro_orcamento` int(11) NOT NULL,
  `nome_servico` varchar(145) DEFAULT NULL,
  `data` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `preco` varchar(15) DEFAULT NULL,
  `descricao` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `cliente_id`, `funcionario_id`, `registro_orcamento`, `nome_servico`, `data`, `preco`, `descricao`) VALUES
(30, 4, 4, 2, 'Substituindo novo parachoque', '2021-11-23 03:00:00', '250', '- Realizado a instalação do parachoque celta, troca dos grampos.'),
(31, 5, 4, 2, 'Manutenção geral', '2021-11-23 03:00:00', '450', '- Realizado troca de óleo, pastilhas e pintura do paralama.'),
(32, 4, 4, 2, 'troca de para', '2021-11-23 03:00:00', '175', 'troca'),
(33, 4, 4, 2, 'Troca do parachoque', '2021-11-25 03:00:00', '250', 'sdasdasdasda'),
(34, 5, 4, 2, 'Troca do parachoque', '2021-11-29 03:00:00', '350', 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos_produtos`
--

CREATE TABLE `servicos_produtos` (
  `id` int(11) NOT NULL,
  `servico_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantidade_produto` int(11) DEFAULT NULL,
  `valor_produto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servicos_produtos`
--

INSERT INTO `servicos_produtos` (`id`, `servico_id`, `material_id`, `quantidade_produto`, `valor_produto`) VALUES
(26, 30, 19, 1, ' 120.00'),
(27, 30, 13, 2, ' 25.00'),
(28, 31, 15, 5, ' 30.00'),
(29, 31, 29, 1, ' 89.00'),
(30, 31, 17, 1, ' 150.00'),
(31, 32, 19, 1, ' 120.00'),
(32, 33, 19, 1, ' 120.00'),
(33, 34, 24, 1, ' 300.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$VE7XN9Bgke7lm82pqG8xUugvByXM..q8BNJBmjNrotMg92Z1Jae1u', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1638070011, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fornecedor_id` (`fornecedor_id`);

--
-- Índices para tabela `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_id` (`cliente_id`),
  ADD KEY `fk_funcionario_id` (`funcionario_id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_id` (`cliente_id`),
  ADD KEY `fk_funcionario_id` (`funcionario_id`);

--
-- Índices para tabela `servicos_produtos`
--
ALTER TABLE `servicos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servico_id` (`servico_id`),
  ADD KEY `fk_material_id` (`material_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `oficina`
--
ALTER TABLE `oficina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `servicos_produtos`
--
ALTER TABLE `servicos_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `servicos_produtos`
--
ALTER TABLE `servicos_produtos`
  ADD CONSTRAINT `fk_material_id` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`id`),
  ADD CONSTRAINT `fk_servico_id` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
