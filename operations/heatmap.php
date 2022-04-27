<?php
?>

<!doctype html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../global/global.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" type="image/x-icon" href="../images/logo/bowserLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../global/global.css" type="text/css">

    <!--google maps api-->
    <!--    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
    <title>Water Bowser</title>
</head>

<body>

<!---html anchor to return to top of page-->
<p id="back_to_top"></p>

<div class="upperPage">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="row">
            </div>

            <div class="col">
                <div class="maintenance_list">
                    <h2>Reports Heatmap</h2>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

            <br /><br />
    <script src="operations.js"></script>
    <script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv17Pa1iXPZVBV4q4uGYCtESCD2evyHg8&sensor=false&libraries=visualization&callback=heatMap" async defer> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>