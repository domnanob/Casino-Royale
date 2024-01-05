<?php
include "./conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    $user = $_SESSION["username"];
    $sql = "SELECT Balance FROM ".$dbname.".".$table." WHERE UserName like '".$user."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "0";
    }
}
?>