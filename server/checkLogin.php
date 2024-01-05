<?php
class LogResponse {
    public $logged;
    function setLogged($log) {
        $this->logged = $log;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    $res = new LogResponse();
    if (isset($_SESSION["username"])) {
        $res->setLogged(true);
    } else {
        $res->setLogged(false);
    }
    echo json_encode($res);
}
?>