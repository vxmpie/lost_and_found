<?php
require_once '../config.php';

$response = ['status' => 'error', 'message' => 'An error occurred'];

if (isset($_GET['id'])) {
    $postId = $conn->real_escape_string($_GET['id']);
    
    $sql_select_post = "SELECT * FROM items WHERE id = '$postId'";
    $result_post = $conn->query($sql_select_post);
    
    if ($result_post->num_rows > 0) {
        $post = $result_post->fetch_assoc();
        
        $userId = $post['owner'];
        $sql_select_user = "SELECT email FROM users WHERE id = '$userId'";
        $result_user = $conn->query($sql_select_user);
        
        if ($result_user->num_rows > 0) {
            $user = $result_user->fetch_assoc();
            
            session_start();
            $isLoggedIn = isset($_SESSION['user_id']);
            
            $response = [
                'status' => 'success',
                'post' => $post,
                'user' => $user,
                'isLoggedIn' => $isLoggedIn
            ];
        } else {
            $response['message'] = 'User not found';
        }
    } else {
        $response['message'] = 'Post not found';
    }
} else {
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
?>