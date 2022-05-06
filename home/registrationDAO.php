<?php

// get connection from config.php
include "../include/config.php";

// create new user function
if ($_POST['phpFunction']=='create') {
	create();
}
// retrieve function
else if ($_POST['phpFunction']=='retrieve') {
	retrieve();
}
// update function
else if ($_POST['phpFunction']=='update') {
	update();
}
// delete function
else if ($_POST['phpFunction']=='delete') {
	delete();
}
// verify function
else if ($_GET['phpFunction']=='verify') {
	verify();
}

function returnAreaCode($location){
	$connection=OpenConnection();
	$sql="SELECT * FROM `tbl_area` WHERE Area_Name='$location'";
	$result = mysqli_query($connection, $sql);
	$rows = mysqli_fetch_array($result);
	$areaCode = $rows["Area_ID"];
	return $areaCode;
}

// insert data into db table tbl_user
function create() {
	$verificationcode = substr(md5(uniqid(rand(), true)), 16, 16);
	$email= strip_tags(trim($_POST['email']));
	$password= strip_tags(trim($_POST['password']));
	$location= strip_tags(trim($_POST['userLocation']));
	$areaCode = returnAreaCode($location);
	
	// query to select from database
	$connection=OpenConnection();
	$sql="SELECT * FROM `tbl_user_account` WHERE email='$email'";
	$query = mysqli_query($connection, $sql);
	if(mysqli_num_rows($query) > 0){
		echo "This email is already registered!";
		return;
	}

	// construct query string - insert into db
	$sql2= "insert into tbl_user_account (User_Type, Password, Email, UserLevel, isVerified, Verification_Code, Location) values
		('Customer','$password','$email', 1,'1','$verificationcode', '$areaCode')";

	// connection confirmation
	if (mysqli_query($connection, $sql2)){
		echo "Successfully registered $email ";
		echo sendEmail($email, $verificationcode);

		// if an error
	} else {
		echo mysqli_error($connection);
		return;
	}

}


//verification email function
function sendEmail($emailTo, $verificationcode) {

	include "../include/config.php";
	// sender
	$fromserver="<br />FROM: s4008324@glos.ac.uk";
	// echo from
	echo $from."<br />";
	// send to users email address
	echo "To: ".$emailTo."<br />";
	// verification text
	$body="Thanks for registering ";
	$link='https://grp20224-ct5038.uogs.co.uk/Bowser-Project/home/registrationDAO.php?'.'phpFunction=verify&email='.$emailTo.'&VerificationCode='.$verificationcode;
	$link= '<a href="'.$link.'">Click here to activate</a> <br />';
	$body=$body.$link;
	echo $body;
}

//verifiy user function
function verify() {
	// echo the verify information
	echo password_verify(input, hashedDBPassword);

	// place email and verification code in variable
	$email=$_GET['email'];
	$verificationcode=$_GET['VerificationCode'];

	echo $verificationcode;

	// database connection
	$connection = OpenConnection();

	// query to update is verified
	$sql = "UPDATE `tbl_user_account` SET IsVerified=1 WHERE email = '$email' AND VerificationCode='$verificationcode'";
	echo $sql;

	if(mysqli_query($connection, $sql)) {
		echo "Account has been verified. <br />";
		// this link to direct to login page
		echo '<a href="index.php">Click here to login</a> <br />';

		// this link to close window
		echo '<a href="javascript: self.close()">Login</a>';
	} else {
		CloseConnection($connection);
		// return;
	}
}
?>
