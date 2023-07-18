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

    //include("db.php");
    $num_table_rows = 0;

    $conn = mysqli_connect("localhost","root","","agenzia_entrate_2") or die(mysqli_error($conn));

    //prendo tutti i lavori dell'utente loggato
    $result = mysqli_query($conn, "SELECT carico_lavoro.data_convocazione, utente.codice_fiscale, carico_lavoro.id_richiesta FROM carico_lavoro JOIN utente ON carico_lavoro.id_cliente = utente.id WHERE id_dipendente = '".$id."';") or die(mysqli_error($conn));
	
    $num_rows = mysqli_num_rows($result);

    $lavoro = array();

    for($i = 0; $i < $num_rows; $i++){

		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $lavoro[] = array(
            'Data convocazione' => $row["data_convocazione"],
            'Codice fiscale Cliente' => $row["codice_fiscale"],
            'ID Richiesta' => $row["id_richiesta"],
        );
        $num_table_rows++;
    }

    mysqli_close($conn);

    $json_data = array(
        "draw"            => 1,
        "recordsTotal"    => $num_table_rows,
        "recordsFiltered" => $num_table_rows,
        "data"            => $lavoro
    );
    echo(json_encode($json_data));

?>