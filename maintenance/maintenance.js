// Google map with geolocation
function initMap() {
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom:14,
        center:{lat:51.8979988098144, lng:-2.0838599205017}
    });
    var marker, i;
    var lat, lng, locObj, bowserID ;
    var locations=[];
    $.post("../home/bowserLocations.php","",function(data){
        //our json data is inside data variable
        console.log(data);
        $.each(data, function(key,value){
            //Iterating the json object
            console.log(value.Lat);
            console.log(value.Bowser_ID);
            //store the lattitude and longitude in lat and lng
            lat=value.Lat;
            lng=value.Lng;
            bowserID=value.Bowser_ID;
            //create LatLng object using lat nad lng variables
            locObj=new google.maps.LatLng(lat,lng);
            locations.push(locObj);
// create markers for all bowsers
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    // icon: image,
                    title: bowserID,
                    map: map
                });
            }
        });
    },"json");


    //
    // // marker on click
    // marker.addListener("click", () => {
    //
    // });

// geo locate button
    var infoWindow = new google.maps.InfoWindow();
    const locationButton = document.createElement("button");
    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

// geo locate user
    locationButton.addEventListener("click", () => {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };
                    infoWindow.setPosition(pos);
                    infoWindow.setContent("Current Location");
                    infoWindow.open(map);
                    // map.setCenter(pos);
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    });
}
// geo locate error
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed."
            : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}
window.initMap = initMap;


// Creating a detail view modal
$('#detailModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })
  
//   Popovers
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})


// Alerts
$(document).ready(function(){
    $('button').click(function(){
        $('.alert').show()
    }) 
});