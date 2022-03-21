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
	if($connection->connect_error) {
    	echo $connection->connect_error;
	}

return $connection;
}

function CloseConnection($connection){
	$connection -> close();
}
?>