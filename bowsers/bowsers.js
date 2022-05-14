// Function for managing Marker position and text

let map;

// Values from bowsers.php divs
bowserLat = +document.getElementById("bowserLat").innerHTML;
bowserLng = +document.getElementById("bowserLng").innerHTML;
bowserID = +document.getElementById("bowserID").innerHTML;

function initMap() {
	// Map initialisation
  	const map = new google.maps.Map(document.getElementById("map"), {
    	zoom: 16,
    	center: { lat: bowserLat, lng: bowserLng },
	});
	
	// Marker Position and Label
	new google.maps.Marker({
		position: { lat: bowserLat, lng: bowserLng },
		map,
		title: "Bowser " + bowserID,
	});
}

window.initMap = initMap;