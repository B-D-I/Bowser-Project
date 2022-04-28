<?php
include "../include/config.php";

session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
include '../include/handler.php';
$selBowserID = '';
$selMaintID = '';

$filter = NULL;
if(!empty($_POST['filter']))
$filter = $_POST['filter'];
$_SESSION["filter"] = $filter;
if (empty($filter)){
   $boweser_query = "SELECT * FROM `tbl_bowsers` where bowserid";
} else {
	$boweser_query = "SELECT * FROM `tbl_bowsers` where bowserid in (select bowser_id from tbl_bowser_inuse)";
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
    <link rel="stylesheet" href="operations.css" type="text/css">
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

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <title>Water Bowser Operations</title>
</head>

<body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!---html anchor to return to top of page-->
<p id="back_to_top"></p>
<!--NAV-->
<div>
    <div class="nav-wrapper">
        <div class="left-side">
            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" id="homeLink" href="../home/index.php">Home</a>
            </div>

            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="operations.php">Operations</a>
            </div>
        </div>

        <div class="middle">
            <h2 class="text-focus-in" id="navTitle">Bowser Hub</h2>
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
                    <ul class="operations-list">
                        <h3 class="text-focus-in"> Maintenance Schedule</h3>
                        <br />
                        <form action="" method="POST">
                            <div class="input-group mb-3">
                                <?php
                                $_SESSION['query'] = 'SELECT * FROM tbl_maintenance_schedule WHERE Maintenance_ID LIKE "%{TERM}%" LIMIT 25';
                                ?>
                                <input type="text" name="term" id="term" class="form-control" placeholder="Search Tasks">
                                <script type="text/javascript">
                                    $(function() {
                                        $( "#term" ).autocomplete({
                                            source: '../include/dbsearch.php',
                                        });
                                    });
                                </script>
                                <button type="submit" name="submit" class="btn btn-primary">Search</button>
                            </div>
                            <?php
                            if (isset($_POST['submit']) ) {
                                if(!empty($_POST['term'])){
                                    $connection = OpenConnection();
                                    $sql = "SELECT * FROM tbl_maintenance_schedule WHERE Maintenance_ID ='".$_POST['term']."'";
                                    $result = mysqli_query($connection,$sql);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        if (mysqli_num_rows($result) > 0){
                                            $selMaintID = $_POST['term'];
                                        } else {
                                            $selMaintID = '0';
                                        }
                                    } CloseConnection($connection);
                                }
                            }
                            ?>
                        </form>
<!--Maintenance tasks div-->
                        <div id="searchedTask">
                            <?php
						$connection = OpenConnection();
                        $sql="SELECT * FROM tbl_maintenance_schedule WHERE Maintenance_ID = '$selMaintID'";
    					$result = mysqli_query($connection,$sql);
						while($row = mysqli_fetch_assoc($result)) {
                            if (mysqli_num_rows($result) > 0){
                                echo "<h4>Maintenance ID: " .$row['Maintenance_ID']. "</h4><br />";
                                echo $row['Task_Type']. "<br />";
                                echo "Description: " .$row['Description']. "<br />";
                                echo "Status: " .$row['Status']. "<br />";
                                echo "Date: " .$row['Date']. "<br />";
                                echo "<br />";
                                echo "Assigned: " .$row['Assigned_To']. "<br />";
                                echo "Area: " .$row['Area_ID']. "<br />";
                            }
						}
                        ?>
                        </div>
                        <br />
                        <?php
                        $connection = OpenConnection();

                        $sql="SELECT * FROM tbl_maintenance_schedule ORDER BY Date DESC LIMIT 10 ";
                        $result = mysqli_query($connection, $sql);
                        $row = mysqli_fetch_array($result);

                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<li id='listItem'" .$row['Date'] ."<br />";
                            echo "User: ".$row['Assigned_To']."&nbsp"."Area: ".$row['Area_ID']."<br />";
                            echo "Status: ". $row['Status'];
                            echo "<br /><a href='#' data-toggle='popover' title='".$row['Description']."' data-content='test'>Description</a> ";
                            echo "<br /><br /></li>";
                        }
                        ?>
                        <script>
                            $(document).ready(function(){
                                $('[data-toggle="popover"]').popover();
                            });
                        </script>

                    </ul>
                    <br />
<!--View bowser requests-->
                    <div id="requestAlerts">
                    <h4>Externally Requested Bowsers:</h4>
                    <br />
                        <?php
                        $connection = OpenConnection();
                        $sql = "SELECT Organisation_Name FROM tbl_company_representative WHERE Email = '$email'";
                        $result = mysqli_query($connection,$sql);
                        $rows = mysqli_fetch_array($result);
                        $company = $rows["Organisation_Name"];

                        $sql2 = "SELECT * FROM tbl_bowser_requests WHERE Organisation_Name = '$company' AND Status = 'Pending'";
                        $result2 = mysqli_query($connection, $sql2);
                        $row2 = mysqli_fetch_array($result2);
                        while($row2 = mysqli_fetch_assoc($result2)) {
                            $requestID = $row2['RequestID'];
                            $capacity = $row2['Bowser_Capacity'];
                            $organisation = $row2['Organisation_From'];
                            echo '<form method="post" action="bowserRequestDAO.php" >';
                            ?>
                            <input type='hidden' name='requestID' value='<?php echo "$requestID";?>'/>
                            <input type='hidden' name='capacity' value='<?php echo "$capacity";?>'/>
                            <!--CURRENT USER COMPANY--->
                            <input type='hidden' name='company' value='<?php echo "$company";?>'/>
                            <!---COMPANY REQUESTED BOWSER-->
                            <input type='hidden' name='organisation' value='<?php echo "$organisation";?>'/>
                        <?php
                            echo "<h5>From: ".$organisation."</h5><br />";
                            echo $row2['Bowser_Capacity']."L Bowser<br />";
                            echo "Level: ".$row2['Priority']." Priority<br />";
                            echo "Request Reason: ".$row2['Request_Reason']."<br />";
                            echo '    <br />                      
                                   <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                      <button class="btn btn-success me-md-2" type="submit" name="acceptButton" value="Accept">Accept</button>
                                      <button class="btn btn-danger" type="submit" name="denyButton" value="Deny">Deny</button>
                                    </div>
                            ';
                            echo "</form>";
                            echo "<br />";
                        }
                        ?>
                    </div>
                    <br />
                </div>

                <div class="col">
                    <div class="row">
                        <div id="text_area">
                            <?php
                            $connection = OpenConnection();
                            $email = $_SESSION['email'];
                            $sql1="SELECT * FROM `tbl_user_account` WHERE email='$email'";
                            $username = current(explode('@', $email));
                            $result = mysqli_query($connection, $sql1);
                            $rows = mysqli_fetch_array($result);
                            $userID = $rows["User_ID"];
                            echo "<h4>User&nbsp;".$username."</h4>";
                            echo "<h4>ID:&nbsp;".$userID."</h4>";
                            CloseConnection($connection);
                            ?>
                        </div>
                    </div>
                    <br />
<!--div to display map--->
                    <div id="viewMap">

                    <form id="formInsertEvent" method="post" enctype="multipart/form-data" >
                        <h5>Deploy Bowser</h5><br />

                        <div class="mapDiv" id="map" name="maps" onClick="markerLocation()"> </div>

                        <label>Bowser ID:</label>
                        <br />
                        <div id="bowserInsertion">
                        <div class="select">
                                <select name="bowserForInsert" id="select">
                                    <?php
                                    $connection = OpenConnection();
                                    $sql = "SELECT * FROM `tbl_bowsers` WHERE Status='Stock'";
                                    $result = mysqli_query($connection, $sql);
                                    $rows = mysqli_fetch_array($result);
                                    echo "<option value='-1' disabled selected>---</option>";
                                    if ($result->num_rows > 0) {
                                        while ($rows = $result->fetch_assoc()) {
                                            echo "<option value='".$rows['BowserID']."'>".$rows['BowserID']."</option>";
                                        }
                                    }
                                    CloseConnection($connection);
                                    ?>
                                </select>
                        </div>
                        </div>

                        <div class="Coordinates">
                            <input type="text" id="locationLat" name="Llat" hidden>

                            <input type="text" id="locationLng" name="Llng" hidden>

                            <input type="text" id="locationComb" class="remove_outline" hidden>
                        </div>

                        <div id="insertButton">
                            <button type="submit" name="submitBowser" class="btn btn-primary ">Add Bowser</button>
                        </div>

                    </form>
                    </div>
<!--Allocate Tasks-->
                        <br />
                        <div id="taskAllocation">

                        <div method="post" action="allocateTaskDAO.php" id="formAllocateTask">
                            <h5>Assign Maintenance Task</h5>
                        <br />
                            <div id="bowserID">
                                <label>Bowser ID:</label>
                                <br />
                                <div class="select">
                                  <p>
                                    <select name="bowserID" id="select">
                                      
                                      <?php
                                        $connection = OpenConnection();
                                        $sql = $boweser_query;
                                        $result = mysqli_query($connection, $sql);
                                        $rows = mysqli_fetch_array($result);

                                        echo "<option value='-1' disabled selected>---</option>";
                                        if ($result->num_rows > 0) {
                                            while ($rows = $result->fetch_assoc()) {
                                                echo "<option value='".$rows['BowserID']."'>".$rows['BowserID']."</option>";
                                            }
                                        }
                                        CloseConnection($connection);
                                        ?>
                                    </select>
                                </div>

									<label for="filter">Show Only Deployed Bowsers</label>
                                    <input type="checkbox" name="filter" form="Filter" value="filter" onchange="this.form.submit()" <?php if(!empty($_SESSION["filter"])){echo "checked";} ?>></input>
                            </div>
                            <br />
                            <div id="maintenanceID">
                                <label>Maintenance Worker:</label>
                                <br />
                                <div class="select">
                                    <select name="workerID" id="select">
                                        <?php
                                        $connection = OpenConnection();
                                        $sql ="SELECT * FROM `tbl_user_account` WHERE User_Type='Maintenance'";
                                        $result = mysqli_query($connection, $sql);
                                        $rows = mysqli_fetch_array($result);

                                        echo "<option value='-1' disabled selected>---</option>";
                                        if ($result->num_rows > 0) {
                                            while ($rows = $result->fetch_assoc()) {
                                                echo "<option value='".$rows['User_ID']."'>".$rows['Email']."</option>";
                                            }
                                        }
                                        CloseConnection($connection);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div id="taskID">
                                <label>Task Type</label>
                                <div id="taskType" class="select">
                                    <select name="task" id="select">
                                        <option value='-1' disabled selected>---</option>
                                        <option value="Refill">Refill</option>
                                        <option value="Repair">Repair</option>
                                        <option value="Service">Service</option>
                                        <option value="Deliver">Deliver</option>
                                        <option value="Collect">Collect</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <br />
                            <div id="priorityID">
                                <label>Priority</label>
                                <div id="priorityMenu" class="select">
                                    <select name="priority" id="select">
                                        <option value='-1' disabled selected>---</option>
                                        <option value="3">High</option>
                                        <option value="2">Medium</option>
                                        <option value="1">Low</option>
                                    </select>
                                </div>
                            </div>

                            <br />
                            <div id="dateID">
                                <label>Date:</label>
                                <br />
                                <input type="date" id="dateID" name="date">
                            </div>
                            <br />
                            <div class="form-floating" id="formID">
                                <textarea class="form-control" name="description" placeholder="description"style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
                            <br /><br />
                            <div id="allocateSubmitID">
                                <button type="submit" name="allocateTaskSubmit" class="btn btn-primary">Assign Task</button>
                            </div>
                        </form>
						<form action="operations.php" method="post" id="Filter">
						</form>
                    </div>
                    </div>
                    <br />

<!--Buttons-->
                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="modalButton" >
                            <a class="text-focus-in" href="javascript:popUpWindow('reports.php','heatmap','900','500')" class="remove_outline" ><h3 id="buttonTxt">Reports</h3></a>
                        </div>
                    </div>
                    <br />
                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="modalButton" >
                            <a class="text-focus-in" href="javascript:popUpWindow('admin.php','admin','900','500')" class="remove_outline" ><h3 id="buttonTxt">Admin</h3></a>
                        </div>
                    </div>
                    <br />
                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="modalButton" >
                            <a class="text-focus-in" class="remove_outline" href="javascript:popUpWindow('../bowsers/bowsers.php','bowsers','900','500')"><h3 id="buttonTxt">Bowsers</h3></a>
                        </div>
                    </div>
                    <br />
                </div>

<!-- Add Bowser Modal -->
    <div class="modal fade" id="addBowserModal" tabindex="-1" aria-labelledby="addBowserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBowserModalLabel">Add Bowser</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="addBowsersDAO.php">
                                <div class="mb-3">
                                <div id="capacityID">
                                    <label>Capacity</label>
                                    <div class="select">
                                        <select name="Capacity" id="select">
                                            <option value='-1' disabled selected>---</option>
                                            <option value="500">500L</option>
                                            <option value="1000">1000L</option>
                                            <option value="5000">5000L</option>
                                            <option value="10000">10,000L</option>
                                            <option value="15000">15,000L</option>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <br /><br />
                                <div id="submitRegiser">
                                    <button type="submit" name="newBowserSubmit" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <br /><br />
<!-- Link back to top of page -->
<p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
<br />  <br />

<script src="operations.js"></script>
<script src ="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv17Pa1iXPZVBV4q4uGYCtESCD2evyHg8&sensor=false&libraries=visualization&callback=initialize" async defer> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>