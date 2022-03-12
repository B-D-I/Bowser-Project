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
//// delete function
//else if ($_POST['phpFunction']=='delete') {
//    delete();
//}
//// verify function
//else if ($_GET['phpFunction']=='verify') {
//    verify();
//}


// insert data into db table tbl_user
function create() {
	// get the values from super globals
	// strip_tags and trim functions to remove whitespace and strip html and php tags, to prevent xss and sql injection
    $email= strip_tags(trim($_POST['email']));
    $password= strip_tags(trim($_POST['re_password']));

    //PASSWORD HASHING
//	$hash_cost =['cost' =>12]; // hash length
//	$hash= password_hash('pass', PASSWORD_DEFAULT, $hash_cost);				// password_hash function used. passwords are hashed to provide better security and confidentiality
	$verificationcode = substr(md5(uniqid(rand(), true)), 16, 16);

	// get connection from config.php
	include "../include/config.php";


	// query to select from database
	$sql="SELECT * FROM `tbl_User_Account` WHERE email='$email'";
	$query = mysqli_query($connection, $sql);
	if(mysqli_num_rows($query) > 0){
		echo "This email is already registered!";
		return;
	}

	// construct query string - insert into db
	$sql="INSERT INTO `tbl_User_Account` (User_Type, Password, Email, UserLevel, isVerified, Verification_Code)"." values ".
		"('Customer','$password','$email', 1,'0','$verificationcode')";

	// connection confirmation
	if (mysqli_query($connection, $sql)){
		echo "Successfully registered $email ";
//		echo sendEmail($email, $verificationcode);
		// if an error
	}else{
		echo mysqli_error($connection);
		return;
	}
	mysqli_close($connection);
}


//
// verification email function
//function sendEmail($emailTo, $verificationcode) {
//
//	include "../include/config.php";
//
//	// sender
//	$fromserver="<br />FROM: s4008324@glos.ac.uk";
//	// echo from
//	echo from."<br />";
//	// send to users email address
//	echo "To: ".$emailTo."<br />";
//	// verification text
//	$body="Thanks for registering ";
//	$link='https://grp20224-ct5038.uogs.co.uk/Bowser-Project/home/registrationDAO.php?'.'phpFunction=verify&email='.$emailTo.'&VerificationCode='.$verificationcode;
//	$link= '<a href="'.$link.'">Click here to activate</a> <br />';
//	$body=$body.$link;
//	echo $body;
//
//}
//
////verifiy user function
//function verify() {
//
//
//	// echo the verify information
//	echo password_verify(input, hashedDBPassword);
//
//	// place email and verification code in variable
//	$email=$_GET['email'];
//	$verificationcode=$_GET['VerificationCode'];
//
//	echo $verificationcode;
//
//	// database connection
//	include "../include/config.php";
//
//	// query to update is verified
//	$sql = "UPDATE `tbl_user_account` SET IsVerified=1 WHERE email = '$email' AND VerificationCode='$verificationcode'";
//	echo $sql;
//
//	if(mysqli_query($connection, $sql)) {
//		// $_SESSION["success"] = "Account created. Please sign in";
//		echo "Account has been verified. <br />";
//
//		// this link to direct to login page
//		echo '<a href="../home/index.php">Click here to login</a> <br />';
//
//		// this link to close window
//		echo '<a href="javascript: self.close()">Login</a>';
//	} else {
//		echo mysqli_error($connection);
//		// return;
//	}
//}


?>

