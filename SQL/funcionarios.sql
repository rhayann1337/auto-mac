

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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
  `data_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
