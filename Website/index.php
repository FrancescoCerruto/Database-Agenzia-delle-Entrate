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
	<div class="container">
		<div class="row">
		
			<div class="col-12">
				<span><h3 style="display: inline-block; margin-right:5%;">Notifiche</h3><button id="aggiorna" type="button" class="btn btn-primary" >Aggiorna</button></span>
				
				<table class = "table table-striped" id="notifiche">
                    <thead>
                        <tr>
                            <th>ID Richiesta</th>
                            <th>Data convocazione</th>
                            <th>Area</th>
                            <th>Ufficio dipendete</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                           <th>ID Richiesta</th>
                            <th>Data convocazione</th>
                            <th>Area</th>
                            <th>Ufficio dipendete</th>
                        </tr>
                    </tfoot>
                </table>

			</div>

		</div>

		<div class="row"></div>
	</div>
	
	<form action="richiesta.php" method="post" id="form_richiesta">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<h1>Richiesta</h1>
					<hr class="mb-3">
					<div class="input-container">
						<i class="fa fa-building icon"></i>
						<select class="form-control" id="regione_sede" name="regione_sede" required>
							<option value="" disabled selected hidden>Seleziona la regione della sede</option>
						</select>
					</div>

					<div class="input-container">
						<i class="fa fa-building icon"></i>
						<select class="form-control" id="provincia_sede" name="provincia_sede" required>
							<option value="" disabled selected hidden>Seleziona la provincia della sede</option>
						</select>
					</div>

					<div class="input-container">
						<i class="fa fa-building icon"></i>
						<select class="form-control" id="comune_sede" name="comune_sede">
							<option value="" disabled selected hidden>Seleziona il comune della sede</option>
						</select>
					</div>

					<div class="input-container">
						<i class="fa fa-building icon"></i>
						<select class="form-control" id="nome_servizio" name="nome_servizio" required>
							<option value="" disabled selected hidden>Seleziona il servizio</option>
							<option value="Agevolazioni">Agevolazioni</option>
							<option value="Dichiarazioni">Dichiarazioni</option>
							<option value="Pagamenti e rimborsi">Pagamenti e rimborsi</option>
							<option value="Fabbricati e terreni">Fabbricati e terreni</option>
							<option value="Accertamenti e regolarizzazioni">Accertamenti e regolarizzazioni</option>
							<option value="Istanze e comunicazioni">Istanze e comunicazioni</option>
						</select>
					</div>

					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" id="request" name="create" value="Request">

					<button id="logout" type="button" class="btn btn-primary" >Logout</button>
				</div>
			</div>
		</div>
	</form>

	<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">INSERIMENTO RICHIESTA</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p id="modal_body"></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary close" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

	<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/richiesta.js"></script>
	<script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
</body>
</html>