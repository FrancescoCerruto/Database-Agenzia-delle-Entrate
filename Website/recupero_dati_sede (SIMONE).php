<?php

    session_start();
    /*if(!isset($_SESSION["userlogin"])){
        echo("Errore: non hai il permesso per visualizzare questa pagina");
        exit;
    }*/

    $link = mysqli_connect("localhost","root","","agenzia_entrate_2") or die(mysqli_error($link));

    $query = "select * from sede";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));
    
    
	
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$res[] = array(
			'Regione' => $row["regione"],
			'Provincia' => $row["provincia"],
			'Comune' => $row["comune"],
		);
	}

    
	
	mysqli_close($link);

    print_r(json_encode($res));
?>