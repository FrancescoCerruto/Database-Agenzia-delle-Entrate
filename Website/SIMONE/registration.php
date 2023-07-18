<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.steps.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.steps.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/sign_up.js"></script>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" crossorigin="anonymous">
        <link href = "css/bootstrap.min.css" rel = "stylesheet" media = "screen">
        <link rel="stylesheet" type="text/css" href="css/jquery.steps.css">
        <link href = "css/Stile.css" rel = "stylesheet" media = "screen">
</head>

    <body>
        <div id="sign_up">

            <h3>Dati utente</h3>

            <section>
                <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <input id="nome" type="textarea" class="form-control" placeholder="Inserisci il nome">
                </div>

                <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <input id="cognome" type="textarea" class="form-control" placeholder="Inserisci il cognome">
                </div>

                <div class="input-container">
                    <i class="fa fa-calendar icon"></i>
                    <input id="data_nascita" type="date" class="form-control" placeholder="Inserisci la data di nascita">
                </div>

                <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <input id="codice_fiscale" type="textarea" class="form-control" placeholder="Inserisci il codice fiscale">
                </div>

                <div class="input-container">
                    <i class="fas fa-briefcase icon"></i>
                    <select class="form-control" id="tipo_utente">
                        <option value="" disabled selected hidden>Seleziona il tipo utente</option>
                        <option value="0">Cittadino</option>
                        <option value="1">Ente</option>
                        <option value="2">Impiegato</option>
                    </select>
                </div>

                <div class="input-container">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <input id="indirizzo" type="textarea" class="form-control" placeholder="Inserisci l'indirizzo di residenza">
                </div>

                <div class="input-container">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <input id="comune" type="textarea" class="form-control" placeholder="Inserisci il comune di residenza">
                </div>

                <div class="input-container">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <input id="provincia" type="textarea" class="form-control" placeholder="Inserisci la provincia di residenza">
                </div>

            </section>

            <h3>Dati ente</h3>

            <section class="step_1" style="display:none">

                <div class="input-container"> 
                    <i class="fas fa-briefcase icon"></i>
                    <input id="delegante" type="textarea" class="form-control" placeholder="Inserisci il delegante">
                </div>

            </section>

            <h3>Dati dipentente</h3>

            <section>
                <div class="input-container">
                   <i class="far fa-building icon"></i>
                    <input id="regione_sede" type="textarea" class="form-control" placeholder="Inserisci la regione">
                </div>

                <div class="input-container">
                   <i class="far fa-building icon"></i>
                    <input id="provincia_sede" type="textarea" class="form-control" placeholder="Inserisci la provincia">
                </div>

                <div class="input-container">
                   <i class="far fa-building icon"></i>
                    <input id="comune_sede" type="textarea" class="form-control" placeholder="Inserisci il comune">
                </div>

                <div class="input-container">
                   <i class="far fa-building icon"></i>
                    <input id="area" type="textarea" class="form-control" placeholder="Inserisci l'area">
                </div>

                <div class="input-container"> 
                    <i class="fas fa-building icon"></i>
                    <input id="numero_stanza" type="number" class="form-control" placeholder="Inserisci il numero stanza">
                </div>

                <div class="input-container"> 
                    <i class="fas fa-briefcase icon"></i>
                    <input id="nome_servizio" type="textarea" class="form-control" placeholder="Inserisci il nome del servizio">
                </div>
                
            </section>

            <h3>Info account</h3>

            <section>
                <div class="input-container">
                    <i class="fa fa-user icon"></i>
                    <input id="username" type="textarea" class="form-control" readonly>
                </div>

                <div class="input-container">
                    <i class="fa fa-key icon"></i>
                    <input id="password" type="password" class="form-control" placeholder="Enter password">
                </div>

                <div class="input-container">
                    <i class="fa fa-key icon"></i>
                    <input id="conf_password" type="password" class="form-control" placeholder="Confirm password">
                </div>
            </section>
        </div>
    </body>
</html>