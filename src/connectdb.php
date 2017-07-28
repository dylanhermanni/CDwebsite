<?php
$database = array();
$database['host'] = "localhost";
$database['port'] = "3306";
$database['name'] = "cdwebsite";
$database['username'] = "root";
$database['password'] = "";

$link = mysql_connect($database['host'], $database['username'], $database['password']);
if ($link) {
    echo "De verbinding is gelukt! u bent verbonden met database: ".$database['name'] . "<br>";
} else {
    echo "mislukt database: ".$database['name'] . "failed";
    echo "error: " .mysql_error();
}
?>