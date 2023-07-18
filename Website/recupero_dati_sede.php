<?php
	
	require_once('config.php');
	
    session_start();

	$sql = "SELECT * FROM sede";
	$stmtselect  = $db->prepare($sql);
	$stmtselect->execute();
	$record = $stmtselect->fetchAll();
    $res = array();
	
	foreach($record as $row){
		
		$res[] = array(
			'Regione' => $row["regione"],
			'Provincia' => $row["provincia"],
			'Comune' => $row["comune"],
		);
	}

    print_r(json_encode($res));
?>