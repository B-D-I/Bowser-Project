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





//                GOOGLE MAPS DIV

// map location set at cheltneham park campus
// var mapCenter = new google.maps.LatLng(51.8979988098144,-2.0838599205017);
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();   // display content
mapCenter = new google.maps.LatLng(51.8979988098144,-2.0838599205017);

function initialize(){       // function for map options
    var mapOptions = {
        zoom: 12,            // Zoom set to 14 as div containig map is small, so gives the user an initial high overview of location
        center:{lat:51.8979988098144, lng:-2.0838599205017},
        // center: new google.maps.LatLng(51.8979988098144,-2.0838599205017),
        // center: mapCenter,
        mapTypeId: "hybrid"    // Hybrid has been used to give both road and satellite imgaging
    };
    myMap = new google.maps.Map(document.getElementById("map"), mapOptions); // calls mapInput id

    const image = {
        url: "/Bowser-Project/images/logo/bowserLogo.png",
        scaledSize: new google.maps.Size(50, 50),
        origin: new google.maps.Point(0,0),
        anchor: new google.maps.Point(0, 0)
    }

    marker = new google.maps.Marker({    // A marker has been included into the map
        map: myMap,
        // position: mapCenter,
        position: {lat:51.8979988098144, lng:-2.0838599205017},     // Positioned in the centre of map
        icon: image,
        draggable: true,         // Marker has been made movable
    });

    // Event listener for the dragged marker location
    google.maps.event.addListener(marker, 'dragend', markerDragged);

    function markerDragged() {   // Function to record Latitude and Longitude information
        var selectedPos = {'latLng': marker.getPosition()};
        geocoder.geocode(selectedPos, showAddressInInfoWindow);
         console.log(selectedPos);
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
function markerLocation() {
    var eventLat = marker.getPosition().lat();  // latitude information
    var eventLng = marker.getPosition().lng();  // longitude
    // store the location data to variable
    document.getElementById('locationLng').value = eventLng;
    document.getElementById('locationLat').value = eventLat;
    // document.getElementById('locationComb').value = eventLat+", "+ eventLng;
    console.log(eventLng, eventLat);
}

function returnMarkerLat(){
    var eventLat = marker.getPosition().lat();  // latitude information
    document.getElementById('locationLat').value = eventLat;
    return eventLat;
}
function returnMarkerLng(){
    var eventLng = marker.getPosition().lng();  // longitude
    document.getElementById('locationLng').value = eventLng;
    return eventLng;
}

// POST TO SERVER
$('#formInsertEvent').submit(function(event) {
    event.preventDefault();
    formData = $('#formInsertEvent').serialize();

        eventLat = returnMarkerLat();
        eventLng = returnMarkerLng();

        console.log(formData);
        // confirm data
        console.log(eventLng, eventLat);

        var bowserID = $("[name=bowserForInsert]").val();
        console.log(bowserID);

        // var locationLng =$("locationLng").val();
        // var locationLat =$("locationLat").val();
        // formData.append("Llng", locationLng);
        // formData.append("Llat", locationLat);

        // formData.append("bowserID", bowserID);
        // console.log(formData.serialize);

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



