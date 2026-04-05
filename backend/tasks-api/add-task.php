<?php
require '../db.php';

session_start();

if (!isset($_SESSION["user_id"])) {
    echo json_encode(['success' => false, 'message' => 'Error No logged in user']);
    exit;
}

$title = $_POST['title'];
$user = $_SESSION['user_id'];
$date = date('Y-m-d H:i:s');

try {
$stmt = $pdo->prepare('INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)');
$stmt->execute([
    'user_id' => $user,
    'title' => $title,
    'created_at' => $date
]);

echo json_encode(['success' => true, 'message' => 'Task added successfully']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error adding task: ' . $e->getMessage()]);
    exit;
}

?>