<?php
function OpenConnection(){
// connect to database and credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bowser_database";
	
// connection variable to hold credentials
$connection = new mysqli($servername, $username, $password, $dbname);
// confirmation if error
	if(!$connection){
		$err = 'MySQLi Error: '. mysqli_connect_errno(). ' '. mysqli_connect_error();
		trigger_error($err, E_USER_ERROR);
	} else {
		return $connection;
	}
}
// function to close the connection
function CloseConnection($connection){
	$connection -> close();
}
?>