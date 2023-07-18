<?php

	require_once('config.php');
	
	session_start();
	
    if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }
	
	$cf = $_SESSION["userlogin"];
	
	//prendo il numero di notifiche
	$sql = "SELECT COUNT(*) AS num_notifiche FROM notifica WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([$cf]);
	$num_rows = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$num_rows = $num_rows['num_notifiche'];

    //prendo tutte le notifiche dell'utente loggato
	$sql = "SELECT * FROM notifica WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([$cf]);
	$record = $stmtselect->fetchAll();
	
	$notifiche = array();
	
    foreach($record as $row){

        $notifiche[] = array(
            'ID Richiesta' => $row["id_richiesta"],
            'Data convocazione' => $row["data_convocazione"],
            'Area' => $row["area"],
            'Ufficio dipendete' => $row["n_stanza"],
        );
    }
	
    $json_data = array(
		"draw" => 1,
		"iTotalRecords" => $num_rows,
		"data" => $notifiche
    );
    echo json_encode($json_data);

?>