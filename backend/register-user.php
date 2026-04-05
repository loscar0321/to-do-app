<?php
Header('Content-Type: application/json');
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['success' => false, 'message' => 'Username already exists']);
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
        "INSERT INTO users 
        (username, password, firstname, lastname) 
        VALUES 
        (:username, 
        :password, 
        :firstName, 
        :lastName)"
        );
    $stmt->execute([
        'username' => $username, 
        'password' => $hashedPassword, 
        'firstName' => $firstName, 
        'lastName' => $lastName]);
    echo json_encode(['success' => true, 'message' => 'User registered successfully']);
}
?>