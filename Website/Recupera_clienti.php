<?php

	require_once('config.php');
	
	session_start();
	
    /*if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }
	
	$cf = $_SESSION["userlogin"];*/
	
	//prendo il numero di clienti
	$sql = "SELECT COUNT(*) AS num_utenti FROM utente WHERE tipo != 'Impiegato'";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$num_rows = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$num_rows = $num_rows['num_utenti'];

    //prendo tutti gli utenti impiegati
	$sql = "SELECT * FROM utente WHERE tipo != 'Impiegato' ";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute();
	$record = $stmtselect->fetchAll();
	
	$utenti = array();
	
    foreach($record as $row){

        $utenti[] = array(
            'Nome' => $row["nome"],
            'Cognome' => $row["cognome"],
            'Codice fiscale' => $row["codice_fiscale"],
            'Tipo utente' => $row["tipo"],
            'Delegante' => $row["delegante"],
        );
    }
	
    $json_data = array(
		"draw" => 1,
		"iTotalRecords" => $num_rows,
		"data" => $utenti
    );
    echo json_encode($json_data);

?>