$('#formUserRegistration').submit(function(event) {
    formData = $('#formUserRegistration').serialize();

    // prevents the form submission
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "operationsDAO.php",
        data: formData+"&phpFunction=createUser",
        success: function(msg){
            $("#divMessage").html(msg);
            window.location="operations.php";
        },
        error: function(msg){
            console.log(msg);
            window.location="operations.php";
        }
    });
});

$('#formBowserRequest').submit(function(event) {
    formData2 = $('#formBowserRequest').serialize();

    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "operationsDAO.php",
        data: formData2+"&phpFunction=requestBowser",
        success: function(msg){
            $("#divMessage").html(msg);
            window.location="operations.php";
        },
        error: function(msg){
            console.log(msg);
            window.location="operations.php";
        }
    });
});


//				    POP UP WINDOW
var taskWindow;                       // function allows for url, window name, width and height to be defined within the html
function popUpWindow(URL, windowName, windowWidth, windowHeight) {
    var centerLeft = (screen.width/3)-(windowWidth/3); // window dimensions
    var centerTop = (screen.height/3)-(windowHeight/3);
    //scrollbars=no,
    var windowFeatures = 'toolbar=no, location=no, directories=no, status=no, menubar=no, titlebar=no, resizable=no,'; // remove toolbar, scrollbar etc..
    return window.open(URL, windowName, windowFeatures +' width='+ windowWidth +', height='+ windowHeight +', top='+ centerTop +', left='+ centerLeft); // open the defined window
}

var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})

// // Google map with geolocation
// let map, infoWindow;
//
// function initMap() {
//     map = new google.maps.Map(document.getElementById("map"), {
//         zoom:14,
//         center:{lat:51.8979988098144, lng:-2.0838599205017}
//     });
//     infoWindow = new google.maps.InfoWindow();
//
//     const locationButton = document.createElement("button");
//
//     locationButton.textContent = "Pan to Current Location";
//     locationButton.classList.add("custom-map-control-button");
//     map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
//     locationButton.addEventListener("click", () => {
//         // Try HTML5 geolocation.
//         if (navigator.geolocation) {
//             navigator.geolocation.getCurrentPosition(
//                 (position) => {
//                     const pos = {
//                         lat: position.coords.latitude,
//                         lng: position.coords.longitude,
//                     };
//
//                     infoWindow.setPosition(pos);
//                     infoWindow.setContent("Location found");
//                     infoWindow.open(map);
//                     map.setCenter(pos);
//                 },
//                 () => {
//                     handleLocationError(true, infoWindow, map.getCenter());
//                 }
//             );
//         } else {
//             // Browser doesn't support Geolocation
//             handleLocationError(false, infoWindow, map.getCenter());
//         }
//     });
// }
//
// function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//     infoWindow.setPosition(pos);
//     infoWindow.setContent(
//         browserHasGeolocation
//             ? "Error: The Geolocation service failed."
//             : "Error: Your browser doesn't support geolocation."
//     );
//     infoWindow.open(map);
// }
//
// window.initMap = initMap;








// STATIC MAP

// JavaScript Document
//This is the callback fucntion provided to google to upload the map.
// function initMap(){
//     var map=new google.maps.Map(document.getElementById('map'),{
//         zoom:14,
//         center:{lat:51.8979988098144, lng:-2.0838599205017}
//     });
//     //We are going to load geo locations from the database.
//     var lat, lng, locObj ;
//     var locations=[];
//     $.post("HeatMap.php","",function(data){
//         //our json data is inside data variable
//         //console.log(data);
//         $.each(data, function(key,value){
//             //Iterating the json object
//             console.log(value.Lat);
//
//             //store the lattitude and longitude in lat and lng
//             lat=value.Lat;
//             lng=value.Lng;
//             //create LatLng object using lat nad lng variables
//             locObj=new google.maps.LatLng(lat,lng);
//             locations.push(locObj);
//         });
//         //debug locations
//         //console.log(locations);
//
//     },"json");
//
//     //This is the start of heatmap code
//     var heatmap=new google.maps.visualization.HeatmapLayer(
//         {
//             data:locations,
//             map:map
//         }
//     );
// }





//                GOOGLE MAPS DIV

// map location set at cheltneham park campus
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();   // display content


function initialize(){       // function for map options
    var mapOptions = {
        zoom: 12,            // Zoom set to 14 as div containig map is small, so gives the user an initial high overview of location
        center:{lat:51.8979988098144, lng:-2.0838599205017},
        mapTypeId: "hybrid"    // Hybrid has been used to give both road and satellite imgaging
    };

    myMap = new google.maps.Map(document.getElementById("map"), mapOptions); // calls mapInput id

    marker = new google.maps.Marker({    // A marker has been included into the map
        map: myMap,
        position: {lat:51.8979988098144, lng:-2.0838599205017},     // Positined in the centre of map
        draggable: true,         // Marker has been made moveable
    });

    // Event listener for the dragged marker location
    google.maps.event.addListener(marker, 'dragend', markerDragged);

    function markerDragged() {   // Function to record Latitude and Longetitude information
        var selectedPos = {'latLng': marker.getPosition()};
        geocoder.geocode(selectedPos, showAddressInInfoWindow);
        //  console.log(selectedPos);
    }
    // function to show address information
    function showAddressInInfoWindow(results) {
        if (results[0]) {
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(myMap, marker);
            // console.log();
        }
    }
}

google.maps.event.addDomListener(window, 'load', initialize);

// function to store the map marker location
function markerLocation(){

    var eventLat = marker.getPosition().lat();  // latitude information
    var eventLng = marker.getPosition().lng();  // longitude

    // store the location data to variable
    document.getElementById('locationLng').value = eventLng;
    document.getElementById('locationLat').value = eventLat;
    // document.getElementById('locationComb').value = eventLat+", "+ eventLng;

    // check correct
    console.log(eventLng, eventLat);

// POST TO SERVER

// function on submit - send data to php doc
    $('#formInsertEvent').on('submit', function(e){
        var formData=new FormData(this);
        e.preventDefault();

        console.log(formData.serialize);
        // confirm data
        console.log(eventLng, eventLat);

        var bowserID = $("bowserForInsert").val();
        console.log(bowserID);

        var locationLng =$("locationLng").val();
        var locationLat =$("locationLat").val();

        formData.append("Llng", locationLng);
        formData.append("Llat", locationLat);
        formData.append("bowserID", bowserID);
        console.log(formData.serialize);

        // AJAX used to send data to php page / url to send data / method used (POST)
        // data type / if stored in cache / alert if successful

        $.ajax({
            url: "deployBowserDAO.php",
            method:"POST",
            data:{"bowserID": bowserID,
                "locationLat": eventLat,
                "locationLng": eventLng,
            },
            success:function(msg) {
                console.log(msg);
                alert("Bowser Deployed");
            }
        });

    });
}


