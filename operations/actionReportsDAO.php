<?php
session_start();
include "../include/config.php";

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

function updateReportStatus($status, $reportID){
    $sql = "UPDATE `tbl_reports` SET Status = '$status' WHERE Report_ID = '$reportID'";
    queryClose($sql);
}

function updateNotifications($noticeText, $areaID){
    $sql = "INSERT INTO `tbl_notifications` (Notice_Text, Area_ID) VALUES ('$noticeText', '$areaID') ";
    queryClose($sql);
}

$reportID = $_POST['reportID'];
$reportType = $_POST['reportType'];
$reportString = $_POST['reportString'];
$bowserID = $_POST['bowserID'];
$description = $_POST['description'];
$date = $_POST['date'];

$noticeText = "From ".$date."&nbsp;&nbsp;Bowser: ".$bowserID."&nbsp;will be undergoing a ".$reportString;


if (isset($_POST['acceptButton'])) {
    updateNotifications($noticeText, 2);
    updateReportStatus('Actioned', $reportID);

}
if (isset($_POST['denyButton'])) {
    updateReportStatus('Ignored', $reportID);
}
?>