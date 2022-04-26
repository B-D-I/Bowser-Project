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
    $sql = "UPDATE `tbl_bowsers` SET Lat ='$postLat', Lng ='$postLng', Status = '$status' WHERE BowserID = '$bowserID'";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}
function updateBowserInUse($bowserID, $postLat, $postLng, $userID){
    $connection = OpenConnection();
    $sql = "INSERT INTO `tbl_bowser_inuse` (Bowser_ID, Lat, Lng, User_ID)
    VALUES ('$bowserID', '$postLat', '$postLng', '$userID') ON DUPLICATE KEY UPDATE Lat='$postLat', Lng='$postLng'";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

$bowserID=$_POST['bowserID'];
$postLng=$_POST['locationLng'];
$postLat=$_POST['locationLat'];
$email = $_SESSION['email'];
$userID = returnUserID();

updateBowserLocation($postLng, $postLat, 'Deployed', $bowserID);
updateBowserInUse($bowserID, $postLat, $postLng, $userID);
?>