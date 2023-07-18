INSERT INTO richiesta (data_ricezione,tipo_cliente
	,nome,cognome,codice_fiscale,indirizzo_residenza,comune
    ,provincia,regione_sede,provincia_sede,comune_sede
    ,servizio_richiesto)
VALUES (CURRENT_DATE(),"Cittadino"
	,"Francesco","Cerruto","CRRFNC00S11F943E"
    ,"Via Carlo Alberto dalla Chiesa 14","Belpasso"
    ,"Catania","Sicilia","Catania",NULL
    ,"Agevolazioni");