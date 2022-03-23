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


function requestBowser()
{
    session_start();
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $reason = $_POST['Reason'];
        $transaction = strip_tags(trim($_POST['Transaction']));
        $organisation = strip_tags(trim($_POST['Organisation']));
        $capacity = strip_tags(trim($_POST['Capacity']));
        $priority = strip_tags(trim($_POST['Priority']));

        $connection = OpenConnection();
        // fetch user id
        $sql1 = "SELECT * FROM `tbl_user_account` WHERE email='$email'";
        $result = mysqli_query($connection, $sql1);
        $rows = mysqli_fetch_array($result);
        $userID = $rows["User_ID"];
        // fetch current bowser stock amount
        $sql2 = "SELECT Stock From `tbl_bowser_stock` WHERE Bowser_Capacity = '$capacity'";
        $result = mysqli_query($connection, $sql2);
        $rows = mysqli_fetch_array($result);
        $stock = $rows["Stock"];
        $modifiedStock = null;
        // lend: select an available bowser of correct capacity and create an invoice for lent bowser
        if ($transaction == 'Lend') {
            $modifiedStock = $stock - 1;
            $sql3 = "SELECT * FROM `tbl_bowsers` WHERE Bowser_Capacity = '$capacity' AND Status = 'Stock' LIMIT 1";
            $results = mysqli_query($connection, $sql3);
            if ($results->num_rows > 0) {
                while ($rows = $results->fetch_assoc()) {
                    $bowserID = $rows['BowserID'];
                    $bowserCost = $rows['Bowser_Cost'];
                    $sql = "INSERT INTO `tbl_bowser_invoices` (Transaction_Type, UserID, BowserID, Organisation_Name, Price) 
                            VALUES ('$transaction', '$userID', '$bowserID', '$organisation', '$bowserCost')";
                }
            }
        }

        // if loaning a bowser, a request is created
        if ($transaction == 'Loan') {
            $sql = "INSERT INTO `tbl_bowser_requests` (UserID, Bowser_Capacity, Organisation_Name, Priority, Request_Reason) values
		    ('$userID','$capacity', '$organisation' ,'$priority','$reason')";
        }
// connection confirmation
        if (mysqli_query($connection, $sql)) {
            echo "success";
            $sql4 = "UPDATE `tbl_bowser_stock` SET Stock = '$modifiedStock' WHERE Bowser_Capacity = '$capacity' ";
            if (mysqli_query($connection, $sql4)) {
                $sql5 = "UPDATE `tbl_bowsers` SET Status = 'Lent' WHERE BowserID = '$bowserID'";
                if (mysqli_query($connection, $sql5)) {
                    header("Location: ../operations/operations.php");
                    CloseConnection($connection);
                } else {
                    echo mysqli_error($connection);
                    return;
                }
                mysqli_close($connection);
            }
        }
    }
}
// Lend : added to invoice - reduce stock - set status to lent
?>
