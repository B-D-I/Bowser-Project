	<?php
	// session start function
	// variable assigned for user email
	session_start();

	include '../include/config.php';
	include '../include/handler.php';
	$selBowserID = '';

	if (isset($_SESSION['email'])){
		$email = $_SESSION['email'];
	}

	if (isset($_SESSION['email'])) {
		$connection = OpenConnection();
		$sql = "SELECT * FROM tbl_user_account WHERE Email='$email'";
		$result = mysqli_query($connection,$sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$userType = $row["User_Type"];
				CloseConnection($connection);
			}
		}
	}

	// Define function to enable Filter checkbox
	$filter = NULL;
	if(!empty($_POST['filter']))
	$filter = $_POST['filter'];
	$_SESSION["filter"] = $filter;
	if (empty($filter)){
	   $_SESSION['query'] = 'SELECT * FROM tbl_bowsers WHERE BowserID LIKE "%{TERM}%"';
	} else {
		$_SESSION['query'] = 'SELECT * FROM tbl_bowsers WHERE BowserID LIKE "%{TERM}%" and BowserID in (select Bowser_ID from tbl_bowser_inuse) LIMIT 25';
	}

	// Default values for Google Map Points
	$row_bowserLat = 51.886;
	$row_bowserLng = -2.088;
	?>

	<!doctype html>
	<html>
		<head>
			<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<!-- CSS -->
			<link rel="stylesheet" href="../global/global.css" type="text/css">
			<link rel="stylesheet" href="bowsers.css" type="text/css">

			<!-- Fonts, Logos and Iconography -->
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

			<title>Water Bowser</title>
		</head>

		<body>
			<!-- Stop page refreshes on events -->
			<script>
				if ( window.history.replaceState ) {
					window.history.replaceState( null, null, window.location.href );
				}
			</script>

			<!---html anchor to return to top of page-->
			<p id="back_to_top"></p>	
			<div class="shadow-sm p-3 mb-5 bg-body rounded">
				<div class="row">
					<!-- Left Column used for Bowser Search and Maintenance Records -->
					<div class="col">
						<div class="bowser-list">
						<!--
							Bowser Information tables and forms 
							including event handling for filter
						-->
							<h2>Bowser Information</h2>
							<form action="" id="bowser" method="POST">
								<input type="text" name="term" id="term" form="bowser" placeholder="Enter Bowser Serial Number...." class="form-control">
								<input type="checkbox" name="filter"  value="filter" form="filter" onchange="this.form.submit()" <?php if(!empty($_SESSION["filter"])){
									echo "checked";
								} ?>> Show Deployed Bowsers Only
								<br /><br />
								<input type='submit' name='submit' form="bowser" value='View' class='btn btn-primary'>
							</form>  
							<form action="bowsers.php" id="filter" method="post">
							</form>
							<br />
							<!-- Autocomplete logic to display valid Bowser IDs -->
							<script>  
								$(function() {
									$( "#term" ).autocomplete({
										source: '../include/dbsearch.php',
									});
								});
							</script>
							<!-- PHP Script to submit form data, used to generate MySQL query to validate existance of Bowser ID -->
							<?php
								if (isset($_POST['submit']) ) {
									if(!empty($_POST['term'])){
										$connection = OpenConnection();
										$sql = "select bowserID from tbl_bowsers where bowserID ='".$_POST['term']."'";
										$result = mysqli_query($connection,$sql);
										while($row = mysqli_fetch_assoc($result)) {
											if (mysqli_num_rows($result) > 0){
												$selBowserID = $_POST['term'];
											} else {
												$selBowserID = '0';
											}
										} CloseConnection($connection);
									}
								}
							?>
							<br />
							<!-- PHP to Generate MySQL Query for Bowser Data to echo out, to display on-screen -->
							<?php
								$connection = OpenConnection();
								$sql = "SELECT bowserID, bowser_capacity, status, bowser_description, Lat, Lng, bowser_cost from tbl_bowsers where bowserID = '$selBowserID'";
								$result = mysqli_query($connection,$sql);
								while($row = mysqli_fetch_assoc($result)) {
									if (mysqli_num_rows($result) > 0){
										echo "<h4>Bowser " .$row['bowserID']. "</h4><br />";
										echo "Bowser Description: " .$row['bowser_description']. "<br />";
										echo "Bowser Capacity: " .$row['bowser_capacity']. "<br />";
										echo "Bowser Cost: " .$row['bowser_cost']. "<br />";
										echo "<br />";
										echo "Bowser Status: " .$row['status']. "<br />";
										echo "<br /><br />";
										$row_bowserID = $row['bowserID'];
										$row_bowserDescription = $row['bowser_description'];
										$row_bowserCapacity = $row['bowser_capacity'];
										$row_bowserCost = $row['bowser_cost'];
										$row_bowserStatus = $row['status'];
										$row_bowserLat = $row['Lat'];
										$row_bowserLng = $row['Lng'];
									}
								}
							?>
						</div>
						<br />
						<?php
							// Only Display Content if Logged in as Operations level user
							if (isset($_SESSION['email'])){
								if ($userType == "Operations"){
									echo '<div class="maintenance-list">
									<h4>Maintenance History</h4>';
									// Query to select bowser maintenance records, time taken calculation uses temporary tables to allow for additional queries
									$connection = OpenConnection();
									$sql=("
										DROP TABLE IF EXISTS difference_in_minutes;
										DROP TABLE IF EXISTS differences;

										CREATE TEMPORARY TABLE difference_in_minutes
										SELECT
											Bowser_ID,
											Maintenance_ID,
											Description,
											Status,
											Date,
											Completed_Date,
											TIMESTAMPDIFF(MINUTE, Date, Completed_Date) AS minutes
										FROM tbl_maintenance_schedule;

										CREATE TEMPORARY TABLE differences
										SELECT
											Bowser_ID,
											Maintenance_ID,
											Description,
											Status,
											Date,
											Completed_Date,
											MOD(minutes, 60) AS minutes_part,
											MOD(minutes, 60 * 24) AS hours_part,
											minutes
										FROM difference_in_minutes;

										SELECT
											Bowser_ID,
											Maintenance_ID,
											Description,
											DATE_FORMAT(Date, '%m/%d/%y %T') AS Date,
											Status,
											CONCAT(
												FLOOR(minutes / 60 / 24), ' days ',
												FLOOR(hours_part / 60), ' hours '
											) AS Difference,
											FLOOR(minutes / 60 / 24) AS Days
										FROM differences
										WHERE bowser_id = '$selBowserID' AND DATE < NOW();
										");

									echo"<table id='maint-table' style='width: 100%;'>";
									echo"<tr align='center'>
										<th>Maintenance ID</th>
										<th>Created</td>
										<th>Status</th>
										<th>Description</th>
										<th></th>
										<th>Days to Complete</th>
									</tr>";
									//Query uses mysql_multi_query to allow more than one query to be run in a single call.
									$query = mysqli_multi_query($connection, $sql);
									if ($query) {
										do {
											if ($result = mysqli_use_result($connection)) {
												// Inline CSS allows for colourisation of time taken cells based on results.
												while ($row = mysqli_fetch_row($result)) {
													echo "<tr style='padding: 10px;'>";
													echo "<td align='center' style='background-color: #EEEEEE; border-radius:15px 0px 0px 15px'>" . $row[1] . "</td>";
													echo "<td align='center' style='background-color: #EEEEEE;'>" . $row[3] . "</td>";
													echo "<td align='center' style='background-color: #EEEEEE;'>" . $row[4] . "</td>";
													echo "<td align='center' style='background-color: #EEEEEE; border-radius:0px 15px 15px 0px'>" . $row[2] . "</td>";
													echo "<td></td>";
													if ($row[6] > 0 and $row[6] <= 3) {
														echo "<td align='center' style='background-color: #FFFF00; border-radius: 15px;'>" . $row[5] . "</td>";
													} else if ($row[6] >= 4 and $row[6] <= 13) {
														echo "<td align='center' style='background-color: #FF8800; border-radius: 15px;'>" . $row[5] . "</td>";
													} else if ($row[6] >= 14) {
														echo "<td align='center' style='color: #FFFFFF; background-color: #FF0000; border-radius: 15px;'>" . $row[5] . "</td>";
													} else {
														echo "<td align='center' style='border-radius: 15px;'>" . $row[5] . "</td>";
													}
													echo "</tr>";
												}
												mysqli_free_result($result);
											}
										} 
										while (mysqli_next_result($connection));
									}
									mysqli_close($connection);
									echo "</table>";
									echo "</div>";
								}
							}
						?>
					</div>
					<!-- Second Column for Map and Bowser Admin Tasks -->
					<div class="col">
						<div class="bowsers-right">
							<?php
								if (isset($_SESSION['email'])){
									if ($userType == "Operations"){
										// Buttons to Create or Edit Bowser Records
										echo '<h2>Add & Edit Bowsers</h2>
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Bowser</button>';
									}
								}
							?>
							<!-- Modal for Creating New Bowser Records -->
							<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<h2>Bowser Details</h2>
												<div class="col">
													<!-- Form for Creating Bowser Records -->
													<form method="POST">
														<label for="bowserID">Bowser ID: </label>
															<input type="text" name="bowserID" class="form-control" required></input>
														<label for="serial">Bowser Description: </label>
															<input type="text" name="description" class="form-control" required></input>
														<label for="cap">Bowser Capacity: </label>
															<input type="number" name="cap" class="form-control" required></input>
														<label for="model">Bowser Status: </label>
															<input type="text" name="status" class="form-control" required></input>
														<label for="cap">Bowser Cost: </label>
															<input type="number" name="cost" class="form-control" required></input>
														<br />
														<input class="btn btn-primary" type="submit" name="addBowser" value="Add Bowser"/>
														<button id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
														<!-- Post Function to write new Bowser to MySQL -->
														<?php
															set_exception_handler('ex_handler');
															$connection = OpenConnection();
															if(isset($_POST['addBowser'])) {
																$bowser_ID = $_POST["bowserID"];
																$Bowser_Serial = $_POST["description"];
																$Bowser_Capacity = $_POST["cap"];
																$Bowser_status = $_POST["status"];
																$Bowser_cost = $_POST["cost"];
																$sql = "
																INSERT INTO
																	tbl_bowsers(
																		bowserID,
																		Bowser_Description,
																		Bowser_Capacity,
																		status,cost
																	)

																	VALUES (
																		'$bowser_ID',
																		'$Bowser_Serial',
																		'$Bowser_Model',
																		'$Bowser_Capacity'
																	)";
																if($query = mysqli_query($connection, $sql3)) {
																	echo "<script>alert('Is Done is Good')</script>";
																	echo "<meta http-equiv='refresh' content='0'>";
																	header("Location: ./bowsers.php");
																} else {
																	header("Location: ./bowsers.php");
																	echo "<meta http-equiv='refresh' content='0'>";
																}
															}
														?>
													</form>	
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
								// Only Display Content if Logged in as Operations level user
								if (isset($_SESSION['email'])) {
									if ($userType == "Operations"){
										if ($selBowserID > '0') {
											echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit Bowser ' . $selBowserID . '</button>
											<br />';
										}
									}
								}
							?>

							<!-- Modal for Editing Bowser Records -->
							<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body">
											<div class="row">
												<h2>Bowser Details</h2>
												<div class="col">
													<!-- Form for Editing Bowser Record data -->
													<form method="POST">
														<label for="bowserID">Bowser ID: </label>
															<input type="text" name="bowserID" class="form-control" value="<?php echo $row_bowserID; ?>" readonly></input>
														<label for="serial">Bowser Description: </label>
															<input type="text" name="description" class="form-control" value="<?php echo $row_bowserDescription; ?>" required></input>
														<label for="cap">Bowser Capacity: </label>
															<input type="number" name="cap" class="form-control" value="<?php echo $row_bowserCapacity; ?>" required></input>
														<label for="status">Bowser Status: </label>
															<select select="<?php echo $row_bowserStatus; ?>" name="status" class="form-select" required>
																<option><?php echo $row_bowserStatus; ?></option>
															</select>
														<label for="cost">Bowser Cost: </label>
															<input type="text" name="cost" class="form-control" value="<?php echo $row_bowserCost; ?>" required></input>								
														<br />
														<!-- Button to updatecurrently select Bowser -->
														<input class="btn btn-primary" type="submit" name="editBowser" value="Edit Bowser"/>
														<!-- Button to set currently select Bowser to Decommissioned -->
														<input class="btn btn-secondary" type="submit" name="decommission" value="Decommission"/>
														<input id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal" name="close" value="Close"/>
														<!-- PHP Function to write Bowser changes to MySQL -->
														<?php
															//Routine to display error messages in Modal
															set_exception_handler('ex_handler');
														
															if(isset($_POST['editBowser'])) {
																$connection = OpenConnection();
																$bowserID = $_POST["bowserID"];
																$Bowser_Description = $_POST["description"];
																$Bowser_Capacity = $_POST["cap"];
																$Bowser_Status = $_POST["status"];
																$Bowser_Cost = $_POST["cost"];

																$sql = "UPDATE tbl_bowsers 
																			SET Bowser_Description = '$Bowser_Description',
																			Bowser_Capacity = '$Bowser_Capacity',
																			Status = '$Bowser_Status',
																			Bowser_Cost = '$Bowser_Cost'
																		WHERE bowserID = '$bowserID'";
																if($query = mysqli_query($connection, $sql)) {
																	echo "<meta http-equiv='refresh' content='0'>";
																	header("Location: ./bowsers.php");
																} else {
																	header("Location: ./bowsers.php");
																	echo "<meta http-equiv='refresh' content='0'>";
																}
																CloseConnection($connection);
															} 
															
															
															if(isset($_POST['decommission'])) { 
																$connection = OpenConnection();
																$bowserID = $_POST["bowserID"];
																$sql = "UPDATE tbl_bowsers 
																			SET 
																			Status = 'Decommissioned'
																			WHERE bowserID = '$bowserID'";
																if($query = mysqli_query($connection, $sql)) {
																	header("Location: ./bowsers.php");
																	echo "<meta http-equiv='refresh' content='0'>";
																}
																CloseConnection($connection);
															} 
															
														?>
													</form>	
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<center>
								<!-- Google Maps Output Showing Marker for Bowsers (Or default location if undefined) -->
								<?php
									if ($row_bowserLat == "0"){
										$bowserLat = '51.886';
									}
									if ($row_bowserLng == "0"){
										$bowserLng = '-2.088';
									} else {
										$bowserLat = $row_bowserLat;
										$bowserLng = $row_bowserLng;
									}
									if ($selBowserID > '0') {
										echo '<h2>Current Location of Bowser ' . $selBowserID . '</h2>';
										echo '<div id="map">';
										// Values defined as divs so they can be read by bowsers.js
										echo '<div id="bowserLat">'. $bowserLat .'</div>';
										echo '<div id="bowserLng">' . $bowserLng . '</div>';
										echo '<div id="bowserID">' . $selBowserID . '</div>';
										echo '<script src="../bowsers/bowsers.js"></script>';
										echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv17Pa1iXPZVBV4q4uGYCtESCD2evyHg8&callback=initMap&v=weekly" async></script></div>';
									} else {
										echo "<h2>Select Bowser to Show Location</h2>
										<br />";

									}
								?>
							</center>
						</div>
					</div>
				</div>
			</div>	
			<!-- Link back to top of page -->
			<p><br /><br /><br /><br /><br />
				<a id="top_link" href="#back_to_top" >RETURN TO TOP</a>
			</p>
			<br /> <br />
			<!-- Post-Load bootstrap script -->
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
			</script>
		</body>
	</html>