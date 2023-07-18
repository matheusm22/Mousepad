 CREATE TABLE `tb_acessos` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `matricula` int NOT NULL,
  `ativo` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dta_criacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `dt_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `matricula` (`matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO tb_acessos(usuario,senha,matricula, ativo) 
        VALUES ('matheus', 139046, 3226, 'Sim');

SELECT * FROM  tb_acessos;