// Ugly Script to allow display of Bowser ID selection for selected use-cases 
// Uses ID from select div object to enable or disable the selection of a Bowser Div

function reportTypeCheck(select){
	var currSelect = select[select.selectedIndex].id;
	if (currSelect == 1){
		document.getElementById("bowserSelect").style.display = "block";
	} else {
		document.getElementById("bowserSelect").style.display = "none";
	}
}


function sendReport(){
	var currSelect = document.getElementById("select");
	var currSelectVar = currSelect.options[currSelect.selectedIndex].getAttribute("id");
	console.log(currSelectVar);
	if (currSelectVar == 1){
		var Report_Type1 = document.getElementById("select").value;
		var Bowser_ID1 = document.getElementById("term").value;
		var Description1 = document.getElementById("floatingTextarea2").value;
		console.log(currSelectVar);
	} else if (currSelectVar == 0){
		var Report_Type1 = document.getElementById("select").value;
		var Bowser_ID1 = "0";
		var Description1 = document.getElementById("floatingTextarea2").value;
		console.log(currSelectVar);
	} else {
		console.log(currSelectVar);
		alert("Please Select Report Type and Complete Details")
		return false;
	}
	
	var dataString = 'Report_Type1=' + Report_Type1 + '&Bowser_ID1=' + Bowser_ID1 + '&Description1=' + Description1;
	console.log(dataString);
	if ( Report_Type1 == '' || Bowser_ID1 == '' || Description1 == '' ) {
		alert("Please Fill All Fields");
	} else {
		$.ajax({
			type: "POST",
			url: "report.php",
			data: dataString,
			cache: false,
			success: function(html) {
				alert(html);
			}
		});
		$('#reportModal').modal('hide');
	}
	return false;
}
	