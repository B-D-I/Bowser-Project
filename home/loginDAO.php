<?php
// get connection from config.php
include "../include/config.php";

session_start();
// if function is set

if(isset($_POST['phpFunction'])) {
    if($_POST['phpFunction'] == 'login') {
        login(); // call function
    }
}
// function to check if user information matches database
function login() {
    $email = $_POST['email'];	// variable for email
    $pass = $_POST['password'];	// variable for password

    // query to check if email and password match, and if user verified
	$connection = OpenConnection();
	$sql = "SELECT Email, Password, User_Type FROM tbl_User_Account WHERE Email='".$email."' AND Password='".$pass."' AND IsVerified='1'";
    // result confirm
    $res = mysqli_query($connection, $sql);
    $num_row = mysqli_num_rows($res);
    $row=mysqli_fetch_assoc($res);

    if( $num_row == 1) {
        echo json_encode($row);
        $_SESSION['email'] = $email;
    } else {
        echo '{"result":"false"}';
    }
	CloseConnection($connection);
}
?>