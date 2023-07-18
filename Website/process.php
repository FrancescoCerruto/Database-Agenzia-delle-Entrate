<?php
require_once('config.php');
?>
<?php
	session_start();

	if(isset($_POST)){

		$nome 			= $_POST['nome'];
		$cognome 		= $_POST['cognome'];
		$codiceFiscale	= $_POST['codiceFiscale'];
		$data_nascita	= $_POST['dataNascita'];
		$indirizzo		= $_POST['indirizzo'];
		$comune			= $_POST['comune'];
		$provincia		= $_POST['provincia'];
		$password 		= $_POST['password'];
		$tipoUtente		= $_POST['tipoUtente'];

		if ($tipoUtente == 'Ente')
		{
			$delegante	 = $_POST['delegante'];
		}
		else if ($tipoUtente == 'Impiegato')
		{
			$numStanza 		= $_POST['numStanza'];
			$regioneSede	= $_POST['regioneSede'];
			$provinciaSede	= $_POST['provinciaSede'];
			$comuneSede		= $_POST['comuneSede'];
			$nomeArea 		= $_POST['area'];
			$nomeServizio	= $_POST['nomeServizio'];
		}	

		echo($tipoUtente);
		
		if($tipoUtente == 'Cittadino') {

			$sql = "INSERT INTO utente (nome, cognome, codice_fiscale, data_nascita, indirizzo_residenza, comune, provincia, password, tipo) VALUES(?,?,?,?,?,?,?,?,?)"; 
			$stmtinsert = $db->prepare($sql);
			$result = $stmtinsert->execute([$nome, $cognome, $codiceFiscale, $data_nascita, $indirizzo, $comune, $provincia, $password, $tipoUtente]);

			if ($result)
			{
				echo 'Inserimento riuscito.';
				$_SESSION['userlogin'] = $codiceFiscale;
				$res = "Your request has been accepted";
				echo(json_encode($res));
			}
			else
			{
				echo 'Inserimento non riuscito.';
			}
		}
		else if($tipoUtente == 'Ente') {

			echo 'Sono un ente.';
			$sql = "INSERT INTO utente (nome, cognome, codice_fiscale, data_nascita, indirizzo_residenza, comune, provincia, password, tipo, delegante) VALUES(?,?,?,?,?,?,?,?,?,?)"; 
			$stmtinsert = $db->prepare($sql);
			$result = $stmtinsert->execute([$nome, $cognome, $codiceFiscale, $data_nascita, $indirizzo, $comune, $provincia, $password, $tipoUtente, $delegante]);
			
			if ($result)
			{
				echo 'Inserimento riuscito.';
				$_SESSION['userlogin'] = $codiceFiscale;
				$res = "Your request has been accepted";
				echo(json_encode($res));
			}
			else
			{
				echo 'Inserimento non riuscito.';
			}
		}
		else {
			
			if (empty($comuneSede)) {
				$sql = "SELECT id FROM sede WHERE regione = ? AND provincia = ? AND comune IS NULL";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$regioneSede, $provinciaSede]);
			}
			else
			{
				$sql = "SELECT id FROM sede WHERE regione = ? AND provincia = ? AND comune = ?";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$regioneSede, $provinciaSede, $comuneSede]);
			}		

			if($result){
				$id_sede = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$id_sede = $id_sede["id"];
				if($stmtselect->rowCount() > 0)
				{
					$sql = "SELECT id FROM servizio WHERE nome = ?";
					$stmtselect  = $db->prepare($sql);
					$result = $stmtselect->execute([$nomeServizio]);
					if ($result)
					{
						$id_servizio = $stmtselect->fetch(PDO::FETCH_ASSOC);
						$id_servizio = $id_servizio["id"];
						$sql = "INSERT INTO utente (nome, cognome, codice_fiscale, data_nascita, indirizzo_residenza, comune, provincia, password, tipo, n_stanza, id_sede_area, nome_area, id_servizio) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)"; 
						$stmtinsert = $db->prepare($sql);
						$result = $stmtinsert->execute([$nome, $cognome, $codiceFiscale, $data_nascita, $indirizzo, $comune, $provincia, $password, $tipoUtente, $numStanza, $id_sede, $nomeArea, $id_servizio]);

						if ($result)
						{
							echo 'Inserimento riuscito.';
							$_SESSION['userlogin'] = $codiceFiscale;
							$res = "Your request has been accepted";
							echo(json_encode($res));
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
		}
		
	}
	else
	{
		echo 'Dati non presenti.';
	}

?>