<?php
function OpenConnection(){
// connect to database and credentials
$servername = "localhost"; // server name
$username = "root"; // username
$password = ""; // password
$dbname = "bowser_database"; // database name
	
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


function CloseConnection($connection){
	$connection -> close();
}
?>