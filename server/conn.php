<?php
//This is the original connection for the databese, but it only works in my webstorage
//$servername = "mysql.rackhost.hu";
//$username = "c43246domnanob";
//$password = "CasinoRoyale";
//$dbname = "c43246database";
//$table = "casino_users";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casino";
$table = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>