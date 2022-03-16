<?php
// get connection from config.php
include "../include/config.php";


// create new user function
if ($_POST['phpFunction']=='create') {
    create();
}

function create() {

    // get connection from config.php
    include "../include/config.php";

    $email= strip_tags(trim($_POST['email']));
    $userType = strip_tags(trim($_POST['user_type']));
    $randomPassword=  substr(md5(uniqid(rand(), true)), 8, 8);

    // query to select from database
    $sql="SELECT * FROM `tbl_user_account` WHERE email='$email'";
    $query = mysqli_query($connection, $sql);
    if(mysqli_num_rows($query) > 0){
        echo "This email is already registered!";
        return;
    }

    // construct query string - insert into db
    $sql= "insert into tbl_user_account (User_Type, Password, Email, UserLevel, isVerified, Verification_Code) values
		('$userType','$randomPassword','$email', 1,'1','$verificationcode')";

    // connection confirmation
    if (mysqli_query($connection, $sql)){
        echo "Successfully registered $email ";
//        header("location: .operations.php");
        echo sendEmail($email, $verificationcode);
        // if an error
    }else{
        echo mysqli_error($connection);
        return;
    }
    mysqli_close($connection);
}