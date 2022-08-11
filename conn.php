<?php
function sqlconn(){
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "arma3life";

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname,3306);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
//echo "Connected successfully";
	return $conn;
}
$conn=sqlconn();
?>