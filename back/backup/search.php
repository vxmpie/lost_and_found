<?php
require_once 'config.php';

if(isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT * FROM items WHERE name LIKE '%$query%' OR description LIKE '%$query%' OR location LIKE '%$query%'";
    $result = $conn->query($sql);

    $items = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    echo json_encode($items);
}
?>