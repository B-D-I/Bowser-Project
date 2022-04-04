// JavaScript Document
//This is the callback function provided to google to upload the map.
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