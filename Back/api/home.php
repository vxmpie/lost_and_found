<?php
require_once '../config.php';

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

// print_r($result);

$items = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}
echo json_encode($items);
?>