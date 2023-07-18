$(document).ready(function () {

	$("#logout").click(function () {
		$.ajax({
			type: "GET",
			url: "index.php",
			data: { logout: true },
			success: function (data) {
				window.location.href = "login.html";
			},
			error: function (data) {
			}
		});
	});
	
	$("#eta").click(function () {
		$.ajax({
			type: "POST",
			url: "eta_media.php",
			success: function (data) {
				console.log("Risultato calcolo eta media:\n" + data);
			},
			error: function (data) {
				alert("ERRORE:\n" + data);
			}
		});
	});
	
	$("#n_ric_sede").click(function () {
		window.location.href = "richieste_sede.php";
	});
	
	$("#n_ric_utente").click(function () {
		window.location.href = "richieste_utente.php";
	});

	$("#s_ric_utente").click(function () {
		window.location.href = "notifiche_utente.php";
	});
	
	creaTabellaImpiegati();
	creaTabellaClienti();
	creaTabellaLavoro();

	$("#aggiorna_impiegati").click(function () {
		console.log("Aggiorno tabella Impiegati");
		creaTabellaImpiegati();
	});

	$("#aggiorna_clienti").click(function () {
		console.log("Aggiorno tabella Clienti");
		creaTabellaClienti();
	});
	
	$("#aggiorna_carico").click(function () {
		console.log("Aggiorno tabella lavoro");
		creaTabellaLavoro();
	});
});

function creaTabellaImpiegati() {

	if ($.fn.dataTable.isDataTable('#impiegati')) {
		var table = $('#impiegati').DataTable().ajax.reload();
	}
	else {
		var table = $('#impiegati').dataTable({
			//simone (non valido)
			/*"sAjaxSource": "Recupera_notifiche.php",
			"bDeferRender": true,
			"paging": false,
			"scrollY": "300",
			"scrollCollapse": true,
			"searching": false,
			"info": false,
			"aoColumns": [	
				{ "mData": "ID Richiesta" },
				{ "mData": "Data convocazione" },
				{ "mData": "Area" },
				{ "mData": "Ufficio dipendete" },
			],*/

			//mio
			'ajax': {
				'url': 'Recupera_impiegati.php',
				type: 'POST',
			},
			'columns': [
				{ "data": 'Nome' },
				{ "data": 'Cognome' },
				{ "data": 'Codice fiscale' },
				{ "data": 'Ufficio dipendente' },
				{ "data": 'Regione Sede' },
				{ "data": 'Provincia Sede' },
				{ "data": 'Comune Sede' },
				{ "data": 'Nome Area' },
				{ "data": 'Nome Servizio' },
			]
		});
	}

	$('#impiegati tbody').on('click', 'tr', function () {
		dataRow = table.DataTable().row(this).data();
	});
}

function creaTabellaClienti() {

	if ($.fn.dataTable.isDataTable('#clienti')) {
		var table = $('#clienti').DataTable().ajax.reload();
	}
	else {
		var table = $('#clienti').dataTable({
			//simone (non valido)
			/*"sAjaxSource": "Recupera_notifiche.php",
			"bDeferRender": true,
			"paging": false,
			"scrollY": "300",
			"scrollCollapse": true,
			"searching": false,
			"info": false,
			"aoColumns": [	
				{ "mData": "ID Richiesta" },
				{ "mData": "Data convocazione" },
				{ "mData": "Area" },
				{ "mData": "Ufficio dipendete" },
			],*/

			//mio
			'ajax': {
				'url': 'Recupera_clienti.php',
				type: 'POST',
			},
			'columns': [
				{ "data": 'Nome' },
				{ "data": 'Cognome' },
				{ "data": 'Codice fiscale' },
				{ "data": 'Tipo utente' },
				{ "data": 'Delegante' },
			]
		});
	}

	$('#clienti tbody').on('click', 'tr', function () {
		dataRow = table.DataTable().row(this).data();
	});
}

function creaTabellaLavoro() {

	if ($.fn.dataTable.isDataTable('#carico')) {
		var table = $('#carico').DataTable().ajax.reload();
	}
	else {
		var table = $('#carico').dataTable({
			//simone
			/*"sAjaxSource": "Recupera_lavori.php",
			"bDeferRender": true,
			"paging": false,
			"scrollY": "300",
			"scrollCollapse": true,
			"searching": false,
			"info": false,
			"aoColumns": [
				{ "mData": "Data convocazione" },
				{ "mData": "Codice fiscale Cliente" },
				{ "mData": "ID Richiesta" },
			],*/

			//mio
			'ajax': {
				'url': 'Recupera_lavori_root.php',
				type: 'POST',
			},
			'columns': [
				{ "data": "Regione Sede" },
				{ "data": "Provincia Sede" },
				{ "data": "Comune Sede" },
				{ "data": "Nome Area" },
				{ "data": "Nome Servizio" },
				{ "data": "Data convocazione" },
				{ "data": "Codice fiscale Cliente" },
				{ "data": "Codice fiscale Impiegato" },
				{ "data": "ID Richiesta" },
			]

		});
	}

	$('#carico tbody').on('click', 'tr', function () {
		dataRow = table.DataTable().row(this).data();
	});
}