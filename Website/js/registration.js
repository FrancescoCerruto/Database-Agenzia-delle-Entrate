var username;
var password;
var conf_password;
var nome;
var cognome;
var dataNascita;
var codiceFiscale;
var indirizzo;
var comune;
var provincia;
var tipoUtente;
var delegante;
var regioneSede;
var provinciaSede;
var comuneSede;
var numStanza;
var nomeServizio;
var area;
var oggi = new Date();
var regioni = new Array();
var province = new Array();
var comuni = new Array();
var dataSedi = new Array();


//controlla i dati dell'account
function CheckAccountInfo(){
    username = $("#username").val();
    password = $("#password").val();
    conf_password = $("#conf_password").val();

    if(password == "" || conf_password == ""){
        alert("Error: you have to fill in all the inputs");
        return false;
    }

    else if(password != conf_password){
        alert("Error: the 'password' and 'confirm password'inputs are different");
        return false;
    }

    return true;
}

//controlla i dati dell'utente - setta username a codice_fiscale
function CheckInfoUtente(){
    nome = $("#nome").val();
    cognome = $("#cognome").val();
    dataNascita = new Date($("#data_nascita").val());
    codiceFiscale = $("#codice_fiscale").val();
    tipoUtente = $("#tipo_utente").val();
    indirizzo = $("#indirizzo").val();
    comune = $("#comune").val();
    provincia = $("#provincia").val();

    if (oggi.getFullYear() - dataNascita.getFullYear() < 17) {
        alert("Errore: Sono passati meno di 18 anni. Devi avere almeno 18 anni per poterti registrare");
        return false;
    }
    else if ((oggi.getFullYear() - dataNascita.getFullYear() == 18) && (dataNascita.getMonth() > oggi.getMonth())) {
        alert("Errore: Sono passati meno di 18 anni. Devi avere almeno 18 anni per poterti registrare");
        return false;
    }
    else if ((oggi.getFullYear() - dataNascita.getFullYear() == 18) && (dataNascita.getMonth() == oggi.getMonth()) && (dataNascita.getDate() > oggi.getDate())) {
        alert("Errore: Sono passati meno di 18 anni. Devi avere almeno 18 anni per poterti registrare");
        return false;
    }

    if (nome == "" || cognome == "" || dataNascita == "" || codiceFiscale == "" || tipoUtente == "" || indirizzo == "" || comune == "" || provincia == ""){
        alert("Errore: devi specificare tutti i dati");
        return false;
    }

    //controllo comune nella provincia????

    $("#username").val(codiceFiscale);
    return true; 
}

//controlla i dati dell'ente
function CheckInfoEnte() {

    if (tipoUtente === 'Ente') {   //utente di tipo ente (0 cittadino, 1 ente, 2 impiegato)

        delegante = $("#delegante").val();

        if (delegante == "") {
            alert("Errore: devi specificare tutti i dati");
            return false;
        }
        return true;
    }
    return true;
}

//controlla i dati del dipendente
function CheckInfoDipendente() {

    if (tipoUtente === 'Impiegato') {

        regioneSede = $("#regione_sede").val();
        provinciaSede = $("#provincia_sede").val();
        comuneSede = $("#comune_sede").val();
        numStanza = $("#numero_stanza").val();
        nomeServizio = $('#nome_servizio').val();
        area = $('#area').val();

        if (regioneSede == "" || provinciaSede == "" ||  numStanza == "" || nomeServizio == "" || area == "") {
            alert("Errore: devi specificare tutti i dati");
            return false;
        }
        return true;
    }
    return true;
}

//bottone next (dopo che ho già girato)
function CheckNextStep(tipoUtente, priorIndex, wizard) {
    // cittadino deve fare step 0,3
    // ente deve fare step 0,1,3
    // dipendente deve fare step 0,2,3

    if (tipoUtente === 'Cittadino') { // cittadino
        // deve andare allo step 3
        // si trova nello step 1
        wizard.steps("next");
        wizard.steps("next");
    }
    else if (tipoUtente === 'Ente') { // ente

        if (priorIndex == 0) {
            // deve andare allo step 1
            // si trova nello step 1 -> non faccio nulla
        }
        else {
            // deve andare allo step 3
            // si trova nello step 2
            wizard.steps("next");
        }
    }
    else { // dipendente
        if (priorIndex == 0) {
            // deve andare allo step 2
            // si trova nello step 1
            wizard.steps("next");
        }
        else {
            // deve andare allo step 3
            // si trova nello step 3 -> non fa nulla
        }
    }
}

//bottone previous (dopo che ho già girato)
function CheckPreviousStep(tipoUtente, priorIndex, wizard) {
    // cittadino deve fare step 0,3 -> torna indietro solo allo step 3
    // ente deve fare step 0,1,3 -> torna indietro o allo step 1 o allo step 3
    // dipendente deve fare step 0,2,3 -> torna indietro o allo step 2 o allo step 3

    if (tipoUtente === 'Cittadino') { // cittadino
        // deve andare allo step 0
        // si trova nello step 2
        wizard.steps("previous");
        wizard.steps("previous");
    }
    else if (tipoUtente === 'Ente') { // ente

        if (priorIndex == 3) {
            // deve andare allo step 1
            // si trova nello step 2
            wizard.steps("previous");
        }
        else {
            // deve andare allo step 0
            // si trova nello step 0 -> non faccio nulla
        }
    }
    else { // dipendente
        if (priorIndex == 3) {
            // deve andare allo step 2
            // si trova nello step 2 -> non faccio nulla
        }
        else {
            // deve andare allo step 0
            // si trova nello step 1
            wizard.steps("previous");
        }
    }
}

function SignUp() {
    $.ajax({
        type: 'POST',
        url: 'process.php',
        data: { nome: nome, cognome: cognome, codiceFiscale: codiceFiscale, dataNascita: dataNascita, indirizzo: indirizzo, comune: comune, provincia: provincia, password: password, tipoUtente: tipoUtente, delegante: delegante, numStanza: numStanza, regioneSede: regioneSede, provinciaSede: provinciaSede, comuneSede: comuneSede, area: area, nomeServizio: nomeServizio }, 
        success: function (data) {
           if (tipoUtente != 'Impiegato') {
                window.location.href = "index.php";
            }
           else {
               window.location.href = "lavoro.php";
            }
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

$(document).ready(function () {

    $("#logout").click(function () {
        window.location.href = "login.html";
    });

    $.ajax({
        type: "POST",
        url: "recupero_dati_sede.php",
        dataType: "JSON",
        success: function (data) {

            dataSedi = data;
            data.forEach(createArrayRegioni);
            regioni = regioni.filter(onlyUnique);
            regioni.forEach(createMenuRegioni);
        },
        error: function () {
            alert("Error: data upload failed");
        }
    });

    // wizard = form a pagine
    var wizard = $("#sign_up").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "horizontal",

        // viene chiamata prima che si cambi sptep
        onStepChanging: function (event, currentIndex, newIndex) {

            if(currentIndex > newIndex){
                return true;
            }

            if(currentIndex == 0 && newIndex == 1){
                return CheckInfoUtente();
            }

            if (currentIndex == 1 && newIndex == 2) {
                return CheckInfoEnte();
            }

            if (currentIndex == 2 && newIndex == 3) {
                return CheckInfoDipendente();
            }
        },
        onStepChanged: function (event, currentIndex, priorIndex) {

            if (currentIndex < priorIndex) {
                CheckPreviousStep(tipoUtente, priorIndex, wizard);
            }
            else {
                CheckNextStep(tipoUtente, priorIndex, wizard);
            }

        },
        onFinishing: function(event,currentIndex){
            return CheckAccountInfo();
        },
        onFinished: function(event,currentIndex){
            SignUp();
        }
    });
});

function createArrayRegioni(item, index) {

    if (regioni.indexOf(item) == -1) {

        regioni.push(item.Regione);
    }
}

function createArrayProvince(item, index) {

    if (item.Regione === $('#regione_sede').val()) {
        province.push(item.Provincia);
    }
}

function createArrayComuni(item, index) {

    if (item.Provincia === $('#provincia_sede').val() && item.Comune !== null) {
        comuni.push(item.Comune);
    }
}

function createMenuRegioni(item, index) {
    $("#regione_sede").append(new Option(item, item));
}

function createMenuProvince(item, index) {
    $("#provincia_sede").append(new Option(item, item));
}

function createMenuComuni(item, index) {
    $("#comune_sede").append(new Option(item, item));
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function onRegioneChange() {
    
    province = new Array();
    comuni = new Array();
    removeProvinceOptions();
    removeComuneOptions();
    dataSedi.forEach(createArrayProvince);
    province = province.filter(onlyUnique);
    province.forEach(createMenuProvince);
}

function onProvinciaChange() {
    comuni = new Array();
    removeComuneOptions();

    dataSedi.forEach(createArrayComuni);
    comuni = comuni.filter(onlyUnique);
    comuni.forEach(createMenuComuni);
}


function removeProvinceOptions() {


    $('#provincia_sede')
        .empty()
        .append("<option value='' disabled selected hidden>Seleziona la provincia della sede</option>");
}

function removeComuneOptions() {


    $('#comune_sede')
        .empty()
        .append("<option value='' disabled selected hidden>Seleziona il comune della sede</option>");
}