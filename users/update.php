<?php
include ('../helpers.php');

requireLogin();
requireAgent();
$pdo = Database::getConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        if (!empty($password)) {

            $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE id = ?");
            $stmt->execute([$username, $email, $role, $hashed_pass, $id]);
        } 

        else {
            
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
            $stmt->execute([$username, $email, $role, $id]);
        }
        
        header("Location: index.php");
        exit();

    } catch(PDOException $e) {
        die("Erreur de modification : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}