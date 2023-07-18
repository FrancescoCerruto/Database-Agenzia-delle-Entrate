CREATE DEFINER=`root`@`localhost` PROCEDURE `calcolo_pratiche_assegnate`
(IN data_c DATETIME, IN orario_apertura TIME, 
IN orario_chiusura TIME, IN id_servizio INTEGER, IN id_sede INTEGER, OUT num_pratiche INTEGER)
BEGIN

		SELECT COUNT(*)
		  INTO num_pratiche
		  FROM carico_lavoro
		WHERE DATE(carico_lavoro.data_convocazione)=DATE(data_c)
		  AND TIME(carico_lavoro.data_convocazione)>=orario_apertura
		  AND TIME(carico_lavoro.data_convocazione)<=orario_chiusura
		  AND id_dipendente IN (
			SELECT utente.id
			  FROM utente
			WHERE utente.id_servizio=id_servizio
			  AND utente.id_sede_area=id_sede
			)
		;

END