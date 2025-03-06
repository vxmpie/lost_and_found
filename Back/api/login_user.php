<?php
require_once '../config.php';

$response = ['status' => 'error', 'message' => 'An error occurred'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $response = ['status' => 'success', 'message' => 'Login successful'];
        } else {
            $response['message'] = 'Invalid password';
        }
    } else {
        $response['message'] = 'No user found with that email';
    }
}

echo json_encode($response);
?>