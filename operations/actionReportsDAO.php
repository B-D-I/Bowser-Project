<?php

session_start();
include "../include/config.php";

function queryClose($sql){
    $connection = OpenConnection();
    if (mysqli_query($connection, $sql)) {
        echo "success";
        header("Location: ../operations/reports.php");
    } else {
        echo mysqli_error($connection);
        header("Location: ../operations/reports.php");
    }
    mysqli_close($connection);
}

function updateReportStatus($status, $reportID){
    $sql = "UPDATE `tbl_reports` SET Status = '$status' WHERE Report_ID = '$reportID'";
    queryClose($sql);
}

function updateNotifications($noticeText, $areaID, $type){
    $sql = "INSERT INTO `tbl_notifications` (Notice_Text, Area_ID, Type) VALUES ('$noticeText', '$areaID', '$type') ";
    queryClose($sql);
}
//function updateFixNotifications($fixNoticeText, $areaID, $type){
//    $sql = "INSERT INTO `tbl_notifications` (Notice_Text, Area_ID, Type) VALUES ('$fixNoticeText', '$areaID', '$type') ";
//    queryClose($sql);
//}

$reportID = $_POST['reportID'];
$reportType = $_POST['reportType'];
$reportString = $_POST['reportString'];
$bowserID = $_POST['bowserID'];
$description = $_POST['description'];
$reportDate = $_POST['date'];
$currentDate = date('Y-m-d');

$noticeText = "From ".$currentDate."&nbsp;&nbsp;Bowser: ".$bowserID."&nbsp;will be undergoing a ".$reportString;

if (isset($_POST['acceptButton'])) {
    updateNotifications($noticeText, 2, 1);
    updateReportStatus('Actioned', $reportID);
}
if (isset($_POST['denyButton'])) {
    updateReportStatus('Ignored', $reportID);
}
?>