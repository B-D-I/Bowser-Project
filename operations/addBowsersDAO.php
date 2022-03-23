<?php
session_start();
include "../include/config.php";
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    $connection = OpenConnection();

    $capacity = strip_tags(trim($_POST['Capacity']));
    $sql1 = "SELECT Stock From `tbl_bowser_stock` WHERE Bowser_Capacity = '$capacity'";
    $result = mysqli_query($connection, $sql1);
    $rows = mysqli_fetch_array($result);
    $stock = $rows["Stock"];
    $stock += 1;

    $sql = "insert into tbl_bowsers (Bowser_Capacity, Bowser_Cost, Status) values
		('$capacity', '$capacity', 'Stock')
		";

// connection confirmation
    if (mysqli_query($connection, $sql)) {
        $sql2 = "UPDATE `tbl_bowser_stock` SET Stock = '$stock' WHERE Bowser_Capacity = '$capacity' ";
        if (mysqli_query($connection, $sql2)) {
            echo "success";
            header("Location: ../operations/operations.php");
        } else {
            echo mysqli_error($connection);
            return;
            header("Location: ../operations/operations.php");
        }
        mysqli_close($connection);
    }
}
?>
