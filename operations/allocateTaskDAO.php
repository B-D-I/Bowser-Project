<?php
session_start();
include "../include/config.php";
if (isset($_SESSION['email'])) {

    $bowserID = strip_tags(trim($_POST['bowserID']));
    $workerID = strip_tags(trim($_POST['workerID']));
    $description = strip_tags(trim($_POST['description']));
    $date = strip_tags(trim($_POST['date']));

    $connection = OpenConnection();

    $sql = "insert into tbl_maintenance_schedule (Bowser_ID, User_ID, Description, Date, assignedTo) values
		('$bowserID', '$workerID','$description','$date','$workerID')";

// connection confirmation
    if (mysqli_query($connection, $sql)) {
        echo "success";
        header("Location: ../operations/operations.php");
    } else {
        echo mysqli_error($connection);
        return;
        header("Location: ../operations/operations.php");
    }
    mysqli_close($connection);
}
?>