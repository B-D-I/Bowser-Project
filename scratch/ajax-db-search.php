 <?php
require "../include/config.php";
$connection = OpenConnection();	
if (isset($_POST['query'])) {
	$sql = "SELECT * FROM tbl_bowser_stock WHERE Bowser_Serial LIKE '{$_POST['query']}%' LIMIT 25";
    $result = mysqli_query($connection, $sql);
 
  if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_array($result)) {
      echo $row['Bowser_Serial']."<br/>";
    }
  } else {
    echo "<p style='color:red'>User not found...</p>";
  }
 
}
?>