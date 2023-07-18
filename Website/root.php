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

    <!--tabella impiegati-->
    <div class="container">
        <div class="row">

            <div class="col-12">
                <span><h3 style="display: inline-block; margin-right:5%;">Impiegati</h3><button id="aggiorna_impiegati" type="button" class="btn btn-primary">Aggiorna</button></span>

                <table class="table table-striped" id="impiegati">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Codice fiscale</th>
                            <th>Ufficio dipendente</th>
                            <th>Regione Sede</th>
                            <th>Provincia Sede</th>
                            <th>Comune Sede</th>
                            <th>Nome Area</th>
                            <th>Nome Servizio</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Codice fiscale</th>
                            <th>Ufficio dipendente</th>
                            <th>Regione Sede</th>
                            <th>Provincia Sede</th>
                            <th>Comune Sede</th>
                            <th>Nome Area</th>
                            <th>Nome Servizio</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        <div class="row"></div>
    </div>

    <!--tabella clienti-->
    <div class="container">
        <div class="row">

            <div class="col-12">
                <span><h3 style="display: inline-block; margin-right:5%; margin-top:5%">Clienti</h3><button id="aggiorna_clienti" type="button" class="btn btn-primary">Aggiorna</button></span>

                <table class="table table-striped" id="clienti">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Codice fiscale</th>
                            <th>Tipo utente</th>
                            <th>Delegante</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Codice fiscale</th>
                            <th>Tipo utente</th>
                            <th>Delegante</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        <div class="row"></div>
    </div>

    <!--tabella carico lavoro-->
    <div class="container">
        <div class="row">

            <div class="col-12">
                <span><h3 style="display: inline-block; margin-right:5%; margin-top:5%">Carico di lavoro</h3><button id="aggiorna_carico" type="button" class="btn btn-primary">Aggiorna</button></span>

                <table class="table table-striped" id="carico">
                    <thead>
                        <tr>
                            <th>Regione Sede</th>
                            <th>Provincia Sede</th>
                            <th>Comune Sede</th>
                            <th>Nome Area</th>
                            <th>Nome Servizio</th>
                            <th>Data convocazione</th>
                            <th>Codice fiscale Cliente</th>
                            <th>Codice fiscale Impiegato</th>
                            <th>ID Richiesta</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>Regione Sede</th>
                            <th>Provincia Sede</th>
                            <th>Comune Sede</th>
                            <th>Nome Area</th>
                            <th>Nome Servizio</th>
                            <th>Data convocazione</th>
                            <th>Codice fiscale Cliente</th>
                            <th>Codice fiscale Impiegato</th>
                            <th>ID Richiesta</th>
                        </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        <div class="row"></div>
    </div>

    <button id="logout" type="button" class="btn btn-primary" >Logout</button>
    <button id="eta" type="button" class="btn btn-primary" >Calcola eta media</button>
    <button id="n_ric_sede" type="button" class="btn btn-primary" >Calcola numero richieste per sede</button>
    <button id="n_ric_utente" type="button" class="btn btn-primary" >Calcola numero richieste per utente</button>
    <button id="s_ric_utente" type="button" class="btn btn-primary" >Stampa notifiche per utente</button>

    <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/root.js"></script>
    <script type="text/javascript" language="javascript" src="js/bootstrap.min.js"></script>
</body>
</html>