<?php
require_once '../config.php';

$response = ['status' => 'error', 'message' => 'An error occurred'];

if (isset($_GET['q'])) {
    $query = $conn->real_escape_string($_GET['q']);
    
    $sql_search = "SELECT * FROM items WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
    $result_search = $conn->query($sql_search);
    
    if ($result_search->num_rows > 0) {
        $results = [];
        while ($row = $result_search->fetch_assoc()) {
            $results[] = $row;
        }
        $response = ['status' => 'success', 'results' => $results];
    } else {
        $response['message'] = 'No results found';
    }
} else {
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
?>