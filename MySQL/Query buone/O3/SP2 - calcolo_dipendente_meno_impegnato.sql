CREATE DEFINER=`root`@`localhost` PROCEDURE `calcolo_dipendente_meno_impegnato`
(IN orario_apertura TIME, IN orario_chiusura TIME,
IN data_c DATETIME, IN id_servizio INTEGER, IN id_sede INTEGER, OUT id_dipendente INTEGER)
BEGIN

		SELECT carico_lavoro.id_dipendente
		  INTO id_dipendente
		  FROM carico_lavoro
		WHERE DATE(carico_lavoro.data_convocazione)=DATE(data_c)
		  AND TIME(carico_lavoro.data_convocazione)>=orario_apertura
		  AND TIME(carico_lavoro.data_convocazione)<=orario_chiusura
		  AND carico_lavoro.id_dipendente IN (
			SELECT id
			  FROM utente
			WHERE utente.id_servizio=id_servizio
			  AND id_sede_area=id_sede
			)
		GROUP BY carico_lavoro.id_dipendente
		HAVING count(*) = (
			SELECT MIN(numero)
			  FROM (
				SELECT count(*) AS numero
				  FROM carico_lavoro
				WHERE DATE(carico_lavoro.data_convocazione)=DATE(data_c)
				  AND TIME(carico_lavoro.data_convocazione)>=orario_apertura
				  AND TIME(carico_lavoro.data_convocazione)<=orario_chiusura
				  AND carico_lavoro.id_dipendente IN (
					SELECT id
					  FROM utente
					WHERE utente.id_servizio=id_servizio
					  AND id_sede_area=id_sede
					)
				GROUP BY carico_lavoro.id_dipendente
				) AS a
			)
		LIMIT 1
		;

END