SELECT servizio_richiesto, regione_sede
	   ,provincia_sede, comune_sede
       ,count(*) AS num_richieste
  FROM richiesta
WHERE regione_sede="Sicilia"
  AND provincia_sede="Catania"
  AND comune_sede IS NULL 
GROUP BY id_servizio
;
