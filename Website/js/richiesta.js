var regioni = new Array();
var province = new Array();
var comuni = new Array();
var dataSedi = new Array();

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

	recuperaDatiSede();
	creaTabellaNotifiche();

	$("#aggiorna").click(function () {
		console.log("Aggiorno tabella");
		creaTabellaNotifiche();
	});
});

function creaTabellaNotifiche() {

	if ($.fn.dataTable.isDataTable('#notifiche')) {
		var table = $('#notifiche').DataTable().ajax.reload();
	}
	else {
		var table = $('#notifiche').dataTable({
			//simone
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
				'url': 'Recupera_notifiche.php',
				type: 'POST',
			},
			'columns': [
				{ "data": 'ID Richiesta' },
				{ "data": 'Data convocazione' },
				{ "data": 'Area' },
				{ "data": 'Ufficio dipendete' },
			]
		});
    }
	
	$('#notifiche tbody').on('click', 'tr', function () {
		dataRow = table.DataTable().row(this).data();
	});
}

function recuperaDatiSede() {

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
}

function createArrayRegioni(item, index) {
	
	if(regioni.indexOf(item) == -1) {
		
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

function createMenuRegioni(item,index) {
	$("#regione_sede").append(new Option(item,item));
}

function createMenuProvince(item,index) {
	$("#provincia_sede").append(new Option(item,item));
}

function createMenuComuni(item,index) {
	$("#comune_sede").append(new Option(item,item));
}

function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}

$('#regione_sede').change(function() {
	
	province = new Array();
	comuni = new Array();
	removeProvinceOptions();
	removeComuneOptions();
	
	dataSedi.forEach(createArrayProvince);
	province = province.filter(onlyUnique);
	province.forEach(createMenuProvince);
});

$('#provincia_sede').change(function () {
	
	comuni = new Array();
	removeComuneOptions();
	
	dataSedi.forEach(createArrayComuni);
	comuni = comuni.filter(onlyUnique);
	comuni.forEach(createMenuComuni);
});



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

$("#form_richiesta").submit(function (e) {

	console.log("form");

	e.preventDefault(); // avoid to execute the actual submit of the form.

	var form = $(this);
	var url = form.attr('action');

	$.ajax({
		type: "POST",
		url: url,
		data: form.serialize(), // serializes the form's elements.
		success: function (data) {
			$("#modal_body").text("Richiesta n. " + data + " elaborata. Aggiornare le notifiche.");
			$('#success').modal('show');
		}
	});
});

$('.close').click(function () {
	$('#success').modal('hide');
});