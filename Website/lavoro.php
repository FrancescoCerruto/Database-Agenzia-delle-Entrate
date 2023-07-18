<?php
	require_once('config.php');
	session_start();

	if(!isset($_SESSION['userlogin'])){
		header("Location: login.html");
	}

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION);
		header("Location: login.html");
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
	
	<div class="container">
		<div class="row">
		
			<div class="col-12">
				<span><h3 style="display: inline-block; margin-right:5%;">Richieste assegnate</h3><button id="aggiorna" type="button" class="btn btn-primary" >Aggiorna</button></span>
				
				<table class = "table table-striped" id="lavoro">
                    <thead>
                        <tr>
                            <th>Data convocazione</th>
                            <th>Codice fiscale Cliente</th>
                            <th>ID Richiesta</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Data convocazione</th>
                            <th>Codice fiscale Cliente</th>
                            <th>ID Richiesta</th>
                        </tr>
                    </tfoot>
                </table>

			</div>

		</div>

		<div class="row"></div>
	</div>
	
	<button id="logout" type="button" class="btn btn-primary" >Logout</button>

	<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/lavoro.js"></script>
	<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
</body>
</html>