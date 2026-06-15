<?php
require_once '../includes/functions.php';
header('Content-Type: application/json');
$tasks = getAllTasks();
echo json_encode(['success' => true, 'tasks' => $tasks]);
?>