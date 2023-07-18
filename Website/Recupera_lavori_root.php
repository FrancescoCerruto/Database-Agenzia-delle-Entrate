<?php
	require_once('config.php');
	session_start();
    if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }
	
	//prendo il numero di lavori
	$sql = "SELECT COUNT(*) AS num_lavori FROM carico_lavoro";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$num_rows = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$num_rows = $num_rows['num_lavori'];

	//prendo i dati dell'impiegato
	$sql = "DROP VIEW IF EXISTS VV";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$sql = "CREATE VIEW VV AS (SELECT carico_lavoro.id, carico_lavoro.data_convocazione AS dc, utente.codice_fiscale AS cf, sede.regione AS r, sede.provincia AS p, sede.comune AS c, utente.nome_area AS na, servizio.nome AS n FROM ((carico_lavoro JOIN utente ON carico_lavoro.id_dipendente = utente.id) JOIN sede ON utente.id_sede_area = sede.id) JOIN servizio on utente.id_servizio = servizio.id)";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);

	//prendo i dati del cliente
	$sql = "DROP VIEW IF EXISTS VA";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$sql = "CREATE VIEW VA AS (SELECT carico_lavoro.id, utente.codice_fiscale AS cfc, richiesta.id AS rc FROM (carico_lavoro JOIN utente ON carico_lavoro.id_cliente = utente.id) JOIN richiesta ON richiesta.id_cliente = utente.id)";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	
	//prendo tutti i dati del lavoro
	$sql = "SELECT * FROM VV JOIN VA ON VV.id = VA.id";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);
	$record_lavori = $stmtselect->fetchAll();
    $lavori = array();

    foreach($record_lavori as $row){

        $lavori[] = array(
            'Regione Sede' => $row["r"],
            'Provincia Sede' => $row["p"],
            'Comune Sede' => $row["c"],
            'Nome Area' => $row["na"],
            'Nome Servizio' => $row["n"],
            'Data convocazione' => $row["dc"],
            'Codice fiscale Cliente' => $row["cfc"],
            'Codice fiscale Impiegato' => $row["cf"],
			'ID Richiesta' => $row["rc"],
        );
    }

	//cancella viste
	$sql = "DROP VIEW VA, VV";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute([]);

   $json_data = array(
		"draw" => 1,
		"iTotalRecords" => $num_rows,
		"data" => $lavori
    );

    echo json_encode($json_data);

?>