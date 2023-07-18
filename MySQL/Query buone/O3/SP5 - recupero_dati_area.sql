CREATE DEFINER=`root`@`localhost` PROCEDURE `recupero_dati_area`
(IN id_sede INTEGER,IN id_servizio INTEGER,OUT capacita INTEGER,
OUT nome_area VARCHAR(255))
BEGIN

	SELECT fornire.nome_area,fornire.capacita
      INTO nome_area,capacita
	  FROM fornire
	WHERE fornire.id_sede_area=id_sede
      AND fornire.id_servizio=id_servizio
	;

END