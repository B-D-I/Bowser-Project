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



// function search_tasks(){
//     let input = document.getElementById('search_bar').value
//     input = input.toLowerCase();
//     let x = document.getElementById('db_div');
//
//     for (i = 0; i < x.length; i++){
//         if (!x[i].innerHTML.toLowerCase().includes(input)){
//             x[i].style.display="none";
//         }
//         else {
//             x[i].style.display="div";
//         }
//     }
// }



// JavaScript Document
//This is the callback fucntion provided to google to upload the map.
function initMap(){
    var map=new google.maps.Map(document.getElementById('map'),{
        zoom:14,
        center:{lat:51.8979988098144, lng:-2.0838599205017}
    });
    //We are going to load geo locations from the database.
    var lat, lng, locObj ;
    var locations=[];
    $.post("HeatMap.php","",function(data){
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
        //debug locations
        //console.log(locations);

    },"json");

    //This is the start of heatmap code
    var heatmap=new google.maps.visualization.HeatmapLayer(
        {
            data:locations,
            map:map
        }
    );
}