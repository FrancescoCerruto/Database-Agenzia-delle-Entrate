$(document).ready(function () {

	$("#logout").click(function () {
		$.ajax({
			type: "GET",
			url: "lavoro.php",
			data: { logout: true },
			success: function (data) {
				window.location.href = "login.html";
			},
			error: function (data) {
			}
		});
	});

	creaTabellaLavoro();

	$("#aggiorna").click(function () {
		console.log("Aggiorno tabella");
		creaTabellaLavoro();
	});
});

function creaTabellaLavoro() {

	if ($.fn.dataTable.isDataTable('#lavoro')) {
		var table = $('#lavoro').DataTable().ajax.reload();
	}
	else {
		var table = $('#lavoro').dataTable({
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
				'url': 'Recupera_lavori.php',
				type: 'POST',
			},
			'columns': [
				{ "data": "Data convocazione" },
				{ "data": "Codice fiscale Cliente" },
				{ "data": "ID Richiesta" },
			]

		});
	}

	$('#lavoro tbody').on('click', 'tr', function () {
		dataRow = table.DataTable().row(this).data();
	});
}