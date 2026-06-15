<?php
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $status = $_POST['status'] ?? '';

    $response = ['success' => false, 'message' => ''];

    if ($id > 0 && in_array($status, ['Pending', 'Completed'])) {
        if (updateTaskStatus($id, $status)) {
            $response['success'] = true;
            $response['message'] = 'Status updated';
        } else {
            $response['message'] = 'Update failed';
        }
    } else {
        $response['message'] = 'Invalid data';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>