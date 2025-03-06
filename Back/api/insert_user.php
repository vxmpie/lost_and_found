<?php
require_once '../config.php';

$response = ['status' => 'error', 'message' => 'An error occurred'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO account (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $response = ['status' => 'success', 'message' => 'New account created successfully'];
    } else {
        $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
    }
}

echo json_encode($response);
?>