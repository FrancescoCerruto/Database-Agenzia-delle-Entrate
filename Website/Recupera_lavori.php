<?php
	require_once('config.php');
	session_start();
    if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }

    $cf = $_SESSION["userlogin"];

    $sql = "SELECT id FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$id = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$id=$id['id'];
	
	//prendo il numero di lavori
	$sql = "SELECT COUNT(*) AS num_lavori FROM carico_lavoro WHERE id_dipendente = ?";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([$id]);
	$num_rows = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$num_rows = $num_rows['num_lavori'];
	
	//prendo tutti i lavori
	$sql = "SELECT carico_lavoro.data_convocazione, utente.codice_fiscale, carico_lavoro.id_richiesta FROM carico_lavoro JOIN utente ON carico_lavoro.id_cliente = utente.id WHERE id_dipendente = ?";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([$id]);
	$record = $stmtselect->fetchAll();
    $lavoro = array();

    foreach($record as $row){

        $lavoro[] = array(
            'Data convocazione' => $row["data_convocazione"],
            'Codice fiscale Cliente' => $row["codice_fiscale"],
            'ID Richiesta' => $row["id_richiesta"],
        );
    }

   $json_data = array(
		"draw" => 1,
		"iTotalRecords" => $num_rows,
		"data" => $lavoro
    );
    echo json_encode($json_data);

?>