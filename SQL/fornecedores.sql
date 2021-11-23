SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `marca` varchar(200) DEFAULT NULL,
  `contato` varchar(45) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `endereco` varchar(145) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL,
  `descricao` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;