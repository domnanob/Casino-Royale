<?php
function setBalance($balance)
{
    include "./conn.php";
    $sql = "UPDATE ".$dbname.".".$table." SET Balance=" . intval($_SESSION["balance"]) + intval($balance) . " WHERE UserName like '" . $_SESSION["username"] . "'";
    $_SESSION["balance"] = intval($_SESSION["balance"]) + intval($balance);
    $result = $conn->query($sql);
}
?>