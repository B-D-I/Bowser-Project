
//				    POP UP WINDOW - this is used to dislpay the bowser page
var taskWindow;                       // function allows for url, window name, width and height to be defined within the html
function popUpWindow(URL, windowName, windowWidth, windowHeight) {
    var centerLeft = (screen.width/3)-(windowWidth/3); // window dimensions
    var centerTop = (screen.height/3)-(windowHeight/3);
    //scrollbars=no,
    var windowFeatures = 'toolbar=no, location=no, directories=no, status=no, menubar=no, titlebar=no, resizable=no,'; // remove toolbar, scrollbar etc..
    return window.open(URL, windowName, windowFeatures +' width='+ windowWidth +', height='+ windowHeight +', top='+ centerTop +', left='+ centerLeft); // open the defined window
}

// popover is used to display further information when an element is clicked
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})

//              GOOGLE MAPS

// Google map with geolocation
let map, infoWindow;

function initMap() {
    // set map location and zoom
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom:14,
        center:{lat:51.8979988098144, lng:-2.0838599205017}
    });

    // the following ajax method retrieves all bowser locations from bowserLocationsDAO.php query, then provides a marker
    // for each location, with their bowser ID viewable on hover
    var marker, i;
    var lat, lng, locObj, bowserID ;
    var locations=[];
    $.post("bowserLocationsDAO.php","",function(data){
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
                    title: "Bowser ID: "+bowserID,
                    map: map
                });
                // marker on click
                marker.addListener("click", () => {
                    alert("Bowser ID: "+bowserID)
                });
            }
        });
    },"json");


// geo locate button - this allows the user to view their current location
    var infoWindow = new google.maps.InfoWindow();
    const locationButton = document.createElement("button");
    locationButton.textContent = "Pan to Current Location";
    locationButton.classList.add("custom-map-control-button");
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

// geo locate user button
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


// function to display the current time on the home page
function ShowTime() {
    // data class for time created using hours, minutes and seconds, followed by the month and year
    var date = new Date();
    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();
    var day = date.getDate();
    var month = date.getMonth() + 1;	// get.month returns an interger between 0 (Jan) and 11 (Dec).
    //first month is represented as 0, so + 1 required
    var year = date.getFullYear();

    hour = updateTime(hour);    // defines where to place '0' in function below
    min = updateTime(min);
    sec = updateTime(sec);
    month = updateTime(month);
    year = updateTime(year);

    // 'clock' id called and 'innerText' used to placing string of the time in the span.
    document.getElementById("clock").innerText = day + '-' + month + '-' + year + ' | ' + hour + " : " + min + " : " + sec;
    var t = setTimeout(function(){ ShowTime() }, 1000);
}
// function to place a '0' before the digit, if under 10 (e.g 09:08)
function updateTime(k) {
    if (k < 10) {             // if the digit is less than 10
        return "0" + k;         // place a '0' before the digit
    }
    else {
        return k;
    }
}
ShowTime(); // call the function