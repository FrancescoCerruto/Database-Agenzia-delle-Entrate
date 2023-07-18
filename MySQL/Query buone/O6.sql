SELECT nome,cognome,codice_fiscale
	   ,indirizzo_residenza,comune,
       provincia,count(*) AS num_richiesta
  FROM richiesta
WHERE id_cliente=9697
;