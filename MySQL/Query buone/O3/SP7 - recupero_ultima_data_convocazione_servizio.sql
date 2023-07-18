CREATE DEFINER=`root`@`localhost` PROCEDURE `recupero_ultima_data_convocazione_servizio`
(IN id_servizio_scelto INTEGER, IN id_sede_scelta INTEGER,
IN orario_apertura TIME, IN orario_chiusura TIME, OUT data_c DATETIME)
BEGIN

		SELECT MAX(data_convocazione)
		   INTO data_c
		   FROM carico_lavoro join richiesta on id_richiesta=richiesta.id
		 WHERE id_servizio=id_servizio_scelto
           AND id_sede=id_sede_scelta
           AND TIME(data_convocazione)<=orario_chiusura
           AND TIME(data_convocazione)>=orario_apertura
		;
        
END