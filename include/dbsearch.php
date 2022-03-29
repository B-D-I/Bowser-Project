<?php
session_start();
?>
<?php
include '../include/config.php';
if (isset($_GET['term'])) {
	$term = $_GET['term'];
	$query = $_SESSION['query'];

	$connection = OpenConnection();
	$query = str_replace('{TERM}', $term, $query);
	$result = mysqli_query($connection, $query);
 	if (mysqli_num_rows($result) > 0) {
    	while ($row = mysqli_fetch_array($result)) {
		$res[]=$row[0];
    	}
	}
    //return json res
    echo json_encode($res);
	return json_encode($res);
}
?>