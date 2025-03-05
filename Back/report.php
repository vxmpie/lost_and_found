<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $conn->real_escape_string($_POST['item_id']);
    $report_text = $conn->real_escape_string($_POST['report_text']);

    $sql = "INSERT INTO reports (item_id, report_text) VALUES ('$item_id', '$report_text')";
    if ($conn->query($sql) === TRUE) {
        echo "Report submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>