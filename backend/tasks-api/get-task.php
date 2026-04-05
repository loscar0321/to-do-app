<?php
Header('Content-Type: application/json');
require '../db.php';
session_start();
if (isset($_SESSION['']) && $_SESSION['']) {
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        echo json_encode($task);
    } else {
        echo json_encode(['success' => false, 'message' => 'Task not found']);
    }
}
?>