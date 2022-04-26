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
            <!--WATER DROPS-->
<!--            <div class="drop"></div>-->
<!--            <div class="wave"></div>-->
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
                        <br /><br />
                    </ul>
                    <br />

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
                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="viewInvoice" >
                            <a class="text-focus-in" href="#viewInvoiceModal" data-bs-toggle="modal" class="remove_outline" ><h3 id="reportTxt">View Invoices</h3></a>
                        </div>
                    </div>
                    <br />

                    <div class="vibrate-2">
                    <div class="d-grid gap-2" id="viewReports" >
                        <a class="text-focus-in" href="#viewReportModal" data-bs-toggle="modal" class="remove_outline"><h3 id="reportTxt">View Reports</h3></a>
                    </div>
                    </div>
                    <br />

                    <!--div to display map--->
                    <div class="d-grid gap-2" id="viewMap">

                    <form id="formInsertEvent" method="post" enctype="multipart/form-data" >
                        <h5>Deploy Bowser</h5><br />

                        <div id="map" name="maps" onClick="markerLocation()"> </div>

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

                        <br /><br />
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

                    <!--Buttons for Bowser Funcs--->
                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="viewLoanBowser" >
                            <a class="text-focus-in" href="#requestBowserModal" data-bs-toggle="modal" class="remove_outline" ><h3 id="reportTxt">Loan Bowser</h3></a>
                        </div>
                    </div>
                    <br />

                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="viewBowserInfo" >
                            <a class="text-focus-in" class="remove_outline" href="javascript:popUpWindow('../bowsers/bowsers.php','bowsers','900','500')"><h3 id="reportTxt">Bowser Operations</h3></a>
                        </div>
                    </div>
                    <br />
<!--                    <div class="vibrate-2">-->
<!--                        <div class="d-grid gap-2" id="viewAddBowser" >-->
<!--                            <a class="text-focus-in" href="#addBowserModal" data-bs-toggle="modal" class="remove_outline" ><h3 id="reportTxt">Add New Bowser</h3></a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <br />-->
                    <div class="vibrate-2">
                        <div class="d-grid gap-2" id="viewRegisterUser" >
                            <a class="text-focus-in" href="#registerNewUserModal" data-bs-toggle="modal" class="remove_outline" ><h3 id="reportTxt">Register New User</h3></a>
                        </div>
                    </div>
                    <br />
                </div>

            <div class="row">
                <div class="col">

                    <!-- Request Bowser Modal -->
                    <div class="modal fade" id="requestBowserModal" tabindex="-1" aria-labelledby="requestBowserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="requestBowserModalLabel">Bowser Loaning & Lending</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">

                                            <form method="post" id="formBowserRequest">
                                            <?php
                                                $connection = OpenConnection();
                                                $sql = "SELECT Organisation_Name FROM tbl_company_representative WHERE Email = '$email'";
                                                $result = mysqli_query($connection,$sql);
                                                $rows = mysqli_fetch_array($result);
                                                $company = $rows["Organisation_Name"];
                                                ?>

                                                <input type='hidden' name='company' value='<?php echo "$company";?>'/>

                                                <div class="mb-3">
                                                    <div id="transactionID">
                                                        <label>Transaction Type</label>
                                                        <div class="select">
                                                            <select name="Transaction" id="select">
                                                                <option value='-1' disabled selected>---</option>
                                                                <option value="Lend">Lend</option>
                                                                <option value="Loan">Loan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div id="organisationID">
                                                    <label>Organisation</label>
                                                    <div class="select">
                                                        <select name="Organisation" id="select">
                                                            <?php
                                                            $sql = "SELECT * FROM tbl_company_representative WHERE Email != '$email'";
                                                            $result = mysqli_query($connection,$sql);
                                                            $rows = mysqli_fetch_array($result);
                                                            $company = $rows["Organisation_Name"];

                                                            echo "<option value='-1' disabled selected>---</option>";
                                                            if ($result->num_rows > 0) {
                                                                while ($rows = $result->fetch_assoc()) {
                                                                    echo "<option value='".$rows['Organisation_Name']."'>".$rows['Organisation_Name']."</option>";
                                                                }
                                                            }
                                                            CloseConnection($connection);
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                </div>
                                                <br />
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
                                                <div id="loanPriorityID">
                                                    <label>Priority</label>
                                                    <div class="select">
                                                        <select name="Priority" id="select">
                                                            <option value='-1' disabled selected>---</option>
                                                            <option value="3">High</option>
                                                            <option value="2">Medium</option>
                                                            <option value="1">Low</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="Reason" placeholder="Reason for Request"style="height: 100px"></textarea>
                                                    <label for="floatingTextarea2">Reason for Request</label>
                                                </div>
                                                <br /><br />
                                                <div id="submitRegiser">
                                                <button type="submit" name="requestBowserSubmit" class="btn btn-secondary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>

                    <!-- Register User Modal -->
                    <div class="modal fade" id="registerNewUserModal" tabindex="-1" aria-labelledby="registerUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registerUserModalLabel">Register New User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">

                                            <form method="post" id="formUserRegistration">
                                                <div class="mb-3">
                                                    <input type="email" name="email" class="form-control" placeholder="Email" id="registerInputEmail" aria-describedby="emailHelp">
                                                </div>
                                                <div class="col">
                                                    <div class="select">
                                                        <select name="user_type" id="select">
                                                            <option value='-1' disabled selected>---</option>
                                                            <option value="Maintenance">Maintenance</option>
                                                            <option value="Operations">Operations</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br /><br />
                                                <div id="submitRegiser">
                                                <button type="submit" name="registerAccountSubmit" class="btn btn-secondary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--View Report Modal--->
<div class="modal fade" id="viewReportModal" tabindex="-1" aria-labelledby="viewReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerUserModalLabel">Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                            <br />


                <?php
                $connection = OpenConnection();
                $sql = "SELECT * FROM `tbl_reports` WHERE Status ='Pending'";
                $result = mysqli_query($connection, $sql);
                $rows = mysqli_fetch_array($result);

                while($rows = mysqli_fetch_assoc($result)) {
                    $reportType = $rows['Report_Type'];
                    $reportID = $rows['Report_ID'];
                    $bowserID = $rows['Bowser_ID'];
                    $description = $rows['Description'];
                    $date = $rows['Date'];
                    // trim date to 10 characters, removing time
                    $date = substr($date, 0,-8);

                    switch($reportType){
                    case 1:
                        $reportString = "Refill";
                        break;
                    case 2:
                        $reportString = "Repair";
                        break;
                    case 3:
                        $reportString = "Complaint";
                        break;
                    case 4:
                        $reportString = "Other";
                        break;
                }

                    echo '<form method="post" action="actionReportsDAO.php" >';
                    ?>
                    <!--POST VARIABLES--->
                    <input type='hidden' name='reportType' value='<?php echo "$reportType";?>'/>
                    <input type='hidden' name='reportString' value='<?php echo "$reportString";?>'/>
                    <input type='hidden' name='reportID' value='<?php echo "$reportID";?>'/>
                    <input type='hidden' name='bowserID' value='<?php echo "$bowserID";?>'/>
                    <input type='hidden' name='description' value='<?php echo "$description";?>'/>
                    <input type='hidden' name='date' value='<?php echo "$date";?>'/>
                    <?php
                    echo "<h5>Reported: ".$reportString."</h5><br />";
                    echo $date;
                    echo "<br />Bowser: ".$bowserID;
                    echo "<br />Description: <br />".$description;
                    echo '    <br />                      
                       <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                          <button class="btn btn-success me-md-2" type="submit" name="acceptButton" value="Accept">Action</button>
                          <button class="btn btn-danger" type="submit" name="denyButton" value="Deny">Ignore</button>
                        </div>
                ';
                    echo "</form>";
                    echo "<br />";
                }
                ?>
                            <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--viewInvoice Modal--->
    <div class="modal fade" id="viewInvoiceModal" tabindex="-1" aria-labelledby="viewInvoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewInvoiceModalLabel">Invoices</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                                <table id="invoiceTable">
                                    <tr>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Transaction&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Created By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Bowser ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Organisation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Charge (£)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    </tr>
                                    <?php
                                    $connection = OpenConnection();

                                    $sql ="SELECT * FROM `tbl_bowser_invoices`ORDER BY Date DESC LIMIT 25";
                                    $result = mysqli_query($connection, $sql);
                                    $rows = mysqli_fetch_array($result);

                                    if ($result->num_rows > 0) {
                                        while ($rows = $result->fetch_assoc()) {
                                            $invoiceID = $rows['InvoiceID'];
                                            $transaction = $rows['Transaction_Type'];
                                            $user = $rows['UserID'];
                                            $bowser = $rows['BowserID'];
                                            $organisation = $rows['Organisation_Name'];
                                            $price = $rows['Price'];
                                            echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rows['InvoiceID']."</td><td>".$rows['Transaction_Type']."</td>
                                            <td>".$rows['UserID']."</td><td>".$rows['BowserID']."</td><td>"
                                                .$rows['Organisation_Name']."</td><td>".$rows['Price']."</td></tr><br />";
                                        }
                                    }
                                    CloseConnection($connection);
                                    ?>
                                </table>
                            <br />
                    </div>
                </div>
            </div>
        </div>
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



<!-- Add Bowser Modal -->
<!--<div class="modal fade" id="viewRequestBowserModal" tabindex="-1" aria-labelledby="viewRequestBowserModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="viewRequestBowserModalLabel">Externally Requested Bowsers:</h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <div class="row">-->
<!--                                <div class="col">-->
<!--            <div id="requestAlerts">-->
<!---->
<!--                <form method="post" action="bowserRequestDAO.php">-->
<!--                    <br />-->
<!--                    --><?php
//                    $connection = OpenConnection();
//                    $sql = "SELECT Organisation_Name FROM tbl_company_representative WHERE Email = '$email'";
//                    $result = mysqli_query($connection,$sql);
//                    $rows = mysqli_fetch_array($result);
//                    $company = $rows["Organisation_Name"];
//
//                    $sql2 = "SELECT * FROM tbl_bowser_requests WHERE Organisation_Name = '$company'";
//                    $result2 = mysqli_query($connection, $sql2);
//                    $row2 = mysqli_fetch_array($result2);
//                    while($row2 = mysqli_fetch_assoc($result2)) {
//
//                        echo "<h5>Organisation: ".$row2['Organisation_Name']."</h5><br />";
//                        echo $row2['Bowser_Capacity']."L Bowser<br />";
//                        echo "Level: ".$row2['Priority']." Priority<br />";
//                        echo "Request Reason: ".$row2['Request_Reason']."<br />";
//                        echo '    <br />
//
//                                                <div class="form-check">
//                                                  <input class="form-check-input" type="radio" name="requestCheckBox" id="flexRadioDefault1">
//                                                  <label class="form-check-label" for="flexRadioDefault1">
//                                                    Accept
//                                                  </label>
//                                                </div>
//
//                                                <div class="form-check">
//                                                  <input class="form-check-input" type="radio" name="requestCheckBox" id="flexRadioDefault2">
//                                                  <label class="form-check-label" for="flexRadioDefault2">
//                                                    Deny
//                                                  </label>
//                                                </div>
//
//                                        ';
//                        echo "<br />";
//                    }
//                    ?>
<!--                    <div id="requestSubmit" class="d-grid gap-2 d-md-flex justify-content-md-end">-->
<!--                        <button name="requestButton" class="btn btn-danger" type="button">Update</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--                </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


    <br /><br />


<!-- Link back to top of page -->
<p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
<br />  <br />

<script src="operations.js"></script>
<script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initialize" async defer> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>