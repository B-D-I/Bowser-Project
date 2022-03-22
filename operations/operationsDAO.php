<?php
// get connection from config.php
include "../include/config.php";

// create new user function
if ($_POST['phpFunction']=='createUser') {
    create();
}
else if ($_POST['phpFunction']=='requestBowser') {
    requestBowser();
}

function create()
{
    // get connection from config.php
//    include "../include/config.php";
        $email = strip_tags(trim($_POST['email']));
        $userType = strip_tags(trim($_POST['user_type']));
        $randomPassword = substr(md5(uniqid(rand(), true)), 8, 8);

        $connection = OpenConnection();
        // query to select from database
        $sql = "SELECT * FROM `tbl_user_account` WHERE email='$email'";
        $query = mysqli_query($connection, $sql);
        if (mysqli_num_rows($query) > 0) {
            echo "This email is already registered!";
            return;
        }
        // construct query string - insert into db
        $sql = "insert into tbl_user_account (User_Type, Password, Email, UserLevel, isVerified, Verification_Code) values
		('$userType','$randomPassword','$email', 1,'1','$verificationcode')";

        // connection confirmation
        if (mysqli_query($connection, $sql)) {
            echo "Successfully registered $email ";
            // if an error
        } else {
            echo mysqli_error($connection);
            return;
        }
        mysqli_close($connection);
}

function bowserDelete($bowser){
    $connection = OpenConnection();
    $sql =  "DELETE FROM tbl_bowser_stock WHERE BOWSER_ID = '$bowser'";
    // connection confirmation
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo mysqli_error($connection);
        return;
    }
    mysqli_close($connection);
}

function createInvoice($transationType, $bowserID){
    $connection = OpenConnection();
    $sqlQ = null;
    if ($transationType == "Lend"){
        $sqlQ =  "SELECT * FROM `tbl_bowser_lent` WHERE BowserID";
    } else if ($transationType == "Loan"){
        $sqlQ = "SELECT * FROM `tbl_bowser_borrowed` WHERE BowserID";
    } $results = mysqli_query($connection, $sqlQ);
    if ($results->num_rows > 0) {
        while ($rows = $results->fetch_assoc()) {
            $transactionID = $rows['TransactionID'];
            $organisation = $rows['Organisation_Name'];
            $sql = "INSERT INTO `tbl_invoices` (TransactionID, TransactionType, BowserID, Organisation_Name) 
            VALUES ('$transactionID', '$transationType', '$bowserID', '$organisation')";
            // connection confirmation
            if (mysqli_query($connection, $sql)) {
                echo "success";
            } else {
                echo mysqli_error($connection);
                return;
            }
            mysqli_close($connection);
        }
    }
}

function requestBowser()
{
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
//        include "../include/config.php";

        $reason = $_POST['Reason'];
        $transaction = strip_tags(trim($_POST['Transaction']));
        $organisation = strip_tags(trim($_POST['Organisation']));
        $capacity = strip_tags(trim($_POST['Capacity']));
        $priority = strip_tags(trim($_POST['Priority']));

        $connection = OpenConnection();
        // fetch user id
        $sql1="SELECT * FROM `tbl_user_account` WHERE email='$email'";
        $result = mysqli_query($connection, $sql1);
        $rows = mysqli_fetch_array($result);
        $userID = $rows["User_ID"];

        if ($transaction == 'Lend') {
            $sql2 = "SELECT * FROM `tbl_bowser_stock` WHERE Bowser_Capacity = '$capacity' LIMIT 1";
            $results = mysqli_query($connection, $sql2);
            if ($results->num_rows > 0) {
                while ($rows = $results->fetch_assoc()) {
                    $bowserID = $rows['Bowser_ID'];
                    $sql = "insert into tbl_bowser_lent (UserID, Organisation_Name, BowserID, Bowser_Capacity, Priority, Request_Reason) values
		    ('$userID', '$organisation', '$bowserID','$capacity','$priority','$reason')";
                    bowserDelete($bowserID);
                    createInvoice($transaction, $bowserID);
                }
            } else {
                echo "<script>alert('No bowser of that size available')</script>";
            }
        }
        if ($transaction == 'Loan'){
            $sql = "insert into tbl_bowser_borrowed (UserID, Organisation_Name, Bowser_Capacity, Priority, Request_Reason) values
		    ('$userID', '$organisation','$capacity','$priority','$reason')";
        }
// connection confirmation
        if (mysqli_query($connection, $sql)) {
            echo "success";
            header("Location: ../operations/operations.php");
            CloseConnection($connection);
        } else {
            echo mysqli_error($connection);
            return;
        }
        mysqli_close($connection);
    }
}
?>