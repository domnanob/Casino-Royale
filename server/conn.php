<?php
/*
$servername = "mysql.caesar.elte.hu";
$username = "domnanob";
$password = "SFS3vDp4ADcr24BF";
$dbname = "domnanob";
$table = "`casino_users`";
*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casino";
$table = "users";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>