<?php
	session_start();
	require_once('config.php');


	$username = $_POST['username'];
	$password = $_POST['password'];

	if ($username == "AMMINISTRATORE" && $password == "root") {
		$_SESSION['userlogin'] = $username;
		echo 'AMMINISTRATORE';
	}
	else {
		$sql = "SELECT * FROM utente WHERE codice_fiscale = ? AND password = ? LIMIT 1";
		$stmtselect  = $db->prepare($sql);
		$result = $stmtselect->execute([$username, $password]);

		if($result)
		{
			$user = $stmtselect->fetch(PDO::FETCH_ASSOC);
			if($stmtselect->rowCount() > 0)
			{
				$_SESSION['userlogin'] = $username;
				$sql = "SELECT tipo FROM utente WHERE codice_fiscale = ? AND password = ? LIMIT 1";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$username, $password]);
				$tipo = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$tipo = $tipo['tipo'];
				echo '1 '.$tipo;
			}
			else
			{
				echo 'Utente inesistente. Registrati.';	
			}
		}
	}
?>