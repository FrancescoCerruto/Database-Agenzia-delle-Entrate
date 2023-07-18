CREATE DEFINER=`root`@`localhost` TRIGGER `agenzia_entrate`.`vincolo_inserimento_tabella_utente`
BEFORE INSERT ON `utente` FOR EACH ROW
BEGIN

	IF (NEW.tipo = "Impiegato") THEN
		
        IF (NEW.delegante IS NOT NULL OR
			NEW.n_stanza IS NULL OR
            NEW.id_sede_area IS NULL OR
            NEW.nome_area IS NULL OR
            NEW.id_servizio IS NULL) THEN
            
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot insert into table Utente: invalid values ​​inserted";
            
		END IF;
        
	ELSEIF (NEW.tipo = "Cittadino") THEN
		
		IF (NEW.delegante IS NOT NULL OR
			NEW.n_stanza IS NOT NULL OR
            NEW.id_sede_area IS NOT NULL OR
            NEW.nome_area IS NOT NULL OR
            NEW.id_servizio IS NOT NULL) THEN
            
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot insert into table Utente: invalid values ​​inserted";
            
		END IF;
	
    ELSEIF (NEW.tipo = "Ente") THEN
    	
		IF (NEW.delegante IS NULL OR
			NEW.n_stanza IS NOT NULL OR
            NEW.id_sede_area IS NOT NULL OR
            NEW.nome_area IS NOT NULL OR
            NEW.id_servizio IS NOT NULL) THEN
            
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot insert into table Utente: invalid values ​​inserted";
            
		END IF;
	
    ELSE
		
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot insert into table Utente: Tipo not allowed";
	
    END IF;
	
END