<?php
	require_once('config.php');
	session_start();

	if(!isset($_SESSION['userlogin']))
	{
		header("Location: login.html");
	}
	
	$regione_sede = $_POST['pippo'];
	$provincia_sede = $_POST['provincia'];
	
	if (empty($_POST['comune']))
	{
		$sql = "SELECT id FROM sede WHERE regione = ? AND provincia = ? AND comune IS NULL";
		$stmtselect  = $db->prepare($sql);
		$result = $stmtselect->execute([$regione_sede, $provincia_sede]);
		if ($result)
		{
			$id_sede = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$id_sede = $id_sede['id'];
			if($stmtselect->rowCount() > 0)
			{
				/*servizio 1*/
				$sql = "SELECT count(*) as conta FROM richiesta WHERE id_sede = ? and id_servizio = 1";
				$stmtselect  = $db->prepare($sql);
				$stmtselect->execute([$id_sede]);
				$conta_1 = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$conta_1 = $conta_1['conta'];
				
				/*servizio 2*/
				$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 2";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$id_sede]);
				$conta_2 = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$conta_2 = $conta_2['conta'];
				/*servizio 3*/
				$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 3";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$id_sede]);
				$conta_3 = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$conta_3 = $conta_3['conta'];
				/*servizio 4*/
				$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 4";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$id_sede]);
				$conta_4 = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$conta_4 = $conta_4['conta'];
				/*servizio 5*/
				$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 5";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$id_sede]);
				$conta_5 = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$conta_5 = $conta_5['conta'];
				/*servizio 6*/
				$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 6";
				$stmtselect  = $db->prepare($sql);
				$result = $stmtselect->execute([$id_sede]);
				$conta_6 = $stmtselect->fetch(PDO::FETCH_ASSOC);
				$conta_6 = $conta_6['conta'];
				
				echo "Numero richieste servizio Agevolazioni: ".$conta_1;
				echo "\nNumero richieste servizio Dichiarazioni: ".$conta_2;
				echo "\nNumero richieste servizio Pagamenti e rimborsi: ".$conta_3;
				echo "\nNumero richieste servizio Fabbricati e terreni: ".$conta_4;
				echo "\nNumero richieste servizio Accertamenti e regolarizzazioni: ".$conta_5;
				echo "\nNumero richieste servizio Istanze e comunicazioni: ".$conta_6;
	
			}
		}
	}
	else
	{
		$comune_sede = $_POST['comune'];
		$sql = "SELECT * FROM sede WHERE regione = ? AND provincia = ? AND comune = ?";
		$stmtselect  = $db->prepare($sql);
		$stmtselect->execute([$regione_sede, $provincia_sede, $comune_sede]);
		$id_sede = $stmtselect->fetch(PDO::FETCH_ASSOC);
		$id_sede = $id_sede['id'];
			
		if($stmtselect->rowCount() > 0)
		{
			/*servizio 1*/
			$sql = "SELECT count(*) as conta FROM richiesta WHERE id_sede = ? and id_servizio = 1";
			$stmtselect  = $db->prepare($sql);
			$stmtselect->execute([$id_sede]);
			$conta_1 = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$conta_1 = $conta_1['conta'];
			
			/*servizio 2*/
			$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 2";
			$stmtselect  = $db->prepare($sql);
			$result = $stmtselect->execute([$id_sede]);
			$conta_2 = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$conta_2 = $conta_2['conta'];
			/*servizio 3*/
			$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 3";
			$stmtselect  = $db->prepare($sql);
			$result = $stmtselect->execute([$id_sede]);
			$conta_3 = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$conta_3 = $conta_3['conta'];
			/*servizio 4*/
			$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 4";
			$stmtselect  = $db->prepare($sql);
			$result = $stmtselect->execute([$id_sede]);
			$conta_4 = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$conta_4 = $conta_4['conta'];
			/*servizio 5*/
			$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 5";
			$stmtselect  = $db->prepare($sql);
			$result = $stmtselect->execute([$id_sede]);
			$conta_5 = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$conta_5 = $conta_5['conta'];
			/*servizio 6*/
			$sql = "SELECT count(*) AS conta FROM richiesta WHERE id_sede = ? and id_servizio = 6";
			$stmtselect  = $db->prepare($sql);
			$result = $stmtselect->execute([$id_sede]);
			$conta_6 = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$conta_6 = $conta_6['conta'];
			
			echo "Numero richieste servizio Agevolazioni: ".$conta_1;
			echo "\nNumero richieste servizio Dichiarazioni: ".$conta_2;
			echo "\nNumero richieste servizio Pagamenti e rimborsi: ".$conta_3;
			echo "\nNumero richieste servizio Fabbricati e terreni: ".$conta_4;
			echo "\nNumero richieste servizio Accertamenti e regolarizzazioni: ".$conta_5;
			echo "\nNumero richieste servizio Istanze e comunicazioni: ".$conta_6;
		}
	}
	
?>