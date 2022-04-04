<?php
session_start();
include "../include/config.php";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $connection = OpenConnection();

    $requestCheckBox = $_POST['requestCheckBox'];

    $sql = "UPDATE `tbl_bowser_requests` SET Status = '$requestCheckBox' ";

    if (mysqli_query($connection, $sql)) {
        echo "success";
        header("Location: ../operations/operations.php");
    } else {
        echo "error";
        header("Location: ../operations/operations.php");
    } CloseConnection($connection);
}

?>