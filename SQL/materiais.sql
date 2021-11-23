

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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


ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fornecedor_id` (`fornecedor_id`);


ALTER TABLE `materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `materiais`
  ADD CONSTRAINT `fk_fornecedor_id` FOREIGN KEY (`fk_fornecedor_id`) REFERENCES `fornecedores` (`id`);
COMMIT;

