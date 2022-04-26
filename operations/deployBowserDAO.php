<?php
session_start();
include '../include/config.php';
$connection = OpenConnection();

function returnUserID(){
    $email =$_SESSION['email'];
    $connection = OpenConnection();
    // fetch user id
    $sql = "SELECT * FROM `tbl_user_account` WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $rows = mysqli_fetch_array($result);
    $userID = $rows["User_ID"];
    return $userID;
}
function updateBowserLocation($postLng, $postLat, $status, $bowserID){
    $connection = OpenConnection();
    $sql = "UPDATE `tbl_bowsers` SET Longitude ='$postLng' AND Latitude ='$postLat' AND Status = '$status' WHERE BowserID = '$bowserID'";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

$bowserID=$_POST['bowserID'];
$postLng=$_POST['locationLng'];
$postLat=$_POST['locationLat'];
//$postLoc=$_POST['locationComb'];

$email = $_SESSION['email'];
$userID = returnUserID();


// '$bowserID',
$sql = "INSERT INTO `tbl_bowser_inuse` (Bowser_ID, Bowser_Longitude, Bowser_Latitude, User_ID)
    VALUES ('$bowserID', '$postLng', '$postLat', '$userID')";

// $bowserID
updateBowserLocation($postLng, $postLat, 'Deployed', 4);

if (mysqli_query($connection, $sql)) {
    echo "success";
} else {
    echo "error";
} CloseConnection($connection);
?>