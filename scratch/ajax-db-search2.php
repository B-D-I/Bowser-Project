<?php
session_start();
?>
<?php
include '../include/config.php';
if (isset($_GET['term'])) {
   $connection = OpenConnection();
   $query = $_SESSION['query'];
   $term = $_GET['term'];
   $result = mysqli_query($connection, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_array($result)) {
      $res[] = $row['Bowser_Serial'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>