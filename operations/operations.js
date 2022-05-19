// this ajax function will submit new user registration data to the associated php page, which will update database
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
// this ajax function will submit the bowser request form data to associated php page
$('#formBowserRequest').submit(function(event) {
    formData2 = $('#formBowserRequest').serialize();
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "operationsDAO.php",
        data: formData2+"&phpFunction=requestBowser",
        success: function(msg){
            $("#divMessage").html(msg);
            window.location="admin.php";
        },
        error: function(msg){
            console.log(msg);
            window.location="admin.php";
        }
    });
});


//				    POP UP WINDOW - used to provide a window for bowser page
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



//                GOOGLE MAPS DIV: includes bowser locations, geo-location, and deploy bowser draggable icon
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();   // display content
mapCenter = new google.maps.LatLng(51.8979988098144,-2.0838599205017);

function initialize(){       // function for map options
    var mapOptions = {
        zoom: 12,
        center:{lat:51.8979988098144, lng:-2.0838599205017},
        mapTypeId: "hybrid"
    };
    myMap = new google.maps.Map(document.getElementById("map"), mapOptions);

    // water tank image used for the deploy bowser icon
    const image = {
        // plesk: "/images/other/water-tank.png"
        url: "/Bowser-Project/images/other/water-tank.png",
        scaledSize: new google.maps.Size(50, 50),
        origin: new google.maps.Point(0,0),
        anchor: new google.maps.Point(0, 0)
    }
    // make water bowser marker draggable
    marker = new google.maps.Marker({
        map: myMap,
        position: {lat:51.8979988098144, lng:-2.0838599205017},
        // Set marker icon to bowser image
        icon: image,
        // Marker has been made movable
        draggable: true,
    });
    // seperate markers for pre-deployed bowsers
    var markers, i;
    var lat, lng, locObj, bowserID ;
    var locations=[];
    // retrieve deployed bowser locations
    $.post("../home/bowserLocationsDAO.php","",function(data){
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
                markers = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    // icon: image,
                    title: "Bowser ID: "+bowserID,
                    map: myMap
                });
            }
        });
    },"json");
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
// return marker latitude
function returnMarkerLat(){
    var eventLat = marker.getPosition().lat();  // latitude information
    document.getElementById('locationLat').value = eventLat;
    return eventLat;
}
// return marker longitude
function returnMarkerLng(){
    var eventLng = marker.getPosition().lng();  // longitude
    document.getElementById('locationLng').value = eventLng;
    return eventLng;
}

// POST TO BOWSER LOCATION SERVER
$('#formInsertEvent').submit(function(event) {
    event.preventDefault();
    formData = $('#formInsertEvent').serialize();
        // new marker location
        eventLat = returnMarkerLat();
        eventLng = returnMarkerLng();
    // confirm data
        console.log(formData);
        console.log(eventLng, eventLat);

        var bowserID = $("[name=bowserForInsert]").val();
        console.log(bowserID);
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
                window.location="operations.php";
            }
        });
    });

// reports page heatmap
function heatMap(){
    var map=new google.maps.Map(document.getElementById('map'),{
        zoom:10,
        center:{lat:51.8979988098146, lng:-2.0838599205018}
    });
    //We are going to load geo locations from the database.
    var lat, lng, locObj ;
    var locations=[];
    // retrieve report location data
    $.post("heatMapDAO.php","",function(data){
        //our json data is inside data variable
        //console.log(data);
        $.each(data, function(key,value){
            //Iterating the json object
            console.log(value.Lat);
            //store the lattitude and longitude in lat and lng
            lat=value.Lat;
            lng=value.Lng;
            //create LatLng object using lat nad lng variables
            locObj=new google.maps.LatLng(lat,lng);
            locations.push(locObj);
        });
    },"json");
    var heatmap=new google.maps.visualization.HeatmapLayer(
        {
            data:locations,
            map:map
        }
    );
}