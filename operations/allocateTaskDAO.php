<?php
session_start();
include "../include/config.php";
if (isset($_SESSION['email'])) {

    $email = $_SESSION['email'];
    $connection = OpenConnection();
    $sql = "SELECT User_ID FROM tbl_user_account WHERE Email='$email'";
    $result = mysqli_query($connection,$sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userID = $row["User_ID"];
            CloseConnection($connection);
        }
    }

    $bowserID = strip_tags(trim($_POST['bowserID']));
    $workerID = strip_tags(trim($_POST['workerID']));
    $description = strip_tags(trim($_POST['description']));
    $date = strip_tags(trim($_POST['date']));

    $connection = OpenConnection();

    $sql = "insert into tbl_maintenance_schedule (Bowser_ID, User_ID, Description, Status, Date, assignedTo) values
		('$bowserID', '$userID','$description','Incomplete', '$date','$workerID')";

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