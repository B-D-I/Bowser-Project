<?php
// this query is used to return the locations of all deployed bowsers
include "../include/config.php";
$connection = OpenConnection();
$sql="SELECT * FROM `tbl_bowser_inuse`";
$res=mysqli_query($connection,$sql);
while($row=mysqli_fetch_array($res)){
    $json[]=$row;
}
// display data
echo json_encode($json);
?>