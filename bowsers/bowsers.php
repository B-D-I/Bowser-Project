<?php
// session start function
// variable assigned for user email
session_start();
//$email =$_SESSION['email'];
// establish connection
include '../include/config.php';
$selBowserID = '';
?>

<!doctype html>
<html lang="en">

<head>
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

	
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
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
     					<input type="text" name="term" id="term" placeholder="Enter Bowser Serial" class="form-control">  
						<script type="text/javascript">
  							$(function() {
     							$( "#term" ).autocomplete({
       								source: '../include/dbsearch.php',
									sql: "select bowser_id from tbl_bowser_stock where Bowser_Serial LIKE '{$_GET['term']}%' LIMIT 25'"
     							});
  							});
						</script>
						<br />
						<input type='submit' name='submit' value='View' class='btn btn-primary'></input>
						<?php
						if (isset($_POST['submit']) ) {
								if(!empty($_POST['term'])){
									$selBowserID = $_POST['term'];
								} else {
									$selBowserID = '0';
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
							}
						}
					?>	
					</div>
					<br />
					<h4>Maintenance History</h4>
						<?php
							$connection2 = OpenConnection();
							$sql2=("SELECT bowser_id, report_type_id, description, status, date from tbl_maintenance_schedule where bowser_id = (select bowser_id from tbl_bowser_stock where bowser_serial = '$selBowserID') and Date < Now()");
							echo"<table style='width: 100%;'>";
							echo"<tr>
									<th>Date</th>
									<th>Type</th>
									<th>Status</th>
									<th>Description</th>
								</tr>";
							$result2 = mysqli_query($connection2, $sql2);
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
								}
							CloseConnection($connection);		
							}
						?>
						</table>
                </div>
                <div class="col">
					<div class="maintenance_list">
					<h2>Add & Edit Bowsers</h2>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add New Bowser</button>
						<?php
							if ($selBowserID > '0'){
								
								echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit '.$selBowserID.'</button>';
							}
						?>

						<!-- Modal -->
						<div id="addModal" class="modal fade" role="dialog">
  							<div class="modal-dialog">

    							<!-- Modal content-->
    							<div class="modal-content">
      								<div class="modal-header">
	        							<h4 class="modal-title">Add New Bowser</h4>
    	  							</div>
      								<div class="modal-body">
	        							<p>Some text in the modal.</p>
    	  							</div>
      								<div class="modal-footer">
										<input type="submit" class="btn btn-primary" name="submit" value="Add Bowser"></input>
        								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      								</div>
    							</div>
							 </div>
						</div>
						<div id="editModal" class="modal fade" role="dialog">
  							<div class="modal-dialog">

    							<!-- Modal content-->
    							<div class="modal-content">
      								<div class="modal-header">
	        							<h4 class="modal-title">Edit Bowser</h4>
    	  							</div>
      								<div class="modal-body">
	        							<p>Some text in the modal.</p>
    	  							</div>
      								<div class="modal-footer">
										<input type="submit" class="btn btn-primary" name="submit" value="Edit Bowser"></input>
        								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      								</div>
    							</div>
							 </div>
						</div>
					</div>
					<br />
					<center>
					<?php
						if ($selBowserID > '0'){
							echo "<h2>Current Location of ".$selBowserID."</h2>";
						} else {
							echo "<h2>Select Bowser to Show Location</h2>";
						}
					?>
					</center>
                    <div class="text_area">
                        <!--div to display map--->
                        <div id="map"></div>
                    </div>
                </div>
            </div>
						
		</div>				
	
		<!-- Modal -->
 <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">


        <br /><br /><br /><br /><br />

        <!-- Link back to top of page -->
        <p><a id="top_link" href="#back_to_top" >RETURN TO TOP</a></p>
        <br />  <br />

        <script src="../bowsers/bowsers.js"></script>
        <script src ="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&callback=initMap" async defer> </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>