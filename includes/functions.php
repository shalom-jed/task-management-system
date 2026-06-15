<?php
require_once 'db.php';

function getAllTasks() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY created_at DESC");
    $tasks = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }
    return $tasks;
}

function addTask($title, $description, $priority) {
    global $conn;
    $stmt = mysqli_prepare($conn, "INSERT INTO tasks (title, description, priority) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $priority);
    return mysqli_stmt_execute($stmt);
}

function updateTaskStatus($id, $status) {
    global $conn;
    $stmt = mysqli_prepare($conn, "UPDATE tasks SET status = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    return mysqli_stmt_execute($stmt);
}

function deleteTask($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM tasks WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
?>