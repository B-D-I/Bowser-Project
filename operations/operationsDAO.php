<?php
// get connection from config.php
include "../include/config.php";
// create new user function
if ($_POST['phpFunction']=='createUser') {
    create();
}
else if ($_POST['phpFunction']=='requestBowser') {
    bowserTransaction();
}

// CREATE A STAFF USER ACCOUNT
function create()
{
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
    $verificationcode = substr(md5(uniqid(rand(), true)), 9, 9);
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

// FUNCTION TO GET CURRENT USER EMAIL
function returnEmail(){
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
} return $email;
}

// FUNCTION TO GET CURRENT USER ID
function returnUserID(){
    $email = returnEmail();
    $connection = OpenConnection();
    // fetch user id
    $sql = "SELECT * FROM `tbl_user_account` WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_array($result);
    $userID = $rows["User_ID"];
    return $userID;
}

// FUNCTION TO RETRIEVE STOCK OF BOWSER TYPE
function returnBowserStock($capacity){
    $connection = OpenConnection();
    // fetch current bowser stock amount
    $sql = "SELECT Stock From `tbl_bowser_stock` WHERE Bowser_Capacity = '$capacity'";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_array($result);
    $stock = $rows["Stock"];
    return $stock;
}

// FUNCTION TO RETRIEVE A BOWSER OF SPECIFIED CAPACITY
function returnStockedBowser($type, $capacity){
    $connection = OpenConnection();
    $sql1 = "SELECT * FROM `tbl_bowsers` WHERE Bowser_Capacity = '$capacity' AND Status = 'Stock' LIMIT 1";
    $results = mysqli_query($connection, $sql1);
    if ($results->num_rows > 0) {
        while ($rows = $results->fetch_assoc()) {
            $bowserRequest = $rows[$type];
        } return $bowserRequest;
    } CloseConnection($connection);
}

// FUNCTION TO UPDATE THE STOCK OF BOWSER AFTER LEND
function updateBowserStock($modifiedStock, $capacity){
    $connection = OpenConnection();
    $sql = "UPDATE `tbl_bowser_stock` SET Stock = '$modifiedStock' WHERE Bowser_Capacity = '$capacity' ";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

// FUNCTION TO CREATE AN INVOICE
function createInvoice($transaction, $userID, $bowserID, $organisation, $bowserCost){
    $connection = OpenConnection();
    $sql = "INSERT INTO `tbl_bowser_invoices` (Transaction_Type, UserID, BowserID, Organisation_Name, Price) 
                            VALUES ('$transaction', '$userID', '$bowserID', '$organisation', '$bowserCost')";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

// FUNCTION TO SEND A BOWSER REQUEST
function bowserRequest($userID, $capacity, $organisation, $priority, $reason){
    $connection = OpenConnection();
    $sql = "INSERT INTO `tbl_bowser_requests` (UserID, Bowser_Capacity, Organisation_Name, Priority, Status, Request_Reason) VALUES
		    ('$userID','$capacity', '$organisation' ,'$priority', 'Pending', '$reason')";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

// FUNCTION TO SET BOWSER STATUS TO LENT
function lendBowser($bowserID){
    $connection = OpenConnection();
    $sql = "UPDATE `tbl_bowsers` SET Status = 'Lent' WHERE BowserID = '$bowserID'";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
    CloseConnection($connection);
}

// FUNCTION TO PERFORM BOWSER TRANSACTIONS
function bowserTransaction()
{
    $connection = OpenConnection();
    $reason = $_POST['Reason'];
    $transaction = strip_tags(trim($_POST['Transaction']));
    $organisation = strip_tags(trim($_POST['Organisation']));
    $capacity = strip_tags(trim($_POST['Capacity']));
    $priority = strip_tags(trim($_POST['Priority']));

    $userID = returnUserID();
    $stock = returnBowserStock($capacity);

    if ($transaction == 'Lend') {
        // update stock
        $modifiedStock = $stock - 1;
        $bowserID = returnStockedBowser('BowserID', $capacity);
        $bowserCost = returnStockedBowser('Bowser_Cost', $capacity);

        lendBowser($bowserID);
        createInvoice($transaction, $userID, $bowserID, $organisation, $bowserCost);
        updateBowserStock($modifiedStock, $capacity);
        header("Location: ../operations/operations.php");
    }
    if ($transaction == 'Loan') {
        bowserRequest($userID, $capacity, $organisation, $priority, $reason);
        header("Location: ../operations/operations.php");
    }
    CloseConnection($connection);
}
?>
