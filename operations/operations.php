<?php
include "../include/config.php";

session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
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
                <a class="text-focus-in" href="operations.php">Operations</a>
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

                    <ul class="operations-list">
                        <h3 class="text-focus-in"> Upcoming Maintenance Scheduled</h3>

                        <br />
<!--                        <div class="mb-3">-->
<!--                            <input type="search" class="form-control" placeholder="Search" id="exampleInputEmail1" aria-describedby="emailHelp">-->
<!--                            <button type="button" class="btn btn-primary btn-sm">OK</button>-->
<!--                            <button type="button" class="btn btn-secondary btn-sm">Filters</button>-->
<!--                        </div>-->
                        <form action="" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <br />
                        <?php
                        $connection = OpenConnection();
//                        if(isset($GET['search'])){
//                            $filtervalues = $_GET['search'];
//                            $query = "SELECT * FROM tbl_maintenance_schedule WHERE CONCAT(assignedTo,Area_ID,Status) LIKE '%$filtervalues%' ";
//                            $query_run = mysqli_query($connection, $query);
//
//                            if(mysqli_num_rows($query_run) > 0)
//                            {
//                                foreach($query_run as $items)
//                                {
//                                    ?>
<!--                                    <tr>-->
<!--                                        <td>--><?//= $items['Date']; ?><!--</td>-->
<!--                                        <td>--><?//= $items['assignedTo']; ?><!--</td>-->
<!--                                        <td>--><?//= $items['Area_ID']; ?><!--</td>-->
<!--                                        <td>--><?//= $items['Status']; ?><!--</td>-->
<!--                                    </tr>-->
<!--                                    --><?php
//                                }
//                            }
//                            else
//                            {
//                                ?>
<!--                                <tr>-->
<!--                                    <td colspan="4">No Record Found</td>-->
<!--                                </tr>-->
<!--                                --><?php
//                            }
//                        }



                        $sql="SELECT * FROM tbl_maintenance_schedule ORDER BY Date DESC ";
                        $result = mysqli_query($connection, $sql);
                        $row = mysqli_fetch_array($result);

                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<li id='listItem'" .$row['Date'] ."<br />";
                            echo "User: ".$row['assignedTo']."&nbsp"."Area: ".$row['Area_ID']."<br />";
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

                </div>

                <div class="col">
                    <div class="row">
                        <div id="text_area">
                            <?php
                            $connection = OpenConnection();
                            $email = $_SESSION['email'];
                            $sql1="SELECT * FROM `tbl_user_account` WHERE email='$email'";
                            $result = mysqli_query($connection, $sql1);
                            $rows = mysqli_fetch_array($result);
                            $userID = $rows["User_ID"];
                            echo "<h4>User&nbsp;".$userID.":&nbsp;&nbsp;&nbsp;".$email."</h4>";
                            CloseConnection($connection);
                            ?>
                            <br />
                            <button class="btn btn-primary" id="registerLink" href="#registerNewUserModal" data-bs-toggle="modal" >Register New User</button>
                            <button class="btn btn-primary" id="loanLink" href="#requestBowserModal" data-bs-toggle="modal" >Loan Bowser</button>
                            <button class="btn btn-primary" id="bowserLink">Bowser Information</button>
                        </div>
                    </div>

                    <br />
                    <div class="vibrate-2">
                    <div class="d-grid gap-2" id="viewReports" >
                        <a class="text-focus-in"  href="javascript:popUpWindow('../reportFeed/reportFeed.php','reports','630','480')" class="remove_outline"><h3 id="reportTxt">View Reports</h3></a>
                    </div>
                    </div>
                    <br />

                    <!--Allocate Tasks--->
                    <div class="row" id="new_tasks">
                        <h3>Allocate New Maintenance Task</h3>
                        <br /><br />

                        <form method="post" action="allocateTaskDAO.php" id="formAllocateTask">
                            <br />
                            <div id="bowserID">
                            <label>Bowser ID:</label>
                            <br />
                            <div class="select">
                                <select name="bowserID" id="select">

<!--                                    <input type="text" id="bowserIDs" name="bowser_name">-->
                                    <?php
                                    $connection = OpenConnection();
                                    $sql ="SELECT * FROM `tbl_bowser_stock` WHERE Bowser_Status='Stock'";
                                    $result = mysqli_query($connection, $sql);
                                    $rows = mysqli_fetch_array($result);

                                    echo "<option value='-1' disabled selected>---</option>";
                                    if ($result->num_rows > 0) {
                                        while ($rows = $result->fetch_assoc()) {
                                            echo "<option value='".$rows['Bowser_ID']."'>".$rows['Bowser_ID']."</option>";
                                        }
                                    }
                                    CloseConnection($connection);
                                    ?>

                                </select>
                            </div>
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
                                <select name="Task" id="select">
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
                                <select name="Priority" id="select">
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
                            <button type="submit" name="allocateTaskSubmit" class="btn btn-primary">ADD</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <br />

            <div class="row">
                <div class="col">

                    <!-- Modal -->
                    <div class="modal fade" id="requestBowserModal" tabindex="-1" aria-labelledby="requestBowserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="requestBowserModalLabel">Request Bowser</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">

                                            <form method="post" id="formBowserRequest">
                                                <div class="mb-3">

                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="Reason" placeholder="Reason for Request"style="height: 100px"></textarea>
                                                        <label for="floatingTextarea2">Reason for Request</label>
                                                    </div>

                                                    <label>Organisation</label>
                                                    <div class="select">
                                                        <select name="Organisation" id="select">
                                                            <option value="CompanyA">Company A</option>
                                                            <option value="CompanyB">Company B</option>
                                                            <option value="CompanyC">Company C</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="col">
                                                    <label>Capacity</label>
                                                    <div class="select">
                                                        <select name="Capacity" id="select">
                                                            <option value="1000">1000L</option>
                                                            <option value="5000">5000L</option>
                                                            <option value="10000">10,000L</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br /> <br />
                                                <div class="col">
                                                    <label>Priority</label>
                                                    <div class="select">
                                                        <select name="Priority" id="select">
                                                            <option value="3">High</option>
                                                            <option value="2">Medium</option>
                                                            <option value="1">Low</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br /><br /><br />

                                                <button type="submit" name="requestBowserSubmit" class="btn btn-secondary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>

                <div class="col">

                    <!-- Modal -->
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
                                                <br /><br /><br />

                                                <button type="submit" name="registerAccountSubmit" class="btn btn-secondary">Submit</button>
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

<br /><br /><br /><br /><br />

<!-- Link back to top of page -->
<p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
<br />  <br />

<script src="operations.js"></script>
<script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initMap" async defer> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>