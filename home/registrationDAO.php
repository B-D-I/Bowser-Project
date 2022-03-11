<?php

// get connection from config.php
include "../include/config.php";
// server
$servername = "localhost";
$serverusername = "root";
$serverpassword = "";
$dbname = "bowser-database"; // database name
// connection variable to hold credentials
$connection = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// confirmation if error
if($connection->connect_error) {
    echo $connection->connect_error;
}


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


// insert data into db table tbl_user
function create() {

	// get the values from super globals
	// strip_tags and trim functions to remove whitespace and strip html and php tags, to prevent xss and sql injection
    $email= strip_tags(trim($_POST['email']));
    $password= strip_tags(trim($_POST['password']));
	$pass= strip_tags(trim($_POST['re_password']));

    //PASSWORD HASHING
//	$hash_cost =['cost' =>12]; // hash length
//	$hash= password_hash('pass', PASSWORD_DEFAULT, $hash_cost);				// password_hash function used. passwords are hashed to provide better security and confidentiality
	$verificationcode = substr(md5(uniqid(rand(), true)), 16, 16);

	// get connection from config.php
	include "../include/config.php";

//     // server
//     $servername = "localhost";
//     $serverusername = "root";
//     $serverpassword = "";
//     $dbname = "bowser-database"; // database name
// // connection variable to hold credentials
//     $connection = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// // confirmation if error
//     if($connection->connect_error) {
//         echo $connection->connect_error;
//     }


	// query to select from database
	$sql="SELECT * FROM `tbl_user_account` WHERE email='$email'";
	$query = mysqli_query($connection, $sql);
	if(mysqli_num_rows($query) > 0){
		echo "This email is already registered!";
		return;
	}

	// construct query string - insert into db
	$sql="INSERT INTO `tbl_user_account` (User_Type, Password, Email, UserLevel, isVerified, Verification_Code)"." values ".
		"('Customer','$password','$email', 1,'0','$verificationcode')";

	// connection confirmation
	if (mysqli_query($connection, $sql)){
		echo "Successfully registered $email ";
		echo sendEmail($email, $verificationcode);
		// if an error
	}else{
		echo mysqli_error($connection);
		return;
	}
	mysqli_close($connection);
}



// verification email function
function sendEmail($emailTo, $verificationcode) {

	include "../include/config.php";
//     // server
//     $servername = "localhost";
//     $serverusername = "root";
//     $serverpassword = "";
//     $dbname = "bowser-database"; // database name
// // connection variable to hold credentials
//     $connection = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// // confirmation if error
//     if($connection->connect_error) {
//         echo $connection->connect_error;
//     }

	// sender
	$fromserver="<br />FROM: s4008324@glos.ac.uk";
	// echo from
	echo from."<br />";
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
    // server
//     $servername = "localhost";
//     $serverusername = "root";
//     $serverpassword = "";
//     $dbname = "bowser-database"; // database name
// // connection variable to hold credentials
//     $connection = new mysqli($servername, $serverusername, $serverpassword, $dbname);
// // confirmation if error
//     if($connection->connect_error) {
//         echo $connection->connect_error;
//     }

	// echo the verify information
	echo password_verify(input, hashedDBPassword);

	// place email and verification code in variable
	$email=$_GET['email'];
	$verificationcode=$_GET['VerificationCode'];

	echo $verificationcode;

	// database connection
	include "../include/config.php";

	// query to update is verified
	$sql = "UPDATE `user_account` SET IsVerified=1 WHERE email = '$email' AND VerificationCode='$verificationcode'";
	echo $sql;

	if(mysqli_query($connection, $sql)) {
		// $_SESSION["success"] = "Account created. Please sign in";
		echo "Account has been verified. <br />";

		// this link to direct to login page
		echo '<a href="../home/index.php">Click here to login</a> <br />';

		// this link to close window
		echo '<a href="javascript: self.close()">Login</a>';
	} else {
		echo mysqli_error($connection);
		// return;
	}
}
// header change
//header("Location: ../index.php?signup=done");
//
//// function to retrieve users name
//function retrieve() {
//	// establish connection
//	include "../include/config.php";
//// sql select query
//	$sql="SELECT first_Name, last_Name FROM `user_account`";
//
//	$result=$connection->query($sql);
//
//	if ($result->num_rows > 0) {
//		// output row data
//		while($row = $result->fetch_assoc()) {
//			echo "firstname:".$row["first_Name"]."lastname: ".$row["last_Name"];
//			if (mysqli_query($connection, $sql)){
//				echo '';
//			}else{
//				echo mysqli_error($connection);
//				return;
//			}
//			mysqli_close($connection);
//		}
//	}
//}
//
////update function
//function update() {
//	//establish connection
//	include "../include/config.php";
//// sql query - update
//	$sql="UPDATE `user_account` SET first_Name='John', last_Name='Doe' WHERE last_Name='Smith'";
//	if (mysqli_query($connection, $sql)){
//		echo 'Successfully updated';
//	}else{
//		echo mysqli_error($connection);
//		return;
//	}
//	mysqli_close($connection);
//}
//
//// delete function
//function delete() {
//	// establish connection
//	include "../include/config.php";
//// sql query - delete
//	$sql="DELETE FROM `user_account` WHERE last_Name='smith'";
//	if (mysqli_query($connection, $sql)){
//		echo 'Successfully deleted';
//	}else{
//		echo mysqli_error($connection);
//		return;
//	}
//	mysqli_close($connection);
//}
//
//?>

