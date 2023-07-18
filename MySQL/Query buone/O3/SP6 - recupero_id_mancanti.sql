CREATE DEFINER=`root`@`localhost` PROCEDURE `recupero_id_mancanti`(IN nome VARCHAR(255),IN cognome VARCHAR(255),
IN codice_fiscale VARCHAR(255),IN indirizzo VARCHAR(255),IN comune VARCHAR(255),IN provincia VARCHAR(255),
IN tipo_utente VARCHAR(255), IN servizio_richiesto VARCHAR(255), IN regione_sede VARCHAR(255), IN provincia_sede VARCHAR(255),
IN comune_sede VARCHAR(255), OUT id_cliente INTEGER, OUT id_sede INTEGER, OUT id_servizio INTEGER)
BEGIN
	
    SELECT id
      INTO id_cliente
	  FROM utente
	WHERE utente.nome=nome
      AND utente.cognome=cognome
      AND utente.codice_fiscale=codice_fiscale
      AND utente.indirizzo_residenza=indirizzo
      AND utente.comune=comune
      AND utente.provincia=provincia
      AND utente.tipo=tipo_utente
	;
    
    IF (id_cliente IS NULL) THEN
    
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Cannot insert into table Richiesta: Utente doesn't exists";
        
    END IF;
    
    IF (comune_sede IS NULL) THEN
		
        SELECT id
          INTO id_sede
          FROM sede
          WHERE sede.regione=regione_sede
            AND sede.provincia=provincia_sede
            AND sede.comune IS NULL
		;
        
        IF (id_sede IS NULL) THEN
        
			SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = "Cannot insert into table Richiesta: Sede doesn't exists";
            
		END IF;
        
	ELSE
    
		SELECT id
          INTO id_sede
          FROM sede
          WHERE sede.regione=regione_sede
            AND sede.provincia=provincia_sede
            AND sede.comune=comune_sede
		;
        
        IF (id_sede IS NULL) THEN
        
			SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = "Cannot insert into table Richiesta: Sede doesn't exists";
            
		END IF;
        
    END IF;
    
    SELECT id
      INTO id_servizio
      FROM servizio
	WHERE servizio.nome=servizio_richiesto
    ;
    
    IF (id_servizio IS NULL) THEN
    
		SIGNAL SQLSTATE '45002' SET MESSAGE_TEXT = "Cannot insert into table Richiesta: Servizio doesn't exists";
        
	END IF;
    
END