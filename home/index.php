
<?php
// session start function
// variable assigned for user email
include "../include/config.php";

// if user is logged in set $email variable to current user email
session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
}
// use the current user email to retrieve the user's location and role / user type
if (isset($_SESSION['email'])) {
	$connection = OpenConnection();
    $sql = "SELECT * FROM tbl_user_account WHERE Email='$email'";
    $result = mysqli_query($connection,$sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userType = $row["User_Type"];
            $userLocation = $row["Location"];
	    CloseConnection($connection);
        }
    }
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
    <link rel="stylesheet" href="home.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="../images/logo/bowserLogo.png">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">

<!--    fonts and style for the page-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Moonrocks&family=Rubik+Puddles&display=swap" rel="stylesheet">

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>	
	
	<!-- jQuery UI -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	
    <!--google maps api-->
<!--    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
	<!--report screen functions -->
	<script type = "text/javascript" src="reportFuncs.js"></script>
	
    <title>Water Bowser</title>

</head>

<body>
<script>
	$('#reportModal').on('hidden.bs.modal', function (e) {
		$('#report').find("input[type=text], textarea").val("");
	})
</script>
<!---html anchor to return to top of page-->
<p id="back_to_top"></p>

<div>
<!--    nav bar to contain links to all pages, plus dynamic title -->
    <div class="nav-wrapper">
        <div class="left-side">

            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="index.php">Home</a>
            </div>
<!--            php is used to ensure only the pages relevant to the logged in user are viewable-->
            <?php
            if (isset($_SESSION['email'])){
            if ($userType == "Maintenance")
                echo '
                 <div class="nav-link-wrapper active-nav-link">
                    <a class="text-focus-in" href="../maintenance/maintenance.php">Maintenance</a>
                </div>
            ';}?>

            <?php
            if (isset($_SESSION['email'])){
            if ($userType == "Operations")
//                echo " ";
                echo '
                  <div class="nav-link-wrapper active-nav-link">
                    <a class="text-focus-in" href="../operations/operations.php">Operations</a>
                  </div>';
			}
			?>
<!--			report modal - to allow users to send bowser reports-->
            <div class="nav-link-wrapper">
            	<a class="text-focus-in" id="link" href="#reportModal" data-bs-toggle="modal">Report</a>
			</div>
			<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            	<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="reportModalLabel">Report Form</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
								<div class="row">
									<form action="" id="report" method="POST">
									<label for="select">Report Type:</label>
										<div class="select">
											<select name="Report_Type" class="" id="select" onchange="reportTypeCheck(this);">';
												<!-- Query to populate Report_Type select box -->
												<?php
													$connection = OpenConnection();
													$result = mysqli_query($connection, "SELECT id, description, is_bowser FROM tbl_report_type order by id asc;");
													echo "<option value='-1' disabled selected>---</option>";
													if (mysqli_num_rows($result) > 0){
														while($row = mysqli_fetch_assoc($result)) {
															echo "<option id='" . $row['is_bowser'] . "'value='".$row['id']."'>".$row['description']."</option>";
														}
													}
													CloseConnection($connection);
												?>
                                            </select>
										</div>
								</div>
								<br />
								<div class="row">
							        <label for="term">Bowser ID:</label>
									<!-- Method for auto completing Bowser ID and only permitting valid IDs -->
									<?php
										$_SESSION['query'] = 'SELECT * FROM tbl_bowser_inuse WHERE Bowser_ID LIKE "%{TERM}%" LIMIT 25';
									?>
					   				<input type="text" name="Bowser_ID" id="term" placeholder="Enter Bowser Serial Number...." class="form-control">
									<script type="text/javascript">
  										$(function() {
											$( "#term" ).autocomplete({
												appendTo: reportModal,
												source: '../include/dbsearch.php'
											});
										});
									</script>
								</div>
								<br />
								<!-- Description Textfield -->
								<div class="row">
	    	                		<label for="floatingTextarea2" class="form-label">Description</label>
    	    	                	<textarea class="form-control" name="Description" id="floatingTextarea2" style="height: 100px"></textarea>
                          		</div>
								<br />
								<!-- Footer including buttons to submit or close form -->
                            	<div class="modal-footer">
                        	    	<p>For assistance, contact us at:
										<a id="link" href="mailto:s4008324@glos.ac.uk">bowser-hub@email.com</a>
                                	</p>
									<br /><br />
                    	            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        	        <button type="button" class="btn btn-primary" name="submit" onclick="sendReport()">Send Report</button>
									</form>
                        		</div>
							</div>
						</div>
            		</div>
				</div>
			</div>
<!--    nav bar title with water droplets-->
    <div class="middle">
        <h2 class="text-focus-in" id="navTitle">Bowser Hub</h2>
        <div id="logo">
            <img id="logo_image" src="../images/logo/bowserLogo.png" alt="" width="100" height="100">
        </div>
        <!--WATER DROPS-->
        <div class="drop"></div>
        <div class="wave"></div>
    </div>
<!--right side of nav includes loggin, if not logged in, or logout if user is logged in-->
        <div class="right-side" >
<!--            confirm if user is logged in-->
            <?php
            if (isset($_SESSION['email'])){
                echo "<div class='nav-link-wrapper' id='logoutTab'>";
                echo "<a href='logout.php'>Logout</a>";
                echo "</div>";
            } else {
                $connection = OpenConnection();
                                    // login and registration modals
                echo '

            <div class="nav-link-wrapper" id="loginTab">
                <a class="" id="loginLink" href="#loginModal" data-bs-toggle="modal" >Login</a>
               
                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <form method="post" id="login_form">
                                            <div class="mb-3">
                                                <label for="loginInputEmail1" class="form-label">Email address</label>
                                                <input type="email" name="email" class="form-control" id="loginInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="loginInputPassword1" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="loginInputPassword1">
                                            </div>
                                            <button type="submit" id="loginSubmit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-link-wrapper" id="registrationTab">
                    <a class="" id="registerLink" href="#registerModal" data-bs-toggle="modal" >Registration</a>

                    <!-- Modal -->
                    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registerModalLabel">Registration</h5>
                                    <button type="button" class="btn-close" id="registerModalClose" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">

                                            <form method="post" id="formUserRegistration">
                                                <div class="mb-3">
                                                    <input type="email" name="email" class="form-control" placeholder="Email" id="registerInputEmail" aria-describedby="emailHelp">
                                                </div>

                                                <div class="mb-3">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" id="password_create">
                                                </div>

                                                <div class="mb-3">
                                                    <input type="password" name="re_password" class="form-control" placeholder="Repeat Password" id="password_confirm">
                                                </div>
                                                
                                                <div class="select">
                                                    <select name="userLocation" id="select">                                         
                                                       <option value="-1" disabled selected>Area</option>';
                                                        $sql = "SELECT * FROM `tbl_area` ";
                                                        $result = mysqli_query($connection, $sql);
                                                        $rows = mysqli_fetch_array($result);
                                                        if ($result->num_rows > 0) {
                                                            while ($rows = $result->fetch_assoc()) {
                                                                $areaName = $rows['Area_Name'];
                                                                echo "<option value='".$areaName."'>".$areaName."</option>";
                                                            }
                                                        }
                                                        echo'                                                      
                                                    </select>
                                                </div>

                                                <div id="account_submit_button">
                                                <button type="submit" id="registerAccountSubmit" class="btn btn-primary">Submit</button>
                                                <hr>
                                                </div>
                                            </form>

                                            <br />

                                            <p>Please check you email inbox for registration confirmation</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';}?>
        </div>
    </div>

    <!--The main section of page--->
    <div class="upperPage">
        <!---row for bowser info and faq buttons--->

        <div class="shadow-sm p-3 mb-5 bg-body rounded">
            <!---row for notifications and map--->
            <div class="row">
                    <div class="col">
                        <div>
                        <h2> Notifications and Alerts</h2><span id="clock">clock</span></div>
                        <ul class="notification-list">
<!--                            display all notifications relevant to users location-->
                            <?php
                            $connection = OpenConnection();
                            // different query dependent on user type
                            if (isset($_SESSION['email'])) {
                                if ($userType == "Operations" OR "Maintenance")
                                $sql2 = "SELECT * FROM `tbl_notifications` ORDER BY Date DESC LIMIT 10  ";
                                if ($userType == "Customer")
                                    $sql2 = "SELECT * FROM `tbl_notifications` WHERE Area_ID = '$userLocation' ORDER BY Date DESC LIMIT 10 ";
                            } else {
                                $sql2 = "SELECT * FROM `tbl_notifications` ORDER BY Date DESC LIMIT 10 ";
                            }
                            $result2 = mysqli_query($connection, $sql2);
                            $rows2 = mysqli_fetch_array($result);
                       // display notifications
                            while($rows2 = mysqli_fetch_assoc($result2)) {
                                $notificationType = $rows2['Type'];
                                switch($notificationType){
                                    case 1:
                                        $notificationDiv = "notificationFault";
                                        break;
                                    case 2:
                                        $notificationDiv = "notificationFix";
                                        break;
                                }
                                $notification = $rows2['Notice_Text'];
                                echo "<div id='$notificationDiv'>".$notification."</div>";
                                echo "<br />";
                            }
                            ?>
                        </ul>
                    </div>
<!--                    div to contain the google maps -->
                    <div class="col">
                        <div class="text_area">
                            <h2>Bowser Map</h2>
                            <p> Find local bowsers using the map below </p>
                            <!--div to display map--->
                            <div class="mapDiv" id="map"></div>
                        </div>
<!--                        pop up window for bowser information-->
                        <div class="row" id="bowserButtonDiv">
                            <!---bowser info--->
                            <div class="vibrate-2" id="viewBowserInformation" >
                                <a class="text-focus-in" class="remove_outline" href="javascript:popUpWindow('../bowsers/bowsers.php','bowsers','900','500')"><h3 id="reportTxt">Bowser Info</h3></a>
                            </div>
                        </div>
<!--                        pop up modal for FAQs-->
                        <div class="row" id="FAQButtonDiv">
                            <!---faqs-->
                            <div class="vibrate-2" id="viewFAQ" >
                                <a class="text-focus-in" href="#FAQModal" data-bs-toggle="modal" ><h3 id="reportTxt">FAQs</h3></a>
                            </div>
                        </div>
                        </div>

                </div>
            </div>
        </div>
                <!-- Modal for FAQs-->
                <div class="modal fade" id="FAQModal" tabindex="-1" aria-labelledby="FAQModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <h2>FAQs</h2><br />
                                        <p style="color: dodgerblue">HOW DO I VIEW NOTIFICATIONS AND ALERTS </p>
                                        <p>Check the notification news feed</p><br />
                                        <p style="color: dodgerblue">HOW DO I REPORT AN ISSUE? </p>
                                        <p>Click the reports tab and send us a query</p><br />
                                        <p style="color: dodgerblue">HOW DO MOVE THE MAP TO MY LOCATION? </p>
                                        <p>Click the 'Pan to Current Location' button above the map</p><br />
                                        <p style="color: dodgerblue">HOW DO I CONTACT YOU? </p>
                                        <p>For assistance, contact us at:
                                            <a id="link" href="mailto:s4008324@glos.ac.uk">bowser-hub@email.com</a>
                                        </p><br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <br />  <br />

        <!-- Link back to top of page -->
        <p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
        <br />  <br />

        <script src="home.js"></script>
        <script src="login.js"></script>
        <script src="register.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

	    <?php
	    $api_key = getAPI();
	    echo '<script src ="https://maps.googleapis.com/maps/api/js?key='.$api_key.'&sensor=false&libraries=visualization&callback=initMap" async defer> </script>';
	    ?>
</body>

</html>
