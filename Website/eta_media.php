<?php
	session_start();
	require_once('config.php');


	$sql = "SELECT AVG(YEAR(CURRENT_DATE())-YEAR(data_nascita)) AS eta_media FROM utente WHERE tipo='Cittadino' AND EXISTS ( SELECT * FROM richiesta WHERE utente.id=richiesta.id_cliente );";
	$stmtselect  = $db->prepare($sql);
	$result = $stmtselect->execute([]);

	if($result)
	{
		$eta_cittadino = $stmtselect->fetch(PDO::FETCH_ASSOC);
		$eta_cittadino = $eta_cittadino['eta_media'];
		$sql = "SELECT AVG(YEAR(CURRENT_DATE())-YEAR(data_nascita)) AS eta_media FROM utente WHERE tipo='Ente' AND EXISTS ( SELECT * FROM richiesta WHERE utente.id=richiesta.id_cliente );";
		$stmtselect  = $db->prepare($sql);
		$result = $stmtselect->execute([]);
		if ($result)
		{
			$eta_ente = $stmtselect->fetch(PDO::FETCH_ASSOC);
			$eta_ente = $eta_ente['eta_media'];
			echo 'Eta media cliente: '.$eta_cittadino.", eta media ente: ".$eta_ente.'.';
		}
	}
?>