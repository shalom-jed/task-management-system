<?php
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $priority = $_POST['priority'] ?? 'Medium';

    $response = ['success' => false, 'message' => ''];

    if (strlen($title) < 3) {
        $response['message'] = 'Title must be at least 3 characters';
    } else {
        if (addTask($title, $description, $priority)) {
            $response['success'] = true;
            $response['message'] = 'Task added';
        } else {
            $response['message'] = 'Database error';
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>