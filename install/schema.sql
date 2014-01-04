CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(65) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `registro` (
  `idregistro` int(11) NOT NULL AUTO_INCREMENT,
  `chave` varchar(10) NOT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `value` text,  
  PRIMARY KEY (`idregistro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
