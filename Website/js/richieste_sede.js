var regioni = new Array();
var province = new Array();
var comuni = new Array();
var dataSedi = new Array();


$(document).ready(function () {

	recuperaDatiSede();
	
	$("#logout").click(function () {
		window.location.href = "root.php";	
	});
});

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
	
	if (item.Regione === $('#regione').val()) {
		province.push(item.Provincia);
	}
}

function createArrayComuni(item, index) {
	
	if (item.Provincia === $('#provincia').val() && item.Comune !== null) {
		comuni.push(item.Comune);
	}
}

function createMenuRegioni(item,index) {
	$("#regione").append(new Option(item,item));
}

function createMenuProvince(item,index) {
	$("#provincia").append(new Option(item,item));
}

function createMenuComuni(item,index) {
	$("#comune").append(new Option(item,item));
}

function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}

$('#regione').change(function() {
	
	province = new Array();
	comuni = new Array();
	removeProvinceOptions();
	removeComuneOptions();
	
	dataSedi.forEach(createArrayProvince);
	province = province.filter(onlyUnique);
	province.forEach(createMenuProvince);
});

$('#provincia').change(function () {
	
	comuni = new Array();
	removeComuneOptions();
	
	dataSedi.forEach(createArrayComuni);
	comuni = comuni.filter(onlyUnique);
	comuni.forEach(createMenuComuni);
});



function removeProvinceOptions() {	
	
	$('#provincia')
		.empty()
		.append("<option value='' disabled selected hidden>Seleziona la provincia della sede</option>");
}

function removeComuneOptions() {

	$('#comune')
		.empty()
		.append("<option value='' disabled selected hidden>Seleziona il comune della sede</option>");
}

$("#form_richiesta").submit(function (e) {

	console.log("form");

	e.preventDefault(); // avoid to execute the actual submit of the form.

	var regione = $('#regione').val();
	var provincia = $('#provincia').val();
	var comune = $('#comune').val();
	
	if (regione != "" && provincia != "")
	{
		$.ajax({
			type: "POST",
			url: 'calcola_richieste_sede.php',
			data: {pippo: regione, provincia: provincia, comune: comune},
			success: function (data) {
				console.log("risultato:\n" + data);
			},
			eroor: function (data) {
				alert("ERRORE:\n" + data);
			},
		});
	}
});