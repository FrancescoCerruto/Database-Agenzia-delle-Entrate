CREATE DEFINER=`root`@`localhost` TRIGGER `agenzia_entrate`.`calcolo_data_convocazione`
BEFORE INSERT ON `richiesta`
FOR EACH ROW
BEGIN

	DECLARE nome_area VARCHAR(255);
    DECLARE data_c DATETIME;
    DECLARE n_stanza INTEGER;
    DECLARE id_dipendente INTEGER;
    DECLARE capacita_normale INTEGER;
    DECLARE capacita_ridotta INTEGER;
    DECLARE nome VARCHAR(255);
    DECLARE cognome VARCHAR(255);
    DECLARE codice_fiscale VARCHAR(255);
    DECLARE indirizzo VARCHAR(255);
    DECLARE comune VARCHAR(255);
    DECLARE provincia VARCHAR(255);
    DECLARE id_richiesta INTEGER;
    DECLARE id_carico INTEGER;
    DECLARE num_dipendenti INTEGER;
    DECLARE id_cliente INTEGER;
    DECLARE id_sede INTEGER;
    DECLARE id_servizio INTEGER;
    
    CALL recupero_id_mancanti (NEW.nome,NEW.cognome,NEW.codice_fiscale,NEW.indirizzo_residenza,NEW.comune,
    NEW.provincia,NEW.tipo_cliente,NEW.servizio_richiesto,NEW.regione_sede,NEW.provincia_sede,NEW.comune_sede,
    id_cliente,id_sede,id_servizio);
    
    SET NEW.id_cliente=id_cliente;
    SET NEW.id_sede=id_sede;
    SET NEW.id_servizio=id_servizio;
        
    SELECT COUNT(*)
      INTO num_dipendenti
      FROM utente
	WHERE utente.id_servizio=NEW.id_servizio
      AND utente.id_sede_area=NEW.id_sede
	;
    
    SELECT MAX(id) + 1
      INTO id_richiesta
      FROM richiesta
	;
    
    IF (id_richiesta IS NULL) THEN
    
		SET id_richiesta = 1;
        
    END IF;
    
    SET NEW.id=id_richiesta;
    
    IF (NEW.tipo_cliente = "Cittadino") THEN
    
		CALL recupero_ultima_data_convocazione_servizio(NEW.id_servizio, NEW.id_sede
        ,STR_TO_DATE("08:00:00","%H:%i:%s"), STR_TO_DATE("12:00:00","%H:%i:%s"),data_c);
	
    ELSEIF (NEW.tipo_cliente = "Ente") THEN
    
		CALL recupero_ultima_data_convocazione_servizio(NEW.id_servizio, NEW.id_sede
        ,STR_TO_DATE("14:00:00","%H:%i:%s"), STR_TO_DATE("18:00:00","%H:%i:%s"),data_c);
	
    END IF;
    
	CALL recupero_dati_area(NEW.id_sede,NEW.id_servizio,capacita_normale,nome_area);
    
    IF (data_c IS NULL OR DATE(data_c) <= NEW.data_ricezione) THEN
		
        SELECT utente.id
			   ,utente.n_stanza
		  INTO id_dipendente
			   ,n_stanza 
		  FROM utente
		WHERE utente.id_sede_area=NEW.id_sede
		  AND utente.id_servizio=NEW.id_servizio
		LIMIT 1
		;
        
		CALL primo_inserimento_orario_convocazione(new.tipo_cliente, new.data_ricezione,
        NEW.id_cliente, id_dipendente, NEW.id);
	
    ELSE
    
		IF (NEW.tipo_cliente="Cittadino") THEN
        
			CALL assegnazione_data_convocazione(STR_TO_DATE("08:00:00","%H:%i:%s"),
            STR_TO_DATE("12:00:00","%H:%i:%s"), NEW.id_sede, NEW.id_servizio, NEW.id_cliente, NEW.id,
            data_c,capacita_normale,STR_TO_DATE("00:15:00","%H:%i:%s"));
		
        ELSEIF (NEW.tipo_cliente="Ente") THEN
			
            SET capacita_ridotta = num_dipendenti * 5;
            
			CALL assegnazione_data_convocazione(STR_TO_DATE("14:00:00","%H:%i:%s"),
            STR_TO_DATE("18:00:00","%H:%i:%s"), NEW.id_sede, NEW.id_servizio, NEW.id_cliente, NEW.id,
            data_c,capacita_ridotta,STR_TO_DATE("00:45:00","%H:%i:%s"));
		
        END IF;
        
    END IF;
    
	SELECT carico_lavoro.id
      INTO id_carico
      FROM carico_lavoro
	WHERE carico_lavoro.id_richiesta=id_richiesta
    ;
    
    SET NEW.id_carico = id_carico;
    
END