<?php

include ('../helpers.php');

requireLogin();
requireAgent();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'] ?? '';
    $user_id = $_POST['user_id'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $date_of_birth = $_POST['dob'] ?? '';
    $code_student = $_POST['code_student'] ?? '';
    $cin = $_POST['cin'] ?? '';
    $filiere = $_POST['filiere'] ?? '';

    if (empty($id) || empty($user_id)) {
        header("Location: index.php");
        exit();
    }

    try {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE students SET firstname = ?, lastname = ?, date_of_birth = ?, code_student = ?, cin = ?, filiere = ?, user_id = ? WHERE id = ?");
        $stmt->execute([$firstname, $lastname, $date_of_birth, $code_student, $cin, $filiere, $user_id, $id]);

        header("Location: index.php");
        exit();

    } catch(PDOException $e) {
        die("Erreur de modification : " . $e->getMessage());
    }

} else {
    header("Location: index.php");
    exit();
}