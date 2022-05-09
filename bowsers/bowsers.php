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

$filter = NULL;
if(!empty($_POST['filter']))
$filter = $_POST['filter'];
$_SESSION["filter"] = $filter;
if (empty($filter)){
   $_SESSION['query'] = 'SELECT * FROM tbl_bowsers WHERE BowserID LIKE "%{TERM}%"';
} else {
	$_SESSION['query'] = 'SELECT * FROM tbl_bowsers WHERE BowserID LIKE "%{TERM}%" and BowserID in (select Bowser_ID from tbl_bowser_inuse) LIMIT 25';
}

$row_bowserLat = 51.886;
$row_bowserLng = -2.088;
?>

<!doctype html>
<html>
	<head>
    	<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="../global/global.css" type="text/css">
		<link rel="stylesheet" href="bowsers.css" type="text/css">
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
	
    <div class="upperPage">
        <div class="shadow-sm p-3 mb-5 bg-body rounded">
            <div class="row">
  				<div class="col">
					<div class="bowser-list">
					<h2>Bowser Information</h2>
						<form action="" id="bowser" method="POST">
     					  <p>
     					    <input type="text" name="term" id="term" form="bowser" placeholder="Enter Bowser Serial Number...." class="form-control">
     					    
							<input type="checkbox" name="filter"  value="filter" form="filter" onchange="this.form.submit()" <?php if(!empty($_SESSION["filter"])){echo "checked";} ?>> Show Deployed Bowsers Only
							<br /><br />
							<input type='submit' name='submit' form="bowser" value='View' class='btn btn-primary'>
     					    </input>
						</form>  
						<form action="bowsers.php" id="filter" method="post">
						</form>
						<br />
						<script>  
  							$(function() {
     							$( "#term" ).autocomplete({
       								source: '../include/dbsearch.php',
     							});
  							});
							</script>
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
						</form>
							
					<br />
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
if (isset($_SESSION['email'])){
    if ($userType == "Operations"){
		echo '<div class="maintenance-list">
			<h4>Maintenance History</h4>';
			if (isset($_SESSION['email'])) {
            if ($userType == "Operations")
				$connection = OpenConnection();
				$sql2=("WITH difference_in_minutes AS(
							SELECT
								Bowser_ID,
    							Maintenance_ID,
    							Description,
    							Status,
    							Date,
    							Completed_Date,
    							TIMESTAMPDIFF(MINUTE, Date, Completed_Date) AS minutes
  							FROM tbl_maintenance_schedule
  						),
  	
						differences AS (
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
								FROM difference_in_minutes
						)
	
	
						SELECT
							Bowser_ID,
    						Maintenance_ID,
    						Description,
    						DATE_FORMAT(DATE, '%m/%d/%y - %T') AS Date,
							Status,
							CONCAT(
    							FLOOR(minutes / 60 / 24), ' days ',
    							FLOOR(hours_part / 60), ' hours '
							) AS Difference,
							FLOOR(minutes / 60 / 24) AS Days
							FROM differences
							WHERE bowser_id = '$selBowserID' AND DATE < NOW()");
				echo"<table id='maint-table' style='width: 100%;'>";
				echo"<tr align='center'>
						<th>Maintenance ID</th>
						<th>Created</td>
						<th>Status</th>
						<th>Description</th>
						<th></th>
						<th>Days to Complete</th>
					</tr>";
				$result2 = mysqli_query($connection, $sql2);
				while($row2 = mysqli_fetch_assoc($result2)) {
                	if (mysqli_num_rows($result2) > 0) {
                    	foreach ($result2 as $row2) {
                        	echo "<tr style='padding: 10px;'>";
							echo "<td align='center' style='background-color: #EEEEEE; border-radius:15px 0px 0px 15px'>" . $row2['Maintenance_ID'] . "</td>";
							echo "<td align='center' style='background-color: #EEEEEE;'>" . $row2['Date'] . "</td>";
                            echo "<td align='center' style='background-color: #EEEEEE;'>" . $row2['Status'] . "</td>";
                            echo "<td align='center' style='background-color: #EEEEEE; border-radius:0px 15px 15px 0px'>" . $row2['Description'] . "</td>";
							echo "<td></td>";
							if ($row2['Days'] >= 14){
								echo "<td align='center' style='color: #FFFFFF; background-color: #FF0000; border-radius: 15px;'>" . $row2['Difference'] . "</td>";
							}						
							if ($row2['Days'] >= 4 and $row2['Days'] <= 13)
								echo "<td align='center' style='background-color: #FF8800; border-radius: 15px;'>" . $row2['Difference'] . "</td>";
							}
							if ($row2['Days'] > 0 and $row2['Days'] <= 3)
								echo "<td align='center' style='background-color: #FFFF00;  border-radius: 15px;'>" . $row2['Difference'] . "</td>";
							} else {

								echo "<td align='center'>" . $row2['Difference'] . "</td>";	
								echo "</tr>";
							}
						}
		}
	CloseConnection($connection);

	}
}
?>
		</table>
	</div>
	</div>
	<div class="col">
		<div class="maintenance-list">
		<?php
                if (isset($_SESSION['email'])){
                    if ($userType == "Operations")
                        echo '<h2>Add & Edit Bowsers</h2>
 

						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Bowser</button>
						';}?>
        				<!-- Modal -->
						<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
							<div class="modal-dialog">
	                			<div class="modal-content">
				                    <div class="modal-body">
        	    			            <div class="row">
											<h2>Bowser Details</h2>
            	            			    <div class="col">
  												<form method="POST">
													<label for="bowserID">Bowser ID: </label>
														<input type="text" name="bowserID" class="form-control" value="<?php echo $row_bowserID; ?>"></input>
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

													<?php
														set_exception_handler('ex_handler');
														$connection = OpenConnection();
														if(isset($_POST['addBowser'])) {
															$Bowser_Serial = $_POST["description"];
															$Bowser_Capacity = $_POST["cap"];
															$Bowser_status = $_POST["status"];
															$Bowser_cost = $_POST["cost"];
															$sql3 = "INSERT INTO tbl_bowsers(bowserID,Bowser_Description,Bowser_Capacity,status,cost) VALUES (NULL,'$Bowser_Serial','$Bowser_Model', '$Bowser_Capacity')";
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
                        if (isset($_SESSION['email'])) {
                            if ($userType == "Operations")
                                if ($selBowserID > '0') {
                                    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit Bowser ' . $selBowserID . '</button>';
                                }
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
													<label for="bowserID">Bowser ID: </label>
														<input type="text" name="bowserID" class="form-control" value="<?php echo $row_bowserID; ?>" readonly></input>
													<label for="serial">Bowser Description: </label>
														<input type="text" name="description" class="form-control" value="<?php echo $row_bowserDescription; ?>" required></input>
													<label for="cap">Bowser Capacity: </label>
														<input type="number" name="cap" class="form-control" value="<?php echo $row_bowserCapacity; ?>" required></input>
													<label for="status">Bowser Status: </label>
														<select select="<?php echo $row_bowserStatus; ?>" name="status" class="form-control" required>
															<option selected><?php echo $row_bowserStatus; ?></option>
														</select>
													<label for="cost">Bowser Cost: </label>
														<input type="text" name="cost" class="form-control" value="<?php echo $row_bowserCost; ?>" required></input>								
													<br />

                                                <?php
                                                if (isset($_SESSION['email'])){
                                                    if ($userType == "Operations")
                                                        echo '
                                                    
													<input class="btn btn-primary" type="submit" name="editBowser" value="Edit Bowser"/>
													<button class="btn btn-secondary">Decommission</button>
													   ';}
												?>
												<button id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

												<?php
													set_exception_handler('ex_handler');
													$connection = OpenConnection();
													
													if(isset($_POST['editBowser'])) {
														$bowserID = $_POST["bowserID"];
														$Bowser_Description = $_POST["description"];
														$Bowser_Capacity = $_POST["cap"];
														$Bowser_Status = $_POST["status"];
														$Bowser_Cost = $_POST["cost"];
														
														$sql4 = "UPDATE tbl_bowsers SET Bowser_Description = '$Bowser_Description', Bowser_Capacity = '$Bowser_Capacity',  Status = '$Bowser_Status', Bowser_Cost = '$Bowser_Cost', WHERE bowserID = '$bowserID'";
														if($query = mysqli_query($connection, $sql4)) {
															echo "<script>alert('Is Done is Good')</script>";
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
							if($row_bowserLat == "0"){
								$bowserLat = '51.886';
							} 
							if($row_bowserLng == "0"){
								$bowserLng = '-2.088';
							} else {
							$bowserLat = $row_bowserLat;
							$bowserLng = $row_bowserLng;
							}
							if ($selBowserID > '0') {
                            	echo '<h2>Current Location of ' . $selBowserID . '</h2>';
								echo '<div id="map">';
								echo '<div id="bowserLat">'. $bowserLat .'</div>';
								echo '<div id="bowserLng">' . $bowserLng . '</div>';
								echo '<div id="bowserID">' . $selBowserID . '</div>';
								echo '<script src="../bowsers/bowsers.js"></script>';
								echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv17Pa1iXPZVBV4q4uGYCtESCD2evyHg8&callback=initMap&v=weekly" async></script></div>';
								
							} else {
								echo "<h2>Select Bowser to Show Location</h2>";
							}
						?>
						</center>
					</div>
				</div>


	    

        <!-- Link back to top of page -->


        <p><br /><br /><br /><br /><br /><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
        <br />  <br />

<!--        <script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initMap" async defer> </script> -->
	  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>