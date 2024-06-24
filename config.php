<?php
// Database configuration
$host = "localhost"; // or the IP address of your database server
$db_username = "root"; // your database username
$db_password = ""; // your database password
$db_name = "crimeleon2"; // your database name

// Create a new MySQLi connection
$mysqli = new mysqli($host, $db_username, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// If you want to set the charset (optional)
$mysqli->set_charset("utf8");

// Rest of your code

// Remember to close the connection when done
// $mysqli->close();
?>
