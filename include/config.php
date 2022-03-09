<?php
// connect to database and credentials
$servername = "localhost"; // server name
$username = "grp20224"; // username
$password = "7oXhg1]6%-SjOmES"; // password
$dbname = "bowser_database"; // database name

// connection variable to hold credentials
$connection = new mysqli($servername, $username, $password, $dbname);
// confirmation if error
if($connection->connect_error) {
    echo $connection->connect_error;
}

?>