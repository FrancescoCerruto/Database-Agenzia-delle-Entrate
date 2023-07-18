CREATE DEFINER=`root`@`localhost` TRIGGER `agenzia_entrate`.`inserisci_notifica`
AFTER INSERT ON `richiesta` FOR EACH ROW
BEGIN

	DECLARE data_c DATETIME;
    DECLARE nome VARCHAR(255);
    DECLARE cognome VARCHAR(255);
    DECLARE codice_fiscale VARCHAR(255);
    DECLARE indirizzo VARCHAR(255);
    DECLARE comune VARCHAR(255);
    DECLARE provincia VARCHAR(255);
    DECLARE nome_area VARCHAR(255);
    DECLARE n_stanza VARCHAR(255);
    DECLARE id_dipendente VARCHAR(255);
    
    SELECT data_convocazione
      INTO data_c
      FROM carico_lavoro
	WHERE id_richiesta=NEW.id
	;
    
    SET nome=NEW.nome;
    SET cognome=NEW.cognome;
    SET codice_fiscale=NEW.codice_fiscale;
    SET indirizzo=NEW.indirizzo_residenza;
    SET comune=NEW.comune;
    SET provincia=NEW.provincia;
    
    SELECT carico_lavoro.id_dipendente
      INTO id_dipendente
      FROM carico_lavoro
	WHERE id_richiesta=NEW.id
    ;
    
    SELECT utente.nome_area
		  ,utente.n_stanza
	  INTO nome_area
		  ,n_stanza
	  FROM utente
	WHERE utente.id=id_dipendente
    ;
    
    INSERT INTO notifica (id_cliente,nome,cognome,codice_fiscale
		,indirizzo_residenza,comune,provincia
        ,data_convocazione,area,n_stanza,id_richiesta)
	  VALUES (NEW.id_cliente,nome,cognome,codice_fiscale
        ,indirizzo,comune,provincia
        ,data_c,nome_area,n_stanza,NEW.id);

END