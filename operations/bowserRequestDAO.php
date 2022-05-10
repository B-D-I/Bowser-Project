<?php
session_start();
// close the query
function queryClose($sql){
    $connection = OpenConnection();
    if (mysqli_query($connection, $sql)) {
        echo "success";
        header("Location: ../operations/operations.php");
    } else {
        echo mysqli_error($connection);
        header("Location: ../operations/operations.php");
    }
    mysqli_close($connection);
}

// UPDATE BOWSER STATUS
function updateStatus($status, $requestID){
    $sql = "UPDATE `tbl_bowser_requests` SET Status = '$status' WHERE RequestID = '$requestID'";
    queryClose($sql);
}
// variables of posted data
$requestID = $_POST['requestID'];
$capacity = $_POST['capacity'];
$organisation = $_POST['organisation'];
$company = $_POST['company'];

// IF REQUEST ACCEPTED, PERFORM LEND BOWSER FUNCTIONS FROM operationsDAO
if (isset($_POST['acceptButton'])) {
    include 'operationsDAO.php';
    lendBowser($capacity, 'Lend', $organisation, $company);
    updateStatus('Accepted', $requestID);
}
if (isset($_POST['denyButton'])) {
    include "../include/config.php";
    updateStatus('Denied', $requestID);
}
?>