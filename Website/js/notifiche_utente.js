var datacf = new Array();
var codfis = new Array();

$(document).ready(function () {

	$("#logout").click(function () {
		window.location.href = "root.php";	
	});
	
	recuperaDatiCf();
});

function recuperaDatiCf() {

	$.ajax({
		type: "POST",
		url: "recupero_dati_cliente.php",
		dataType: "JSON",
		success: function (data) {

			datacf = data;
			data.forEach(createArrayCf);
			codfis = codfis.filter(onlyUnique);
			codfis.forEach(createMenuCf);
		},
		error: function () {
			alert("Error: data upload failed");
		}
	});
}

function createArrayCf(item, index) {
	
	if(codfis.indexOf(item) == -1) {
		
		codfis.push(item.CodFis);
	}
}

function createMenuCf(item,index) {
	$("#cf").append(new Option(item,item));
}

function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
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
			console.log("Risultato:\n" + data);
		},
		error: function (data) {
			alert ("ERRORE:\n" + data);
		}
	});
});