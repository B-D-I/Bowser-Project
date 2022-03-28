<?php
include "../include/config.php";
session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
// Getting user ID and other user info from DB
$connection = OpenConnection();
$User_SQL = "SELECT * from tbl_user_account WHERE Email = '$email'";
$User_Query = mysqli_query($connection, $User_SQL);
$User = mysqli_fetch_assoc($User_Query);
$User_ID = $User['User_ID'];

//Getting Maintenence job info
$sql = "SELECT * FROM tbl_maintenance_schedule WHERE Assigned_To = '$User_ID'";
$query = mysqli_query($connection, $sql);
$job = mysqli_fetch_assoc($query);
// CloseConnection($connection);



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
            <div id="logo">
                <img id="logo_image" src="../images/logo/bowserLogo.png" alt="" width="100" height="100">
            </div>
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
                        <h4>User: <?php echo $email  ?> </h4>

                        <br /><br />
                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="popover"]').popover();
                            });
                        </script>
                        <?php

                        foreach($query as $row){
                                        // Getting details for detail view based on button ID
                                        $maintID = $row['Maintenance_ID'];
                                        $getDetailIDSQL = "SELECT * FROM tbl_maintenance_schedule WHERE Maintenance_ID = '$maintID'";
                                        $detailQuery = mysqli_query($connection, $getDetailIDSQL);
                                        $detailJob = mysqli_fetch_assoc($detailQuery);

                                        echo "<div class='form-check'>";
                                        // echo "<input class='form-check-input' type='checkbox' value='' >";
                                         echo "<label class='form-check-label'>";
                                        echo "Bowser ", $row['Bowser_ID']," - " ,$row['Description'];
                                        echo "</label>";

                                        echo "<button type='button' class='btn btn-link' data-toggle='popover' data-html = 'true' 
                                        title= 'Maintenance ID: $row[Maintenance_ID]  Bowser ID: $row[Bowser_ID] User ID: $row[User_ID] Description: $row[Description] Status: $row[Status]
                                         Date: $row[Date] Assigned To: $row[Assigned_To] Area ID: $row[Area_ID] Priority $row[Priority] Task Type: $row[Task_Type]'  
                                        style='float:right;'>View Details</button>";

                                       echo "<button type='button' class='btn btn-primary' style='float:right position:fixed;';>Task Complete</button>";
                                    echo "</div>";
                                    echo "<br/>";
                        }
                        ?>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Task: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Bowser: <?php echo $detailJob['Bowser_ID'] ?> </p>
        <p>Description: <?php echo $detailJob['Description'] ?></p>
        <p>Date: </p>
        <p>Area: </p>
        <p>Status: </p>
        <p>Submitted by: </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                      
                    <br /><br />

                    
               
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