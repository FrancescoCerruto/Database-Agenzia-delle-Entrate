<?php
	require_once('config.php');
	session_start();

	if(!isset($_SESSION['userlogin']))
	{
		header("Location: login.html");
	}
		
	$cf = $_POST['cf'];
	
	$sql = "SELECT count(*) AS conta FROM richiesta WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$conta_6 = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$conta_6 = $conta_6['conta'];
	$sql = "SELECT * FROM richiesta WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$result = $stmtselect->fetch(PDO::FETCH_ASSOC);
	
	echo "Nome utente: ".$result['nome'];
	echo "\nCognome utente: ".$result['cognome'];
	echo "\nCodice fiscale utente: ".$cf;
	echo "\nIndirizzo di residenza utente: ".$result['indirizzo_residenza'];
	echo "\nComune di residenza utente: ".$result['comune'];
	echo "\nProvincia di residenza utente: ".$result['provincia'];
	echo "\nNumero richieste: ".$conta_6;
			
?>