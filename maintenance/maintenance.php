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
$sql = "SELECT * FROM tbl_maintenance_schedule WHERE Assigned_To = '$User_ID' AND Status <> 'Completed'";
$query = mysqli_query($connection, $sql);
$job = mysqli_fetch_assoc($query);
// CloseConnection($connection);


// url parameters
if(isset($_GET['id'])){
    $id= $_GET['id'];
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
    <link rel="stylesheet" href="maintenanceCSS.php" type="text/css">
    <link rel="icon" type="image/x-icon" href="../images/logo/bowserLogo.png">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Moonrocks&family=Rubik+Puddles&display=swap" rel="stylesheet">

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

<div>
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
            <h2 class="text-focus-in" id="navTitle">Bowser Hub</h2>
            <div id="logo">
                <img id="logo_image" src="../images/logo/bowserLogo.png" alt="" width="100" height="100">
            </div>
            <!--WATER DROPS-->
            <div class="drop"></div>
            <div class="wave"></div>
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

                                        $jobStatus = $row['Status'];

                                        echo "<div class='form-check'>";
                                        echo "<label class='form-check-label'>";
                                        echo "Bowser ", $row['Bowser_ID']," - " ,$row['Date'], " ", "<span class = status>",$jobStatus,"</span>";
                                        echo "</label>";

                                        echo "<button type='button' class='btn btn-link' data-toggle='popover' data-html = 'true' 
                                        title= 'Description: $row[Description]  Area ID: $row[Area_ID] Priority $row[Priority] Task Type: $row[Task_Type]'  
                                        style='float:right;'>View Details</button>";

                                        echo "<br/><br/>";
                                        echo "<button type='button' class='btn btn-primary' style='float:right position:fixed; id='initialSubmit'>Task Complete</button>";

                                    //    In progress
                                       echo "<button type='button' class='btn btn-secondary' style='float:right position:fixed; id='taskInProgress'>Task In Progress</button>";


                                    //    Alerts for each task
                                       echo "<div class = 'alert alert-primary alert-dismissible'>";
                                       echo"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
                                    <path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                                    </svg>";
                                       echo  "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                                       echo "Are you sure you want to submit task $row[Maintenance_ID]?";
                                       echo "<br/><br/>";

                                    //    Setting url parameter for submitting task
                                       echo "<form action='maintenance.php?id=$row[Maintenance_ID]' method='post'>";
                                       echo "<button class = 'btn btn-secondary' type='submit' name='submit' value='Submit'> Yes, submit </button> ";
                                       echo "</form>";

                                       echo "</div>";
                                    
                                    //    Closing tags and underline styling for tasks
                                       echo "<hr>";
                                    echo "</div>";
                                    echo "<br/>";
                        }

                                    //    Submitting task if url parameter is set
                                    if(isset($id)){
                                        $submitSQL = "UPDATE tbl_maintenance_schedule SET Status = 'Completed' WHERE maintenance_ID='$id'";
                                        mysqli_query($connection, $submitSQL);

                                        $date = $row['Date'];
                                        $bowserID = $row['Bowser_ID'];
                                        $type = $row['Task_Type'];
                                        $area = $row['Area_ID'];
                                        $fixNoticeText = "On ".$date."&nbsp;&nbsp;Bowser: ".$bowserID."&nbsp;has undertaken a ".$type;

                                        $sql = "INSERT INTO `tbl_notifications` (Notice_Text, Area_ID, Type) VALUES ('$fixNoticeText', '$area', 2) ";
                                        $connection = OpenConnection();
                                        if (mysqli_query($connection, $sql)) {
//                                            echo "success";
//                                            header("Location: ../maintenance/maintenance.php");
                                        } else {
                                            echo mysqli_error($connection);
                                        }
                                        mysqli_close($connection);
                                    }
                        ?>
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