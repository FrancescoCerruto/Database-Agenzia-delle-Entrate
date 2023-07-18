<?php

	require_once('config.php');
	
	session_start();
	
    /*if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }
	
	$cf = $_SESSION["userlogin"];*/
	
	//prendo il numero di utenti
	$sql = "SELECT COUNT(*) AS num_utenti FROM utente WHERE tipo = 'Impiegato'";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$num_rows = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$num_rows = $num_rows['num_utenti'];

	$sql = "DROP VIEW IF EXISTS VV";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$sql = "CREATE VIEW VV AS (SELECT id, nome AS nome_s FROM servizio)";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);

	//prendo tutti gli utenti impiegati
	$sql = "SELECT utente.nome, utente.cognome, utente.codice_fiscale, utente.n_stanza, sede.regione, sede.provincia, sede.comune, utente.nome_area, VV.nome_s FROM (utente JOIN sede ON utente.id_sede_area = sede.id) JOIN VV ON utente.id_servizio = vv.id WHERE tipo = 'Impiegato' ";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute();
	$record = $stmtselect->fetchAll();
	
	$utenti = array();
	
    foreach($record as $row){

        $utenti[] = array(
            'Nome' => $row["nome"],
            'Cognome' => $row["cognome"],
            'Codice fiscale' => $row["codice_fiscale"],
            'Ufficio dipendente' => $row["n_stanza"],
            'Regione Sede' => $row["regione"],
            'Provincia Sede' => $row["provincia"],
            'Comune Sede' => $row["comune"],
            'Nome Area' => $row["nome_area"],
            'Nome Servizio' => $row["nome_s"],
        );
    }
	
	//cancella viste
	$sql = "DROP VIEW VV";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);

    $json_data = array(
		"draw" => 1,
		"iTotalRecords" => $num_rows,
		"data" => $utenti
    );
    echo json_encode($json_data);

?>