<?php

include ('../helpers.php');

requireLogin();
requireAgent();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $user_id = $_POST['user_id'] ?? '';

    if (empty($user_id)) {
        header("Location: create.php?error=missing_user");
        exit();
    }

    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $date_of_birth = $_POST['dob'] ?? '';
    $code_student = $_POST['student_code'] ?? '';
    $cin = $_POST['cin'] ?? '';
    $filiere = $_POST['field'] ?? '';

    try {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO students (firstname, lastname, date_of_birth, code_student, cin, filiere, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([$firstname, $lastname, $date_of_birth, $code_student, $cin, $filiere, $user_id]);

        header("Location: index.php");
        exit();

    } catch(PDOException $e) {
        die("Erreur hors de la création de l'étudiant : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}
?>