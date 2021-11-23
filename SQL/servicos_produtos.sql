SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `servicos_produtos` (
  `id` int(11) NOT NULL,
  `servico_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `quantidade_produto` int(11) DEFAULT NULL,
  `valor_produto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;


ALTER TABLE `servicos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_servico_id` (`servico_id`),
  ADD KEY `fk_material_id` (`material_id`);


ALTER TABLE `servicos_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `servicos_produtos`
  ADD CONSTRAINT `fk_servico_id` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_material_id` FOREIGN KEY (`material_id`) REFERENCES `materiais` (`id`);
COMMIT;
