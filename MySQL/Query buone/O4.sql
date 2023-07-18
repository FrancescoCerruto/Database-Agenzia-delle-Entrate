SELECT tipo, AVG(YEAR(CURRENT_DATE())-YEAR(data_nascita)) AS eta_media
  FROM utente
WHERE tipo!="Impiegato"
  AND EXISTS ( SELECT *
 FROM richiesta
	 WHERE utente.id=richiesta.id_cliente
			 )
GROUP BY tipo
;