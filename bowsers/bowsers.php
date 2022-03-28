<?php
// session start function
// variable assigned for user email
session_start();
//$email =$_SESSION['email'];
// establish connection
include '../include/config.php';
include '../include/handler.php';
$selBowserID = '';
?>

<!doctype html>
<html lang="en"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="../global/global.css" type="text/css">
    <link rel="stylesheet" href="../maintenance/maintenance.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

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
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<!---html anchor to return to top of page-->
<p id="back_to_top"></p>
<div class="container">
    <div class="nav-wrapper">
        <div class="left-side">
            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="../home/index.php">Home</a>
            </div>

            <div class="nav-link-wrapper active-nav-link">
                <a class="text-focus-in" href="../maintenance/bowsers.php">Bowsers</a>
            </div>
        </div>

        <div class="middle">
            <h2 class="text-focus-in">Bowser Hub</h2>
        </div>

        <div class="right-side">
            <div class="nav-link-wrapper">
                <!--right navbar--->
            </div>
        </div>
    </div>
    <div class="upperPage">
        <div class="shadow-sm p-3 mb-5 bg-body rounded">
            <div class="row">
  				<div class="row">
  				</div>

				<div class="col">
					<div class="maintenance_list">
					<h2>Bowser Information</h2>
						<form action="" method="POST">
     					<?php
							$_SESSION['query'] = 'SELECT * FROM tbl_bowser_stock WHERE Bowser_Serial LIKE "%{TERM}%" LIMIT 25';
						?>
					   	<input type="text" name="term" id="term" placeholder="Enter Bowser Serial Number...." class="form-control">
						<script type="text/javascript">
  						$(function() {
     						$( "#term" ).autocomplete({
       							source: '../include/dbsearch.php',
     						});
  						});
						</script>
						<br />
						<input type='submit' name='submit' value='View' class='btn btn-primary'></input>
						<?php
						
						if (isset($_POST['submit']) ) {
								if(!empty($_POST['term'])){
									$connection = OpenConnection();
									$sql = "select bowser_serial from tbl_bowser_stock where bowser_serial ='".$_POST['term']."'";
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
					</form>
					<br />
					<h4>Bowser
					<?php
						$connection = OpenConnection();
						$sql = "SELECT bowser_id, bowser_serial, bowser_capacity, bowser_status, bowser_model from tbl_bowser_stock where bowser_serial = '$selBowserID'";
    					$result = mysqli_query($connection,$sql);
						while($row = mysqli_fetch_assoc($result)) {
							if (mysqli_num_rows($result) > 0){
								echo $row['bowser_serial']. "</h4><br />";
								echo "Bowser Model: " .$row['bowser_model']. "<br /><br />";
								echo "Bowser Status: " .$row['bowser_status']. "<br />";
								echo "Bowser Capacity: " .$row['bowser_capacity']. "<br />";
								echo "<br /><br />";
								$row_bowserID = $row['bowser_id'];
								$row_bowserSerial = $row['bowser_serial'];
								$row_bowserModel = $row['bowser_model'];
								$row_bowserCapacity = $row['bowser_capacity'];
								$row_bowserLocationX = '';
								$row_bowserLocationY = '';
								$row_bowserStatus = $row['bowser_status'];
							}
						}
					?>
					</div>
					<br />
					<h4>Maintenance History</h4>
						<?php
							$connection = OpenConnection();
							$sql2=("SELECT bowser_id, report_type_id, description, status, date from tbl_maintenance_schedule where bowser_id = (select bowser_id from tbl_bowser_stock where bowser_serial = '$selBowserID') and Date < Now()");
							echo"<table style='width: 100%;'>";
							echo"<tr>
									<th>Date</th>
									<th>Type</th>
									<th>Status</th>
									<th>Description</th>
								</tr>";
							$result2 = mysqli_query($connection, $sql2);
							while($row2 = mysqli_fetch_assoc($result2)) {
								if (mysqli_num_rows($result2) > 0){
									foreach($result2 as $row2){
									$row_id2 = (int)$row2['bowser_id'];
										if($row_id2 % 2 == 0){
											echo "<tr bgcolor='lightgrey'>";
										} else {
											echo "<tr>";
										}
										echo "<td align='center'>".$row2['date']."</td>";
										echo "<td align='center'>".$row2['report_type_id']."</td>";
										echo "<td align='center'>".$row2['status']."</td>";
										echo "<td align='center'>".$row2['description']."</td></tr>";
									}
								} CloseConnection($connection);
							
							}
						?>
						</table>
                </div>
                <div class="col">
					<div class="maintenance_list">
						<h2>Add & Edit Bowsers</h2>
						
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Bowser</button>
        				<!-- Modal -->
						<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
							<div class="modal-dialog">
	                			<div class="modal-content">
				                    <div class="modal-body">
        	    			            <div class="row">
											<h2>Bowser Details</h2>
            	            			    <div class="col">
  												<form method="POST">
													<label for="serial">Bowser Serial: </label>
														<input type="text" name="serial" class="form-control" required></input>
													<label for="model">Bowser Model: </label>
														<input type="text" name="model" class="form-control" required></input>
													<label for="cap">Bowser Capacity: </label>
														<input type="number" name="cap" class="form-control" required></input>
													<br />
													<input class="btn btn-primary" type="submit" name="addBowser" value="Add Bowser"/>
													<button id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
													<?php
														set_exception_handler('ex_handler');
														$connection = OpenConnection();
														if(isset($_POST['addBowser'])) {
															$Bowser_Serial = $_POST["serial"];
															$Bowser_Model = $_POST["model"];
															$Bowser_Capacity = $_POST["cap"];
															$sql3 = "INSERT INTO tbl_bowser_stock(Bowser_ID,Bowser_Serial,Bowser_Model,Bowser_Capacity) VALUES (NULL,'$Bowser_Serial','$Bowser_Model', '$Bowser_Capacity')";
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
							if ($selBowserID > '0'){
								echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit Bowser ' .$selBowserID. '</button>';
							}
						?>
						

        				<!-- Modal -->
						<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
							<div class="modal-dialog">
	                			<div class="modal-content">
				                    <div class="modal-body">
        	    			            <div class="row">
											<h2>Bowser Details</h2>
            	            			    <div class="col">
  												<form method="POST">
													<label for="bowser_id">Bowser ID: </label>
														<input type="text" name="bowser_id" class="form-control" value="<?php echo $row_bowserID; ?>" readonly></input>
													<label for="serial">Bowser Serial: </label>
														<input type="text" name="serial" class="form-control" value="<?php echo $row_bowserSerial; ?>" required></input>
													<label for="model">Bowser Model: </label>
														<input type="text" name="model" class="form-control" value="<?php echo $row_bowserModel; ?>" required></input>
													<label for="cap">Bowser Capacity: </label>
														<input type="number" name="cap" class="form-control" value="<?php echo $row_bowserCapacity; ?>" required></input>
													<label for="status">Bowser Status: </label>
														<select select="<?php echo $row_bowserStatus; ?>" name="status" class="form-control" required>
															<option selected><?php echo $row_bowserStatus; ?></option>
															</select>
													<br />
													<input class="btn btn-primary" type="submit" name="editBowser" value="Edit Bowser"/>
													<button class="btn btn-secondary">Decommission</button>
													<button id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
													<?php
														set_exception_handler('ex_handler');
														$connection = OpenConnection();
														
														if(isset($_POST['editBowser'])) {
															$Bowser_ID = $_POST["bowser_id"];
															$Bowser_Serial = $_POST["serial"];
															$Bowser_Model = $_POST["model"];
															$Bowser_Capacity = $_POST["cap"];
															$Bowser_Status = $_POST["status"];
															
															
															
															$sql4 = "UPDATE tbl_bowser_stock SET Bowser_Serial = '$Bowser_Serial', Bowser_Model = '$Bowser_Model', Bowser_Capacity = '$Bowser_Capacity', Bowser_Status = '$Bowser_Status' WHERE Bowser_ID = '$Bowser_ID'";
															if($query = mysqli_query($connection, $sql4)) {
																echo "<script>alert('Is Done is Good $Bowser_ID')</script>";
																echo "<meta http-equiv='refresh' content='0'>";
																header("Location: ./bowsers.php");
															} else {
																header("Location: ./bowsers.php");
																echo "<meta http-equiv='refresh' content='0'>";
															}
														} CloseConnection($connection);
													
													?>

												</form>	
					            			</div>
                    	    			</div>
                    				</div>
	                			</div>
    	        			</div>
        				</div>

						<br /><br />
						<?php
							if ($selBowserID > '0'){
								echo "<h2>Current Location of ".$selBowserID."</h2>";
							} else {
								echo "<h2>Select Bowser to Show Location</h2>";
							}
						?>
						</center>
					</div>
				</div>


	    <br /><br /><br /><br /><br />

        <!-- Link back to top of page -->
        <p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
        <br />  <br />

        <script src="../bowsers/bowsers.js"></script>
<!--        <script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initMap" async defer> </script> -->
	  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>