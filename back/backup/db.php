<?php
require_once 'config.php';

function execute_query($query) {
    global $conn;
    $result = $conn->query($query);
    if ($result === TRUE) {
        return true;
    } else {
        return $conn->error;
    }
}
?>