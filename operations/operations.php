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
                <a class="text-focus-in" href="../operations/operations.html">Operations</a>
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
                        <h3> Upcoming Maintenance Scheduled</h3>
                        <br />
                        <div class="mb-3">
                            <input type="search" class="form-control" placeholder="Search" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <button type="button" class="btn btn-primary btn-sm">OK</button>
                            <button type="button" class="btn btn-secondary btn-sm">Filters</button>
                        </div>
                        <br />
                        <li id="rando"> 02/02/2022 <br />
                            #TaskID - GL51 1EP <br />
                            -- Maintenance <br />
                            -- Allocated: Rando Mando
                        </li>
                        <br />
                        <li> 02/02/2022 <br />
                            #TaskID - GL51 1DG <br />
                            -- Refill <br />
                            -- Not Allocated</li>
                        <br />
                        <li> 03/02/2022 <br />
                            #TaskID - GL51 1DG <br />
                            -- Maintenance <br />
                            -- Not Allocated</li>
                        <br />
                        <li> 03/02/2022 <br />
                            #TaskID - GL51 1DG <br />
                            -- Maintenance <br />
                            -- Not Allocated</li>
                        <br />
                    </ul>
                    <br />
                </div>

                <div class="col">
                    <div class="row">
                        <?php
						$connection = OpenConnection();
						$email = $_SESSION['email'];
                        $sql1="SELECT * FROM `tbl_user_account` WHERE email='$email'";
                        $result = mysqli_query($connection, $sql1);
                        $rows = mysqli_fetch_array($result);
                        $userID = $rows["User_ID"];
                        echo "<h4>User: &nbsp;".$email." <br />ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$userID."</h4>";
						CloseConnection($connection);
                        ?>
                        <div class="text_area">
                            <h3>Details</h3>
                            <h4>#TaskID</h4><br />
                            <h4>-- Maintenance <br />
                                -- Allocated: Rando Mando</h4>
                        </div>
                    </div>
                    <br /><br />
                    <div class="row" id="new_tasks">
                        <h3>Allocate New Maintenance Task</h3>
                        <br /><br />
                        <form action="">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bowser ID
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">001</a></li>
                                    <li><a class="dropdown-item" href="#">002</a></li>
                                    <li><a class="dropdown-item" href="#">003</a></li>
                                </ul>
                            </div>
                            <br /><br />

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Worker
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">Tom</a></li>
                                    <li><a class="dropdown-item" href="#">Mary</a></li>
                                    <li><a class="dropdown-item" href="#">Carl</a></li>
                                </ul>
                            </div>
                            <br /><br />

                            <label for="">Date:</label>
                            <input type="date" id="" name="">
                            <br /><br />

                            <button type="button" class="btn btn-primary">ADD</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">

                    <button class="btn btn-secondary" id="registerLink" href="#requestBowserModal" data-bs-toggle="modal" >Request New Bowser</button>
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
                    <button type="button" class="btn btn-secondary">Open Bowser Spreadsheet</button>
                </div>

                <div class="col">
                    <button class="btn btn-secondary" id="registerLink" href="#registerNewUserModal" data-bs-toggle="modal" >Register New User</button>

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