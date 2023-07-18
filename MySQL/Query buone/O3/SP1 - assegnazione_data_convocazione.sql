CREATE DEFINER=`root`@`localhost` PROCEDURE `assegnazione_data_convocazione`
(IN orario_apertura TIME, IN orario_chiusura TIME, IN id_sede INTEGER, IN id_servizio INTEGER,
IN id_cliente INTEGER, IN id INTEGER, IN data_c DATETIME, IN capacita INTEGER, IN tempo_attesa TIME)
BEGIN

	DECLARE num_pratiche INTEGER;
	DECLARE id_dipendente INTEGER;
	DECLARE  n_stanza INTEGER;
    
	CALL calcolo_pratiche_assegnate(data_c, orario_apertura, orario_chiusura, id_servizio, id_sede, num_pratiche);
    
	IF (num_pratiche >= capacita ) THEN
    
		SELECT utente.id
			   ,utente.n_stanza
		  INTO id_dipendente
			   ,n_stanza 
		  FROM utente
		WHERE utente.id_sede_area=id_sede
		  AND utente.id_servizio=id_servizio
		LIMIT 1
		;
        
        IF (DATE_FORMAT(data_c,"%a") != "Fri" AND DATE_FORMAT(data_c,"%a") != "Sat") THEN
        
			INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (CAST(DATE(data_c) + INTERVAL 1 DAY AS DATETIME) + orario_apertura,id_cliente,id_dipendente,id);
              
		ELSEIF (DATE_FORMAT(data_c,"%a") = "Fri") THEN
        
			INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (CAST(DATE(data_c) + INTERVAL 3 DAY AS DATETIME) + orario_apertura,id_cliente,id_dipendente,id);
              
		ELSE
        
			INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (CAST(DATE(data_c) + INTERVAL 2 DAY AS DATETIME) + orario_apertura,id_cliente,id_dipendente,id);
              
		END IF;
        
	ELSE 
    
		SELECT u.id
		  INTO id_dipendente
		  FROM utente u
		WHERE u.id_sede_area = id_sede
		  AND u.id_servizio = id_servizio
		  AND NOT EXISTS (
			SELECT *
			  FROM carico_lavoro
			 WHERE u.id = carico_lavoro.id_dipendente
			   AND DATE(carico_lavoro.data_convocazione) = DATE(data_c)
               AND TIME(carico_lavoro.data_convocazione)>=orario_apertura
               AND TIME(carico_lavoro.data_convocazione)<=orario_chiusura
			   AND carico_lavoro.id_dipendente IN (
				  SELECT ut.id
					FROM utente ut
				   WHERE ut.id_sede_area = id_sede
					 AND ut.id_servizio = id_servizio
			   )
		)
		LIMIT 1
		;
        
		IF (id_dipendente IS NOT NULL) THEN
        
			SELECT utente.n_stanza
			  INTO n_stanza
			  FROM utente
			WHERE utente.id=id_dipendente
			;
            
			INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (STR_TO_DATE(DATE(data_c), "%Y-%m-%d%T%H:%i:%s") + orario_apertura,id_cliente,id_dipendente,id);
		
		ELSE
        
			CALL calcolo_dipendente_meno_impegnato(orario_apertura, orario_chiusura, data_c, id_servizio, id_sede, id_dipendente);
			
            SELECT MAX(data_convocazione)
			  INTO data_c
			  FROM carico_lavoro
			WHERE DATE(data_convocazione)=DATE(data_c)
              AND TIME(data_convocazione)>=orario_apertura
              AND TIME(data_convocazione)<=orario_chiusura
			  AND carico_lavoro.id_dipendente=id_dipendente
			;
            
			SELECT utente.n_stanza
			  INTO n_stanza
			  FROM utente
			WHERE utente.id=id_dipendente
			;
            
			INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (data_c + INTERVAL MINUTE(tempo_attesa) MINUTE,id_cliente,id_dipendente,id);
              
		END IF;
        
	END IF;
    
END