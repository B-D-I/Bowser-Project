<?php

session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    include "../include/config.php";

}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="../global/global.css" type="text/css">
    <link rel="stylesheet" href="maintenance.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="../images/logo/bowserLogo.png">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--google maps api-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <title>Water Bowser</title>
</head>

<body>

<!---html anchor to return to top of page-->
<p id="back_to_top"></p>

<div class="container">
    <div class="nav-wrapper">
        <div class="left-side">
            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="../home/index.php">Home</a>
            </div>

            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="maintenance.php">Maintenance</a>
            </div>
        </div>

        <div class="middle">
            <h2 class="text-focus-in">Bowser Hub</h2>
        </div>

        <div class="right-side">
            <div class="nav-link-wrapper">
                <!--right navbar--->
                <?php
                if (isset($_SESSION['email'])) {
                    echo "<div class='nav-link-wrapper' id='logoutTab'>";
                    echo "<a href='../home/logout.php'>Logout</a>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="upperPage">
        <div class="shadow-sm p-3 mb-5 bg-body rounded">
            <div class="row">
                <div class="col">

                    <h2> Requirements:</h2>
                    <br />

                    <ul class="maintenance_list">

                        <br />

                        <?php
                        $sql1="SELECT * FROM `tbl_user_account` WHERE email='$email'";
                        $result = mysqli_query($connection, $sql1);
                        $rows = mysqli_fetch_array($result);
                        $userID = $rows["User_ID"];

                        echo "<h4>User: &nbsp;".$email." <br />ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$userID."</h4>";
                        ?>

                        <br /><br />
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" >
                            <label class="form-check-label">
                                02/02/2022, Cheltenham - bowser 005 needs refilling
                            </label>
                        </div>

                        <br />
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" >
                            <label class="form-check-label">
                                02/02/2022, Cheltenham - bowser 012 has a fault
                            </label>
                        </div>

                        <br />
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" >
                            <label class="form-check-label" >
                                02/02/2022, Cheltenham - bowser 011 is leaking
                            </label>
                        </div>

                        <br />
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" >
                            <label class="form-check-label" >
                                02/02/2022, Cheltenham - bowser 004 needs refilling
                            </label>

                            <br />
                    </ul>
                    <br /><br />

                    <button type="button" class="btn btn-primary">Task Complete</button>
                    <br />
                </div>

                <div class="col">
                    <div class="text_area">
                        <h2>Bowser Map</h2>
                        <br />
                        <!--div to display map--->
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <br /><br /><br /><br /><br />

        <!-- Link back to top of page -->
        <p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
        <br />  <br />

        <script src="maintenance.js"></script>
        <script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initMap" async defer> </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>