<?php
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $response = ['success' => false, 'message' => ''];

    if ($id > 0 && deleteTask($id)) {
        $response['success'] = true;
        $response['message'] = 'Task deleted';
    } else {
        $response['message'] = 'Delete failed';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>