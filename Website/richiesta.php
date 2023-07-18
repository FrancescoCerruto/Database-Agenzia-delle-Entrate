<?php
	require_once('config.php');
	session_start();

	if(!isset($_SESSION['userlogin']))
	{
		header("Location: login.html");
	}
	
	$cf = $_SESSION['userlogin'];

	$sql = "SELECT id FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$id = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$id=$id['id'];

	$sql = "SELECT tipo FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$tipo = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$tipo=$tipo['tipo'];
	
	$sql = "SELECT nome FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$nome = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$nome=$nome['nome'];

	$sql = "SELECT cognome FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$cognome = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$cognome=$cognome['cognome'];

	$sql = "SELECT indirizzo_residenza FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$indirizzo = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$indirizzo=$indirizzo['indirizzo_residenza'];

	$sql = "SELECT comune FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$comune = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$comune=$comune['comune'];

	$sql = "SELECT provincia FROM utente WHERE codice_fiscale = ?";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([$cf]);
	$provincia = $stmtselect->fetch(PDO::FETCH_ASSOC);
	$provincia=$provincia['provincia'];

	$servizio_richiesto = $_POST['nome_servizio'];
	$regione_sede 		= $_POST['regione_sede'];
	$provincia_sede		= $_POST['provincia_sede'];

	if (empty($_POST['comune_sede']))
	{
		$sql = "SELECT id FROM sede WHERE regione = ? AND provincia = ? AND comune IS NULL";
		$stmtselect  = $db->prepare($sql);
		$result = $stmtselect->execute([$regione_sede, $provincia_sede]);
	}
	else
	{
		$comune_sede = $_POST['comune_sede'];
		$sql = "SELECT id FROM sede WHERE regione = ? AND provincia = ? AND comune = ?";
		$stmtselect  = $db->prepare($sql);
		$result = $stmtselect->execute([$regione_sede, $provincia_sede, $comune_sede]);
	}		

	if($result)
	{
		$id_sede = $stmtselect->fetch(PDO::FETCH_ASSOC);
		$id_sede = $id_sede['id'];
		if($stmtselect->rowCount() > 0)
		{
			$sql = "SELECT id FROM servizio WHERE nome = ?";
			$stmtselect  = $db->prepare($sql);
			$result = $stmtselect->execute([$servizio_richiesto]);
			if ($result)
			{
				$id_servizio = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$id_servizio = $id_servizio['id'];
				if (!isset($_POST['comune_sede']))
				{
					$sql = "INSERT INTO richiesta (data_ricezione, id_cliente, tipo_cliente, nome, cognome, codice_fiscale, indirizzo_residenza, comune, provincia, id_sede, regione_sede, provincia_sede, id_servizio, servizio_richiesto) VALUES(CURDATE(),?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
					$stmtinsert = $db->prepare($sql);
					$result = $stmtinsert->execute([
						$id, 
						$tipo, 
						$nome, 
						$cognome, 
						$cf, 
						$indirizzo, 
						$comune, 
						$provincia, 
						$id_sede, 
						$regione_sede, 
						$provincia_sede, 
						$id_servizio, 
						$servizio_richiesto
					]);
				}
				else
				{
					$sql = "INSERT INTO richiesta (data_ricezione, id_cliente, tipo_cliente, nome, cognome, codice_fiscale, indirizzo_residenza, comune, provincia, id_sede, regione_sede, provincia_sede, comune_sede, id_servizio, servizio_richiesto) VALUES(CURDATE(),?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
					$stmtinsert = $db->prepare($sql);
					$result = $stmtinsert->execute([$id, $tipo, $nome, $cognome, $cf, $indirizzo, $comune, $provincia, $id_sede, $regione_sede, $provincia_sede, $_POST['comune_sede'], $id_servizio, $servizio_richiesto]);
				}
				if ($result)
				{
					echo $db->lastInsertId();
				}
				else
				{
					echo 'Inserimento non riuscito.';
				}
			}
			else
			{
				echo 'Impossibile connettersi al database.';
			}
		}
		else
		{
			echo 'Sede non esistente.';		
		}
	}
	else
	{
		echo 'Impossibile connettersi al database.';
	}
	
?>