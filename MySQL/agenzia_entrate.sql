DROP SCHEMA IF EXISTS agenzia_entrate;
CREATE SCHEMA agenzia_entrate;
USE agenzia_entrate;

CREATE TABLE `servizio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_qhhjqcky6c2284ip174hlnjyl` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `sede` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regione` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `comune` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UKmiqgkc8f0pr4xd99p5pxphots` (`regione`,`provincia`,`comune`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `area` (
  `nome` varchar(255) NOT NULL,
  `id_sede` int(11) NOT NULL,
  PRIMARY KEY (`nome`,`id_sede`),
  KEY `FKdl72bkwx0hnqfpc3xk5snk5sv` (`id_sede`),
  CONSTRAINT `FKdl72bkwx0hnqfpc3xk5snk5sv` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `utente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `codice_fiscale` varchar(255) NOT NULL,
  `data_nascita` date NOT NULL,
  `indirizzo_residenza` varchar(255) NOT NULL,
  `comune` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `delegante` varchar(255) DEFAULT NULL,
  `n_stanza` int(11) DEFAULT NULL,
  `id_sede_area` int(11) DEFAULT NULL,
  `nome_area` varchar(255) DEFAULT NULL,
  `id_servizio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_3vd7df1l1hnmhukq2bembt26n` (`codice_fiscale`),
  KEY `FKmo8a3v2k10oysgoerbxcl56tu` (`nome_area`,`id_sede_area`),
  KEY `FKrwh2lcyr0u0phivdwjle8kr4e` (`id_servizio`),
  CONSTRAINT`FKmo8a3v2k10oysgoerbxcl56tu` FOREIGN KEY (`nome_area`,`id_sede_area`) REFERENCES `area`(`nome`,`id_sede`),
  CONSTRAINT `FKrwh2lcyr0u0phivdwjle8kr4e` FOREIGN KEY (`id_servizio`) REFERENCES `servizio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `carico_lavoro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_convocazione` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_dipendente` int(11) NOT NULL,
  `id_richiesta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK6gnnqhnxyfl24nvom1cbao14b` (`id_cliente`),
  KEY `FKewcrmh2sulhj6pmmicq6ba5vc` (`id_dipendente`),
  CONSTRAINT `FK6gnnqhnxyfl24nvom1cbao14b` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`),
  CONSTRAINT `FKewcrmh2sulhj6pmmicq6ba5vc` FOREIGN KEY (`id_dipendente`) REFERENCES `utente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `richiesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_ricezione` date NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo_cliente` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `codice_fiscale` varchar(255) NOT NULL,
  `indirizzo_residenza` varchar(255) NOT NULL,
  `comune` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `regione_sede` varchar(255) NOT NULL,
  `provincia_sede` varchar(255) NOT NULL,
  `comune_sede` varchar(255) DEFAULT NULL,
  `id_servizio` int(11) NOT NULL,
  `servizio_richiesto` varchar(255) NOT NULL,
  `id_carico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UKeqc5chiks1skd5gmrjy4au4mh` (`codice_fiscale`,`data_ricezione`),
  KEY `FKjy5ssglvaclwkjavtmb7c2t70` (`id_cliente`),
  KEY `FKjy5ssglvaclwkjavtmb7c2ter` (`id_carico`),
  KEY `FKjy5ssglvaclwkjavtmb7c2t10` (`id_servizio`),
  KEY `FKpx4bdlcnp777xqk057v9rnl20` (`id_sede`),
  CONSTRAINT `FKjy5ssglvaclwkjavtmb7c2t70` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`),
  CONSTRAINT `FKjy5ssglvaclwkjavtmb7c2ter` FOREIGN KEY (`id_carico`) REFERENCES `carico_lavoro` (`id`),
  CONSTRAINT `FKjy5ssglvaclwkjavtmb7c2t10` FOREIGN KEY (`id_servizio`) REFERENCES `servizio` (`id`),
  CONSTRAINT `FKpx4bdlcnp777xqk057v9rnl20` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `notifica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `codice_fiscale` varchar(255) NOT NULL,
  `indirizzo_residenza` varchar(255) NOT NULL,
  `comune` varchar(255) NOT NULL,
  `provincia` varchar(255) NOT NULL,
  `data_convocazione` datetime NOT NULL,
  `area` varchar(255) NOT NULL,
  `n_stanza` int(11) NOT NULL,
  `id_richiesta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKkni1okn2n7a7vkv9x3evjviav` (`id_cliente`),
  KEY `FKkni1okn2n7a7vkv9x3evjviqg` (`id_richiesta`),
  CONSTRAINT `FKkni1okn2n7a7vkv9x3evjviav` FOREIGN KEY (`id_cliente`) REFERENCES `utente` (`id`),
  CONSTRAINT `FKkni1okn2n7a7vkv9x3evjviqg` FOREIGN KEY (`id_richiesta`) REFERENCES `richiesta` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `fornire` (
 `id_servizio` int(11) NOT NULL,
 `id_sede_area` int(11) NOT NULL,
 `nome_area` varchar(255) NOT NULL,
 `capacita` int(11) NOT NULL,
 PRIMARY KEY (`id_servizio`, `id_sede_area`, `nome_area`),
 KEY `FKmo8a3v2k10oysgoerbxcl56ts` (`nome_area`, `id_sede_area`),
 KEY `FKrwh2lcyr0u0phivdwjle8kr4w` (`id_servizio`),
 CONSTRAINT`FKmo8a3v2k10oysgoerbxcl56ts` FOREIGN KEY (`nome_area`,`id_sede_area`) REFERENCES `area` (`nome`,`id_sede`),
 CONSTRAINT `FKrwh2lcyr0u0phivdwjle8kr4w` FOREIGN KEY (`id_servizio`) REFERENCES `servizio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;