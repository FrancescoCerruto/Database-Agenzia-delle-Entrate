<?php
	
	require_once('config.php');
	
    session_start();

	$sql = "SELECT * FROM utente where tipo!='Impiegato";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute();
	$record = $stmtselect->fetchAll();
    $res = array();
	
	foreach($record as $row){
		
		$res[] = array(
			'Cf' => $row["regione"],
		);
	}

    print_r(json_encode($res));
?>