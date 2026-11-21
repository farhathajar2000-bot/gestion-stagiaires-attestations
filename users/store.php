<?php
include ('../helpers.php');

requireLogin();
requireAgent();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

        $Check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $Check->execute([$email]);
        
        if ($Check->fetch()) {
            header("Location: create.php?error=2");
            exit();
        }
        
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password, $role]);

        header("Location: index.php");
        exit();

    } catch(PDOException $e) {
        die("Erreur lors de la création : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}
?>