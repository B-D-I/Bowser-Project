<?php
include "../include/config.php";
// this query returns report location data to be used for heatmap
$connection = OpenConnection();
$sql="SELECT * FROM `tbl_reports`";
$res=mysqli_query($connection,$sql);
while($row=mysqli_fetch_array($res)){
    $json[]=$row;
}
// display data
echo json_encode($json);
?>
