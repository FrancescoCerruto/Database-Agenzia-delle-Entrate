<?php
	require_once('config.php');
	session_start();

	if(!isset($_SESSION['userlogin'])){
		header("Location: login.html");
	}

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION);
		echo '1';
	}
?>
<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" crossorigin="anonymous">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="css/jquery.steps.css">
	<link href="css/Stile.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        
</head>
<body>
	<form action="calcola_richieste_utente.php" method="post" id="form_richiesta">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<h1>Richiesta</h1>
					<hr class="mb-3">
					<div class="input-container">
						<i class="fa fa-user icon"></i>
						<select class="form-control" id="cf" name="cf" required>
							<option value="" disabled selected hidden>Seleziona il codice fiscale</option>
						</select>
					</div>

					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="request" value="Request">
					<button id="logout" type="button" class="btn btn-primary" >Torna indietro</button>
				</div>
			</div>
		</div>
	</form>

	<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/richieste_utente.js"></script>
	<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
</body>
</html>