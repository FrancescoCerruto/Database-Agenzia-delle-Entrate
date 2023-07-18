<?php
require_once('config.php');
?>
<?php 

	session_start();

	if(!isset($_SESSION['userlogin'])){
		header("Location: login.php");
	}

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION);
		header("Location: login.php");
	}

	// echo . $_SESSION['userlogin'];
	/*$sql = "SELECT * FROM notifica WHERE codice_fiscale = ?"; 
	$stmselect = $db->prepare($sql);
	$result = $stmselect->execute([$cf]);
	if ($result)
	{
		echo 'Hai delle notifiche';
	}
	else
	{
		echo 'Non hai nessuna notifica';
	}*/
?>

<p>Benvenuto nell'Area personale</p>





<a href="index.php?logout=true">Logout</a>