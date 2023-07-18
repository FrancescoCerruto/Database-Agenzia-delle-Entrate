CREATE DEFINER=`root`@`localhost` PROCEDURE `primo_inserimento_orario_convocazione`
(IN tipo_utente VARCHAR(255),
IN data_ricezione DATE, IN id_cliente INTEGER, IN id_dipendente INTEGER, IN id INTEGER)
BEGIN

	IF (tipo_utente = "Cittadino") THEN
    
        IF (DATE_FORMAT(data_ricezione,"%a") != "Fri" AND DATE_FORMAT(data_ricezione,"%a") != "Sat") THEN
        
			INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (STR_TO_DATE(data_ricezione,"%Y-%m-%d%T%H:%i:%s")  + INTERVAL 1 DAY + STR_TO_DATE("08:00:00","%H:%i:%s"),
              id_cliente,id_dipendente,id);
		
        ELSE
        
			IF (DATE_FORMAT(data_ricezione,"%a") = "Fri") THEN
            
				INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
				  VALUES (STR_TO_DATE(data_ricezione,"%Y-%m-%d%T%H:%i:%s")  + INTERVAL 3 DAY + STR_TO_DATE("08:00:00","%H:%i:%s"),
                  id_cliente,id_dipendente,id);
			
            ELSE
				
                INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
				  VALUES (STR_TO_DATE(data_ricezione,"%Y-%m-%d%T%H:%i:%s")  + INTERVAL 2 DAY + STR_TO_DATE("08:00:00","%H:%i:%s"),
                  id_cliente,id_dipendente,id);
			
            END IF;
		
        END IF;
	
    ELSEIF (tipo_utente = "Ente") THEN
		
        IF (DATE_FORMAT(data_ricezione,"%a") != "Fri" AND DATE_FORMAT(data_ricezione,"%a") != "Sat") THEN
			
            INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
			  VALUES (STR_TO_DATE(data_ricezione,"%Y-%m-%d%T%H:%i:%s")  + INTERVAL 1 DAY + STR_TO_DATE("14:00:00","%H:%i:%s"),
              id_cliente,id_dipendente,id);
		
        ELSE
			
            IF (DATE_FORMAT(data_ricezione,"%a") = "Fri") THEN
				
                INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
				  VALUES (STR_TO_DATE(data_ricezione,"%Y-%m-%d%T%H:%i:%s")  + INTERVAL 3 DAY + STR_TO_DATE("14:00:00","%H:%i:%s"),
                  id_cliente,id_dipendente,id);
			
            ELSE
				
                INSERT INTO carico_lavoro (data_convocazione,id_cliente,id_dipendente,id_richiesta)
				  VALUES (STR_TO_DATE(data_ricezione,"%Y-%m-%d%T%H:%i:%s")  + INTERVAL 2 DAY + STR_TO_DATE("14:00:00","%H:%i:%s"),
                  id_cliente,id_dipendente,id);
			
            END IF;
		
        END IF;
	
    END IF;

END