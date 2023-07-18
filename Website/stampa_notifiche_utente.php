<?php

	require_once('config.php');
	
	session_start();
	
    if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }
	
	$cf = $_POST["cf"];
	
	//prendo il numero di notifiche
	$sql = "SELECT COUNT(*) AS n FROM notifica WHERE codice_fiscale  = ?";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([$cf]);
	$num_rows = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$num_rows = $num_rows['n'];

    //prendo tutte le notifiche di tizio
	$sql = "SELECT * FROM notifica WHERE codice_fiscale  = ? ";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([$cf]);
	$record = $stmtselect->fetchAll();
	
	foreach($record as $row){

        echo "\nId notifica: ".$row["id"];
        echo "\nId cliente: " .$row["id_cliente"];
        echo "\nNome: " .$row["nome"];
        echo "\nCognome: " .$row["cognome"];
        echo "\nCodice fiscale: " .$row["codice_fiscale"];
        echo "\nIndirizzo residenza: " .$row["indirizzo_residenza"];
        echo "\nComune residenza: " .$row["comune"];
        echo "\nProvincia residenza: ".$row["provincia"];
        echo "\nData convocazione: ".$row["data_convocazione"];
        echo "\nArea: ".$row["area"];
        echo "\nUfficio dipendente: ".$row["n_stanza"];
        echo "\nId richiesta: ".$row["id_richiesta"];
        echo "\n\n\n";
    }
	
?>