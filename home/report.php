<?php
include("../include/config.php");
$connection = OpenConnection();

$reportType = $_POST['Report_Type1'];
$bowsrID = $_POST['Bowser_ID1'];
$description = $_POST['Description1'];

if (isset($_POST['Report_Type1'])) {
	if($_POST['Bowser_ID1'] != 0){
		$sql = "SELECT bowserID FROM tbl_bowsers WHERE bowserID ='".$_POST['Bowser_ID1']."'";
		$result = mysqli_query($connection,$sql);
		while($row = mysqli_fetch_assoc($result)) {
			if (mysqli_num_rows($result) == 0){
				return false;	
			} else {
				$bowserID = $_POST['Bowser_ID1'];
				$sql1 = "insert into tbl_reports(Report_ID, Report_Type, Bowser_ID, Description, Date, Status) values (NULL, '$reportType', '$bowsrID', '$description', NOW(), 'Pending')"; 
				$result1 = mysqli_query($connection,$sql1);
				echo "Form Submitted succesfully";
				return true;
			}
		
		}
		echo "Please Enter Valid Bowser ID";
	} else {
		$sql2 = "insert into tbl_reports(Report_ID, Report_Type, Bowser_ID, Description, Date, Status) values (NULL, '$reportType', '$bowsrID', '$description', NOW(), 'Pending')"; 
		$result = mysqli_query($connection,$sql2);
		echo "Form Submitted succesfully";
		return true;
	} 
}
CloseConnection($connection);
?>