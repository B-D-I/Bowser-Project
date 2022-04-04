<?php
session_start();
include "../include/config.php";

// FUNCTION TO ADD NEW BOWSER TO TABLE
function addBowser($capacity){
    $connection = OpenConnection();
    $sql = "INSERT INTO `tbl_bowsers` (Bowser_Capacity, Bowser_Cost, Status) VALUES
		('$capacity', '$capacity', 'Stock')
		";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

// FUNCTION TO UPDATE A BOWSER STATUS
function updateBowserStatus($stock, $capacity){
    $connection = OpenConnection();
    $sql = "UPDATE `tbl_bowser_stock` SET Stock = '$stock' WHERE Bowser_Capacity = '$capacity' ";
    if (mysqli_query($connection, $sql)) {
        echo "success";
    } else {
        echo "error";
    } CloseConnection($connection);
}

// ADD BOWSER
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $connection = OpenConnection();

    $capacity = strip_tags(trim($_POST['Capacity']));
    $sql1 = "SELECT Stock From `tbl_bowser_stock` WHERE Bowser_Capacity = '$capacity'";
    $result = mysqli_query($connection, $sql1);
    $rows = mysqli_fetch_array($result);
    $stock = $rows["Stock"];
    $stock += 1;

    addBowser($capacity);
    updateBowserStatus($stock, $capacity);
    header("Location: ../operations/operations.php");
    CloseConnection($connection);
}
?>
