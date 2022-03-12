// Ugly Script to allow display of Bowser ID selection for selected use-cases 
// Uses ID from select div object to enable or disable the selection of a Bowser Div

function reportTypeCheck(select){
	var currSelect = select[select.selectedIndex].id;
	if (currSelect <= 2){
		document.getElementById("bowserSelect").style.display = "block";
	} else {
		document.getElementById("bowserSelect").style.display = "none";
	}
}