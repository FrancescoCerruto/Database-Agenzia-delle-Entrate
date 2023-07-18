<?php
	session_start();
    if(!isset($_SESSION["userlogin"])) 
    {
        header("Location: login.html");
    }

    //include("db.php");
    $num_table_rows = 0;

    $conn = mysqli_connect("localhost","root","","agenzia_entrate_2") or die(mysqli_error($conn));

    //prendo tutte le notifiche dell'utente loggato
    $result = mysqli_query($conn, "SELECT * from notifica where codice_fiscale = '".$_SESSION["userlogin"]."';") or die(mysqli_error($conn));
   
    $num_rows = mysqli_num_rows($result);

    $notifiche = array();

    for($i = 0; $i < $num_rows; $i++){

		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $notifiche[] = array(
            'ID Richiesta' => $row["id_richiesta"],
            'Data convocazione' => $row["data_convocazione"],
            'Area' => $row["area"],
            'Ufficio dipendete' => $row["n_stanza"],
        );
        $num_table_rows++;
    }

    mysqli_close($conn);

    $json_data = array(
        "draw"            => 1,
        "recordsTotal"    => $num_table_rows,
        "recordsFiltered" => $num_table_rows,
        "data"            => $notifiche
    );
    echo(json_encode($json_data));

?>